
$(document).ready(function () {


    // Add Attendance
    $("body").on("click", ".add_attendance_btn", function (e) {
        e.preventDefault();

        var my_btn = $(this).text();

        if (my_btn == 'Add Attendance') {
            $("#add_attendance_div").show();
            $("#add_attendance_btn").text('Hide Add Attendance');
        } else {
            $("#add_attendance_div").hide();
            $("#add_attendance_btn").text('Add Attendance');
        }

    });



    //////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////
    // Event Name And Date Selected User Ajax

    $("body").on("change", ".event_title_id", function (e) {

        //    var event_name = $("#event_title_id").find(":selected").val();

        var id = $(this).val();
        var event_name = $("#event_title_id").find(":selected").text();

        console.log(id);
        // $(this).text("Loading ...");

        $.ajax({
            url: 'fetch_event_date_cal',
            method: 'GET',
            dataType: 'json',
            async: false,
            data: {
                'id': id,
            },
            success: function (response) {
                // trimText = $.trim(response);


                var dataVal = response.data;

                var htmlHead = '<select class="form-select" name="event_date" id="event_date" required>' +
                    '<option selected disabled value="">Choose Event Date...</option>';
                var htmlFoot = '</select>';

                var dragItems = [];

                dataVal.forEach(element => {
                    dragItems.push('<option value="' + element.start + '">' + changeDateTimeFormat(element.start) + '</option>');
                });

                // console.log(response);
                $("#showEventTitleAttendance").html(htmlHead + dragItems + htmlFoot);

                $(".eventDateTitle").text('Event Dates For: ' + event_name);

            }
        })
    });



    // Add Attendance Details For An eVENT Ajax Request
    $("#add_attendance_row_btn").click(function (e) {
        e.preventDefault();

        $("#add_attendance_row_btn").val("Saving Attendance To Event. Please Wait ...");

        var event_name = $("#event_title_id").find(":selected").text();
        var event_name_id = $("#event_title_id").find(":selected").val();
        var event_date = $("#event_date").find(":selected").val();
        // action = 'add_attendance_to_event_row';

        $.ajax({
            url: 'add_event_date_cal',
            method: 'GET',
            dataType: 'json',
            async: false,
            data: {
                event_name: event_name,
                event_date: event_date,
                event_name_id: event_name_id
            },
            success: function (response) {

                if (response.success == 'success') {

                    $("#add_attendance_row_btn").val("Add New Attendance");
                    // $("#add_attendance_form")[0].reset();
                    toast('success', 'New Attendance is successfully created.', 'New Attendance', 'toast-top-center', 5000);


                    fetchAttendanceTable();

                    $("#add_attendance_div").hide();
                    $("#add_attendance_btn").text('Add Attendance');

                } else if (response.success == 'exists') {

                    $("#add_attendance_row_btn").val("Add New Attendance");
                    // $("#add_attendance_form")[0].reset();
                    toast('warning', 'Record already exists', 'New Attendance', 'toast-top-center', 5000);

                    $("#add_attendance_div").hide();
                    $("#add_attendance_btn").text('Add Attendance');

                }

            }
        });

    });


    // Update  Attendance Details For An eVENT Ajax Request
    $("body").on("click", ".save_attendance_btn", function (e) {
        e.preventDefault();

        // var index = 5;

        data_hide = $(".data_show").data("data_hide");


        int_att_id = $(this).attr("id");
        int_males = $(".int_males" + int_att_id).val();
        int_females = $(".int_females" + int_att_id).val();
        int_children = $(".int_children" + int_att_id).val();
        int_ft = $(".int_ft" + int_att_id).val();
        action = 'save_attendance_values';


        $(this).text("Saving ...");

        $.ajax({
            url: 'include/settings/calendar_proc.php',
            method: 'POST',
            data: {
                action: action,
                int_att_id: int_att_id,
                int_males: int_males,
                int_females: int_females,
                int_children: int_children,
                int_ft: int_ft
            },
            success: function (response) {

                displayAttendanceTable();
                // claendar_display();

                trimText = $.trim(response);

                // console.log(data_hide);

                $("#showDataMale" + int_att_id).hide();
                $("#showDataFemale" + int_att_id).hide();
                $("#showDataChildren" + int_att_id).hide();
                $("#showDataFT" + int_att_id).hide();


                $("#hideDataMale" + int_att_id).show();
                $("#hideDataFemale" + int_att_id).show();
                $("#hideDataChildren" + int_att_id).show();
                $("#hideDataFT" + int_att_id).show();


                $("#showDataEditBtn" + int_att_id).hide();
                $("#showDataSaveBtn" + int_att_id).show();


                if (trimText == 'success') {
                    // $.Toast(title, message, type, options);

                    // $.Toast("Toast title", "Toast message here");

                    displayAttendanceTable();
                    toast('success', 'Attendance Successfully Saved', 'Success', 5000);


                } else if (trimText == 'error') {
                    // $.Toast(title, message, type, options);
                    toast('error', 'Attendance Not Saved', 'Denied', 5000);

                }


            }
        });


    });


    // Update  Attendance Details For An eVENT Ajax Request
    $("body").on("click", ".edit_attendance_btn", function (e) {
        e.preventDefault();

        var data_hide = $(this).data("data_hide");

        var int_att_id = $(this).attr("id");

        if (data_hide == false) {
            $(".myTblRowEdit" + int_att_id).hide();
            $(".myTblRowShow" + int_att_id).show();
            $(".edit_att_btn" + int_att_id).hide();
            $(".update_att_btn" + int_att_id).show();
        } else if (data_hide == true) {
            $(".myTblRowEdit" + int_att_id).show();
            $(".myTblRowShow" + int_att_id).hide();
            $(".edit_att_btn" + int_att_id).show();
            $(".update_att_btn" + int_att_id).hide();
        }

    });


    // Update  Attendance Save eVENT Ajax Request
    $("body").on("click", ".update_attendance_btn", function (e) {
        e.preventDefault();

        var data_hide = $(this).data("data_hide");

        var int_att_id = $(this).attr("id");

        var males_val = $(".males_val" + int_att_id).val();
        var females_val = $(".females_val" + int_att_id).val();
        var children_val = $(".children_val" + int_att_id).val();
        var first_timers_val = $(".first_timers_val" + int_att_id).val();


        if (data_hide == false) {
            $(".myTblRowEdit" + int_att_id).hide();
            $(".edit_att_btn" + int_att_id).hide();

            $(".myTblRowShow" + int_att_id).show();
            $(".update_att_btn" + int_att_id).show();
        } else if (data_hide == true) {
            $(".myTblRowEdit" + int_att_id).show();
            $(".edit_att_btn" + int_att_id).show();

            $(".myTblRowShow" + int_att_id).hide();
            $(".update_att_btn" + int_att_id).hide();
        }
        $.ajax({
            url: 'update_single_attendance_data',
            method: 'GET',
            dataType: 'json',
            async: false,
            data: {
                'id': int_att_id,
                'males': males_val,
                'females': females_val,
                'children': children_val,
                'first_timers': first_timers_val,
            },
            success: function (response) {
                if (response.success == 'success') {

                    toast('success', 'Church Attendance record is successfully saved.', 'Church Attendance', 'toast-top-center', 5000);

                    fetchAttendanceTable();

                }
            },
            error: function (response) {
                console.log(response);
            }
        });

    });


    fetchAttendanceTable();

    function fetchAttendanceTable() {
        $.ajax({
            url: 'fetch_curhch_attendance',
            method: 'GET',
            dataType: 'json',
            async: false,
            // data: {
            //     'id': v.id,
            //     'title': v.title,
            //     'start': v.start ? changeDateTimeDB(v.start) : null,
            //     'end': v.end ? changeDateTimeDB(v.end) : null,
            //     'allDay': v.allDay,
            //     'color': n,
            //     'descript': v.description ? v.description : "",
            // },
            success: function (response) {

                var dataVal = response.data;

                var dragItems = [];

                var html_head = '<table id="datatable_attendance" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">' +
                    '<thead>' +
                    '<tr>' +
                    '<th>#</th>' +
                    '<th>Event Title</th>' +
                    '<th>Date</th>' +
                    '<th>Males</th>' +
                    '<th>Females</th>' +
                    '<th>Children</th>' +
                    '<th>First Timers</th>' +
                    '<th>Total</th>' +
                    '<th>Action</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>';


                // for(let i = 0; i < dataVal.length; i++) {

                //     console.log(dataVal[i]);

                //     dragItems.push('<tr>' +
                //         '<td>' + dataVal[i].event_title + '</td>' +
                //         '<td>' + changeDateTimeFormat(dataVal[i].event_datetime) + '</td>' +
                //         '<td>' + dataVal[i].males + '</td>' +
                //         '<td>' + dataVal[i].females + '</td>' +
                //         '<td>' + dataVal[i].children + '</td>' +
                //         '<td>' + dataVal[i].first_timers + '</td>' +
                //         '<td>' + dataVal[i].first_timers + '</td>' +
                //         '<td>' +
                //         '<a href="avascript:void(0)" id="' + dataVal[i].id + '" class="view_first_timer_btn mx-2" title="View First Timer"><i class="ri-eye-line" style="font-size: 20px;"></i></a>' +
                //         '<a href="avascript:void(0)" id="' + dataVal[i].id + '" class="edit_first_timer_btn mx-2" title="Edit First Timer"><i class="ri-edit-line text-success" style="font-size: 20px;"></i></a>' +
                //         '<a href="avascript:void(0)" id="' + dataVal[i].id + '" class="delete_first_timer_btn mx-2" title="Delete First Timer"><i class="ri-delete-bin-6-line text-danger" style="font-size: 20px;"></i></a>' +
                //         '</td>' +
                //         '</tr>');
                // }

                dataVal.forEach(element => {

                    // console.log(element.bg_color);

                    dragItems.push('<tr>' +
                        '<td>' + element.id + '</td>' +
                        '<td>' + element.event_title + '</td>' +
                        '<td>' + changeDateTimeFormat(element.event_datetime) + '</td>' +
                        '<td ><div id="' + element.id + '" class="myTblRowEdit' + element.id + '">' + element.males + '</div> <input id="' + element.id + '" style="display: none;"  class="form-control myTblRowShow' + element.id + ' males_val' + element.id + '" name="males"  type="number" min="0" step="1" value="' + element.males + '"/></td>' +
                        // '<td style="display: none; width: 50px" id="' + element.id + '" class="myTblRowEdits' + element.id + '"><input id="" class="form-control" name="lname" type="text" value="' + element.males + '"/></td>' +
                        '<td ><div id="' + element.id + '" class="myTblRowEdit' + element.id + '">' + element.females + '</div> <input id="' + element.id + '" style="display: none;"  class="form-control myTblRowShow' + element.id + ' females_val' + element.id + '" name="males"  type="number" min="0" step="1" value="' + element.females + '"/></td>' +

                        '<td ><div id="' + element.id + '" class="myTblRowEdit' + element.id + '">' + element.children + '</div> <input id="' + element.id + '" style="display: none;"  class="form-control myTblRowShow' + element.id + ' children_val' + element.id + '" name="males"  type="number" min="0" step="1" value="' + element.children + '"/></td>' +
                        '<td ><div id="' + element.id + '" class="myTblRowEdit' + element.id + '">' + element.first_timers + '</div> <input id="' + element.id + '" style="display: none;"  class="form-control myTblRowShow' + element.id + ' first_timers_val' + element.id + '" name="males"  type="number" min="0" step="1" value="' + element.first_timers + '"/></td>' +
                        '<td>' + sumOfNum(element.males, element.females, element.children, element.first_timers) + '</td>' +
                        '<td>' +

                        '<a href="avascript:void(0)" id="' + element.id + '" class="edit_attendance_btn mx-2 edit_att_btn' + element.id + '" data-data_hide="false" title="Edit First Timer"><i class="ri-edit-line text-success" style="font-size: 20px;"></i></a>' +
                        '<a href="avascript:void(0)" id="' + element.id + '" style="display: none; font-size: 20px;" data-data_hide="true" class="update_attendance_btn mx-2 update_att_btn' + element.id + '" title="Update Attendance"><i class="ri-save-line text-primary"></i></a>' +

                        '</td>' +
                        '</tr>');

                });


                var html_foot = '</tbody></table>';

                // console.log(dragItems);

                $("#myTableRowList").html(html_head + dragItems + html_foot);

                $("#datatable_attendance").DataTable({
                    order: [0, 'desc'],
                    dom: 'Bfrtip',
                    buttons: [
                        'columnsToggle'
                    ],
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print',
                    ],
                });


            },
            error: function (response) {
                console.log(response);
            }
        });
    }




    //Toasters
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



    function diffOfNum(num1, num2) {

        fig1 = parseInt(num1);
        fig2 = parseInt(num2);

        total = 0;

        if (fig2 > fig1) {
            total = Math.abs(fig2 - fig1);
        } else {
            total = -(Math.abs(fig2 - fig1));
        }

        return total;
    }

    function sumOfNum(num1, num2, num3, num4) {

        fig1 = parseInt(num1);
        fig2 = parseInt(num2);
        fig3 = parseInt(num3);
        fig4 = parseInt(num4);

        total = 0;

        total = Math.abs(fig1 + fig2 + fig3 + fig4);

        return total;
    }

    function aveOfNum(num1, num2, num3, num4) {

        fig1 = parseInt(num1);
        fig2 = parseInt(num2);
        fig3 = parseInt(num3);
        fig4 = parseInt(num4);

        total = 0;

        total = Math.abs((fig1 + fig2 + fig3 + fig4) / 4);

        return total;
    }


    function roundingFigures(figures) {

        onlyNum = figures;
        fig = onlyNum.toString();

        displaying = '';

        if (fig.length > 3) {

            num = fig.substring(0, fig.length - 2);

            bforePoint = num[0];
            afterPoint = num[1];

            if (bforePoint === '') {
                bforePoint = '0';
            } else if (bforePoint == '-') {
                bforePoint = '-0';
            } else {
                bforePoint = num[0];
            }

            if (afterPoint === '') {
                afterPoint = '00';
            } else {
                afterPoint = num[1];
            }

            displaying = bforePoint + '.' + afterPoint + 'K';

            // var displa = num.toFixed(1);

            // console.log(bforePoint);

        } else {
            displaying = onlyNum.toFixed(2);
        }

        return displaying;
    }

    // Convert To Readable Dates

    function changeDateFormat(datess) {
        const date = new Date(datess);
        formartedDate = date.toLocaleString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })
        return formartedDate;
    }

    // Convert To Readable Month And Year
    function makeMonthYear(datetimes) {
        // var d = new Date(Date.parse(datetimes.replace(/-/g, "/")));

        var d = new Date(datetimes);
        var month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'];
        var date = month[d.getMonth()] + ", " + d.getFullYear();
        var time = d.toLocaleTimeString().toUpperCase().replace(/([\d]+:[\d]+):[\d]+(\s\w+)/g, "$1$2");
        return (date);
    }

    // Convert To Readable Date And Time
    function changeDateTimeFormat(datetimes) {
        // var d = new Date(Date.parse(datetimes.replace(/-/g, "/")));

        var d = new Date(datetimes);
        var month = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        var date = d.getDate() + " " + month[d.getMonth()] + ", " + d.getFullYear();
        var time = d.toLocaleTimeString().toUpperCase().replace(/([\d]+:[\d]+):[\d]+(\s\w+)/g, "$1$2");
        return (date + " " + time);
    }



});