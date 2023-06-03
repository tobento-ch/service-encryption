# Encryption Service

Encryption interfaces for PHP applications using [Crypto](https://github.com/defuse/php-encryption) as default implementation.

## Table of Contents

- [Getting started](#getting-started)
    - [Requirements](#requirements)
    - [Highlights](#highlights)
- [Documentation](#documentation)
    - [Basic Usage](#basic-usage)
        - [Encrypt And Decrypt](#encrypt-and-decrypt)
    - [Interfaces](#interfaces)
        - [Encrypter Factory Interface](#encrypter-factory-interface)
        - [Encrypter Interface](#encrypter-interface)
        - [Key Generator Interface](#key-generator-interface)
    - [Crypto Implementation](#crypto-implementation)
- [Credits](#credits)
___

# Getting started

Add the latest version of the encryption service project running this command.

```
composer require tobento/service-encryption
```

## Requirements

- PHP 8.0 or greater

## Highlights

- Framework-agnostic, will work with any project
- Decoupled design

# Documentation

## Basic Usage

### Encrypt And Decrypt

```php
use Tobento\Service\Encryption\EncrypterInterface;

class SomeService
{
    public function __construct(
        private EncrypterInterface $encrypter,
    ) {
        $encrypted = $encrypter->encrypt('something');
        
        $decrypted = $encrypter->decrypt($encrypted);
    }
}
```

## Interfaces

### Encrypter Factory Interface

You may use the encrypter factory interface for creating encrypters.

```php
namespace Tobento\Service\Encryption;

interface EncrypterFactoryInterface
{
    /**
     * Create a new Encrypter.
     *
     * @param string $key
     * @return EncrypterInterface
     * @throws EncrypterException
     */
    public function createEncrypter(string $key): EncrypterInterface;
}
```

### Encrypter Interface

```php
namespace Tobento\Service\Encryption;

interface EncrypterInterface
{
    /**
     * Returns the encrypted data.
     *
     * @param mixed $data
     * @return string
     * @throws EncryptException
     */
    public function encrypt(mixed $data): string;
    
    /**
     * Returns the decrypted data.
     *
     * @param string $encrypted
     * @return mixed
     * @throws DecryptException
     */
    public function decrypt(string $encrypted): mixed;
}
```

### Key Generator Interface

You may use the key generator interface for generating keys.

```php
namespace Tobento\Service\Encryption;

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
```

## Crypto Implementation

You may check out the [Crypto](https://github.com/defuse/php-encryption) to learn more about it.

**Usage**

```php
use Tobento\Service\Encryption\Crypto\KeyGenerator;
use Tobento\Service\Encryption\Crypto\EncrypterFactory;
use Tobento\Service\Encryption\KeyGeneratorInterface;
use Tobento\Service\Encryption\EncrypterFactoryInterface;
use Tobento\Service\Encryption\EncrypterInterface;

$keyGenerator = new KeyGenerator();

var_dump($keyGenerator instanceof KeyGeneratorInterface);
// bool(true)

// Generate a key and store it savely for reusage.
$key = $keyGenerator->generateKey();

$encrypterFactory = new EncrypterFactory();

var_dump($encrypterFactory instanceof EncrypterFactoryInterface);
// bool(true)

$encrypter = $encrypterFactory->createEncrypter(key: $key);

var_dump($encrypter instanceof EncrypterInterface);
// bool(true)
```

# Credits

- [Tobias Strub](https://www.tobento.ch)
- [All Contributors](../../contributors)
- [Crypto](https://github.com/defuse/php-encryption)