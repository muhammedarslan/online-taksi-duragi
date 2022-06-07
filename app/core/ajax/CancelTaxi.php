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

$quer22y = $db->query("SELECT * FROM hey_taksi WHERE user_id = '$UserId' and token='$token' ")->fetch(PDO::FETCH_ASSOC);


$query = $db->prepare("UPDATE hey_taksi SET
	status = :iki WHERE user_id =:bir and token=:uc ");
$update = $query->execute(array(
	"bir" => $_SESSION['Durak']->id,
	"iki" => -555,
	"uc" => $token
));

send_sms($UserId,$quer22y['phone_number'],'Maalesef taksi durağı şu anda taksi gönderemeyeceğini belirtti. Bunun için çok üzgünüz, lütfen daha sonra tekrar deneyiniz.');

if ( $update ){
	echo json_encode(array(
		'status' => 'success',
		'reload' => true,
		'location' => false,
		'message' => 'Müşterinin taksi talebi başarıyla iptal edildi !'
	));
	exit;
} else {
	http_response_code(401);
}