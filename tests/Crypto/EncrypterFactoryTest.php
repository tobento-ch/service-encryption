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

namespace Tobento\Service\Encryption\Crypto\Test;

use PHPUnit\Framework\TestCase;
use Tobento\Service\Encryption\Crypto\EncrypterFactory;
use Tobento\Service\Encryption\EncrypterFactoryInterface;
use Tobento\Service\Encryption\EncrypterInterface;
use Tobento\Service\Encryption\EncrypterException;
use Defuse\Crypto\Key;

/**
 * EncrypterFactoryTest
 */
class EncrypterFactoryTest extends TestCase
{
    public function testThatImplementsEncrypterFactoryInterface()
    {
        $this->assertInstanceof(
            EncrypterFactoryInterface::class,
            new EncrypterFactory()
        );
    }
    
    public function testCreateEncrypterMethod()
    {
        $key = Key::createNewRandomKey()->saveToAsciiSafeString();
        
        $this->assertInstanceof(
            EncrypterInterface::class,
            (new EncrypterFactory())->createEncrypter(key: $key)
        );
    }
    
    public function testCreateEncrypterMethodThrowsEncrypterExceptionIfBadKey()
    {
        $this->expectException(EncrypterException::class);
        
        (new EncrypterFactory())->createEncrypter(key: 'badKey');
    }
}