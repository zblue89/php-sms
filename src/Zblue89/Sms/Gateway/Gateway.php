<?php
namespace Zblue89\Sms\Gateway;

interface Gateway
{
    public function send($phoneNumber, $message);
}