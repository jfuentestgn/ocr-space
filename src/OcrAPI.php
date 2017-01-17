<?php

namespace JFuentesTgn\OcrSpace;

use GuzzleHttp\Client as HttpClient;

class OcrAPI
{
    private $key;
    private $url;
    
    public function __construct($apiKey, $url = '')
    {
        $this->key = $apiKey;
        $this->url = $url;
    }

    public function getApiKey()
    {
        return $this->key;
    }

    public function setApiKey($apiKey)
    {
        $this->key = $apiKey;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function parseImageFile($imgFile, $options = [])
    {
        return $this->parseImage('file', fopen($imgFile, 'r'), $options);
    }

    public function parseImageUrl($imgUrl, $options = [])
    {
        return $this->parseImage('url', $imgUrl, $options);
    }

    public function parseImageBinary($imgBinary, $mimeType, $options = [])
    {
        return $this->parseImageBase64(base64_encode($imgBinary), $mimeType, $options);
    }

    public function parseImageBase64($imgBase64, $mimeType, $options = [])
    {
        return $this->parseImage('base64Image', 'data:' . $mimeType . ';base64,' . $imgBase64, $options);
    }

    protected function parseImage($fldName, $fldValue, $options = [])
    {
        $client = new HttpClient();

        $lang = isset($options['lang']) ? $options['lang'] : 'eng';
        $headers = [ 'apikey' => $this->key ];
        $multipart = [
                [ 'name' => 'language', 'contents' => 'eng' ],
                [ 'name' => $fldName, 'contents' => $fldValue ]
            ];

        $url = $this->url == '' ? 'https://api.ocr.space/parse/image' : $this->url;
        try {
            $response = $client->request('POST', $url, ['headers' => $headers, 'multipart' => $multipart]);
        } catch (\Exception $e) {
            throw new OcrException('Error connecting to service URL: ' . $url, 0, $e);
        }

        $code = $response->getStatusCode();
        if ($code != 200) {
            throw new OcrException('HTTP error returned from service URL: ' . $url, $code);
        }
        $body = $response->getBody();
        return new OcrResponse(json_decode($body));
    }
}
