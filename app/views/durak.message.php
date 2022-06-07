<?php

include('durak.header.php');

new_session();

$UID = $_SESSION['Durak']->id;

$CNM = str_replace(array(' ','(',')','-','+'), '', $_Params);

if ( strlen($CNM)  != 12 || !is_numeric($CNM) ) {
  go('DurakYonetim/Mesajlar');
  exit;
}

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
           <li><a class="parent-item"  onclick="InnerMsg(this); return false;" href="/DurakYonetim"><i class="fa fa-taxi"></i>&nbsp;- <?=say($_SESSION['Durak']->realname)?></a>&nbsp;<i class="fa fa-angle-right"></i>
           </li>
           <li class="active">Mesajlar</li>
         </ol>
       </div>
     </div>
     <style type="text/css">
       .slimScrollDiv{
        width: 100% !important;
      }
    </style>

    <a href="javascript:;" onclick="n_msg();" >
        <button style="margin-left: 20px;" type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-danger animated zoomInDown" data-upgraded=",MaterialButton,MaterialRipple">YENİ SOHBET<span class="mdl-button__ripple-container"><span class="mdl-ripple is-animating" style="width: 153.568px; height: 153.568px; transform: translate(-50%, -50%) translate(23px, 15px);"></span></span></button>
      </a>

    <div class="row animated fadeIn">

     <div class="col-sm-4">
       <div class="card card-box">
        <div class="card-head">
          <header>Sohbet Listesi</header>
          <div class="tools">
            <a onclick="reloadContent();" class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
          </div>
        </div>
        <div class="card-body no-padding height-9">
         <div class="collapse collapse-xs collapse-sm show chat-page" id="open-chats">
          <div class="form-group mt-20 is-empty">
            <input id="chat_search" type="text" value="" placeholder="Sohbet ara..." class="form-control">
            <span class="material-input"></span></div>
            <ul class="list-unstyled" id="inbox">

             <?php

             $Chats = $db->query("SELECT * FROM sms_log where sender_user='$UID' or receiver = '$UID' order by id desc ", PDO::FETCH_ASSOC);
             $Class = '';
             if ( $Chats->rowCount() ){
              $Chatarray = array();
              foreach( $Chats as $row ){

                if ( $row['sender_user'] == $UID ) {

                  if ( !in_array($row['receiver'], $Chatarray) ) {

                    $NMB = $row['receiver'];

                    $ChatPerson = $db->query("SELECT * FROM contact WHERE phone_number = '{$NMB}' and status=1 ")->fetch(PDO::FETCH_ASSOC);

                    if ( '+'.str_replace(array('-',' '), array('',''), $_Params) == $NMB ) {
                      $Class = 'active';
                      $RName = $ChatPerson['realname'];
                    } else {
                      $Class = '';
                    }

                    if ( $ChatPerson ){

                      echo '<li data-name="'.say($ChatPerson['realname']).'" data-numb="+'.seo_link('+90'.pnumber($NMB)).'" class="'.$Class.'">
                      <a onclick="InnerMsg(this); return false;"  href="/DurakYonetim/Mesajlar/+'.seo_link('+90'.pnumber($NMB)).'" class="'.$Class.'">
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

                      echo '<li data-name="'.say($ChatPerson['realname']).'" data-numb="+'.seo_link('+90'.pnumber($NMB)).'"  class="'.$Class.'">
                      <a onclick="InnerMsg(this); return false;"  href="/DurakYonetim/Mesajlar/+'.seo_link('+90'.pnumber($NMB)).'" class="'.$Class.'">
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

                   $ChatPerson = $db->query("SELECT * FROM contact WHERE phone_number = '{$NMB}' and status=1 ")->fetch(PDO::FETCH_ASSOC);

                   if ( '+'.str_replace(array('-',' '), array('',''), $_Params) == $NMB ) {
                    $Class = 'active';
                    $RName = $ChatPerson['realname'];
                  } else {
                    $Class = '';
                  }

                  if ( $ChatPerson ){

                    echo '<li data-name="'.say($ChatPerson['realname']).'" data-numb="+'.seo_link('+90'.pnumber($NMB)).'"  class="'.$Class.'">
                    <a onclick="InnerMsg(this); return false;"  href="/DurakYonetim/Mesajlar/+'.seo_link('+90'.pnumber($NMB)).'" class="'.$Class.'">
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

                    echo '<li data-name="'.say($ChatPerson['realname']).'" data-numb="+'.seo_link('+90'.pnumber($NMB)).'"  class="'.$Class.'">
                    <a onclick="InnerMsg(this); return false;"  href="/DurakYonetim/Mesajlar/+'.seo_link('+90'.pnumber($NMB)).'" class="'.$Class.'">
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
<?php

$Nbm = '+'.str_replace(array('-',' '), array('',''), $_Params);

$SingleChat = $db->query("SELECT * FROM sms_log  where (sender_user='$UID' and receiver='$Nbm') or (sender_user='$Nbm' and receiver='$UID')  ORDER BY id ASC ", PDO::FETCH_ASSOC);

if ( $SingleChat->rowCount() ){
  ?>

  <div class="col-sm-8">
   <div class="card card-box">
    <div class="card-head">
      <header><?php if ( $RName == '' ) { echo '+90 '.str_replace(array('(',')'), '', pnumber($Nbm)); } else { echo $RName; } ?></header>
      <div class="tools">
        <a  onclick="frm_refresh();" class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
      </div>
    </div>
    <div class="card-body no-padding height-9">
      <div class="row">
  <iframe data-srcs = "/DurakYonetim/MesajIframe?N=<?php echo '+90-'.str_replace(array('(',')',' '), array('','','-'), pnumber($Nbm));?>&R=<?=$RName?>" id="msg_frm" scrolling="none" style="border: none;width: 100%;height: 450px;" src="/DurakYonetim/empty"></iframe>
          <div class="box-footer chat-box-submit">
          <form action="javascript:;" id="chat_form" method="post">
            <div class="input-group">
              <input id="nmb_" type="text" hidden="" name="number" value="+90<?=str_replace(array('(',')',' '),'',pnumber($Nbm))?>" >
              <input id="msg_" type="text" name="message" placeholder="Mesajınızı buraya yazınız." class="form-control">
              <input id="msg2_" hidden type="text" value="old" class="form-control">
              <span class="input-group-btn">
                <button style="z-index: 100;" onclick="msg_send_btn();" type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-info" data-upgraded=",MaterialButton,MaterialRipple">Gönder <i class="fa fa-paper-plane-o"></i><span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span></button>
              </span> </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
} else {

  ?>

  <div class="col-sm-8">
   <div class="card card-box">
    <div class="card-head">
      <header>Yeni Sohbet &nbsp; / &nbsp; +90 <?=str_replace(array('(',')'),'',pnumber($Nbm))?></header>
      <div class="tools">
        <a onclick="reloadContent();" class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
      </div>
    </div>
    <div class="card-body no-padding height-9">
     <div class="row">
      <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto;"><ul class="chat nice-chat chat-page small-slimscroll-style" style="overflow: hidden; width: auto;">



      </ul><div class="slimScrollBar" style="background: rgb(158, 165, 171); width: 5px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; height: 402.056px;"></div><div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
      <div class="box-footer chat-box-submit">
        <div style="text-align: center;" class="alert alert-info">
          Bu sohbete ilk mesajı gönderebilirsiniz.
        </div>
        <form action="javascript:;" id="chat_form" method="post">
          <div class="input-group">
            <input id="nmb_" type="text" hidden="" name="number" value="+90<?=str_replace(array('(',')',' '),'',pnumber($Nbm))?>" >
            <input id="msg2_" hidden type="text" value="new" class="form-control">
            <input id="msg_" type="text" name="message" placeholder="Mesajınızı buraya yazınız." class="form-control">
            <span class="input-group-btn">
              <button style="z-index: 100;"  onclick="msg_send_btn();" type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-info" data-upgraded=",MaterialButton,MaterialRipple">Gönder <i class="fa fa-paper-plane-o"></i><span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span></button>
            </span> </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
}
?>



</div>

</div>
</div>
<!-- end page content -->



<?php

include('durak.footer.php');
echo '<script>
setTimeout(()=>{$("#msg_frm").attr("src", $("#msg_frm").attr("data-srcs"));},1000);
  setInterval(()=>{frm_refresh();},60000);
</script>';
echo '  </body>
</html>';

?>