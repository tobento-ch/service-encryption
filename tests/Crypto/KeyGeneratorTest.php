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
use Tobento\Service\Encryption\Crypto\KeyGenerator;
use Tobento\Service\Encryption\KeyGeneratorInterface;

/**
 * KeyGeneratorTest
 */
class KeyGeneratorTest extends TestCase
{
    public function testThatImplementsKeyGeneratorInterface()
    {
        $this->assertInstanceof(
            KeyGeneratorInterface::class,
            new KeyGenerator()
        );
    }
    
    public function testGenerateKeyMethod()
    {
        $this->assertIsString((new KeyGenerator())->generateKey());
    }
}