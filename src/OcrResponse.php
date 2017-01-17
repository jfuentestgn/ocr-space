<?php

namespace JFuentesTgn\OcrSpace;

class OcrResponse
{

    protected $ocrResponseItem = null;
    protected $parsedResults = [];
    protected $errorMessage = null;
    protected $errorDetails = null;
    protected $processingTime = null;

    public function __construct($jsonResponse)
    {
        $this->jsonResponse = $jsonResponse;
        $this->parseResponse();
    }

    protected function parseResponse()
    {
        $this->parsedResults = $this->jsonResponse->ParsedResults;
        $this->ocrExitCode = $this->jsonResponse->OCRExitCode;
        $this->errorMessage = $this->jsonResponse->ErrorMessage;
        $this->errorDetails = $this->jsonResponse->ErrorDetails;
        $this->processingTime = $this->jsonResponse->ProcessingTimeInMilliseconds;
    }


    public function length()
    {
        if ($this->parsedResults == null) {
            return 0;
        }
        return count($this->parsedResults);
    }

    public function item($i)
    {
        if ($this->parsedResults == null || $i >= count($this->parsedResults)) {
            return null;
        }
        return new OcrResultItem($this->parsedResults[$i]);
    }

    public function exitCode()
    {
        return $this->ocrExitCode;
    }

    public function errorMessage()
    {
        return $this->errorMessage;
    }

    public function errorDetails()
    {
        return $this->errorDetails;
    }

    public function processingTime()
    {
        return $this->processingTime;
    }


    public function __toString()
    {
        return 'OCR.space Response: (JSON)' . json_encode($this->jsonResponse);
    }
}
