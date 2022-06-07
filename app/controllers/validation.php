<?php

date_default_timezone_set('Europe/Istanbul');


if       (getenv('HTTP_CLIENT_IP'))        $ipaddress = getenv('HTTP_CLIENT_IP');
else if  (getenv('HTTP_X_FORWARDED_FOR'))  $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
else if  (getenv('HTTP_X_FORWARDED'))      $ipaddress = getenv('HTTP_X_FORWARDED');
else if  (getenv('HTTP_FORWARDED_FOR'))    $ipaddress = getenv('HTTP_FORWARDED_FOR');
else if  (getenv('HTTP_FORWARDED'))        $ipaddress = getenv('HTTP_FORWARDED');
else if  (getenv('REMOTE_ADDR'))           $ipaddress = getenv('REMOTE_ADDR');
else                                       $ipaddress = 'UNKNOWN';


if (!filter_var($ipaddress, FILTER_VALIDATE_IP)) :

	http_response_code(403);
	require_once VDIR.'/error.forbidden.html';
	exit();

endif;


if ( !isset($_SERVER['HTTP_USER_AGENT']) || $_SERVER['HTTP_USER_AGENT'] == '' ) :

	http_response_code(403);
	require_once VDIR.'/error.forbidden.html';
	exit();

endif;