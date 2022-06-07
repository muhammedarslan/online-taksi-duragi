$(function() {

	PageLoaded();

	$.post('/AjaxCall/UpdateNotifications',{'data':'data'},(data)=>{
		
		const json = JSON.parse(data);

		$('#notif_ul').html('');

		if ( json.NC != '0' ) {

			let n_c = 0;

			$.each( json, function( key, value ) {

				n_c = value.NC;

				$('#notif_ul').prepend('<li>'+
					' <a href="/DurakYonetim/Bildirim/'+value.token+'">'+
					'<span class="time">'+value.time+' önce</span>'+
					' <span class="details">'+
					value.icon+' '+value.text+
					' </span>'+
					'</a>'+
					'</li>');

			});

			$('#notif_c1').text(' '+n_c+' ');
			$('#notif_c1').show();
			$('#notif_c2').show();
			$('#notif_c2').text(n_c+' okunmamış');

		} else {
			$('#notif_c1').hide();
			$('#notif_c2').hide();
			$('#notif_ul').html('<li>'+
				'<a style="text-align:center;" href="javascript:;">'+
				'<span class="details">'+
				'Herhangi bir bildiriminiz bulunmuyor.'+
				'</a>'+
				'</li>');
		}

	});

	$.post('/AjaxCall/TaxiRequests',{'data':'data'},(data)=>{

		const json = JSON.parse(data);
		const stat = $('#men_tggle').val();

		if ( json.status == 'new' ) {

			if ( stat == 1 ) {
				$('#taksi_durum1').hide();
				$('#taksi_durum2').show();
			}

		} else {

			if ( stat == 1 ) {
				$('#taksi_durum2').hide();
				$('#taksi_durum1').show();
			}
			
		}
	});

	setTimeout(()=>{
		$.post('/AjaxCall/WhatsappSession',{'data':'data'},(data)=>{

			const json = JSON.parse(data);

			if ( json.status == 'inactive' ) {
				$.toast({
					heading: 'Whatsapp oturumunuza bağlanamadık !',
					text: 'Lütfen <a href="https://web.whatsapp.com" target="_blank">whatsapp web</a> oturumuna bağlı olduğunuzdan emin olun. Ayrıntılı bilgi için <a onclick="InnerPage(this); return false;" href="/DurakYonetim/Whatsapp">tıklayın.</a>',
					position: 'top-right',
					loaderBg:'#ff6849',
					icon: 'warning',
					hideAfter: 45000, 
					stack: false
				});
			}

		});
	},3000);

	setInterval(()=>{

		$.post('/AjaxCall/WhatsappSession',{'data':'data'},(data)=>{

			const json = JSON.parse(data);

			if ( json.status == 'inactive' ) {
				$.toast({
					heading: 'Whatsapp oturumunuza bağlanamadık !',
					text: 'Lütfen <a href="https://web.whatsapp.com" target="_blank">whatsapp web</a> oturumuna bağlı olduğunuzdan emin olun. Ayrıntılı bilgi için <a onclick="InnerPage(this); return false;" href="/DurakYonetim/Whatsapp">tıklayın.</a>',
					position: 'top-right',
					loaderBg:'#ff6849',
					icon: 'warning',
					hideAfter: 45000, 
					stack: 6
				});
			}

		});

	},60000);

	setInterval(()=>{

		$.post('/AjaxCall/TaxiRequests',{'data':'data'},(data)=>{

			const json = JSON.parse(data);
			const stat = $('#men_tggle').val();

			if ( json.status == 'new' ) {

				if ( stat == 1 ) {
					$('#taksi_durum1').hide();
					$('#taksi_durum2').show();
				}
				
				document.getElementById("NotifSound").play()


				swal({
					title: "Yeni Taksi Talep Edildi !",
					text:json.message,
					html:true,
					showCancelButton: true,
					type:'info',
					showConfirmButton:true,
					confirmButtonColor:'#ffcb80',
					confirmButtonText:'Taksi gönder',
					cancelButtonText:'Kapat',
					allowEscapeKey:true,
					allowOutsideClick:false
				}, function (isConfirm) {
					if (isConfirm) {
						window.location = '/DurakYonetim/HeyTaksi';
					}
				});



			} else {
				if ( stat == 1 ) {
					$('#taksi_durum2').hide();
					$('#taksi_durum1').show();
				}
			}

		});

	},15000);


	const UN = setInterval(()=>{

		$.post('/AjaxCall/UpdateNotifications',{'data':'data'},(data)=>{
			
			const json = JSON.parse(data);

			$('#notif_ul').html('');

			if ( json.NC != '0' ) {

				let n_c = 0;

				$.each( json, function( key, value ) {

					n_c = value.NC;

					$('#notif_ul').prepend('<li>'+
						' <a href="/DurakYonetim/Bildirim/'+value.token+'">'+
						'<span class="time">'+value.time+' önce</span>'+
						' <span class="details">'+
						value.icon+' '+value.text+
						' </span>'+
						'</a>'+
						'</li>');

				});

				$('#notif_c1').text(' '+n_c+' ');
				$('#notif_c1').show();
				$('#notif_c2').show();
				$('#notif_c2').text(n_c+' okunmamış');

			} else {
				$('#notif_c1').hide();
				$('#notif_c2').hide();
				$('#notif_ul').html('<li>'+
					'<a style="text-align:center;" href="javascript:;">'+
					'<span class="details">'+
					'Okunmamış bildiriminiz bulunmuyor.'+
					'</a>'+
					'</li>');
			}

		});

	},60000);



});

const deletes = (id,tbl) => {

	swal({
		title: "Gerçekten silmek istiyor musun?",
		text: "Sildiğin veriler geri getirilemeyebilir, yine de devam etmek istiyor musun?",
		type: "info",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Evet, sil",
		cancelButtonText: "Hayır, iptal et",
		closeOnConfirm: false,
		closeOnCancel: false
	}, function (isConfirm) {
		if (isConfirm) {

			swal({
				title: "Lütfen Bekleyiniz...",
				text:'Sunucumuza göndermiş olduğunuz bilgileri işliyoruz.',
				showCancelButton: false,
				showConfirmButton:false,
				allowEscapeKey:false,
				allowOutsideClick:false,
				closeOnConfirm: false,
				closeOnCancel: false
			});
			
			setTimeout(function(){
				$.post('/AjaxCall/DeleteData',{'tbl':tbl,'id':id},(data)=>{

					const json = JSON.parse(data);

					if ( json.status == 'success' ) {

						swal({
							title: "Başarıyla Silindi",
							text:json.message,
							html:true,
							showCancelButton: false,
							type:'success',
							showConfirmButton:true,
							allowEscapeKey:false,
							allowOutsideClick:false,
							closeOnConfirm: false,
							closeOnCancel: false
						}, function (isConfirm) {
							if ( json.reload == true ) {
								location.reload();
							} else if ( json.location != false ) {
								window.location = json.location;
							} else { swal.close(); }
						});


					} else {

						swal({
							title: "Bir hata oluştu",
							text:json.message,
							html:true,
							showCancelButton: false,
							type:'error',
							showConfirmButton:true,
							allowEscapeKey:false,
							allowOutsideClick:false,
							closeOnConfirm: false,
							closeOnCancel: false
						}, function (isConfirm) {
							if ( json.reload == true ) {
								location.reload();
							} else if ( json.location != false ) {
								window.location = json.location;
							} else { swal.close(); }
						});

					}

				}).fail(()=>{
					swal({
						title: "Sistemsel bir hata oluştu",
						text:'Bir hata oluştu ve verileriniz işlenemedi. Lütfen daha sonra tekrar deneyiniz.',
						showCancelButton: false,
						type:'error',
						showConfirmButton:true,
						allowEscapeKey:false,
						allowOutsideClick:false,
						closeOnConfirm: false,
						closeOnCancel: false
					});
				});

			},1000);

		} else {
			swal({
				title: "İşlem iptal edildi",
				text:'Hiçbir şeye dokunmadık.',
				html:true,
				showCancelButton: false,
				type:'error',
				showConfirmButton:true,
				allowEscapeKey:true,
				allowOutsideClick:false,
				closeOnConfirm: true,
				closeOnCancel: false
			});
		}
	});

};

const hback = () => {

	topbar.show();

	const href  = '/DurakYonetim';

	$.get(href,{'load':'inner'},(data)=>{

		const title = data.match("{{(.*?)}}")[1];

		const html = data.split('|||')[1];

		$("title").text(title);
		$('#PageContent').html(html);
		window.history.pushState("", "", href);

		PageLoaded();

		setTimeout(()=>{
			topbar.hide();
		},1000);

		$('html, body').animate({scrollTop: 0}, 1000);

	});

	
};

String.prototype.str_tr = function(){
	var string = this;
	var letters = { "İ": "i", "I": "ı", "Ş": "ş", "Ğ": "ğ", "Ü": "ü", "Ö": "ö", "Ç": "ç" };
	string = string.replace(/(([İIŞĞÜÇÖ]))/g, function(letter){ return letters[letter]; })
	return string.toLowerCase();
}	


$("#chat_search").on("change paste keyup", function() {

	let val = $(this).val();
	val = val.replace('-','');
	val = val.replace('(','');
	val = val.replace(')','');
	val = val.replace(' ','');
	val = val.replace(' ','');
	val = val.replace(' ','');
	val = val.replace(' ','');
	val = val.str_tr();
	let dataName;
	let dataNumb2;
	let dataNumb;

	if ( val != '' ) {

		$('#inbox').find('li').each(function(){
			$(this).hide();
			dataName = $(this).attr('data-name');
			dataName = dataName.str_tr();
			dataNumb2 = $(this).attr('data-numb');
			dataNumb = dataNumb2.replace('-','');
			dataNumb = dataNumb.replace('-','');
			dataNumb = dataNumb.replace('-','');
			dataNumb = dataNumb.replace('-','');
			if ( dataNumb.indexOf(val) >= 0 || dataName.indexOf(val) >= 0 ) {
				$(this).show();
			}

		});


	} else {

		$('#inbox').find('li').each(function(){
			$(this).show();

		});

	}

});

const chang_avatar = ()=> {

	$('#new_avatar').click();

};

$('#new_avatar').change(function(){

	const inp = $('#new_avatar').val();

	if ( inp != '' ) {

		swal({
			title: "Lütfen Bekleyiniz...",
			text:'Seçmiş olduğunuz avatar görselini işliyoruz...',
			showCancelButton: false,
			showConfirmButton:false,
			allowEscapeKey:false,
			allowOutsideClick:false,
			closeOnConfirm: false,
			closeOnCancel: false
		});

		setTimeout(()=>{
			$('#av_form').submit();
		},2000);

	}

});


const msg_send_btn = () => {

	const message = $('#msg_').val();
	const number  = $('#nmb_').val();
	const type  = $('#nmb2_').val();

	if ( number == ''  ) {

		swal({
			title: "Bir hata oluştu",
			text:'Lütfen yeniden deneyin.',
			html:true,
			showCancelButton: false,
			type:'error',
			showConfirmButton:true,
			allowEscapeKey:false,
			allowOutsideClick:false,
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			location.reload();
		});

	} else {

		if ( message != '' ) {

			swal({
				title: "Lütfen Bekleyiniz...",
				text:'Mesajınız sms servisimize iletiliyor.',
				showCancelButton: false,
				showConfirmButton:false,
				allowEscapeKey:false,
				allowOutsideClick:false,
				closeOnConfirm: false,
				closeOnCancel: false
			});

			setTimeout(()=>{
				$.post('/AjaxCall/SendMessage',{'nmb':number,'msg':message,'type':type},(data)=>{

					const json = JSON.parse(data);

					if ( json.status == 'success' ) {

						$('#msg_').val('');

						if ( json.t == 'new' ) {

							setTimeout(function(){
								window.location = '/DurakYonetim/Mesajlar/'+json.fm;
							},1000);

						} else {
							swal.close();
							frm_refresh();

						}

					} else {

						swal({
							title: "Bir hata oluştu",
							text:json.message,
							html:true,
							showCancelButton: false,
							type:'error',
							showConfirmButton:true,
							allowEscapeKey:false,
							allowOutsideClick:false,
							closeOnConfirm: false,
							closeOnCancel: false
						}, function (isConfirm) {
							if ( json.reload == true ) {
								location.reload();
							} else if ( json.location != false ) {
								window.location = json.location;
							} else { swal.close(); }
						});

					}

				}).fail(()=>{
					swal({
						title: "Sistemsel bir hata oluştu",
						text:'Bir hata oluştu ve verileriniz işlenemedi. Lütfen daha sonra tekrar deneyiniz.',
						showCancelButton: false,
						type:'error',
						showConfirmButton:true,
						allowEscapeKey:false,
						allowOutsideClick:false,
						closeOnConfirm: false,
						closeOnCancel: false
					});
				});
			},1000);

		}
	}

};


const n_msg = () => {

	swal({
		title: "Yeni mesaj gönder",
		text: "Rehberindeki bir kişiye mi yoksa farklı bir numaraya mı mesaj göndermek istiyorsun?",
		type: "info",
		showCancelButton: true,
		confirmButtonColor: "#c1c1c1",
		confirmButtonText: "Rehberimden seç",
		cancelButtonText: "Yeni bir numara",
		closeOnConfirm: false,
		closeOnCancel: false
	}, function (isConfirm) {
		if (isConfirm) { 

			swal({
				title: "Rehberinize Yönlendiriliyorsunuz...",
				text:'Rehberinizden mesaj göndermek istediğiniz kullanıcıyı seçebilirsiniz.',
				showCancelButton: false,
				showConfirmButton:false,
				allowEscapeKey:false,
				allowOutsideClick:false,
				closeOnConfirm: false,
				closeOnCancel: false
			});

			setTimeout(()=>{
				window.location = '/DurakYonetim/TelefonRehberi';
			},2500);

		} else {

			swal({
				title: "Numaraya mesaj gönder",
				type: "input",
				showCancelButton: true,
				closeOnConfirm: false,
				confirmButtonText:'Mesaj gönder',
				animation: "slide-from-top",
				inputPlaceholder: "(5xx) xxx xx xx"
			}, function (inputValue) {
				if (inputValue === false) return false;
				if (inputValue === "") {
					swal.showInputError("Lütfen geçerli bir numara giriniz"); return false
				}
				dataNumb = inputValue.replace(')','');
				dataNumb = dataNumb.replace('(','');
				dataNumb = dataNumb.replace(' ','-');
				dataNumb = dataNumb.replace(' ','-');
				dataNumb = dataNumb.replace(' ','-');
				dataNumb = dataNumb.replace(' ','-');
				dataNumb = dataNumb.replace(' ','-');
				window.location = '/DurakYonetim/Mesajlar/+90-'+dataNumb;
			});
			setTimeout(()=>{$("input").mask("(999) 999 99 99");},1000);
		}

	});

};


const frm_refresh = () => {

	const src = $("#msg_frm").attr("src");
	$("#msg_frm").attr("src", src);

};

const rmv_token = () => {

	swal({
		title: "Lütfen Bekleyiniz...",
		text:'Anahtarlar sıfırlanıyor.',
		showCancelButton: false,
		showConfirmButton:false,
		allowEscapeKey:false,
		allowOutsideClick:false,
		closeOnConfirm: false,
		closeOnCancel: false
	});

	setTimeout(()=>{

		$.post('/AjaxCall/ResetRememberToken',{'data':'data'},(data)=>{

			swal({
				title: "İşlem Başarılı !",
				text:'Hesabınızdan otomatik girişi sağlayan tüm anahtarlar kaldırıldı. <br> Yeni bir beni hatırla işlemi gerçekleşene kadar otomatik giriş yapmaya çalışan tüm kullanıcılar giriş sayfasına yönlendirilecek.<br> Hesabınızın güvende olmadığını düşünüyorsanız lütfen şifrenizi değiştirin veya bizimle iletişime geçin.',
				html:true,
				showCancelButton: false,
				type:'success',
				showConfirmButton:true,
				allowEscapeKey:false,
				allowOutsideClick:false,
				closeOnConfirm: false,
				confirmButtonText:'Tamam',
				closeOnCancel: false
			});

		});

	},1000);

};

const dltmsg = (msg) => {

	swal({
		title: "Bu mesajı silmek istiyor musunuz?",
		text: "Sildiğin veriler geri getirilemeyebilir, yine de devam etmek istiyor musun?",
		type: "info",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Evet, sil",
		cancelButtonText: "Hayır, iptal et",
		closeOnConfirm: false,
		closeOnCancel: false
	}, function (isConfirm) {
		if (isConfirm) {

			swal({
				title: "Lütfen Bekleyiniz...",
				text:'Sunucumuza göndermiş olduğunuz bilgileri işliyoruz.',
				showCancelButton: false,
				showConfirmButton:false,
				allowEscapeKey:false,
				allowOutsideClick:false,
				closeOnConfirm: false,
				closeOnCancel: false
			});
			
			setTimeout(function(){
				$.post('/AjaxCall/DeleteExtraMessage',{'b':msg},(data)=>{

					const json = JSON.parse(data);

					if ( json.status == 'success' ) {

						swal({
							title: "Başarıyla Silindi",
							text:json.message,
							html:true,
							showCancelButton: false,
							type:'success',
							showConfirmButton:true,
							allowEscapeKey:false,
							allowOutsideClick:false,
							closeOnConfirm: false,
							closeOnCancel: false
						}, function (isConfirm) {
							if ( json.reload == true ) {
								location.reload();
							} else if ( json.location != false ) {
								window.location = json.location;
							} else { swal.close(); }
						});


					} else {

						swal({
							title: "Bir hata oluştu",
							text:json.message,
							html:true,
							showCancelButton: false,
							type:'error',
							showConfirmButton:true,
							allowEscapeKey:false,
							allowOutsideClick:false,
							closeOnConfirm: false,
							closeOnCancel: false
						}, function (isConfirm) {
							if ( json.reload == true ) {
								location.reload();
							} else if ( json.location != false ) {
								window.location = json.location;
							} else { swal.close(); }
						});

					}

				}).fail(()=>{
					swal({
						title: "Sistemsel bir hata oluştu",
						text:'Bir hata oluştu ve verileriniz işlenemedi. Lütfen daha sonra tekrar deneyiniz.',
						showCancelButton: false,
						type:'error',
						showConfirmButton:true,
						allowEscapeKey:false,
						allowOutsideClick:false,
						closeOnConfirm: false,
						closeOnCancel: false
					});
				});

			},1000);

		} else {
			swal({
				title: "İşlem iptal edildi",
				text:'Hiçbir şeye dokunmadık.',
				html:true,
				showCancelButton: false,
				type:'error',
				showConfirmButton:true,
				allowEscapeKey:true,
				allowOutsideClick:false,
				closeOnConfirm: true,
				closeOnCancel: false
			});
		}
	});

};

const pymt = (type) => {

	$('#pr_bd').html('<iframe onload="this.height=this.contentWindow.document.body.scrollHeight + 130;" src="/DurakYonetim/PaymentIframe?type='+type+'" frameborder="none" scrolling="none" style="width: 100%" height="999"></iframe>');
	
};

const checkwp = () => {

	$.post('/AjaxCall/WhatsappSession',{'data':'data'},(data)=>{

		const json = JSON.parse(data);

		if ( json.status == 'inactive' ) {
			$.toast({
				heading: 'Whatsapp oturumunuza bağlanamadık !',
				text: 'Lütfen <a href="https://web.whatsapp.com" target="_blank">whatsapp web</a> oturumuna bağlı olduğunuzdan emin olun. Ayrıntılı bilgi için <a onclick="InnerPage(this); return false;" href="/DurakYonetim/Whatsapp">tıklayın.</a>',
				position: 'top-right',
				loaderBg:'#ff6849',
				icon: 'error',
				hideAfter: 5000, 
				stack: false
			});
		} else {
			reloadContent();
		}

	});

};

const new_extra = () => {

	const key = $('#recipient-name').val();
	const text = $('#message-text').val();

	if ( key == '' || text == '' ) {

		swal({
			title: "Hata !",
			text:'Lütfen boş alan bırakmayınız !',
			html:true,
			showCancelButton: false,
			type:'error',
			showConfirmButton:true,
			allowEscapeKey:true,
			allowOutsideClick:false,
			closeOnConfirm: true,
			closeOnCancel: false
		});

	} else {
		
		swal({
			title: "Lütfen Bekleyiniz...",
			text:'Sunucumuza göndermiş olduğunuz bilgileri işliyoruz.',
			showCancelButton: false,
			showConfirmButton:false,
			allowEscapeKey:false,
			allowOutsideClick:false,
			closeOnConfirm: false,
			closeOnCancel: false
		});

		setTimeout(()=>{

			$.post('/AjaxCall/NewExtraMessage',{'key':key,'text':text},(data)=>{

				const json = JSON.parse(data);

				if ( json.status == 'success' ) {

					swal({
						title: "Başarıyla Eklendi !",
						text:json.message,
						html:true,
						showCancelButton: false,
						type:'success',
						showConfirmButton:true,
						allowEscapeKey:false,
						allowOutsideClick:false,
						closeOnConfirm: false,
						closeOnCancel: false
					}, function (isConfirm) {
						if ( json.reload == true ) {
							location.reload();
						} else if ( json.location != false ) {
							window.location = json.location;
						} else { swal.close(); }
					});


				} else {

					swal({
						title: "Bir hata oluştu",
						text:json.message,
						html:true,
						showCancelButton: false,
						type:'error',
						showConfirmButton:true,
						allowEscapeKey:false,
						allowOutsideClick:false,
						closeOnConfirm: false,
						closeOnCancel: false
					}, function (isConfirm) {
						if ( json.reload == true ) {
							location.reload();
						} else if ( json.location != false ) {
							window.location = json.location;
						} else { swal.close(); }
					});

				}

			}).fail(()=>{
				swal({
					title: "Sistemsel bir hata oluştu",
					text:'Bir hata oluştu ve verileriniz işlenemedi. Lütfen daha sonra tekrar deneyiniz.',
					showCancelButton: false,
					type:'error',
					showConfirmButton:true,
					allowEscapeKey:false,
					allowOutsideClick:false,
					closeOnConfirm: false,
					closeOnCancel: false
				});
			});

		},1000);

	}

};

const cncltx = (token) => {

	swal({
		title: "Taksi talebi iptal edilecek !",
		text: "Bu durum müşterinin gözünde kötü karşılanabilir. Devam etmek istiyor musun?",
		type: "info",
		showCancelButton: true,
		confirmButtonColor: "",
		confirmButtonText: "Evet,Talebi iptal et",
		cancelButtonText: "Hayır, Talebi koru",
		closeOnConfirm: false,
		closeOnCancel: false
	}, function (isConfirm) {
		if (isConfirm) {

			swal({
				title: "Lütfen Bekleyiniz...",
				text:'Sunucumuza göndermiş olduğunuz bilgileri işliyoruz.',
				showCancelButton: false,
				showConfirmButton:false,
				allowEscapeKey:false,
				allowOutsideClick:false,
				closeOnConfirm: false,
				closeOnCancel: false
			});
			
			setTimeout(function(){
				$.post('/AjaxCall/CancelTaxi',{'token':token},(data)=>{

					const json = JSON.parse(data);

					if ( json.status == 'success' ) {

						swal({
							title: "Başarıyla İptal Edildi !",
							text:json.message,
							html:true,
							showCancelButton: false,
							type:'success',
							showConfirmButton:true,
							allowEscapeKey:false,
							allowOutsideClick:false,
							closeOnConfirm: false,
							closeOnCancel: false
						}, function (isConfirm) {
							if ( json.reload == true ) {
								location.reload();
							} else if ( json.location != false ) {
								window.location = json.location;
							} else { swal.close(); }
						});


					} else {

						swal({
							title: "Bir hata oluştu",
							text:json.message,
							html:true,
							showCancelButton: false,
							type:'error',
							showConfirmButton:true,
							allowEscapeKey:false,
							allowOutsideClick:false,
							closeOnConfirm: false,
							closeOnCancel: false
						}, function (isConfirm) {
							if ( json.reload == true ) {
								location.reload();
							} else if ( json.location != false ) {
								window.location = json.location;
							} else { swal.close(); }
						});

					}

				}).fail(()=>{
					swal({
						title: "Sistemsel bir hata oluştu",
						text:'Bir hata oluştu ve verileriniz işlenemedi. Lütfen daha sonra tekrar deneyiniz.',
						showCancelButton: false,
						type:'error',
						showConfirmButton:true,
						allowEscapeKey:false,
						allowOutsideClick:false,
						closeOnConfirm: false,
						closeOnCancel: false
					});
				});

			},1000);

		} else {
			swal({
				title: "Talep hala geçerli !",
				text:'Müşterinin taksi talebi hala geçerli !',
				html:true,
				showCancelButton: false,
				type:'warning',
				showConfirmButton:true,
				allowEscapeKey:true,
				allowOutsideClick:false,
				closeOnConfirm: true,
				closeOnCancel: false
			});
		}
	});

};

const taxis = (token) => {

	$.post('/AjaxCall/TaxiModal',{'token':token},(data)=>{

		$('#smodal').html(data);
		$('#exampleModal').modal();
		$('select').selectpicker();

	});

};

const sendtaxi = (token) => {


	swal({
		title: "Lütfen Bekleyiniz...",
		text:'Sunucumuza göndermiş olduğunuz bilgileri işliyoruz.',
		showCancelButton: false,
		showConfirmButton:false,
		allowEscapeKey:false,
		allowOutsideClick:false,
		closeOnConfirm: false,
		closeOnCancel: false
	});

	$.post('/AjaxCall/SendTaxi',{'token':token,'plaka':$('#s_taksi').val(),'dakika':$('#s_dk').val()},(data)=>{

		const json = JSON.parse(data);

		if ( json.status == 'success' ) {

			swal({
				title: "Başarıyla Tamamlandı !",
				text:json.message,
				html:true,
				showCancelButton: false,
				type:'success',
				showConfirmButton:true,
				allowEscapeKey:false,
				allowOutsideClick:false,
				closeOnConfirm: false,
				closeOnCancel: false
			}, function (isConfirm) {
				if ( json.reload == true ) {
					location.reload();
				} else if ( json.location != false ) {
					window.location = json.location;
				} else { swal.close(); }
			});


		} else {

			swal({
				title: "Bir hata oluştu",
				text:json.message,
				html:true,
				showCancelButton: false,
				type:'error',
				showConfirmButton:true,
				allowEscapeKey:false,
				allowOutsideClick:false,
				closeOnConfirm: false,
				closeOnCancel: false
			}, function (isConfirm) {
				if ( json.reload == true ) {
					location.reload();
				} else if ( json.location != false ) {
					window.location = json.location;
				} else { swal.close(); }
			});

		}

	});

};

const check_smss = ()=> {

	swal({
		title: "Lütfen Bekleyiniz...",
		text:'SMS kullanıcı bilgileriniz kontrol ediliyor...',
		showCancelButton: false,
		showConfirmButton:false,
		allowEscapeKey:false,
		allowOutsideClick:false,
		closeOnConfirm: false,
		closeOnCancel: false
	});

	setTimeout(function(){
		$.post('/AjaxCall/CheckSMSUser',{'data':'data'},(data)=>{

			const json = JSON.parse(data);

			if ( json.status == 'success' ) {

				swal({
					title: "Doğrulama Başarılı !",
					text:'Netgsm sms servisiniz api erişimimiz için gerekli bilgileri doğruladı.',
					html:true,
					showCancelButton: false,
					type:'success',
					showConfirmButton:true,
					allowEscapeKey:false,
					allowOutsideClick:false,
					closeOnConfirm: false,
					confirmButtonText:'Tamam',
					closeOnCancel: false
				});

			} else {

				swal({
					title: "Doğrulama Başarısız !",
					text:'Netgsm sms servisiniz cevap olarak bir hata gönderdi. Lütfen bilgileri kontrol edip yeniden deneyiniz.',
					html:true,
					showCancelButton: false,
					type:'error',
					showConfirmButton:true,
					allowEscapeKey:false,
					allowOutsideClick:false,
					closeOnConfirm: false,
					confirmButtonText:'Tamam',
					closeOnCancel: false
				});

			}



		}).fail(()=>{
			swal({
				title: "Sistemsel bir hata oluştu",
				text:'Lütfen daha sonra tekrar deneyiniz.',
				showCancelButton: false,
				type:'error',
				showConfirmButton:true,
				allowEscapeKey:false,
				allowOutsideClick:false,
				closeOnConfirm: false,
				closeOnCancel: false
			});
		});

	},1000);

};


const PageLoaded = () => {

	$('#PgScripts').html(
		'<script async defer src="/assets/durak/js/home-chart.js?v=1.0.1" ></script>'+
		'<script async defer src="/assets/durak/js/pages/validation/form-validation.js?v=1.0.1" ></script>'+
		'<script async defer src="/assets/durak/js/pages/table/table_data.js?v=1.0.1" ></script>'
		);

	$('#gtag').html("<script>"+
		"window.dataLayer = window.dataLayer || [];"+
		"function gtag(){dataLayer.push(arguments);}"+
		"gtag('js', new Date());"+
		"gtag('config', 'UA-83139045-12');"+
		"</script>");

};

const InnerPage = (obj) => {

	topbar.show();

	const href  = obj.getAttribute("href");

	$.get(href,{'load':'inner'},(data)=>{

		const title = data.match("{{(.*?)}}")[1];

		const html = data.split('|||')[1];

		$("title").text(title);
		$('#PageContent').html(html);
		window.history.pushState("", "", href);

		PageLoaded();

		setTimeout(()=>{
			topbar.hide();
		},1000);

		$('html, body').animate({scrollTop: 0}, 1000);

	});

};

const InnerMsg = (obj) => {

	const href  = obj.getAttribute("href");

	$.get(href,{'load':'inner'},(data)=>{

		const title = data.match("{{(.*?)}}")[1];

		const html = data.split('|||')[1];

		$("title").text(title);
		$('#PageContent').html(html);
		window.history.pushState("", "", href);

		PageLoaded();

	});

};

const mntggle = () => {

	const stat = $('#men_tggle').val();

	if ( stat == 1 ) {
		$('#men_tggle').val(0);
		$('#taksi_durum1').fadeOut();
		$('#taksi_durum2').fadeOut();

	} else {
		$('#men_tggle').val(1);

	}

};

const reloadContent = () => {

	topbar.show();

	const href  = window.location.pathname;

	$.get(href,{'load':'inner'},(data)=>{

		const title = data.match("{{(.*?)}}")[1];

		const html = data.split('|||')[1];

		$("title").text(title);
		$('#PageContent').html(html);
		window.history.pushState("", "", href);

		PageLoaded();

		setTimeout(()=>{
			topbar.hide();
		},1000);

	});

};