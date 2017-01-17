<?php

/*
 * This file is part of Ocr.Space Client
 *
 * (c) Juan Fuentes <jfuentestgna@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | API Key
    |--------------------------------------------------------------------------
    | Here you must specify your API key
    | 
    | You must ask for an API key to use this OCR API. Please visit
    | https://ocr.space/ocrapi to register and get your API key
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'apiKey' => 'YOUR-API-KEY',

    /*
    |--------------------------------------------------------------------------
    | OCR.SPACE API SERVICE URL
    |--------------------------------------------------------------------------
    | Specify service URL
    | 
    | By default, current URL is defined. If your some reason this URL changes
    | in the future, just modify the value of this property and everything
    | will work again
    |
    */
    
    'url' => 'https://api.ocr.space/parse/image'

];
