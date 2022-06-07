<?php



$OrderID = @$_POST['platform_order_id'];


if ( isset($_POST['status']) && $_POST['status'] == 'success' ) {

	global $db;

	$query = $db->query("SELECT * FROM pay WHERE token = '{$OrderID}' ORDER BY id desc ")->fetch(PDO::FETCH_ASSOC);
	if ( $query ){
		
		$User = $query['user_id'];
		$Type = $query['type'];

		if ( $Type == '1' ) { $AddTime = 60*60*24*30; $Am = 198; } else
		if ( $Type == '2' ) { $AddTime = 60*60*24*365; $Am = 1987; } else
		if ( $Type == '3' ) { $AddTime = 60*60*24*365*3; $Am = 5987; } else
		{ $AddTime = 3; }

		$UserS = $db->query("SELECT * FROM users WHERE id = '{$User}'")->fetch(PDO::FETCH_ASSOC);

		$NewFT = $UserS['finished_time'] + $AddTime;

		$query = $db->prepare("UPDATE users SET
			finished_time = :bir
			WHERE id = :iki");
		$update = $query->execute(array(
			"bir" => $NewFT,
			"iki" => $User
		));


		$query = $db->prepare("INSERT INTO payments SET
			user_id = :bir,
			payment_amount = :iki,
			payment_time = :uc,
			payment_id = :dort,
			token = :bes");
		$insert = $query->execute(array(
			"bir" => $User,
			"iki" => $Am,
			"uc" => time(),
			"dort" => $_POST['payment_id'],
			"bes" => random(20)
		));

		$delete = $db->exec("DELETE FROM pay WHERE user_id = '$User' ");

		header("Location:/PaymentSuccess");
		exit;

	} else {

		header("Location:/pPaymentFailed");
		exit;

	}

} else {

	header("Location:/pPaymentFailed");
	exit;

}