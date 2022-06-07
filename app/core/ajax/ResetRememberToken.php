<?php

new_session();
$UID = $_SESSION['Durak']->id;


$delete = $db->exec("DELETE FROM remember_me WHERE user_id = '$UID' ");

setcookie("RMB", 'false', time() -3600,'/',DOMAIN,false,true);

add_log($UID,'Otomatik giriş anahtarları sıfırlandı.');

echo json_encode(array(
	'HttpCode' => 200
));