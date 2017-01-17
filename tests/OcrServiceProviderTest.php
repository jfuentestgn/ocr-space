<?php

use Orchestra\Testbench\TestCase;
use JFuentesTgn\OcrSpace\OcrServiceProvider;

class OcrServiceProviderTest extends TestCase
{
    protected $service;

    public function setUp()
    {
        parent::setUp();
        $this->service = $this->app->make('ocrspaceapi');
    }

    protected function getPackageProviders($app)
    {
        return ['JFuentesTgn\OcrSpace\OcrServiceProvider'];
    }

    public function testIsService()
    {
        $this->assertTrue($this->service instanceof JFuentesTgn\OcrSpace\OcrAPI);
    }
}
