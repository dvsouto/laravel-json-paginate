# Laravel Json Paginate

In vanilla Laravel application exists the method `paginate` in Query Builder (https://laravel.com/docs/5.8/pagination#paginating-eloquent-results), that returns the results formated to front pagination.

This package adds a `jsonPaginate` method to the Eloquent query builder that listens the results in json format to use in API and show data in others applications.

## Installation

You can install the package via composer:

```bash
composer require dvsouto/laravel-json-paginate
```

In Laravel 5.5 and above the service provider will automatically get registered. In older versions of the framework just add the service provider in `config/app.php` file:

```php
'providers' => [
    ...
    Bitnary\JsonPaginate\JsonPaginateServiceProvider:class,
];
```

In Lumen you need to load de service provider on `bootstrap/app.php` file:
```php
    ...
    $app->register(App\Providers\JsonPaginateServiceProvider::class); // JsonPaginate para o Eloquent
```

## Usage 

To paginate the results according to the json API spec, simply call the `jsonPaginate` method.

```php
YourModel::jsonPaginate();
```

Of course you may still use all the builder methods you know:

```php
YourModel::where('my_field', 'myValue')->jsonPaginate();
```

By default the maximum page size is set to 100. You can change this number passing the value to  `jsonPaginate`.

```php
$maxResults = 10;

YourModel::jsonPaginate($maxResults);
```

This return an array containing thats parameters:
```json
{
    "data": [
        {
            "id": 1,
            "name": "Davi Souto"
        },
        {
            "id": 2,
            "name": "Lorem Ipsum"
        },
        {
            "id": 3,
            "name": "Sit Amet"
        },
        ...
    ],
    "paginator": {
        "current_page": 1, // (int) Current page number
        "prev_page": 1, // (int) Previous page number
        "next_page": 2, // (int) Next page number
        "first_page": 1, // (int) The first page (always 1),
        "is_first_page": true, // (boolean) Is in first page ?
        "last_page": 25, // (int) Last page number 
        "is_last_page": false, // (boolean) Is in last page ?
        "page_keys": [ // (array) Contains the list of pages to display in front
            1,
            2,
            3,
            4,
        ],
        "from_item": 1, // (int) Results for this page starts from this item
        "to_item": 100, // (int) Results for this page ends in this item
        "total_items": 100, // (int) Total of existent itens 
        "per_page": 10, // (int) Results for this page ends in this item
        "display_items": // (int) Total of itens in this page
    }
}
```

## Security

If you discover any security related issues, please email davi.souto@gmail.com instead of using the issue tracker.

## Credits

- [Spatie Laravel Json Api Paginate](https://github.com/spatie/laravel-json-api-paginate)
- [All Contributors](../../contributors)


## License

The MIT License (MIT). Please see [License File](LICENCE.md) for more information.
