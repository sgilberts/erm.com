// import DataTable from 'datatables.net-dt';
// import 'datatables.net-responsive-dt';
 
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});



$(document).ready(function() {

  // Add User
  $("body").on("click", ".add_user_btn", function(e) {
    e.preventDefault();

    var my_btn = $(this).text();

    if (my_btn == 'Add User') {
        $("#add_user_div").show();
        $("#edit_user_div").hide();
        $("#add_user_btn").text('Hide Add User');
    } else {
        $("#add_user_div").hide();
        $("#edit_user_div").hide();
        $("#add_user_btn").text('Add User');
    }
    // console.log(my_btn);
    // $("").hide();
    // $("").hide();

    // var id = $(this).attr('id');

    // console.log(id);

    // $("#get_sort_by_name").val(id);

    // $.ajax({
    //     url: "edit_customer/"+id,
    //     method: 'GET',
    //     dataType: 'json',
    //     // data: 'id',
    //     success: function(response) {

    //         // console.log(response);
    //         $("#edit_name").val(response.name);
    //         $("#edit_contact_number").val(response.contact_number);
    //         $("#edit_contact_email").val(response.contact_email);
    //         $("#edit_address").val(response.address);
    //         $("#edit_department").val(response.department_id).change();
    //         $("#edit_doctor_address").val(response.doctor_address);
    //         // $("#edit_id").val(response.department_id);
    //         // $("#edit_id").val(response.id);
    //         // $("#edit_id").val(response.id);
    //         $("#edit_cus_id").val(response.id);

    //         $('#editCustomerform').modal('show');

    //         },
    //         error: function(data) {
    //             // console.log(data);
    //         }
    //     });

});


  // Edit User
  $("body").on("click", ".edit_user_btn", function(e) {
    e.preventDefault();

    var id = $(this).attr('id');

    // console.log(id);

    $.ajax({
        url: "edit_user/"+id,
        method: 'GET',
        dataType: 'json',
        // data: 'id',
        success: function(response) {

            // console.log(response);
            $("#edit_fname").val(response.fname);
            $("#edit_lname").val(response.lname);
            $("#edit_username").val(response.username);
            $("#edit_email").val(response.email);
            $("#edit_phone").val(response.phone);
            $("#edit_gender").val(response.gender).change();
            $("#edit_chapter_role").val(response.chapter_role).change();
            $("#edit_chapter").val(response.chapter_id).change();
            $("#edit_user_role").val(response.user_role).change();
            $("#edit_about_user").val(response.about_admin);
            $("#edit_chapter_id").val(response.chapter_id).change();
            // $("#chapter_role").val(response.chapter_role);
            // $("#chapter_role").val(response.chapter_role);
            $("#edit_user_id").val(response.id);

            
            $("#add_user_div").hide();
            $("#edit_user_div").show();


            },
            error: function(data) {
                // console.log(data);
            }
        });
        
});


  // Match Passwords
  $("body").on("keyup", "#cpassword", function(e) {
    e.preventDefault();

    var cpassword = $(this).val();
    var password = $("#password").val();

    console.log(cpassword);
    if (password === cpassword) {

        $("#validate_form").html('<div class="text-success"> <i>Passwords mathced!</i></div>');
        console.log('Matched');
    } else {
        $("#validate_form").html('<div class="text-danger"> <i>Passwords do not match!</i></div>');
        console.log('upsss!');
    }
   
});



  // Reset User Password
  $("body").on("click", ".reset_user_password_btn", function(e) {
    e.preventDefault();

    var id = $(this).attr('id');

    // console.log(id);

    // $("#get_sort_by_name").val(id);

    $.ajax({
        url: "reset_user_password/"+id,
        method: 'GET',
        dataType: 'json',
        // data: 'id',
        success: function(response) {

            console.log(response);
            if (response) {
                toast(response.alert_type, response.message, response.title, response.positionClass, 5000);
  
            }
            
            },
            error: function(data) {
                // console.log(data);
            }
        });
        
});



    // // Edit Customer
    // $("body").on("click", ".edit_customer", function(e) {
    //     e.preventDefault();

        // var id = $(this).attr('id');

        // // console.log(id);

        // // $("#get_sort_by_name").val(id);

        // $.ajax({
        //     url: "edit_customer/"+id,
        //     method: 'GET',
        //     dataType: 'json',
        //     // data: 'id',
        //     success: function(response) {
    
        //         // console.log(response);
        //         $("#edit_name").val(response.name);
        //         $("#edit_contact_number").val(response.contact_number);
        //         $("#edit_contact_email").val(response.contact_email);
        //         $("#edit_address").val(response.address);
        //         $("#edit_department").val(response.department_id).change();
        //         $("#edit_doctor_address").val(response.doctor_address);
        //         // $("#edit_id").val(response.department_id);
        //         // $("#edit_id").val(response.id);
        //         // $("#edit_id").val(response.id);
        //         $("#edit_cus_id").val(response.id);

        //         $('#editCustomerform').modal('show');
    
        //         },
        //         error: function(data) {
        //             // console.log(data);
        //         }
        //     });

    // });

    
    // // View Customer Detail Information
    // $("body").on("click", ".view_detail_customer", function(e) {
    //     e.preventDefault();

    //     var id = $(this).attr('id');

    //     // console.log(id);

    //     // $("#get_sort_by_name").val(id);

    //     $.ajax({
    //         url: "edit_customer/"+id,
    //         method: 'GET',
    //         dataType: 'json',
    //         // data: 'id',
    //         success: function(response) {
    
    //             // console.log(response);
    //             $("#view_name").text(response.name);
    //             $("#view_contact_number").text(response.contact_number);
    //             $("#view_contact_email").text(response.contact_email);
    //             $("#view_address").text(response.address);
    //             $("#view_department").text(response.dep_name);
    //             $("#view_doctor_address").text(response.doctor_address);
    //             $("#view_doctor").text(response.doctor_name);
    //             $("#view_created_at").text(chaangeDateFormat(response.created_at));
    //             $("#view_updated_at").html(chaangeDateFormat(response.updated_at));
    //             $("#view_cus_id").text(response.id);

    //             $('#viewCustomerDetailsModal').modal('show');
    
    //             },
    //             error: function(data) {
    //                 // console.log(data);
    //             }
    //         });

    // });


    // Change Customer Status
    $("body").on("change", ".change_user_status", function(e) {
        e.preventDefault();

        // var id = $(this).attr('id');
        var id = $(this).data('user_id');
        
        var send_val = 0;
        // console.log(id);
        $.ajax({
            url: "edit_user/"+id,
            method: 'GET',
            dataType: 'json',
            // data: 'id',
            success: function(response) {
    
                if (response.status == 0) {
                    send_val = 1;
                } else if (response.status == 1) {
                    send_val = 0;
                }

                console.log('Old Status: '+response.status);

                $.ajax({
                    url: "change_status",
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        send_val: send_val,
                        id: id,
                        '_token': '{{ csrf_field() }}'
                    },
                    success: function(datas) {
            
                        console.log('New Status: '+datas.status);
            
                        }
                    });
    
                },
            });

    });

    // Temporary Delete Admin User
    $("body").on("click", ".delete_user_password_btn", function(e) {
        e.preventDefault();

        var id = $(this).attr('id');
        var url = "list";

        $.ajax({
            url: "edit_user/"+id,
            method: 'GET',
            dataType: 'json',
            // data: 'id',
            success: function(response) {
    
                Swal.fire({
                    title: 'Delete User?',
                    text: 'The user "'+response.fname +' '+ response.lname+'" will be moved into the users recycle bin!',
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
                            url: "delete_user/"+id,
                            method: 'GET',
                            dataType: 'json',
                            success: function(response) {
                               
                                // location.href = url;
                                if (response.alert_type == 'success') {
                                    
                                    Swal.fire({
                                        title: 'Deleted!',
                                        text: 'User has been moved into the recycle bin.',
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
                                        'User Account is still safe',
                                        'success'
                                    )
                                }
        
                            }
                        });
        
                    } else {
                        Swal.fire(
                            'User Account is still safe',
                            'success'
                        )
                    }
                });
    
                },
                
            });

    });


    // Permanently Delete Admin User
    $("body").on("click", ".perm_delete_user_btn", function(e) {
        e.preventDefault();

        var id = $(this).attr('id');
        var url = "recycle";

        $.ajax({
            url: "edit_user/"+id,
            method: 'GET',
            dataType: 'json',
            // data: 'id',
            success: function(response) {
    
                Swal.fire({
                    title: 'Delete User Foerever?',
                    text: 'The user "'+response.fname +' '+ response.lname+'" will be permanently removed from the database.',
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
                            url: "pem_delete_user/"+id,
                            method: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                
                                // location.href = url;
                                if (response.alert_type == 'success') {
                                    
                                    Swal.fire({
                                        title: 'Deleted!',
                                        text: 'User has been removed from database.',
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
                                        'User Account is still safe',
                                        'success'
                                    )
                                }
        
                            }
                        });
        
                    } else {
                        Swal.fire(
                            'User Account is still safe',
                            'success'
                        )
                    }
                });
    
                },
                
            });

    });



    // Edit Depatment
    $("body").on("click", ".view_user_btn", function(e) {
        e.preventDefault();

        var id = $(this).attr('id');

   
        $.ajax({
            url: "edit_user/"+id,
            method: 'GET',
            dataType: 'json',
            // data: 'id',
            success: function(response) {
    
                $('#myadminuserdetail').modal('show');
    
                // console.log(response);

                var email_verified = '';
                var user_statuses = '';

                if (response.verified == 1) {
                    email_verified = 'Verified';
                } else {
                    email_verified = 'Not Verified';
                }

                if (response.status == 1) {
                    user_statuses = 'Active';
                } else {
                    user_statuses = 'Inactive';
                }

                $("#text_id").html(response.id);
                $("#text_name").html(response.fname + ' ' + response.lname);
                $("#a_img_src").html('<a class="image-popup-no-margins" href="./../../public/uploads/user_img/' + response.img_name + '">');
                $("#img_tag_name").html('<img class="img-fluid" alt="img-3" src="./../../public/uploads/user_img/' + response.img_name + '" width="150" height="100">');
                $("#text_username").html(response.username);
                $("#text_email").html(response.email);
                $("#text_email2").html(response.email);
                $("#text_user_code").html(response.user_code);
                $("#text_phone").html(response.phone);
                $("#text_phone2").html(response.phone);
                $("#text_user_role").html(response.user_role);
                $("#text_gender").html(response.gender);
                $("#text_chapter").html(response.chapter_name);
                $("#text_about_user").html(response.about_admin);
                $("#text_verified").html(email_verified);
                $("#text_user_state").html(user_statuses);
                $("#text_date_created").html(chaangeDateTimeFormat(response.created_at));
                $("#text_date_updated").html(chaangeDateTimeFormat(response.updated_at));

                },
                error: function(data) {
                    console.log(data);
                }
            });

    });
    


    // // Change Depatment Status
    // $("body").on("change", ".change_dep_status", function(e) {
    //     e.preventDefault();

    //     var id = $(this).attr('id');
    //     // var status_val = $(this).val();
    //     var send_val = 0;

    //     console.log(id);
    //     // console.log(status_val);

    //     $.ajax({
    //         url: "edit_department/"+id,
    //         method: 'GET',
    //         dataType: 'json',
    //         // data: 'id',
    //         success: function(response) {
    
    //             if (response.status == 0) {
    //                 send_val = 1;
    //             } else if (response.status == 1) {
    //                 send_val = 0;
    //             }

    //             console.log('Old Status: '+response.status);

    //             $.ajax({
    //                 url: "change_status",
    //                 method: 'GET',
    //                 dataType: 'json',
    //                 data: {
    //                     send_val: send_val,
    //                     id: id,
    //                     '_token': '{{ csrf_field() }}'
    //                 },
    //                 success: function(datas) {
            
    //                     // if (response.status == 0) {
    //                     //     send_val = 1;
    //                     // } else if (response.status == 1) {
    //                     //     send_val = 0;
    //                     // }
        
    //                     // console.log('New Status: '+datas.status);
            
    //                     }
    //                 });
    
    //             },
    //             error: function(data) {
    //                 console.log(data);
    //             }
    //         });

    // });


    // // Delete Depatment
    // $("body").on("click", ".del_department", function(e) {
    //     e.preventDefault();

    //     var id = $(this).attr('id');

    //     // console.log(id);

    //     // $("#get_sort_by_name").val(id);

    //     $.ajax({
    //         url: "edit_department/"+id,
    //         method: 'GET',
    //         dataType: 'json',
    //         // data: 'id',
    //         success: function(response) {
    
    //             // console.log(response);
    //             $("#del_name").text('Are you sure you want to delete "'+response.name+'" department?');
    //             $("#del_btn").html('<a href="delete_department/'+response.id+'" class="btn btn-soft-danger">Delete</a>');

    //             $('#delete_department_modal').modal('show');
    
    //             },
    //             error: function(data) {
    //                 console.log(data);
    //             }
    //         });

    // });
        
    


    ///////////////////////////////////////////////////////////////////////////////////////////////////////

    ///////////////////////////////////////////////////////////////////////////////////////////////////////


    // Temp Delete Admin User
    $("body").on("click", ".restore_user_btn", function(e) {
        e.preventDefault();

        var id = $(this).attr('id');
        var url = "recycle";

        $.ajax({
            url: "edit_user/"+id,
            method: 'GET',
            dataType: 'json',
            // data: 'id',
            success: function(response) {
    
                Swal.fire({
                    title: 'Restore User?',
                    text: 'The user "'+response.fname +' '+ response.lname+'" will be restored!',
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
                            url: "restore_user/"+id,
                            method: 'GET',
                            dataType: 'json',
                            success: function(response) {
                               
                                // location.href = url;
                                if (response.alert_type == 'success') {
                                    
                                    Swal.fire({
                                        title: 'Restored!',
                                        text: 'User has been restored.',
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
                                        'User not restored',
                                        'success'
                                    )
                                }
        
                            }
                        });
        
                    } else {
                        Swal.fire(
                            'User not restored',
                            'success'
                        )
                    }
                });
    
                },
                
            });

    });




    ///////////////////////////////////////////////////////////////////////////////////////////////////////

    ///////////////////////////////////////////////////////////////////////////////////////////////////////


    // Edit Admin User Image
    $("body").on("click", ".edit_image", function(e) {
        e.preventDefault();

        var id = $(this).attr('id');
        var url = "list";

        $.ajax({
            url: "edit_user/"+id,
            method: 'GET',
            dataType: 'json',
            // data: 'id',
            success: function(response) {
    
                var f_name = response.fname != null ? response.fname+" " : "";
                var l_name =   response.lname != null ? response.lname : "" ;
                var fullName = f_name + l_name
            //   console.log(response);
              $('#user_name_resp').text('Update the user image for ' + fullName);
              $('#edit_photo_id').val(response.id)
              $('#editImageFormModal').modal('show');

            //   loadDropZone();
            },
                
        });

    });



    // function loadDropZone() {

    //     var myFileUploadDropZone = new Dropzone(".dropzone", {
    //      url: "your-upload-file",
    //      maxFiles: 15,
    //      maxFilesize: 5,
    //      acceptedFiles: ".png, .jpg, .gif, .pdf, .doc",
    //      addRemoveLinks: true,
    //      dictDefaultMessage: "Drop your files here or click to upload",
    //      dictFallbackMessage: "Your browser does not support drag & drop feature.",
    //      dictInvalidFileType: "Your uploaded file type is not supported.",
    //      dictFileTooBig: "File is too big ({{filesize}} MB). Max filesize: {{maxFilesize}} MB.",
    //      dictResponseError: "Server responded with {{statusCode}} code.",
    //      dictCancelUpload: "Cancel Upload",
    //      dictRemoveFile: "Remove",
    //      init: function() {
    //         this.on("complete", function(file) {
    //            this.removeFile(file);
    //         });
    //      }
    //   });

    // }




    function getOnlineUsers() {
        var url = "list";
        // $('#myTDOnline').load(document.URL +  ' #myTDOnline');

        // $("#myTimer").load(location.url+" #myTimer>*","");
        // $("#myTimer").load(location.href+" #myTimer>*");
        // $("#myTimer").load('#myTimer');

        // $("#myTDOnline").load(document.URL +  " #myTDOnline");
        // $("#myTDOfflin").load(document.URL +  " #myTDOffline");
        $("#myTDbody").load(document.URL +  " #myTDbody>*");
        // $('#myTbody').load(document.URL +  ' #myTbody');

        // $(".datatable_button").DataTable({
        //     order: [0, 'desc'],
        //     dom: 'Bfrtip',
        //     buttons: [
        //         'columnsToggle'
        //     ],
        //     buttons: [
        //         'copy', 'csv', 'excel', 'pdf', 'print',
        //     ],
        // });
    }


      
    function toast(type, msg, title, positionClass, timeOut) {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": positionClass,
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": timeOut,
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    toastr[type](msg, title, toastr.options);


    }



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


    //Run updates every 10 seconds
    var k = setInterval(checkUserOnline, 12000);

    function checkUserOnline() {
        //Do whatever updating you need

        getOnlineUsers();
        // fetchReloadOnline();

    }

    
// If you want to stop the automatic updates here, you can use the command
// clearInterval(k)
});