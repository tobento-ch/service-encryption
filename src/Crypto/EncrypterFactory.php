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
     * @param string $name
     * @param array $config
     * @return EncrypterInterface
     * @throws EncrypterException
     */
    public function createEncrypter(string $name, array $config): EncrypterInterface
    {
        if (!isset($config['key']) || !is_string($config['key'])) {
            throw new EncrypterException('Missing or invalid config "key"');
        }
        
        try {
            $key = Key::loadFromAsciiSafeString($config['key']);
        } catch (CryptoException $e) {
            throw new EncrypterException($e->getMessage(), $e->getCode(), $e);
        }
        
        return new Encrypter($name, $key);
    }
}