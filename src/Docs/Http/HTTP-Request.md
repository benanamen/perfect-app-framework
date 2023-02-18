# Request class

The `Request` class provides an easy way to access request data such as GET and POST parameters.

## Usage

To use the `Request` class, you first need to create an instance of the class by passing in the request data as an array. 

Here's an example:

```php
$requestData = array_merge($_GET, $_POST);
$request = new Request($requestData);
```

In this example, we use the `array_merge()` function to combine the `$_GET` and `$_POST` superglobal arrays into a single array `$requestData`. We then pass this array to the `Request` constructor to create a new `Request` object `$request`.

Once you have created a `Request` object, you can use the `get()` method to retrieve a specific request parameter. For example, to retrieve the value of a parameter with the name `foo`, you would call the `get()` method with the string `'foo'` as an argument:

```php
$value = $request->get('foo');
```

If the `foo` parameter exists in the request data, its value will be returned. If it does not exist, the `get()` method will return `null`.

You can also use the `has()` method to check whether a specific parameter exists in the request data. For example:

```php
if ($request->has('foo')) {
    // Do something if the 'foo' parameter exists
} else {
    // Do something else if the 'foo' parameter does not exist
}
```

The `has()` method returns `true` if the specified parameter exists in the request data, and `false` otherwise.

## Example

Here's an example of how you could use the `Request` class to retrieve and process a form submission:

```php
// Check if the form has been submitted
if ($request->has('submit')) {
    // Retrieve the form data
    $name = $request->get('name');
    $email = $request->get('email');
    $message = $request->get('message');

    // Do something with the form data
    // ...
}
```

In this example, we first check whether the form has been submitted by checking whether the `submit` parameter exists in the request data.
If it does, we retrieve the values of the `name`, `email`, and `message` parameters using the `get()` method, and then process the form data in some way.