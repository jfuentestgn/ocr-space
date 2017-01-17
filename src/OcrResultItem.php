<?php

namespace JFuentesTgn\OcrSpace;

class OcrResultItem
{
    protected $item;
    protected $exitCode;
    protected $errorMessage;
    protected $errorDetails;

    public function __construct($item)
    {
        $this->item = $item;
        $this->parseItem();
    }

    protected function parseItem()
    {
        $this->exitCode = $this->item->FileParseExitCode;
        $this->text = $this->item->ParsedText;
        $this->errorMessage = $this->item->ErrorMessage;
        $this->errorDetails = $this->item->ErrorDetails;
    }

    public function getExitCode()
    {
        return $this->exitCode;
    }

    public function text()
    {
        return $this->text;
    }

    public function errorMessage()
    {
        return $this->errorMessage;
    }

    public function errorDetails()
    {
        return $this->errorDetails;
    }

    public function __toString()
    {
        return $this->text;
    }
}
