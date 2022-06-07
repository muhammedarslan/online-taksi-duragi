<?php

include('durak.header.php');

new_session();

$PageDatatable = true;
$UID = $_SESSION['Durak']->id;

?>

<link href="/assets/durak/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
<link href="https://cdn.datatables.net/responsive/1.0.7/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />
<!-- start page content -->
<input type="text" value="heytaksi" id="page_id" hidden="">
<div class="page-content-wrapper">
	<div class="page-content">
		<div class="page-bar">
			<div class="page-title-breadcrumb animated fadeIn">
				<div class=" pull-left">
					<div class="page-title"><strong style="font-weight: 600;" >Hey Taksi</div>
					</div>
					<ol class="breadcrumb page-breadcrumb pull-right">
						<li><a class="parent-item"  onclick="InnerPage(this); return false;" href="/DurakYonetim"><i class="fa fa-taxi"></i>&nbsp;- <?=say($_SESSION['Durak']->realname)?></a>&nbsp;<i class="fa fa-angle-right"></i>
						</li>
						<li class="active">Hey Taksi</li>
					</ol>
				</div>
			</div>

			<div class="alert alert-success animated fadeIn">
				<center style="letter-spacing: 0.3px;" >Bir müşteriniz taksi talep ettiği zaman anında haberdar edileceksiniz.</center>
			</div>

			<div class="row animated fadeIn">
				<div class="col-sm-12">
					<div class="card card-box">
						<div style="text-align: center;"  class="card-head">
							<header>Taksi Talepleri</header>
							<div class="tools">
								<a onclick="reloadContent();" class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>

							</div>
						</div>
						<div class="card-body ">
							<div class="row">
								<?php

								$query = $db->query("SELECT * FROM hey_taksi WHERE status=1 and user_id='$UID' order by id ASC  ", PDO::FETCH_ASSOC);

								
								if ( $query->rowCount() ){
									foreach( $query as $row ){
										$PHN = $row['phone_number'];
										$query2 = $db->query("SELECT * FROM contact WHERE status='1' and phone_number='$PHN' ")->fetch(PDO::FETCH_ASSOC);
										if ( $query2 ){
											

											echo '<div class="col-md-4">
											<div class="card card-box">
											<div class="card-body no-padding ">
											<div class="doctor-profile">
											<img src="/media/avatars/default/'.mb_strtoupper(substr(say($query2['realname']), 0,1)).'.png" class="doctor-pic" alt=""> 
											<div class="profile-usertitle">
											<p>
											<div class="doctor-name">'.say($query2['realname']).'
											<p>+90 '.pnumber($PHN).'</p>
											<p>'.date('d.m.Y H:i:s',$row['req_time']).'</p>
											<p><strong>- '.timerformat($row['req_time'],time()).' önce -</strong></p>

											</div>
											</div><br>
											<p>'.say($query2['adres']).'</p> 
											<div class="profile-userbuttons"><br>
											<a style="" href="javascript:;" onclick="taxis('."'".$row['token']."'".');" class="btn btn-circle deepPink-bgcolor btn-sm">Müşteriye Taksi Gönder</a>
											<p><br><a  style="background-color:#fda582 !important;" onclick="cncltx('."'".$row['token']."'".');" href="javascript:;" class="btn btn-circle deepPink-bgcolor btn-sm">İptal et</a>
											</div>
											</div>
											</div>
											</div>
											</div>';

										}
									}
								} else {
									
									echo '<div style="margin:auto;margin-top:10px;margin-bottom:10px;">
									<center>
									<h3>Şu anda taksi talep eden hiç kimse yok.</h3>
									<h3 style="margin-top: -25px;" >Arkana yaslan ve keyfini çıkar &#128516;</h3>		
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


			<div class="row animated fadeIn">
				<style type="text/css">
					td,th {
						border: 1px solid #000000 !important;

					}

				</style>
				<div class="col-md-12">
					<?php
		// <div class="alert alert-warning"> ... </div>
					?>
					<div class="card card-box">
						<div style="text-align: center;" class="card-head">

							<header>Taksi Talep Geçmişi</header>
							<div class="tools">
								<a onclick="reloadContent();" class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>

							</div>
						</div>
						<div style="font-weight: 400;" class="card-body ">
							<div class="table-scrollable">
								<table id="table" class="display table-striped responsive" style="width:100%;font-weight: 400;text-align: center;">
									<thead>
										<tr>
											<th>Sıra</th>
											<th>Müşteri Adı</th>
											<th>Telefon Numarası</th>
											<th>Talep Zamanı</th>
											<th>Gönderilen taksi</th>
											<th>Durum</th>										

										</tr>
									</thead>
									<style type="text/css">
										tfoot input {

											width: 100%;
											padding: 3px;
											box-sizing: border-box;
										}
									</style>
									<tfoot style="display: table-header-group;">
										<tr>
											<th>Sıra</th>
											<th>Müşteri Adı</th>
											<th>Telefon Numarası</th>
											<th>Talep Zamanı</th>
											<th>Gönderilen taksi</th>
											<th>Durum</th>


										</tr>
									</tfoot>
									<tbody style="text-align: center;" >


										<?php

										$query = $db->query("SELECT * FROM hey_taksi WHERE status !=1 and user_id='$UID' order by id DESC LIMIT 1000 ", PDO::FETCH_ASSOC);


										if ( $query->rowCount() ){
											$n = 0;
											foreach( $query as $row ){
												$n++;

												$PHN = $row['phone_number'];
												$query2 = $db->query("SELECT * FROM contact WHERE status='1' and phone_number='$PHN' ")->fetch(PDO::FETCH_ASSOC);

												$Taxis = $db->query("SELECT * FROM taxies WHERE id='".$row['taxi_id']."' ")->fetch(PDO::FETCH_ASSOC);

												echo '<tr>
												<td>'.$n.'</td>
												<td>'.$query2['realname'].'</td>
												<td>+90 '.pnumber($query2['phone_number']).'</td>
												<td>'.date('d.m.Y H:i:s',$row['req_time']).'</td><td>'.$Taxis['plaka'].'</td><td>';
												if ( $row['status'] == 2 ) {
													echo '<span class="label label-success label-mini">Başarıyla Gönderildi</span>';
												} else {
													echo '<span class="label label-danger label-mini">İptal Edildi</span>';
												}

												echo'</td></tr>';


											}

										}
										?>


									</tbody>

								</table>
							</div>
						</div>
					</div>


				</div>
			</div>


		</div>
	</div>
	<!-- end page content -->

	<style type="text/css">
		.md-form input[type=date], .md-form input[type=datetime-local], .md-form input[type=email], .md-form input[type=number], .md-form input[type=password], .md-form input[type=search-md], .md-form input[type=search], .md-form input[type=tel], .md-form input[type=text], .md-form input[type=time], .md-form input[type=url], .md-form textarea.md-textarea {
			-webkit-transition: border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
			-o-transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
			transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
			transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
			outline: 0;
			-webkit-box-shadow: none;
			box-shadow: none;
			border: none;
			border-bottom: 1px solid #ced4da;
			-webkit-border-radius: 0;
			border-radius: 0;
			-webkit-box-sizing: content-box;
			box-sizing: content-box;
			background-color: transparent;
		}
		.md-form textarea.md-textarea {
			overflow-y: hidden;
			padding: 1.5rem 0;
			resize: none;
		}
		.md-form .form-control {
			margin: 0 0 .5rem;
			-webkit-border-radius: 0;
			border-radius: 0;
			padding: .6rem 0 .4rem;
			background-color: transparent;
			height: auto;
		}
	</style>
	<div id="smodal">

	</div>

	<?php

	include('durak.footer.php');
	echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>';
	echo '  </body>
	</html>';

	?>