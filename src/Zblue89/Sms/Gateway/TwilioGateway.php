<?php
/**
 * Created by IntelliJ IDEA.
 * User: zblue89-PC
 * Date: 11/9/2016
 * Time: 10:01 AM
 */

namespace Zblue89\Sms\Gateway;


class TwilioGateway implements Gateway
{

    private $sid;

    private $authToken;

    private $fromNumber;

    public function __construct($sid, $authToken, $fromNumber)
    {
        $this->sid = $sid;
        $this->authToken = $authToken;
        $this->fromNumber = $fromNumber;
    }

    public function send($phoneNumber, $message)
    {
        $client = new \Twilio\Rest\Client($this->sid, $this->authToken);

        $client->messages->create(
            $phoneNumber,
            array(
                'from' => $this->fromNumber,
                'body' => $message
            )
        );
    }
}