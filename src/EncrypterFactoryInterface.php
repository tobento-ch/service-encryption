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
 * EncrypterFactoryInterface
 */
interface EncrypterFactoryInterface
{
    /**
     * Create a new Encrypter.
     *
     * @param string $name
     * @param array $config
     * @return EncrypterInterface
     * @throws EncrypterException
     */
    public function createEncrypter(string $name, array $config): EncrypterInterface;
}