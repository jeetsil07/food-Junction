$(document).ready(function(){
    // ---------------------Emlloyee table----------------------
    function showTable(tabletype,page){
        $.ajax({
            url: '../backendoperation.php',
            type:'POST',
            data:{
                show: tabletype,
                page_no: page
            },
            success: function(res){
                $('#showemptable').html(res);
            }
        });
    }
    // ----------------------Staff Table Pagination-------------------
    $(document).on('click','.staffepno',function(){
        var pno = $(this).attr('id');
        // alert(pno);
        showTable('staff',pno);
    });
    // ----------------------admin Table Pagination-------------------
    $(document).on('click','.adminepno',function(){
        var pno = $(this).attr('id');
        // alert(pno);
        showTable('admin',pno);
    });
    // ----------------------Superadmin Table Pagination-------------------
    $(document).on('click','.super_adminepno',function(){
        var pno = $(this).attr('id');
        // alert(pno);
        showTable('superadmin',pno);
    });
    // ----------------------DeliveryagentTable Pagination-------------------
    $(document).on('click','.deliveryagentepno',function(){
        var pno = $(this).attr('id');
        // alert(pno);
        showTable('deliveryagent',pno);
    });
    // --------------------superadmin table-------------------
    $('#showsuperadmin').on('click',function(){
        showTable('superadmin');
    });
    // --------------------admin table-------------------
    $('#showadmin').on('click',function(){
        showTable('admin');
    });
    // --------------------staff table-------------------
    $('#showstaff').on('click',function(){
        showTable('staff');
    });
    // --------------------deliveryagent table-------------------
    $('#showdeliveryagent').on('click',function(){
        showTable('deliveryagent');
    });
    // ----------------------------Edit staff table--------------------
    $(document).on('click','.staffeditbtn',function(){
        var staffid = $(this).data('staffid');
        // alert(pid);
        $.ajax({
            url: '../edit.php',
            type: 'POST',
            data:{
                staffid: staffid,
                staffedit: true
            },
            success: function(response){
                // alert(response);
                $('#empeditformcontainer').html(response);
                $('#emp-edit-modal').modal('show');
            }
        })
    });
    // -----------------staff Edit confirm--------------------------
    $(document).on('click','#staffeditsubmit',function(e){
        e.preventDefault();
        var uempname = $('#uempname').val();
        var uempemail = $('#uempemail').val();        
        var empid = $('#staffeditsubmit').data('staffeditid');
        // alert(empid);
        if(confirm('Are You Sure to Updata Data?')){
            $.ajax({
                url: '../edit.php',
                type: 'POST',
                data:{
                    uempname: uempname,
                    uempemail: uempemail,
                    empid: empid,
                    edit: 'editstaffdetails'
                },
                success: function(response){
                    alert(response);
                    $('#emp-edit-modal').modal('hide');
                    location.reload(true);
                }
            });
        }else{
            alert('Data Updation Cancel');
        }
    });
     // ----------------------------Edit admin table--------------------
     $(document).on('click','.admineditbtn',function(){
        var adminid = $(this).data('adminid');
        // alert(pid);
        $.ajax({
            url: '../edit.php',
            type: 'POST',
            data:{
                adminid: adminid,
                adminedit: true
            },
            success: function(response){
                // alert(response);
                $('#empeditformcontainer').html(response);
                $('#emp-edit-modal').modal('show');
            }
        })
    });
    // -----------------admin Edit confirm--------------------------
    $(document).on('click','#admineditsubmit',function(e){
        e.preventDefault();
        var uempname = $('#uempname').val();
        var uempemail = $('#uempemail').val();        
        var empid = $('#admineditsubmit').data('admineditid');
        // alert(empid);
        if(confirm('Are You Sure to Updata Data?')){
            $.ajax({
                url: '../edit.php',
                type: 'POST',
                data:{
                    uempname: uempname,
                    uempemail: uempemail,
                    empid: empid,
                    edit: 'editadmindetails'
                },
                success: function(response){
                    alert(response);
                    $('#emp-edit-modal').modal('hide');
                    location.reload(true);
                }
            });
        }else{
            alert('Data Updation Cancel');
        }
    });
     // ----------------------------Edit superadmin table--------------------
     $(document).on('click','.super_admineditbtn',function(){
        var superadminid = $(this).data('super_adminid');
        // alert(pid);
        $.ajax({
            url: '../edit.php',
            type: 'POST',
            data:{
                superadminid: superadminid,
                superadminedit: true
            },
            success: function(response){
                // alert(response);
                $('#empeditformcontainer').html(response);
                $('#emp-edit-modal').modal('show');
            }
        })
    });
    // -----------------superadmin Edit confirm--------------------------
    $(document).on('click','#super_admineditsubmit',function(e){
        e.preventDefault();
        var uempname = $('#uempname').val();
        var uempemail = $('#uempemail').val();        
        var empid = $('#super_admineditsubmit').data('super_admineditid');
        // alert(empid);
        if(confirm('Are You Sure to Updata Data?')){
            $.ajax({
                url: '../edit.php',
                type: 'POST',
                data:{
                    uempname: uempname,
                    uempemail: uempemail,
                    empid: empid,
                    edit: 'editsuperadmindetails'
                },
                success: function(response){
                    alert(response);
                    $('#emp-edit-modal').modal('hide');
                    location.reload(true);
                }
            });
        }else{
            alert('Data Updation Cancel');
        }
    });
     // ----------------------------Edit deliveryagent table--------------------
     $(document).on('click','.deliveryagenteditbtn',function(){
        var deliveryagentid = $(this).data('deliveryagentid');
        // alert(pid);
        $.ajax({
            url: '../edit.php',
            type: 'POST',
            data:{
                deliveryagentid: deliveryagentid,
                deliveryagentedit: true
            },
            success: function(response){
                // alert(response);
                $('#empeditformcontainer').html(response);
                $('#emp-edit-modal').modal('show');
            }
        })
    });
    // -----------------deliveryagent Edit confirm--------------------------
    $(document).on('click','#deliveryagenteditsubmit',function(e){
        e.preventDefault();
        var uempname = $('#uempname').val();
        var uempemail = $('#uempemail').val();        
        var empid = $('#deliveryagenteditsubmit').data('deliveryagenteditid');
        // alert(empid);
        if(confirm('Are You Sure to Updata Data?')){
            $.ajax({
                url: '../edit.php',
                type: 'POST',
                data:{
                    uempname: uempname,
                    uempemail: uempemail,
                    empid: empid,
                    edit: 'editdeliveryagentdetails'
                },
                success: function(response){
                    alert(response);
                    $('#emp-edit-modal').modal('hide');
                    location.reload(true);
                }
            });
        }else{
            alert('Data Updation Cancel');
        }
    });
    // -----------------------------product table---------------------
    function showproductTable(tabletype,page){
        // alert("hello");
        $.ajax({
            url: '../backendoperation.php',
            type:'POST',
            data:{
                show: tabletype,
                page_no: page
            },
            success: function(res){
                // alert(res);
                $('#producttablecontainer').html(res);
            }
        });
    }
    showproductTable('food_items');
    // -------------product pagination----------------
    $(document).on('click','.ppno',function(){
        var pno = $(this).attr('id');
        // alert(pno);
        showproductTable('food_items',pno);
    });
    // ------------------product edit------------------
    $(document).on('click','.peditbtn',function(){
        var pid = $(this).data('pid');
        // alert(pid);
        $.ajax({
            url: '../edit.php',
            type: 'POST',
            data:{
                pid: pid,
                edit: true
            },
            success: function(response){
                $('#peditformcontainer').html(response);
                $('#product-edit-modal').modal('show');
            }
        })
    });
    // -----------------Edit confirm--------------------------
    $(document).on('click','#foodedit',function(e){
        e.preventDefault();
        var ufoodname = $('#ufoodname').val();
        var ufoodcat = $('#ufoodcat').val();
        var ufoodmrp = $('#ufoodmrp').val();
        var ufoodgst = $('#ufoodgst').val();
        var foodedit = $('#foodedit').data('foodeditid');
        // alert(foodedit);
        if(confirm('Are You Sure to Updata Data?')){
            $.ajax({
                url: '../edit.php',
                type: 'POST',
                data:{
                    ufoodname: ufoodname,
                    ufoodcat: ufoodcat,
                    ufoodmrp: ufoodmrp,
                    ufoodgst: ufoodgst,
                    foodedit: foodedit,
                    edit: 'fooditems'
                },
                success: function(response){
                    alert(response);
                    $('#product-edit-modal').modal('hide');
                    location.reload(true);
                }
            });
        }else{
            alert('Data Updation Cancel');
        }
    });
    // -----------------------------Delete Food Items------------------------------
    $(document).on('click','.pdltbtn',function(){
        var pid = $(this).data('pid');
        // alert(pid);
        if(confirm('Are You Sure to Delete Data?')){
            $.ajax({
                url: '../edit.php',
                type: 'POST',
                data:{
                    dfoodid: pid,
                    delete: true
                },
                success: function(response){
                    alert(response);
                    location.reload(true);
                }
            });
        }else{
            alert('Data Deletion Cancel');
        }
    });
});