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

namespace Tobento\Service\Encryption\Test;

use PHPUnit\Framework\TestCase;
use Tobento\Service\Encryption\Encrypters;
use Tobento\Service\Encryption\EncryptersInterface;
use Tobento\Service\Encryption\EncrypterInterface;
use Tobento\Service\Encryption\Crypto;

/**
 * EncryptersTest
 */
class EncryptersTest extends TestCase
{
    protected function createEncrypter(string $name): EncrypterInterface
    {
        return (new Crypto\EncrypterFactory())->createEncrypter(
            name: $name,
            config: [
                'key' => (new Crypto\KeyGenerator())->generateKey(),
            ],
        );
    }
    
    public function testConstructorMethod()
    {
        $encrypters = new Encrypters(
            $this->createEncrypter('default'),
            $this->createEncrypter('foo'),
        );
        
        $this->assertInstanceof(EncryptersInterface::class, $encrypters);
        $this->assertInstanceof(EncrypterInterface::class, $encrypters);
    }
    
    public function testGetMethod()
    {
        $encrypters = new Encrypters(
            $this->createEncrypter('default'),
            $this->createEncrypter('foo'),
        );
        
        $this->assertInstanceof(EncrypterInterface::class, $encrypters->get(name: 'default'));
        $this->assertInstanceof(EncrypterInterface::class, $encrypters->get(name: 'foo'));
        $this->assertSame(null, $encrypters->get(name: 'bar'));
    }
    
    public function testHasMethod()
    {
        $encrypters = new Encrypters(
            $this->createEncrypter('default'),
            $this->createEncrypter('foo'),
        );
        
        $this->assertTrue($encrypters->has(name: 'default'));
        $this->assertTrue($encrypters->has(name: 'foo'));
        $this->assertFalse($encrypters->has(name: 'bar'));
    }
}