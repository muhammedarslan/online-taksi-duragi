<?php


$ServerName = explode('.', $_SERVER['SERVER_NAME']);

if ( $ServerName[0] != 'www' ) {
	header("HTTP/1.1 301 Moved Permanently");
	header("Location:https://www.onlinetaksiduragi.com".$_SERVER['REQUEST_URI']);
	exit;
}



define('ROOT_DIR'       , __DIR__                                            );
define('APP_DIR'        , ROOT_DIR .'/app'                                   );
define('CORE_DIR'       , APP_DIR  .'/core'                                  );
define('VDIR'           , APP_DIR  .'/views'                                 );
define('CDIR'           , APP_DIR  .'/controllers'                           );
define('TMPDIR'         , ROOT_DIR .'/assets/tmp'                            );
define('PROTOCOL'       , 'https://'                                         );
define('DOMAIN'         , 'www.onlinetaksiduragi.com'                        );
define('PATH'     	    , '/'				       	                         );

define('DB_HST'         , 'localhost'                                        );
define('DB_NME'         , ''                                             	 );
define('DB_CHR'         , 'utf8'                                             );
define('DB_USR'         , ''                                             	 );
define('DB_PWD'         , ''                                       			 );

define('RCPTCHA_STE'    ,''          										 );
define('RCPTCHA_KEY'    ,''          										 );

define('smtp_host'    	,'smtp.eu.mailgun.org'                               );
define('smtp_port'    	,'465'                                               );
define('smtp_secure'  	,'ssl'                                               );
define('smtp_username'	,'iletisim@bulten.onlinetaksiduragi.com'             );
define('smtp_password'	,'');
define('smtp_from'    	,'İletişim | Online Taksi Durağı'                    );

define('SMS_user_code'  ,''                                       			 );
define('SMS_password'   ,''                                          	 	 );


require_once CORE_DIR.'/load.app.php';
$App->run();


