<?php

include('durak.header.php');

new_session();

$PageDatatable = true;
$UID = $_SESSION['Durak']->id;

$o = $_Params[0];

$o = (object) $o;


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
					<div class="page-title"><strong style="font-weight: 600;" >Fatura</div>
					</div>
					<ol class="breadcrumb page-breadcrumb pull-right">
						<li><a class="parent-item"  onclick="InnerPage(this); return false;" href="/DurakYonetim"><i class="fa fa-taxi"></i>&nbsp;- <?=say($_SESSION['Durak']->realname)?></a>&nbsp;<i class="fa fa-angle-right"></i>
						</li>
						<li class="active">Fatura</li>
					</ol>
				</div>
			</div>

			<div class="row animated fadeIn">
				<div class="col-md-12">
					<div class="white-box">
						<h3><b>FATURA</b> <span class="pull-right"># <?=$o->id?></span></h3>
						<hr>
						<div class="row animated fadeIn">
							<div class="col-md-12">
								<div class="pull-left">
									<address>
										<img style="width: 250px;" src="/media/logo_dark.png" class="logo-default" />
										<br><br>
									</address>
								</div>
								<div class="pull-right text-right">
									<address>
										<p style="margin-bottom: 15px;" class="font-bold addr-font-h4"><?=$_SESSION['Durak']->realname?></p>
										<p style="margin-bottom: 25px;" class="text-muted m-l-30">
											<?=$_SESSION['Durak']->phone_number?>
											<br>
											<?=$_SESSION['Durak']->email?>
										</p>
										<p class="m-t-30">
											<b>Fatura tarihi :</b> <i class="fa fa-calendar"></i> <?=date('d.m.Y H:i')?>
										</p>

									</address>
								</div>
							</div>
							<div style="margin-top: 50px;" class="col-md-12">
								<div class="table-responsive m-t-40">
									<table class="table table-hover">
										<thead>
											<tr>
												<th class="text-center">Sıra</th>
												<th class="text-center">Alınan Hizmet</th>
												<th class="text-center">Ödenme tarihi</th>
												<th class="text-center">Ödenen tutar</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="text-center">1</td>
												<td class="text-center">Taksi Durağı yönetim hizmeti - <?=$o->payment_id?></td>
												<td class="text-center"><?=date('d.m.Y H:i:s',$o->payment_time);?></td>
												<td class="text-center"><?=$o->payment_amount?> ₺</td>

											</tr>

										</tbody>
									</table><hr>
								</div>
							</div>
							<div class="col-md-12">
								<div class="pull-right m-t-28 text-right">
									<?php

									$Toplam = $o->payment_amount;
									$Kdv = ceil($Toplam / 100 * 18);
									$Genel = $Toplam - $Kdv;

									?>
									<hr>
									<h3 style="margin-top: 15px;" ><b>Genel Toplam :</b> <?=$Genel?> ₺</h3> 
									<h3 style="margin-top: 15px;" ><b>KDV Tutarı :</b> <?=$Kdv?> ₺</h3> 
									<hr>
									<h3 style="margin-top: 15px;" ><b>Toplam Tutar :</b> <?=$Toplam?> ₺</h3> 
									<hr>


									<p>Bu fatura otomasyon sistemi tarafından oluşturulmuş olup bilgilendirme amaçlıdır.
										<p style="margin-top: 15px;" >Mali değeri yoktur.

										</div>
										<div class="clearfix"></div>
										<hr>
										<div class="text-right">
											<button onclick="javascript:window.print();" class="btn btn-default btn-outline d-print-none" type="button"> <span><i class="fa fa-print"></i> Yazdır</span> </button>
										</div>
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