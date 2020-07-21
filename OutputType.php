<?php

class OutputType
{
    private $console = "\n";
    private $browser = "</br>";

    public function getOutputConsole()
    {
        return $this->console;
    }

    public function getOutputBrowser()
    {
        return $this->browser;
    }
}