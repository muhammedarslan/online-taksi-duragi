<?php

new_session();
if ( isset($_SESSION['SessionDurak']) ) {
	header("Location:/DurakYonetim"); exit;
}
if ( isset($_GET['Sifremi']) && $_GET['Sifremi'] == 'Unuttum' ) {
	load_page('durak.lost.pass');
} else if ( isset($_GET['Adım']) && $_GET['Adım'] == '2' ) {
	if ( !isset($_SESSION['lost_reset_pin']) || $_SESSION['lost_reset_pin'] == '' ) {
		header("Location:/DurakYonetim/Giris?Sifremi=Unuttum");
		exit;
	} 
	load_page('durak.lost.pass2');
	$_SESSION['Adım2-session'] = 'active';
} else {
	load_page('durak.login');
}