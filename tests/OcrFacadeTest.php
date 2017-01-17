<?php

use Orchestra\Testbench\TestCase;
use JFuentesTgn\OcrSpace\OcrFacade;

class OcrFacadeTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return ['JFuentesTgn\OcrSpace\OcrServiceProvider'];
    }

    public function testValidFacade()
    {
        $this->assertEquals('YOUR-API-KEY', OcrFacade::getApiKey());
    }
}
