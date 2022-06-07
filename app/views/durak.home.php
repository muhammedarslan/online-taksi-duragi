<?php

include('durak.header.php');

new_session();

$UID = $_SESSION['Durak']->id;

$PageDatatable = true;

?>
<link href="/assets/durak/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
<link href="https://cdn.datatables.net/responsive/1.0.7/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />
<!-- start page content -->
<input type="text" value="home" id="page_id" hidden="">
<div class="page-content-wrapper">
	<div class="page-content">
		<div class="page-bar">
			<div class="page-title-breadcrumb animated fadeIn">
				<div class=" pull-left">
					<div class="page-title"><strong style="font-weight: 600;" ><?=say($_SESSION['Durak']->realname)?></strong></div>
				</div>
				<ol class="breadcrumb page-breadcrumb pull-right">
					<li><a class="parent-item" href="javascript:;"><i class="fa fa-taxi"></i>&nbsp;- <?=say($_SESSION['Durak']->realname)?></a>&nbsp;<i class="fa fa-angle-right"></i>
					</li>
					<li class="active">Anasayfa</li>
				</ol>
			</div>
		</div>
		<?php

		$Stat11 = $db->prepare("SELECT count(*) FROM hey_taksi WHERE user_id='$UID' and status=2 ");
		$Stat11->execute();
		$Stat1 = $Stat11->fetchColumn();

		$Stat222 = time()-(60*60*24*30);
		$Stat22 = $db->prepare("SELECT count(*) FROM contact where status=1 and user_id='$UID' ");
		$Stat22->execute();
		$Stat2 = $Stat22->fetchColumn();

		$Stat33 = $db->prepare("SELECT count(*) FROM sms_log WHERE sender_user='$UID' ");
		$Stat33->execute();
		$Stat3 = $Stat33->fetchColumn();

		$Stat44 = $db->prepare("SELECT count(*) FROM sms_log WHERE receiver='$UID' ");
		$Stat44->execute();
		$Stat4 = $Stat44->fetchColumn();


		?>

		<div class="alert alert-info animated fadeIn">
			<center style="letter-spacing: 0.3px;" >Hoşgeldiniz, bir müşteriniz taksi talep ettiği zaman anında haberdar edileceksiniz.</center>
		</div>
		<!-- start widget -->
		<div class="row animated fadeIn">
			<div class="col-lg-6 col-md-12 col-sm-12 col-12">
				<div class="row animated fadeIn clearfix">            
					<div class="col-md-6 col-sm-6 col-12">
						<div class="card">
							<div style="text-align: center;" class="panel-body">
								<h3><strong>- <?=$Stat1?> -</strong><br> Toplam Sefer</h3>
								<div class="progressbar-xs progress-rounded progress-striped progress ng-isolate-scope active">
									<div class="progress-bar progress-bar-orange" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-12">
						<div class="card">
							<div style="text-align: center;" class="panel-body">
								<h3><strong>- <?=$Stat2?> -</strong><br> Toplam Müşteri</h3>
								<div class="progressbar-xs progress-rounded progress-striped progress ng-isolate-scope active">
									<div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
								</div></div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-12">
							<div class="card">
								<div style="text-align: center;" class="panel-body">
									<h3><strong>- <?=$Stat3?> -</strong><br> Giden Mesaj</h3>
									<div class="progressbar-xs progress-rounded progress-striped progress ng-isolate-scope active" >
										<div class="progress-bar progress-bar-purple" role="progressbar" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
									</div></div>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-12">
								<div class="card">
									<div style="text-align: center;" class="panel-body">
										<h3><strong>- <?=$Stat4?> -</strong><br> Gelen Mesaj</h3>
										<div class="progressbar-xs progress-rounded progress-striped progress ng-isolate-scope active" >
											<div class="progress-bar progress-bar-cyan" role="progressbar" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
										</div></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-12 col-sm-12 col-12">
							<div class="card card-box">
								<div class="card-head">
									<header>Grafiksel Raporlama</header>
									<div class="tools">
									</div>
								</div>
								<div class="card-body no-padding height-9">
									<div id="home_cart" class="row animated fadeIn">
										<p id="chart_l_text" style="margin: 20px;color: grey;" >Grafikler yükleniyor...</p>   
										<div style="height: 290px;" ></div>
									</div>
									<div style="margin-bottom: 7px;"></div>
								</div>
							</div>
						</div>
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
													<th>Müşteri Adı</th>
													<th>Telefon Numarası</th>
													<th>Talep Zamanı</th>
													<th>Gönderilen taksi</th>
													<th>Durum</th>


												</tr>
											</tfoot>
											<tbody style="text-align: center;" >


												<?php

												$query = $db->query("SELECT * FROM hey_taksi WHERE status !=1 and user_id='$UID' order by id DESC LIMIT 50 ", PDO::FETCH_ASSOC);


												if ( $query->rowCount() ){

													foreach( $query as $row ){


														$PHN = $row['phone_number'];
														$query2 = $db->query("SELECT * FROM contact WHERE status='1' and phone_number='$PHN' ")->fetch(PDO::FETCH_ASSOC);

														$Taxis = $db->query("SELECT * FROM taxies WHERE id='".$row['taxi_id']."' ")->fetch(PDO::FETCH_ASSOC);

														echo '<tr>
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


					<!-- end widget -->
					<div class="row animated fadeIn">
						<div class="col-lg-8 col-md-12 col-sm-12 col-12">
							<div class="card card-box">
								<div class="card-head">
									<header>Rehbere Son Kayıt Edilenler</header>
									<div class="tools">
									</div>
								</div>
								<div class="card-body no-padding height-9">
									<div class="row animated fadeIn table-padding">
										<div class="col-md-6 col-sm-6 col-6">
											<div class="btn-group">
												<a onclick="InnerPage(this); return false;"  href="/DurakYonetim/TelefonRehberi/YeniKayıt" id="addrow animated fadeIn" class="btn btn-success">
													Yeni ekle <i class="fa fa-plus"></i>
												</a>
											</div>
										</div>

									</div>
									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover table-checkable order-column" id="example4">
											<thead>
												<tr>
													<th class="center">#</th>
													<th class="center">Adı Soyadı</th>
													<th class="center">Telefon Numarası</th>
													<th class="center">Eklenme Zamanı</th>
													<th class="center">Adresi </th>
												</tr>
											</thead>
											<tbody>


												<?php

												$query = $db->query("SELECT * FROM contact WHERE status='1' and user_id='$UID' ORDER BY id DESC LIMIT 6 ", PDO::FETCH_ASSOC);
												$n = 0;
												if ( $query->rowCount() ){

													foreach( $query as $row ){
														$n++;
														echo '<tr class="odd gradeX">
														<td class="center">#</td>
														<td class="center">'.say($row['realname']).'</td>
														<td class="center">'.pnumber($row['phone_number']).'</td>
														<td class="center"><strong>'.timerformat($row['added_time'],time()).' önce </strong></td>
														<td class="center"><a onclick="swal('."'".say(str_replace(array("\n","\r","\n\r","\r\n"), ' ', $row['adres']))."'".','."'".say($row['realname'])." adlı kişinin adresidir.'".');" href="javascript:;">Adres</a> </td>
														</tr>
														';

													}
												}

												?>                                               


											</tbody>
										</table>
										<?php 
										if ( $n == 0 ) {
											echo '<div class="alert alert-danger">
											<center>Rehberinizde henüz kayıt bulunmuyor.</center>
											</div>';
											echo '<div style="height:240px;margin-top:40px;" ><center><img style="width:200px;" src="/media/phone_icon.png" /></center></div>';
										}
										?>
										
										<div class="full-width text-center p-t-10" >
											<a onclick="InnerPage(this); return false;"  href="/DurakYonetim/TelefonRehberi" class="btn purple btn-outline btn-circle margin-0">Tüm Rehberi Görüntüle</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-lg-4 col-md-12 col-sm-12 col-12">
							<div class="card card-box">
								<div class="card-head">
									<header>Son Sohbetler</header>
								</div>
								<div class="card-body ">
									<div  class="row chat_al animated fadeIn">
										<ul class="docListWindow small-slimscroll-style">
											<?php

											$Chats = $db->query("SELECT * FROM sms_log where sender_user='$UID' or receiver = '$UID' ORDER BY id DESC ", PDO::FETCH_ASSOC);
											$n = 0;
											if ( $Chats->rowCount() ){
												echo '<style type="text/css">
												.slimScrollDiv{
													width: 100% !important;
												}
												.docListWindow{
													width: 100% !important;
												}
												</style>';
												$Chatarray = array();
												foreach( $Chats as $row ){
													$n++;
													if ( $row['sender_user'] == $UID ) {

														if ( !in_array($row['receiver'], $Chatarray) ) {

															$NMB = $row['receiver'];
															$ChatPerson = $db->query("SELECT * FROM contact WHERE phone_number = '{$NMB}' and status=1 ")->fetch(PDO::FETCH_ASSOC);
															if ( $ChatPerson ){

																echo '            <li>
																<div class="prog-avatar">
																<img src="/media/avatars/default/'.mb_strtoupper(substr(say($ChatPerson['realname']), 0,1)).'.png" width="40" height="40">
																</div>
																<div class="details">
																<div class="title">
																<a  target="_blank" href="/DurakYonetim/Mesajlar/+'.seo_link('+90'.pnumber($NMB)).'">'.say($ChatPerson['realname']).'</a></strong>
																</div>
																<div>
																<span class="clsAvailable">Kayıtlı müşteri</span>
																</div>
																</div>
																</li>';  

															} else {

																echo '            <li>
																<div class="prog-avatar">
																<img src="/media/favicon.ico" width="40" height="40">
																</div>
																<div class="details">
																<div class="title">
																<a  target="_blank" href="/DurakYonetim/Mesajlar/+'.seo_link('+90'.pnumber($NMB)).'">+90 '.pnumber($NMB).'</a>
																</div>
																<div>
																<span class="clsNotAvailable">Numara kayıtlı değil</span>
																</div>
																</div>
																</li>';  

															}

															array_push($Chatarray, $row['receiver']);
														}
													} else {

														if ( !in_array($row['sender_user'], $Chatarray) ) {

															$NMB = $row['sender_user'];
															$ChatPerson = $db->query("SELECT * FROM contact WHERE phone_number = '{$NMB}' and status=1 ")->fetch(PDO::FETCH_ASSOC);
															if ( $ChatPerson ){

																echo '            <li>
																<div class="prog-avatar">
																<img src="/media/avatars/default/'.mb_strtoupper(substr(say($ChatPerson['realname']), 0,1)).'.png" width="40" height="40">
																</div>
																<div class="details">
																<div class="title">
																<a  target="_blank" href="/DurakYonetim/Mesajlar/+'.seo_link('+90'.pnumber($NMB)).'">'.say($ChatPerson['realname']).'</a> <strong>- '.pnumber($ChatPerson['phone_number']).'</strong>
																</div>
																<div>
																<span class="clsAvailable">Kayıtlı müşteri</span>
																</div>
																</div>
																</li>';  

															} else {

																echo '            <li>
																<div class="prog-avatar">
																<img src="/media/favicon.ico" width="40" height="40">
																</div>
																<div class="details">
																<div class="title">
																<a  target="_blank" href="/DurakYonetim/Mesajlar/+'.seo_link('+90'.pnumber($NMB)).'">+90 '.pnumber($NMB).'</a>
																</div>
																<div>
																<span class="clsNotAvailable">Numara kayıtlı değil</span>
																</div>
																</div>
																</li>';  

															} 

															array_push($Chatarray, $row['sender_user']);
														}
													}


												}
											}


											?>

										</ul>
										<?php 
										if ( $n == 0 ) {
											echo '<div style="margin-top:30px;height:45px;width:90%;" class="alert alert-danger">
											<style>
											.chat_al{
												background-image: url(/media/Chat-512.png);
												background-repeat: no-repeat;background-position: center;
											}
											</style>
											<center>Sohbet geçmişiniz bulunmuyor.</center>
											</div>';
										}
										?>
										<div class="full-width text-center p-t-10" style="margin-top: 23px;" >
											<a onclick="InnerPage(this); return false;"  href="/DurakYonetim/Mesajlar" class="btn purple btn-outline btn-circle margin-0">Tüm Sohbetleri Görüntüle</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>


<?php /* ?>
<div class="page-bar">
  <div style="text-align: center;" class="page-title-breadcrumb animated fadeIn">
    <div class="page-title"><strong style="font-weight: 600;letter-spacing: initial;" >Blogumuza göz atmak ister misiniz?</div>
    </div>
  </div>


  <div class="row animated fadeIn">
    <div class="col-lg-3 col-md-6 col-12 col-sm-6"> 
      <div class="card-box">
        <div class="thumb-center"><img class="img-responsive" alt="user" src="media/blog/blog1.jpg"></div>
        <div class="white-box">
          <div class="text-muted"><span class="m-r-10">June 16</span> 
            <a class="text-muted m-l-10" href="#"><i class="fa fa-heart-o"></i> 56</a>
          </div>
          <h3 class="m-t-20 m-b-20">White Woman Practices Yoga In</h3>
          <p>There is a new neighbor on Sesame Street. Her name is Julia </p>
          <button class="btn btn-success btn-rounded waves-effect waves-light m-t-20">Read more</button>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-12 col-sm-6"> 
      <div class="card-box">
        <div class="thumb-center"><img class="img-responsive" alt="user" src="media/blog/blog2.jpg"></div>
        <div class="white-box">
          <div class="text-muted"><span class="m-r-10">Feb 12</span> 
            <a class="text-muted m-l-10" href="#"><i class="fa fa-heart-o"></i> 45</a>
          </div>
          <h3 class="m-t-20 m-b-20">How Much Radon is In Your Home?</h3>
          <p>There is a new neighbor on Sesame Street. Her name is Julia</p>
          <button class="btn btn-success btn-rounded waves-effect waves-light m-t-20">Read more</button>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-12 col-sm-6"> 
      <div class="card-box">
        <div class="thumb-center"><img class="img-responsive" alt="user" src="media/blog/blog3.jpg"></div>
        <div class="white-box">
          <div class="text-muted"><span class="m-r-10">Dec 17</span> 
            <a class="text-muted m-l-10" href="#"><i class="fa fa-heart-o"></i> 79</a>
          </div>
          <h3 class="m-t-20 m-b-20">White Woman Practices Yoga In</h3>
          <p>There is a new neighbor on Sesame Street. Her name is Julia </p>
          <button class="btn btn-success btn-rounded waves-effect waves-light m-t-20">Read more</button>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-12 col-sm-6"> 
      <div class="card-box">
        <div class="thumb-center"><img class="img-responsive" alt="user" src="media/blog/blog4.jpg"></div>
        <div class="white-box">
          <div class="text-muted"><span class="m-r-10">April 23</span> 
            <a class="text-muted m-l-10" href="#"><i class="fa fa-heart-o"></i> 654</a>
          </div>
          <h3 class="m-t-20 m-b-20">How Much Radon is In Your Home?</h3>
          <p>There is a new neighbor on Sesame Street. Her name is Julia</p>
          <button class="btn btn-success btn-rounded waves-effect waves-light m-t-20">Read more</button>
        </div>
      </div>  
    </div>
  </div>

  <?php */ ?>




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
