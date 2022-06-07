<?php

include('durak.header.php');

new_session();

$UID = $_SESSION['Durak']->id;

?>
<div class="page-content-wrapper">
	<div class="page-content">
		<div class="page-bar">
			<div class="page-title-breadcrumb animated fadeIn">
				<div class=" pull-left">
					<div class="page-title"><strong style="font-weight: 600;" >Whatsapp Oturumu</div>
					</div>
					<ol class="breadcrumb page-breadcrumb pull-right">
						<li><a class="parent-item"  onclick="InnerPage(this); return false;" href="/DurakYonetim"><i class="fa fa-taxi"></i>&nbsp;- <?=say($_SESSION['Durak']->realname)?></a>&nbsp;<i class="fa fa-angle-right"></i>
						</li>
						<li class="active">Whatsapp Oturumu</li>
					</ol>
				</div>
			</div>
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/css/lightbox.min.css" integrity="sha256-tBxlolRHP9uMsEFKVk+hk//ekOlXOixLKvye5W2WR5c=" crossorigin="anonymous" />
			<?php

			$Check = @file_get_contents('https://www.waboxapp.com/api/status/90'.$_SESSION['Durak']->sms_user.'?token=cb7cb4026e9cfe8fbe17a51abddc1a805d6f8c709c9c0&random='.time());

			$JsonD = json_decode($Check);

			if ( $UID == '18' ) {
				?>
				<center>
					<div class="page-title"><strong style="font-weight: 600;" >
					Demo modu için whatsapp devre dışı bırakılmıştır.</strong><p>
						<strong style="font-weight: 600;" >
						Bazı güvenlik nedenlerinden dolayı demo modunda bu özelliği devre dışı bıraktık. Anlayışınız için teşekkür ederiz.</strong>
					</div></center>
					<?php

				} else {

					if ( isset($JsonD->success) && $JsonD->success == 'true' ) {

						?>

						<center><img src="/media/wp.png">
							<div class="page-title"><strong style="font-weight: 600;" >
							Whatsapp oturumunuz Aktif.</strong><p>
								<strong style="font-weight: 600;" >
								Mesajlar otomatik olarak ayarladığınız şekilde cevaplanmaktadır.</strong>
							</div></center>

							<?php

						} else {

							?>


							<div class="row animated fadeIn">
								<div class="col-md-12">

									<!-- BEGIN PROFILE CONTENT -->
									<div class="profile-content">
										<div class="row animated fadeIn">
											<div style="width: 100%;" class="card">
												<div class="card-topline-aqua">
													<header></header>
												</div>
												<div class="white-box">
													<div style="margin-top:-22px;text-align: center;" class="profile-usertitle-name">Whatsapp Oturumu</div>
													<div style="text-align: center;" class="profile-usertitle-job">Müşterileriniz ile whatsapp üzerinden iletişime geçin.</div>
													<!-- Tab panes -->
													<div class="tab-content">
														<div class="tab-pane active fontawesome-demo" id="tab1">
															<div id="biography" >
																<hr>

																<center><p>&#xb7; Müşterileriniz sms ile taksi çağırabildikleri gibi whatsapp ile de taksi çağırabilirler. Bunun için whatsapp oturumunuzu birkaç adımda hazır hale getirebilirsiniz.</p></center>

																<br><div style="margin-bottom: 25px;" class="alert alert-info">
																	<center>  Whatsapp oturumunuzu hazır hale getirmek için lütfen aşağıdaki adımları takip edin.
																	</center>
																</div>

																<center>

																	<p>1 - Whatsapp Business uygulamasını Android Market veya App Store'den indirin.</p>

																	<p>2 - Whatsapp, telefon numaranızı doğrulamak için firma numaranızı isteyecektir. Buraya Netgsm'den aldığınız numaranızı giriniz.</p>

																	<p>3 - Netgsm kullanıcı adı ve şifreniz ile Netgsm Webportal'dan Sabit Telefon > Ayarlar menüsünden yönlendirilecek numarayı kendi cep telefonunuzu giriniz. (Whatsapp'dan gelecek doğrulama kodunu cep numaranızdan dinlemek içindir. Doğrulama işleminden sonra yönlendirmeyi kaldırabilirsiniz.)</p>

																	<p>4 -  Beni Ara butonunun aktif olması için sürenin bitmesini bekleyin ve Beni Ara butonuna basınız. Whatsapp'dan gelen çağrıyı dinleyerek doğrulama kodunuzu giriniz.</p>

																	<hr>
																	<p><strong>Whatsapp oturumunuzu başarıyla oluşturdunuz, devam edelim.</strong></p>
																	<hr>

																	<p>5 - <a target="_blank" href="https://www.google.com/chrome/">Google Chrome</a> web tarayıcısını açınız. <p>Şu anda sadece chrome üzerinden oturumunuza erişebiliyoruz, en kısa zamanda tüm tarayıcılar için destek getireceğiz.</p>

																	<p>6 - Chrome web mağazasına giriniz ve <a target="_blank" href="https://chrome.google.com/webstore/detail/waboxapp/mgaecjklgnbkkdfnfpncgnogplnjjcdh">waboxapp</a> eklentisini tarayıcınıza kurunuz. <a target="_blank" href="https://chrome.google.com/webstore/detail/waboxapp/mgaecjklgnbkkdfnfpncgnogplnjjcdh">Buraya tıklayabilirsiniz.</a>
																	</p>
																	<a href="/media/wp/bir.png" data-lightbox="image-1" data-title="waboxapp eklentisini kurunuz."><img style="width: 60%;margin-top: 20px;" src="/media/wp/bir.png"></a>
																	<br>
																	<p>7 - Eklenti kurulumunu tamamladıktan sonra sağ üst tarafta waboxapp simgesine tıklayınız ve Enter your waboxapp API key linkine tıklayınız.</p>
																	<a href="/media/wp/iki.png" data-lightbox="image-1" data-title="waboxapp eklentisi ayarları."><img style="width: 60%;margin-top: 20px;" src="/media/wp/iki.png"></a>
																	<br>
																	<br>
																	<p>8 - Açılan sayfada <strong>cb7cb4026e9cfe8fbe17a51abddc1a805d6f8c709c9c0</strong> anahtarını giriniz ve validate butonuna tıklayınız.</p>
																	<a href="/media/wp/uc.png" data-lightbox="image-1" data-title="waboxapp eklentisi ayarları."><img style="width: 60%;margin-top: 20px;" src="/media/wp/uc.png"></a>
																	<br>
																	<hr>
																	<p><strong>Her şey tamam, artık sadece tek bir adım kaldı.</strong></p>
																	<hr>

																	<p>9 - <a target="_blank" href="https://web.whatsapp.com/">web.whatsapp.com</a> adresine giriniz ve karekodu telefonunuza okutarak whatsapp web oturumunu başlatınız.</p>
																	<a href="/media/wp/dort.png" data-lightbox="image-1" data-title="Whatsapp web."><img style="width: 60%;margin-top: 20px;" src="/media/wp/dort.png"></a>
																	<br>
																	<hr>
																	<p><strong>Artık müşterileriniz whatsapp üzerinden taksi talebinde bulunabilirler.<p> Mesajlar otomatik olarak Mesaj Ayarları sayfasında hazırladığınız şekilde cevaplanır.</strong></p>
																	<hr>
																	<a style="margin-left: 20px;" href="javascript:;" onclick="checkwp();" ><button type="button" class="btn btn-success">Oturumu Kontrol Et</button></a>							

																</center>

															</div>
														</div>
													</div>
												</div>
											</div>


										</div>
									</div>
									<!-- END PROFILE CONTENT -->


								</div>
							</div>

						<?php } } ?>

					</div>
				</div>

				<?php

				include('durak.footer.php');

				echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/js/lightbox.js" integrity="sha256-+kSfYaELtdxwIN+oQ7+/0Lgza4Z182hYZ02HMd8Wblg=" crossorigin="anonymous"></script>';

				echo '  </body>
				</html>';

				?>