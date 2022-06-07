<?php

new_session();
$User = $_SESSION['RefUser'];
$_Params['surucu'] = 'Yeni Kayıt';
include('durak.header.customer.php');

?>

<!-- start page content -->
<input type="text" value="NewCustomer" id="page_id" hidden="">
<div class="page-content-wrapper">
	<div class="page-content">
		<div class="page-bar">
			<div class="page-title-breadcrumb animated fadeIn">
				<div class=" pull-left">
					<div class="page-title"><strong style="font-weight: 600;" ><?=say($User['realname'])?></div>
					</div>
					<ol class="breadcrumb page-breadcrumb pull-right">
						<li><a class="parent-item" href="?exit" >- Çıkış yap -</a>
						</li>
					</ol>
				</div>
			</div>

			<div class="animated fadeIn alert alert-info">
				Ödeme talebinde bulunmak için <a target="_blank" href="https://www.r10.net/members/110851-msa.html">R10</a> üzerinden mesaj gönderebilir veya <a target="_blank" href="https://msarslan.com/iletisim">msarslan.com/iletisim</a> adresini kullanabilirsiniz.
			</div>

			<div style="font-size: 20px;" class="row animated fadeIn">
				<div class="col-md-12 col-sm-12">
					<div class="card card-box">
						<div class="card-head">
							<center><header>Ödeme Talebinde Bulun</header></center>
						</div>
						<div class="card-body" id="bar-parent2">
							<form  action="javascript:;" method="post" id="form_sample_2" class="form-horizontal" novalidate="novalidate">
								<div class="form-body">


									<div class="form-group row  margin-top-20">
										<label class="control-label col-md-3">Ad & Soyad
											<span class="required" aria-required="true"> * </span>
										</label>
										<div class="col-md-6">
											<div class="input-icon right">
												<i class="fa"></i>
												<input placeholder="Ad & Soyad" type="text" class="form-control" name="name"> </div>
											</div>
										</div>

										<div class="form-group row  margin-top-20">
											<label class="control-label col-md-3">Telefon Numarası
												<span class="required" aria-required="true"> * </span>
											</label>
											<div class="col-md-6">
												<div class="input-icon right">
													<i class="fa"></i>
													<input
													id="TlfMask" placeholder="(5xx) xxx xx xx" type="text" class="form-control" name="tel"> </div>
												</div>
											</div>

											<div class="form-group row  margin-top-20">
												<label class="control-label col-md-3">IBAN Numarası
													<span class="required" aria-required="true"> * </span>
												</label>
												<div class="col-md-6">
													<div class="input-icon right">
														<i class="fa"></i>
														<input placeholder="Ödeme talep edilen banka hesabı." type="text" class="form-control" name="iban"> </div>
													</div>
												</div>

												<div class="form-group row  margin-top-20">
													<label class="control-label col-md-3">Ödeme Miktarı
														<span class="required" aria-required="true"> * </span>
													</label>
													<div class="col-md-6">
														<div class="input-icon right">
															<i class="fa"></i>
															<input placeholder="Talep edilen ödeme miktarı." type="text" class="form-control" name="c_name"> </div>
														</div>
													</div>

													<div class="form-group row  margin-top-20">
														<label class="control-label col-md-3">Ek Notlar
															<span class="required" aria-required="true"> * </span>
														</label>
														<div class="col-md-6">
															<div class="input-icon right">
																<i class="fa"></i>
																<textarea placeholder="Eklemek istediğiniz not var ise buraya ekleyebilirsiniz." class="form-control" name="adres"></textarea>
															</div>
														</div>
													</div>


												</div>
												<div class="form-group">
													<div class="offset-md-3 col-md-9">
														<button type="submit" class="btn btn-success">Talebimi Gönder</button>
													</div>
												</div>
											</form>
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

											<header>Referanslarınızın Ödemeleri</header>
										</div>
										<div style="font-weight: 400;" class="card-body ">
											<div class="table-scrollable">
												<table id="table" class="display table-striped responsive" style="width:100%;font-weight: 400;">
													<thead>
														<tr>
															<th>Sıra</th>
															<th>Ödenen Hesap</th>
															<th>Ödenen Tutar</th>
															<th>Ödeme Zamanı</th>
															<th>Komisyon Oranınız</th>
															<th>Komisyon Tutarınız</th>


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
															<th>Ödenen Hesap</th>
															<th>Ödenen Tutar</th>
															<th>Ödeme Zamanı</th>
															<th>Komisyon Oranınız</th>
															<th>Komisyon Tutarınız</th>

														</tr>
													</tfoot>
													<tbody style="text-align: center;" >


														<?php

														$USRN = $User['username'];
														$UsersS = $db->query("SELECT * FROM users WHERE ref='$USRN' ", PDO::FETCH_ASSOC);


														if ( $UsersS->rowCount() ){
															$n = 0;

															foreach( $UsersS as $row ){

																$USerID = $row['id'];											
																$Payments = $db->query("SELECT * FROM payments WHERE user_id='$USerID' ", PDO::FETCH_ASSOC);

																foreach ($Payments as $pay ) {
																	$n++;
																	echo '<tr>

																	<td>'.$n.'</td>
																	<td>'.$row['realname'].'</td>
																	<td>'.$pay['payment_amount'].' ₺</td>
																	<td>'.date('d.m.Y H:i:s',$pay['payment_time']).'</td>
																	<td>%25</td>
																	<td>'.round($pay['payment_amount'] * 25 / 100).' ₺</td>

																	</tr>';
																}


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

					include('durak.footer.taxi.php');
					echo '<script async defer src="/assets/durak/js/pages/table/table_data.js?v=1.0.1" ></script>';
					echo '<script async defer src="/assets/durak/js/pages/validation/form-validation.js?v=1.0.1" ></script>';
					echo '<script type="text/javascript">

					$(document).ready(function()
					{
						$("#TlfMask").mask("(999) 999 99 99");
						})
						</script>';
						echo '  </body>
						</html>';
						echo '  </body>
						</html>';

						?>