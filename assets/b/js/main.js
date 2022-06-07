
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

    $('.validate-form').on('submit',function(){
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }

        if ( check == true ) {
            Swal.fire({
                title: "Lütfen Bekleyiniz . . .",
                text:'Bir sonraki adım için hazırlık yapıyoruz.',
                showCancelButton: false,
                showConfirmButton:false,
                allowEscapeKey:false,
                allowOutsideClick:false
            });

            setTimeout(()=>{

                const FormData = $('#step_form').serialize();

                $.post('?'+Date.now(),FormData,(data)=>{

                    const json = JSON.parse(data);

                    if ( json.type == 'swal' ) {

                        Swal.fire({
                            title: json.title,
                            html:json.message,
                            showCancelButton: false,
                            type:json.status,
                            confirmButtonText:'Tamam',
                            showConfirmButton:true,
                            allowEscapeKey:false,
                            allowOutsideClick:false
                        });

                    } else if ( json.type == 'pass_step' ) {

                        $('#step_div').html(json.stepForm);
                        $.get('/assets/b/js/main.js');
                        setTimeout(()=>{
                            Swal.close();
                        },500);

                    } else if ( json.type == 'refsuccess' ) {

                     Swal.fire({
                        title: 'Başarıyla giriş yaptınız !',
                        text:'Yönlendiriliyorsunuz...',
                        showCancelButton: false,
                        type:'success',
                        showConfirmButton:false,
                        allowEscapeKey:false,
                        allowOutsideClick:false
                    });

                     setTimeout(()=>{
                        location.reload();
                    },2000);

                 }

             }).fail(()=>{
                Swal.fire({
                    title: 'Bir Hata Oluştu!',
                    text:'Sistemsel bir hata oluştu, lütfen daha sonra tekrar deneyiniz.',
                    showCancelButton: false,
                    type:'error',
                    confirmButtonText:'Tamam',
                    showConfirmButton:true,
                    allowEscapeKey:false,
                    allowOutsideClick:false
                });
            });

         },1500);

        }

        return check;
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