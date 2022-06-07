<?php

new_session();
$UID = $_SESSION['Durak']->id;

if ( $UID == '18' ){
	echo json_encode(array(
		'status' => 'failed',
		'reload' => false,
		'location' => false,
		'message' => 'Bazı güvenlik nedenlerinden dolayı demo modunda bu özelliği devre dışı bıraktık. Anlayışınız için teşekkür ederiz.'
	));
	exit;
} 

$token = post('token');

$Single = $db->query("SELECT * FROM hey_taksi WHERE user_id = '$UID' and token='$token' ")->fetch(PDO::FETCH_ASSOC);

if ( !$Single ) exit;

$Singdf = $Single['phone_number'];

$Contact = $db->query("SELECT * FROM contact WHERE status='1' and user_id='$UID' and phone_number='$Singdf' ")->fetch(PDO::FETCH_ASSOC);

if ( !$Contact ) exit;

?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title" id="exampleModalLabel">Müşteriye Taksi Gönder - <?=say($Contact['realname'])?></h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<form id="n_form" action="" method="post" >

				<div class="md-form">
					<center>

						<select data-width="60%" required="" id="s_taksi" data-live-search="true" class="selectpicker">
							<option disabled="" >GÖNDERİLECEK TAKSİYİ SEÇİNİZ*</option>
							<?php

							$query = $db->query("SELECT * FROM taxies WHERE user_id='$UID' and status=1 order by id DESC ", PDO::FETCH_ASSOC);

							foreach ($query as $row) {
								echo '<option value="'.$row['id'].'" >'.$row['surucu'].' - '.$row['plaka'].'</option>';
							}

							?>
						</select>


					</center>
				</div>
				<br>
				<div class="md-form">
					<center><input style="width: 40%;" type="number" min="1" name="dakika" placeholder="Kaç dakikada ulaşır?" class="form-control" id="s_dk"></center>
				</div>
				
			</form>
		</div>
		
		<center><button onclick="sendtaxi('<?=$token?>');" type="button" class="btn btn-danger">Taksiyi Gönder</button></center>
		<br>
	</div>
</div>
</div>