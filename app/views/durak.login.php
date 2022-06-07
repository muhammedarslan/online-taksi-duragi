<?php

$gzip_pres = true; 
function gzipKontrol() 
{ 
	$kontrol = str_replace(" ","", 
		strtolower($_SERVER['HTTP_ACCEPT_ENCODING']) 
	); 
	$kontrol = explode(",", $kontrol); 
	return in_array("gzip", $kontrol); 
} 
function ClearSpace($kaynak) 
{ 
	return preg_replace("/\s+/", " ", $kaynak); 
} 
function CacheGzip($kaynak) 
{ 
	global $gzip_pres; 
	$sayfa_cikti = ClearSpace($kaynak); 
	if (!gzipKontrol() || headers_sent() || !$gzip_pres)  
		return $sayfa_cikti; 
	header("Content-Encoding: gzip"); 
	return gzencode($sayfa_cikti); 
}

ob_start("CacheGzip");

$RandomCode0 = random(32);
$RandomCode1 = random(32);
$RandomCode2 = random(32);
$RandomCode3 = random(32);
$RandomCode4 = random(32);
$RandomCode5 = random(32);

$RandomSelect = rand(0,5);

new_session();

$_SESSION['LoginPageRandomSelect'] = $RandomSelect;
$_SESSION['LoginPageRandom']       = ${'RandomCode'.$RandomSelect};


?>
<!DOCTYPE html>
<html lang="tr">
<head>
	<title>Durak Girişi | Online Taksi Durağı</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Yapay zeka destekli online taksi durağınızı oluşturun. Müşteri potansiyelinizi arttırın, gelirinizi katlayın.">

	<link rel="icon" type="image/png" href="/media/favicon.ico"/>
	
	<link rel="stylesheet" type="text/css" href="/assets/durak/l/vendor/bootstrap/css/bootstrap.min.css">
	
	<link rel="stylesheet" type="text/css" href="/assets/durak/l/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" type="text/css" href="/assets/durak/l/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	
	<link rel="stylesheet" type="text/css" href="/assets/durak/l/vendor/animate/animate.css">

	<link rel="stylesheet" type="text/css" href="/assets/durak/l/vendor/css-hamburgers/hamburgers.min.css">
	
	<link rel="stylesheet" type="text/css" href="/assets/durak/l/vendor/animsition/css/animsition.min.css">
	
	<link rel="stylesheet" type="text/css" href="/assets/durak/l/vendor/select2/select2.min.css">

	<link rel="stylesheet" type="text/css" href="/assets/durak/l/vendor/daterangepicker/daterangepicker.css">
	<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-borderless@1/borderless.css" rel="stylesheet" type="text/css"/>
	
	<link rel="stylesheet" type="text/css" href="/assets/durak/l/css/util.css">
	
	<link rel="stylesheet" type="text/css" href="/assets/durak/l/css/main.css">
	
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-83139045-12"></script>
	<div id="gtag">
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'UA-83139045-12');
		</script>
	</div>
</head>
<body style="background-color: #666666;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form action="javascript:;" method="post" class="login100-form validate-form">
					<span class="login100-form-title p-b-43">
						Lütfen giriş yapınız.
					</span>
					
					
					<div class="wrap-input100 validate-input" data-validate = "Kayıt olurken belirttiğiniz durak kimliği">
						<input class="input100" type="text" name="durakcode">
						<span class="focus-input100"></span>
						<span class="label-input100">Durağınızın kullanıcı adı</span>
					</div>
					
					
					<div class="wrap-input100 validate-input" data-validate="Bu alan zorunludur">
						<input class="input100" type="password" name="pass">
						<span class="focus-input100"></span>
						<span class="label-input100">Durağınızın şifresi</span>
					</div>

					<input type="text" value="<?=$RandomCode0?>" hidden name="pg0">
					<input type="text" value="<?=$RandomCode1?>" hidden name="pg1">
					<input type="text" value="<?=$RandomCode2?>" hidden name="pg2">
					<input type="text" value="<?=$RandomCode3?>" hidden name="pg3">
					<input type="text" value="<?=$RandomCode4?>" hidden name="pg4">
					<input type="text" value="<?=$RandomCode5?>" hidden name="pg5">
					<input type="text" value="login" hidden name="page" id="page" >

					<div class="flex-sb-m w-full p-t-3 p-b-32">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Beni hatırla
							</label>
						</div>

						<div>
							<a style="float: right;" href="/DurakYonetim/Giris?Sifremi=Unuttum" class="txt1">
								Şifremi unuttum?
							</a>
							
							<a style="float: right;margin-top: 15px;" href="/Basla" target="_blank" class="txt1">
								Hesabınız yok mu? 14 gün ücretsiz deneyin.
							</a>
						</div>
					</div>


					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Giriş Yap
						</button>
					</div>

					<div style="margin-top: 10px;" class="text-center p-t-46 p-b-20">
						<span class="txt2">
							&copy; 2019 | 	Online Taksi Durağı.
						</span>
					</div>

				</form>

				<div class="login100-more">
				</div>
			</div>
		</div>
	</div>





	
	<script src="/assets/durak/l/vendor/jquery/jquery-3.2.1.min.js"></script>
	
	<script src="/assets/durak/l/vendor/animsition/js/animsition.min.js"></script>
	
	<script src="/assets/durak/l/vendor/bootstrap/js/popper.js"></script>
	<script src="/assets/durak/l/vendor/bootstrap/js/bootstrap.min.js"></script>
	
	<script src="/assets/durak/l/vendor/select2/select2.min.js"></script>
	
	<script src="/assets/durak/l/vendor/daterangepicker/moment.min.js"></script>
	
	<script src="/assets/durak/l/vendor/daterangepicker/daterangepicker.js"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js" integrity="sha256-7OUNnq6tbF4510dkZHCRccvQfRlV3lPpBTJEljINxao=" crossorigin="anonymous"></script>
	
	<script src="/assets/durak/l/vendor/countdowntime/countdowntime.js"></script>
	
	<script src="/assets/durak/l/js/main.js"></script>

</body>
</html>