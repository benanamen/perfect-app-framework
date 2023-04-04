# CS Fixer

```shell
tools/php-cs-fixer/vendor/bin/php-cs-fixer fix src
```

# PHP Stan

```shell
vendor/bin/phpstan analyse  -l 6 src
```

```shell
vendor/bin/phpstan analyse -l 9 tests
```

# Codeception

```bash
php vendor/bin/codecept run
```

```bash
php vendor/bin/codecept run --html
```


```bash
php vendor/bin/codecept run tests/Unit/Flash/FlashTest.php

```

```bash
php vendor/bin/codecept run tests/Unit/Http/SessionTest.php

```

```bash
php vendor/bin/codecept run tests/Unit/Database/ConnectionTest.php
```

```bash
php vendor/bin/codecept run tests/Unit/Form/ValidateFormRequiredWhitelistTest.php
```

# Coverage Test with Html Report

``` bash
php vendor/bin/codecept run --coverage --coverage-html 
```