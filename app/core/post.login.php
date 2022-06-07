<?php

ajax_check('post');


$DurakCode = post('DurakCod');
$RMB       = post('RMB');
$Pass      = password(post('Pass'));

new_session();

if ( !isset($_SESSION['LoginPageRandomSelect']) || !isset($_SESSION['LoginPageRandom']) ) {
	echo json_encode(array(
		"status" => 'error',
		"reload" => 'true',
		'text' => 'Lütfen yeniden deneyiniz.'
	));
	exit;
}

if ( post('Pg'.$_SESSION['LoginPageRandomSelect']) != $_SESSION['LoginPageRandom'] ) {
	echo json_encode(array(
		"status" => 'error',
		"reload" => 'true',
		'text' => 'Lütfen yeniden deneyiniz.'
	));
	exit;
}


$query = $db->query("SELECT * FROM users WHERE username='{$DurakCode}' and password = '{$Pass}' ")->fetch(PDO::FETCH_ASSOC);

if ( !$query ){
	echo json_encode(array(
		"status" => 'error',
		"reload" => 'false',
		'text' => 'Bu bilgiler ile eşleşen hesap Bulunamadı. <br><strong>Lütfen tekrar deneyiniz.</strong>'
	));
	exit;
} else {

	if ( $query['status'] == '2' ) {
		echo json_encode(array(
			"status" => 'error',
			"reload" => 'false',
			'text' => 'Bu hesap bazı nedenlerden dolayı bloke edilmiş. <br> Lütfen bizimle iletişime geçiniz.'
		));
		exit;

	}  else if ( $query['status'] != '1' ) {
		echo json_encode(array(
			"status" => 'error',
			"reload" => 'false',
			'text' => 'Hesabınız henüz kayıt aşamasında. Lütfen <a style="color:#ffffff;font-size:18px;" href="/Basla">Buraya tıklayarak</a> kayıt işlemlerine devam ediniz.'
		));
		exit;
	}
	else {

		session_regenerate_id();
		
		$_SESSION['SessionDurak'] = 'active';
		$_SESSION['Durak'] = (object) $query;

		$LastLoginUpdate = $db->prepare("UPDATE users SET
			last_login = :bir,
			last_ip = :iki,
			last_type = :uc
			WHERE id = :dort");
		$update = $LastLoginUpdate->execute(array(
			"bir" => time(),
			"iki" => get_ip(),
			"uc" => 'Giriş sayfası',
			"dort" => $query['id']
		));

		add_log($query['id'],'Giriş sayfası aracılığı ile giriş yapıldı.');


		if ( $RMB == 'true' ) {

			$UserID = $query['id'];
			$delete = $db->exec("DELETE FROM remember_me WHERE user_id = '$UserID' ");

			add_log($query['id'],'Beni hatırla anahtarı sıfırlandı.');

			$NewToken = random(46);

			$Insert2 = $db->prepare("INSERT INTO remember_me SET
				user_id = :bir,
				remember_token = :iki,
				expired_time = :uc,
				user_browser = :dort");
			$insert = $Insert2->execute(array(
				"bir" => $UserID,
				"iki" => $NewToken,
				"uc" => time()+604800,
				'dort' => md5($_SERVER['HTTP_USER_AGENT'])
				
			));

			setcookie("RMB", $NewToken, time() + 604801,'/',DOMAIN,false,true);


		}

		echo json_encode(array(
			"status" => 'success',
			"reload" => 'false'
		));
		exit;

	}

}


