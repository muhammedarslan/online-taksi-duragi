<?php

new_session();

if ( $_GET['type'] == '1' ) { $Amount = 198; } else 
if ( $_GET['type'] == '2' ) { $Amount = 1987; } else 
if ( $_GET['type'] == '3' ) { $Amount = 5987; } else  {

	echo 'Hata!';
	exit;
}


echo 'Lütfen bekleyiniz, ödemeniz hazırlanıyor...';

$UserId = $_SESSION['Durak']->id;

if ( $UserId == '18' ){
	echo '<br>Demo modu için ödeme oluşturulamaz.';
	exit;
} 

if ( $UserId == '19' ){
	echo '<br>Sanal pos: iyzico.';
	exit;
} 

$Rdn = random(12);

$FllName = $_SESSION['Durak']->bossname;
$LastName = explode(' ', $_SESSION['Durak']->bossname);
$LN = str_replace(' '.end($LastName), '', $FllName);

$Last = str_replace($LN, '', $FllName);

global $db;

$query = $db->prepare("INSERT INTO pay SET
	token = ?,
	user_id = ?,
	type = ?,
	pay_time = ?");
$insert = $query->execute(array(
	$Rdn,$UserId,$_GET['type'],time()
));

require_once CDIR.'/class.shopier.php';

$shopier = new Shopier('13e5fbb252707523a0b2a4e116c56eb3', 'f66b51fea87faeb8bfa9fdd4b2f116fe');
$shopier->setBuyer([
	'id' => $UserId,
	'first_name' => $LN,
	'last_name' => $Last,
	'email' => $_SESSION['Durak']->email,
	'phone' => $_SESSION['Durak']->phone_number
]);
$shopier->setOrderBilling([
	'billing_address' => $_SESSION['Durak']->address,
	'billing_city' => '',
	'billing_country' => 'turkey',
	'billing_postcode' => '',
]);
$shopier->setOrderShipping([
	'shipping_address' => $_SESSION['Durak']->address,
	'shipping_city' => '',
	'shipping_country' => 'turkey',
	'shipping_postcode' => '',
]);
die($shopier->run($Rdn, $Amount, PROTOCOL.DOMAIN.PATH.'payment-callback' ));

?>
