<!DOCTYPE html>
<html lang="tr">
<head>
	<title>Hesap Oluştur | Online Taksi Durağı</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="/media/favicon.ico"/>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/assets/b/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/assets/b/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/assets/b/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/assets/b/vendor/animate/animate.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="/assets/b/vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/assets/b/vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/assets/b/vendor/select2/select2.min.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="/assets/b/vendor/daterangepicker/daterangepicker.css">
	<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-borderless@1/borderless.css" rel="stylesheet" type="text/css"/>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/assets/b/css/util.css">
	<link rel="stylesheet" type="text/css" href="/assets/b/css/main.css">
	<!--===============================================================================================-->
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
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url('/media/home/basla.jpeg');">
					<span class="login100-form-title-1">
						14 Gün Ücretsiz Deneyin
					</span>
				</div>
				<br>
				<div id="step_div">
					<?php

					require_once CORE_DIR.'/register.forms.php';

					echo $FormStep1;

					?>
				</div>
			</div>
		</div>
	</div>
	
	<!--===============================================================================================-->
	<script src="/assets/b/vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="/assets/b/vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="/assets/b/vendor/bootstrap/js/popper.js"></script>
	<script src="/assets/b/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="/assets/b/vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="/assets/b/vendor/daterangepicker/moment.min.js"></script>
	<script src="/assets/b/vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="/assets/b/vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
	<script src="/assets/b/js/main.js?v=1.0.1"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js" integrity="sha256-7OUNnq6tbF4510dkZHCRccvQfRlV3lPpBTJEljINxao=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js?v=1.0.1" id="theapp"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js?v=1.0.1"></script>

</body>
</html>