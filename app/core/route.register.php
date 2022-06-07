<?php

global $db;

$User = $db->query("SELECT * FROM users WHERE mini_token='$Tkn' and status=1 ")->fetch(PDO::FETCH_ASSOC);
if ( !$User ){
	http_response_code(404);
	require_once VDIR.'/page.404.php';		
	exit;
}