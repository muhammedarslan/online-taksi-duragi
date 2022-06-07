<?php

new_session();

$UserId = $_SESSION['Durak']->id;

if ( $UserId == '18' ){
	echo json_encode(array(
		'status' => 'failed',
		'reload' => false,
		'location' => false,
		'message' => 'Bazı güvenlik nedenlerinden dolayı demo modunda bu özelliği devre dışı bıraktık. Anlayışınız için teşekkür ederiz.'
	));
	exit;
} 

$token = post('token');
$taxi  = post('plaka');
$dk    = post('dakika');

$quer22y = $db->query("SELECT * FROM hey_taksi WHERE user_id = '$UserId' and token='$token' ")->fetch(PDO::FETCH_ASSOC);


$Singdf = $quer22y['phone_number'];
$Contact = $db->query("SELECT * FROM contact WHERE status='1' and user_id='$UserId' and phone_number='$Singdf' ")->fetch(PDO::FETCH_ASSOC);

$Taks = $db->query("SELECT * FROM taxies WHERE id='$taxi' and user_id='$UserId' ")->fetch(PDO::FETCH_ASSOC);

$query = $db->prepare("UPDATE hey_taksi SET
	status = :iki,taxi_id =:dort,taxi_time =:bes WHERE user_id =:bir and token=:uc ");
$update = $query->execute(array(
	"bir" => $_SESSION['Durak']->id,
	"iki" => 2,
	"uc" => $token,
	'dort' => $Taks['id'],
	'bes' => $dk
));


$Msg = $_SESSION['Durak']->msg6;

$message = str_replace('%MüşteriAdı%', $Contact['realname'], $Msg);
$message = str_replace('%MüşteriAdresi%', $Contact['adres'], $message);
$message = str_replace('%Durak%', $_SESSION['Durak']->realname, $message);
$message = str_replace('%TaksiPlakası%', $Taks['plaka'], $message);
$message = str_replace('%TaksiTanımı%', $Taks['arac'], $message);
$message = str_replace('%TaksiZamanı%', $dk, $message);

send_sms($UserId,$quer22y['phone_number'],$message);

if ( $update ){
	echo json_encode(array(
		'status' => 'success',
		'reload' => true,
		'location' => false,
		'message' => 'Talep edilen taksi başarıyla gönderildi !'
	));
	exit;
} else {
	http_response_code(401);
}