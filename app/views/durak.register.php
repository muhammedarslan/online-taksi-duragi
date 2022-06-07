<?php


$User = $_Params[0];
$_Params['surucu'] = 'Yeni Kayıt';
include('durak.header.customer.php');

?>

<!-- start page content -->
<input type="text" value="NewCustomer" id="page_id" hidden="">
<div class="page-content-wrapper">
	<div class="page-content">
		<div class="page-bar">
			<div class="page-title-breadcrumb animated fadeIn">
				<div class=" pull-left">
					<div class="page-title"><strong style="font-weight: 600;" ><?=say($User['realname'])?></div>
					</div>
					<ol class="breadcrumb page-breadcrumb pull-right">
						<li><a class="parent-item" href="javascript:;" ><i class="fa fa-taxi"></i>&nbsp;- <?=say($User['realname'])?></a>
						</li>
					</ol>
				</div>
			</div>

			<div class="animated fadeIn alert alert-warning">
				Tek bir mesaj ile taksi çağırmak ister misiniz? Hemen durağa kayıt olun.
			</div>

			<div class="animated fadeIn alert alert-info">
				Telefon numarası, adres gibi kişisel verileriniz 6698 sayılı Kişisel Verilerin Korunması Kanunu gereğince asla 3. kişilerle paylaşılmamaktadır.
			</div>

			<div style="font-size: 20px;" class="row animated fadeIn">
				<div class="col-md-12 col-sm-12">
					<div class="card card-box">
						<div class="card-head">
							<header>Taksi Durağına Kayıt Ol</header>
						</div>
						<div class="card-body" id="bar-parent2">
							<form  action="javascript:;" method="post" id="form_sample_2" class="form-horizontal" novalidate="novalidate">
								<div class="form-body">
									<script type="text/javascript">

										const getLocation = () => {
											if (navigator.geolocation) {
												navigator.geolocation.getCurrentPosition(showPosition);
											} else { 
												alert('Maalesef tarayıcınız bu özelliği destekleniyor.');
											}
										}

										const showPosition = (position) => {

											const lat = position.coords.latitude;
											const lng = position.coords.longitude;

											if ( lat == '' || lng == '' ) {

												swal({
													title: "Konum Bilgisi",
													text:'Lütfen cihazınızın gps alıcısını açınız ve tarayıcı erişimi için izin veriniz',
													html:true,
													showCancelButton: false,
													type:'success',
													showConfirmButton:true,
													allowEscapeKey:false,
													allowOutsideClick:false,
													closeOnConfirm: false,
													closeOnCancel: false
												});

											} else {

												swal({
													title: "Lütfen Bekleyiniz...",
													text:'Yaklaşık konumunuz bulunmaya çalışılıyor...',
													showCancelButton: false,
													showConfirmButton:false,
													allowEscapeKey:false,
													allowOutsideClick:false,
													closeOnConfirm: false,
													closeOnCancel: false
												});

												setTimeout(()=>{
													$.post('/AjaxCall/FindAddress',{'lat':lat,'lng':lng},(data)=>{

														if ( data != '0' ) {

															$('#adres_tx').val(data);

															swal({
																title: "Başarıyla Tamamlandı!",
																text:'Yaklaşık konumunu adres alanına ekledik, lütfen daha tanımlayıcı olması için düzenleyebilir misin?',
																html:true,
																showCancelButton: false,
																type:'success',
																showConfirmButton:true,
																allowEscapeKey:false,
																allowOutsideClick:false,
																closeOnConfirm: false,
																closeOnCancel: false
															});

														} else {
															swal({
																title: "Bir Hata Oluştu!",
																text:'Konumunu maalesef alamadık, adresini kendin girebilir misin?',
																html:true,
																showCancelButton: false,
																type:'error',
																showConfirmButton:true,
																allowEscapeKey:false,
																allowOutsideClick:false,
																closeOnConfirm: false,
																closeOnCancel: false
															});
														}

													});


												},1000);

											}

										}
									</script>


									<div class="form-group row  margin-top-20">
										<label class="control-label col-md-3">Ad & Soyad
											<span class="required" aria-required="true"> * </span>
										</label>
										<div class="col-md-6">
											<div class="input-icon right">
												<i class="fa"></i>
												<input
												<?php if ( isset($_GET['n']) ) echo 'value="'.$_GET['n'].'"'; ?>
												placeholder="Size nasıl hitap etmemizi istersiniz?" type="text" class="form-control" name="name"> </div>
											</div>
										</div>

										<div class="form-group row  margin-top-20">
											<label class="control-label col-md-3">Telefon Numarası
												<span class="required" aria-required="true"> * </span>
											</label>
											<div class="col-md-6">
												<div class="input-icon right">
													<i class="fa"></i>
													<input
													<?php
													if ( isset($_GET['t']) && $_GET['t'] != '' ) echo 'value="'.urldecode(str_replace('+90', '', $_GET['t'])).'"';
													?>
													id="TlfMask" placeholder="Telefon numaranız: (5xx) xxx xx xx" type="text" class="form-control" name="tel"> </div>
												</div>
											</div>

											<div class="form-group row  margin-top-20">
												<label class="control-label col-md-3">Adres
													<span class="required" aria-required="true"> * </span>
												</label>
												<div class="col-md-6">
													<div class="input-icon right">
														<i class="fa"></i>
														<textarea id="adres_tx" placeholder="Size istediğiniz zaman taksi gönderebilmemiz için geçerli adresiniz." class="form-control" name="adres"><?php if ( isset($_GET['a']) ) echo $_GET['a']; ?></textarea>
														
													</div>
												</div>
											</div>


										</div>
										<div class="form-group">
											<div class="offset-md-3 col-md-9">
												<button type="submit" class="btn btn-success">Durağa Kayıt Ol</button>
												<a style="margin-left: 20px;" href="javascript:;" onclick="getLocation();" ><button type="button" class="btn btn-warning">Yaklaşık Konumumu Bul</button></a>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>


				</div>
			</div>
			<!-- end page content -->

			<?php

			include('durak.footer.taxi.php');
			echo '<script async defer src="/assets/durak/js/pages/validation/form-validation.js?v=1.0.1" ></script>';
			echo '<script type="text/javascript">

			$(document).ready(function()
			{
				$("#TlfMask").mask("(999) 999 99 99");
				})
				</script>';
				echo '  </body>
				</html>';

				?>