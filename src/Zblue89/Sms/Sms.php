<?php

namespace Zblue89\Sms;

class Sms {
	protected $confg;
	public function __construct($config) {
		$this->config = $config;
	}
	public function send($to, $template, $params = null) {
		$url = $this->config ['url'];
		$isDummy = $this->config ['isDummy'];
		$logpath = $this->config ['logpath'];
		$toLabel = $this->config ['to'];
		$textLabel = $this->config ['text'];
		$fields = $this->config ['params'];
		$fields [$toLabel] = $to;
		$text = \View::make ( "sms::$template" );
		if ($params != null && is_array ( $params )) {
			$keys = array ();
			$values = array ();
			foreach ( $params as $k => $v ) {
				$keys [] = '${' . $k . '}';
				$values [] = $v;
			}
			$text = str_replace ( $keys, $values, $text );
		}
		if (! empty ( $this->config ['prefix'] )) {
			$text = $this->config ['prefix'] . $text;
		}
		if (! empty ( $this->config ['postfix'] )) {
			$text = $text . $this->config ['postfix'];
		}
		$fields [$textLabel] = urlencode ( $text );
		if ($isDummy) {
			$log = '';
			foreach ( $fields as $key => $value ) {
				$log .= $key . ': ' . $value . "\n";
			}
			file_put_contents ( app_path () . $logpath . "/" . date ( 'Ymd' ) . ".log", $log, FILE_APPEND );
		} else {
			$fields_string = '';
			foreach ( $fields as $key => $value ) {
				$fields_string .= $key . '=' . $value . '&';
			}
			$fields_string = rtrim ( $fields_string, '&' );
			
			$ch = curl_init ();
			
			curl_setopt ( $ch, CURLOPT_URL, $url );
			curl_setopt ( $ch, CURLOPT_POST, count ( $fields ) );
			curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields_string );
			curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, TRUE );
			
			$result = curl_exec ( $ch );
			curl_close ( $ch );
		}
	}
}