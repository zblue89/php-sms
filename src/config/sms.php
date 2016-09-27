<?php

return [
    [
        /**
         * phone number format
         */
        'format' => '/^.*$/',

        /**
         * SMS Gateway
         *
         * log, plivo, twilio, generic
         */
        'gateway' => 'log',

        /**
         * Plivo Configuration
         */
        'plivo_auth_id' => '',
        'plivo_auth_token' => '',
        'plivo_source' => '',

        /**
         * Twilio Configuration
         */
        'twilio_sid' => '',
        'twilio_auth_token' => '',
        'twilio_from_number' => '',

        /**
         * Generic Configuration
         */
        'generic_url' => '',
        'generic_parameters' => array(),
        'generic_phone_number_parameter_name' => '',
        'generic_message_parameter_name' => '',
        'generic_good_response' => ''
    ]
];