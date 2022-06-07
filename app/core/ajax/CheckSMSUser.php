<?php

new_session();
$UID = $_SESSION['Durak']->id;

if ( $UID == '18' ){
	echo json_encode(array(
		'status' => 'failed',
		'reload' => false,
		'location' => false,
		'message' => 'Bazı güvenlik nedenlerinden dolayı demo modunda bu özelliği devre dışı bıraktık. Anlayışınız için teşekkür ederiz.'
	));
	exit;
} 


$SmsUser = $_SESSION['Durak']->sms_user;
$Smspass = $_SESSION['Durak']->sms_pass;


$CheckNetGsm = file_get_contents('https://api.netgsm.com.tr/sms/header/get/?usercode='.urlencode($SmsUser).'&password='.urlencode($Smspass));


if ( substr($CheckNetGsm, 0,10) == $SmsUser ) {

	echo json_encode(array(
		'status' => 'success'
	));

} else {

	echo json_encode(array(
		'status' => 'failed'
	));

}