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

$Number = post('nmb');
$Messag = post('msg');


if ( strlen($Number) != 13 || $Messag == '' ) {

	echo json_encode(array(
		'status'  => 'error',
		'reload'  => false,
		'fm'      => false,
		'location'=> false,
		'message' => 'Lütfen boş alan bırakmayınız'
	));
	exit;

}



if ( post('type') != 'new' ){

	send_sms($UID,$Number,$Messag);
	echo json_encode(array(
		'status'  => 'success',
		'reload'  => true,
		'fm'      => false,
		't'       => post('type'),
		'location'=> false,
		'message' => 'Mesajınız başarıyla gönderildi.'
	));

} else {

	send_sms($UID,$Number,$Messag);
	echo json_encode(array(
		'status'  => 'success',
		'reload'  => false,
		't'       => post('type'),
		'fm'      => '+'.seo_link('+90'.pnumber($Number)),
		'location'=> false,
		'message' => 'Mesaj başarıyla gönderildi.'
	));

}

