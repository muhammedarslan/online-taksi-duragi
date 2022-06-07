<!DOCTYPE html>
<html lang="tr">
<head>
	<title>Şifremi Unuttum | Online Taksi Durağı</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Yapay zeka destekli online taksi durağınızı oluşturun. Müşteri potansiyelinizi arttırın, gelirinizi katlayın.">
	<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="/media/favicon.ico"/>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/assets/durak/l/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/assets/durak/l/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/assets/durak/l/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/assets/durak/l/vendor/animate/animate.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="/assets/durak/l/vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/assets/durak/l/vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/assets/durak/l/vendor/select2/select2.min.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="/assets/durak/l/vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/assets/durak/l/css/util.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/assets/durak/l/css/main.css">
	<!--===============================================================================================-->
</head>
<body style="background-color: #666666;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form action="javascript:;" method="post" class="login100-form validate-form">
					<span class="login100-form-title p-b-43">
						Şifremi Sıfırla
					</span>
					
					
					<div class="wrap-input100 validate-input" data-validate = "Lütfen geçerli bir telefon numarası giriniz">
						<input id="TlfMask" class="input100" type="text" name="tel">
						<span class="focus-input100"></span>
						<span class="label-input100">Güvenli Telefon Numaranız</span>
					</div>
					
					<div class="flex-sb-m w-full p-t-3 p-b-32">
						<div class="contact100-form-checkbox">
						</div>

						<div>
							<a href="/DurakYonetim/Giris" class="txt1">
								Giriş sayfasına geri git
							</a>
						</div>
					</div>

					<center>
						<div style="margin: 20px;" class="g-recaptcha" data-sitekey="<?=RCPTCHA_STE?>"></div>
					</center>					

					<div id="lost_pass_button" class="container-login100-form-btn">
						<button class="login100-form-btn">
							Sonraki Adım
						</button>
					</div>
					
					<div class="text-center p-t-46 p-b-20">
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
	
	

	
	
	<!--===============================================================================================-->
	<script src="/assets/durak/l/vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="/assets/durak/l/vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="/assets/durak/l/vendor/bootstrap/js/popper.js"></script>
	<script src="/assets/durak/l/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="/assets/durak/l/vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="/assets/durak/l/vendor/daterangepicker/moment.min.js"></script>
	<!--===============================================================================================-->
	<script src="/assets/durak/l/vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.13.6/dist/sweetalert2.all.min.js" integrity="sha256-/G2z6UkcmktdqEG/Cv8/6Ww0MQHK3yPIcNW6ugcfpd4=" crossorigin="anonymous"></script>
	<!--===============================================================================================-->
	<script src="/assets/durak/l/vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
	<script src="/assets/durak/l/js/main.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js" id="theapp"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
	<script src="https://www.google.com/recaptcha/api.js?hl=tr"></script>

	<script type="text/javascript">

		$(document).ready(function()
		{
			$("#TlfMask").mask("(999) 999 99 99");
		})
	</script>

</body>
</html>