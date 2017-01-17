<?php

use Orchestra\Testbench\TestCase;
use JFuentesTgn\OcrSpace\OcrAPI;

class OcrAPITest extends TestCase
{

    protected $api;
    protected $text;

    public function setUp()
    {
        parent::setUp();
        $this->api = $this->app->make('ocrspaceapi');
        //$this->api->setApiKey('PUT A REAL API KEY TO RUN TESTS AGAINST OCR.SPACE API SERVICE');
        $this->text = "BEIJING — Jing Yuechen, the \r\nfounder of an Internet start-up here \r\nin the Chinese capital, has no interest \r\nin overthrowing the Communist \r\nParty. But these days she finds herself \r\ncursing the nation's smothering \r\ncyberpolice as she tries — and fails \r\nto browse photo-sharing websites like \r\nFlickr and struggles to stay in touch \r\nnith the Facebook friends she has \r\nmade during trips to France, India \r\nand Singapore. \r\n";
    }

    protected function getPackageProviders($app)
    {
        return ['JFuentesTgn\OcrSpace\OcrServiceProvider'];
    }

    public function testIsInstance()
    {
        $api = new OcrAPI('KEY');
        $this->assertTrue($api instanceof OcrAPI);
        $this->assertEquals('KEY', $api->getApiKey());
    }

    public function testGetKey()
    {
        $this->assertEquals('YOUR-API-KEY', $this->api->getApiKey());
    }

    public function testParseGifImageFromFile()
    {
        $file = 'tests/resources/screenshot.gif';
        $resp = $this->api->parseImageFile($file);
        $this->assertTrue($this->isValidText($resp->item(0)->text()));
    }

    public function testParseJPEGImageFromFile()
    {
        $file = 'tests/resources/screenshot.jpg';
        $resp = $this->api->parseImageFile($file);
        $this->assertTrue($this->isValidText($resp->item(0)->text()));
    }

    public function testParsePNGImageFromFile()
    {
        $file = 'tests/resources/screenshot.png';
        $resp = $this->api->parseImageFile($file);
        $this->assertTrue($this->isValidText($resp->item(0)->text()));
    }

    public function testParsePDFImageFromFile()
    {
        $file = 'tests/resources/screenshot.pdf';
        $resp = $this->api->parseImageFile($file);
        $this->assertTrue($this->isValidText($resp->item(0)->text()));
    }

    public function testParseJPGImageFromUrl()
    {
        $url = 'http://dl.a9t9.com/blog/ocr-online/screenshot.jpg';
        $resp = $this->api->parseImageUrl($url);
        $this->assertTrue($this->isValidText($resp->item(0)->text()));
    }

    public function testParseJPGImageBinary()
    {
        $img = file_get_contents('tests/resources/screenshot.jpg');
        $resp = $this->api->parseImageBinary($img, 'image/jpeg');
        $this->assertTrue($this->isValidText($resp->item(0)->text()));
    }

    public function testParseJPGImageBase64()
    {
        $img = file_get_contents('tests/resources/screenshot.jpg');
        $resp = $this->api->parseImageBase64(base64_encode($img), 'image/jpeg');
        $this->assertTrue($this->isValidText($resp->item(0)->text()));
    }


    protected function isValidText($text)
    {
        return strpos($text, 'BEIJING') === 0;
    }
}
