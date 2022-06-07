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
					<div class="page-title"><strong style="font-weight: 600;" >Kişi Düzenle</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                       <li><a class="parent-item"  onclick="InnerPage(this); return false;" href="/DurakYonetim"><i class="fa fa-taxi"></i>&nbsp;- <?=say($_SESSION['Durak']->realname)?></a>&nbsp;<i class="fa fa-angle-right"></i>
                       </li>
                       <li class=""><a class="parent-item" href="/DurakYonetim/TelefonRehberi">Telefon Rehberi</a>&nbsp;<i class="fa fa-angle-right"></i></li>
                       <li class="active">Kişi Düzenle</li>
                   </ol>
               </div>
           </div>

           <div style="font-size: 20px;" class="row animated fadeIn">
            <div class="col-md-12 col-sm-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>Kişi düzenle</header>
                    </div>
                    <div class="card-body" id="bar-parent2">
                        <form  action="javascript:;" method="post" id="form_sample_2" class="form-horizontal" novalidate="novalidate">
                            <div class="form-body">


                                <div class="form-group row  margin-top-20">
                                    <label class="control-label col-md-3">Adı Soyadı
                                        <span class="required" aria-required="true"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <div class="input-icon right">
                                            <i class="fa"></i>
                                            <input value="<?=say($_Params['realname'])?>" placeholder="Ad & Soyad" type="text" class="form-control" name="name"> </div>
                                        </div>
                                    </div>

                                    <div class="form-group row  margin-top-20">
                                        <label class="control-label col-md-3">Telefon Numarası
                                            <span class="required" aria-required="true"> * </span>
                                        </label>
                                        <div class="col-md-6">
                                            <div class="input-icon right">
                                                <i class="fa"></i>
                                                <input value="<?=pnumber($_Params['phone_number'])?>" id="TlfMask" placeholder="(5xx) xxx xx xx" type="text" class="form-control" name="tel"> </div>
                                            </div>
                                        </div>

                                        <div class="form-group row  margin-top-20">
                                            <label class="control-label col-md-3">Adresi
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <textarea  placeholder="Adres" class="form-control" name="adres"><?=say($_Params['adres'])?></textarea>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="form-group">
                                        <div class="offset-md-3 col-md-9">
                                            <button type="submit" class="btn btn-danger">Kişiyi Düzenle</button>
                                            <a style="margin-left: 20px;" href="javascript:;" onclick="deletes('<?=$_Params['token']?>','contact');" ><button type="button" class="btn btn-warning">Kişiyi Rehberimden Sil</button></a>
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
        echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js" id="theapp"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>';
        echo '<script type="text/javascript">

        $(document).ready(function()
        {
         $("#TlfMask").mask("(999) 999 99 99");
         })
         </script>';
         echo '  </body>
         </html>';

         ?>