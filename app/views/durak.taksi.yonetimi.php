<?php

include('durak.header.php');

new_session();

$PageDatatable = true;
$UID = $_SESSION['Durak']->id;

?>

<link href="/assets/durak/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
<link href="https://cdn.datatables.net/responsive/1.0.7/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />
<!-- start page content -->
<input type="text" value="contact" id="page_id" hidden="">
<div class="page-content-wrapper">
	<div class="page-content">
		<div class="page-bar">
			<div class="page-title-breadcrumb animated fadeIn">
				<div class=" pull-left">
					<div class="page-title"><strong style="font-weight: 600;" >Taksilerim</div>
					</div>
					<ol class="breadcrumb page-breadcrumb pull-right">
						<li><a class="parent-item"  onclick="InnerPage(this); return false;" href="/DurakYonetim"><i class="fa fa-taxi"></i>&nbsp;- <?=say($_SESSION['Durak']->realname)?></a>&nbsp;<i class="fa fa-angle-right"></i>
						</li>
						<li class="active">Taksilerim</li>
					</ol>
				</div>
			</div>

			<a onclick="InnerPage(this); return false;"  href="/DurakYonetim/TaksiYonetimi/YeniTaksi">
				<button style="margin-left: 20px;" type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-danger animated zoomInDown" data-upgraded=",MaterialButton,MaterialRipple">YENİ TAKSİ EKLE<span class="mdl-button__ripple-container"><span class="mdl-ripple is-animating" style="width: 153.568px; height: 153.568px; transform: translate(-50%, -50%) translate(23px, 15px);"></span></span></button>
			</a>
			
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

							<header>Kayıtlı Taksilerim</header>
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
											<th>Aracın Plakası</th>
											<th>Aracın Sürücüsü</th>
											<th>Aracın Tanımı</th>
											<th>Düzenle</th>
											

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
											<th>Aracın Plakası</th>
											<th>Aracın Sürücüsü</th>
											<th>Aracın Tanımı</th>
											<th>Düzenle</th>


										</tr>
									</tfoot>
									<tbody style="text-align: center;" >
										

										<?php

										$query = $db->query("SELECT * FROM taxies WHERE user_id='$UID' and status=1 order by id DESC ", PDO::FETCH_ASSOC);

										if ( $query->rowCount() ){
											$n = 0;
											foreach( $query as $row ){
												$n++;
												echo '<tr>
												<td>'.$n.'</td>
												<td>'.say($row['plaka']).'</td>
												<td>'.say($row['surucu']).'</td>
												<td>'.say($row['arac']).'</td>
												
												<td><a target="_blank" href="/DurakYonetim/TaksiYonetimi/TaksiDuzenle?ID='.clear($row['token']).'">Taksiyi düzenle</a> </td>
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