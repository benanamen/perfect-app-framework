To use Debug add the following to global config

```php
//----------------------------------------------------------------------------------------
// Debugging
//----------------------------------------------------------------------------------------

define("DEBUG", true); // Toggle Debugging
define("SHOW_DEBUG_PARAMS", DEBUG); // Display Sql & Sql Parameters
define("SHOW_SESSION_DATA", DEBUG); // Display Session Data
define("SHOW_POST_DATA", DEBUG); // Display Post Data
define("SHOW_GET_DATA", DEBUG); // Display Get Data
define("SHOW_COOKIE_DATA", DEBUG); // Display Cookie Data
define("SHOW_REQUEST_DATA", false); // Display Request Data

SHOW_POST_DATA ?  $var['POST'] = $_POST : false;
SHOW_GET_DATA  ? $var['GET'] =  $_GET  : false;
SHOW_COOKIE_DATA ?  $var['COOKIE'] = $_COOKIE : false;
SHOW_REQUEST_DATA ? $var['REQUEST'] = $_REQUEST : false;
SHOW_SESSION_DATA && !empty($_SESSION) ?  $var['SESSION'] = $_SESSION : false;

if (DEBUG)
{
    $varDumper = new HTMLVarDumper;
    ShowDebugData::displayDebugData($varDumper, $var);
}
```