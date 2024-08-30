# Laravel CRUD Generator Package

This package provides  to generate CRUD operations for models in 
Laravel application. 
It automatically creates a controller, 
model, request validation, 
migration, and API routes for  model.

## Requirements

- Laravel 11+
- PHP 8.2+

## Installation

### 1. Install the Package

Add the package to your Laravel application using Composer.

#### Option A: Install from Local Path

1. Modify your `composer.json` to include the package from a local directory:

   ```json
   {
       "repositories": [
            {
            "type": "path",
            "url": "packages/jatri/crudGenerator"
        }
       ],
       "require": {
           "jatri/crud-generator": "*"
       }
   }


Run the composer command to install this package
```bash 
composer require jatri/crud-generator
```

Register the Service Provider to config/app.php
```
'providers' => [
    // ........
    Jatri\CrudGenerator\CrudGeneratorServiceProvider::class,
],
```

Run the following Artisan command to publish them

```bash
  php artisan vendor:publish --provider="Jatri\CrudGenerator\CrudGeneratorServiceProvider"

```

Run the migration

```bash
php artisan migrate
```

## Usage

To use the Laravel CRUD Generator package, follow these steps:

### Generating CRUD Operations

To generate CRUD operations for a model, use the Artisan command provided by the package. Replace `ModelName` with the name of your model.

```bash
php artisan crud:generate ModelName
