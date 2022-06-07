<?php


global $db;

$Tkn = @$_GET['ID'];
$UID = $_SESSION['Durak']->id;

$query = $db->query("SELECT * FROM payments WHERE token = '{$Tkn}' and user_id='$UID' ")->fetch(PDO::FETCH_ASSOC);
if ( !$query ){
	
	header("Location:/DurakYonetim/Odemeler");
	exit;

}