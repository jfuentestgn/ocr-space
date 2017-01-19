Laravel OCR.space API
=====================

[![Work in progress](https://img.shields.io/waffle/label/evancohen/smart-mirror/in%20progress.svg?style=plastic)]()
[![License: MIT](https://img.shields.io/packagist/l/doctrine/orm.svg?style=plastic)]()

Laravel (or just plain PHP) class for calling https://ocr.space/ [free API](https://ocr.space/ocrapi)

This package provides an independent implementation of an OCR.space API client for Laravel (or PHP) applications

OCR.API is a free/paid API for the OCR.space online service that converts images of text documents in text strings using OCR technologies

## Requirements

* PHP >= 5.6.4
* A valid key from [OCR API](https://ocr.space/ocrapi) (registration needed)

## Installation

To get OCR.space API just use the require command of composer or edit manually your composer.json, adding the require block (then you should run composer update):

```bash
$ composer require jfuentestgn/ocr-space
```

```json
{
    "require": {
        "jfuentestgn/ocr-space": "dev-master"
    }
}
```

After install the package, if you want to use it in a Laravel application, you should register the service provider. Add the OcrServiceProvider class to the list of providers in config/app.php:

```php
  'providers' => [
    ....
    JFuentesTgn\OcrSpace\OcrServiceProvider::class,
    ...
    ]
```

If you want to use the Facade version of the service, you could add an alias in `config/app.php`:

```php
  'aliases' => [
    ....
    'OCR' => JFuentesTgn\OcrSpace\OcrFacade::class, 
    ...
    ]
```

## Configuration

This package requires an API key to work. First of all, register in the [OCR API site](https://ocr.space/ocrapi) to get a valid KEY

Publish vendor assets to get a local copy of the config file:

```bash
$ php artisan vendor:publish --provider=JFuentesTgn\\OcrSpace\\OcrServiceProvider
```

This will create a `config/ocrspace.php` file in your app. Edit this file and update the API key configuration property


## Usage

In Laravel, you can use the OcrAPI class service as any other injected service. As an exemple:

```php

use JFuentesTgn\OcrSpace\OcrAPI;

class TestController extends Controller 
{

  public function processImage(Request $request, OcrAPI $ocr)
  {
    // You can use the $ocr instance to call OCR.space web service
    $response = $ocr->parseImageFile($imageFile);
  }
}
```

If you prefer to use the facade interface, you can do just this:

```php
  $response = OCR::parseImageFile($imageFile);
```

Laravel is not a requirement for this package. If you need to use it outside a Laravel app, you can just create an instance of the API as with any other class:

```php
  $ocr = new OcrAPI($apiKey);
  $response = $ocr->parseImageFile($imageFile);
```
In this case you MUST pass your API key as a parameter to the constructor

The response (`JFuentesTgn\OcrSpace\OcrResponse`) object returned by the OcrAPI methods maps [JSON response](https://ocr.space/ocrapi#Response) from OCR.space online service in an object oriented way.

This is an example of how to read the service response:
```php
$image = 'snap_005.jpg';
$response = $ocr->parseImageFile($image);
if ($response->length() == 1) {
  $text = $response->items(0)->text();
}
```


## Credits

This package is maintained by [Juan Fuentes](https://github.com/jfuentestgn)

OCR.space is a service of [a9t9 software GmbH](https://a9t9.com/about). They are also in [github](https://github.com/A9T9)

This package is an independent development that is in no way linked to a9t9 software. I want to acknowledge a9t9 for put this OCR service online

## License

Laravel OCR.space API is licensed under [The MIT License (MIT)](LICENSE).