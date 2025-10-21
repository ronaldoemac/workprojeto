<?php

namespace App\Service;

use Psr\Log\LoggerInterface;

class StringManipulationService
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    public function cleanString(String|null $string): String
    {
        $this->logger->info('recebemos o valor '.$string);
        $string = str_replace('[', '',$string);
        $string = str_replace(']', '',$string);
        $this->logger->info('devolvemos o valor '.$string);
        
        return $string;
    }
}