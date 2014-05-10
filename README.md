[![Build Status](https://travis-ci.org/OpenClassrooms/CacheBundle.svg?branch=master)](https://travis-ci.org/OpenClassrooms/CacheBundle)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/b04e23bf-8e36-4704-801e-bb29a7719ed3/mini.png)](https://insight.sensiolabs.com/projects/b04e23bf-8e36-4704-801e-bb29a7719ed3)

CacheBundle adds features to Doctrine Cache implementation
- Default lifetime
- Fetch with a namespace
- Save with a namespace
- Cache invalidation through namespace strategy
- CacheProvider Builder

See [OpenClassrooms/Cache](https://github.com/OpenClassrooms/Cache) for more details.

## Installation
The easiest way to install CacheBundle is via [composer](http://getcomposer.org/).

Create the following `composer.json` file and run the `php composer.phar install` command to install it.

```json
{
    "require": {
        "openclassrooms/cache-bundle": "*"
    }
}
```
## Configuration

## Usage
The configured cache is available as openclassrooms.cache.cache service:
```php
$cache = $container->get('openclassrooms.cache.cache');

$cache->fetch($id);
$cache->fetchWithNamespace($id, $namespaceId);
$cache->save($id, $data);
$cache->saveWithNamespace($id, $data, $namespaceId);
$cache->invalidate($namespaceId);

```

The configured cache provider is available as openclassrooms.cache.cache_provider service:
```php
$cacheProvider = $container->get('openclassrooms.cache.cache_provider');
```

The cache provider builder is available as openclassrooms.cache.cache_provider service:
```php
$builder = $container->get('openclassrooms.cache.cache_provider_builder');

// Redis
$cacheProvider = $builder
    ->create(CacheProviderType::REDIS)
    ->withHost('127.0.0.1')
    ->withPort(6379) // Default 6379
    ->withTimeout(0.0) // Default 0.0
    ->build();
```

See [OpenClassrooms/Cache](https://github.com/OpenClassrooms/Cache) for more details.


