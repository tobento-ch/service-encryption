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
 * KeyGeneratorInterface
 */
interface KeyGeneratorInterface
{
    /**
     * Returns a generated new key.
     *
     * @return string
     * @throws KeyException
     */
    public function generateKey(): string;
}