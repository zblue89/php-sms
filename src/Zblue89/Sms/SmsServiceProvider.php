<?php

namespace Zblue89\Sms;

use Illuminate\Support\ServiceProvider;
use Zblue89\Sms\Gateway\GenericGateway;
use Zblue89\Sms\Gateway\LogGateway;
use Zblue89\Sms\Gateway\PlivoGateway;
use Zblue89\Sms\Gateway\TwilioGateway;

class SmsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('sms', function ($app) {
            $smsSender = new SmsSender();
            $smsConfigSets = $app['config']['sms'];
            foreach ($smsConfigSets as $smsConfigSet) {
                $gateway = null;
                switch ($smsConfigSet['gateway']) {
                    case 'log':
                        $gateway = new LogGateway($app->make('Psr\Log\LoggerInterface'));
                        break;
                    case 'plivo':
                        $gateway = new PlivoGateway($smsConfigSet['plivo_auth_id'], $smsConfigSet['plivo_auth_token'], $smsConfigSet['plivo_source']);
                        break;
                    case 'twilio':
                        $gateway = new TwilioGateway($smsConfigSet['twilio_sid'], $smsConfigSet['twilio_auth_token'], $smsConfigSet['twilio_from_number']);
                        break;
                    case 'generic':
                        $gateway = new GenericGateway($smsConfigSet['generic_url'], $smsConfigSet['generic_parameters'], $smsConfigSet['generic_phone_number_parameter_name'], $smsConfigSet['generic_message_parameter_name'], $smsConfigSet['generic_good_response']);
                        break;
                    default:
                        $gateway = null;
                        break;
                }

                if ($gateway != null) {
                    $smsSender->add($smsConfigSet['format'], $gateway);
                }
            }
            return $smsSender;
        });
    }
}
