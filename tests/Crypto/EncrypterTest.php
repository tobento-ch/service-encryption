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
use Tobento\Service\Encryption\Crypto\Encrypter;
use Tobento\Service\Encryption\EncrypterInterface;
use Tobento\Service\Encryption\DecryptException;
use Defuse\Crypto\Key;

/**
 * EncrypterTest
 */
class EncrypterTest extends TestCase
{
    public function testThatImplementsEncrypterInterface()
    {
        $key = Key::createNewRandomKey();
        
        $enrypter = new Encrypter(key: Key::createNewRandomKey());
        
        $this->assertInstanceof(EncrypterInterface::class, $enrypter);
    }
    
    public function testEncryptAndDecrypt()
    {
        $encrypter = new Encrypter(key: Key::createNewRandomKey());
        
        $encrypted = $encrypter->encrypt('lorem ipsum');
        
        $this->assertNotSame('lorem ipsum', $encrypted);
        $this->assertSame('lorem ipsum', $encrypter->decrypt($encrypted));
    }
    
    public function testDecryptThrowsDecryptExceptionIfBadData()
    {
        $this->expectException(DecryptException::class);
        
        $encrypter = new Encrypter(key: Key::createNewRandomKey());
        
        $encrypted = $encrypter->encrypt('lorem ipsum');
        
        $encrypter->decrypt('bad'.$encrypted);
    }
}