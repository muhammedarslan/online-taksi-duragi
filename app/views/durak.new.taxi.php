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
					<div class="page-title"><strong style="font-weight: 600;" >Yeni taksi</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                       <li><a class="parent-item"  onclick="InnerPage(this); return false;" href="/DurakYonetim"><i class="fa fa-taxi"></i>&nbsp;- <?=say($_SESSION['Durak']->realname)?></a>&nbsp;<i class="fa fa-angle-right"></i>
                       </li>
                       <li class=""><a class="parent-item" href="/DurakYonetim/TaksiYonetimi">Taksilerim</a>&nbsp;<i class="fa fa-angle-right"></i></li>
                       <li class="active">Yeni Taksi</li>
                   </ol>
               </div>
           </div>

           <div class="alert alert-success animated fadeIn">
            <center><strong>Yeni taksi eklemenizin ardından taksi sürücüsüne bilgilendirme mesajı gönderilecektir.</strong></center>
        </div>


        <div style="font-size: 20px;" class="row animated fadeIn">
            <div class="col-md-12 col-sm-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>Yeni taksi</header>
                    </div>
                    <div class="card-body" id="bar-parent2">
                        <form  action="javascript:;" method="post" id="form_sample_2" class="form-horizontal" novalidate="novalidate">
                            <div class="form-body">


                                <div class="form-group row  margin-top-20">
                                    <label class="control-label col-md-3">Aracın Plakası
                                        <span class="required" aria-required="true"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <div class="input-icon right">
                                            <i class="fa"></i>
                                            <input placeholder="Aracın plakası" type="text" class="form-control" name="plaka"> </div>
                                        </div>
                                    </div>

                                    <div class="form-group row  margin-top-20">
                                        <label class="control-label col-md-3">Aracın Sürücüsü
                                            <span class="required" aria-required="true"> * </span>
                                        </label>
                                        <div class="col-md-6">
                                            <div class="input-icon right">
                                                <i class="fa"></i>
                                                <input placeholder="Aracın sürücüsü" type="text" class="form-control" name="surucu"> </div>
                                            </div>
                                        </div>

                                        <div class="form-group row  margin-top-20">
                                            <label class="control-label col-md-3">
                                                Sürücü Telefonu
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input
                                                    <?php
                                                    if ( isset($_GET['N']) && $_GET['N'] != '' ) echo 'value="'.urldecode($_GET['N']).'"';
                                                    ?>
                                                    id="TlfMask" placeholder="(5xx) xxx xx xx" type="text" class="form-control" name="tel"> </div>
                                                </div>
                                            </div>

                                            <div class="form-group row  margin-top-20">
                                                <label class="control-label col-md-3">Aracın Tanımı
                                                    <span class="required" aria-required="true"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <input placeholder="Müşteriye aracı tanıtmak için ek bilgi" type="text" class="form-control" name="bilgi"> </div>
                                                    </div>
                                                </div>

                                                <input hidden="" value="taksiduragi" placeholder="Taksi şöforunun kontrolü için parola" type="password" class="form-control" name="parola">


                                            </div>
                                            <div class="form-group">
                                                <div class="offset-md-3 col-md-9">
                                                    <button type="submit" class="btn btn-success"> Yeni Taksiyi Ekle</button>
                                                    <a style="margin-left: 20px;" href="javascript:;" onclick="hback();" ><button type="button" class="btn btn-default">İptal</button></a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- end page content -->



                <?php

                include('durak.footer.php');
                echo '<script type="text/javascript">

                $(document).ready(function()
                {
                 $("#TlfMask").mask("(999) 999 99 99");
                 })
                 </script>';
                 echo '  </body>
                 </html>';

                 ?>