<?php

/**
 * TOBENTO
 *
 * @copyright   Tobias Strub, TOBENTO
 * @license     MIT License, see LICENSE file distributed with this source code.
 * @author      Tobias Strub
 * @link        https://www.tobento.ch
 */

declare(strict_types=1);

namespace Tobento\Service\Encryption\Crypto;

use Tobento\Service\Encryption\KeyGeneratorInterface;
use Tobento\Service\Encryption\KeyException;
use Defuse\Crypto\Key;
use Defuse\Crypto\Exception\CryptoException;

/**
 * KeyGenerator
 */
class KeyGenerator implements KeyGeneratorInterface
{
    /**
     * Returns a generated new key.
     *
     * @return string
     * @throws KeyException
     */
    public function generateKey(): string
    {
        try {
            return Key::createNewRandomKey()->saveToAsciiSafeString();
        } catch (CryptoException $e) {
            throw new KeyException($e->getMessage(), (int)$e->getCode(), $e);
        }
    }
}