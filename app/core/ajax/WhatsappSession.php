<?php

new_session();

function startBot($site_url , $timeout = 5)
{

	$ch = curl_init();

	$tarayici = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.9; rv:32.0) Gecko/20100101 Firefox/32.0';

	curl_setopt($ch, CURLOPT_URL,$site_url);

	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER , 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1);
	curl_setopt($ch, CURLOPT_HEADER         , 0);
	curl_setopt($ch, CURLOPT_TIMEOUT        , $timeout);
	curl_setopt($ch, CURLOPT_USERAGENT      , $tarayici);

	$result = curl_exec($ch);
	curl_close($ch);

	return $result;

}

$Check = startBot('https://www.waboxapp.com/api/status/90'.$_SESSION['Durak']->sms_user.'?token=b992e97d7e2a3d0cd06189e2dcc3bbf85d456e80cb655&random='.time());

$JsonD = json_decode($Check);

if ( isset($JsonD->error) && $JsonD->error != 'Unauthorized'  ) {

	echo json_encode(array(
		'status' => 'inactive'
	));
	exit;

}

echo json_encode(array(
	'status' => 'invalid'
));
exit;