# Nova Log Level Field

[![Packagist](https://img.shields.io/packagist/v/dotburo/nova-log-level-field.svg?style=flat-square)](https://packagist.org/packages/dotburo/nova-log-level-field)
[![Downloads](https://img.shields.io/packagist/dt/dotburo/nova-log-level-field?style=flat-square)](https://packagist.org/packages/dotburo/nova-log-level-field)

A Laravel Nova field to display an error/log level badge on index and detail views of models.

## Features
* Follows the [PSR-3: Logger Interface](https://www.php-fig.org/psr/psr-3/) log levels
* Big or small badge
* Customizable badge colors
* Super tiny, no css or js files

## Installation
```
composer require dotburo/nova-log-level-field
```

## Usage
The package expects the value of the field to be one of [PSR-3 log level](https://www.php-fig.org/psr/psr-3/): 
**emergency**, **alert**, **critical**, **error**, **warning**, **notice**, **info** or **debug**.
```php
// for example, in app/Nova/Post.php

use Dotburo\NovaLogLevel\LogLevelField;
use Psr\Log\LogLevel;

// ...

public function fields(Request $request) {
    return [
        LogLevelField::make('Level')
            // Optional, show a small badge
            ->small()
            // Optional, override one or more default colors
            ->colors([
                LogLevel::EMERGENCY => '#000000',
            ])
    ];
}
```

## License
The MIT License (MIT). Please see the [license file](LICENSE) for more information.
