<?php


$router->get('/', function(){
	load_page('main.home');
});

$router->get('/Aktif/Msa', function(){
	new_session();
	if ( isset($_SESSION['Msa']) && $_SESSION['Msa'] == 'active' ) {
		load_page('msa');
	} else {
		?>
		<form action="/msa-post" method="post">
			<input type="text" name="key">
			<button type="submit" >Gönder</button>
		</form>
	</form>
	<?php
}
});

$router->post('/Aktif/Msa', function(){
	
	global $db;

	$ID = post('bir');

	$query = $db->prepare("UPDATE users SET
		finished_time = :fin,
		sms_user = :bir,
		sms_pass = :iki,
		sms_title = :uc,
		status = :dort
		WHERE id = :uid");
	$update = $query->execute(array(
		'uid' => $ID,
		'bir' => post('iki'),
		'iki' => post('uc'),
		'uc' => post('dort'),
		'dort' => 1,
		'fin' => time()+60*60*24*14
	));
	if ( $update ){

		$SingleUser = $db->query("SELECT * FROM users WHERE id = '{$ID}'")->fetch(PDO::FETCH_ASSOC);

		if ( $SingleUser['status'] == 1 ) {
			send_sms('default',$SingleUser['phone_number'],'Sayın '.$SingleUser['bossname'].', Online Taksi Durağınız tamamen hazırlandı ve 14 gün ücretsiz denemeniz başlatıldı. onlinetaksiduragi.com/taksi adresinden belirlediğiniz kullanıcı adı ve şifre ile panelinize giriş yapabilirsiniz. Bizi beklediğiniz için teşekkür ederiz, bol kazançlar dileriz.');
			echo json_encode(array(
				'type'     => 'swal',
				'status'   => 'success',
				'title'    => 'Başarıyla Tamamlandı !',
				'message'  => 'Kullanıcı başarıyla aktifleştirildi.'
			));
			exit;
		} else {

			echo json_encode(array(
				'type'     => 'swal',
				'status'   => 'error',
				'title'    => 'Bir hata oluştu!',
				'message'  => 'Status hatalı.'
			));
			exit;

		}

	} else {
		echo json_encode(array(
			'type'     => 'swal',
			'status'   => 'error',
			'title'    => 'Bir hata oluştu!',
			'message'  => 'Update hatası.'
		));
		exit;

	}

});

$router->post('/msa-post', function(){
	
	if ( password($_POST['key']) == 'd427a32b7baf70b7a475f31e60189ed7' ) {
		new_session();
		$_SESSION['Msa'] = 'active';
		header("Location:/Aktif/Msa");
		exit;
	} else {
		header("Location:/");
	}

});

$router->get('/Basla', function(){
	load_page('starting.home');
});

$router->get('/Ref', function(){

	if ( isset($_GET['exit']) ) {

		new_session();
		$_SESSION['Ref'] = 'false';
		header("Location:/Ref");
		exit;

	}
	
	new_session();
	if ( isset($_SESSION['Ref']) && $_SESSION['Ref'] == 'active' ) {
		load_page('ref.user',array(),'Referans Kullanıcılarınız');
	} else {
		load_page('ref');
	}

});

$router->get('/YeniRef', function(){

	load_page('ref.new',array(),'Yeni Referns Kullanıcısı');

});

$router->post('/YeniRef', function(){

	global $db;

	$post1 = post('realname');
	$post2 = post('username');
	$post3 = post('pass');

	if ( $post1 == '' || $post2 == '' || $post3 == ''  ) {
		echo json_encode(array(
			'type'     => 'swal',
			'status'   => 'warning',
			'title'    => 'Bir hata oluştu !',
			'message'  => 'Lütfen boş alan bırakmayınız'
		));
		exit;
	}


	$query = $db->query("SELECT * FROM referer_users WHERE username = '{$post2}'")->fetch(PDO::FETCH_ASSOC);
	if ( $query ){
		echo json_encode(array(
			'type'     => 'swal',
			'status'   => 'warning',
			'title'    => 'Bir hata oluştu !',
			'message'  => 'Bu kullanıcı adı zaten kullanılıyor.'
		));
		exit;
	}

	$query = $db->prepare("INSERT INTO referer_users SET
		username = ?,
		realname = ?,
		password = ?");
	$insert = $query->execute(array(
		$post2,$post1,password($_POST['pass'])
	));

	echo json_encode(array(
		'type'     => 'swal',
		'status'   => 'success',
		'title'    => 'Hesabınız başarıyla oluşturuldu!',
		'message'  => '<a style="color:#ffffff;font-size:1.125em;" href="/Ref">Buraya</a> tıklayarak giriş yapabilirsiniz.'
	));
	exit;

});

$router->post('/Ref', function(){
	ajax_check('post');

	global $db;

	new_session();

	if ( isset($_SESSION['Ref']) && $_SESSION['Ref'] == 'active' ) {

		require_once CORE_DIR.'/ajax/YeniRef.php';
		exit;
	}


	$Post1 = post('username');
	$Post2 = password($_POST['pass']);

	$query = $db->query("SELECT * FROM referer_users WHERE username = '{$Post1}' and password = '$Post2' ")->fetch(PDO::FETCH_ASSOC);
	if ( $query ){
		
		new_session();

		$_SESSION['Ref'] = 'active';
		$_SESSION['RefUser'] = $query;

		echo json_encode(array(
			'type'     => 'refsuccess'
		));
		exit;

	} else {
		echo json_encode(array(
			'type'     => 'swal',
			'status'   => 'warning',
			'title'    => 'Bir hata oluştu !',
			'message'  => 'Bilgiler ile eşleşen hesap bulunamadı.'
		));
		exit;
	}


});


$router->post('/Basla', function(){
	ajax_check('post');
	global $db;
	require_once CORE_DIR.'/ajax/starting.php';
});

$router->get('/DurakYonetim/Giris', function(){
	require_once CORE_DIR.'/route.login.php';
});

$router->get('/DurakYonetim/TelefonRehberi', function(){
	$Page_title = 'Telefon Rehberi | Online Taksi Durağı';
	load_page('durak.contact',array(),$Page_title);
});

$router->get('/PaymentSuccess', function(){
	require_once VDIR.'/payment.success.php';
});

$router->get('/pPaymentFailed', function(){
	echo 'Ödemeniz ile ilgili bir hata oluştu, lütfen bizimle iletişime geçiniz.';
});

$router->get('/DurakYonetim/Fatura', function(){

	require_once CORE_DIR.'/route.invoice.php';
	$Page_title = 'Fatura | Online Taksi Durağı';
	load_page('durak.invoice',array($query),$Page_title);
});

$router->get('/DurakYonetim/Whatsapp', function(){
	$Page_title = 'Whatsapp Oturumu | Online Taksi Durağı';
	load_page('durak.whatsapp',array(),$Page_title);
});

$router->get('/DurakYonetim/TopluMesaj', function(){
	$Page_title = 'Toplu Mesaj Gönder | Online Taksi Durağı';
	load_page('durak.multimessage',array(),$Page_title);
});

$router->post('/DurakYonetim/TopluMesaj', function(){
	require_once CORE_DIR.'/route.post.msg.php';
});

$router->post('/payment-callback', function(){
	
	require_once CORE_DIR.'/payment.callback.php';

});

$router->get('/DurakYonetim/PaymentIframe', function(){
	require_once CORE_DIR.'/ajax/PaymentIframe.php';
});

$router->get('/DurakYonetim/Odemeler', function(){
	$Page_title = 'Ödeme Yönetimi | Online Taksi Durağı';
	load_page('durak.payments',array(),$Page_title);
});

$router->get('/d/(.*?)', function($Tkn){

	require_once CORE_DIR.'/route.register.php';
	$Page_title = 'Yeni Müşteri Kaydı | Online Taksi Durağı';
	load_page('durak.register',array($User),$Page_title);
});

$router->post('/d/(.*?)', function($Tkn){

	require_once CORE_DIR.'/route.post.register.php';

});

$router->get('/t/(.*?)', function($Tkn){
	
	require_once CORE_DIR.'/route.get.taxi.php';

});

$router->get('/DurakYonetim/HeyTaksi', function(){
	$Page_title = 'Hey Taksi | Online Taksi Durağı';
	load_page('durak.heytaksi',array(),$Page_title);
});

$router->get('/DurakYonetim/Mesajlar', function(){
	$Page_title = 'Mesajlar | Online Taksi Durağı';
	load_page('durak.messages',array(),$Page_title);
});

$router->get('/DurakYonetim/Destek', function(){
	$Page_title = 'Destek | Online Taksi Durağı';
	load_page('durak.help',array(),$Page_title);
});

$router->post('/DurakYonetim/Destek', function(){
	global $db;
	require_once CORE_DIR.'/ajax/SendContact.php';
});

$router->get('/DurakYonetim/Ayarlar', function(){
	$Page_title = 'Sms Ayarları | Online Taksi Durağı';
	load_page('durak.settings',array(),$Page_title);
});

$router->get('/DurakYonetim/TaksiYonetimi', function(){
	$Page_title = 'Taksi Yönetimi | Online Taksi Durağı';
	load_page('durak.taksi.yonetimi',array(),$Page_title);
});

$router->get('/DurakYonetim/Profil', function(){
	$Page_title = 'Profil | Online Taksi Durağı';
	load_page('durak.profile',array(),$Page_title);
});

$router->post('/DurakYonetim/Profil', function(){

	require_once CORE_DIR.'/route.change.avatar.php';

});

$router->get('/DurakYonetim/TaksiYonetimi/YeniTaksi', function(){
	$Page_title = 'Yeni Taksi | Online Taksi Durağı';
	load_page('durak.new.taxi',array(),$Page_title);
});

$router->post('/DurakYonetim/Ayarlar', function(){
	
	ajax_check('post');
	global $db;
	require_once CORE_DIR.'/ajax/UpdateSMS.php';

});

$router->get('/DurakYonetim/TaksiYonetimi/TaksiDuzenle', function(){

	require_once CORE_DIR.'/route.edit.taxi.php';
	load_page('durak.edit.taxi',$query,$Page_title);
});

$router->get('/DurakYonetim/MesajIframe', function(){
	$Page_title = 'Mesaj | Online Taksi Durağı';
	global $db;
	require_once VDIR.'/message.iframe.php';
});

$router->get('/DurakYonetim/empty', function(){
	$Page_title = 'Empty | Online Taksi Durağı';
	echo '<br><br><center><img style="width:300px;" src="/media/taxi_loading.gif"/> ';
	echo '<h3 style="font-weight: 500;
	letter-spacing: 1px;" >Mesajlar yükleniyor...</h3></center>';
});

$router->get('/DurakYonetim/TelefonRehberi/KayıtsızNumaralar', function(){
	$Page_title = 'Kayıtsız Numaralar | Online Taksi Durağı';
	load_page('durak.unregistered.contact',array(),$Page_title);
});

$router->get('/DurakYonetim/Mesajlar/(.*?)', function($nmb){
	$Page_title = 'Sohbet | Online Taksi Durağı';
	load_page('durak.message',$nmb,$Page_title);
});

$router->get('/DurakYonetim/TelefonRehberi/YeniKayıt', function(){
	$Page_title = 'Yeni Kayıt | Online Taksi Durağı';
	load_page('durak.new.contact',array(),$Page_title);
});

$router->get('/DurakYonetim/TelefonRehberi/KayıtDuzenle', function(){
	$Page_title = 'Kayıt Düzenle | Online Taksi Durağı';

	global $db;
	global $UID;

	$ID = clear($_GET['ID']); 
	$query = $db->query("SELECT * FROM contact WHERE user_id = '{$UID}' and token='$ID' and status=1 ")->fetch(PDO::FETCH_ASSOC);
	if ( !$query ){
		header("Location:/DurakYonetim/TelefonRehberi");
		exit;
	}

	load_page('durak.edit.contact',$query,$Page_title);
});

$router->post('/DurakYonetim/TelefonRehberi/YeniKayıt', function(){


	$name  = post('name');
	$tel   = post('tel');
	$adres = post('adres');

	new_session();
	if ( $_SESSION['Durak']->id == '18' ){
		echo json_encode(array(
			'status' => 'failed',
			'reload' => false,
			'location' => false,
			'message' => 'Bazı güvenlik nedenlerinden dolayı demo modunda bu özelliği devre dışı bıraktık. Anlayışınız için teşekkür ederiz.'
		));
		exit;
	} 

	if ( $name == '' || $tel == '' || $adres == '' || strlen($tel) != 15 ) {

		echo json_encode(array(
			'status' => 'error',
			'reload' => false,
			'location' => false,
			'message' => 'Lütfen eksik veya hatalı alan bırakmayınız.'
		));
		exit;

	}

	$Tel = str_replace(array(' ','(',')'), array('','',''), $tel);
	$Tel = '+90'.$Tel;

	new_session();

	global $db;

	add_log($_SESSION['Durak']->id,'Rehbere yeni bir kişi eklendi. '.$name);

	$query = $db->prepare("INSERT INTO contact SET
		user_id = :bir,
		realname = :iki,
		phone_number = :uc,
		adres = :dort,
		sms_count = :bes,
		added_time = :alti,
		token = :sekiz,
		status = :yedi");
	$insert = $query->execute(array(
		"bir" => $_SESSION['Durak']->id,
		"iki" => $name,
		"uc" => $Tel,
		"dort" => $adres,
		"bes" => 0,
		"alti" => time(),
		"yedi" => 1,
		'sekiz'=> random(20)
	));
	if ( $insert ){
		echo json_encode(array(
			'status' => 'success',
			'reload' => false,
			'location' => '/DurakYonetim/TelefonRehberi',
			'message' => 'Yeni kişi <strong>'.$name.'</strong> başarıyla eklendi.'
		));
		exit;
	} else {
		http_response_code(401);
	}

});

$router->post('/DurakYonetim/TaksiYonetimi/YeniTaksi', function(){
	ajax_check('post');

	$plaka  = post('plaka');
	$arac   = post('bilgi');
	$surucu = post('surucu');
	$tel    = post('tel');

	new_session();
	if ( $_SESSION['Durak']->id == '18' ){
		echo json_encode(array(
			'status' => 'failed',
			'reload' => false,
			'location' => false,
			'message' => 'Bazı güvenlik nedenlerinden dolayı demo modunda bu özelliği devre dışı bıraktık. Anlayışınız için teşekkür ederiz.'
		));
		exit;
	} 

	$Random1 = rand(1,9);
	$Random2 = rand(0,9);
	$Random3 = rand(0,9);
	$Random4 = rand(0,9);
	$Random5 = rand(0,9);
	$Random6 = rand(0,9);

	$parola = $Random1.$Random2.$Random3.$Random4.$Random5.$Random6;

	if ( $parola == '' || $surucu == '' || $arac == '' || $plaka == '' || $tel == '' ) {

		echo json_encode(array(
			'status' => 'error',
			'reload' => false,
			'location' => false,
			'message' => 'Lütfen eksik veya hatalı alan bırakmayınız.'
		));
		exit;

	}

	$Tel = str_replace(array(' ','(',')'), array('','',''), $tel);
	$Tel = '+90'.$Tel;

	$Token2 = letter_id();

	send_sms('default',$Tel,'Sayın '.$surucu.', '.$plaka.' plakalı taksi için bilgi ekranına onlinetaksiduragi.com/t/'.$Token2.'?p='.$parola.' adresinden '.$parola.' pin kodu ile ulaşabilirsiniz.');

	new_session();

	global $db;

	add_log($_SESSION['Durak']->id,'Yeni bir taksi eklendi. '.$plaka);

	$query = $db->prepare("INSERT INTO taxies SET
		user_id = :bir,
		plaka = :iki,
		arac = :uc,
		surucu = :dort,
		telefon= :sekiz,
		password = :bes,
		token = :alti,
		token2 = :alti2,
		status = :yedi");
	$insert = $query->execute(array(
		"bir" => $_SESSION['Durak']->id,
		"iki" => $plaka,
		"uc" => $arac,
		"dort" => $surucu,
		"bes" => password($parola),
		"alti" => random(15),
		"alti2" => $Token2,
		"yedi" => 1,
		'sekiz'=> $Tel
	));
	if ( $insert ){
		echo json_encode(array(
			'status' => 'success',
			'reload' => false,
			'location' => '/DurakYonetim/TaksiYonetimi',
			'message' => 'Yeni taksiniz <strong>'.$plaka.'</strong> başarıyla eklendi.'
		));
		exit;
	} else {
		http_response_code(401);
	}

});

$router->post('/DurakYonetim/TelefonRehberi/KayıtDuzenle', function(){

	$ID = clear($_GET['ID']);

	new_session();
	if ( $_SESSION['Durak']->id == '18' ){
		echo json_encode(array(
			'status' => 'failed',
			'reload' => false,
			'location' => false,
			'message' => 'Bazı güvenlik nedenlerinden dolayı demo modunda bu özelliği devre dışı bıraktık. Anlayışınız için teşekkür ederiz.'
		));
		exit;
	} 


	$name  = post('name');
	$tel   = post('tel');
	$adres = post('adres');

	if ( $name == '' || $tel == '' || $adres == '' || strlen($tel) != 15 ) {

		echo json_encode(array(
			'status' => 'error',
			'reload' => false,
			'location' => false,
			'message' => 'Lütfen eksik veya hatalı alan bırakmayınız.'
		));
		exit;

	}

	$Tel = str_replace(array(' ','(',')'), array('','',''), $tel);
	$Tel = '+90'.$Tel;

	new_session();

	global $db;

	add_log($_SESSION['Durak']->id,'Rehberdeki kişi düzenlendi. '.$name);

	$query = $db->prepare("UPDATE contact SET
		realname = :iki,
		phone_number = :uc,
		adres = :dort WHERE user_id =:bir and token=:bes ");
	$insert = $query->execute(array(
		"bir" => $_SESSION['Durak']->id,
		"iki" => $name,
		"uc" => $Tel,
		"dort" => $adres,
		"bes" => $ID
	));
	if ( $insert ){
		echo json_encode(array(
			'status' => 'success',
			'reload' => false,
			'location' => '/DurakYonetim/TelefonRehberi',
			'message' => 'Rehberdeki kişi <strong>'.$name.'</strong> başarıyla güncellendi.'
		));
		exit;
	} else {
		http_response_code(401);
	}

});

$router->post('/DurakYonetim/TaksiYonetimi/TaksiDuzenle', function(){

	$ID = clear($_GET['ID']);

	new_session();
	if ( $_SESSION['Durak']->id == '18' ){
		echo json_encode(array(
			'status' => 'failed',
			'reload' => false,
			'location' => false,
			'message' => 'Bazı güvenlik nedenlerinden dolayı demo modunda bu özelliği devre dışı bıraktık. Anlayışınız için teşekkür ederiz.'
		));
		exit;
	} 


	$plaka  = post('plaka');
	$arac   = post('bilgi');
	$surucu = post('surucu');
	$parola = post('parola2');

	if (  $surucu == '' || $arac == '' || $plaka == '' ) {

		echo json_encode(array(
			'status' => 'error',
			'reload' => false,
			'location' => false,
			'message' => 'Lütfen eksik veya hatalı alan bırakmayınız.'
		));
		exit;

	}

	new_session();

	global $db;

	if ( $parola != '' ) {

		$query = $db->prepare("UPDATE taxies SET
			password = :iki WHERE user_id=:bir and token=:alti ");
		$insert2 = $query->execute(array(
			"bir" => $_SESSION['Durak']->id,
			"iki" => password($parola),
			"alti" => $ID
		));

	}

	add_log($_SESSION['Durak']->id,'Kayıtlı taksi düzenlendi. '.$plaka);

	$query = $db->prepare("UPDATE taxies SET
		plaka = :iki,
		arac = :uc,
		surucu = :dort WHERE user_id=:bir and token=:alti ");
	$insert = $query->execute(array(
		"bir" => $_SESSION['Durak']->id,
		"iki" => $plaka,
		"uc" => $arac,
		"dort" => $surucu,
		"alti" => $ID
	));
	if ( $insert ){
		echo json_encode(array(
			'status' => 'success',
			'reload' => false,
			'location' => '/DurakYonetim/TaksiYonetimi',
			'message' => 'Taksi <strong>'.$plaka.'</strong> başarıyla güncellendi.'
		));
		exit;
	} else {
		http_response_code(401);
	}

});

$router->get('/DurakYonetim/Cikis', function(){
	$Page_title = 'Cıkış | Online Taksi Durağı';
	sleep(2);
	new_session();
	$UserID = $_SESSION['Durak']->id;
	global $db;
	$delete = $db->exec("DELETE FROM remember_me WHERE user_id = '$UserID' ");
	$_SESSION['SessionDurak'] = 'false';
	session_destroy();
	header("refresh:3;url=/DurakYonetim/Giris");
	echo 'Başarıyla çıkış yaptınız, yönlendiriliyorsunuz...';
	exit;

});

$router->get('/DurakYonetim/Bildirim/(.*?)', function($token){
	$Page_title = 'Yönlendiriliyorsunuz | Online Taksi Durağı';
	global $db;

	new_session();
	$Sid = $_SESSION['Durak']->id;
	$query = $db->query("SELECT * FROM notifications WHERE token = '{$token}' and user_id='$Sid' ")->fetch(PDO::FETCH_ASSOC);
	if ( $query ){

		$query2 = $db->prepare("UPDATE notifications SET
			status = :bir,
			notif_icon= :uc
			WHERE id = :iki");
		$update = $query2->execute(array(
			"bir" => 1,
			"iki" => $query['id'],
			"uc"  => '<span class="notification-icon circle blue-bgcolor"><i class="fa fa-check"></i></span>'
		));

		header("Location:".$query['notif_url']);
		
	} else {
		header("Location:/DurakYonetim");
	}

});


$router->get('/AjaxCall/([a-zA-Z0-9-ZÇŞĞÜÖİçşğüöı-]+)', function($Url){

	header("Content-type: application/json; charset=utf-8");
	http_response_code(401);
	echo json_encode(array(
		'HttpStatusCode' => 401,
		'ResponseType' => 'Error',
		'ResponseMessage' => 'OAuth2 authentication required',
		'AdministratorContact' => 'msa@muhammedarslan.com.tr'
	));
	exit;

});

$router->post('/AjaxCall/([a-zA-Z0-9-ZÇŞĞÜÖİçşğüöı-]+)', function($Url){

	ajax_check('post');

	new_session();

	if ( $Url != 'ContactForm' ) {
		if ( $Url != 'ConfirmPin' ) {
			if ( $Url != 'FindAddress' ) {
				if ( !isset($_SESSION['SessionDurak']) ) {

					http_response_code(403);
					exit;
				}
			}
		}
	}

	if ( file_exists(CORE_DIR.'/ajax/'.$Url.'.php') ) :

		global $db;

		require_once CORE_DIR.'/ajax/'.$Url.'.php';

	else :

		http_response_code(403);

	endif;

});

$router->post('/DurakYonetim/Giris/Ajax', function(){
	new_session();
	if ( isset($_SESSION['SessionDurak']) ) {
		header("Location:/DurakYonetim"); exit;
	}

	global $db;
	require_once CORE_DIR.'/post.login.php';

});

$router->post('/DurakYonetim/arama', function(){

	$query = post('q');
	header("Location:/DurakYonetim/ara/".urlencode($query));

});

$router->post('/DurakYonetim/Giris/Post', function(){
	new_session();
	if ( isset($_SESSION['SessionDurak'])  ) {
		header("Location:/DurakYonetim"); exit;
	}

	if ( clear(@$_SESSION['Adım2-session']) != 'active' ) {
		header("Location:/DurakYonetim"); exit;
	}

	$_SESSION['Adım2-session'] = 'false';

	if ( post('pin') == @$_SESSION['lost_reset_pin'] && @$_SESSION['lost_send_time'] > time() ) {

		load_page('durak.lost.pass.3');
		$_SESSION['reset_allow'] = 'true';


	} else {

		echo "<script>alert('Pin kodu geçersiz !');window.location='/DurakYonetim/Giris?Sifremi=Unuttum';</script>";

	}

	$_SESSION['lost_reset_pin'] = 'none';	

});

$router->post('/DurakYonetim/Giris/Post2', function(){

	new_session();
	if ( isset($_SESSION['SessionDurak'])  ) {
		header("Location:/DurakYonetim"); exit;
	}

	if ( clear(@$_SESSION['reset_allow']) != 'true' ) {
		header("Location:/DurakYonetim"); exit;
	}

	$_SESSION['reset_allow'] = 'false-none';



	if ( isset($_POST['pass']) && strlen(clear(@$_POST['pass'])) > 4 ) {

		global $db;
		$User = @$_SESSION['reset_pass_user'];
		$NP   = password(@$_POST['pass']);



		$query = $db->prepare("UPDATE users SET
			password = :bir
			WHERE id = :iki");
		$update = $query->execute(array(
			"bir" => $NP,
			"iki" => $User
		));

		add_log($User,'ŞİFRENİZ DEĞİŞTİRİLDİ.');

		session_destroy();

		if ( $update ) {
			load_page('durak.lost.pass.4');
			exit;
		} else {
			echo "<script>alert('Lütfen daha güçlü bir şifre belirleyiniz !');window.location='/DurakYonetim/Giris?Sifremi=Unuttum';</script>";
			exit;
		}

	} else {
		echo "<script>alert('Lütfen daha güçlü bir şifre belirleyiniz !');window.location='/DurakYonetim/Giris?Sifremi=Unuttum';</script>";
		exit;
	}


});

$router->post('/DurakYonetim/Giris/Ajax2', function(){
	new_session();
	if ( isset($_SESSION['SessionDurak']) ) {
		header("Location:/DurakYonetim"); exit;
	}

	global $db;
	require_once CORE_DIR.'/post.lost.password.php';

});

$router->get('/DurakYonetim', function(){
	$Page_title = 'Anasayfa | Online Taksi Durağı';
	load_page('durak.home',array(),$Page_title);
});


$router->get('/taksi-durağı', function(){
	header("Location:/DurakYonetim");
	exit;
});

$router->get('/taksici', function(){
	header("Location:/DurakYonetim");
	exit;
});

$router->get('/taksi', function(){
	header("Location:/DurakYonetim");
	exit;
});