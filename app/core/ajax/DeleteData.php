<?php

new_session();

$UserId = $_SESSION['Durak']->id;
$Notifs = array();

if ( $UserId == '18' ){
	echo json_encode(array(
		'status' => 'failed',
		'reload' => false,
		'location' => false,
		'message' => 'Bazı güvenlik nedenlerinden dolayı demo modunda bu özelliği devre dışı bıraktık. Anlayışınız için teşekkür ederiz.'
	));
	exit;
} 


$Table = post('tbl');
$ID = post('id');


global $db;

try {
	$result = $db->query("SELECT 1 FROM $Table LIMIT 1");
} catch (Exception $e) {
	http_response_code(401);
	exit;
}

$query = $db->prepare("UPDATE $Table SET
	status = :iki WHERE user_id =:bir and token=:uc ");
$update = $query->execute(array(
	"bir" => $_SESSION['Durak']->id,
	"iki" => -555,
	"uc" => $ID
));

$Eks = '';
if ( $Table == 'contact' ) $Eks = 'Rehberden';
if ( $Table == 'taxies' ) $Eks = 'Taksilerden';

add_log($UserId,$Eks.' den bir veri silindi.');

if ( $update ){
	echo json_encode(array(
		'status' => 'success',
		'reload' => true,
		'location' => false,
		'message' => 'Bunun bir hata olduğunu düşünüyorsan lütfen bizimle iletişime geç.'
	));
	exit;
} else {
	http_response_code(401);
}