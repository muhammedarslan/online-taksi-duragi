<?php

new_session();

$UserId = $_SESSION['Durak']->id;

if ( $UserId == '18' ){
	echo json_encode(array(
		'status' => 'failed',
		'reload' => false,
		'location' => false,
		'message' => 'Bazı güvenlik nedenlerinden dolayı demo modunda bu özelliği devre dışı bıraktık. Anlayışınız için teşekkür ederiz.'
	));
	exit;
} 

$Baslik = post('baslik');

$Msg = post('adres');

if ( $Baslik == '' || $Msg == '' ) {
	echo json_encode(array(
		'status' => 'error',
		'reload' => false,
		'location' => false,
		'message'   => 'Lütfen başlık ve mesaj alanını boş bırakmayınız.'
	));
	exit;
}

global $db;

$Msg = str_replace('%MüşteriAdı%', '', $Msg);
$Msg = str_replace('%MüşteriAdresi%', '', $Msg);
$Msg = str_replace('%Durak%', $_SESSION['Durak']->realname, $Msg);
$Msg = str_replace('%TaksiPlakası%', '' , $Msg);
$Msg = str_replace('%TaksiTanımı%', '' , $Msg);
$Msg = str_replace('%TaksiZamanı%', '' , $Msg);

if ( isset($_POST['usr_list']) ) {

	foreach ($_POST['usr_list'] as $user) {
		
		$result = file_get_contents('https://api.netgsm.com.tr/sms/send/get/?usercode='.$_SESSION['Durak']->sms_user.'&password='.$_SESSION['Durak']->sms_pass.'&gsmno='.$user.'&message='.urlencode(clear($Msg)).'&msgheader='.urlencode($Baslik).'&dil=TR');

		$query = $db->prepare("INSERT INTO sms_log SET
			sender_user = ?,
			receiver = ?,
			send_time = ?,
			code = ?,
			message = ?");
		$insert = $query->execute(array(
			$UserId,$user,time(),'111',$Msg
		));

		echo json_encode(array(
			'status' => 'success',
			'reload' => false,
			'location' => false,
			'message'   => 'Mesajlar kullanıcılara başarıyla gönderildi.'
		));

	}

} else {
	
	echo json_encode(array(
		'status' => 'error',
		'reload' => false,
		'location' => false,
		'message'   => 'Lütfen en az bir kullanıcı seçiniz.'
	));
	exit;

}