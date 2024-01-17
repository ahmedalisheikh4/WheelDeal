// $(function ($) {
//     "use strict";

//     // LOADER
//     if(gs.is_loader == 1)
//     {
//       $(window).on("load", function (e) {
//           $('#preloader').fadeOut(1000);
//       });
//     }

//     $(document).ready(function () {

//       // NORMAL FORM

//       $(document).on('submit','#geniusform',function(e){
//         e.preventDefault();
//         $('.gocover').show();
//         $('button.submit-btn').prop('disabled',true);
//             $.ajax({
//              method:"POST",
//              url:$(this).prop('action'),
//              data:new FormData(this),
//              contentType: false,
//              cache: false,
//              processData: false,
//              success:function(data)  
//              {
//                 if ((data.errors)) {
//                 $('.alert-success').hide();
//                 $('.alert-danger').show();
//                 $('.alert-danger ul').html('');
//                   for(var error in data.errors)
//                   {
//       							let flag = 0;
//       							$('.alert-danger ul li').each(function() {
//       								if ($(this).text() == data.errors[error]) {
//       									flag = 1;
//       								}
//       							});
//       							if (flag == 1) {
//       								continue;
//       							}
//                     $('.alert-danger ul').append('<li>'+ data.errors[error] +'</li>')
//                   }
//                 }
//                 else
//                 {
//                   $('.alert-danger').hide();
//                   $('.alert-success').show();
//                   $('.alert-success p').html(data);
//                   document.getElementById('geniusform').reset();
//                 }
//                 $('.gocover').hide();
//                 $('button.submit-btn').prop('disabled',false);
//              }

//             });

//       });

//       // NORMAL FORM ENDS


//       // REGISTER FORM

//       $("#registerform").on('submit',function(e){
//         e.preventDefault();
//         $('#pills-signup button.submit-btn').prop('disabled',true);
//         $('#pills-signup .alert-info').show();
//         $('#pills-signup .alert-info p').html($('#processdata').val());
//             $.ajax({
//              method:"POST",
//              url:$(this).prop('action'),
//              data:new FormData(this),
//              dataType:'JSON',
//              contentType: false,
//              cache: false,
//              processData: false,
//              success:function(data)
//              {
//                // console.log(data);
//                 if ((data.errors)) {
//                 $('#pills-signup .alert-success').hide();
//                 $('#pills-signup .alert-info').hide();
//                 $('#pills-signup .alert-danger').show();
//                 $('#pills-signup .alert-danger ul').html('');
//                   for(var error in data.errors)
//                   {
//                     $('#pills-signup .alert-danger p').html(data.errors[error]);
//                   }
//                 $('#pills-signup button.submit-btn').prop('disabled',false);
//                 }
//                 else
//                 {
//                   $('#pills-signup .alert-info').hide();
//                   $('#pills-signup .alert-danger').hide();
//                   $('#pills-signup .alert-success').show();
//                   $('#pills-signup .alert-success p').html(data);
//                   $('#pills-signup button.submit-btn').prop('disabled',false);

//                   $('#registerform').trigger("reset");
//                 }

//              }

//             });

//       });
//       // REGISTER FORM ENDS



//       // LOGIN FORM

//       $("#loginform").on('submit',function(e){
//         e.preventDefault();
//         $('#pills-profile button.submit-btn').prop('disabled',true);
//         $('#pills-profile .alert-info').show();
//         $('#pills-profile .alert-info p').html($('#authdata').val());
//             $.ajax({
//              method:"POST",
//              url:$(this).prop('action'),
//              data:new FormData(this),
//              dataType:'JSON',
//              contentType: false,
//              cache: false,
//              processData: false,
//              success:function(data)
//              {
//                 if ((data.errors)) {
//                 $('#pills-profile .alert-success').hide();
//                 $('#pills-profile .alert-info').hide();
//                 $('#pills-profile .alert-danger').show();
//                 $('#pills-profile .alert-danger ul').html('');
//                   for(var error in data.errors)
//                   {
//                     $('#pills-profile .alert-danger p').html(data.errors[error]);
//                   }
//                 }
//                 else
//                 {
//                   $('#pills-profile .alert-info').hide();
//                   $('#pills-profile .alert-danger').hide();
//                   $('#pills-profile .alert-success').show();
//                   $('#pills-profile .alert-success p').html('Success !');
//                   if(data == 1){
//                     location.reload();
//                   }
//                   else{
//                     window.location = data;
//                   }

//                 }
//                 $('#pills-profile button.submit-btn').prop('disabled',false);
//              }

//             });

//       });

//       // LOGIN FORM ENDS

//       // FORGOT FORM

//       $("#forgotform").on('submit',function(e){
//         e.preventDefault();
//         $('button.submit-btn').prop('disabled',true);
//         $('.alert-info').show();
//         $('.alert-info p').html($('#authdata').val());
//             $.ajax({
//              method:"POST",
//              url:$(this).prop('action'),
//              data:new FormData(this),
//              dataType:'JSON',
//              contentType: false,
//              cache: false,
//              processData: false,
//              success:function(data)
//              {
//                 if ((data.errors)) {
//                 $('.alert-success').hide();
//                 $('.alert-info').hide();
//                 $('.alert-danger').show();
//                 $('.alert-danger ul').html('');
//                   for(var error in data.errors)
//                   {
//                     $('.alert-danger p').html(data.errors[error]);
//                   }
//                 }
//                 else
//                 {
//                   $('.alert-info').hide();
//                   $('.alert-danger').hide();
//                   $('.alert-success').show();
//                   $('.alert-success p').html(data);
//                   $('input[type=email]').val('');
//                 }
//                 $('button.submit-btn').prop('disabled',false);
//              }

//             });

//       });
//     });

// });
