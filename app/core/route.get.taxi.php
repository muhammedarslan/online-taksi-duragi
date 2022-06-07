<?php

global $db;

$Taxi = $db->query("SELECT * FROM taxies WHERE token2 = '{$Tkn}'")->fetch(PDO::FETCH_ASSOC);
if ( !$Taxi ){
	http_response_code(404);
	require_once VDIR.'/page.404.php';
	exit;
}

$Usr = $Taxi['user_id'];
$User = $db->query("SELECT * FROM users WHERE id='$Usr' and status=1 ")->fetch(PDO::FETCH_ASSOC);
if ( !$User ){
	http_response_code(403);
	exit;
}
new_session();
if ( @$_SESSION['Pin_Session_'.$Taxi['id']] == 'active' ) {

	load_page('durak.single.taxi',array($Taxi),'Taksi Yolcu Takibi');
	exit;

} else {
	load_page('durak.taxi.pin',array($Taxi),'Lütfen Pin Giriniz');
	exit;
}
