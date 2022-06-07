<?php

$Page_title = 'Taksi Düzenle | Online Taksi Durağı';

global $db;
global $UID;

$ID = clear($_GET['ID']); 
$query = $db->query("SELECT * FROM taxies WHERE user_id = '{$UID}' and token='$ID' and status=1 ")->fetch(PDO::FETCH_ASSOC);
if ( !$query ){
	header("Location:/DurakYonetim/TaksiYonetimi");
	exit;
}