<?php

$_Params = $_Params[0];
$TaxiID = $_Params['user_id'];
$User = $db->query("SELECT * FROM users WHERE id='$TaxiID'")->fetch(PDO::FETCH_ASSOC);

include('durak.header.taxi.php');

?>

<!-- start page content -->
<input type="text" value="singletaxi" id="page_id" hidden="">
<div class="page-content-wrapper">
	<div class="page-content">
		<div class="page-bar">
			<div class="page-title-breadcrumb animated fadeIn">
				<div class=" pull-left">
					<div class="page-title"><strong style="font-weight: 600;" >Taksi yolcu takip sayfası</div>
					</div>
					<ol class="breadcrumb page-breadcrumb pull-right">
						<li><a class="parent-item" href="javascript:;" ><i class="fa fa-taxi"></i>&nbsp;- <?=say($User['realname'])?></a>
						</li>
					</ol>
				</div>
			</div>

			<div class="row animated fadeIn">
				<div class="col-sm-12">
					<div class="card card-box">
						<div style="text-align: center;"  class="card-head">
							<header>Son Müşteriniz</header>
							<div class="tools">
								<a onclick="reloadContent();" class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>

							</div>
						</div>
						<div class="card-body ">
							<div class="row">
								<?php
								$Txd = $_Params['id'];
								$query = $db->query("SELECT * FROM hey_taksi WHERE status=2 and taxi_id='$Txd' order by id DESC LIMIT 1 ", PDO::FETCH_ASSOC);

								
								if ( $query->rowCount() ){
									foreach( $query as $row ){
										$PHN = $row['phone_number'];
										$query2 = $db->query("SELECT * FROM contact WHERE status='1' and phone_number='$PHN' ")->fetch(PDO::FETCH_ASSOC);
										if ( $query2 ){
											

											echo '<div class="col-md-12">
											<div class="card card-box">
											<div class="card-body no-padding ">
											<div class="doctor-profile">
											<img src="/media/avatars/default/'.mb_strtoupper(substr(say($query2['realname']), 0,1)).'.png" class="doctor-pic" alt=""> 
											<div class="profile-usertitle">
											<p>
											<div class="doctor-name">'.say($query2['realname']).'
											<p style="margin-top:10px;" >+90 '.pnumber($PHN).'</p>
											<p>'.date('d.m.Y H:i:s',$row['req_time']).'</p>
											<p><strong>- '.timerformat($row['req_time'],time()).' önce -</strong></p>

											</div>
											</div><br>
											<p>'.say($query2['adres']).'</p> 
											</div>
											</div>
											</div>
											</div>';

										}
									}
								} else {
									
									echo '<div style="margin:auto;margin-top:10px;margin-bottom:10px;">
									<center>
									<h3>Henüz müşteriniz bulunmuyor.</h3>		
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

			<?php

			$Txd = $_Params['id'];
			$query = $db->query("SELECT * FROM hey_taksi WHERE status=2 and taxi_id='$Txd' order by id DESC LIMIT 12 ", PDO::FETCH_ASSOC);


			if ( $query->rowCount() ){

				?>

				<div class="row animated fadeIn">
					<div class="col-sm-12">
						<div class="card card-box">
							<div style="text-align: center;"  class="card-head">
								<header>Eski Müşterileriniz</header>
								<div class="tools">
									<a onclick="reloadContent();" class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>

								</div>
							</div>
							<div class="card-body ">
								<div class="row">
									<?php

									$n = 0;
									foreach( $query as $row ){
										$n++;
										if ( $n == 1 ) continue;

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
											<p style="margin-top:10px;" >+90 '.pnumber($PHN).'</p>
											<p>'.date('d.m.Y H:i:s',$row['req_time']).'</p>
											<p><strong>- '.timerformat($row['req_time'],time()).' önce -</strong></p>

											</div>
											</div><br>
											<p>'.say($query2['adres']).'</p> 
											</div>
											</div>
											</div>
											</div>';

										}
									}


									?>

								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>


		</div>
	</div>
	<!-- end page content -->

	<?php

	include('durak.footer.taxi.php');
	?>
	<script>
		setInterval(()=>{

			location.reload();

		},15000);
	</script>
	<?php
	echo '  </body>
	</html>';

	?>