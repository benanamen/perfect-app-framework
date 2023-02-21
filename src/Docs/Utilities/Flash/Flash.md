The `Flash` class provides a simple way to add and display one-time messages in a web application. These messages are stored in the session and can be displayed to the user on the next request.

To use the `Flash` class, you should start a session before adding messages. Here's an example:

```php
session_start();

use PerfectApp\Utilities\Flash;

// Add a success message
Flash::addMessage('Your account has been created successfully!');

// Add an error message
Flash::addMessage('There was an error processing your request', 'danger');
```

You can also retrieve and display the messages in your view using the `displayMessages()` method:

```php
use PerfectApp\Utilities\Flash;

// Display the messages
Flash::displayMessages();

```

This will display the messages as styled `div` elements with the appropriate CSS class based on the message type (default is `success`). You can customize the message display by modifying the HTML code in the `displayMessages()` method.

You can also retrieve the messages manually using the `getMessages()` method:

```php
use PerfectApp\Utilities\Flash;

// Retrieve the messages
$messages = (new Flash)->getMessages();

// Loop through the messages
foreach ($messages as $message) {
    echo "<div class='alert alert-{$message['type']}'>{$message['body']}</div>";
}

```

This will return an array of messages that you can loop through and display in your view.