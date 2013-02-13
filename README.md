KitpagesMobileAppBuilderBundle
==============================

This bundle is used to generate specific plateform packages (android, iOS, phonegap,
firefoxOS,...) from a given common Html/JS code base

## Versions




## Actual state

This bundle is early alpha state.

## Installation

Add KitpagesMobileAppBuilderBundle in your composer.json

```js
{
    "require": {
        "kitpages/mobile-app-builder-bundle": "*"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update kitpages/mobile-app-builder-bundle
```

AppKernel.php

``` php
$bundles = array(
    ...
    new Kitpages\MobileAppBuilderBundle\KitpagesMobileAppBuilderBundle(),
);
```


