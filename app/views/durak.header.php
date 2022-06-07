<?php

new_session();

if ( !isset($_GET['load']) ) :

  ?>
  <!DOCTYPE html>
  <html lang="tr">
  <!-- BEGIN HEAD -->
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="Yapay zeka destekli online taksi durağınızı oluşturun. Müşteri potansiyelinizi arttırın, gelirinizi katlayın.">
    <title><?=say($__PageTitle)?></title>
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
    <!-- icons -->
    <link href="/assets/durak/plugins/simple-line-icons/simple-line-icons.min.css?v=1.0.1" rel="stylesheet" type="text/css" />
    <link href="/assets/durak/plugins/font-awesome/css/font-awesome.min.css?v=1.0.1" rel="stylesheet" type="text/css"/>

    <!--bootstrap -->
    <link href="/assets/durak/plugins/bootstrap/css/bootstrap.min.css?v=1.0.1" rel="stylesheet" type="text/css" />
    <!-- Material Design Lite CSS -->
    <link rel="stylesheet" href="/assets/durak/plugins/material/material.min.css?v=1.0.1">
    <link rel="stylesheet" href="/assets/durak/css/material_style.css?v=1.0.1">
    <link rel="stylesheet" href="/assets/durak/plugins/jquery-toast/dist/jquery.toast.min.css">
    <link rel="stylesheet" href="/assets/durak/plugins/sweet-alert/sweetalert.min.css?v=1.0.1">
    <!-- animation -->
    <link href="/assets/durak/css/pages/animate_page.css?v=1.0.1" rel="stylesheet">
    <!-- Theme Styles -->

    <link href="/assets/durak/css/plugins.min.css?v=1.0.1" rel="stylesheet" type="text/css" />
    <link href="/assets/durak/css/style.css?v=1.0.1" rel="stylesheet" type="text/css" />
    <link href="/assets/durak/css/responsive.css?v=1.0.1" rel="stylesheet" type="text/css" />
    <link href="/assets/durak/css/theme-color.css?v=1.0.1" rel="stylesheet" type="text/css" />
    <link href="/assets/durak/css/pages/formlayout.css?v=1.0.1" rel="stylesheet" type="text/css" />
    <!-- favicon -->
    <link rel="shortcut icon" href="/media/favicon.ico" /> 
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-83139045-12"></script>
    <div id="gtag">
      <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-83139045-12');
      </script>
    </div>
  </head>
  <!-- END HEAD -->
  <body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md dark-sidebar-color logo-red header-red">
    <div class="page-wrapper">
      <!-- start header -->
      <div class="page-header navbar navbar-fixed-top">
        <div class="page-header-inner ">
          <!-- logo start -->
          <div class="page-logo">
            <a onclick="InnerPage(this); return false;" href="/DurakYonetim/HeyTaksi">
              <span class="logo-icon material-icons fa-rotate-45">local_taxi</span>
              <span style="margin-left: 8px;" class="logo-default" > Durağı</span> </a>
            </div>
            <!-- logo end -->
            <ul class="nav navbar-nav navbar-left in">
             <li><a href="javascript:;" onclick="mntggle();" class="menu-toggler sidebar-toggler"><i class="icon-menu"></i></a></li>
           </ul>
           <input type="text" value="1" hidden="" id="men_tggle" >
           <?php
               /*
  <form class="search-form-opened" action="/DurakYonetim/arama" method="post">
                    <div class="input-group">
                        <input type="text" required="" class="form-control" placeholder="Arama yap ..." name="q">
                        <span class="input-group-btn">
                          <button type="submit" style="background: none;" class="btn submit">
                             <i class="icon-magnifier"></i>
                         </button>
                     </span>
                 </div>
             </form>
               */
             ?>
             <!-- start mobile menu -->
             <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
              <span></span>
            </a>
            <!-- end mobile menu -->
            <!-- start header menu -->
            <div class="top-menu">
              <ul class="nav navbar-nav pull-right">
               <!-- start language menu -->
               <li class="dropdown language-switch">
                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> <img src="/assets/durak/img/flags/tr.png" class="position-left" alt="">&nbsp;&nbsp; Türkiye
                </a>
              </li>
              <!-- end language menu -->
              <!-- start notification dropdown -->
              <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                  <i class="fa fa-bell-o"></i>
                  <span style="display: none;" id="notif_c1" class="badge headerBadgeColor1"> ... </span>
                </a>
                <ul class="dropdown-menu animated fadeInDown">
                  <li class="external">
                    <h3><span class="bold">Bildirimler</span></h3>
                    <span id="notif_c2" class="notification-label purple-bgcolor"></span>
                  </li>
                  <li>

                    <ul id="notif_ul" class="dropdown-menu-list small-slimscroll-style" data-handle-color="#637283">

                      <li>
                        <a href="javascript:;">
                          <span class="details">
                            Bildirimler yükleniyor...
                          </a>
                        </li>

                      </ul>
                      <div class="dropdown-menu-footer">

                      </div>
                    </li>
                  </ul>
                </li>
                <!-- end notification dropdown -->
                <!-- start manage user dropdown -->
                <li class="dropdown dropdown-user">
                  <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <span class="username username-hide-on-mobile"> <?=say($_SESSION['Durak']->realname)?> </span>
                    <i class="fa fa-angle-down"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-default animated flipInX">
                    <li>
                      <a onclick="InnerPage(this); return false;" href="/DurakYonetim/Profil">
                        <i class="icon-user"></i> Profilim </a>
                      </li>
                      <li>
                        <a onclick="InnerPage(this); return false;" href="/DurakYonetim/Ayarlar">
                          <i class="icon-settings"></i> Sms Ayarları
                        </a>
                      </li>
                      <li>
                        <a onclick="InnerPage(this); return false;" href="/DurakYonetim/Odemeler">
                          <i class="icon-star"></i> Ödeme Yönetimi
                        </a>
                      </li>
                      <li>
                        <a onclick="InnerPage(this); return false;" href="/DurakYonetim/Destek">
                          <i class="icon-directions"></i> Bize Ulaşın
                        </a>
                      </li>
                      <li>
                        <a href="/DurakYonetim/Cikis">
                          <i class="icon-logout"></i> Çıkış yap </a>
                        </li>
                      </ul>
                    </li>
                    <!-- end manage user dropdown -->
                  </ul>
                </div>
              </div>
            </div>
            <!-- end header -->
            <!-- start page container -->
            <div class="page-container">
              <!-- start sidebar menu -->
              <div class="sidebar-container">
               <div class="sidemenu-container navbar-collapse collapse fixed-menu">
                 <div id="remove-scroll">
                   <ul class="sidemenu  page-header-fixed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                     <li class="sidebar-toggler-wrapper hide">
                       <div class="sidebar-toggler">
                         <span></span>
                       </div>
                     </li>
                     <li class="sidebar-user-panel">
                       <div class="user-panel">
                         <div class="pull-left image">
                          <a href="/DurakYonetim/Profil" onclick="InnerPage(this); return false;" ><img style="background: none;" src="/media/avatars/<?=$_SESSION['Durak']->avatar?>" class="img-circle user-img-circle" alt="Avatar" /></a>
                        </div>
                        <div class="pull-left info">
                         <p><?=say($_SESSION['Durak']->realname)?></p>
                       </div>
                     </div>


                   </li>
                   <li class="nav-item">
                    <a onclick="InnerPage(this); return false;" href="/DurakYonetim" class="nav-link nav-toggle"> <i class="material-icons">home</i>
                     <span class="title">Anasayfa</span> 
                   </a>
                 </li>

                 <li class="nav-item">
                   <a onclick="InnerPage(this); return false;" href="/DurakYonetim/HeyTaksi" class="nav-link nav-toggle"> <i class="material-icons">local_taxi</i>
                     <span class="title">Hey Taksi</span> 
                     <span id="taksi_durum1" style="display:none;margin-right: 0px;animation: 3s ease 0s normal none infinite running fadeIn;" class="label label-rouded label-menu label-info">Şimdilik Sakin</span>
                     <span id="taksi_durum2" style="display:none;margin-right: 3px;animation: 1.7s ease 0s normal none infinite running wobble;" class="label label-rouded label-menu label-warning">Yeni Müşteri</span>
                   </a>
                 </li>

                 <li class="nav-item">
                  <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="material-icons">contacts</i>
                    <span class="title"> Rehberim </span>
                    <span class="arrow"></span>
                  </a>
                  <ul class="sub-menu" style="display: none;">
                    <li class="nav-item">
                      <a onclick="InnerPage(this); return false;" href="/DurakYonetim/TelefonRehberi" class="nav-link ">
                        <span class="title">Kayıtlı Müşterilerim</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a onclick="InnerPage(this); return false;" href="/DurakYonetim/TelefonRehberi/KayıtsızNumaralar" class="nav-link ">
                        <span class="title">Kayıtsız Numaralar</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a onclick="InnerPage(this); return false;" href="/DurakYonetim/TelefonRehberi/YeniKayıt" class="nav-link ">
                        <span class="title">Yeni Kayıt Ekle</span>
                      </a>
                    </li>
                  </ul>
                </li>

                <li class="nav-item">
                  <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="material-icons">message</i>
                    <span class="title"> Mesajlarım </span>
                    <span class="arrow"></span>
                  </a>
                  <ul class="sub-menu" style="display: none;">
                    <li class="nav-item">
                      <a onclick="InnerPage(this); return false;" href="/DurakYonetim/Mesajlar" class="nav-link ">
                        <span class="title">Tüm Mesajlar</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a onclick="InnerPage(this); return false;" href="/DurakYonetim/TopluMesaj" class="nav-link ">
                        <span class="title">Toplu Mesaj Gönder</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a onclick="n_msg();" href="javascript:;" class="nav-link ">
                        <span class="title">Yeni Mesaj Gönder</span>
                      </a>
                    </li>
                  </ul>
                </li>

                <li class="nav-item">
                  <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="material-icons">texture</i>
                    <span class="title"> Taksilerim </span>
                    <span class="arrow"></span>
                  </a>
                  <ul class="sub-menu" style="display: none;">
                    <li class="nav-item">
                      <a onclick="InnerPage(this); return false;" href="/DurakYonetim/TaksiYonetimi" class="nav-link ">
                        <span class="title">Taksilerim</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a onclick="InnerPage(this); return false;" href="/DurakYonetim/TaksiYonetimi/YeniTaksi" class="nav-link ">
                        <span class="title">Yeni Araç Ekle</span>
                      </a>
                    </li>
                  </ul>
                </li>

                <li class="nav-item">
                  <a onclick="InnerPage(this); return false;" href="/DurakYonetim/Whatsapp" class="nav-link nav-toggle"> <i class="fa fa-whatsapp"></i>
                    <span style="margin-left: -4px;" class="title">Whatsapp</span> 
                  </a>
                </li>

                <li class="nav-item">
                  <a onclick="InnerPage(this); return false;" href="/DurakYonetim/Ayarlar" class="nav-link nav-toggle"> <i class="material-icons">settings</i>
                    <span class="title">Mesaj Ayarları</span> 
                  </a>
                </li>

                <li class="nav-item">
                  <a onclick="InnerPage(this); return false;" href="/DurakYonetim/Profil" class="nav-link nav-toggle"> <i class="material-icons">account_circle</i>
                    <span class="title">Profilim</span> 
                  </a>
                </li>

                <li class="nav-item">
                  <a onclick="InnerPage(this); return false;" href="/DurakYonetim/Odemeler" class="nav-link nav-toggle"> <i class="material-icons">star</i>
                    <span class="title">Ödeme Yönetimi</span> 
                  </a>
                </li>

                <li class="nav-item">
                  <a onclick="InnerPage(this); return false;" href="/DurakYonetim/Destek" class="nav-link nav-toggle"> <i class="material-icons">help_outline</i>
                    <span class="title">Bize Ulaşın</span> 
                  </a>
                </li>

                <li class="nav-item">
                  <a href="/DurakYonetim/Cikis" class="nav-link nav-toggle"> <i class="material-icons">exit_to_app</i>
                    <span class="title">Güvenli Çıkış</span> 
                  </a>
                </li>


              </ul>
            </div>
          </div>
        </div>
        <!-- end sidebar menu -->
        <div id="PageContent">

          <?php

        else :

          echo '{{'.say($__PageTitle).'}}|||';

          endif; ?>