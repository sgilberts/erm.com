// import DataTable from 'datatables.net-dt';
// import 'datatables.net-responsive-dt';
 

$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });


  // Add Members
  $("body").on("click", ".add_members_btn", function(e) {
    e.preventDefault();

    var my_btn = $(this).text();

    // console.log('4');

    if (my_btn == 'Add Member') {
        $("#add_members_div").show();
        $("#edit_members_div").hide();
        $("#add_members_btn").text('Hide Add Member');
    } else {
        $("#add_members_div").hide();
        $("#edit_members_div").hide();
        $("#add_members_btn").text('Add Member');
    }

});


//   // Edit User
  $("body").on("click", ".edit_members_btn", function(e) {
    e.preventDefault();

    var id = $(this).attr('id');

    // console.log(id);

    $.ajax({
        url: "edit_member/"+id,
        method: 'GET',
        dataType: 'json',
        // data: 'id',
        success: function(response) {

            // console.log(response);
            
            $("#edit_member_id").val(response.id);
            $("#edit_fname").val(response.first_name);
            $("#edit_lname").val(response.last_name);
            $("#edit_other_names").val(response.other_names);
            $("#edit_email").val(response.email);
            $("#edit_phone").val(response.contact);
            $("#edit_gps").val(response.gps);
            $("#edit_gender").val(response.gender);
            $("#edit_chapter").val(response.chapter_id).change();
            $("#edit_location").val(response.location);
            $("#edit_bdate").val(response.bdate);
            $("#edit_accept_jesus").val(response.accept_jesus);
            $("#edit_baptized").val(response.baptized);
            $("#edit_bap_date").val(response.bap_date);
            $("#edit_holy_spirit").val(response.holy_spirit);
            $("#edit_region_name").val(response.state_county_id).change();
            $(".nationality_select").val(response.nationality_id).change();
            $("#edit_branch_name").val(response.branch_id).change();
            $("#edit_chapter_id").val(response.chapter_id).change();

            $("#add_members_div").hide();
            $("#edit_members_div").show();


            },
            error: function(data) {
                // console.log(data);
            }
        });
        
    });




    // Change Country For States
    $("body").on("change", "#nationality_select", function(e) {
        e.preventDefault();

        var id = $(this).val();      

        var userURL = $(this).data('url');

        $.ajax({
            url: userURL,
            method: 'GET',
            dateType: 'json',
            data: {
                id: id,
                '_token': "{{ csrf_field() }}"
            },
            success: function(response) {

                $('#state_id').html(response.html);

            }
        });

    });


    // Change Edit Country For States
    $("body").on("change", "#edit_nationality_select", function(e) {
        e.preventDefault();

        var id = $(this).val();      

        var userURL = $(this).data('url');

        $.ajax({
            url: userURL,
            method: 'GET',
            dateType: 'json',
            data: {
                id: id,
                '_token': "{{ csrf_field() }}"
            },
            success: function(response) {

                $('#edit_state_id').html(response.html);

            }
        });

    });


    // Temporary Delete First Timer
    $("body").on("click", ".delete_members_btn", function(e) {
        e.preventDefault();

        var id = $(this).attr('id');
        var url = "list";

        $.ajax({
            url: "edit_member/"+id,
            method: 'GET',
            dataType: 'json',
            // data: 'id',
            success: function(response) {
    
                Swal.fire({
                    title: 'Delete Member?',
                    text: 'The member "'+response.first_name +' '+ response.last_name+'" will be moved into the members recycle bin!',
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
                            url: "delete_member/"+id,
                            method: 'GET',
                            dataType: 'json',
                            success: function(response) {
                               
                                // location.href = url;
                                if (response.alert_type == 'success') {
                                    
                                    Swal.fire({
                                        title: 'Deleted!',
                                        text: 'Member has been moved into the recycle bin.',
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
                                        'Member is still safe',
                                        'success'
                                    )
                                }
        
                            }
                        });
        
                    } else {
                        Swal.fire(
                            'Member is still safe',
                            'success'
                        )
                    }
                });
    
                },
                
            });

    });




    // Edit Member
    $("body").on("click", ".view_members_btn", function(e) {
        e.preventDefault();

        var id = $(this).attr('id');

   
        $.ajax({
            url: "edit_member/"+id,
            method: 'GET',
            dataType: 'json',
            // data: 'id',
            success: function(response) {
    
                var email_verified = '';
                var member_status = '';

                if (response.status == 1) {
                    member_status = 'Active';
                } else {
                    member_status = '<div class="text-danger">Inactive</div>';
                }
                if (response.verify == 1) {
                    email_verified = 'Email Verified';
                } else {
                    email_verified = 'E-mail not verified';
                }

                // console.log(response);

                $("#text_id").html(response.id);
                $("#text_mem_id").html(response.mem_id);
                $("#member_text_name").html(response.first_name + ' ' + response.other_names + ' ' + response.last_name);
                $("#a_member_img_src").html('<a class="image-popup-no-margins" href="./../../public/uploads/mem_img/' + response.mem_img_name + '">');
                $("#member_img_tag_name").html('<img class="img-fluid" alt="img-3" src="./../../public/uploads/mem_img/' + response.mem_img_name + '" width="150" height="100">');
                $("#text_nationality").html(response.country_name);
                $("#text_region_name").html(response.state_name);
                $("#member_text_email").html(response.email);
                $("#text_member_code").html(response.user_code);
                $("#member_text_phone").html(response.contact);
                $("#member_text_phone2").html(response.contact);
                $("#text_location").html(response.location);
                $("#text_gps").html(response.gps);
                $("#text_birth_date").html(chaangeDateFormat(response.bdate));
                $("#text_baptized").html(response.baptized);
                $("#text_date_bap").html(chaangeDateFormat(response.bap_date));
                $("#text_accept_jesus").html(response.accept_jesus);
                $("#text_holy_spirit").html(response.holy_spirit);
                $("#member_text_gender").html(response.gender);
                // $("#text_gender").html(response.gender);
                $("#member_text_chapter").html(response.chapter_name);
                $("#member_text_verified").html(email_verified);
                $("#text_member_state").html(member_status);
                $("#member_text_date_created").html(chaangeDateTimeFormat(response.created_at));
                $("#member_text_date_updated").html(chaangeDateTimeFormat(response.updated_at));

                
                $('#myadminMemberDetail').modal('show');
    

                },
                error: function(data) {
                    console.log(data);
                }
            });

    });
    


    
    // Edit Admin User Image
    $("body").on("click", ".edit_member_image", function(e) {
        e.preventDefault();

        var id = $(this).attr('id');
        // var url = "list";

        $.ajax({
            url: "edit_member/"+id,
            method: 'GET',
            dataType: 'json',
            // data: 'id',
            success: function(response) {
    
                var f_name = response.first_name != null ? response.first_name+" " : "";
                var o_name = response.other_names != null ? response.other_names+" " : "";
                var l_name =   response.other_names != null ? response.other_names : "" ;
                var fullName = f_name + o_name + l_name;

              console.log(response);
              $('#member_name_resp').text('Update the member image for ' + fullName);
              $('#edit_member_photo_id').val(response.id)
              $('#editMemberImageFormModal').modal('show');

            //   loadDropZone();
            },
                
        });

    });



    // Permanently Delete Admin User
    $("body").on("click", ".perm_delete_member_btn", function(e) {
        e.preventDefault();

        var id = $(this).attr('id');
        var my_url = "recycle";

        $.ajax({
            url: "edit_member/"+id,
            method: 'GET',
            dataType: 'json',
            // data: 'id',
            success: function(response) {
    
                Swal.fire({
                    title: 'Delete Member Foerever?',
                    text: 'The Member "'+response.first_name +' '+ response.last_name+'" will be permanently removed from the database.',
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
                            url: "pem_delete_member/"+id,
                            method: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                
                                // location.href = url;
                                if (response.alert_type == 'success') {
                                    
                                    Swal.fire({
                                        title: 'Deleted!',
                                        text: 'First Timer have been removed from database.',
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
                                        'First Timer is still safe',
                                        'success'
                                    )
                                }
        
                            }
                        });
        
                    } else {
                        Swal.fire(
                            'First Timer is still safe',
                            'success'
                        )
                    }
                });
    
                },
                
            });

    });



    // Change Member Status
    $("body").on("change", ".change_member_status", function(e) {
        e.preventDefault();

        // var id = $(this).attr('id');
        var id = $(this).data('member_id');
        
        var send_val = 0;
        console.log(id);
        $.ajax({
            url: "edit_member/"+id,
            method: 'GET',
            dataType: 'json',
            // data: 'id',
            success: function(response) {
    
                if (response.status == 0) {
                    send_val = 1;
                } else if (response.status == 1) {
                    send_val = 0;
                }

                // console.log('Old Status: '+response.status);

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
            
                        // console.log('New Status: '+datas.status);
            
                        }
                    });
    
                },
            });

    });



//     ///////////////////////////////////////////////////////////////////////////////////////////////////////

//     ///////////////////////////////////////////////////////////////////////////////////////////////////////


    //  Restore Member
    $("body").on("click", ".restore_members_btn", function(e) {
        e.preventDefault();

        var id = $(this).attr('id');
        var url = "recycle";

        $.ajax({
            url: "edit_member/"+id,
            method: 'GET',
            dataType: 'json',
            // data: 'id',
            success: function(response) {
    
                Swal.fire({
                    title: 'Restore First Timer?',
                    text: 'The first timer "'+response.first_name +' '+ response.last_name+'" will be restored!',
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
                            url: "restore_member/"+id,
                            method: 'GET',
                            dataType: 'json',
                            success: function(response) {
                               
                                // location.href = url;
                                if (response.alert_type == 'success') {
                                    
                                    Swal.fire({
                                        title: 'Restored!',
                                        text: 'First Timer has been restored.',
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
                                        'First Timer not restored',
                                        'success'
                                    )
                                }
        
                            }
                        });
        
                    } else {
                        Swal.fire(
                            'First Timer not restored',
                            'success'
                        )
                    }
                });
    
                },
                
            });

    });



   
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
    // $("#get_old_state_id").val(ids);

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

  
  
  // Reset Member Password
  $("body").on("click", ".reset_member_password_btn", function(e) {
    e.preventDefault();

    var id = $(this).attr('id');

    // console.log(id);

    // $("#get_sort_by_name").val(id);

    $.ajax({
        url: "reset_member_password/"+id,
        method: 'GET',
        dataType: 'json',
        // data: 'id',
        success: function(response) {

            // console.log(response);
                if (response) {
                    toast(response.alert_type, response.message, response.title, response.positionClass, 5000);
    
                }
            
            },
            error: function(data) {
                // console.log(data);
            }
        });
        
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
            msg = 'Are you sure you want to delete selected members?';
            msg2 = 'Selected member not deleted';
        } else if (what_to_do == 'restore_sel_form') {
            myTitle = 'Restore All';
            msg = 'Are you sure you want to restore selected members?';
            msg2 = 'Selected member not restored';
        } else if (what_to_do == 'perm_del_sel_form') {
            myTitle = 'Permanent Delete All';
            msg = 'Are you sure you want to delete selected members forever?';
            msg2 = 'Selected member not deleted forever';
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