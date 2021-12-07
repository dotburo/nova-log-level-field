# Nova Error Level Field

[![Packagist](https://img.shields.io/packagist/v/dotburo/nova-error-level-field.svg?style=flat-square)](https://packagist.org/packages/dotburo/nova-error-level-field)

Basic tool to display an error level badge in Laravel Nova.

## Features
* Follows the [PSR-3: Logger Interface](https://www.php-fig.org/psr/psr-3/) error levels
* Big or small badge
* Customizable badge colors
* Super tiny, no css or js files

## Installation
```
composer require dotburo/nova-error-level-field
```

## Usage
```php
// for example, in app/Nova/Post.php

use Dotburo\NovaErrorLevel\ErrorLevelField;
use Psr\Log\LogLevel;

// ...

public function fields(Request $request) {
    return [
        ErrorLevelField::make('Level')
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
