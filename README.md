### Installation

PHP 7.2 and Laravel 6.x or higher are required.

```shell script
composer require ronanflavio/artisan-make-extension
```

After updating `composer`, add the service provider to the `providers` array in `config/app.php`

```
Ronanflavio\ArtisanMakeExtension\ArtisanMakeExtensionServiceProvider::class,
```

### Available make commands

#### Data Transfer Objects

It is a layer used to carries data between the processes using a default object.

To create your own, use the command bellow:

```shell script
php artisan make:dto Example/CreatingExampleDto
```

The command above will create the directory `DataTransferObjects` inside your `app` folder.
In this directory will be placed the abstract class `DataTransferObject.php` which is used
as extension from all DTOs' classes generated with the `make:dto` command.

The actual class `CreatingExampleDto` will be placed within the directory `Example` inside
the `DataTransferObjects` folder, because of the slash separating the class of its namespace
and directory.

#### Services

A layer used to manage the business rules and concentrate the logical stuffs.

To create your own, use the command bellow:

```shell script
php artisan make:service Example/ExampleService
```

The command above will create the directory `Services` inside your `app` folder.
In this directory will be placed the abstract class `Service.php` which is used
as extension from all services' classes generated with the `make:service` command.

The actual class `ExampleService` will be placed within the directory `Example` inside
the `Services` folder, because of the slash separating the class of its namespace
and directory.

### License

The Artisan Make Extension is free software licensed under the MIT license.
