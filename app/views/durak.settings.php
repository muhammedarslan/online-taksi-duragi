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
					<div class="page-title"><strong style="font-weight: 600;" >Genel Ayarlar</div>
					</div>
					<ol class="breadcrumb page-breadcrumb pull-right">
						<li><a class="parent-item"  onclick="InnerPage(this); return false;" href="/DurakYonetim"><i class="fa fa-taxi"></i>&nbsp;- <?=say($_SESSION['Durak']->realname)?></a>&nbsp;<i class="fa fa-angle-right"></i>
						</li>
						<li class="active">Genel Ayarlar</li>
					</ol>
				</div>
			</div>
			<style type="text/css">
				.form-control{
					border-width: 3px;
					border-radius: 15px;
				}
			</style>
			<div class="row animated fadeIn">
				<div class="col-md-12">
					<!-- BEGIN PROFILE SIDEBAR -->
					<div class="profile-sidebar">

						<div class="card">
							<div class="card-head card-topline-aqua text-center">
								<header>Müşterinin ilk mesajı</header>
							</div>
							<div class="card-body no-padding height-9">
								<div style="margin-top: 10px;" class="row animated fadeIn m-t-10">
									<div class="col-md-12 text-center">
										<p>Yeni bir müşteri kazandığınızı gösteren mesajdır. Müşterilerinizi etkilemek için güzel bir hoş geldin mesajı gönderilebilir.</p>
									</div>
								</div>
							</div>
						</div>

						<div class="card">
							<div class="card-head card-topline-aqua text-center">
								<header>Müşteriyi karşılama mesajı</header>
							</div>
							<div class="card-body no-padding height-9">
								<div style="margin-top: 10px;" class="row animated fadeIn m-t-10">
									<div class="col-md-12 text-center">
										<p>Müşterinizin sizi tercih ettiğini, sizden taksi istediğini gösterir. Müşteriyi kendinize bağlamak için güzel bir fırsattır.</p>
									</div>
								</div>
							</div>
						</div>

						<div class="card">
							<div class="card-head card-topline-aqua text-center">
								<header>Taksi gönderme mesajı</header>
							</div>
							<div class="card-body no-padding height-9">
								<div style="margin-top: 10px;" class="row animated fadeIn m-t-10">
									<div class="col-md-12 text-center">
										<p>Kontrol panelinizde bulunan Hey Taksi alanında müşterilerinizin taksi talepleri görünür. Bu alandan bir taksi gönderdiğinizde bu mesaj gönderilir.</p>
									</div>
								</div>
							</div>
						</div>

						<div class="card">
							<div class="card-head card-topline-aqua text-center">
								<header>Müşteri yardım mesajı</header>
							</div>
							<div class="card-body no-padding height-9">
								<div style="margin-top: 10px;" class="row animated fadeIn m-t-10">
									<div class="col-md-12 text-center">
										<p>Müşterilerinize mesajlaşma sisteminiz hakkında bilgi vermek için kullanabileceğiniz alandır. Açıklayıcı ve sade bir anlatımla müşterilerinizin aklında kalıcı olabilirsiniz.</p>
									</div>
								</div>
							</div>
						</div>

						<div class="card">
							<div class="card-head card-topline-aqua text-center">
								<header>Ekstra Mesajlar</header>
							</div>
							<div class="card-body no-padding height-9">
								<div style="margin-top: 10px;" class="row animated fadeIn m-t-10">
									<div class="col-md-12 text-center">
										<p>Kendinize özgü espri, şive gibi mesajlarınızı buraya ekleyebilirsiniz. Bu mesajlaşma sisteminizi daha eğlenceli hale getirecek ve müşterilerinizin size daha bağlı kalmasını sağlayacaktır.</p>
									</div>
								</div>
							</div>
						</div>
						

					</div>
					<!-- END BEGIN PROFILE SIDEBAR -->
					<!-- BEGIN PROFILE CONTENT -->
					<div class="profile-content">
						<div class="row animated fadeIn">
							<div style="width: 100%;" class="card">
								<div class="card-topline-aqua">
									<header></header>
								</div>
								<div class="white-box">
									<div style="margin-top:-22px;text-align: center;" class="profile-usertitle-name">Gönderilen Mesajlar</div>
									<div style="text-align: center;" class="profile-usertitle-job">Müşterilerinize gönderilecek smsleri buradan ayarlayabilirsiniz.</div>
									<!-- Tab panes -->
									<div class="tab-content">
										<div class="tab-pane active fontawesome-demo" id="tab1">
											<div id="biography" >
												<form style="text-align: center;" action="javascript:;" method="post" id="form_sample_2" class="form-horizontal" novalidate="novalidate">
													<div class="profile-usertitle">
													</div>
													<hr>
													<p>Müşterilerinizin adı, adresi veya gönderilen taksinin plakası gibi değişken değerler aşağıda yer alan mesajlarda <strong>yüzde işaretleri (%)</strong> içerisinde temsil edilerek belirtilmiştir.</p>

													<p><strong>Yüzde işaretleri (%)</strong> içerisinde yer alan değerler değişken değerlerdir. Kullanabileceğiniz değişken değerler şu şekildedir:</p>
													<div class="row">
														<div class="col-md-4 col-6 b-r"> <strong>Müşterinin adı</strong>
															<br>
															<p class="text-muted">%MüşteriAdı%</p>
														</div>
														<div class="col-md-4 col-6 b-r"> <strong>Müşterinin adresi</strong>
															<br>
															<p class="text-muted">%MüşteriAdresi%</p>
														</div>
														<div class="col-md-4 col-6 b-r"> <strong>Taksi durağının adı</strong>
															<br>
															<p class="text-muted">%Durak%</p>
														</div>

													</div>
													<div class="row">
														<div class="col-md-4 col-6 b-r"> <strong>Gönderilen taksi plakası</strong>
															<br>
															<p class="text-muted">%TaksiPlakası%</p>
														</div>
														<div class="col-md-4 col-6 b-r"> <strong>Gönderilen taksi tanımı</strong>
															<br>
															<p class="text-muted">%TaksiTanımı%</p>
														</div>
														<div class="col-md-4 col-6 b-r"> <strong>Ortalama geliş süresi</strong>
															<br>
															<p class="text-muted">%TaksiZamanı%</p>
														</div>

													</div>

													<hr>
													<div style="text-align: center;" class="profile-usertitle-name">Taksi çağırma anahtar söz dizimi</div>
													<div style="margin-top: 10px;" class="alert alert-warning">
														Müşteriniz bu söz dizimini gönderdiğinde yeni taksi istediği anlaşılır.
													</div>
													<div class="form-group">
														<center><input style="text-align: center;width: 60%;" type="text" class="form-control" placeholder="Müşteriniz bu söz dizimini gönderdiğinde yeni taksi istediği anlaşılır." name="taksicagir" value="<?=say($_SESSION['Durak']->f_m)?>"></center>
													</div>
													<hr>
													<div style="text-align: center;" class="profile-usertitle-name">Müşterinin ilk mesajı</div>
													<div style="margin-top: 10px;" class="alert alert-info">
														Bir müşteriniz size ilk defa mesaj attığında bu mesaj gönderilir.
													</div>
													<div class="form-group">
														<center><textarea style="width: 60%;height: 100px;" placeholder="Bir müşteriniz size ilk kez mesaj attığında bu mesaj gönderilir." class="form-control" name="msg1"><?=say($_SESSION['Durak']->f_m_to_user)?></textarea></center>
													</div>

													<hr>
													<div style="text-align: center;" class="profile-usertitle-name">
														Müşteriyi karşılama mesajı
													</div>
													<div style="margin-top: 10px;" class="alert alert-info">
														Müşteriniz taksi çağırma anahtarını kullandığında bu mesaj gönderilir. <p><strong>Müşteriniz bu mesajı onayladığında taksi talep etmiş olur.</strong>
														</div>
														<div class="form-group">
															<center><textarea style="width: 60%;height: 100px;" placeholder="Müşteriniz taksi çağırma anahtarını kullandığında bu mesaj gönderilir." class="form-control" name="msg2"><?=say($_SESSION['Durak']->msg1)?></textarea></center>
														</div>

														<hr>
														<div style="text-align: center;" class="profile-usertitle-name">
															Müşteriye taksi gönderme mesajı
														</div>
														<div style="margin-top: 10px;" class="alert alert-info">
															Müşteriye taksisini gönderdiğinizde bu mesaj gönderilir.
														</div>
														<div class="form-group">
															<center><textarea style="width: 60%;height: 100px;" placeholder="Müşteriye taksisini gönderdiğinizde bu mesaj gönderilir." class="form-control" name="msg7"><?=say($_SESSION['Durak']->msg6)?></textarea></center>
														</div>

														<hr>
														<div style="text-align: center;" class="profile-usertitle-name">
															Müşteri taksi sorgulama mesajı
														</div>
														<div style="margin-top: 10px;" class="alert alert-info">
															Müşteriniz <strong>taksim</strong> veya <strong>taksim nerede</strong> anahtar dizimini kullandığında bu mesaj gönderilir.
														</div>
														<div class="form-group">
															<center><textarea style="width: 60%;height: 100px;" placeholder="Müşteriniz taksim veya taksim nerede anahtar dizimini kullandığında bu mesaj gönderilir" class="form-control" name="msg3"><?=say($_SESSION['Durak']->msg4)?></textarea></center>
														</div>
														<hr>
														<div style="text-align: center;" class="profile-usertitle-name">
															Müşteri adres sorgulama mesajı
														</div>
														<div style="margin-top: 10px;" class="alert alert-info">
															Müşteriniz <strong>adresim</strong> anahtar dizimini kullandığında bu mesaj gönderilir.
														</div>
														<div class="form-group">
															<center><textarea style="width: 60%;height: 100px;" placeholder="Müşteriniz adresim anahtar dizimini kullandığında bu mesaj gönderilir." class="form-control" name="msg4"><?=say($_SESSION['Durak']->msg2)?></textarea></center>
														</div>

														<hr>
														<div style="text-align: center;" class="profile-usertitle-name">
															Müşteri yardım mesajı
														</div>
														<div style="margin-top: 10px;" class="alert alert-info">
															Müşteriniz <strong>yardım</strong> anahtar dizimini kullandığında bu mesaj gönderilir.
														</div>
														<div class="form-group">
															<center><textarea style="width: 60%;height: 100px;" placeholder="Müşteriniz yardım anahtar dizimini kullandığında bu mesaj gönderilir" class="form-control" name="msg5"><?=say($_SESSION['Durak']->msg3)?></textarea></center>
														</div>
														<hr>
														<div style="text-align: center;" class="profile-usertitle-name">
															Talep anlaşılmadı mesajı
														</div>
														<div style="margin-top: 10px;" class="alert alert-info">
															Gönderilen mesaj herhangi bir söz dizimi ile eşleşmediğinde bu mesaj gönderilir.
														</div>
														<div class="form-group">
															<center><textarea style="width: 60%;height: 100px;" placeholder="Gönderilen mesaj herhangi bir söz dizimi ile eşleşmediğinde bu mesaj gönderilir." class="form-control" name="msg6"><?=say($_SESSION['Durak']->msg5)?></textarea></center>
														</div>
														<hr>
														<button type="submit" class="btn btn-danger">Mesajları Güncelle</button>

														<hr>
														<div style="text-align: center;" class="profile-usertitle-name">
															Ekstra mesajlar
														</div>
														<div style="margin-top: 10px;" class="alert alert-info">
															Kendinize özgü eklemek istediğiniz mesajları buradan ekleyebilirsiniz.
														</div>

														<button style="margin-left: 20px;" type="button" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-primary animated zoomInDown" data-upgraded=",MaterialButton,MaterialRipple">Yeni mesaj ekle<span class="mdl-button__ripple-container"><span class="mdl-ripple is-animating" style="width: 153.568px; height: 153.568px; transform: translate(-50%, -50%) translate(23px, 15px);"></span></span></button>
														
														<div class="table-wrap">
															<div class="table-responsive">
																<table class="table display product-overview mb-30" id="support_table5">
																	<thead>
																		<tr>
																			<th>Anahtar kelimeniz</th>
																			<th>Gönderilecek mesaj</th>
																			<th>Kaldır</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php

																		if ( is_array(json_decode($_SESSION['Durak']->e_m)) ) {

																			foreach (json_decode($_SESSION['Durak']->e_m) as $row ) {
																				
																				echo '<tr>
																				<td>'.$row[0].'</td>
																				<td>'.$row[1].'</td>
																				<td><a onclick="dltmsg('."'".base64_encode($row[0])."'".');" href="javascript:;">Kaldır</a></td>

																				</tr>';

																			}

																		}

																		?>
																		
																	</tbody>
																</table>
															</div>
														</div>




													</form>
													

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
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="exampleModalLabel">Yeni mesaj kaydet</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="n_form" action="" method="post" >
						<div class="md-form">
							<input required="" type="text" name="key" placeholder="Mesajı tetikleyecek anahtar söz dizimi" class="form-control" id="recipient-name">
						</div>
						<br>
						<div class="md-form">
							<textarea required="" type="text" name="text" id="message-text" class="form-control md-textarea" rows="3" placeholder="Mesaj tetiklendiğinde gönderilecek cevap" ></textarea>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
					<button onclick="new_extra();" type="button" class="btn btn-primary">Mesajı kaydet</button>
				</div>
			</div>
		</div>
	</div>



	<?php

	include('durak.footer.php');

	echo '  </body>
	</html>';

	?>