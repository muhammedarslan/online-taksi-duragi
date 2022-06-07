
var FormValidation = function () {

    // basic validation
    var handleValidation1 = function() {
        // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation

            var form1 = $('#form_sample_1');

            form1.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                messages: {
                    select_multi: {
                        maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
                        minlength: jQuery.validator.format("At least {0} items must be selected")
                    }
                },
                rules: {
                    name: {
                        minlength: 2,
                        required: true
                    },                    
                    email: {
                        required: true,
                        email: true
                    },
                    url: {
                        required: true,
                        url: true
                    },
                    number: {
                        required: true,
                        number: true
                    },
                    digits: {
                        required: true,
                        digits: true
                    },
                    creditcard: {
                        required: true,
                        creditcard: true
                    },
                    occupation: {
                        minlength: 5,
                    },
                    select: {
                        required: true
                    },
                    
                },

                invalidHandler: function (event, validator) { //display error alert on form submit              
                    success1.hide();
                    error1.show();
                    App.scrollTo(error1, -200);
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                    var cont = $(element).parent('.input-group');
                    if (cont) {
                        cont.after(error);
                    } else {
                        element.after(error);
                    }
                },

                highlight: function (element) { // hightlight error inputs
                	$(element).closest('.form-group').removeClass('has-success').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set error class to the control group
                },

                success: function (label) {
                    label.closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                },

                submitHandler: function (form) {
                    success1.show();
                    error1.hide();
                }
            });


        };

        function loading_swal() {
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
        }

    // validation using icons
    var handleValidation2 = function() {
        // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation

            var form2 = $('#form_sample_2');
            var error2 = $('.alert-danger', form2);
            var success2 = $('.alert-success', form2);

            form2.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                rules: {
                    name: {
                        minlength: 2,
                        required: true
                    },
                    surucu: {
                        minlength: 2,
                        required: true
                    },
                    bilgi: {
                        minlength: 2,
                        required: true
                    },
                    tel: {
                        minlength: 2,
                        required: true
                    },
                    adres: {
                        minlength: 5,
                        required: true
                    },
                    plaka: {
                        minlength: 5,
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    parola: {
                        minlength: 4,
                        required: true
                    },
                    taksicagir: {
                        minlength: 2,
                        required: true
                    },
                    msg1: {
                        minlength: 2,
                        required: true
                    },
                    msg2: {
                        minlength: 2,
                        required: true
                    },
                    msg3: {
                        minlength: 2,
                        required: true
                    },
                    msg4: {
                        minlength: 2,
                        required: true
                    },
                    msg5: {
                        minlength: 2,
                        required: true
                    },
                    msg6: {
                        minlength: 2,
                        required: true
                    },
                    msg7: {
                        minlength: 2,
                        required: true
                    },
                    msg8: {
                        minlength: 2,
                        required: true
                    },
                    msg9: {
                        minlength: 2,
                        required: true
                    },
                    msg10: {
                        minlength: 2,
                        required: true
                    },
                    iban: {
                        minlength: 2,
                        required: true
                    },
                    url: {
                        required: true,
                        url: true
                    },
                    c_email: {
                        required: true,
                        email: true
                    },
                    c_name: {
                        required: true,
                        minlength: 2
                    },
                    c_message: {
                        required: true,
                        minlength: 2
                    },
                    number: {
                        required: true,
                        number: true
                    },
                    creditcard: {
                        required: true,
                        creditcard: true
                    },
                },

                invalidHandler: function (event, validator) { //display error alert on form submit              
                    success2.hide();
                    error2.show();
                    App.scrollTo(error2, -200);
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                    var icon = $(element).parent('.input-icon').children('i');
                    icon.removeClass('fa-check').addClass("fa-warning");  
                    icon.attr("data-original-title", error.text()).tooltip({'container': 'body'});
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').removeClass("has-success").addClass('has-error'); // set error class to the control group   
                    },

                unhighlight: function (element) { // revert the change done by hightlight

                },

                success: function (label, element) {
                    var icon = $(element).parent('.input-icon').children('i');
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                    icon.removeClass("fa-warning").addClass("fa-check");
                },

                submitHandler: function (form) {
                    success2.show();
                    error2.hide();
                    //form[0]
                    loading_swal();

                    setTimeout(()=>{

                        const FormData = $('#form_sample_2').serialize();

                        $.post('',FormData,(data)=>{

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
            });


}



return {
        //main function to initiate the module
        init: function () {

            handleValidation1();
            handleValidation2();

        }

    };

}();

jQuery(document).ready(function() {
	'use strict';
    FormValidation.init();
});