<?php


namespace Zblue89\Sms\Facades;

use Illuminate\Support\Facades\Facade;

class Sms extends Facade {
	
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() {
		return 'sms';
	}
}