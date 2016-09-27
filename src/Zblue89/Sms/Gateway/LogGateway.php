<?php
/**
 * Created by IntelliJ IDEA.
 * User: zblue89-PC
 * Date: 8/9/2016
 * Time: 9:05 PM
 */

namespace Zblue89\Sms\Gateway;


use Psr\Log\LoggerInterface;

class LogGateway implements Gateway
{

    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function send($phoneNumber, $message)
    {
        $this->logger->info('SMS to Phone Number:' . $phoneNumber . ' with Message:\'' . $message . '\'');
    }
}