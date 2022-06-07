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
					<div class="page-title"><strong style="font-weight: 600;" >Kayıtsız Numaralar</div>
					</div>
					<ol class="breadcrumb page-breadcrumb pull-right">
						<li><a class="parent-item"  onclick="InnerPage(this); return false;" href="/DurakYonetim"><i class="fa fa-taxi"></i>&nbsp;- <?=say($_SESSION['Durak']->realname)?></a>&nbsp;<i class="fa fa-angle-right"></i>
							<li><a class="parent-item" href="/DurakYonetim/TelefonRehberi"> Telefon Rehberi</a>&nbsp;<i class="fa fa-angle-right"></i>
							</li>
							<li class="active">Kayıtsız Numaralar</li>
						</ol>
					</div>
				</div>

				<div class="alert alert-primary animated fadeIn">
					<center style="letter-spacing: 0.3px;" >Size mesaj atmış fakat rehberinizde kayıtlı olmayan numaralar burada gözükür.</center>
				</div>


				<div class="row animated fadeIn">
					<div class="col-sm-12">
						<div class="card ">
							<div class="card-head">
								<header>Kayıtsız Numaralar</header>
								<div class="tools">
									<a onclick="reloadContent();" class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
								</div>
							</div>
							<div class="card-body ">
								<div class="row">
									<?php

									$query = $db->query("SELECT * FROM sms_log WHERE receiver='$UID' ", PDO::FETCH_ASSOC);
									$n = 1;
									$tbleArr = array();
									if ( $query->rowCount() ){
										foreach( $query as $row ){
											$PHN = $row['sender_user'];
											if ( in_array($PHN, $tbleArr) ) {
												continue;
											}
											$query2 = $db->query("SELECT * FROM contact WHERE status='1' and phone_number='$PHN' ")->fetch(PDO::FETCH_ASSOC);
											if ( !$query2 ){
												array_push($tbleArr, $PHN);
												$n++;
												echo '<div class="col-md-4">
												<div class="card card-box">
												<div class="card-body no-padding ">
												<div class="doctor-profile">
												<img src="/media/favicon.ico" class="doctor-pic" alt=""> 
												<div class="profile-usertitle">
												<p>
												<div class="doctor-name">+90 '.pnumber($PHN).'</div>
												</div><br>
												<p>En son <strong>'.timerformat($row['send_time'],time()).'</strong> önce mesaj gönderdi.</p> 
												<div class="profile-userbuttons"><br>
												<a style="background-color:#a890d3 !important;" href="/DurakYonetim/Mesajlar/'.$PHN.'" class="btn btn-circle deepPink-bgcolor btn-sm">Mesajları görüntüle</a>
												<a  style="background-color:#fda582 !important;"  href="/DurakYonetim/TelefonRehberi/YeniKayıt?N='.urlencode(pnumber($PHN)).'" class="btn btn-circle deepPink-bgcolor btn-sm">Rehbere ekle</a>
												</div>
												</div>
												</div>
												</div>
												</div>';

											}
										}
									} 
									if ( $n == 1 ) {

										echo '<div style="margin:auto;margin-top:10px;margin-bottom:10px;">
										<center>
										<h3>Mesaj geçmişinizde kayıtsız numara bulunamadı !</h3>
										<img style="width: 350px;margin-top: -30px;" src="/media/taxi_loading.gif"/>
										</center>
										</div>';

									}

									?>

								</div>
							</div>
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