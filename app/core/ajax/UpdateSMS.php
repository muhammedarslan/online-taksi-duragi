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


$taksicagir = post('taksicagir');
$msg1       = post('msg1');
$msg2       = post('msg2');
$msg3       = post('msg3');
$msg4       = post('msg4');
$msg5       = post('msg5');
$msg6       = post('msg6');
$msg7       = post('msg7');


if ( $taksicagir == '' || $msg1 == '' || $msg2 == '' || $msg3 == '' || $msg4 == '' || $msg5 == '' || $msg6 == '' || $msg7 == '' ) {

	echo json_encode(array(
		'status' => 'error',
		'reload' => false,
		'location' => false,
		'message' => 'Lütfen eksik veya hatalı alan bırakmayınız.'
	));
	exit;

}


$query = $db->prepare("UPDATE users SET
	f_m = :bir,
	f_m_to_user = :iki,
	msg1 = :uc,
	msg2 = :bes,
	msg3 = :alti,
	msg4 = :dort,
	msg5 = :yedi,
	msg6 = :dokuz
	WHERE id = :sekiz");
$update = $query->execute(array(
	"bir" => $taksicagir,
	"iki" => $msg1,
	"uc" => $msg2,
	"dort" => $msg3,
	"bes" => $msg4,
	"alti" => $msg5,
	"yedi" => $msg6,
	"dokuz" => $msg7,
	"sekiz" => $UID
));

$query = $db->query("SELECT * FROM users WHERE id='$UID' ")->fetch(PDO::FETCH_ASSOC);
$_SESSION['Durak'] = (object) $query;

if ( $update ) {

	echo json_encode(array(
		'status' => 'success',
		'reload' => false,
		'location' => false,
		'message' => 'Mesajlar başarıyla güncellendi.'
	));
	exit;	

} else {

	echo json_encode(array(
		'status' => 'error',
		'reload' => true,
		'location' => false,
		'message' => 'Bir hata oluştu, lütfen daha sonra tekrar dene.'
	));
	exit;
}