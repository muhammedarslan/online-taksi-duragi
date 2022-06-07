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

$Post = post('b');

$Data = base64_decode($Post);


$query = $db->query("SELECT * FROM users WHERE id = '{$UID}' and status='1' ")->fetch(PDO::FETCH_ASSOC);
if ( $query ){

	$Ext = json_decode($query['e_m']);

	$N_array = array();

	foreach ($Ext as $key) {
		
		if ( $key[0] != $Data ) {
			array_push($N_array, $key);
		}

	}

	$Last = json_encode($N_array);

	$query = $db->prepare("UPDATE users SET
		e_m = :bir
		WHERE id = :iki");
	$update = $query->execute(array(
		"bir" => $Last,
		"iki" => $UID
	));

	if ( $update ) {
		$_SESSION['Durak']->e_m = $Last;
		echo json_encode(array(
			'status' => 'success',
			'reload' => true,
			'location' => false,
			'message' => 'Bunun bir hata olduğunu düşünüyorsan lütfen bizimle iletişime geç.'
		));
		exit;
	} else {
		echo json_encode(array(
			'status' => 'error',
			'reload' => true,
			'location' => false,
			'message' => 'Bunun bir hata olduğunu düşünüyorsan lütfen bizimle iletişime geç.'
		));
		exit;
	}

} else {
	echo json_encode(array(
		'status' => 'error',
		'reload' => true,
		'location' => false,
		'message' => 'Bunun bir hata olduğunu düşünüyorsan lütfen bizimle iletişime geç.'
	));
	exit;
}