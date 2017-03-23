# Serviceman

***"Because Your Laravel App Needs Special Services!"***

Package for implementing **SOA** (Service Oriented Architecture) pattern in **Laravel 5.4.*** which adds more organized folder structure to [joselfonseca/laravel-tactician](https://github.com/joselfonseca/laravel-tactician) package. The folder structure can be configured through the **config/serviceman.php** file.

## Installation

Set `minimum-stability` to `dev` in the `composer.json` file
```json
    "minimum-stability": "dev"
```

To install this update your `composer.json` file to require
```json
    "require": {
        "munza/serviceman" : "0.9.*"
    }
```
Or run `composer require munza/serviceman` from the command line.

Once the dependencies have been downloaded, add the service provider to your `config/app.php` file
```php
    'providers' => [
        ...
        Munza\Serviceman\ServicemanServiceProvider::class,
        ...
    ]
```

Publish the configuration file.
Create a new command class (with handler);
```bash
    php artisan vendor:publish
```

## Usage

Create a new service class:
```bash
    php artisan make:service User
```

Create a new command class (with handler):
```bash
    php artisan make:service:command Register User
```

Create a new command class (without handler):
```bash
    php artisan make:service:command Register User --no-handler
```

Create a new handler class:
```bash
    php artisan make:service:handler RegisterHandler Register User
```

Create a new middleware class:
```bash
    php artisan make:service:middleware RegisterValidator User
```

## Configuration

Edit `config/serviceman.php` for generator configuration.
```php
    ...
    'generator'  => [
        'basePath' => app_path(),
        'paths' => [
            'service'    => 'Services',
            'command'    => 'Services\\{{ service }}',
            'handler'    => 'Services\\{{ service }}',
            'middleware' => 'Services\\{{ service }}',
        ],
    ],
    ...
```

`{{ service }}` will be replaced with name of the service. For example if following command is used -
```bash
    php artisan make:service:command Register User
```
Then, `app/Services/User/Register.php` file will be generated, where `User` is the name of the service that has replaced `{{ service }}`.

## Example

Please check [joselfonseca/laravel-tactician](https://github.com/joselfonseca/laravel-tactician) packge for more information.
Also check [https://gist.github.com/joselfonseca/24ee0e96666a06b16f92](https://gist.github.com/joselfonseca/24ee0e96666a06b16f92) for a working example.

## Issues

If you discover any issues, please open an issue using the issue tracker. But take a look at the previous issues before creating a new one to avoid duplication.

## License

The MIT License (MIT). Please see [License](LICENSE) for more information.
