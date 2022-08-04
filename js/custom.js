$(document).ready(function(){
    // ---------------slick slider------------
    $('.slides').slick({
        // dots: true,
        infinite: true,
        speed: 500,
        fade: true,
        cssEase: 'linear',
        autoplay: true,
        prevArrow: '<i class="fa fa-angle-left left_arrow">',
        nextArrow: '<i class="fa fa-angle-right right_arrow">'
    });
    // ---------------------Special Food---------------------
    $('.special,.testimonial,.partner').slick({
        // dots: true,
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 3,
        autoplay: true,
        speed: 2000,
        prevArrow: '<i class="fa fa-angle-left left_arrow">',
        nextArrow: '<i class="fa fa-angle-right right_arrow">',
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 2,
              infinite: true,
            //   dots: true
            }
          },
          {
            breakpoint: 800,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
      });
        // ------------------------------service----------------------
      $('.service-slides').slick({
        // dots: true,
        infinite: true,
        speed: 500,
        fade: true,
        cssEase: 'linear',
        autoplay: true,
        arrows: false
      });
    // --------------------nav background--------------
    $(window).scroll(function(){
        $('#header').toggleClass('navbg',$(this).scrollTop()>20);
    })
    // -----------------menu modal-----------------
    $('#menubtn').on('click',function(){
        $('#menumodal').modal('show');
    });
    // -------------------food items modal----------------
    $('.food-items').on('click',function(){
        $('.food-item-modal').modal('show');
    });
    // ------------------login form------------
    $('.supadminbtn').on('click',function(){
      $('#supadm-login-modal').modal('show');
    });
    $('.adminbtn').on('click',function(){
      $('#admin-login-modal').modal('show');
    });
    $('.staffbtn').on('click',function(){
        $('#staff-login-modal').modal('show');
    });
    $('.dlbtn').on('click',function(){
      $('#delivery-login-modal').modal('show');
    });
    $('.customerbtn').on('click',function(){
      $('#customer-login-modal').modal('show');
    });
    $('#customer-signup').on('click',function(){
      $('#customer-login-modal').modal('hide');
      $('#customer-reg-modal').modal('show');
    });
    // $('#admin-reg-form').on('click',function(){
    //     $('#admin-login-modal').modal('hide');
    //     $('#admin-reg-modal').modal('show');
    // });
    // $('#emp-reg-form').on('click',function(){
    //     $('#emp-login-modal').modal('hide');
    //     $('#emp-reg-modal').modal('show');
    // });
    $('#addfoodbtn').on('click',function(){
      $('#foodregform').modal('show');
    });
    $('#addfoodcatbtn').on('click',function(){
      $('#foodcatregform').modal('show');
    });
    $('#addempbtn').on('click',function(){
      $('#empregformmodal').modal('show');
    });
    // ---------------------maintainance---------------------
    $('#openbannermodalform').on('click',function(){
      $('#bannermodal').modal('show');
    });
    $('#openservicemodalform').on('click',function(){
      $('#servicemodal').modal('show');
    });
    $('#openemployeemodalform').on('click',function(){
      $('#employeemodal').modal('show');
    });
    $('#openpartnermodalform').on('click',function(){
      $('#partnermodal').modal('show');
    });
    // -------------------sidebar---------------
    $('.sidemenubtn').on('click',function(){
      $('.sidebar').toggleClass('left');
    });
    // ----------------------cart price manipulation-------------------
    $('.quantity').change(function(){
      var quant = $(this).val();
      // alert(quant);
      var proprice = quant * $(this).data('price');
      // alert($(this).closest('div .card-body').find("input[name='price']").val());
      $(this).closest('div .card-body').find("input[name='price']").val(proprice);
      var mrp = 0;
      $('.price').each(function(){
        // console.log($(this).val());
       mrp = mrp +  parseInt($(this).val());
      });
      // console.log(mrp);
      $('#mrp').val(mrp);
      mrp = $('#mrp').val();
      var gst = (mrp*12)/100;
      // alert(gst);
      $('#gst').val(gst);
      var totalprice = parseInt(mrp)+parseInt(gst);
      // alert(totalprice);
      $('#total').val(totalprice);
      
    })
});