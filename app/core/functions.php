<?php


function go($get)        {
    $URL= PROTOCOL.DOMAIN.PATH.$get;
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    die('Yönlendiriliyorsunuz...');

}

function clear($mVar)    {
    if(is_array($mVar)){
        foreach($mVar as $gVal => $gVar){
            if(!is_array($gVar)){
                $mVar[$gVal] = htmlspecialchars(strip_tags(urldecode(addslashes(stripslashes(stripslashes(trim(htmlspecialchars_decode($gVar))))))));  
            }else{
                $mVar[$gVal] = TemizVeri($gVar);
            }
        }
    }else{
        $mVar = htmlspecialchars(strip_tags(urldecode(addslashes(stripslashes(stripslashes(trim(htmlspecialchars_decode($mVar))))))));
    }
    return $mVar;

}

function pnumber($number){

    $first = substr($number, 0,3);
    $second = substr($number, 3,3);
    $third = substr($number, 6,3);
    $forth = substr($number, 9,2);
    $five = substr($number, 11,2);

    return '('.$second.') '.$third.' '.$forth.' '.$five;

}

function letter_id() {

    global $db;
    $query = $db->query("SELECT * FROM tokens ORDER by id DESC LIMIT 1 ")->fetch(PDO::FETCH_ASSOC);
    if ( $query ){

        $token = $query['token'];
        $token_id = $query['id'];

        $delete = $db->exec("DELETE FROM  tokens WHERE id='$token_id' ");

        if ( $delete == '1' ) {

            return $token;

        } else {
            letter_id();
        }

    } else {
        die('<center><h2>Kritik bir hata oluştu, lütfen bunu site yöneticisine bildirin ! (hata kodu: 4)</h2></center>');
    }

}

function say($key){

    return stripslashes($key);

}

function random($get)    {
    $token = bin2hex(openssl_random_pseudo_bytes($get) );
    return $token;

}

function random2($get)    {
    $token = bin2hex(openssl_random_pseudo_bytes($get));
    $unix_time = time();
    $token2 = substr($token, 0,20);
    $token3 = str_replace($token2, '', $token);
    $token = $token2.$unix_time.$token3;
    return md5($token);

}

function timerFormat($start_time, $end_time , $std_format = false)
{       
    $total_time = $end_time - $start_time;
    $days       = floor($total_time /86400);        
    $hours      = floor($total_time /3600);     
    $minutes    = intval(($total_time/60) % 60);        
    $seconds    = intval($total_time % 60);     
    $results = "";
    if($std_format == false)
    {
        if($days > 0) $results .= $days . (($days > 1)?" gün ":" gün ");     
        if($hours > 0) $results .= $hours . (($hours > 1)?" saat ":" saat ");        
        if($minutes > 0) $results .= $minutes . (($minutes > 1)?" dk ":" dk ");
        if($seconds > 0) $results .= $seconds . (($seconds > 1)?" sn ":" sn ");


        if ( $seconds > 0  ) {$result = $seconds.' sn';  }
        if ( $minutes > 0  ) {$result = $minutes.' dk';  }
        if ( $hours > 0  ) {$result = $hours.' saat';  }
        if ( $days > 0 ) { $result = $days.' gün'; }

    }
    if ( !isset($result) || $result == '' ) {
        return '0 sn';
    } else {
        return $result;
    }
}

function add_log($id,$msg){

    global $db;

    $query = $db->query("SELECT * FROM users WHERE id = '{$id}' and status='1' ")->fetch(PDO::FETCH_ASSOC);

    if ( !$query ) { header("Location:/DurakYonetim/Cikis"); exit; }

    $query2 = $db->prepare("INSERT INTO action_logs SET
        user_id = ?,
        action = ?,
        report_time = ?");
    $insert = $query2->execute(array(
      $query['id'],clear($msg),time()
  ));

    return '';



}

function add_notification($user,$text,$url,$icon ='<span class="notification-icon circle yellow"><i class="fa fa-taxi"></i></span>'){

    global $db;

    $query = $db->prepare("INSERT INTO notifications SET
        user_id = ?,
        notif_text = ?,
        notif_url = ?,
        notif_icon = ?,
        notif_time = ?,
        token = ?,
        status = ?");
    $insert = $query->execute(array(
     $user,clear($text),$url,$icon,time(),random(15).time().random(15),0
 ));

    return '';

}

function ajax_check($get){
    if(empty(@$_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        http_response_code(401);
        echo json_encode(array(
            'HttpStatusCode' => 401,
            'ResponseType' => 'Error',
            'ResponseMessage' => 'This parameter only accepts ajax request.'
        ));
        die();

    } 

    if ( $get == 'post' ) { if ( !$_POST ) { require_once VDIR.'/ajax_error_http.html'; die(); } }

}

function post($query)    {

    if ( isset($_POST[$query]) && clear($_POST[$query]) != '' ) { 

        return clear($_POST[$query]); 

    } else {

       return ''; 
   }

}

function send_sms($from,$to,$message,$Taksi = array('-','-','-')){

    $Err = false;
    $ErrText = '';
    $KAdi = '';
    $Sifre = '';
    $message = $message.' #'.rand(4,9533);

    $to = str_replace(array(' ','(',')'), '', $to);
    $to = '+'.$to;
    if ( substr($to, 0,1) != '+' ) {
        $to = '+'.$to;
    }

    $to = str_replace('++', '+', $to);

    global $db;

    if ( $from == 'default' ) {

        $KAdi  = SMS_user_code;
        $Sifre = SMS_password;
        $Title = SMS_user_code;
        $query['id'] = 0;
        $query['realname'] = '';

    } else {

        $query = $db->query("SELECT * FROM users WHERE id = '{$from}' and status='1' and sms_user != '' and sms_pass != '' ")->fetch(PDO::FETCH_ASSOC);

        if ( !$query ) {
            $Err = true;
            $ErrText .= ' --- Sistemde kullanıcı bulunamadı.';

        } else {

            $KAdi  = $query['sms_user'];
            $Sifre = $query['sms_pass'];
            $Title = $query['sms_title'];

        }

    }

    if ( $Err == false ) {
        $UID = $query['id'];
        $CheckContact = $db->query("SELECT * FROM contact WHERE phone_number = '$to' and user_id='$UID' and status=1 ")->fetch(PDO::FETCH_ASSOC);
        if ( $CheckContact ){
            $musteri = array(
                'Adı' => $CheckContact['realname'],
                'Adresi' => $CheckContact['adres']
            );
        } else {
            $musteri = array(
                'Adı' => '',
                'Adresi' => ''
            );
        }

        $message = str_replace('%MüşteriAdı%', $musteri['Adı'], $message);
        $message = str_replace('%MüşteriAdresi%', $musteri['Adresi'], $message);
        $message = str_replace('%Durak%', $query['realname'], $message);
        $message = str_replace('%TaksiPlakası%', $Taksi[0], $message);
        $message = str_replace('%TaksiTanımı%', $Taksi[1], $message);
        $message = str_replace('%TaksiZamanı%', $Taksi[2], $message);
        

        $result = file_get_contents('https://api.netgsm.com.tr/sms/send/get/?usercode='.$KAdi.'&password='.$Sifre.'&gsmno='.$to.'&message='.urlencode(clear($message)).'&msgheader='.$Title.'&dil=TR');

        if ( $result == '20' || $result == '30' || $result == '40' || $result == '70' ) {
            $Err = true;
            $ErrText .= ' --- Sms servisi bir hata döndürdü: '.$result;
        } 

    }

    $result = str_replace('00 ', '', $result);

    $query = $db->prepare("INSERT INTO sms_log SET
        sender_user = ?,
        receiver = ?,
        send_time = ?,
        code = ?,
        message = ?");
    $insert = $query->execute(array(
        $from,$to,time(),$result,$message
    ));

    $ProcessId = $db->lastInsertId();

    return $ProcessId;

}

function load_page($filename,$params = array(),$title= 'Online Taksi Durağı')
{

    if ( !file_exists(VDIR.'/'.$filename.'.php') ) {
      die('<center><h2>Bu sayfa ile ilgili bir sorun oluştu. En kısa sürede düzelteceğiz.</h2></center>');
  } else {
    $_Params = $params;
    $__PageTitle = $title;
    global $db;
    require_once VDIR.'/'.$filename.'.php';
}

}

function new_session ()  {
 if (session_status() == PHP_SESSION_NONE) {
   session_start();
}

}

function recatpcha_solve($url){

    $headers[]  = "User-Agent:Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2.13) Gecko/20101203 Firefox/3.6.13";
    $headers[]  = "Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
    $headers[]  = "Accept-Encoding:gzip,deflate";
    $headers[]  = "Accept-Charset:ISO-8859-1,utf-8;q=0.7,*;q=0.7";
    $headers[]  = "Keep-Alive:115";
    $headers[]  = "Connection:keep-alive";
    $headers[]  = "Cache-Control:max-age=0";

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_ENCODING, "gzip");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    $data = curl_exec($curl);
    curl_close($curl);
    
    if ( $data == '' ) {
        return file_get_contents($url);
    } else {
        return $data;
    }

}

function go_home()       {
    $URL= PROTOCOL.DOMAIN.PATH;
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    die('Yönlendiriliyorsunuz...');

}

function reload()        {
    $URL = $_SERVER['REQUEST_URI'];
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    die('Yönlendiriliyorsunuz...');

}

function password($query){

  $pass = sha1(base64_encode(md5(base64_encode($query))));
  $end = substr($pass, 5, 32);
  return $end;

}

function get_ip()        {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    
    return $ipaddress;
    
}

function seo_link($text) {
    $text  = str_replace('&', '', $text);
    $find = array("/Ğ/","/Ü/","/Ş/","/İ/","/Ö/","/Ç/","/ğ/","/ü/","/ş/","/ı/","/ö/","/ç/");
    $degis = array("G","U","S","I","O","C","g","u","s","i","o","c");
    $text = preg_replace("/[^0-9a-zA-ZÄzÜŞİÖÇğüşıöç]/"," ",$text);
    $text = preg_replace($find,$degis,$text);
    $text = preg_replace("/ +/"," ",$text);
    $text = preg_replace("/ /","-",$text);
    $text = preg_replace("/\s/","",$text);
    $text = strtolower($text);
    $text = preg_replace("/^-/","",$text);
    $text = preg_replace("/-$/","",$text);
    $text = str_replace('-amp-', '-', $text);
    return $text;
}