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
use Tobento\Service\Encryption\LazyEncrypters;
use Tobento\Service\Encryption\EncryptersInterface;
use Tobento\Service\Encryption\EncrypterInterface;
use Tobento\Service\Encryption\Crypto;
use Tobento\Service\Container\Container;

/**
 * LazyEncryptersTest
 */
class LazyEncryptersTest extends TestCase
{
    public function testConstructorMethod()
    {
        $encrypters = new LazyEncrypters(
            container: new Container(),
            encrypters: [
                'default' => [
                    'factory' => Crypto\EncrypterFactory::class,
                    'config' => [
                        'key' => (new Crypto\KeyGenerator())->generateKey(),
                    ],
                ],
            ],
        );
        
        $this->assertInstanceof(EncryptersInterface::class, $encrypters);
        $this->assertInstanceof(EncrypterInterface::class, $encrypters);
    }
    
    public function testGetMethod()
    {
        $encrypters = new LazyEncrypters(
            container: new Container(),
            encrypters: [
                'default' => [
                    'factory' => Crypto\EncrypterFactory::class,
                    'config' => [
                        'key' => (new Crypto\KeyGenerator())->generateKey(),
                    ],
                ],
                'foo' => [
                    'factory' => Crypto\EncrypterFactory::class,
                    'config' => [
                        'key' => (new Crypto\KeyGenerator())->generateKey(),
                    ],
                ],
            ],
        );
        
        $this->assertInstanceof(EncrypterInterface::class, $encrypters->get(name: 'default'));
        $this->assertInstanceof(EncrypterInterface::class, $encrypters->get(name: 'foo'));
        $this->assertSame(null, $encrypters->get(name: 'bar'));
    }
    
    public function testHasMethod()
    {
        $encrypters = new LazyEncrypters(
            container: new Container(),
            encrypters: [
                'default' => [
                    'factory' => Crypto\EncrypterFactory::class,
                    'config' => [
                        'key' => (new Crypto\KeyGenerator())->generateKey(),
                    ],
                ],
                'foo' => [
                    'factory' => Crypto\EncrypterFactory::class,
                    'config' => [
                        'key' => (new Crypto\KeyGenerator())->generateKey(),
                    ],
                ],
            ],
        );
        
        $this->assertTrue($encrypters->has(name: 'default'));
        $this->assertTrue($encrypters->has(name: 'foo'));
        $this->assertFalse($encrypters->has(name: 'bar'));
    }
}