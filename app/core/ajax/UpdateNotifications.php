<?php


new_session();

$UserId = $_SESSION['Durak']->id;
$Notifs = array();


$query = $db->query("SELECT * FROM notifications WHERE user_id = '$UserId' and status = 0 ORDER by id ASC LIMIT 20  ", PDO::FETCH_ASSOC);

if ( $query->rowCount() ){

	$n = 0;
	foreach( $query as $row ){
		$n++;
		array_push($Notifs, array(
			'NC'   => $n,
			'text' => say($row['notif_text']),
			'icon' => $row['notif_icon'],
			'token'=> $row['token'],
			'time' => timerFormat(intval($row['notif_time']),time()+10)

		));

	}

	echo json_encode($Notifs);
	exit;

} else {

	echo json_encode(array(
		'NC'  => 0
	));
	exit;

}