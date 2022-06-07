<?php

include('durak.header.php');

new_session();

$UID = $_SESSION['Durak']->id;

?>


<!-- start page content -->
<input type="text" value="blank" id="page_id" hidden="">
<div class="page-content-wrapper">
	<div class="page-content">
		<div class="page-bar">
			<div class="page-title-breadcrumb animated fadeIn">
				<div class=" pull-left">
					<div class="page-title"><strong style="font-weight: 600;" >Bizimle iletişime geçin</div>
					</div>
					<ol class="breadcrumb page-breadcrumb pull-right">
						<li><a class="parent-item"  onclick="InnerPage(this); return false;" href="/DurakYonetim"><i class="fa fa-taxi"></i>&nbsp;- <?=say($_SESSION['Durak']->realname)?></a>&nbsp;<i class="fa fa-angle-right"></i>
						</li>
						<li class="active">Destek</li>
					</ol>
				</div>
			</div>


			<div class="row animated fadeIn">
				<div class="col-sm-12">
					<div class="borderBox light bordered">
						<div class="row">
							<div class="col-sm-12">
								<div class="contact-map">
									<iframe src="https://maps.google.com/maps?q=istanbul&t=k&z=13&ie=UTF8&iwloc=&output=embed" width="640" height="480"></iframe>
								</div>
							</div>
						</div>
						<div class="row m-t-50 m-b-30">
							<div class="col-md-10 col-md-offset-1">
								<div class="row m-b-20">
									<div class="col-sm-12">
										<h3 class="title">BİZE ULAŞIN</h3>
										<p class="text-muted sub-title">Bize ulaşmak için aşağıda yer alan iletişim formunu veya sağ tarafta bulunan diğer iletişim kanallarını kullanabilirsiniz.<br> Gönderdiğiniz mesajlara en kısa sürede dönüş yapmaya çalışacağız.</p>
									</div>
								</div>
								<div class="row">
									<!-- Contact form -->
									<div class="col-sm-6">
										<form name="ajax-form" action="javascript:;" method="post" class="contact-form" data-parsley-validate="" id="form_sample_2" novalidate="">
											<div class="form-group">
												<input class="form-control" id="name2" name="c_name" placeholder="Adınız Soyadınız" type="text" value="" required="">
											</div>
											<!-- /Form-name -->
											<div class="form-group">
												<input class="form-control" id="email2" name="c_email" type="email" placeholder="E-posta adresiniz" value="" required="">
											</div>
											<!-- /Form-email -->
											<div class="form-group">
												<textarea class="form-control" id="message2" name="c_message" rows="5" placeholder="Mesajınız" required=""></textarea>
											</div>
											<!-- /Form Msg -->
											<div class="row">
												<div class="col-12">
													<div class="">
														<button type="submit" class="btn btn-danger waves-effect waves-light" id="send">Mesajı Göner</button>
													</div>
												</div> <!-- /col -->
											</div> <!-- /row -->
										</form> <!-- /form -->
									</div> <!-- end col -->
									<div class="col-sm-4 col-sm-offset-1">
										<div class="contact-box">
											<div class="contact-detail">
												<i class="fa fa-envelope"></i>
												<span>
													<a target="_blank" href="mailto:iletisim@onlinetaksiduragi.com">iletisim@onlinetaksiduragi.com</a>
												</span>
											</div>
											<div class="contact-detail">
												<i class="fa fa-mobile"></i>
												<span>
													<a href="javascript:;">+90 (850) 303 49 16</a>
												</span>
											</div>
											<div class="contact-detail">
												<i class="fa fa-whatsapp"></i>
												<span>
													<a target="_blank" href="https://api.whatsapp.com/send?phone=908503034916&text=Merhaba,%20online%20taksi%20dura%C4%9F%C4%B1%20hakk%C4%B1nda%20g%C3%B6r%C3%BC%C5%9Fmek%20istiyorum.">+90 (850) 303 49 16</a>
												</span>
											</div>
											
										</div>
									</div> <!-- end col -->
								</div>
							</div>
						</div>
						<!-- end row -->
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- end page content -->



	<?php

	include('durak.footer.php');

	echo '  </body>
	</html>';

	?>