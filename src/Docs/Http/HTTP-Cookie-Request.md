# Cookie Class

The `Cookie` class provides a convenient way to work with cookies in PHP.

## Usage

First, create an instance of the `Cookie` class:

```php
use PerfectApp\Http\Cookie;

// Instantiate the Cookie class without any arguments
$cookie = new Cookie([]);
```

To get a cookie value by key, use the `get` method:

```php
$value = $cookie->get('key');
```

To set a cookie value, use the `set` method:

```php
$cookie->set('key', 'value', $expire = 0, $path = '/', $domain = '', $secure = false, $httponly = false);
```

To delete a cookie, use the `delete` method:

```php
$cookie->delete('key', $path = '/', $domain = '');
```

## Example

```php
use PerfectApp\Http\Cookie;

// Instantiate the Cookie class with the $_COOKIE superglobal
$cookie = new Cookie([]);

// Get a cookie value
$value = $cookie->get('cookie_name');

// Set a cookie value
$cookie->set('cookie_name', 'cookie_value');

// Delete a cookie
$cookie->delete('cookie_name');

```