$(document).ready(function(){
    // ----------------super admin login ---------------------
    $('#supadm').on('click',function(e){
        e.preventDefault();
        let email = $('#semail').val();
        let pass = $('#spass').val();
        $.ajax({
            type: "POST",
            url: "logincheck.php",
            data: {
                email: email,
                pass : pass,
                user : 'superadmin',
                submit: true
            },
            success: function(response){
                // alert(response);
                $('#supadmform').trigger("reset");
                if(response == 1){
                    // alert(response);
                    window.location.href = "./backend/superadmin/superadminpanel.php";
                }else{
                    alert("Invalid Email id / Password...");
                }
            },
            error: function(){
                alert('Sorry something went wrong, please try again later!')
            }
        });
    });
    // ----------------admin login ---------------------
    $('#adm').on('click',function(e){
        e.preventDefault();
        let email = $('#aemail').val();
        let pass = $('#apass').val();
        $.ajax({
            type: "POST",
            url: "logincheck.php",
            data: {
                email: email,
                pass : pass,
                user : 'admin',
                submit: true
            },
            success: function(response){
                $('.admform').trigger("reset");
                // alert(response);
                if(response == 1){
                    // alert(response);
                    window.location.href = "./backend/admin/adminpanel.php";
                }else{
                    alert("Invalid Email id / Password...");
                }
            },
            error: function(){
                alert('Sorry something went wrong, please try again later!')
            }
        });
    });
    // -----------------------------------------staff login----------------------
    $('#staff').on('click',function(e){
        e.preventDefault();
        let email = $('#stemail').val();
        let pass = $('#stpass').val();
        $.ajax({
            type: "POST",
            url: "logincheck.php",
            data: {
                email: email,
                pass : pass,
                user : 'staff',
                submit: true
            },
            success: function(response){
                // $('.staffform').trigger("reset");
                // alert(response);
                if(response == 1){
                    // alert(response);
                    window.location.href = "./backend/staff/staffpanel.php";
                }else{
                    alert("Invalid Email id / Password...");
                }
            },
            error: function(){
                alert('Sorry something went wrong, please try again later!')
            }
        });
    });
    // ------------------------------------customer user login--------------------------------------
    $('#customerlogsubmit').on('click',function(e){
        e.preventDefault();
        let email = $('#customeremailid').val();
        let pass = $('#customerpass').val();
        $.ajax({
            type: "POST",
            url: "logincheck.php",
            data: {
                email: email,
                pass : pass,
                user : 'customer',
                submit: true
            },
            success: function(response){
                $('#customerloginform').trigger("reset");
                // alert(response);
                if(response == 1){
                    // alert("successful");
                    $('#customer-login-modal').modal('hide');
                    // window.location.href = "./index.php";
                    location.reload(true);
                }else if(response == 0 || response == 2){
                    alert("Invalid Email id / Password...");
                }else{
                    alert(response);
                    location.reload(true);
                }
            },
            error: function(){
                alert('Sorry something went wrong, please try again later!')
            }
        });
    });
    // --------------------------------------------customer registration----------------------
    $("#customerregform").on('submit',function(e){
        e.preventDefault();
        // let name =$("#customername").val();
        // let email =$("#customeremail").val();
        // let pass =$("#customerpass").val();
        var userregformdata = new FormData(this);
        // console.log(userregformdata);
        // return false;
        $.ajax({
            url: 'userreg.php',
            type: 'POST',
            data: userregformdata,
            processData: false,
            contentType: false,
            success: function(response){
                $('#customerregform').trigger("reset");
                // alert(response);
                if(response == 1){
                    alert("Registration Succesfull");
                    $('#customer-reg-modal').modal('hide');
                    $('#customer-login-modal').modal('show');
                }else if(response == 2){
                    alert("Image Should Be jpg/png/jpeg");
                }else{
                    alert("Registration unsuccessfull...");
                }
            },
            error: function(){
                alert('Sorry something went wrong, please try again later!')
            }
        });
    });

    // -----------------------------------------load food items-----------------------------------------
    $('.food-items').on('click',function(){
        var catid = $(this).data('catid');
        // alert(catid);
        $.ajax({
            type: 'POST',
            url: 'loaditems.php',
            data: {
                catid: catid,
                fooditem: true
            },
            success: function(response){
                // alert(response);
                $('.fooditem-container').empty();
                $('.fooditem-container').html(response);
            },
            error:function(){
                alert("Something Went Wrong...");
            }
        });
    });
    // -------------------------------add to cart------------------------------
    $(document).on('click','.food-cart',function(){
        var foodid = $(this).data('foodid');
        // alert(foodid);
        $.ajax({
            url: 'cookie.php',
            type: 'POST',
            data: {
                foodid : foodid,
                cookie : true
            },
            success : function(res){
                alert(res);
                $('.close').on('click',function(){
                   location.reload(true);
                });
            }
        });
    });
    // -------------------------------------remove cookie items---------------------------------
    $('.rmvcookie').on('click',function(){
        var cookieid = $(this).data('cookieid');
        // alert(cookieid);
        $.ajax({
            url: 'removecookie.php',
            type: 'POST',
            data:{
                cookie : 'remove',
                id : cookieid
            },
            success: function(response){
                // alert(response);
                if(response==1){
                    location.reload(true);
                }else{
                    alert('Item cant be remove');
                }
            }
        });
    });
    // -------------------------checkout section---------------------
    $('.checkout').on('click',function(){
        
        $.ajax({
            url: 'checkout.php',
            type: 'POST',
            data:{
                check: true
            },
            success:function(response){
                // alert(response);
                if(response == 1){
                    alert("Go for payment");
                }else{
                    $('#customer-login-modal').modal('show');
                }
            }
        });
    });
   
});