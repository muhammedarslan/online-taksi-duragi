<?php

new_session();
$UID = $_SESSION['Durak']->id;

$query = $db->query("SELECT * FROM users WHERE id='$UID' ")->fetch(PDO::FETCH_ASSOC);
$_SESSION['Durak'] = (object) $query;

include('durak.header.php');




?>


<!-- start page content -->
<input type="text" value="profile" id="page_id" hidden="">
<div class="page-content-wrapper">
	<div class="page-content">
		<div class="page-bar">
			<div class="page-title-breadcrumb animated fadeIn">
				<div class=" pull-left">
					<div class="page-title"><strong style="font-weight: 600;" >Profilim</div>
					</div>
					<ol class="breadcrumb page-breadcrumb pull-right">
						<li><a class="parent-item"  onclick="InnerPage(this); return false;" href="/DurakYonetim"><i class="fa fa-taxi"></i>&nbsp;- <?=say($_SESSION['Durak']->realname)?></a>&nbsp;<i class="fa fa-angle-right"></i>
						</li>
						<li class="active">Profilim</li>
					</ol>
				</div>
			</div>
			<div class="row animated fadeIn">
				<div class="col-md-12">
					<!-- BEGIN PROFILE SIDEBAR -->
					<div class="profile-sidebar">
						<div class="card card-topline-aqua">
							<div class="card-body no-padding height-9">
								<div class="row">
									<div class="profile-userpic">
										<a title="Avatar görselinizi değiştirmek için tıklayınız." href="javascript:;" onclick="chang_avatar();" ><img src="/media/avatars/<?=$_SESSION['Durak']->avatar?>" class="img-responsive" alt=""> </div></a>
									</div>
									<form id="av_form" method="post" action="" enctype="multipart/form-data" >
										<input type="file" accept="image/*" hidden="" id="new_avatar" name="image">
										<input type="text" value="data" hidden="" name="data">
									</form>
									<div class="profile-usertitle">
										<div class="profile-usertitle-name"> <?=say($_SESSION['Durak']->realname)?> </div>
										<div class="profile-usertitle-job"> Taksi durağı </div>
									</div>
									<ul class="list-group list-group-unbordered">
										<li class="list-group-item">
											<b>Son giriş</b> <a class="pull-right"><?=date('d.m.Y',$_SESSION['Durak']->last_login)?> &nbsp; / &nbsp; <?=date('H:i:s',$_SESSION['Durak']->last_login)?></a>
										</li>
										<li class="list-group-item">
											<b>Son giriş ip adresi</b> <a class="pull-right"><?=say($_SESSION['Durak']->last_ip)?></a>
										</li>
										<li class="list-group-item">
											<b>Son giriş türü</b> <a class="pull-right"><?=say($_SESSION['Durak']->last_type)?></a>
										</li>
									</ul>
									<!-- END SIDEBAR USER TITLE -->
									<!-- SIDEBAR BUTTONS -->
									<div class="profile-userbuttons">
										<br>
										<button onclick="rmv_token();" type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-primary">TÜM OTURUMLARI KAPAT</button>
									</div>
									<!-- END SIDEBAR BUTTONS -->
								</div>
							</div>
							<div class="card">
								<div class="card-head card-topline-aqua">
									<header><?=say($_SESSION['Durak']->realname)?></header>
								</div>
								<div class="card-body no-padding height-9">
									<div class="row text-center m-t-10">
										<div class="col-md-12">
											<p><?=say($_SESSION['Durak']->address)?></p>
										</div>
									</div>
								</div>
							</div>
							<div class="card">
								<div style="border-bottom: none;" class="card-head card-topline-aqua">
									<header>Giriş Bilgileriniz</header>
								</div>
								<div class="card-body no-padding height-9">
									<ul class="list-group list-group-unbordered">
										<li class="list-group-item">
											<b>Durak kullanıcı adı: </b> <a class="pull-right"><?=say($_SESSION['Durak']->username)?></a>
										</li>
										<li class="list-group-item">
											<b>Durak şifresi: </b> <a class="pull-right">Belirlediğiniz şifreniz</a>
										</li>
									</ul>
								</div>
							</div>
							<div class="card">
								<div class="card-head card-topline-aqua">
									<header>Hesabınız</header>
								</div>
								<div class="card-body no-padding height-9">
									<div class="work-monitor work-progress">
										<div class="states">
											<div class="info">
												<div class="desc pull-left"><?=timerformat($_SESSION['Durak']->created_time,time())?> &nbsp;&nbsp;/&nbsp;&nbsp; <?=timerformat($_SESSION['Durak']->created_time,$_SESSION['Durak']->finished_time)?></div>
												<?php

												$PerCent = round((time() - $_SESSION['Durak']->created_time) * 100 / ($_SESSION['Durak']->finished_time - time()) ,2);

												?>
												<div class="percent pull-right"><?=$PerCent?>%</div>
											</div>
											<div class="progress progress-xs">
												<div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="<?=$PerCent?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$PerCent?>%">
													<span class="sr-only"><?=$PerCent?>% </span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- END BEGIN PROFILE SIDEBAR -->
						<!-- BEGIN PROFILE CONTENT -->
						<div class="profile-content">
							<div class="row">
								<div style="width: 100%;" class="card">
									<div class="card-topline-aqua">
										<header></header>
									</div>
									<div class="white-box">
										<!-- Nav tabs -->
										<div class="p-rl-20">
											<ul class="nav customtab nav-tabs" role="tablist">
												<li class="nav-item"><a href="#tab1" class="nav-link active"  data-toggle="tab" >Hakkınızda</a></li>
												<li class="nav-item"><a href="#tab2" class="nav-link" data-toggle="tab">Hareketler</a></li>
											</ul>
										</div>
										<!-- Tab panes -->
										<div class="tab-content">
											<div class="tab-pane active fontawesome-demo" id="tab1">
												<div id="biography" >
													<div class="row">
														<div class="col-md-4 col-6 b-r"> <strong>Adınız Soyadınız</strong>
															<br>
															<p class="text-muted"><?=say($_SESSION['Durak']->bossname)?></p>
														</div>
														<div class="col-md-4 col-6 b-r"> <strong>Telefon Numaranız</strong>
															<br>
															<p class="text-muted"><?=pnumber($_SESSION['Durak']->phone_number)?></p>
														</div>
														<div class="col-md-4 col-6 b-r"> <strong>E-posta Adresiniz</strong>
															<br>
															<p class="text-muted"><?=say($_SESSION['Durak']->email)?></p>
														</div>

													</div>
													<hr>
													<p class="m-t-30">Bu sayfada bulunan bilgilerde hata olduğunu düşünüyorsanız lütfen bizimle iletişime geçiniz. İletişim için sol menüde bulunan Destek sayfasını kullanabilirsiniz.</p>
												</p>

												<center><h3>İstatistikler</h3></center>

												<div id="home_cart" class="row animated fadeIn">
													<p id="chart_l_text" style="margin: 20px;color: grey;" >Grafikler yükleniyor...</p>   
													<div style="height: 290px;" ></div>
												</div>

											</div>
										</div>
										<div class="tab-pane" id="tab2">
											<div class="container-fluid">
												<div class="row">

													<div class="full-width p-rl-20">
														<br>
														<ul class="activity-list">
															<?php

															$query = $db->query("SELECT * FROM action_logs WHERE user_id='$UID' order by id DESC LIMIT 100 ", PDO::FETCH_ASSOC);
															if ( $query->rowCount() ){
																foreach( $query as $row ){
																	echo '															<li>
																	<div class="avatar">
																	<img src="/media/avatars/'.$_SESSION['Durak']->avatar.'" alt="" />
																	</div>
																	<div class="activity-desk">
																	<h5><span>'.say($row['action']).' <a href="javascript:;"> &nbsp; / '.say($_SESSION['Durak']->realname).'.</a> </span></h5>
																	<p class="text-muted">'.timerformat($row['report_time'],time()).' önce  /  '.date('d.m.Y H:i:s',$row['report_time']).'</p>
																	</div>
																	</li>';
																}
															}

															?>
														</ul>
													</div>
												</div>
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
		</div>
	</div>
	<!-- end page content -->



	<?php

	include('durak.footer.php');

	echo '  </body>
	</html>';

	?>