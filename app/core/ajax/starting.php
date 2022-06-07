<?php


$Step = post('step');

require_once CORE_DIR.'/register.forms.php';


if ( $Step == 'step1' ) {


	$Username = post('username');
	$Pass     = password($_POST['pass']);

	if ( $Username == '' || post('pass') == '' ) {
		echo json_encode(array(
			'type'     => 'swal',
			'status'   => 'warning',
			'title'    => 'Bir hata oluştu!',
			'message'  => 'Lütfen boş alan bırakmayınız.'
		));
		exit;
	}


	$IsAccount = $db->query("SELECT * FROM users WHERE username = '{$Username}' and password='$Pass' ")->fetch(PDO::FETCH_ASSOC);
	if ( $IsAccount ){

		if ( $IsAccount['status'] == '1' || $IsAccount['status'] == '2' ) {
			// Aktif hesabı mevcut.

			echo json_encode(array(
				'type'     => 'swal',
				'status'   => 'info',
				'title'    => 'Aktif Hesabınız Mevcut !',
				'message'  => 'Bu bilgiler ile sistemimize zaten kayıt olmuşsunuz. Lütfen hesabınıza giriş yapınız.'
			));
			exit;

		} else {
			
			$Stat = $IsAccount['status'];

			new_session();
			$UserID = $IsAccount['id'];
			$_SESSION['RegisterUser'] = $UserID;

			if ( $Stat == '3' ) { 

				echo json_encode(array(
					'type'  => 'pass_step',
					'stepForm' => $FormStep2
				));
				exit;

			} else
			if ( $Stat == '4' ) { 

				echo json_encode(array(
					'type'  => 'pass_step',
					'stepForm' => $FormStep3
				));
				exit;

			} else
			if ( $Stat == '5' ) { 

				echo json_encode(array(
					'type'  => 'pass_step',
					'stepForm' => $FormStep4
				));
				exit;

			} else
			if ( $Stat == '6' ) { 

				echo json_encode(array(
					'type'  => 'pass_step',
					'stepForm' => $FormStep6
				));
				exit;

			}

		}

	} else {

		$IsAccount2 = $db->query("SELECT * FROM users WHERE username = '{$Username}' ")->fetch(PDO::FETCH_ASSOC);
		if ( $IsAccount2 ){ 

			// Dolu kullanıcı adı
			echo json_encode(array(
				'type'     => 'swal',
				'status'   => 'warning',
				'title'    => 'Kullanıcı adı kullanımda !',
				'message'  => 'Bu kullanıcı adı başka bir kullanıcı tarafından alınmış. Lütfen başka bir kullanıcı adı deneyiniz. Eğer bu kullanıcı adını kayıt aşamasında siz aldıysanız lütfen belirlediğiniz şifre devam ediniz.'
			));
			exit;

		} else {

			if ( strlen(post('pass')) < 5 ) {
				echo json_encode(array(
					'type'     => 'swal',
					'status'   => 'warning',
					'title'    => 'Güvensiz Şifre !',
					'message'  => 'Lütfen daha güçlü bir şifre oluşturun, oluşturduğunuz şifre çok kısa.'
				));
				exit;
			}

			$query = $db->prepare("INSERT INTO users SET
				username = ?,
				realname = ?,
				bossname = ?,
				avatar = ?,
				email = ?,
				phone_number = ?,
				password = ?,
				created_time = ?,
				finished_time = ?,
				packet = ?,
				sms_user = ?,
				sms_pass = ?,
				sms_title = ?,
				f_m = ?,
				e_m = ?,
				f_m_to_user = ?,
				msg1 = ?,
				msg2 = ?,
				msg3 = ?,
				msg4 = ?,
				msg5 = ?,
				msg6 = ?,
				last_login = ?,
				last_ip = ?,
				last_type = ?,
				address = ?,
				token = ?,
				mini_token = ?,
				ref = ?,
				status = ?");
			$insert = $query->execute(array(
				$Username,0,0,0,0,0,$Pass,time(),0,0,0,0,0,'Hey taksi','[]',"Selam, %Durak% \'ye hoş geldin. Bu senin ilk mesajın. Komutları görmek için yardım mesajını gönderebilirsin.","Tekrardan hoş geldin %MüşteriAdı%,  kayıtlı adresine taksi göndermemi ister misin?","Selam %MüşteriAdı%, sistemimde kayıtlı adresin şu şekilde: %MüşteriAdresi%","Yeni taksi çağırmak için Hey taksi mesajını, adres kaydetmek için ise yeni adres mesajını gönderebilirsin. Kullanabileceğin diğer mesajlar şu şekilde:  adresim, taksim nerede.","%TaksiPlakası% plakalı %TaksiTanımı% aracın yolda. Birkaç dakika içerisinde yanında olacaktır.","Ne demek istediğini anlayamadım, tekrar eder misin? Yardım için yardım mesajını gönderebilirsin.","%TaksiPlakası% plakalı %TaksiTanımı% aracımız seni almak için yola çıktı. Birkaç dakika içerisinde yanına gelecektir. Bizi tercih ettiğin için teşekkür ederiz.",time(),'::1','Register',0,random2(32),letter_id(),0,3
			));
			if ( $insert ){

				new_session();
				$UserID = $db->lastInsertId();
				$_SESSION['RegisterUser'] = $UserID;

				echo json_encode(array(
					'type'  => 'pass_step',
					'stepForm' => $FormStep2
				));
				exit;
			}  else {
				echo json_encode(array(
					'type'     => 'swal',
					'status'   => 'error',
					'title'    => 'Bir hata oluştu!',
					'message'  => 'Lütfen yeniden deneyiniz.'
				));
				exit;
			}

		}
	}
}  else if ( $Step == 'step2' ) {

	new_session();
	$UserID = $_SESSION['RegisterUser'];

	$Post1 = post('bir');
	$Post2 = post('iki');
	$Post3 = post('uc');

	if ( $Post1 == '' || $Post2 == '' || $Post3 == '' || !filter_var($Post3, FILTER_VALIDATE_EMAIL) ) {

		echo json_encode(array(
			'type'     => 'swal',
			'status'   => 'warning',
			'title'    => 'Bir hata oluştu!',
			'message'  => 'Lütfen tüm alanların doğruluğundan emin olunuz.'
		));
		exit;
	}

	$Post2 = '+90'.str_replace(array('(',')',' '), array('','',''), $Post2);

	$RefP = 0;
	
	if ( post('ref') != '' ) {
		$RefP = post('ref');
	}

	$query = $db->prepare("UPDATE users SET
		bossname = :bir,
		phone_number = :iki,
		email = :uc,
		ref = :bes,
		status = :dort
		WHERE id = :uid");
	$update = $query->execute(array(
		'uid' => $UserID,
		'bir' => $Post1,
		'iki' => $Post2,
		'uc' => $Post3,
		'dort' => 4,
		'bes' => $RefP
	));
	if ( $update ){
		echo json_encode(array(
			'type'  => 'pass_step',
			'stepForm' => $FormStep3
		));
		exit;
	} else {
		echo json_encode(array(
			'type'     => 'swal',
			'status'   => 'error',
			'title'    => 'Bir hata oluştu!',
			'message'  => 'Lütfen yeniden deneyiniz.'
		));
		exit;
	}



}  else if ( $Step == 'step3' ) {

	new_session();
	$UserID = $_SESSION['RegisterUser'];

	$Post1 = post('bir');
	$Post2 = post('iki');

	if ( $Post1 == '' || $Post2 == '' ) {

		echo json_encode(array(
			'type'     => 'swal',
			'status'   => 'warning',
			'title'    => 'Bir hata oluştu!',
			'message'  => 'Lütfen boş alan bırakmayınız.'
		));
		exit;
	}

	$Post1 = trim($Post1,' ');
	$Post2 = trim($Post2,' ');

	function replace_tr($text) {
		$text = trim($text);
		$search = array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü',' ');
		$replace = array('c','c','g','g','i','i','o','o','s','s','u','u','-');
		$new_text = str_replace($search,$replace,$text);
		return $new_text;
	}


	$query = $db->prepare("UPDATE users SET
		realname = :bir,
		avatar = :iki,
		packet = :uc,
		address = :dort,
		status = :bes
		WHERE id = :uid");
	$update = $query->execute(array(
		'uid' => $UserID,
		'bir' => $Post1,
		'iki' => 'default/'.mb_strtoupper(replace_tr(mb_substr($Post1, 0,1))).'.png',
		'uc' => 'free',
		'dort' => $Post2,
		'bes' => 5
	));
	if ( $update ){
		echo json_encode(array(
			'type'  => 'pass_step',
			'stepForm' => $FormStep4
		));
		exit;
	} else {
		echo json_encode(array(
			'type'     => 'swal',
			'status'   => 'error',
			'title'    => 'Bir hata oluştu!',
			'message'  => 'Lütfen yeniden deneyiniz.'
		));
		exit;
	}



}  else if ( $Step == 'step4' ) {

	new_session();
	$UserID = $_SESSION['RegisterUser'];

	$Post1 = post('bir');
	$Post2 = post('iki');

	if ( $Post1 == '' || $Post2 == '' ) {

		echo json_encode(array(
			'type'     => 'swal',
			'status'   => 'warning',
			'title'    => 'Bir hata oluştu!',
			'message'  => 'Lütfen boş alan bırakmayınız.'
		));
		exit;
	}



	$query = $db->prepare("INSERT INTO netgsm_accounts SET
		user_id = ?,
		username = ?,
		password = ?,
		last_time = ?");
	$insert = $query->execute(array(
		$UserID,$Post1,$Post2,time()
	));

	if ( $insert ){

		$query = $db->prepare("UPDATE users SET
			status = :bes
			WHERE id = :uid");
		$update = $query->execute(array(
			'uid' => $UserID,
			'bes' => 6
		));

		$SingleUser = $db->query("SELECT * FROM users WHERE id = '{$UserID}'")->fetch(PDO::FETCH_ASSOC);

		send_sms('default',$SingleUser['phone_number'],'Sayın '.$SingleUser['bossname'].', Online Taksi Durağı ailesine hoşgeldiniz. Hesabınızı aktif hale getirebilmek için son birkaç düzenleme yapıyoruz. Hesabınız aktif olur olmaz sizi yeniden bilgilendireceğiz. Anlayışınız için teşekkür eder, iyi günler dileriz.');

		echo json_encode(array(
			'type'  => 'pass_step',
			'stepForm' => $FormStep6
		));
		exit;
	} else {
		echo json_encode(array(
			'type'     => 'swal',
			'status'   => 'error',
			'title'    => 'Bir hata oluştu!',
			'message'  => 'Lütfen yeniden deneyiniz.'
		));
		exit;
	}



}  else if ( $Step == 'step5' ) {

	echo json_encode(array(
		'type'  => 'pass_step',
		'stepForm' => $FormStep5
	));
	exit;

}