<?php

$FormStep1 = '<center><h3>Adım 1 - Hesap bilgileri</h3></center>

<form action="javascript:;" method="post" id="step_form" novalidate="" class="login100-form validate-form">
<div class="wrap-input100 validate-input m-b-26" data-validate="Bu alan zorunludur">
<span class="label-input100">Kullanıcı adı</span>
<input class="input100" type="text" name="username" placeholder="Bu bilgiyi panelinize giriş yaparken kullanacaksınız.">
<span class="focus-input100"></span>
</div>
<input type="text" hidden="" value="step1" name="step">

<div class="wrap-input100 validate-input m-b-18" data-validate = "Bu alan zorunludur">
<span class="label-input100">Şifre</span>
<input class="input100" type="password" name="pass" placeholder="Bu bilgiyi panelinize giriş yaparken kullanacaksınız.">
<span class="focus-input100"></span>
</div>

<div style="margin-top: 40px;" class="container-login100-form-btn">
<button class="login100-form-btn">
Devam Et
</button>
</div>
</form>';

if ( isset($_GET['ref']) && $_GET['ref'] != '' ) {
	$FRef = clear($_GET['ref']);
} else {
	$FRef = '';
}

$FormStep2 = '<center><h3>Adım 2 - Sizi Tanıyalım</h3></center>

<form action="javascript:;" method="post" id="step_form" novalidate="" class="login100-form validate-form">
<input type="text" hidden="" value="step2" name="step">

<div class="wrap-input100 validate-input m-b-26" data-validate="Bu alan zorunludur">
<span class="label-input100">Adınız & Soyadınız</span>
<input class="input100" type="text" name="bir" placeholder="Size nasıl hitap edebiliriz?">
<span class="focus-input100"></span>
</div>

<div class="wrap-input100 validate-input m-b-26" data-validate="Bu alan zorunludur">
<span class="label-input100">Telefon numaranız</span>
<input class="input100" type="text" id="TlfMask" name="iki" placeholder="Telefon numaranız. (5xx) xxx xx xx">
<span class="focus-input100"></span>
</div>

<div class="wrap-input100 validate-input m-b-26" data-validate="Bu alan zorunludur">
<span class="label-input100">E-posta adresiniz</span>
<input class="input100" type="email" name="uc" placeholder="E-posta adresiniz.">
<span class="focus-input100"></span>
</div>
<hr>
<p>Eğer bizi tanımanızda yardımcı olmuş bir kişi var ise kendisine buradan referans puanı kazandırabilirsiniz. Bu alan zorunlu değildir, boş olarak da bırakabilirsiniz.</p>
<br>
<div class="wrap-input100 m-b-26">
<span class="label-input100">Referans Kullanıcı</span>
<input class="input100" type="text" value="'.$FRef.'" name="ref" placeholder="Referans vermek istediğiniz kişinin kullanıcı adı.">
<span class="focus-input100"></span>
</div>


<div style="margin-top: 40px;" class="container-login100-form-btn">
<button class="login100-form-btn">
Devam Et
</button>
</div>
</form>
<script type="text/javascript">

$(document).ready(function()
{
	$("#TlfMask").mask("(599) 999 99 99");
	})
	</script>';



	$FormStep3 = '<center><h3>Adım 3 - Durağınızı Tanıyalım</h3></center>

	<form action="javascript:;" method="post" id="step_form" novalidate="" class="login100-form validate-form">
	<input type="text" hidden="" value="step3" name="step">

	<div class="wrap-input100 validate-input m-b-26" data-validate="Bu alan zorunludur">
	<span class="label-input100">Durağınızın adı</span>
	<input class="input100" type="text" name="bir" placeholder="Taksi durağınızın adı.">
	<span class="focus-input100"></span>
	</div>


	<div class="wrap-input100 validate-input m-b-26" data-validate="Bu alan zorunludur">
	<span class="label-input100">Durağınızın adresi</span>
	<textarea onclick="$('."'#txt_h'".').attr('."'style'".','."'height:50px;'".');" id="txt_h" class="input100" name="iki" placeholder="Taksi durağınızın adresi." style=""></textarea>
	<span class="focus-input100"></span>
	</div>


	<div style="margin-top: 40px;" class="container-login100-form-btn">
	<button class="login100-form-btn">
	Devam Et
	</button>
	</div>
	</form>';

	$FormStep4 = '<center>
	<h3>Kaydınızı başarıyla aldık, teşekkür ederiz.</h3>
	<hr>
	<h4>Şimdi sıra 850'."'".'li numara almakta.</h4>
	<h5 style="margin-top:10px;" >Buna gelen mesajları yönetebilmemiz için ihtiyacımız var.</h5>
	<hr>
	<h5>Bu konuda Türkiye'."'".'nin en kaliteli telekom operatörlerinden</h5>
	<h5 style="margin-top:10px;" >Netgsm'."'".'i tavsiye etmekteyiz.</h5>

	<hr>
	<h5>Durağınıza kayıtlı bir dijital numaranız <small>(850)</small></h5>
	<h5 style="margin-top:10px;" >var ise devam et butonu ile devam edebilirsiniz.</h5>
	<hr>
	<h5>Eğer kayıtlı bir dijital numaranız yok ise</h5>
	<h5 style="margin-top:10px;" >Abonelik oluştur butonu ile aboneliğinizi oluşturup</h5>
	<h5 style="margin-top:10px;" >işlemlere devam edebilirsiniz.</h5>
	<hr><br>
	<form action="javascript:;" method="post" id="step_form" novalidate="" class="validate-form" >
	<input type="text" hidden="" value="step5" name="step">
	<a href="http://www.vadimgsm.com/bilgilendirme" target="_blank"><button style="margin-right:50px;" type="button" class="btn btn-outline-primary btn-lg">Abonelik oluştur</button></a>

	<button onclick="$('."'#step_form'".').submit();" type="button" class="btn btn-outline-success btn-lg">Devam et</button>
	</form>
	<div style="height:80px;"></div>
	</center>';


	$FormStep5 = '<center><h3>Adım 4 - Son Adım</h3>
	<br>
	<p style="padding:15px;" >Müşterilerizden gelen ve müşterilerinize giden mesajları yönetebilmemiz için hesabınızda birkaç değişiklik yapmamız gerekli. Bu değişiklikleri yapabilmemiz ve sms haklarınızı tanımlayabilmemiz için lütfen netgsm hesap bilgilerinizi giriniz.</p>
	</center>
	<hr>
	<form action="javascript:;" method="post" id="step_form" novalidate="" class="login100-form validate-form">
	<input type="text" hidden="" value="step4" name="step">

	<div class="wrap-input100 validate-input m-b-26" data-validate="Lütfen bu alanı doldurun">
	<span class="label-input100">Kullanıcı Adı veya Abone No</span>
	<input class="input100" type="text" name="bir" placeholder="Netgsm kullanıcı adı veya abone numaranız.">
	<span class="focus-input100"></span>
	</div>


	<div class="wrap-input100 validate-input m-b-26" data-validate="Lütfen bu alanı doldurun">
	<span class="label-input100">Şifre</span>
	<input class="input100" type="text" name="iki" placeholder="Netgsm şifreniz.">
	<span class="focus-input100"></span>
	</div>


	<div style="margin-top: 40px;" class="container-login100-form-btn">
	<button class="login100-form-btn">
	Kaydımı Tamamla
	</button>
	</div>
	</form>';

	$FormStep6 = '<center>
	<img style="width:200px;margin-bottom:20px;" src="/media/wp.png"/>
	<h3>Tüm Adımlar Tamamlandı.</h3>
	<hr>
	<h5 style="padding-right:25px;padding-left:25px;" >Birkaç saat içerisinde hesabınızı hazır hale getirip</h5>
	<h5 style="margin-top:10px;" > size bilgi vereceğiz.</h5>
	<br>
	<h5 style="padding-right:25px;padding-left:25px;" >Bizimle olduğunuz için teşekkür ederiz.</h5>

	<div style="margin-top:30px;">
	<a href="/" ><button style="margin-right:50px;" type="button" class="btn btn-outline-info btn-lg">Anasayfaya dön</button></a>

	<a href="/DurakYonetim/Giris"><button type="button" class="btn btn-outline-danger btn-lg">Durak girişi</button></a>
	</div>
	
	<div style="height:40px;"></div>
	</center>';