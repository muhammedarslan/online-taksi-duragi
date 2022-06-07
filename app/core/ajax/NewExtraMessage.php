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


$key  = post('key');
$text = post('text');

if ( $key == ''  || $text == '' ) {

	echo json_encode(array(
		'status' => 'error',
		'reload' => true,
		'location' => false,
		'message' => 'Mesaj eklenirken bir hata oluştu !'
	));
	exit;

}

$query = $db->query("SELECT * FROM users WHERE id = '{$UID}' and status='1' ")->fetch(PDO::FETCH_ASSOC);
if ( $query ){

	$query['e_m'] = $query['e_m'] == 'null' ? '[]' : $query['e_m'];
	$Ext = json_decode($query['e_m']);

	array_push($Ext, array($key,$text));

	$Last = json_encode($Ext);

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
			'message' => 'Yeni ekstra mesajınız başarıyla eklendi.'
		));
		exit;
	} else {
		echo json_encode(array(
			'status' => 'error',
			'reload' => true,
			'location' => false,
			'message' => 'Mesaj eklenirken bir hata oluştu !'
		));
		exit;
	}


} else {
	echo json_encode(array(
		'status' => 'error',
		'reload' => true,
		'location' => false,
		'message' => 'Mesaj eklenirken bir hata oluştu !'
	));
	exit;
}