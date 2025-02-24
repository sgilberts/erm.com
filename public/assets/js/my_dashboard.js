// import DataTable from 'datatables.net-dt';
// import 'datatables.net-responsive-dt';


$(document).ready(function () {

    // var dataDatatable = $('#alternative-page-datatable').DataTable({})

    // Pagination For Birthdates

    // $("body").on("click", ".page_item_birth", function(e) {
    //     e.preventDefault();

    //     page_limit = $("#page_limit").find(":selected").val();
    //     let page = $(this).attr("id");

    //     displayBirthDateForThisWeek('', page, page_limit);


    // });


    $("body").on("change", ".page_limit", function (e) {

        page_limit = $("#page_limit").find(":selected").val();

        displayBirthDateForThisWeek('', '', page_limit);
    });



    // Display Admin User Information 
    // checked, all_pages, page_limit
    displayBirthDateForThisWeek();

    function displayBirthDateForThisWeek(checked, all_pages, page_limit) {

        check_all = checked;
        pages = all_pages;
        limiting = page_limit;
        limit = '';


        if (check_all === '' || check_all == null) {
            checked_all = '0';

        } else {
            checked_all = check_all;

        }

        if (pages === '' || pages == null) {

            page = '1';
        } else {

            page = pages;
        }

        if (limiting === '' || limiting == null) {

            limit = '2';

        } else {
            limit = limiting;
        }

        action = 'birth_dates_for_this_week';
        start_date = '2023-01-01';
        groupings = 'month';

        $.ajax({
            url: 'admin/fetch_birthdates',
            method: 'GET',
            dataType: 'json',
            data: {
                action: action,
                start_date: start_date,
                //  checked_all: checked_all,
                page: page,
                limit: limit,
                groupings: groupings
            },
            success: function (response) {


                var header_field = '<table class="table table-centered mb-0 align-middle table-hover table-nowrap">' +
                    '<thead class="table-light">' +
                    '<tr>' +
                    '<th>Name</th>' +
                    '<th>Position</th>' +
                    '<th>Status</th>' +
                    '<th>Start date</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>';




                var footer_field = '</tbody></table>';

                $("#showBirthDatesWeek").html(header_field + response.data + footer_field);
                $("#myPagination").html(response.links);

                console.log(response.links);

            }
        });
    }

    //  $(document).on('click', '.pagination a', function(event){
    //     event.preventDefault(); 
    //     var page = $(this).attr('href').split('page=')[1];
    //     fetch_user_data(page);
    // });

    // function fetch_user_data(page)
    // {

    //     $.ajax({
    //         url: "admin/ajax?page="+page,
    //         method: 'GET',
    //         dataType: 'json',
    //         // data: {
    //         //     action: action,
    //         //     start_date: start_date,
    //         //    //  checked_all: checked_all,
    //         //     page: page,
    //         //     limit: limit,
    //         //     groupings: groupings
    //         // },
    //         success: function(response) {


    //             var header_field = '<table class="table table-centered mb-0 align-middle table-hover table-nowrap">'+
    //                                    '<thead class="table-light">'+
    //                                        '<tr>'+
    //                                            '<th>Name</th>'+
    //                                            '<th>Position</th>'+
    //                                            '<th>Status</th>'+
    //                                            '<th>Start date</th>'+
    //                                        '</tr>'+
    //                                    '</thead>'+
    //                                    '<tbody>';




    //                var footer_field = '</tbody></table>';

    //             // $("#showBirthDatesWeek").html(header_field+response.data+footer_field);
    //             // $("#myPagination").html(response.links);
    //             console.log(data);
    //         $('.birthday_table').html(header_field+response+footer_field);
    //             console.log(response.links);

    //         }
    //     });
    // }	 

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
                    success: function (response) {

                        // console.log(response);
                        if (response.alert_type == 'success') {

                            location.href = my_url;

                        }

                    },
                    error: function (data) {
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