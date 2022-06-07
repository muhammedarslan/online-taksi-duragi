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
					<div class="page-title"><strong style="font-weight: 600;" >Telefon Rehberi</div>
					</div>
					<ol class="breadcrumb page-breadcrumb pull-right">
						<li><a class="parent-item"  onclick="InnerPage(this); return false;" href="/DurakYonetim"><i class="fa fa-taxi"></i>&nbsp;- <?=say($_SESSION['Durak']->realname)?></a>&nbsp;<i class="fa fa-angle-right"></i>
						</li>
						<li class="active">Telefon Rehberi</li>
					</ol>
				</div>
			</div>

			<a onclick="InnerPage(this); return false;" href="/DurakYonetim/TelefonRehberi/YeniKayıt">
				<button style="margin-left: 20px;" type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-success animated zoomInDown" data-upgraded=",MaterialButton,MaterialRipple">YENİ KAYIT EKLE<span class="mdl-button__ripple-container"><span class="mdl-ripple is-animating" style="width: 153.568px; height: 153.568px; transform: translate(-50%, -50%) translate(23px, 15px);"></span></span></button>
			</a>

			<br><br>
			<div class="alert alert-danger animated fadeIn">
				<center style="letter-spacing: 0.3px;" >Farklı bir platformdaki rehberinizi toplu olarak içeri aktarmak istiyorsanız lütfen bizimle <a onclick="InnerPage(this); return false;" href="/DurakYonetim/Destek">iletişime</a> geçiniz.</center>
			</div>

			<div class="alert alert-warning animated fadeIn">
				<center style="letter-spacing: 0.3px;" >Müşterileriniz <a href="https://onlinetaksiduragi.com/d/<?=$_SESSION['Durak']->mini_token?>" target="_blank" >onlinetaksiduragi.com/d/<?=$_SESSION['Durak']->mini_token?></a> adresi üzerinden durağınıza kendileri kayıt olabilirler.</center>
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

							<header>Kayıtlı Müşterileriniz</header>
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
											<th>Adı Soyadı</th>
											<th>Telefon Numarası</th>
											<th>Mesaj Gönder</th>
											<th>Adresi</th>
											<th>Eklenme Zamanı</th>
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
											<th>Adı Soyadı</th>
											<th>Telefon Numarası</th>
											<th>Mesaj Gönder</th>
											<th>Adresi</th>
											<th>Eklenme Zamanı</th>
											<th>-</th>


										</tr>
									</tfoot>
									<tbody style="text-align: center;" >
										

										<?php

										$query = $db->query("SELECT * FROM contact WHERE status='1' and user_id='$UID' order by id DESC ", PDO::FETCH_ASSOC);

										if ( $query->rowCount() ){
											$n = 0;
											foreach( $query as $row ){
												$n++;
												echo '<tr>
												<td>'.$n.'</td>
												<td>'.say($row['realname']).'</td>
												<td><a target="_blank" href="/DurakYonetim/Mesajlar/'.$row['phone_number'].'">'.pnumber($row['phone_number']).'</a> </td>
												<td><a target="_blank" href="/DurakYonetim/Mesajlar/'.$row['phone_number'].'">Tıklayınız</a> </td>
												<td>'.say($row['adres']).'</td>
												<td>'.gmdate('d.m.Y H:i:s',$row['added_time']).' <br><strong> - '.timerformat($row['added_time'],time()).' önce -</strong></td>
												<td><a target="_blank" href="/DurakYonetim/TelefonRehberi/KayıtDuzenle?ID='.clear($row['token']).'">Kişiyi düzenle</a> </td>
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