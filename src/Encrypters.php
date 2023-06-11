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
 * Encrypters
 */
final class Encrypters implements EncryptersInterface, EncrypterInterface
{
    /**
     * @var array<string, EncrypterInterface>
     */
    protected array $encrypters = [];
    
    /**
     * Create a new Encrypters.
     *
     * @param EncrypterInterface ...$encrypters
     */
    public function __construct(
        EncrypterInterface ...$encrypters,
    ) {
        foreach($encrypters as $encrypter) {
            $this->encrypters[$encrypter->name()] = $encrypter;
        }
    }

    /**
     * Returns true if encrypter exists, otherwise false.
     *
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool
    {
        return isset($this->encrypters[$name]);
    }
    
    /**
     * Returns the encrypter if exists, otherwise null.
     *
     * @param string $name
     * @return null|EncrypterInterface
     */
    public function get(string $name): null|EncrypterInterface
    {
        return $this->encrypters[$name] ?? null;
    }
    
    /**
     * Returns the name.
     *
     * @return string
     */
    public function name(): string
    {
        return 'encrypters';
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
        $encrypter = $this->getFirst();
        
        if (is_null($encrypter)) {
            throw new EncryptException('No encrypter found');
        }
        
        return $encrypter->encrypt($data);
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
        $encrypter = $this->getFirst();
        
        if (is_null($encrypter)) {
            throw new DecryptException('No encrypter found');
        }
        
        return $encrypter->decrypt($encrypted);
    }
    
    /**
     * Returns the first encrypter or null if none.
     *
     * @return null|EncrypterInterface
     */
    protected function getFirst(): null|EncrypterInterface
    {
        $firstKey = array_key_first($this->encrypters);
        
        return is_null($firstKey) ? null : $this->encrypters[$firstKey];
    }
}