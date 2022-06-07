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
					<div class="page-title"><strong style="font-weight: 600;" >Toplu mesaj gönder</div>
					</div>
					<ol class="breadcrumb page-breadcrumb pull-right">
						<li><a class="parent-item"  onclick="InnerPage(this); return false;" href="/DurakYonetim"><i class="fa fa-taxi"></i>&nbsp;- <?=say($_SESSION['Durak']->realname)?></a>&nbsp;<i class="fa fa-angle-right"></i>
						</li>
						<li class="active">Toplu mesaj</li>
					</ol>
				</div>
			</div>

			<link rel="stylesheet" type="text/css" href="/assets/durak/css/multi.min.css?v=1.0.1">
			<script defer src="/assets/durak/js/multi.min.js?v=1.0.1"></script>


			<div style="font-size: 20px;" class="row animated fadeIn">
				<div class="col-md-12 col-sm-12">
					<div class="card card-box">
						<div class="card-head">
							<header>Toplu mesaj gönder</header>
						</div>
						<div class="card-body" id="bar-parent2">
							<form  action="javascript:;" method="post" id="form_sample_2" class="form-horizontal" novalidate="novalidate">
								<div class="form-body">

									<center>
										<span id="msg_s" style="font-weight: 400;display: none;" >Mesajın gönderileceği kullanıcılar<span class="required" aria-required="true"> * </span></span>
										<div style="margin-bottom: 15px;"></div>
									</center>
									<div class="col-md-12">
										<div class="input-icon right">
											<i class="fa"></i>
											<select multiple="multiple" id="sltc_" name='usr_list[]'>

												<?php

												$query = $db->query("SELECT * FROM contact WHERE status='1' and user_id='$UID' order by id DESC ", PDO::FETCH_ASSOC);

												foreach ($query as $row ) {
													echo '<option value="'.$row['phone_number'].'" >'.$row['realname'].' &nbsp;-&nbsp; '.pnumber($row['phone_number']).'</option>';
												}

												?>

											</select>
										</div>
									</div>


									<hr>
									<div class="form-group row  margin-top-20">
										<label class="control-label col-md-3">Mesaj Başlığı
											<span class="required" aria-required="true"> * </span>
										</label>
										<div class="col-md-6">
											<div class="input-icon right">
												<i class="fa"></i>
												<select name="baslik" class="form-control" >
													<?php

													$Titles = file_get_contents('https://api.netgsm.com.tr/sms/header/?usercode='.$_SESSION['Durak']->sms_user.'&password='.$_SESSION['Durak']->sms_pass);

													$Exp = explode('<br>', $Titles);

													foreach ($Exp as $key) {
														if ( $key != '' ) {
															echo '<option>'.$key.'</option>';
														}
													}

													?>
												</select>
											</div>
										</div>
									</div>

									<div class="form-group row  margin-top-20">
										<label class="control-label col-md-3">Mesajınız
											<span class="required" aria-required="true"> * </span>
										</label>
										<div class="col-md-6">
											<div class="input-icon right">
												<i class="fa"></i>
												<textarea placeholder="Göndermek istediğiniz mesajınızı buraya yazabilirsiniz." class="form-control" name="adres"></textarea>
											</div>
										</div>
									</div>


								</div>
								<div class="form-group">
									<div class="offset-md-3 col-md-9">
										<button type="submit" class="btn btn-success">Mesajları Gönder</button>
										<a style="margin-left: 20px;" href="javascript:;" onclick="hback();" ><button type="button" class="btn btn-default">İptal</button></a>
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

	include('durak.footer.php');
	echo "<script>
	setTimeout(()=>{
		$('select').multi({
			search_placeholder: 'Mesaj göndermek istediğiniz kişileri sağ tarafa taşıyınız.',
			});
			$('#msg_s').fadeIn();
			},1000);
			</script>";
			echo '  </body>
			</html>';

			?>