<?php

$_Params['surucu'] = '---';

?>

<!DOCTYPE html>
<html lang="tr" >
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<meta name="description" content="Taksi durağı yönetim paneli" />
	<meta name="author" content="Muhammed Arslan" />
	<title>Taksi Yolcu Takibi</title>
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
	<!-- icons -->
	<link href="/assets/durak/plugins/simple-line-icons/simple-line-icons.min.css?v=1.0.1" rel="stylesheet" type="text/css" />
	<link href="/assets/durak/plugins/font-awesome/css/font-awesome.min.css?v=1.0.1" rel="stylesheet" type="text/css"/>

	<!--bootstrap -->
	<link href="/assets/durak/plugins/bootstrap/css/bootstrap.min.css?v=1.0.1" rel="stylesheet" type="text/css" />
	<!-- Material Design Lite CSS -->
	<link rel="stylesheet" href="/assets/durak/plugins/material/material.min.css?v=1.0.1">
	<link rel="stylesheet" href="/assets/durak/css/material_style.css?v=1.0.1">
	<link rel="stylesheet" href="/assets/durak/plugins/sweet-alert/sweetalert.min.css?v=1.0.1">
	<!-- animation -->
	<link href="/assets/durak/css/pages/animate_page.css?v=1.0.1" rel="stylesheet">
	<!-- Theme Styles -->

	<link href="/assets/durak/css/plugins.min.css?v=1.0.1" rel="stylesheet" type="text/css" />
	<link href="/assets/durak/css/style.css?v=1.0.1" rel="stylesheet" type="text/css" />
	<link href="/assets/durak/css/responsive.css?v=1.0.1" rel="stylesheet" type="text/css" />
	<link href="/assets/durak/css/theme-color.css?v=1.0.1" rel="stylesheet" type="text/css" />
	<link href="/assets/durak/css/pages/formlayout.css?v=1.0.1" rel="stylesheet" type="text/css" />
	<!-- favicon -->
	<link rel="shortcut icon" href="/media/favicon.ico" /> 
</head>
<body style="background-color: rgba(54, 70, 93, 0.99);" >


	<?php

	echo '<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-borderless@1/borderless.css" rel="stylesheet" type="text/css"/>';
	echo '<script
	src="https://code.jquery.com/jquery-3.4.1.min.js"
	integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
	crossorigin="anonymous"></script>';
	echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js" integrity="sha256-7OUNnq6tbF4510dkZHCRccvQfRlV3lPpBTJEljINxao=" crossorigin="anonymous"></script>';
	?>
	<script type="text/javascript">
		<?php

		if ( isset($_GET['p']) && $_GET['p'] != '' ) {
			?>

			async function swal() {

				$.post('/AjaxCall/ConfirmPin',{'pin':'<?=substr(clear($_GET['p']), 0,6)?>','taxi':'<?=$_Params[0]['token2']?>'},(data)=>{

					const json = JSON.parse(data);

					if ( json.status == 'success' ) {

						Swal.fire({
							title: "Doğrulama Başarılı!",
							html:'<strong>'+json.msg+'</strong>',
							showCancelButton: false,
							type:'success',
							showConfirmButton:false,
							allowEscapeKey:false,
							allowOutsideClick:false,
							closeOnConfirm: false,
							closeOnCancel: false
						}, function (isConfirm) {
							window.location = '?p=';
						});

						setTimeout(()=>{
							window.location = '?p=';
						},1500);

					} else {

						Swal.fire({
							title: "Doğrulama Başarısız!",
							html:'<strong>'+json.msg+'</strong>',
							showCancelButton: false,
							type:'error',
							showConfirmButton:true,
							allowEscapeKey:false,
							confirmButtonText:'Tamam',
							allowOutsideClick:false,
						}, function (isConfirm) {
							window.location = '?p=';
						});

						setTimeout(()=>{
							window.location = '?p=';
						},1500);

					}

				});

			} 
			<?php
		}  else {

			?>

			async function swal() {

				style ='letter-spacing: 34px;'+
				'text-align: center;'+
				'font-size: 30px;'+
				'font-weight: 600;';

				setTimeout(()=>{
					document.getElementsByClassName("swal2-input")[0].setAttribute("style",style);
					document.getElementsByClassName("swal2-input")[0].setAttribute("minlength",'6');
					document.getElementsByClassName("swal2-input")[0].setAttribute("maxlength",'6');

				},1000);

				const { value: ipAddress } = await Swal.fire({
					title: 'Lütfen pin giriniz',
					input: 'text',
					inputValue: '',
					allowOutsideClick:false,
					allowEscapeKey:false,
					confirmButtonText:'Devam et',
					showCancelButton: false,
					inputValidator: (value) => {
						if (!value) {
							return 'Lütfen boş bırakmayınız.'
						} else {

							if ( value.length < 6 ) {

								return 'Lütfen 6 karakter giriniz.'

							}

						}
					}
				})

				if (ipAddress) {

					$.post('/AjaxCall/ConfirmPin',{'pin':ipAddress,'taxi':'<?=$_Params[0]['token2']?>'},(data)=>{

						const json = JSON.parse(data);

						if ( json.status == 'success' ) {

							Swal.fire({
								title: "Doğrulama Başarılı!",
								html:'<strong>'+json.msg+'</strong>',
								showCancelButton: false,
								type:'success',
								showConfirmButton:false,
								allowEscapeKey:false,
								allowOutsideClick:false,
								closeOnConfirm: false,
								closeOnCancel: false
							}, function (isConfirm) {
								window.location = '?p=';
							});

							setTimeout(()=>{
								window.location = '?p=';
							},1500);

						} else {

							Swal.fire({
								title: "Doğrulama Başarısız!",
								html:'<strong>'+json.msg+'</strong>',
								showCancelButton: false,
								type:'error',
								showConfirmButton:true,
								allowEscapeKey:false,
								confirmButtonText:'Tamam',
								allowOutsideClick:false,
							}, function (isConfirm) {
								window.location = '?p=';
							});

							setTimeout(()=>{
								window.location = '?p=';
							},1500);

						}

					});

				}
			}
		<?php } ?>
		swal();
	</script>
	<?php
	echo '  </body>
	</html>';

	?>