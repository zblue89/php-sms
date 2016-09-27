<?php
/**
 * Created by IntelliJ IDEA.
 * User: zblue89-PC
 * Date: 11/9/2016
 * Time: 10:01 AM
 */

namespace Zblue89\Sms\Gateway;


class GenericGateway implements Gateway
{
    private $url;

    private $parameters = array();

    private $phoneNumberParamName;

    private $messageParamName;

    private $goodResponse;

    public function __construct($url, array $parameters, $phoneNumberParamName, $messageParamName, $goodResponse = null)
    {
        $this->url = $url;
        $this->parameters = $parameters;
        $this->phoneNumberParamName = $phoneNumberParamName;
        $this->messageParamName = $messageParamName;
        $this->goodResponse = $goodResponse;
    }

    public function send($phoneNumber, $message)
    {
        $fields_string = '';
        foreach ($this->parameters as $key => $value) {
            $fields_string .= $key . '=' . urlencode($value) . '&';
        }
        $fields_string .= $this->phoneNumberParamName . '=' . urlencode($phoneNumber) . '&';
        $fields_string .= $this->messageParamName . '=' . urlencode($message);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, count($this->parameters) + 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

        $result = curl_exec($ch);
        curl_close($ch);
        if ($this->goodResponse != null && !empty ($this->goodResponse) && $result != $this->goodResponse) {
            throw new \Exception($result);
        }
    }
}