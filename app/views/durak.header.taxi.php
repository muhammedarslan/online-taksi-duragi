<?php


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
    <title>Taksi Yolcu Takibi | Online Taksi Durağı</title>
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
  <body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md dark-sidebar-color logo-red header-red sidemenu-closed">
    <div class="page-wrapper">
      <!-- start header -->
      <div class="page-header navbar navbar-fixed-top">
        <div class="page-header-inner ">
          <!-- logo start -->
          <div class="page-logo">
            <a onclick="InnerPage(this); return false;" href="">
              <span class="logo-icon material-icons fa-rotate-45">local_taxi</span>
              <span style="margin-left: 8px;" class="logo-default" > Durağı</span> </a>
            </div>
            <!-- logo end -->
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

             <!-- start header menu -->
             <div class="top-menu">
              <ul style="padding-right: 20px;" class="nav navbar-nav pull-right">
                <!-- start manage user dropdown -->
                <li class="dropdown dropdown-user">
                  <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <span style="display: block !important;" class="username username-hide-on-mobile"> <?=say($_Params['surucu'])?> </span>
                  </a>
                </li>
                <!-- end manage user dropdown -->
              </ul>
            </div>
          </div>
        </div>
        <!-- end header -->
        <!-- start page container -->
        <div class="page-container">


          <div id="PageContent">

            <?php

            endif; ?>