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

namespace Tobento\Service\Encryption;

/**
 * EncrypterInterface for encrypt and decrypt data.
 */
interface EncrypterInterface
{
    /**
     * Returns the encrypted data.
     *
     * @param mixed $data
     * @return string
     * @throws EncryptException
     */
    public function encrypt(mixed $data): string;
    
    /**
     * Returns the decrypted data.
     *
     * @param string $encrypted
     * @return mixed
     * @throws DecryptException
     */
    public function decrypt(string $encrypted): mixed;
}