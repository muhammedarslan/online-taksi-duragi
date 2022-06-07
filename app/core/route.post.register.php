<?php

$name  = post('name');
$tel   = post('tel');
$adres = post('adres');

if ( $name == '' || $tel == '' || $adres == '' || strlen($tel) != 15 ) {

	echo json_encode(array(
		'status' => 'error',
		'reload' => false,
		'location' => false,
		'message' => 'Lütfen eksik veya hatalı alan bırakmayınız.'
	));
	exit;

}

$Tel = str_replace(array(' ','(',')'), array('','',''), $tel);
$Tel = '+90'.$Tel;

new_session();

global $db;

$User = $db->query("SELECT * FROM users WHERE mini_token='$Tkn' and status=1 ")->fetch(PDO::FETCH_ASSOC);

$ContactCheck = $db->query("SELECT * FROM contact WHERE phone_number='$Tel' and status=1 ")->fetch(PDO::FETCH_ASSOC);

if ( $ContactCheck ) {

	echo json_encode(array(
		'status' => 'error',
		'reload' => false,
		'location' => false,
		'message' => 'Bu numara zaten bu durağa kayıtlı. Lütfen kontrol ederek yeniden deneyiniz.'
	));
	exit;

} else {

	$query = $db->prepare("INSERT INTO contact SET
		user_id = :bir,
		realname = :iki,
		phone_number = :uc,
		adres = :dort,
		sms_count = :bes,
		added_time = :alti,
		token = :sekiz,
		status = :yedi");
	$insert = $query->execute(array(
		"bir" => $User['id'],
		"iki" => $name,
		"uc" => $Tel,
		"dort" => $adres,
		"bes" => 0,
		"alti" => time(),
		"yedi" => 1,
		'sekiz'=> random(20)
	));
	if ( $insert ){

		send_sms($User['id'],$Tel,'Taksi durağımıza hoşgeldin '.$name.'. Sana biraz sistemimizden bahsedeyim, '.$User['msg3']);

		echo json_encode(array(
			'status' => 'success',
			'reload' => false,
			'location' => '/d/'.$User['mini_token'],
			'message' => 'Bu durağa başarıyla kayıt oldunuz, teşekkür ederiz.'
		));
		exit;
	} else {
		http_response_code(401);
	}	
}