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
use Tobento\Service\Encryption\DecryptException;
use Tobento\Service\Encryption\EncrypterException;
use RuntimeException;

/**
 * DecryptExceptionTest
 */
class DecryptExceptionTest extends TestCase
{
    public function testDecryptException()
    {
        $e = new DecryptException(message: 'Message');
        
        $this->assertInstanceof(EncrypterException::class, $e);
        $this->assertSame('Message', $e->getMessage());
    }
}