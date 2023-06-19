
# Laravel elastic

This package will add an easy integration of elasticsearch into laravel. With the ability to index multiple models into one index.



## Installation


```bash
composer require swisnl/laravel-elastic
```
```bash
php artisan laravel-elastic:install
```
Now there will be an `elastic.php` available to configure your elastic instance in.

## Features

The follow commands are available for indexing, deleting the index or refreshing the index:

```bash
php artisan elastic:create-index

php artisan elastic:delete-index

php artisan elastic:refresh-index
```

## Usage
Add the syncsWithIndex trait to any of you're models. Make sure to add the model in the models section of `config.php`
Implement the `IndexableInterface` to your model and implement the method stubs. Now on the giving condition laravel will keep your model in sync with the index in elasticsearch


