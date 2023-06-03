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
use Tobento\Service\Encryption\KeyException;
use RuntimeException;

/**
 * KeyExceptionTest
 */
class KeyExceptionTest extends TestCase
{
    public function testKeyException()
    {
        $e = new KeyException(message: 'Message');
        
        $this->assertInstanceof(RuntimeException::class, $e);
        $this->assertSame('Message', $e->getMessage());
    }
}