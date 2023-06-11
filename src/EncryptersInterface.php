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
 * EncryptersInterface
 */
interface EncryptersInterface
{
    /**
     * Returns true if encrypter exists, otherwise false.
     *
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool;
    
    /**
     * Returns the encrypter if exists, otherwise null.
     *
     * @param string $name
     * @return null|EncrypterInterface
     */
    public function get(string $name): null|EncrypterInterface;
}