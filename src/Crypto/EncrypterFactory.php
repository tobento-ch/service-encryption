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

use Tobento\Service\Encryption\EncrypterFactoryInterface;
use Tobento\Service\Encryption\EncrypterInterface;
use Tobento\Service\Encryption\EncrypterException;
use Defuse\Crypto\Key;
use Defuse\Crypto\Exception\CryptoException;

/**
 * EncrypterFactory
 */
class EncrypterFactory implements EncrypterFactoryInterface
{
    /**
     * Create a new Encrypter.
     *
     * @param string $key
     * @return EncrypterInterface
     * @throws EncrypterException
     */
    public function createEncrypter(string $key): EncrypterInterface
    {
        try {
            $key = Key::loadFromAsciiSafeString($key);
        } catch (CryptoException $e) {
            throw new EncrypterException($e->getMessage(), $e->getCode(), $e);
        }
        
        return new Encrypter($key);
    }
}