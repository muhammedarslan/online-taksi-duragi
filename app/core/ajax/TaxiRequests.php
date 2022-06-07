<?php

new_session();
$UID = $_SESSION['Durak']->id;

$query = $db->query("SELECT * FROM hey_taksi WHERE user_id = '$UID' and status=1 ")->fetch(PDO::FETCH_ASSOC);
if ( $query ){


	echo json_encode(array(
		'status'  => 'new',
		'message' => 'Rehberinizde kayıtlı bir müşteriniz taksi talep etti. Hemen taksisini göndermek için tıklayın.'
	));

} else {

	echo json_encode(array(
		'status'  => 'calm-down'
	));

}