# Class: PostRequest

## Represents a HTTP POST request

### Usage

```php
use PerfectApp\Http\PostRequest;

// Instantiate the class with an array of POST data
$postData = $_POST; // or some other array of post data
$postRequest = new PostRequest($postData);

// Get the value of a POST parameter
$value = $postRequest->get('param_name');

// Check if a POST parameter exists
$exists = $postRequest->has('param_name');
```

### Methods

`__construct(array $postData)`

Creates a new PostRequest instance with the given post data array.

Parameters:
`$postData` (array): The post data array.

`get(string $key): mixed`

Gets the value of a POST parameter.

Parameters:
        `$key` (string): The name of the POST parameter to get.
    Returns:
        mixed: The value of the POST parameter if it exists, or null otherwise.

`has(string $key): bool`

Checks if a POST parameter exists.

Parameters:
        `$key` (string): The name of the POST parameter to check.
    Returns:
        bool: `true` if the POST parameter exists, or `false` otherwise.