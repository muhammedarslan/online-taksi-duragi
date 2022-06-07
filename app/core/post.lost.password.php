<?php


ajax_check('post');


$verify = recatpcha_solve("https://www.google.com/recaptcha/api/siteverify?secret=".RCPTCHA_KEY."&response=".$_POST['captha']);

$captcha_success = json_decode($verify);


if ($captcha_success->success==false) { 

	echo json_encode(array(
		"status" => 'error',
		"reload" => 'false',
		'text' => 'Güvenlik doğrulaması geçersiz !'
	));

	exit;
}


$Random1 = rand(1,9);
$Random2 = rand(0,9);
$Random3 = rand(0,9);
$Random4 = rand(0,9);
$Random5 = rand(0,9);
$Random6 = rand(0,9);

$Pin = $Random1.$Random2.$Random3.$Random4.$Random5.$Random6;


$Tel = post('tel');
$Tel = str_replace(array(' ','(',')'), array('','',''), $Tel);
$Tel = '+90'.$Tel;

$query = $db->query("SELECT * FROM users WHERE phone_number = '{$Tel}' and status='1' ")->fetch(PDO::FETCH_ASSOC);
if ( !$query ){

	echo json_encode(array(
		"status" => 'error',
		"reload" => 'false',
		'text' => 'Kullanıcı hesabı bulunamadı !'
	));

	exit;
}

$UserID = $query['id'];
$LastQuery = $db->query("SELECT * FROM lost_password WHERE user_id='$UserID' ")->fetch(PDO::FETCH_ASSOC);

if ( $LastQuery ) {

	if ( $LastQuery['send_count'] > 2 ) {
		echo json_encode(array(
			"status" => 'error',
			"reload" => 'false',
			'text' => "Maksimum deneme sayısına ulaştınız. Lütfen 24 saat sonra tekrar deneyiniz."
		));

		exit;
	}

	$Update = $LastQuery['send_count'] + 1;

	$query = $db->prepare("UPDATE lost_password SET
		send_count = :bir,
		last_send = :uc
		WHERE user_id = :iki");
	$update = $query->execute(array(
		"bir" => $Update,
		"iki" => $UserID,
		"uc" => time()
	));

	new_session();
	$_SESSION['lost_reset_pin'] = $Pin;
	$_SESSION['reset_pass_user'] = $UserID;
	$_SESSION['lost_send_time'] = time()+(60*3);

	add_log($UserID,'Telefonunuza şifre sıfırlama pin kodu gönderildi.');

	send_sms('default',$Tel,$Pin.' pin kodu ile şifrenizi sıfırlayabilirsiniz. Hey Taksi.');
	
	echo json_encode(array(
		"status" => 'success',
		"reload" => 'false',
		'text' => "Lütfen telefonunuzu kontrol ediniz."
	));

	exit;

} else {

	$query = $db->prepare("INSERT INTO lost_password SET 
		send_count = :bir,
		user_id = :iki,
		last_send= :uc");
	$update = $query->execute(array(
		"bir" => 1,
		"iki" => $UserID,
		"uc" => time()
	));

	new_session();
	$_SESSION['lost_reset_pin'] = $Pin;
	$_SESSION['lost_send_time'] = time()+(60*3);
	
	recatpcha_solve('https://api.netgsm.com.tr/sms/send/get/?usercode=8503034916&password=K8SWJH3E&gsmno='.$Tel.'&message='.urlencode($Pin.' pin kodu ile şifrenizi sıfırlayabilirsiniz. Hey Taksi.').'&msgheader=8503034916&dil=TR');

	echo json_encode(array(
		"status" => 'success',
		"reload" => 'false',
		'text' => "Lütfen telefonunuzu kontrol ediniz."
	));

	exit;

}

