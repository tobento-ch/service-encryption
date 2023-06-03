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
use Tobento\Service\Encryption\EncrypterException;
use RuntimeException;

/**
 * EncrypterExceptionTest
 */
class EncrypterExceptionTest extends TestCase
{
    public function testEncrypterException()
    {
        $e = new EncrypterException(message: 'Message');
        
        $this->assertInstanceof(RuntimeException::class, $e);
        $this->assertSame('Message', $e->getMessage());
    }
}