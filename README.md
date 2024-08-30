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
               "url": "packages/jatri/crud-generator"
           }
       ],
       "require": {
           "jatri/crud-generator": "*"
       }
   }


## Usage

To use the Laravel CRUD Generator package, follow these steps:

### Generating CRUD Operations

To generate CRUD operations for a model, use the Artisan command provided by the package. Replace `ModelName` with the name of your model.

```bash
php artisan crud:generate ModelName
