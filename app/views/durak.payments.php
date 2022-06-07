<?php

new_session();
$PageDatatable = true;
$UID = $_SESSION['Durak']->id;

$query = $db->query("SELECT * FROM users WHERE id='$UID' ")->fetch(PDO::FETCH_ASSOC);
$_SESSION['Durak'] = (object) $query;

include('durak.header.php');





?>

<link href="/assets/durak/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
<link href="https://cdn.datatables.net/responsive/1.0.7/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="/assets/durak/css/pages/pricing.css">
<!-- start page content -->
<input type="text" value="contact" id="page_id" hidden="">
<div class="page-content-wrapper">
	<div class="page-content">
		<div class="page-bar">
			<div class="page-title-breadcrumb animated fadeIn">
				<div class=" pull-left">
					<div class="page-title"><strong style="font-weight: 600;" >Ödeme Yönetimi</div>
					</div>
					<ol class="breadcrumb page-breadcrumb pull-right">
						<li><a class="parent-item"  onclick="InnerPage(this); return false;" href="/DurakYonetim"><i class="fa fa-taxi"></i>&nbsp;- <?=say($_SESSION['Durak']->realname)?></a>&nbsp;<i class="fa fa-angle-right"></i>
						</li>
						<li class="active">Ödeme Yönetimi</li>
					</ol>
				</div>
			</div>

			<div class="row animated fadeIn">
				<div class="col-sm-12">
					<div class="card-box">
						<div class="card-head">
							<header>Hesabınız</header>
						</div>
						<div class="card-body ">

							<h5 style="font-size: 20px !important;margin-bottom: 15px;" >Bizimle olduğunuz süre : <span style="color: red;" ><?=timerformat($_SESSION['Durak']->created_time,time())?></span>. Teşekkür ederiz. Kalan süreniz: <span style="color: red;" ><?=timerformat(time(),$_SESSION['Durak']->finished_time)?></span>.</h5>
							<?php
							$PerCent = round((time() - $_SESSION['Durak']->created_time) * 100 / ($_SESSION['Durak']->finished_time - time()) ,2);

							?>
							<div id="p3" class="mdl-progress mdl-js-progress is-upgraded" data-upgraded=",MaterialProgress"><div class="progressbar bar bar1" style="width: <?=$PerCent?>%;"></div><div class="bufferbar bar bar2" style="width: 87%;"></div><div class="auxbar bar bar3" style="width: 13%;"></div></div>

						</div>
					</div>
				</div>
			</div>

			<div class="row animated fadeIn">
				<div class="col-sm-12">
					<div class="card-box">
						<div class="card-head">
							<center><header>Hesabınızın Süresini Uzatın</header></center>
						</div>
						<center><img style="width: 95%;margin-top: 20px;" src="/media/footerbankaallend-1170x71.png"></center>
						<div id="pr_bd" class="card-body ">

							<div class="pricing-plans">
								<div class="wrap">
									<div class="pricing-grids">
										<div style="height: 30px;" class="pricing-grid1">
											<div class="price-value fontCss">
												<h3><a onclick="pymt(1);" href="javascript:;">+1 ay 198 ₺</a></h3>
											</div>
										</div>
										<div style="height: 30px;" class="pricing-grid2">
											<div class="price-value two fontCss">
												<h3><a onclick="pymt(2);" href="javascript:;">+1 yıl 1987 ₺</a></h3>
											</div>
										</div>
										<div style="height: 30px;" class="pricing-grid3">
											<div class="price-value three fontCss">
												<h3><a onclick="pymt(3);" href="javascript:;">+3 yıl 5987 ₺</a></h3>
											</div>
										</div>
									</div>
								</div>
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

							<header>Ödemeleriniz</header>
							<div class="tools">
								<a onclick="reloadContent();" class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>

							</div>
						</div>
						<div style="font-weight: 400;" class="card-body ">
							<div class="table-scrollable">
								<table id="table" class="display table-striped responsive" style="width:100%;font-weight: 400;">
									<thead>
										<tr>
											<th>Sıra</th>
											<th>Durak Adı</th>
											<th>Yetkili Adı</th>
											<th>Ödeme Zamanı</th>
											<th>Ödeme Miktarı</th>
											<th>Fatura</th>
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
											<th>Durak Adı</th>
											<th>Yetkili Adı</th>
											<th>Ödeme Zamanı</th>
											<th>Ödeme Miktarı</th>
											<th>Fatura</th>


										</tr>
									</tfoot>
									<tbody style="text-align: center;" >
										

										<?php

										$query = $db->query("SELECT * FROM payments WHERE  user_id='$UID' order by id ASC ", PDO::FETCH_ASSOC);

										if ( $query->rowCount() ){
											$n = 0;
											foreach( $query as $row ){
												$n++;
												echo '<tr>
												<td>'.$n.'</td>
												<td>'.say($_SESSION['Durak']->realname).'</td>
												<td>'.say($_SESSION['Durak']->bossname).'</td>
												<td>'.date('d.m.Y H:i:s',$row['payment_time']).'</td>
												<td>'.say($row['payment_amount']).' ₺</td>
												<td><a target="_blank" href="/DurakYonetim/Fatura?ID='.clear($row['token']).'">Fatura</a> </td>												
												</tr>
												';

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

	<?php

	include('durak.footer.php');

	echo '  </body>
	</html>';

	?>