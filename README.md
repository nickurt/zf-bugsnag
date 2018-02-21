## Bugsnag Notifier for Zend Framework 2.3 and 3.0
### Bugsnag?
The Bugsnag Notifier for Zend Framework 2.3 and 3.0 gives you instant notifications of the errors in your application. You can create a free plan/account on the [bugsnag](https://bugsnag.com) website.
### Install
#### Installation with the composer
```sh
php composer.phar require nickurt/zf-bugsnag:1.*
```

### Requirements

* PHP5.5+
* [Zend Framework 2.3](https://github.com/zendframework/zf2) or [Zend Framework 3.0](https://github.com/zendframework/zendframework)
* [Bugsnag PHP-API](https://github.com/bugsnag/bugsnag-php)

### Post Installation

Enable it in your `application.config.php` (or `modules.config.php`) file
```php
<?php

// application.config.php
return array(
    'modules' => array(
        'ZfBugsnag', // Must be added as the first module
        // ...
    ),
    // ...
);

// modules.config.php
return [
    'ZfBugsnag', // Must be added as the first module

    // ...
];


```
### Configuration

Copy the `config/zfbugsnag.local.php` file to your `config/autoload` folder and change the settings (IsEnabled/ApiKey)