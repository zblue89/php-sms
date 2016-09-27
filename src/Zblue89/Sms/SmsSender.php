<?php
/**
 * Created by IntelliJ IDEA.
 * User: zblue89-PC
 * Date: 8/9/2016
 * Time: 8:50 PM
 */

namespace Zblue89\Sms;

use Zblue89\Sms\Gateway\Gateway;

class SmsSender
{

    private $gateways = array();

    public function add($phoneFormat, Gateway $gateway){
        $this->gateways[$phoneFormat] = $gateway;
    }

    public function send($phoneNumber, $message)
    {
        foreach ($this->gateways as $phoneFormat => $gateway) {
            if (preg_match($phoneFormat, $phoneNumber) === 1) {
                $gateway->send($phoneNumber, $message);
                break;
            }
        }
    }


}