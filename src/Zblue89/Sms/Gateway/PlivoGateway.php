<?php

namespace Zblue89\Sms\Gateway;

use Plivo\RestAPI;

class PlivoGateway implements Gateway
{
    private $authId;

    private $authToken;

    private $source;

    public function __construct($authId, $authToken, $source)
    {
        $this->authId = $authId;
        $this->authToken = $authToken;
        $this->source = $source;
    }

    public function send($phoneNumber, $message)
    {
        $restApi = new RestAPI($this->authId, $this->authToken);
        // Send a message
        $p = array(
            'src' => $this->source,
            'dst' => "$phoneNumber",
            'text' => "$message",
            'type' => 'sms',
        );

        $response = $restApi->send_message($p);

        $status = $response['status'];
        if ($status == 202) {
            return true;
        } else {
            return 'HTTP Status ' . $status;
        }
    }
}