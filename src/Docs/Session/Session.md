The `Session` class is a simple PHP class that provides an easy-to-use interface for working with sessions. This class
provides the following methods:

`get($key)`

This method allows you to retrieve a value from the session using a key. If the key does not exist in the
session, `null` will be returned.

**Parameters**

-   `$key` - The key of the session value to retrieve.

**Return value**

-   Returns the session value associated with the given key or `null` if the key does not exist.

`set($key, $value)`

This method allows you to set a value in the session using a key.

**Parameters**

-   `$key` - The key of the session value to set.
-   `$value` - The value to set in the session.

**Return value**

This method does not return any value.

`delete($key)`

This method allows you to delete a value from the session using a key.
Parameters

-   `$key` - The key of the session value to delete.

**Return value**

This method does not return any value.

`start()`

This method starts a session if it has not been started already.

**Parameters**

-   This method does not take any parameters.

**Return value**

-   This method does not return any value.

### Example Usage

```php

// Start the session
$session = new PerfectApp\Session;
$session->start();

// Set a value in the session
$session->set('key', 'value');

// Get a value from the session
echo $session->get('key');
var_dump($_SESSION);

// Delete a value from the session
echo $session->delete('key');
var_dump($_SESSION);
```
