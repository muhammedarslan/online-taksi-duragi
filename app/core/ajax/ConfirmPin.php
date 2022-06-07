<?php


$Tkn = post('taxi');

$Pin = post('pin');


$Taxi = $db->query("SELECT * FROM taxies WHERE token2 = '{$Tkn}'")->fetch(PDO::FETCH_ASSOC);
if ( !$Taxi ){
	
	echo json_encode(array(
		'status' => 'error',
		'msg'    => 'Geçersiz Adres!'
	));
	exit;
}

$Usr = $Taxi['user_id'];
$User = $db->query("SELECT * FROM users WHERE id='$Usr' and status=1 ")->fetch(PDO::FETCH_ASSOC);
if ( !$User ){

	echo json_encode(array(
		'status' => 'error',
		'msg'    => 'Geçersiz Adres!'
	));
	exit;
}


if ( password($Pin)  == $Taxi['password'] ) {
	new_session();
	$_SESSION['Pin_Session_'.$Taxi['id']] = 'active';
	echo json_encode(array(
		'status' => 'success',
		'msg'    => 'doğrulama başarılı, yönlendiriliyorsunuz...'
	));
	exit;

} else {

	echo json_encode(array(
		'status' => 'error',
		'msg'    => 'Lütfen pini kontrol edip yeniden deneyiniz.'
	));
	exit;

}