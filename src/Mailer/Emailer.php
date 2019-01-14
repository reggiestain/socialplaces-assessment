<?php

namespace App\Mailer;

use Psr\Log\LoggerInterface;

class Emailer {
    /**
     *
     * @var string 
     */
    private $mySweetParam;
    /**
     *
     * @var LoggerInterface
     */
    private $logger;        
    
    public function __construct(string $mySweetParam, LoggerInterface $logger) {
        
        $this->mySweetParam = $mySweetParam;
        $this->logger = $logger;
    }

    public function create(): \Swift_Message {
        
    }

}
