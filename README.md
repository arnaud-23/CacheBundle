[![Build Status](https://travis-ci.org/OpenClassrooms/CacheBundle.svg?branch=master)](https://travis-ci.org/OpenClassrooms/CacheBundle)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/b04e23bf-8e36-4704-801e-bb29a7719ed3/mini.png)](https://insight.sensiolabs.com/projects/b04e23bf-8e36-4704-801e-bb29a7719ed3)

CacheBundle adds features to Doctrine Cache implementation
- Default lifetime
- Fetch with a namespace
- Save with a namespace
- Cache invalidation through namespace strategy
- CacheProvider Builder

See [Cache](https://github.com/OpenClassrooms/Cache) for more details.

## Installation
The easiest way to install Cache is via [composer](http://getcomposer.org/).

Create the following `composer.json` file and run the `php composer.phar install` command to install it.

```json
{
    "require": {
        "openclassrooms/cache-bundle": "*"
    }
}
```
```php
<?php
require 'vendor/autoload.php';

use OpenClassrooms\Cache\Cache\Cache;

//do things
```
<a name="install-nocomposer"/>
