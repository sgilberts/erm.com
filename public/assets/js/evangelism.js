// import DataTable from 'datatables.net-dt';
// import 'datatables.net-responsive-dt';
 

$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });


  // Add New Souls
    $("body").on("click", ".add_new_soul_btn", function(e) {
        e.preventDefault();

        var my_btn = $(this).text();

        // console.log('4');

        if (my_btn == 'Add New Soul') {
            $("#add_new_soul_div").show();
            $("#edit_new_soul_div").hide();
            $("#add_new_soul_btn").text('Hide Add New Soul');
        } else {
            $("#add_new_soul_div").hide();
            $("#edit_new_soul_div").hide();
            $("#add_new_soul_btn").text('Add New Soul');
        }

    });


    // Edit New Soul
    $("body").on("click", ".edit_new_soul_btn", function(e) {
        e.preventDefault();

        var id = $(this).attr('id');

        // console.log(id);

        $.ajax({
            url: "edit_new_soul/"+id,
            method: 'GET',
            dataType: 'json',
            // data: 'id',
            success: function(response) {

                // console.log(response);
                
                $("#edit_ft_id").val(response.id);
                $("#edit_fname").val(response.first_name);
                $("#edit_lname").val(response.last_name);
                $("#edit_email").val(response.email);
                $("#edit_phone").val(response.cell_number);
                $("#edit_gender").val(response.gender).change();
                $("#edit_location").val(response.ft_location);
                $("#edit_ft_accept_jesus").val(response.ft_accept_jesus).change();
                $("#edit_report_info").val(response.report_info);
                $("#edit_ft_rec_holy").val(response.ft_rec_holy).change();
                $("#edit_branch_name").val(response.branch_id).change();


                $("#add_new_soul_div").hide();
                $("#edit_new_soul_div").show();


                },
                error: function(data) {
                    // console.log(data);
                }
            });
            
    });


    // View New Souls
    $("body").on("click", ".view_new_soul_btn", function(e) {
        e.preventDefault();

        var id = $(this).attr('id');

    
        $.ajax({
            url: "edit_new_soul/"+id,
            method: 'GET',
            dataType: 'json',
            // data: 'id',
            success: function(response) {
    
                $("#ft_text_id").html(response.id);
                $("#ft_text_name").html(response.first_name + ' ' + response.last_name);
                $("#ft_text_name2").html(response.first_name + ' ' + response.last_name);
                $("#ft_text_email").html(response.email);
                $("#ft_text_registered_by").html(response.created_by_fname + ' ' + response.created_by_lname);
                $("#ft_text_phone").html(response.cell_number);
                $("#ft_text_phone2").html(response.cell_number);
                $("#ft_text_ft_location").html(response.ft_location);
                $("#ft_text_ft_interest").html(response.report_info);
                $("#ft_text_branch_name").html(response.branchName);
                $("#text_ft_accept_jesus").html(response.ft_accept_jesus);
                $("#text_ft_rec_holy").html(response.ft_rec_holy);
                $("#ft_text_gender").html(response.gender);
                $("#ft_text_date_created").html(chaangeDateTimeFormat(response.created_at));
                $("#ft_text_date_updated").html(chaangeDateTimeFormat(response.updated_at));

                
                $('#myadminftdetail').modal('show');
    

                },
                error: function(data) {
                    console.log(data);
                }
            });

    });
    

        


    // Temp Restore New Soul
    $("body").on("click", ".restore_new_soul_btn", function(e) {
        e.preventDefault();

        var id = $(this).attr('id');
        var url = "recycle";

        $.ajax({
            url: "edit_new_soul/"+id,
            method: 'GET',
            dataType: 'json',
            // data: 'id',
            success: function(response) {
    
                Swal.fire({
                    title: 'Restore New Soul?',
                    text: 'The new soul "'+response.first_name +' '+ response.last_name+'" will be restored!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                    reverseButtons: true,
                    cancelButtonColor: '#11B',
                    confirmButtonColor: '#F31',
                }).then((result) => {
                    if (result.value) {
        
                        $.ajax({
                            url: "restore_new_soul/"+id,
                            method: 'GET',
                            dataType: 'json',
                            success: function(response) {
                               
                                // location.href = url;
                                if (response.alert_type == 'success') {
                                    
                                    Swal.fire({
                                        title: 'Restored!',
                                        text: 'New soul has been restored.',
                                        icon: 'info',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: '#670A9D',
                                    }).then((result) => {
                                        if (result.value) {
                            
                                            // $('#tbody').load(document.URL +  ' #tbody');
                                            location.href = url;
                                           
                                        } else {
                                            location.href = url;
                                        }
                                    });
        
                                }  else {
                                    Swal.fire(
                                        'New soul not restored',
                                        'success'
                                    )
                                }
        
                            }
                        });
        
                    } else {
                        Swal.fire(
                            'New soul not restored',
                            'success'
                        )
                    }
                });
    
                },
                
            });

    });


    // Temporary Delete First Timer
    $("body").on("click", ".delete_new_soul_btn", function(e) {
        e.preventDefault();

        var id = $(this).attr('id');
        var url = "list";

        $.ajax({
            url: "edit_new_soul/"+id,
            method: 'GET',
            dataType: 'json',
            // data: 'id',
            success: function(response) {
    
                Swal.fire({
                    title: 'Delete New Soul?',
                    text: 'The new soul "'+response.first_name +' '+ response.last_name+'" will be moved into the new souls recycle bin!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: false,
                    cancelButtonColor: '#11B',
                    confirmButtonColor: '#F31',
                }).then((result) => {
                    if (result.value) {
        
                        $.ajax({
                            url: "delete_new_soul/"+id,
                            method: 'GET',
                            dataType: 'json',
                            success: function(response) {
                               
                                // location.href = url;
                                if (response.alert_type == 'success') {
                                    
                                    Swal.fire({
                                        title: 'Deleted!',
                                        text: 'New soul has been moved into the recycle bin.',
                                        icon: 'info',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: '#670A9D',
                                    }).then((result) => {
                                        if (result.value) {
                            
                                            location.href = url;
                                           
                                        } else {
                                            location.href = url;
                                        }
                                    });
        
                                }  else {
                                    Swal.fire(
                                        'New soul is still safe',
                                        'success'
                                    )
                                }
        
                            }
                        });
        
                    } else {
                        Swal.fire(
                            'New soul is still safe',
                            'success'
                        )
                    }
                });
    
                },
                
            });

    });



    // Permanently Delete Admin User
    $("body").on("click", ".perm_delete_new_soul_btn", function(e) {
        e.preventDefault();

        var id = $(this).attr('id');
        var my_url = "recycle";

        $.ajax({
            url: "edit_new_soul/"+id,
            method: 'GET',
            dataType: 'json',
            // data: 'id',
            success: function(response) {
    
                Swal.fire({
                    title: 'Delete New Soul Foerever?',
                    text: 'The new soul "'+response.first_name +' '+ response.last_name+'" will be permanently removed from the database.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: false,
                    cancelButtonColor: '#11B',
                    confirmButtonColor: '#F31',
                }).then((result) => {
                    if (result.value) {
        
                        $.ajax({
                            url: "pem_delete_new_soul/"+id,
                            method: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                
                                // location.href = url;
                                if (response.alert_type == 'success') {
                                    
                                    Swal.fire({
                                        title: 'Deleted!',
                                        text: 'New soul have been removed from database.',
                                        icon: 'info',
                                        confirmButtonText: 'Okay',
                                        confirmButtonColor: '#670A9D',
                                    }).then((result) => {
                                        if (result.value) {
                            
                                            location.href = my_url;
                                            
                                        } else {
                                            location.href = my_url;
                                        }
                                    });
        
                                }  else {
                                    Swal.fire(
                                        'New soul is still safe',
                                        'success'
                                    )
                                }
        
                            }
                        });
        
                    } else {
                        Swal.fire(
                            'New soul is still safe',
                            'success'
                        )
                    }
                });
    
                },
                
            });

    });

    


//     ///////////////////////////////////////////////////////////////////////////////////////////////////////

//     ///////////////////////////////////////////////////////////////////////////////////////////////////////




   
    // Choose Selected Items
    $("body").on("change", ".chooseItem", function(e) {
        e.preventDefault();

        var ids = '';

        $(".chooseItem").each(function() {
            if(this.checked) {
                var id = $(this).val();   
                ids += id+',';
            }
        });
        
        $("#get_select_all").val(ids);
        // $("#get_old_sub_category_id").val(ids);

        // FilterForm();

    });



    // Choose Selected All Checked Items
    $('#tblData').on('change', '.tblChk', function () {
        // debugger;
        if ($('.tblChk:checked').length == $('.tblChk').length) {
        $('#chkAll').prop('checked', true);
        } else {
        $('#chkAll').prop('checked', false);
        
        $("#get_select_all").val('');
        
        }
        getCheckRecords();
    });

    $("#chkAll").change(function () {
        // debugger;
        if ($(this).prop('checked')) {
        $('.tblChk').not(this).prop('checked', true);
        } else {
        $('.tblChk').not(this).prop('checked', false);

        $("#get_select_all").val('');
        
        }
        getCheckRecords();
    });

    

    function getCheckRecords() {
    
        var ids = '';

        $('.tblChk:checked').each(function () {

        if ($(this).prop('checked')) {
            if ($(".selectedDiv").children().length == 0) {

                var id = $(this).val();   
                ids += id+',';
                $("#get_select_all").val(ids);

            } else {
                
                $("#get_select_all").val(ids);
            
            }
        } else {
            $("#get_select_all").val(ids);
        }
    
        console.log(ids);
        });
    }


    // Checked Boxes

    $("body").on("click", ".del_sel_form", function(e) {
        e.preventDefault();

        var values = $("#get_select_all").val();
        var what_to_do = 'del_sel_form';
        // var url = "recycle";
        var my_url = "list";

        // console.log(values);
        if (values == '') {
            Swal.fire(
                'Please select at least one item',
                'error'
            )
        } else {
            SelectionForm(values, what_to_do, my_url);
    
        }
    
    });


    $("body").on("click", ".restore_sel_form", function(e) {
        e.preventDefault();

        var values = $("#get_select_all").val();
        var what_to_do = 'restore_sel_form';
        var my_url = "recycle";
        // var url = "list";

        // console.log(values);
        if (values == '') {
            Swal.fire(
                'Please select at least one item',
                'error'
            )
        } else {
            SelectionForm(values, what_to_do, my_url);
    
        }
    
    });

    $("body").on("click", ".perm_del_sel_form", function(e) {
        e.preventDefault();

        var values = $("#get_select_all").val();
        var what_to_do = 'perm_del_sel_form';
        var my_url = "recycle";
        // var url = "list";

        // console.log(values);
        if (values == '') {
            Swal.fire(
                'Please select at least one item',
                'error'
            )
        } else {
            SelectionForm(values, what_to_do, my_url);
    
        }
    
    });


    function SelectionForm(values, what_to_do, my_url) {


        var myTitle = '';
        var msg = '';
        var msg2 = '';

        if (what_to_do == 'del_sel_form') {
            myTitle = 'Delete All';
            msg = 'Are you sure you want to delete selected new souls?';
            msg2 = 'Selected new soul not deleted';
        } else if (what_to_do == 'restore_sel_form') {
            myTitle = 'Restore All';
            msg = 'Are you sure you want to restore selected new souls?';
            msg2 = 'Selected new soul not restored';
        } else if (what_to_do == 'perm_del_sel_form') {
            myTitle = 'Permanent Delete All';
            msg = 'Are you sure you want to delete selected new souls forever?';
            msg2 = 'Selected new soul not deleted forever';
        }

        Swal.fire({
            title: myTitle,
            text: msg,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            reverseButtons: true,
            cancelButtonColor: '#11B',
            confirmButtonColor: '#F31',
        }).then((result) => {
            if (result.value) {

                $.ajax({
                    url: "selected_action",
                    method: 'GET',
                    dataType: 'json',
                    data: {
                            values: values, 
                            what_to_do: what_to_do
                            },
                    success: function(response) {

                        // console.log(response);
                        if (response.alert_type == 'success') {
                                                
                            location.href = my_url;
                                    
                        }
                        
                    },
                    error: function(data) {
                        // console.log(data);
                    }
                });

            } else {
                Swal.fire(
                    msg2,
                    'success'
                )
            }
        });

    }
        
//     function toast(type, msg, title, positionClass, timeOut) {
//     toastr.options = {
//         "closeButton": true,
//         "debug": false,
//         "newestOnTop": false,
//         "progressBar": false,
//         "positionClass": positionClass,
//         "preventDuplicates": false,
//         "onclick": null,
//         "showDuration": "300",
//         "hideDuration": "1000",
//         "timeOut": timeOut,
//         "extendedTimeOut": "1000",
//         "showEasing": "swing",
//         "hideEasing": "linear",
//         "showMethod": "fadeIn",
//         "hideMethod": "fadeOut"
//     };

//     toastr[type](msg, title, toastr.options);


//     }



    // Convert To Readable Dates
    function chaangeDateFormat(datess) {
        const date = new Date(datess);
        formartedDate = date.toLocaleString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })
        return formartedDate;
    }

    // Convert To Readable Date And Time
    function chaangeDateTimeFormat(datetimes) {
        // var d = new Date(Date.parse(datetimes.replace(/-/g, "/")));

        var d = new Date(datetimes);
        var month = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'Aug', 'September', 'October', 'November', 'December'];
        var date = d.getDate() + " " + month[d.getMonth()] + ", " + d.getFullYear();
        var time = d.toLocaleTimeString().toUpperCase().replace(/([\d]+:[\d]+):[\d]+(\s\w+)/g, "$1$2");
        return (date + " " + time);
    }


//     //Run updates every 10 seconds
//     var k = setInterval(checkUserOnline, 12000);

//     function checkUserOnline() {
//         //Do whatever updating you need

//         getOnlineUsers();
//         // fetchReloadOnline();

//     }

    
// If you want to stop the automatic updates here, you can use the command
// clearInterval(k)
});