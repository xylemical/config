# Configuration framework

Provides a framework for configuration.

## Install

The recommended way to install this library is [through composer](http://getcomposer.org).

```sh
composer require xylemical/config
```

## Usage

```php

use Xylemical\Config\ConfigBuilder;

$source = ...; // A source defined by \Xylemical\Config\Source\SourceInterface.
$builder = new ConfigBuilder($source);
$configFactory = $builder->getFactory();

```

## License

MIT, see LICENSE.
