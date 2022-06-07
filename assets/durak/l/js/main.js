
(function ($) {
  "use strict";


    /*==================================================================
    [ Focus Contact2 ]*/
    $('.input100').each(function(){
      $(this).on('blur', function(){
        if($(this).val().trim() != "") {
          $(this).addClass('has-val');
        }
        else {
          $(this).removeClass('has-val');
        }
      })    
    })


    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $('#lost_pass_button').click(function(){
      const tel = $('input[name="tel"]').val();
      const captha = grecaptcha.getResponse();

      grecaptcha.reset();

      if ( captha == '' ) {
       Swal.fire({
        type: 'warning',
        title: 'Hata !',
        html: 'Lütfen güvenlik doğrulamasını onaylayınız !',
        confirmButtonText:'Kapat',
        showConfirmButton:true,
        showCancelButton:false
      });
     } else {

      if ( tel == '' ) {
       Swal.fire({
        type: 'warning',
        title: 'Hata !',
        html: 'Lütfen geçerli bir telefon numarası giriniz !',
        confirmButtonText:'Kapat',
        showConfirmButton:true,
        showCancelButton:false
      })
     } else {

      swal.fire({
        title: "İşleminiz yapılıyor",
        showConfirmButton: !1,
        allowEscapeKey:false,
        allowOutsideClick:false,
        text: "Lütfen biraz bekleyiniz..."
      });

      setTimeout(function(){
        $.post('/DurakYonetim/Giris/Ajax2',{'tel':tel,'captha':captha},function(data){

          const res = JSON.parse(data);

          if ( res.status == 'error' ) {

            if ( res.reload == 'true' ) {
              setTimeout(function(){
                window.location = '/DurakYonetim/Giris?Sifremi=Unuttum';
              },2000);
            }

            $('input[name="pass"]').val('');
            Swal.fire({
              type: 'warning',
              title: 'Hata !',
              html: res.text,
              confirmButtonText:'Kapat',
              showConfirmButton:true,
              showCancelButton:false
            })



          } else if ( res.status == 'success' ) {

            setTimeout(function(){
              window.location = '/DurakYonetim/Giris?Adım=2';
            },3000);

            Swal.fire({
              type: 'success',
              title: 'Pin kodu telefonunuza gönderildi',
              html: '<br><strong>Lütfen 3 dk içerisinde kodu onaylayınız.</strong>',
              cancelButtonText:'Kapat',
              showConfirmButton:false,
              showCancelButton:false,
              allowEscapeKey:false,
              allowOutsideClick:false
            })

          }

        });
      },1000);

    }
  }

  return false;
});

    $('.validate-form').on('submit',function(){
      var check = true;

      for(var i=0; i<input.length; i++) {
        if(validate(input[i]) == false){
          showValidate(input[i]);
          check=false;
        }
      }

      if ( check == false ) {
        return check;
      } else if ( $('#page').val() == 'login' ) {

        const DurakCode = $('input[name="durakcode"]').val();
        const Pass = $('input[name="pass"]').val();
        const Pg0 = $('input[name="pg0"]').val();
        const Pg1 = $('input[name="pg1"]').val();
        const Pg2 = $('input[name="pg2"]').val();
        const Pg3 = $('input[name="pg3"]').val();
        const Pg4 = $('input[name="pg4"]').val();
        const Pg5 = $('input[name="pg5"]').val();

        let RMB = 'false';
        if ( $('#ckb1').is(':checked') )  RMB = 'true';

        if ( DurakCode == '' || Pass == '' || Pg0 == '' || Pg1 == '' || Pg2 == '' || Pg3 == '' || Pg4 == '' || Pg5 == '' || DurakCode == 'undefined' || Pass == 'undefined' || Pg0 == 'undefined' || Pg1 == 'undefined' || Pg2 == 'undefined' || Pg3 == 'undefined' || Pg4 == 'undefined' || Pg5 == 'undefined' ) {
          location.reload();
        } else {

          swal.fire({
            title: "Lütfen Bekleyiniz...",
            text:'Bilgileriniz kontrol ediliyor...',
            showCancelButton: false,
            showConfirmButton:false,
            allowEscapeKey:false,
            allowOutsideClick:false,
            closeOnConfirm: false,
            closeOnCancel: false
          });


          setTimeout(()=>{

            $.post('/DurakYonetim/Giris/Ajax',{'DurakCod':DurakCode,'Pass':Pass,'RMB':RMB,'Pg0':Pg0,'Pg1':Pg1,'Pg2':Pg2,'Pg3':Pg3,'Pg4':Pg4,'Pg5':Pg5},function(data){

              const res = JSON.parse(data);

              if ( res.status == 'success' ) {

                $('input[name="durakcode"]').attr('disabled','disabled');
                $('input[name="pass"]').attr('disabled','disabled');
                $('input[name="pass"]').attr('type','text');
                $('input[name="durakcode"]').val('Yönlendiriliyorsunuz...');
                $('input[name="pass"]').val('Yönlendiriliyorsunuz...');


                Swal.fire({
                  type: 'success',
                  title: 'Başarıyla Giriş Yaptınız',
                  html: '<br><strong>Yönlendiriliyorsunuz...</strong>',
                  cancelButtonText:'Kapat',
                  showConfirmButton:false,
                  showCancelButton:false,
                  allowEscapeKey:false,
                  allowOutsideClick:false
                })

                setTimeout(function(){
                  window.location = '/DurakYonetim';
                },2000);

              } else {

                if ( res.reload == 'true' ) {
                  setTimeout(function(){
                    window.location = '/DurakYonetim/Giris';
                  },2000);
                }

                $('input[name="pass"]').val('');
                Swal.fire({
                  type: 'warning',
                  title: 'Hata !',
                  html: res.text,
                  confirmButtonText:'Kapat',
                  showConfirmButton:true,
                  showCancelButton:false
                })

              }



            });
          },1000);

        }

      }
    });


    $('.validate-form .input100').each(function(){
      $(this).focus(function(){
       hideValidate(this);
     });
    });

    function validate (input) {
      if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
        if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
          return false;
        }
      }
      else {
        if($(input).val().trim() == ''){
          return false;
        }
      }
    }

    function showValidate(input) {
      var thisAlert = $(input).parent();

      $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
      var thisAlert = $(input).parent();

      $(thisAlert).removeClass('alert-validate');
    }
    

  })(jQuery);