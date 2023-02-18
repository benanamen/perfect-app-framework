# GetRequest

The `GetRequest` class provides a convenient way to access GET request parameters in PHP.

## Usage

Create a new instance of the `GetRequest` class and pass in an array of GET data:

```php
$get = new GetRequest($_GET);
```

You can then use the `get` method to retrieve a specific GET parameter by name:

```php
$value = $get->get('paramName');
```

If the specified parameter does not exist, `get` will return `null`.

You can also use the `has` method to check if a parameter exists:

```php
if ($get->has('paramName')) {
    // Do something
}
```

## Constructor

`__construct(array $data)`

The constructor takes an array of GET data as its parameter.

## Methods

`get(string $name): ?string`

Returns the value of the specified GET parameter, or `null` if it does not exist.

`has(string $name): bool`

Returns `true` if the specified GET parameter exists, `false` otherwise.