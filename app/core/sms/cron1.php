<?php


try {
	$db = new PDO("mysql:host=localhost;dbname=taxi;charset=utf8", 'root', '');
} catch ( PDOException $e ){
	die('System error...');
}

function clear($mVar)    {
	if(is_array($mVar)){
		foreach($mVar as $gVal => $gVar){
			if(!is_array($gVar)){
				$mVar[$gVal] = htmlspecialchars(strip_tags(urldecode(addslashes(stripslashes(stripslashes(trim(htmlspecialchars_decode($gVar))))))));  
			}else{
				$mVar[$gVal] = TemizVeri($gVar);
			}
		}
	}else{
		$mVar = htmlspecialchars(strip_tags(urldecode(addslashes(stripslashes(stripslashes(trim(htmlspecialchars_decode($mVar))))))));
	}
	return $mVar;

}

function seo_link($text) {
	$text  = str_replace('&', '', $text);
	$find = array("/Ğ/","/Ü/","/Ş/","/İ/","/Ö/","/Ç/","/ğ/","/ü/","/ş/","/ı/","/ö/","/ç/");
	$degis = array("G","U","S","I","O","C","g","u","s","i","o","c");
	$text = preg_replace("/[^0-9a-zA-ZÄzÜŞİÖÇğüşıöç]/"," ",$text);
	$text = preg_replace($find,$degis,$text);
	$text = preg_replace("/ +/"," ",$text);
	$text = preg_replace("/ /","-",$text);
	$text = preg_replace("/\s/","",$text);
	$text = strtolower($text);
	$text = preg_replace("/^-/","",$text);
	$text = preg_replace("/-$/","",$text);
	$text = str_replace('-amp-', '-', $text);
	return $text;
}

function send_sms($from,$to,$message,$Taksi = array('-','-','-')){

	$Err = false;
	$ErrText = '';
	$KAdi = '';
	$Sifre = '';
	$message = $message.' #'.rand(4,9533);

	$to = str_replace(array(' ','(',')'), '', $to);
	$to = '+'.$to;
	if ( substr($to, 0,1) != '+' ) {
		$to = '+'.$to;
	}

	global $db;

	if ( $from == 'default' ) {

		$KAdi  = SMS_user_code;
		$Sifre = SMS_password;
		$Title = SMS_user_code;

	} else {

		$query = $db->query("SELECT * FROM users WHERE id = '{$from}' and status='1' and sms_user != '' and sms_pass != '' ")->fetch(PDO::FETCH_ASSOC);

		if ( !$query ) {
			$Err = true;
			$ErrText .= ' --- Sistemde kullanıcı bulunamadı.';

		} else {

			$KAdi  = $query['sms_user'];
			$Sifre = $query['sms_pass'];
			$Title = $query['sms_title'];

		}

	}

	if ( $Err == false ) {
		$UID = $query['id'];
		$CheckContact = $db->query("SELECT * FROM contact WHERE phone_number = '$to' and user_id='$UID' and status=1 ")->fetch(PDO::FETCH_ASSOC);
		if ( $CheckContact ){
			$musteri = array(
				'Adı' => $CheckContact['realname'],
				'Adresi' => $CheckContact['adres']
			);
		} else {
			$musteri = array(
				'Adı' => '',
				'Adresi' => ''
			);
		}

		$message = str_replace('%MüşteriAdı%', $musteri['Adı'], $message);
		$message = str_replace('%MüşteriAdresi%', $musteri['Adresi'], $message);
		$message = str_replace('%Durak%', $query['realname'], $message);
		$message = str_replace('%TaksiPlakası%', $Taksi[0], $message);
		$message = str_replace('%TaksiTanımı%', $Taksi[1], $message);
		$message = str_replace('%TaksiZamanı%', $Taksi[2], $message);

		$result = file_get_contents('https://api.netgsm.com.tr/sms/send/get/?usercode='.$KAdi.'&password='.$Sifre.'&gsmno='.$to.'&message='.urlencode(clear($message)).'&msgheader='.$Title.'&dil=TR');

		if ( $result == '20' || $result == '30' || $result == '40' || $result == '70' ) {
			$Err = true;
			$ErrText .= ' --- Sms servisi bir hata döndürdü: '.$result;
		} 

	}

	$result = str_replace('00 ', '', $result);

	$query = $db->prepare("INSERT INTO sms_log SET
		sender_user = ?,
		receiver = ?,
		send_time = ?,
		code = ?,
		message = ?");
	$insert = $query->execute(array(
		$from,$to,time(),$result,$message
	));

	$ProcessId = $db->lastInsertId();

	return $ProcessId;

}



$SingleSMS = $db->query("SELECT * FROM incoming_messages WHERE status=1 ORDER by id ASC LIMIT 1 ")->fetch(PDO::FETCH_ASSOC);


if ( $SingleSMS ){

	$Object = (object) $SingleSMS;
	
	$UpdateQ = $db->prepare("UPDATE incoming_messages SET
		status = :new_stat
		WHERE id = :id");
	$Update = $UpdateQ->execute(array(
		"new_stat" => 2,
		"id" => $Object->id
	));


	if ( $Update ){
		
		$QueryUser = $db->query("SELECT * FROM users WHERE id='$Object->user_id' and status=1 ORDER by id ASC LIMIT 1 ")->fetch(PDO::FETCH_ASSOC);

		if ( $QueryUser ) {

			$IsFirstSms = $db->query("SELECT * FROM sms_log WHERE sender_user='$Object->user_id' and receiver='+$Object->phone_number' and code != '70' and code != '20' and code!='30' and code != '40' ORDER by id ASC LIMIT 1 ")->fetch(PDO::FETCH_ASSOC);

			if ( !$IsFirstSms ) {

				send_sms($QueryUser['id'],$Object->phone_number,$QueryUser['f_m_to_user']);

			}

			$UserMessage = mb_strtolower($Object->message);
			$UserPhoneNu = $Object->phone_number;
			$ucdakika = time() - 180;

			$RequestTaksi = $db->query("SELECT * FROM sms_request WHERE phone_number = '$UserPhoneNu' and req_type='taxi' and req_time > $ucdakika order by id DESC LIMIT 1 ")->fetch(PDO::FETCH_ASSOC);
			if ( $RequestTaksi ){

				$delete = $db->exec("DELETE FROM sms_request  WHERE phone_number = '$UserPhoneNu' and req_type='taxi' ");
				
				if ( $UserMessage == 'evet' ||  $UserMessage == ' evet' $UserMessage == 'evet ' $UserMessage == 'EVET' $UserMessage == 'onayla' $UserMessage == 'onayladım' $UserMessage == 'gönder' $UserMessage == 'istiyorum' ) {
					send_sms($QueryUser['id'],$Object->phone_number,'Taksi talebin başarıyla alındı ve durağa iletildi. Aracın hazır olduğunda tekrar bilgi vereceğiz.');
					$query = $db->prepare("INSERT INTO hey_taksi SET
						user_id =?,
						phone_number = ?,
						req_time = ?,
						taxi_id =?,
						taxi_time=?,
						status = ?,
						token = ?");
					$insert = $query->execute(array(
						$QueryUser['id'],'+'.$Object->phone_number,time(),0,0,1,bin2hex(openssl_random_pseudo_bytes(20))
					));
				} else {
					send_sms($QueryUser['id'],$Object->phone_number,'Taksi isteğin iptal edildi, daha sonra tekrar görüşmek üzere :)');
				}

			} else {


				$RequestAdres = $db->query("SELECT * FROM sms_request WHERE phone_number = '$UserPhoneNu' and req_type='adres' and req_time > $ucdakika order by id DESC LIMIT 1 ")->fetch(PDO::FETCH_ASSOC);

				if ( $RequestAdres ){

					$NameE = explode(',', $UserMessage);
					$Name  = @$NameE[0];
					$Adres = @$NameE[1];

					if ( @$Name != '' && $Adres != '' ) {
						send_sms($QueryUser['id'],$Object->phone_number,'Sistemimde kayıtlı ismini ve adresini başarıyla değiştirdim. Şimdi ne yapmak istiyorsun?');
						$delete = $db->exec("DELETE FROM sms_request  WHERE phone_number = '$UserPhoneNu' and req_type='adres' ");

						$query = $db->prepare("UPDATE contact SET
							realname = :bir,
							adres = :iki
							WHERE user_id = :uc and phone_number = :dort ");
						$update = $query->execute(array(
							"bir" => $Name,
							"iki" => $Adres,
							"uc" => $QueryUser['id'],
							"dort" => '+'.$UserPhoneNu
						));

					} else {
						$delete = $db->exec("DELETE FROM sms_request  WHERE phone_number = '$UserPhoneNu' and req_type='adres' ");
						send_sms($QueryUser['id'],$Object->phone_number,'Maalesef mesajını tanımlayamadım. Lütfen yeniden dener misin? İsmini yazdıktan sonra virgül koyup adresini yazman yeterli.');

					}

				} else {


					switch (seo_link(str_replace(' ', '', $UserMessage))) {
						case seo_link(str_replace(' ', '', mb_strtolower($QueryUser['f_m']))):

						$to = '+'.$UserPhoneNu;
						$UID = $QueryUser['id'];
						$CheckContact = $db->query("SELECT * FROM contact WHERE phone_number = '$to' and user_id='$UID' and status=1 ")->fetch(PDO::FETCH_ASSOC);
						if ( $CheckContact ) {

							send_sms($QueryUser['id'],$Object->phone_number,$QueryUser['msg1']);

							$query = $db->prepare("INSERT INTO sms_request SET
								phone_number = ?,
								req_type = ?,
								req_time = ?");
							$insert = $query->execute(array(
								$UserPhoneNu,'taxi',time()
							)); 
						} else {
							send_sms($QueryUser['id'],$Object->phone_number,'Lütfen önce seni tanımama izin verir misin? Bunun için yeni adres komutunu kullanabilirsin. Yardım için yardım komutunu kullanabilirsin.');
						}

						break;
						case 'taksim':
						$to = '+'.$UserPhoneNu;
						$UID = $QueryUser['id'];
						$CheckContact = $db->query("SELECT * FROM contact WHERE phone_number = '$to' and user_id='$UID' and status=1 ")->fetch(PDO::FETCH_ASSOC);
						if ( !$CheckContact ) {
							send_sms($QueryUser['id'],$Object->phone_number,'Lütfen önce seni tanımama izin verir misin? Bunun için yeni adres komutunu kullanabilirsin. Yardım için yardım komutunu kullanabilirsin.');
						} else {
							$Phn = '+'.$Object->phone_number;
							$CheckTaxi = $db->query("SELECT * FROM hey_taksi WHERE user_id='$Object->user_id' and phone_number = '$Phn' ")->fetch(PDO::FETCH_ASSOC);
							if ( $CheckTaxi ){

								if ( $CheckTaxi['status'] == 1 ) {
									send_sms($QueryUser['id'],$Object->phone_number,'Taksin hazır olunca sana bilgi vereceğiz.');
								} else {
									$Taksid = $CheckTaxi['taxi_id'];
									$SingleTaxi = $db->query("SELECT * FROM taxies WHERE id = '{$Taksid}'")->fetch(PDO::FETCH_ASSOC);
									if ( $SingleTaxi ){
										send_sms($QueryUser['id'],$Object->phone_number,$QueryUser['msg4'],array($SingleTaxi['plaka'],$SingleTaxi['arac'],$CheckTaxi['taxi_time']));
									} else {
										send_sms($QueryUser['id'],$Object->phone_number,$QueryUser['msg4']);
									}
								}
							} else {
								send_sms($QueryUser['id'],$Object->phone_number,'Senin için hazırlanmış bir taksi bulamadım. '.$QueryUser['f_m'].' komutu ile taksi talebinde bulunabilirsin.');
							}
						}
						break;
						case 'taksim-nerede':
						$to = '+'.$UserPhoneNu;
						$UID = $QueryUser['id'];
						$CheckContact = $db->query("SELECT * FROM contact WHERE phone_number = '$to' and user_id='$UID' and status=1 ")->fetch(PDO::FETCH_ASSOC);
						if ( !$CheckContact ) {
							send_sms($QueryUser['id'],$Object->phone_number,'Lütfen önce seni tanımama izin verir misin? Bunun için yeni adres komutunu kullanabilirsin. Yardım için yardım komutunu kullanabilirsin.');
						} else {
							$Phn = '+'.$Object->phone_number;
							$CheckTaxi = $db->query("SELECT * FROM hey_taksi WHERE user_id='$Object->user_id' and phone_number = '$Phn' ")->fetch(PDO::FETCH_ASSOC);
							if ( $CheckTaxi ){

								if ( $CheckTaxi['status'] == 1 ) {
									send_sms($QueryUser['id'],$Object->phone_number,'Taksin hazır olunca sana bilgi vereceğiz.');
								} else {
									$Taksid = $CheckTaxi['taxi_id'];
									$SingleTaxi = $db->query("SELECT * FROM taxies WHERE id = '{$Taksid}'")->fetch(PDO::FETCH_ASSOC);
									if ( $SingleTaxi ){
										send_sms($QueryUser['id'],$Object->phone_number,$QueryUser['msg4'],array($SingleTaxi['plaka'],$SingleTaxi['arac'],$CheckTaxi['taxi_time']));
									} else {
										send_sms($QueryUser['id'],$Object->phone_number,$QueryUser['msg4']);
									}
								}
							} else {
								send_sms($QueryUser['id'],$Object->phone_number,'Senin için hazırlanmış bir taksi bulamadım. '.$QueryUser['f_m'].' komutu ile taksi talebinde bulunabilirsin.');
							}
						}
						break;
						case 'adresim':
						$to = '+'.$UserPhoneNu;
						$UID = $QueryUser['id'];
						$CheckContact = $db->query("SELECT * FROM contact WHERE phone_number = '$to' and user_id='$UID' and status=1 ")->fetch(PDO::FETCH_ASSOC);
						if ( $CheckContact ) {

							send_sms($QueryUser['id'],$Object->phone_number,$QueryUser['msg2']);


						} else {
							send_sms($QueryUser['id'],$Object->phone_number,'Sistemde kayıtlı herhangi bir adresin bulunmuyor. Yeni adres eklemek için yeni adres komutunu kullanabilirsin.');
						}

						break;
						case 'yardim':
						
						send_sms($QueryUser['id'],$Object->phone_number,$QueryUser['msg3']);

						break;

						default:
						
						$Extra = json_decode($QueryUser['e_m']);
						$S_M = 0;

						if ( is_array($Extra) ) {

							foreach ($Extra as $row ) {
								
								if ( seo_link(str_replace(' ', '', $UserMessage)) == seo_link($row[0]) ) {
									send_sms($QueryUser['id'],$Object->phone_number,$row[1]);
									$S_M = 2;
									break;
								}

							}

						}

						if ( $S_M == 0 ) {
							send_sms($QueryUser['id'],$Object->phone_number,$QueryUser['msg5']);
						}

						break;
					}

				}
			}

			$query = $db->prepare("INSERT INTO sms_log SET
				sender_user = ?,
				receiver = ?,
				send_time = ?,
				code = ?,
				message = ?");
			$insert = $query->execute(array(
				'+'.$Object->phone_number,$QueryUser['id'],time(),-111,$Object->message
			));
		}
	}
}

sleep(1);

exit;
die();
?>