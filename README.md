## ZfBugsnag
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
        // ...
        'ZfBugsnag',
    ),
    // ...
);