# PHP SMS

The purpose of this package is to allow the user to use different SMS gateway to send the SMS to different phone number format.

For example, you may use Twilio to send SMS to US phone number, and Plivo to send SMS to Malaysian phone number.

Currently the package just support 4 SMS gateways, which are log (show the message in log file), Twilio, Plivo, and Generic (perform HTTP POST to the configured URL). If you are to use Twilio and/or Plivo, you have to include `twilio\twilio-sdk` and/or `plivo/plivo` in your project.

# Installation

1. Add `zblue89\php-sms` to your composer:

        composer require zblue89\php-sms
    
2. Add `\Zblue89\Sms\SmsServiceProvider::class` into `providers` section in `config\app.php` file.

        'providers' => [
            ...
            Zblue89\Sms\SmsServiceProvider::class
            ...
        ]

3. Add `'SMS' => Zblue89\Sms\Facades\SMS::class` into `aliases` section in `config\app.php` file.

        'aliases' => [
            ...
            'SMS' => Zblue89\Sms\Facades\SMS::class,
            ...
        ]

4. Copy `sms.php` configuration file from `vendor\zblue89\php-sms\src\config` folder to `config` folder.

       
# Configuration

You may provide multiple sets of SMS configuration in `config/sms.php`.

`format` - the phone number regular expression format. E.g. `/^60\d+$/` for Malaysian phone number.

`gateway` - the SMS gateway to be used for the provided `format`. Currently it only supports `log`, `twilio`, `plivo`, and `generic`.


The following configuration are required for Plivo SMS gateway:

`plivo_auth_id` - Plivo Authentication ID

`plivo_auth_token` - Plivo Authentication Token

`plivo_source` - Source for Plivo


The following configuration are required for Twilio SMS gateway:

`twilio_sid` - Twilio SID

`twilio_auth_token` - Twilio Authentication Token

`twilio_from_number` - Twilio From Number


The following configuration are required for Generic SMS gateway:

`generic_url` - POST URL

`generic_parameters` - Additional parameters to be included during the HTTP POST

`generic_phone_number_parameter_name` - Parameter name for Phone Number during the HTTP POST

`generic_message_parameter_name` - Parameter name for Message during the HTTP POST

`generic_good_response` - Expected response body from HTTP POST. An exception will be thrown if the response body does not match with this value. This value is nullable. If it is null, the process is considered as success all the time.

# Example of configuration:

	[
		'format' => '/^60\d+$/,
		'gateway' => 'plivo',
		'plivo_auth_id' => 'XXXXXXX'
		'plivo_auth_token' => 'XXXXXX',
		'plivo_source' => 'tapway'
	], 
	[
		'format' => '/^65\d+$/,
		'gateway' => 'twilio',
		'twilio_sid' => 'XXXXXXX'
		'twilio_auth_token' => 'XXXXXX',
		'twilio_from_number' => '0123456789'
	]
    
# Usage

Using SMS provider service is very simple:

    SMS::send('<phone number>', '<message>');
    
  


