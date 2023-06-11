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

use Tobento\Service\Encryption\EncrypterInterface;
use Tobento\Service\Encryption\EncryptException;
use Tobento\Service\Encryption\DecryptException;
use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;
use Throwable;

/**
 * Encrypter
 */
final class Encrypter implements EncrypterInterface
{
    /**
     * Create a new Encrypter.
     *
     * @param string $name
     * @param Key $key
     */
    public function __construct(
        protected string $name,
        #[\SensitiveParameter] protected Key $key,
    ) {}
    
    /**
     * Returns the encrypter name.
     *
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }
    
    /**
     * Returns the encrypted data.
     *
     * @param mixed $data
     * @return string
     * @throws EncryptException
     */
    public function encrypt(mixed $data): string
    {
        try {
            $data = json_encode($data, JSON_THROW_ON_ERROR);
            
            return base64_encode(Crypto::encrypt($data, $this->key));
        } catch (Throwable $e) {
            throw new EncryptException($e->getMessage(), (int)$e->getCode(), $e);
        }
    }
    
    /**
     * Returns the decrypted data.
     *
     * @param string $encrypted
     * @return mixed
     * @throws DecryptException
     */
    public function decrypt(string $encrypted): mixed
    {
        try {
            $decrypted = Crypto::decrypt(base64_decode($encrypted), $this->key);
            
            return json_decode($decrypted, true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $e) {
            throw new DecryptException($e->getMessage(), (int)$e->getCode(), $e);
        }
    }
}