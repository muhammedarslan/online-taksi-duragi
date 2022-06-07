<?php


$_LoginExplode = explode('/', rtrim(urldecode(strtok($_SERVER["REQUEST_URI"], '?')),'/'));

if ( isset($_LoginExplode[1]) && clear($_LoginExplode[1]) == 'DurakYonetim' ) {

	new_session();

	if ( !isset($_SESSION['SessionDurak']) || clear($_SESSION['SessionDurak']) != 'active' ) {

		if ( isset($_COOKIE['RMB']) && clear($_COOKIE['RMB']) != 'false' ) {

			$CookieToken = clear($_COOKIE['RMB']);
			$Browser     = md5($_SERVER['HTTP_USER_AGENT']);
			$time        = time();


			$query = $db->query("SELECT * FROM remember_me WHERE remember_token = '{$CookieToken}' and user_browser = '$Browser' and expired_time > $time ")->fetch(PDO::FETCH_ASSOC);
			if ( $query ){
				
				$SessionUser = $query['user_id'];
				
				session_regenerate_id();

				$query = $db->query("SELECT * FROM users WHERE id = '{$SessionUser}' and status='1' ")->fetch(PDO::FETCH_ASSOC);
				if ( $query ){

					$LastLoginUpdate = $db->prepare("UPDATE users SET
						last_login = :bir,
						last_ip = :iki,
						last_type = :uc
						WHERE id = :dort");
					$update = $LastLoginUpdate->execute(array(
						"bir" => time(),
						"iki" => get_ip(),
						"uc" => 'Otomatik giriş',
						"dort" => $query['id']
					));

					add_log($query['id'],'Beni hatırla anahtarı ile otomatik giriş yapıldı.');
					
					$_SESSION['SessionDurak'] = 'active';
					$_SESSION['Durak'] = (object) $query;
					reload();
					exit;

				} else {
					setcookie("RMB", 'false', time() -3600,'/',DOMAIN,false,true);
					header("Location:/DurakYonetim/Giris");
					exit;
				}

			} else {
				setcookie("RMB", 'false', time() -3600,'/',DOMAIN,false,true);
				header("Location:/DurakYonetim/Giris");
				exit;
			}

		} else {
			if ( @$_LoginExplode[2] != 'Giris' ) {

				header("Location:/DurakYonetim/Giris");
				exit;

			}
		}
	}
	new_session();
	$UID = @$_SESSION['Durak']->id;
}


if ( isset($_GET['load']) ) :

	if ( $_GET['load'] == 'inner' ) :
		
		if(empty(@$_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
			header("Content-type: application/json; charset=utf-8");
			http_response_code(401);
			echo json_encode(array(
				'HttpStatusCode' => 401,
				'ResponseType' => 'Error',
				'ResponseMessage' => 'This parameter only accepts ajax request.'
			));
			exit;
		} 

	endif;
endif;