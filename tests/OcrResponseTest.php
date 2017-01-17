<?php

use Orchestra\Testbench\TestCase;
use JFuentesTgn\OcrSpace\OcrResponse;

class OcrResponseTest extends TestCase
{

    protected $response;

    public function setUp()
    {
        parent::setUp();

        $content = '{"ParsedResults":[{"TextOverlay":{"Lines":[],"HasOverlay":false,"Message":"Text overlay is not provided as it is not requested"},"FileParseExitCode":1,"ParsedText":"This is the text","ErrorMessage":"","ErrorDetails":""}],"OCRExitCode":1,"IsErroredOnProcessing":false,"ErrorMessage":"Error message","ErrorDetails":"Error details","ProcessingTimeInMilliseconds":"444"}';
      
        $this->response = new OcrResponse(json_decode($content));
    }

    public function testOCRExitCode()
    {
        $this->assertEquals($this->response->exitCode(), 1);
    }

    public function testNrItems()
    {
        $this->assertEquals($this->response->length(), 1);
    }

    public function testText()
    {
        $this->assertEquals('This is the text', $this->response->item(0)->text());
    }

    public function testErrorMessage()
    {
        $this->assertEquals('Error message', $this->response->errorMessage());
    }

    public function testErrorDetails()
    {
        $this->assertEquals('Error details', $this->response->errorDetails());
    }

    public function testProcessingTime()
    {
        $this->assertEquals(444, $this->response->processingTime());
    }
}
