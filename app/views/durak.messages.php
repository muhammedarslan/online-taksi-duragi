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
					<div class="page-title"><strong style="font-weight: 600;" >Mesajlar</div>
					</div>
					<ol class="breadcrumb page-breadcrumb pull-right">
						<li><a class="parent-item"  onclick="InnerPage(this); return false;" href="/DurakYonetim"><i class="fa fa-taxi"></i>&nbsp;- <?=say($_SESSION['Durak']->realname)?></a>&nbsp;<i class="fa fa-angle-right"></i>
						</li>
						<li class="active">Mesajlar</li>
					</ol>
				</div>
			</div>
			<a href="javascript:;" onclick="n_msg();" >
				<button style="margin-left: 20px;" type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-danger animated zoomInDown" data-upgraded=",MaterialButton,MaterialRipple">YENİ SOHBET<span class="mdl-button__ripple-container"><span class="mdl-ripple is-animating" style="width: 153.568px; height: 153.568px; transform: translate(-50%, -50%) translate(23px, 15px);"></span></span></button>
			</a>
			<div id="sttext" style="margin:auto;margin-top:10px;margin-bottom:10px;display: none;">
				<center>
					<h3>Sohbet geçmişiniz bulunmuyor.</h3>
					<h3 style="margin-top: -25px;" >Yeni sohbet başlatmak için Yeni Sohbet butonunu kullanabilirsiniz.</h3>						</center>
				</div>
				<script type="text/javascript">
					setTimeout(()=>{
						$('#sttext').fadeIn();
					},2000);
				</script>
				<div style="display: none;" class="row animated fadeIn">
					<div class="col-sm-4">
						<div class="card card-box">
							<div class="card-head">
								<header>Kullanıcı Listesi</header>
								<div class="tools">
									<a onclick="reloadContent();" class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
								</div>
							</div>
							<div class="card-body no-padding height-9">
								<div class="collapse collapse-xs collapse-sm show chat-page" id="open-chats">
									<div class="form-group mt-20 is-empty">
										<input type="text" value="" placeholder="Ara..." class="form-control">
										<span class="material-input"></span></div>
										<ul class="list-unstyled" id="inbox">

											<?php

											$Chats = $db->query("SELECT * FROM sms_log where sender_user='$UID' or receiver = '$UID' ", PDO::FETCH_ASSOC);
											$Class = '';
											if ( $Chats->rowCount() ){
												$Chatarray = array();
												foreach( $Chats as $row ){

													if ( $row['sender_user'] == $UID ) {

														if ( !in_array($row['receiver'], $Chatarray) ) {

															$NMB = $row['receiver'];
															go('DurakYonetim/Mesajlar/+'.seo_link('+90'.pnumber($NMB)).'');
															$ChatPerson = $db->query("SELECT * FROM contact WHERE phone_number = '{$NMB}' and status=1 ")->fetch(PDO::FETCH_ASSOC);
															if ( $ChatPerson ){

																echo '<li class="'.$Class.'">
																<a href="/DurakYonetim/Mesajlar/+'.seo_link('+90'.pnumber($NMB)).'" class="'.$Class.'">
																<div class="media">
																<div class="media-left thumb thumb-sm">
																<img alt="" class="media-object chat-img" src="/media/avatars/default/'.mb_strtoupper(substr(say($ChatPerson['realname']), 0,1)).'.png"> </div>
																<div class="media-body">
																<p class="media-heading">
																<span class="text-strong">'.say($ChatPerson['realname']).'</span>
																<small class="pull-right">'.timerformat($row['send_time'],time()).' önce</small>
																</p>
																<small class=" message">'.say(substr($row['message'], 0,60)).'</small>
																</div>
																</div>
																</a>
																</li>'; 

															} else {

																echo '<li class="'.$Class.'">
																<a href="/DurakYonetim/Mesajlar/+'.seo_link('+90'.pnumber($NMB)).'" class="'.$Class.'">
																<div class="media">
																<div class="media-left thumb thumb-sm">
																<img alt="" class="media-object chat-img" src="/media/favicon.ico"> </div>
																<div class="media-body">
																<p class="media-heading">
																<span class="text-strong">+90 '.pnumber($NMB).'</span>
																<small class="pull-right">'.timerformat($row['send_time'],time()).' önce</small>
																</p>
																<small class=" message">'.say(substr($row['message'], 0,60)).'</small>
																</div>
																</div>
																</a>
																</li>';   

															}

															array_push($Chatarray, $row['receiver']);
														}
													} else {

														if ( !in_array($row['sender_user'], $Chatarray) ) {

															$NMB = $row['sender_user'];
															go('DurakYonetim/Mesajlar/+'.seo_link('+90'.pnumber($NMB)).'');
															$ChatPerson = $db->query("SELECT * FROM contact WHERE phone_number = '{$NMB}' and status=1 ")->fetch(PDO::FETCH_ASSOC);
															if ( $ChatPerson ){

																echo '<li class="'.$Class.'">
																<a href="/DurakYonetim/Mesajlar/+'.seo_link('+90'.pnumber($NMB)).'" class="'.$Class.'">
																<div class="media">
																<div class="media-left thumb thumb-sm">
																<img alt="" class="media-object chat-img" src="/media/avatars/default/'.mb_strtoupper(substr(say($ChatPerson['realname']), 0,1)).'.png"> </div>
																<div class="media-body">
																<p class="media-heading">
																<span class="text-strong">'.say($ChatPerson['realname']).'</span>
																<small class="pull-right">'.timerformat($row['send_time'],time()).' önce</small>
																</p>
																<small class=" message">'.say(substr($row['message'], 0,60)).'</small>
																</div>
																</div>
																</a>
																</li>';  

															} else {

																echo '<li class="'.$Class.'">
																<a href="/DurakYonetim/Mesajlar/+'.seo_link('+90'.pnumber($NMB)).'" class="'.$Class.'">
																<div class="media">
																<div class="media-left thumb thumb-sm">
																<img alt="" class="media-object chat-img" src="/media/favicon.ico"> </div>
																<div class="media-body">
																<p class="media-heading">
																<span class="text-strong">+90 '.pnumber($NMB).'</span>
																<small class="pull-right">'.timerformat($row['send_time'],time()).' önce</small>
																</p>
																<small class=" message">'.say(substr($row['message'], 0,60)).'</small>
																</div>
																</div>
																</a>
																</li>'; 

															} 

															array_push($Chatarray, $row['sender_user']);
														}
													}


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
			<!-- end page content -->



			<?php

			include('durak.footer.php');

			echo '  </body>
			</html>';

			?>