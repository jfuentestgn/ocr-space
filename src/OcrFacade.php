<?php

namespace JFuentesTgn\OcrSpace;

use Illuminate\Support\Facades\Facade;

class OcrFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'ocrspaceapi';
    }
}
