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

use Psr\Container\ContainerInterface;
use Tobento\Service\Autowire\Autowire;

/**
 * LazyEncrypters
 */
final class LazyEncrypters implements EncryptersInterface, EncrypterInterface
{
    /**
     * @var Autowire
     */
    protected Autowire $autowire;
    
    /**
     * @var array<string, EncrypterInterface>
     */
    protected array $createdEncrypters = [];
    
    /**
     * Create a new LazyEncrypters.
     *
     * @param ContainerInterface $container
     * @param array $encrypters
     */
    public function __construct(
        ContainerInterface $container,
        protected array $encrypters,
    ) {
        $this->autowire = new Autowire($container);
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
        if (isset($this->createdEncrypters[$name])) {
            return $this->createdEncrypters[$name];
        }
        
        if (!isset($this->encrypters[$name])) {
            return null;
        }
        
        if (!isset($this->encrypters[$name]['factory'])) {
            return null;
        }
        
        $factory = $this->autowire->resolve($this->encrypters[$name]['factory']);
        
        if (! $factory instanceof EncrypterFactoryInterface) {
            return null;
        }
        
        $config = $this->encrypters[$name]['config'] ?? [];
        
        return $this->createdEncrypters[$name] = $factory->createEncrypter($name, $config);
    }
    
    /**
     * Returns the name.
     *
     * @return string
     */
    public function name(): string
    {
        return 'lazyEncrypters';
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
        $encrypter = $this->get($this->getFirstEncrypterName());
        
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
        $encrypter = $this->get($this->getFirstEncrypterName());
        
        if (is_null($encrypter)) {
            throw new DecryptException('No encrypter found');
        }
        
        return $encrypter->decrypt($encrypted);
    }
    
    /**
     * Returns the first encrypter name or null if none.
     *
     * @return string
     */
    protected function getFirstEncrypterName(): string
    {
        $firstKey = array_key_first($this->encrypters);
        
        return is_null($firstKey) ? 'default' : $this->encrypters[$firstKey];
    }
}