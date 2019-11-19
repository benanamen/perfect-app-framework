To use Debug add the following to global config

```php
//----------------------------------------------------------------------------------------
// Debugging
//----------------------------------------------------------------------------------------

define('DEBUG', true); // Toggle Debugging
define('SHOW_DEBUG_PARAMS', true); // Display Sql & Sql Parameters
define('SHOW_SESSION_DATA', true); // Display Session Data
define('SHOW_POST_DATA', true); // Display Post Data
define('SHOW_GET_DATA', true); // Display Get Data
define('SHOW_COOKIE_DATA', false); // Display Cookie Data
define('SHOW_REQUEST_DATA', false); // Display Request Data

if (DEBUG)
{
    $var = [
          'POST' => [SHOW_POST_DATA => $_POST]
        , 'GET' => [SHOW_GET_DATA => $_GET]
        , 'COOKIE' => [SHOW_COOKIE_DATA => $_COOKIE]
        , 'REQUEST' => [SHOW_REQUEST_DATA => $_REQUEST]
        , 'SESSION' => [SHOW_SESSION_DATA => $_SESSION]];

    $varDumper = new HTMLVarDumper;
    ShowDebugData::displayDebugData($varDumper, $var);
}
```