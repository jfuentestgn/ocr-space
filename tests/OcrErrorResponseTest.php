<?php

use Orchestra\Testbench\TestCase;
use JFuentesTgn\OcrSpace\OcrResponse;

class OcrErrorResponseTest extends TestCase
{

    protected $response;

    public function setUp()
    {
        parent::setUp();

        $content = '{"ParsedResults":null,"OCRExitCode":3,"IsErroredOnProcessing":true,"ErrorMessage":"File failed validation. The base64 file is invalid.","ErrorDetails":"File failed validation. The base64 file is invalid.","ProcessingTimeInMilliseconds":"7"}';
      
        $this->response = new OcrResponse(json_decode($content));
    }

    public function testOCRExitCode()
    {
        $this->assertEquals($this->response->exitCode(), 3);
    }

    public function testNrItems()
    {
        $this->assertEquals($this->response->length(), 0);
    }

    public function testItemNull()
    {
        $this->assertEquals(null, $this->response->item(0));
    }

    public function testErrorMessage()
    {
        $this->assertEquals('File failed validation. The base64 file is invalid.', $this->response->errorMessage());
    }

    public function testErrorDetails()
    {
        $this->assertEquals('File failed validation. The base64 file is invalid.', $this->response->errorDetails());
    }

    public function testProcessingTime()
    {
        $this->assertEquals(7, $this->response->processingTime());
    }
}
