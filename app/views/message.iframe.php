  <?php

  $Nbm = '+'.str_replace(array('-',' '), array('',''), @$_GET['N']);

  new_session();

  $UID = $_SESSION['Durak']->id;

  $RName = @$_GET['R'];

  $SingleChat = $db->query("SELECT * FROM sms_log  where (sender_user='$UID' and receiver='$Nbm') or (sender_user='$Nbm' and receiver='$UID')  ORDER BY id ASC ", PDO::FETCH_ASSOC);



  ?>
  <!DOCTYPE html>
  <html lang="tr">
  <!-- BEGIN HEAD -->
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="Taksi durağı yönetim paneli" />
    <meta name="author" content="Muhammed Arslan" />
    <title>Taksi Durağı Yönetim Paneli</title>
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
    <!-- icons -->
    <link href="/assets/durak/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/durak/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

    <!--bootstrap -->
    <link href="/assets/durak/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Material Design Lite CSS -->
    <link rel="stylesheet" href="/assets/durak/plugins/material/material.min.css">
    <link rel="stylesheet" href="/assets/durak/css/material_style.css">
    <link rel="stylesheet" href="/assets/durak/plugins/sweet-alert/sweetalert.min.css">
    <!-- animation -->
    <link href="/assets/durak/css/pages/animate_page.css" rel="stylesheet">
    <!-- Theme Styles -->
    
    <link href="/assets/durak/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/durak/css/style.css" rel="stylesheet" type="text/css" />
    <link href="/assets/durak/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="/assets/durak/css/theme-color.css" rel="stylesheet" type="text/css" />
    <link href="/assets/durak/css/pages/formlayout.css" rel="stylesheet" type="text/css" />
    <!-- favicon -->
    <link rel="shortcut icon" href="/media/favicon.ico" /> 
    <script type="text/javascript">
      var isInIFrame = (window.location != window.parent.location);
      if(isInIFrame!=true){
        window.location = '/DurakYonetim';
      }
    </script>
  </head>
  <body style="background-color: #ffffff;" >
    <!-- END HEAD -->
    <div class="card-body no-padding height-9">
      <div class="row">
        <ul id="chat_ul" class="chat nice-chat chat-page small-slimscroll-style">
          <?php

          foreach ($SingleChat as $row ) {

            if ( $row['sender_user'] == $UID ) {

              echo '          <li class="out"><img src="/media/favicon.ico" class="avatar" alt="">
              <div class="message">
              <span class="arrow"></span> <a class="name" href="javascript:;">'.$_SESSION['Durak']->realname.'</a> <span class="datetime"> / '.date('d.m.Y H:i',$row['send_time']).'</span> 
              <span class="body">'.say($row['message']).'</span>
              </div>
              </li>';

            } else {

              echo '          <li class="in"><img src="';
              if ( $RName == '' ) { echo '/media/favicon.ico'; } else { echo '/media/avatars/default/'.mb_strtoupper(substr(say($RName), 0,1)).'.png'; }
              echo'" class="avatar" alt="">
              <div class="message">
              <span class="arrow"></span> <a class="name" href="javascript:;">'; 
              if ( $RName == '' ) { echo '+90 '.str_replace(array('(',')'), '', pnumber($Nbm)); } else { echo $RName; }
              echo'</a> <span class="datetime"> / '.date('d.m.Y H:i',$row['send_time']).'</span> 
              <span class="body">'.say($row['message']).'</span>
              </div>
              </li>';

            }


          }


          ?>
        </ul>
</div></div>
    </body>
    <script src="/assets/durak/plugins/jquery/jquery.min.js" ></script>
    <script src="/assets/durak/plugins/popper/popper.min.js" ></script>
    <script src="/assets/durak/plugins/jquery-blockui/jquery.blockui.min.js" ></script>
    <script src="/assets/durak/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- bootstrap -->
    <script src="/assets/durak/plugins/bootstrap/js/bootstrap.min.js" ></script>
    <!-- counterup -->
    <script src="/assets/durak/plugins/counterup/jquery.waypoints.min.js" ></script>
    <script src="/assets/durak/plugins/counterup/jquery.counterup.min.js" ></script>
    <!-- Common js-->
    <script src="/assets/durak/js/app.js" ></script>
    <script src="/assets/durak/js/ext.js" ></script>
    <script src="/assets/durak/js/layout.js" ></script>
    <script src="/assets/durak/js/theme-color.js" ></script>
    <script src="/assets/durak/plugins/sweet-alert/sweetalert.min.js" ></script>