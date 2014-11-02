## Bugsnag Notifier for Zend Framework 2
### Bugsnag?
The Bugsnag Notifier for Zend Framework 2 gives you instant notifications of the errors in your application. You can create a free plan/account on the [bugsnag](https://bugsnag.com) website.
### Install
#### Installation with the composer
```sh
php composer.phar require nickurt/zf-bugsnag:dev-master
```

### Requirements

* PHP5.5+
* [Zend Framework 2.3.*](https://github.com/zendframework/zf2)
* [Bugsnag PHP-API](https://github.com/bugsnag/bugsnag-php)

### Post Installation

Enable it in your `application.config.php` file
```php
<?php
return array(
    'modules' => array(
        'ZfBugsnag', // Must be added as the first module
        // ...
    ),
    // ...
);
```
### Configuration

Copy the `config/zfbugsnag.local.php` file to your `config/autoload` folder and change the settings (IsEnabled/ApiKey)