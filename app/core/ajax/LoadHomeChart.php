<?php

new_session();
$UID = $_SESSION['Durak']->id;

$left = 0;
$Back = time()-(60*60*24*30);

$Back12 = time()- 31556926;
$Now = time();

$ArrayM = array();
$Array1 = array();
$Array2 = array();
$Array3 = array();
$Array4 = array();

$aylar = array(
	1=>"Ocak",
	2=>"Şubat",
	3=>"Mart",
	4=>"Nisan",
	5=>"Mayıs",
	6=>"Haziran",
	7=>"Temmuz",
	8=>"Ağustos",
	9=>"Eylül",
	10=>"Ekim",
	11=>"Kasım",
	12=>"Aralık"
);

$NN = 0;

while ( $Now > $Back12 ) {

	$NN++;

	$i = intval(ltrim(gmdate('m',$Now),'0'));
	$im = intval(ltrim(gmdate('m',$Now),'0'));
	$y = gmdate('Y',$Now);

	$ii = $i+1;

	if ( $ii > 12 ) $ii = $ii - 12;

	if ( strlen($i) == 1 ) $i = '0'.$i;
	if ( strlen($ii) == 1 ) $ii = '0'.$ii;


	$Unix1 = strtotime('01.'.$i.'.'.$y);
	$Unix2 = strtotime('01.'.$ii.'.'.$y);


	$Stat1_Q = $db->query("SELECT count(*) FROM hey_taksi where status=2 and user_id='$UID' and req_time > '$Unix1' and req_time < '$Unix2' ")->fetchColumn();
	$Stat2_Q = $db->query("SELECT count(*) FROM contact where status=1 and user_id='$UID' and added_time > '$Unix1' and added_time < '$Unix2' ")->fetchColumn();
	$Stat3_Q = $db->query("SELECT count(*) FROM sms_log where sender_user='$UID' and send_time > '$Unix1' and send_time < '$Unix2' ")->fetchColumn();
	$Stat4_Q = $db->query("SELECT count(*) FROM sms_log where receiver='$UID' and send_time > '$Unix1' and send_time < '$Unix2' ")->fetchColumn();

	if ( $Stat1_Q != 0 || $Stat2_Q != 0 || $Stat3_Q != 0 || $Stat4_Q != 0  ) {

		array_push($ArrayM, $aylar[$im].' -'.str_replace('20', '', $y));
		array_push($Array1, $Stat1_Q);
		array_push($Array2, $Stat2_Q);
		array_push($Array3, $Stat3_Q);
		array_push($Array4, $Stat4_Q);

	} else {

		if ( $NN < 4 ) {

			array_push($ArrayM, $aylar[$im].' -'.str_replace('20', '', $y));
			array_push($Array1, $Stat1_Q);
			array_push($Array2, $Stat2_Q);
			array_push($Array3, $Stat3_Q);
			array_push($Array4, $Stat4_Q);

		}

	}

	$Now = $Now - (60*60*24*30);

}

$ArrayM = array_reverse($ArrayM);
$Array1 = array_reverse($Array1);
$Array2 = array_reverse($Array2);
$Array3 = array_reverse($Array3);
$Array4 = array_reverse($Array4);


echo json_encode(array(
	'ChartTitle' => 'Görüntülemek istediğiniz veri tipinin üzerine tıklayarak görünüm durumunu değiştirebilirsiniz.',
	'labels' => $ArrayM,
	'datasets' => array( array(
		'label' => 'Toplam sefer',
		'backgroundColor' => '#fda582',
		'hidden' => false,
		'borderColor' => '#fda582',
		'fill' => false,
		'data' => $Array1
	),array(
		'label' => 'Toplam müşteri',
		'backgroundColor' => '#9ce89d',
		'borderColor' => '#9ce89d',
		'fill' => false,
		'data' => $Array2
	),array(
		'label' => 'Gönderilen sms',
		'hidden' => false,
		'backgroundColor' => '#a890d3',
		'borderColor' => '#a890d3',
		'fill' => false,
		'data' => $Array3
	),array(
		'label' => 'Alınan sms',
		'hidden' => false,
		'backgroundColor' => '#72c2ff',
		'borderColor' => '#72c2ff',
		'fill' => false,
		'data' => $Array4
	))

));