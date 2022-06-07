<?php



$gzip_pres = true; 
function gzipKontrol() 
{ 
	$kontrol = str_replace(" ","", 
		strtolower($_SERVER['HTTP_ACCEPT_ENCODING']) 
	); 
	$kontrol = explode(",", $kontrol); 
	return in_array("gzip", $kontrol); 
} 
function ClearSpace($kaynak) 
{ 
	return preg_replace("/\s+/", " ", $kaynak); 
} 
function CacheGzip($kaynak) 
{ 
	global $gzip_pres; 
	$sayfa_cikti = ClearSpace($kaynak); 
	if (!gzipKontrol() || headers_sent() || !$gzip_pres)  
		return $sayfa_cikti; 
	header("Content-Encoding: gzip"); 
	return gzencode($sayfa_cikti); 
}

ob_start("CacheGzip");

require_once VDIR.'/main.header.php';

new_session();

$ContactToken = random2(32);

$_SESSION['CT'] = $ContactToken;

?>


<section class="page-wrapper">

	
	<header class="site-header">
		<nav class="navbar navbar-expand-lg center-brand navbar-transparent-white">
			<div class="container nav-logo-detail-outer">
				<a class="navbar-brand scroll" href="#anasayfa">
					<img src="/media/logo_main.png" alt="logo" class="logo-default">
					<img src="/media/logo_dark.png" alt="logo" class="logo-after-scroll">
				</a>

				<button class="navbar-toggler navbar-toggler-right collapsed" type="button" data-toggle="collapse" data-target=".navbar-collapse"> <i class="fa fa-bars"></i> </button>

				<div class="collapse navbar-collapse d-sm-0 d-md-0">
					<ul class="navbar-nav">
						<li class="nav-item">
							<a class="nav-link active scroll" href="#anasayfa">anasayfa</a>
						</li>
						<li class="nav-item">
							<a class="nav-link scroll" href="#hizmetlerimiz">hizmetlerimiz</a>
						</li>
						<li class="nav-item">
							<a class="nav-link scroll" href="#fiyatlandirma">fiyatlandırma</a>
						</li>
					</ul>
					<ul class="navbar-nav ml-auto">
						<li class="nav-item">
							<a target="_blank" class="nav-link" href="/DurakYonetim">durak girişi</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="/Basla" target="_blank" >hemen başla</a>
						</li>
						<li class="nav-item">
							<a class="nav-link scroll" href="#iletisim">iletişim</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>
	


	
	<section class="main-slider-section" id="anasayfa">
		<div id="rev_slider_346_1_wrapper" class="rev_slider_wrapper fullscreen-container" data-alias="beforeafterslider1" data-source="gallery" style="background:#252525;padding:0px;">
			
			<div id="main-slider-four" class="rev_slider fullscreenbanner" style="display:none;" data-version="5.4.3.3">
				<ul>


					
					<li data-index="rs-965" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="/assets/images/night-100x50.jpg" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="" data-beforeafter='{"moveto":"56%|56%|56%|56%","bgColor":"","bgType":"image","bgImage":"/media/home/online-taksi-duragi.jpeg","bgFit":"cover","bgPos":"center center","bgRepeat":"no-repeat","direction":"horizontal","easing":"Power2.easeInOut","delay":"500","time":"750","out":"fade","carousel":false}'>
						
						<img src="/media/home/taksi-duragini-akillandır.jpeg" alt="" data-bgposition="center center" data-kenburns="on" data-duration="5000" data-ease="Power4.easeOut" data-scalestart="150" data-scaleend="100" data-rotatestart="0" data-rotateend="0" data-blurstart="30" data-blurend="0" data-offsetstart="0 0" data-offsetend="0 0" data-bgparallax="off" class="rev-slidebg" data-no-retina>
						
						<div class="tp-caption main-slider-text  fontface-one   tp-resizeme  tp-blackshadow rs-parallaxlevel-5" id="slide-24-layer-0" data-x="['center','center','center','center']" data-hoffset="['-45','-30','-30','-38']" data-y="['middle','middle','middle','middle']" data-voffset="['-80','110','110','-100']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-beforeafter="before" data-responsive_offset="on" data-frames='[{"delay":2000,"speed":2000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:40px;","to":"o:1;fb:0;","ease":"Power4.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[50,50,50,50]" style="z-index: 16; white-space: nowrap; font-size: 60px; line-height: 120px; font-weight: 700; color: #ffffff;">Durağınızı Akıllandırın</div>

						
						<div class="tp-caption  main-slider-detail-text tp-resizeme rs-parallaxlevel-5" id="slide-24-layer-2" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['80','210','210','120']" data-width="['960','960','960','320']" data-height="none" data-whitespace="normal" data-type="text" data-beforeafter="before" data-responsive_offset="on" data-frames='[{"delay":600,"speed":2000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:40px;","to":"o:1;fb:0;","ease":"Power4.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[5,5,5,5]" style="z-index: 11; min-width: 960px; max-width: 960px; white-space: normal; font-size: 13px; line-height: 20px;letter-spacing: 1px;font-family:Montserrat;color: #000000;background: rgb(255, 214, 88,0.8);border-radius:50px;">Yapay zeka destekli taksi durağınızı oluşturun, <br> müşteri potansitelinizi arttırın, gelirinizi katlayın.
						</div>

						
						<div class="tp-caption background-primary button-setting button-setting-secondary text-color-dark tp-resizeme rs-parallaxlevel-4" id="slide-24-layer-3" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['bottom','bottom','bottom','bottom']" data-voffset="['210','70','70','100']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-beforeafter="before" data-responsive_offset="on" data-frames='[{"delay":700,"speed":2000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:40px;","to":"o:1;fb:0;","ease":"Power4.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"200","ease":"Linear.easeNone","to":"o:1;rX:0;rY:0;rZ:0;z:0;fb:0;","style":"c:rgb(0,0,0);bg:rgb(255,255,255);"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[40,40,40,40]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[45,45,45,45]" style="z-index: 999; white-space: nowrap; font-size: 15px;  font-weight: 400; color: #ffffff; letter-spacing: 1px;font-family:Montserrat;cursor:pointer;"><a style="color: #ffffff;" class="scroll" href="#hizmetlerimiz"> Bizi Tanıyın </a> </div>


						<div class="tp-caption main-slider-text text-color-dark  fontface-one  tp-resizeme  tp-blackshadow rs-parallaxlevel-5" id="slide-24-layer-4" data-x="['center','center','center','center']" data-hoffset="['-45','-30','-30','-38']" data-y="['middle','middle','middle','middle']" data-voffset="['-80','110','110','-100']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-beforeafter="after" data-responsive_offset="on" data-frames='[{"delay":2000,"speed":2000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:40px;","to":"o:1;fb:0;","ease":"Power4.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[50,50,50,50]" style="z-index: 16; white-space: nowrap; font-size: 60px; line-height: 120px; font-weight: 700; color: #ffffff;">Durağınızı Akıllandırın</div>


						
						<div class="tp-caption text-color-dark main-slider-detail-text tp-resizeme rs-parallaxlevel-5" id="slide-24-layer-5" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['80','210','210','120']" data-width="['960','960','960','320']" data-height="none" data-whitespace="normal" data-type="text" data-beforeafter="after" data-responsive_offset="on" data-frames='[{"delay":600,"speed":2000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:40px;","to":"o:1;fb:0;","ease":"Power4.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[5,5,5,5]" style="z-index: 11; min-width: 960px; max-width: 960px; white-space: normal; font-size: 13px; line-height: 20px; font-weight: 400; color: #000000 !important; letter-spacing: 1px;font-family:Montserrat;background:rgb(255, 214, 88,0.8);border-radius:50px;">Yapay zeka destekli taksi durağınızı oluşturun, <br> müşteri potansitelinizi arttırın, gelirinizi katlayın.
						</div>

						
						<div class="tp-caption background-primary button-setting button-setting-secondary  tp-resizeme rs-parallaxlevel-4" id="slide-24-layer-6" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['bottom','bottom','bottom','bottom']" data-voffset="['210','70','70','100']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-beforeafter="after" data-responsive_offset="on" data-frames='[{"delay":700,"speed":2000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:40px;","to":"o:1;fb:0;","ease":"Power4.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"200","ease":"Linear.easeNone","to":"o:1;rX:0;rY:0;rZ:0;z:0;fb:0;","style":"c:rgb(0,0,0);bg:rgb(255,255,255);"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[40,40,40,40]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[45,45,45,45]" style="z-index: 999; white-space: nowrap; font-size: 15px;  font-weight: 400; color: #ffffff; letter-spacing: 1px;font-family:Montserrat;cursor:pointer;"><a class="scroll" href="#hizmetlerimiz"> Bizi Tanıyın </a> </div>



					</li>

				</ul>
				<style type="text/css">
					.tparrows{
						display: none !important;
					}
				</style>
				<div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
			</div>
		</div>
		

	</section>
	


	
	<section class="about-company-section background-grey padding-top-bottom" id="hizmetlerimiz">
		<div class="container">
			
			<div class="about-company-slider-section">
				<div class="about-company-slider swiper-container">
					<div class="swiper-wrapper">
						<div class="swiper-slide">
							<div class="about-company-slide">
								<div class="row">
									<div class="col-lg-6 offset-lg-0 col-md-8 offset-md-2">
										<div class="about-slider-image-section clearfix position-relative">
											<div class="about-slider-images-section-inner">
												<img src="/media/home/sms.jpg" alt="about-slider-image" data-slide="animated" data-animate="zoomIn">
											</div>
											<div class="about-img-gradient-box gradient-bg-green-blue" data-slide="animated" data-animate="zoomIn"></div>
										</div>
									</div>
									<div class="col-lg-6 vertical-align-about-caption">
										<div class="about-slider-img-detail" data-slide="animated" data-animate="fadeInRight">
											<p class="text-color-secondary paragraph-14 fontface-two padding-bottom-25">Sunduğumuz hizmetlerden bazıları</p>
											<h2 class="fontface-one text-color-dark padding-bottom-35"><span class="font-weight-700">SMS Taksi</span> </h2>
											<p class="text-color-dark paragraph-15 padding-bottom-25 text-color-darkgrey">
												Müşterileriniz tek bir kısa mesaj ile 1 dakikadan daha kısa sürede adreslerine taksi çağırsınlar. Siz de hiç uğraşmadan tek bir tık ile taksileri yönlendirin.  
											</p>
											<p class="text-color-dark paragraph-15 padding-bottom-25 text-color-darkgrey">
												Her şey bu kadar basit, tüm kısa mesajlar otomatik olarak önceden ayarladığınız şekilde anında cevaplanır. Bir müşteriniz size mesaj gönderdiğinde adres ve isim bilgisi otomatik olarak size yansıtılır.  
											</p>
											<p class="text-color-dark paragraph-15 padding-bottom-45 text-color-darkgrey">
												Müşterilerinizin gönderdiği kısa mesajlar kendi tarifelerinden 1 kısa mesaj olarak ücretlendirilir. Hiçbir ekstra ücret yansıtılmaz.
											</p>
											<a href="/Basla" target="_blank"  class="button-setting background-secondary text-color-white button-setting-primary">Hemen Başla  </a>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="swiper-slide">
							<div class="about-company-slide">
								<div class="row">
									<div class="col-lg-6 offset-lg-0 col-md-8 offset-md-2">
										<div class="about-slider-image-section clearfix position-relative">
											<div class="about-slider-images-section-inner">
												<img src="/media/home/wp.jpg" alt="about-slider-image" data-slide="animated" data-animate="zoomIn">
											</div>
											<div class="about-img-gradient-box gradient-bg-green-blue" data-slide="animated" data-animate="zoomIn"></div>
										</div>
									</div>
									<div class="col-lg-6 vertical-align-about-caption">
										<div class="about-slider-img-detail" data-slide="animated" data-animate="fadeInRight">
											<p class="text-color-secondary paragraph-14 fontface-two padding-bottom-25">Sunduğumuz hizmetlerden bazıları</p>
											<h2 class="fontface-one text-color-dark padding-bottom-35"><span class="font-weight-700">Whatsapp Taksi</span> </h2>
											<p class="text-color-dark paragraph-15 padding-bottom-25 text-color-darkgrey">
												Müşterileriniz tek bir whatsapp mesajı ile 1 dakikadan daha kısa sürede adreslerine taksi çağırsınlar. Siz de hiç uğraşmadan tek bir tık ile taksileri yönlendirin.  
											</p>
											<p class="text-color-dark paragraph-15 padding-bottom-25 text-color-darkgrey">
												Her şey bu kadar basit, tüm whatsapp mesajları otomatik olarak önceden ayarladığınız şekilde anında cevaplanır. Bir müşteriniz size mesaj gönderdiğinde adres ve isim bilgisi otomatik olarak size yansıtılır.  
											</p>
											<p class="text-color-dark paragraph-15 padding-bottom-45 text-color-darkgrey">
												Whatsapp mesajlaşmaları tamamen ücretsizdir.
											</p>
											<a href="/Basla" target="_blank"  class="button-setting background-secondary text-color-white button-setting-primary">Hemen Başla  </a>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="swiper-slide">
							<div class="about-company-slide">
								<div class="row">
									<div class="col-lg-6 offset-lg-0 col-md-8 offset-md-2">
										<div class="about-slider-image-section clearfix position-relative">
											<div class="about-slider-images-section-inner">
												<img src="/media/home/phone.jpg" alt="about-slider-image" data-slide="animated" data-animate="zoomIn">
											</div>
											<div class="about-img-gradient-box gradient-bg-pink-purple" data-slide="animated" data-animate="zoomIn"></div>
										</div>
									</div>
									<div class="col-lg-6 vertical-align-about-caption">
										<div class="about-slider-img-detail" data-slide="animated" data-animate="fadeInRight">
											<p class="text-color-secondary paragraph-14 fontface-two padding-bottom-25">Çok yakında hizmetinizde</p>
											<h2 class="fontface-one text-color-dark padding-bottom-35"><span class="font-weight-700">Telefon Taksi</span> </h2>
											<p class="text-color-dark paragraph-15 padding-bottom-25 text-color-darkgrey">
												Müşterileriniz kurumsal numaranızı arayıp telesekreter aracılığı ile tek bir tuş ile taksi çağırabilirler. Siz de yine hiçbir uğraşa gerek kalmadan tek bir tık ile müşterinizin talep ettiği taksiyi yönlendirebilirsiniz.  
											</p>
											<p class="text-color-dark paragraph-15 padding-bottom-25 text-color-darkgrey">
												Her şey bu kadar basit, telesekteter konuşmalarını istediğiniz gibi düzenleyebilir, isterseniz kendi sesiniz ile hitap edebilirsiniz. Bir müşteri taksi talep ettiğinde ise otomatik olarak adres ve isim bilgisi size yansıtılır. 
											</p>
											<p class="text-color-dark paragraph-15 padding-bottom-25 text-color-darkgrey">
												Müşterileriniz aramalarından kendi tarifeleri üzerinden standart olarak ücretlendirilir. Hiçbir ekstra ücret yansıtılmaz. 
											</p>
											<p class="text-color-dark paragraph-15 padding-bottom-45 text-color-darkgrey">
												Bu hizmet şu anda test aşamasındadır. En kısa sürede kullanıma hazır hale getirilecektir.
											</p>
											<a href="/Basla" target="_blank"  class="button-setting background-secondary text-color-white button-setting-primary">Hemen Başla  </a>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="swiper-slide">
							<div class="about-company-slide">
								<div class="row">
									<div class="col-lg-6 offset-lg-0 col-md-8 offset-md-2">
										<div class="about-slider-image-section clearfix position-relative">
											<div class="about-slider-images-section-inner">
												<img src="/media/home/taksi-duragi-istatistik.gif" alt="about-slider-image" data-slide="animated" data-animate="zoomIn">
											</div>
											<div class="about-img-gradient-box gradient-bg-green-blue" data-slide="animated" data-animate="zoomIn"></div>
										</div>
									</div>
									<div class="col-lg-6 vertical-align-about-caption">
										<div class="about-slider-img-detail" data-slide="animated" data-animate="fadeInRight">
											<p class="text-color-secondary paragraph-14 fontface-two padding-bottom-25">Sunduğumuz hizmetlerden bazıları</p>
											<h2 class="fontface-one text-color-dark padding-bottom-35"><span class="font-weight-700">Detaylı İstatistikler</span> </h2>
											<p class="text-color-dark paragraph-15 padding-bottom-25 text-color-darkgrey">
												İleriye dönük planlamalarınızı daha kolay yapabilmeniz için sürekli olarak istatisikler tutarız ve bu istatistikleri grafikler halinde size sunarız. 
											</p>
											<p class="text-color-dark paragraph-15 padding-bottom-25 text-color-darkgrey">
												Aylara göre düzenlediğiniz sefer sayınız, kazandığınız yeni müşteriler, toplam müşteri sayınız gibi birçok istatistiksel veriyi size canlı grafikler ile sunarız.
											</p>

											<p class="text-color-dark paragraph-15 padding-bottom-25 text-color-darkgrey">
												Bu grafikleri taksi durağınızın durumunu değerlendirmeniz ve planlamalarınızı daha kolay yapabilmeniz için ücretsiz ve sürekli olarak sunmaya devam edeceğiz.
											</p>
											
											<a href="/Basla" target="_blank"  class="button-setting background-secondary text-color-white button-setting-primary">Hemen Başla  </a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="swiper-pagination d-none d-sm-none d-md-none d-lg-block"></div>
				</div>
			</div>

			
			<div class="about-company-services">
				<div class="section-heading text-center">
					<div class="row">
						<div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">
							<h2 class="fontface-one text-color-dark padding-bottom-35 wow fadeInUp" data-wow-delay="300ms"><strong>Çok</strong> <span class="text-color-secondary font-weight-700">Daha Fazlası</span></h2>
							<p class="paragraph-15 fontface-two text-color-darkgrey wow fadeInUp" data-wow-delay="350ms">
								Yüksek ücretli ve sıkıcı telefon numaralarından kurtulun. Kurumsal firmaların tercihi 850'li numaranıza hemen kavuşun.
							</p>
						</div>
					</div>
				</div>
				<div class="about-company-services-block">
					<div class="row">
						<div class="col-lg-4 offset-lg-0 col-md-6 offset-md-3 offset-sm-0">
							<div class="about-company-services-block-inner background-white text-center wow fadeInUp" data-wow-delay="300ms">
								<div class="about-company-services-block-inner-icon"><i class="fas fa-phone"></i></div>
								<h4 class="fontface-one text-color-dark font-weight-700 padding-bottom-10">Sınırsız iletişim</h4>
								
								<p class="text-color-darkgrey paragraph-14 fontface-two">
								Meşgul çalmayan sınırsız iletişim</p>
							</div>
						</div>
						<div class="col-lg-4 offset-lg-0 col-md-6 offset-md-3 offset-sm-0">
							<div class="about-company-services-block-inner background-white text-center wow fadeInUp" data-wow-delay="350ms">
								<div class="about-company-services-block-inner-icon"><i class="fas fa-location-arrow"></i></div>
								<h5 class="fontface-one text-color-dark font-weight-700 padding-bottom-10">Sınırsız yönlendirme</h5>
								
								<p class="text-color-darkgrey paragraph-14 fontface-two">
								Tüm numaralara sınırsız yönlendirme</p>
							</div>
						</div>
						<div class="col-lg-4 offset-lg-0 col-md-6 offset-md-3 offset-sm-0">
							<div class="about-company-services-block-inner background-white text-center wow fadeInUp" data-wow-delay="400ms">
								<div class="about-company-services-block-inner-icon"><i class="fas fa-globe"></i></div>
								<h5 class="fontface-one text-color-dark font-weight-700 padding-bottom-10">Heryerden kullanım</h5>
								
								<p class="text-color-darkgrey paragraph-14 fontface-two">
								Heryerden kullanım ve yönetim</p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4 offset-lg-0 col-md-6 offset-md-3 offset-sm-0">
							<div class="about-company-services-block-inner background-white text-center wow fadeInUp" data-wow-delay="300ms">
								<div class="about-company-services-block-inner-icon"><i class="fas fa-chart-bar"></i></div>
								<h4 class="fontface-one text-color-dark font-weight-700 padding-bottom-10">Görüşme raporları</h4>
								
								<p class="text-color-darkgrey paragraph-14 fontface-two">
								Mobil uygulama ile raporlama</p>
							</div>
						</div>
						<div class="col-lg-4 offset-lg-0 col-md-6 offset-md-3 offset-sm-0">
							<div class="about-company-services-block-inner background-white text-center wow fadeInUp" data-wow-delay="350ms">
								<div class="about-company-services-block-inner-icon"><i class="fas fa-hashtag"></i></div>
								<h4 class="fontface-one text-color-dark font-weight-700 padding-bottom-10">Akılda kalıcı</h4>
								
								<p class="text-color-darkgrey paragraph-14 fontface-two">
								Akıllarda kalan özel numara seçimi</p>
							</div>
						</div>
						<div class="col-lg-4 offset-lg-0 col-md-6 offset-md-3 offset-sm-0">
							<div class="about-company-services-block-inner background-white text-center wow fadeInUp" data-wow-delay="400ms">
								<div class="about-company-services-block-inner-icon"><i class="fas fa-qrcode"></i></div>
								<h5 class="fontface-one text-color-dark font-weight-700 padding-bottom-10">Santral hizmeti</h5>
								
								<p class="text-color-darkgrey paragraph-14 fontface-two">
								Santral hizmeti ile kullanabilme</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	


	
	<section class="company-information-section padding-top-bottom bg-setting" data-parallax="scroll" data-image-src="/media/home/galata.jpg" id="kendinizi-asin">
		<div class="container">
			<div class="row">
				<div class="col-lg-7 col-md-8">
					<div class="company-information-inner">
						<h2 class="text-color-white fontface-one padding-bottom-35 wow fadeInLeft" data-wow-delay="350ms">Kalıpların dışına çıkın,</span></h2>
						<p class="text-color-white fontface-two paragraph-20 padding-bottom-45 wow fadeInLeft" data-wow-delay="400ms">&#xb7; 850'li numaralar katma değerli hizmet numaraları değildir. 0312, 0212 vb. coğrafi numaralardan farkı yoktur. İş yerlerinde kullanılan standart sabit telefon numaralarıdır.</p>
						<p class="text-color-white fontface-two paragraph-20 padding-bottom-45 wow fadeInLeft" data-wow-delay="400ms">&#xb7; 850'li numaralar sadece çağrı merkezi numarası değildir. Tüm firmalar abonelik oluşturabilir ve kullanmaya başlayabilirler.</p>
						<p class="text-color-white fontface-two paragraph-20 wow fadeInLeft" data-wow-delay="400ms">&#xb7; "850'li numaralar arandığında çok ücret yansır veya sizi 850'li numaralar aradığında telefonu açana da ücret yansır" duyumu tamamen yanlıştır. 850'li numaralar sabit telefon numaralarıdır. Heryöne dakikalarınızdan ücretsiz aranabilirsiniz.</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	

	<?php

	$Stat1 = $db->query("SELECT count(*) FROM users ")->fetchColumn()+87;
	$Stat2 = $db->query("SELECT count(*) FROM hey_taksi ")->fetchColumn()+320;
	$Stat3 = $db->query("SELECT count(*) FROM contact ")->fetchColumn()+250;

	?>

	
	<section class="company-stats-section padding-top-bottom" id="istatistikler">
		<div class="container">
			<div class="row">
				<div class="col-lg-7 order-md-12 order-sm-12 order-12 order-lg-1">
					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-4">
							<div class="stats-block-inner text-center wow fadeInUp" data-wow-delay="300ms">
								<i class="ti-home text-color-dark "></i>
								<div class="stats-number-inner text-color-dark fontface-one font-weight-700 padding-top-20">
									<span><?=$Stat1?></span>+
								</div>
								<p class="paragraph-16 font-weight-400 fontface-two text-color-dark padding-top-5">Taksi Durağı</p>
							</div>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-4">
							<div class="stats-block-inner text-center wow fadeInUp" data-wow-delay="350ms">
								<i class="ti-loop text-color-dark "></i>
								<div class="stats-number-inner text-color-dark fontface-one font-weight-700 padding-top-20">
									<span><?=$Stat2?></span>+
								</div>
								<p class="paragraph-16 font-weight-400 fontface-two text-color-dark padding-top-5">Düzenlenen Sefer</p>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4">
							<div class="stats-block-inner text-center wow fadeInUp" data-wow-delay="400ms">
								<i class="ti-face-smile text-color-dark "></i>
								<div class="stats-number-inner text-color-dark fontface-one font-weight-700 padding-top-20">
									<span><?=$Stat3?></span>+
								</div>
								<p class="paragraph-16 font-weight-400 fontface-two text-color-dark padding-top-5">Mutlu Müşteri</p>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-5 order-md-1 order-sm-1 order-1 order-lg-12">
					<div class="row">
						<div class="col-lg-12">
							<div class="stats-heading text-right padding-bottom-30 wow fadeInUp" data-wow-delay="300ms">
								<h2 class="text-color-dark fontface-one">Taksi durağınızı</h2>
								<h2 class="text-color-dark fontface-one">online'a <span class="text-color-secondary ">taşıyın</span></h2>
							</div>
							<div class="stats-heading-detail text-right wow fadeInUp" data-wow-delay="350ms">
								<p class="paragraph-14 text-color-darkgrey fontface-two">
									Müşteri potansiyelinizi arttırın, onları kendinize hayran bırakın.
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	

	
	<section class="pricing-table-section padding-top-bottom background-grey" id="fiyatlandirma">
		<div class="container">
			<div class="section-heading text-center">
				<div class="row">
					<div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2">
						<h2 class="fontface-one text-color-dark padding-bottom-35 wow fadeInUp" data-wow-delay="300ms"><span class="text-color-dark font-weight-700">14 Gün</span> Ücretsiz Deneyin</h2>
						<p class="paragraph-15 fontface-two text-color-darkgrey wow fadeInUp" data-wow-delay="350ms">
							Online Taksi Durağını hiçbir kredi kartı bilgisi vermeden 14 gün ücretsiz deneyebilirsiniz.
						</p>
						<br>
						<p class="paragraph-15 fontface-two text-color-darkgrey wow fadeInUp" data-wow-delay="350ms">
						Ödemelerinizi ise 256-bit SSL sertifikası ile güçlendirilmiş 3d altyapısında 12 taksit imkanı ile güvenle gerçekleştirebilirsiniz.</p>
					</div>
				</div>
			</div>

			<div class="pricing-table-outer">
				<div class="row">
					<div class="col-md-4">
						<div class="pricing-table-inner text-center wow fadeInUp" data-wow-delay="300ms">
							<div class="row">
								<div class="col-md-12">
									<h4 class="font-weight-600 text-color-dark fontface-one padding-bottom-20">Aylık Plan</h4>
								</div>
								<div class="col-md-12">
									<p class="paragraph-24 fontface-two text-color-darkgrey  padding-bottom-30">
										0₺ kazanç
									</p>
								</div>
								<div class="col-md-12">
									<h2 class="pricing-main-price fontface-one font-weight-700 text-color-dark">
										<span class="paragraph-20 pricing-currency-sign font-weight-600 fontface-two">₺</span> 198
										<span class="paragraph-16 font-weight-400 fontface-two"> / Ay</span>
									</h2>
								</div>
								<div class="col-md-12">
									<ul class="pricing-detail-list padding-top-25 padding-bottom-45">
										<li class="paragraph-15 text-color-darkgrey fontface-two padding-top-15">Tüm Hizmetlere Erişim</li>
										<li class="paragraph-15 text-color-darkgrey fontface-two padding-top-15">0850 Özel Numara</li>
										<li class="paragraph-15 text-color-darkgrey fontface-two padding-top-15">Arama Yönlendirme</li>
										<li class="paragraph-15 text-color-darkgrey fontface-two padding-top-15">Her Yerden Bağlanabilme</li>
										<li class="paragraph-15 text-color-darkgrey fontface-two padding-top-15">SMS Taksi</li>
										<li class="paragraph-15 text-color-darkgrey fontface-two padding-top-15">Whatsapp Taksi</li>
										<li class="paragraph-15 text-color-darkgrey fontface-two padding-top-15">Detaylı Raporlama</li>
										<li class="paragraph-15 text-color-darkgrey fontface-two padding-top-15">7/24 Destek</li>
									</ul>
								</div>
								<div class="col-md-12">
									<a href="/Basla" target="_blank"  class="button-setting background-secondary  button-setting-primary">Hemen Başla</a>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="pricing-table-inner text-center active main wow fadeInUp" data-wow-delay="350ms">
							<div class="row">
								<div class="col-md-12">
									<h4 class="font-weight-600 text-color-dark fontface-one padding-bottom-20">Yıllık Plan*</h4>
								</div>
								<div class="col-md-12">
									<p class="paragraph-24 fontface-two text-color-darkgrey  padding-bottom-30">
										389₺ kazanç*
									</p>
								</div>
								<div class="col-md-12">
									<h2 class="pricing-main-price fontface-one font-weight-700 text-color-dark">
										<span class="paragraph-20 pricing-currency-sign font-weight-600 fontface-two">₺</span> 1987
										<span class="paragraph-16 font-weight-400 fontface-two"> / Yıl</span>
									</h2>
								</div>
								<div class="col-md-12">
									<ul class="pricing-detail-list padding-top-25 padding-bottom-45">
										<li class="paragraph-15 text-color-darkgrey fontface-two padding-top-15">Tüm Hizmetlere Erişim</li>
										<li class="paragraph-15 text-color-darkgrey fontface-two padding-top-15">0850 Özel Numara</li>
										<li class="paragraph-15 text-color-darkgrey fontface-two padding-top-15">Arama Yönlendirme</li>
										<li class="paragraph-15 text-color-darkgrey fontface-two padding-top-15">Her Yerden Bağlanabilme</li>
										<li class="paragraph-15 text-color-darkgrey fontface-two padding-top-15">SMS Taksi</li>
										<li class="paragraph-15 text-color-darkgrey fontface-two padding-top-15">Whatsapp Taksi</li>
										<li class="paragraph-15 text-color-darkgrey fontface-two padding-top-15">Detaylı Raporlama</li>
										<li class="paragraph-15 text-color-darkgrey fontface-two padding-top-15">7/24 Destek</li>
									</ul>
								</div>
								<div class="col-md-12">
									<a href="/Basla" target="_blank"  class="button-setting background-primary  button-setting-primary">Hemen Başla</a>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="pricing-table-inner text-center wow fadeInUp" data-wow-delay="400ms">
							<div class="row">
								<div class="col-md-12">
									<h4 class="font-weight-600 text-color-dark fontface-one padding-bottom-20">3 Yıllık Plan</h4>
								</div>
								<div class="col-md-12">
									<p class="paragraph-24 fontface-two text-color-darkgrey  padding-bottom-30">
										1141₺ kazanç*
									</p>
								</div>

								<div class="col-md-12">
									<h2 class="pricing-main-price fontface-one font-weight-700 text-color-dark">
										<span class="paragraph-20 pricing-currency-sign font-weight-600 fontface-two">₺</span> 5987
										<span class="paragraph-16 font-weight-400 fontface-two"> / 3 Yıl</span>
									</h2>
								</div>

								<div class="col-md-12">
									<ul class="pricing-detail-list padding-top-25 padding-bottom-45">
										<li class="paragraph-15 text-color-darkgrey fontface-two padding-top-15">Tüm Hizmetlere Erişim</li>
										<li class="paragraph-15 text-color-darkgrey fontface-two padding-top-15">0850 Özel Numara</li>
										<li class="paragraph-15 text-color-darkgrey fontface-two padding-top-15">Arama Yönlendirme</li>
										<li class="paragraph-15 text-color-darkgrey fontface-two padding-top-15">Her Yerden Bağlanabilme</li>
										<li class="paragraph-15 text-color-darkgrey fontface-two padding-top-15">SMS Taksi</li>
										<li class="paragraph-15 text-color-darkgrey fontface-two padding-top-15">Whatsapp Taksi</li>
										<li class="paragraph-15 text-color-darkgrey fontface-two padding-top-15">Detaylı Raporlama</li>
										<li class="paragraph-15 text-color-darkgrey fontface-two padding-top-15">7/24 Destek</li>
									</ul>
								</div>
								<div class="col-md-12">
									<a href="/Basla" target="_blank"  class="button-setting background-secondary  button-setting-primary">Hemen Başla</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	


	
	<section class="contact-form-section padding-top-bottom" id="iletisim">
		<div class="container">
			<div class="row">
				<div class="col-lg-5">
					<div class="company-contact-detail wow fadeInLeft" data-wow-delay="300ms">
						<div class="contact-heading padding-bottom-35">
							<h2 class="fontface-one text-color-dark ">Bizimle</h2>
							<h2 class="fontface-one text-color-dark">iletişime <span class="font-weight-700">geçin<span class="text-color-primary">.</span></span>
							</h2>
						</div>
						<p class="paragraph-14 text-color-darkgrey fontface-two">
						Bizimle iletişime geçmek için aşağıda yer alan kanalları kullanabilir veya sağda bulunan iletişim formunu doldurabilirsiniz.</p>
						<hr>
						<div class="contact-detail-list">
							<ul>
								<li class="paragraph-15 text-color-darkgrey fontface-two padding-top-10">Telefon no: +90 (850) 303 49 16</li>
								<li class="paragraph-15 text-color-darkgrey fontface-two padding-top-10">Whatsapp: &nbsp;+90 (850) 303 49 16</li>
								<li class="paragraph-15 text-color-darkgrey fontface-two padding-top-10">E-posta: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;iletisim@onlinetaksiduragi.com</li>
							</ul>
						</div>

						<div class="contact-company-icons padding-top-35">
							<ul class="company-social-icons">
								<li class="company-social-icons-list">
									<a target="_blank" href="https://api.whatsapp.com/send?phone=908503034916&text=Merhaba,%20online%20taksi%20dura%C4%9F%C4%B1%20hakk%C4%B1nda%20g%C3%B6r%C3%BC%C5%9Fmek%20istiyorum." class="facebook-icon"> <i class="fab fa-whatsapp"></i></a>
								</li>
								<li class="company-social-icons-list">
									<a target="_blank" href="tel:8503034916" class="twitter-icon"> <i class="fas fa-mobile-alt"></i> </a>
								</li>

								<li class="company-social-icons-list">
									<a target="_blank" href="mailto:iletisim@onlinetaksiduragi.com" class="instagram-icon"><i class="fas fa-envelope"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>

				<div class="col-lg-6 offset-lg-1">
					<div class="company-contact-form wow fadeInRight" data-wow-delay="300ms">
						<h3 class="text-color-dark font-weight-600 fontface-one padding-bottom-45">Bize Yazın</h3>
						<form action="javascript:;" class="contact-form-outer">
							<div class="row">
								<div class="col-md-6">
									<div class="contact-form-textfield padding-bottom-30">
										<input id="f_ad" type="text" placeholder="Ad & Soyad" class="form-control paragraph-16">
									</div>
								</div>
								<div class="col-md-6">
									<div class="contact-form-textfield padding-bottom-30">
										<input id="f_mail" type="email" placeholder="E-posta adresi" class="form-control paragraph-16">
									</div>
								</div>
								<div class="col-md-12">
									<div class="contact-form-textfield padding-bottom-45">
										<input id="f_konu" type="text" placeholder="Konu" class="form-control paragraph-16">
									</div>
								</div>
								<input type="text" hidden="" value="<?=$ContactToken?>" id="ContactToken" >
								<div class="col-md-12">
									<div class="contact-form-textfield padding-bottom-40">
										<textarea id="f_mesaj" placeholder="Mesaj" class="form-control paragraph-16"></textarea>
									</div>
								</div>
								<div class="col-md-12">
									<a id="snd_frm" class="button-setting button-setting-primary background-secondary text-color-white width-100 text-center" href="javascript:;">Mesajımı Gönder</a>
									<a style="pointer-events: none;display: none;" id="snd_frm2" class="button-setting button-setting-primary background-primary text-color-white width-100 text-center" href="javascript:;">Mesajınız için teşekkür ederiz.</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	


	
	<footer class="footer-section padding-bottom-70 padding-top-70 padding-top-1">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 order-lg-1 order-md-3 order-sm-3 order-3 wow fadeIn" data-wow-delay="300ms">
					<p class="paragraph-13 footer-copyright-text font-weight-500 fontface-two text-color-dark padding-top-10">&copy; 2019 <g-emoji class="g-emoji" alias="heart" fallback-src="/media/love.png">❤️</g-emoji> 
						<a target="_blank" href="https://muhammedarslan.com.tr?ref=onlinetaksiduragi.com" class="footer-web-link"> Msa</a> tarafından sevgi ile kodlandı.
					</p>
				</div>

				<div class="col-lg-6 order-lg-1 order-md-2 order-sm-2 order-2 wow fadeIn" data-wow-delay="350ms">
					<div class="footer-links padding-top-5">
						<ul class="footer-links-outer text-center">
							<li class="footer-links-inner">
								<a class="scroll" href="#anasayfa">anasayfa</a>
							</li>
							<li class="footer-divider">|</li>
							<li class="footer-links-inner">
								<a class="scroll" href="#hizmetlerimiz">hizmetlerimiz</a>
							</li>
							<li class="footer-divider">|</li>
							<li class="footer-links-inner">
								<a  href="/Basla" target="_blank" >hemen başla</a>
							</li>
							<li class="footer-divider">|</li>
							<li class="footer-links-inner">
								<a class="" target="_blank" href="/DurakYonetim">durak girişi</a>
							</li>
							<li class="footer-divider">|</li>
							<li class="footer-links-inner">
								<a class="scroll" href="#iletisim">iletişim</a>
							</li>
						</ul>
					</div>
				</div>

				<div class="col-lg-2 order-lg-1 clearfix order-md-1 order-sm-1 order-1 wow fadeIn" data-wow-delay="400ms">
					<a href="#anasayfa" class="footer-logo scroll"><img style="width: 180px;" src="/media/logo_dark.png" alt="logo-treely"></a>
				</div>
			</div>
		</div>
	</footer>
	

</section>




<?php

require_once VDIR.'/main.footer.php';