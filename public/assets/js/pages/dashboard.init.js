
$(document).ready(function () {

    var globalVal = 0;
    var myYear = new Date().getFullYear();

    $("body").on("change", ".filterChartYear", function (e) {
        // e.preventDefault();
        var id = $(this).attr('id');
        var valueItem = $(this).val();

        var period_chart = $(".period_chart").find(":selected").val();

        $(".month_chart").val('').change();
        // var month_chart = $(".month_chart").find(":selected").val();

        // var period_chart = $(".period_chart").val();

        var send_year = '';

        if (period_chart == '') {
            Swal.fire(
                'Please select a period.',
                'Info'
            )
        } else {
            
            if (valueItem == null || valueItem == '') {
                send_year = myYear;
                // $(".month_chart").val('').change();
                // $(".period_chart").val('').change();
            } else {
                send_year = valueItem;
                globalVal = 1;
                // $(".month_chart").val('').change();
                // $(".period_chart").val('').change();
            }


            var send_period = period_chart;

            var monthly_chart = '';
                 
            $("#column_line_chart").html('');

            what_to_do(send_year, monthly_chart, send_period, id);

        }

    });


    $("body").on("change", ".month_chart", function (e) {
        e.preventDefault();
        var id = $(this).attr('id');
        var valueItem = $(this).val();

        var filterChartYear = $(".filterChartYear").val();


        var send_year = '';

            send_year = filterChartYear;
            // $(".period_chart").val('MONTH').change();

            // if (globalVal == 1) {
                globalVal = 1;
            // } else {
            //     globalVal = 1;
            // }

        var send_period = 'DAY';

        what_to_do(send_year, valueItem, send_period, id);

    });


    // $("body").on("change", ".period_chart", function (e) {
    //     e.preventDefault();
    //     var id = $(this).attr('id');
    //     var valueItem = $(this).val();

    //     var month_chart = $(".month_chart").val();
    //     var filterChartYear = $(".filterChartYear").val();

    //     // var id = $(this).data('user_id');
    //     if (globalVal == 1) {
    //         globalVal = 0;
    //     } else {
    //         globalVal = 1;
    //     }

    //     var send_year = '';

    //     if (filterChartYear == null) {
    //         send_year = 2024;
    //     } else {
    //         send_year = filterChartYear;
    //     }

    //     if (month_chart == '') {
    //         month_chart = '';
    //     } else {
    //         month_chart = month_chart;
    //     }

    //     what_to_do(send_year, month_chart, valueItem, id);

    // });




    function what_to_do(send_year, send_monthly, send_period, id) {

        if (globalVal == 1) {

            fetchAttendanceData(send_year, send_monthly, send_period, id);

        }

    }


    fetchAttendanceData(myYear, '', '' ,'');

    function fetchAttendanceData(send_year, send_monthly, send_period, id) {

        // console.log(send_year);
        // console.log(send_monthly);
        // console.log(send_period);
        // console.log(id);

        var maleValues = [];
        var femalesValues = [];
        var childrenValues = [];
        var ftValues = [];
        var datesValues = [];
        var avgValues = [];
        var totalValues = [];

        $.ajax({
            url: 'admin/fetch_church_attendance',
            method: 'GET',
            dataType: 'json',
            data: {
                id: id,
                send_monthly: send_monthly,
                send_period: send_period,
                send_year: send_year
            },
            success: function (response) {

                // console.log(response);

                var dataVal = response.data;

                for (let i = 0; i < dataVal.length; i++) {

                    maleValues.push(dataVal[i].males);
                    femalesValues.push(dataVal[i].females);
                    childrenValues.push(dataVal[i].children);
                    ftValues.push(dataVal[i].first_timers);

                    if (send_period == 'MONTH') {
                        
                        datesValues.push(makeMonthYear(dataVal[i].new_date));

                    } else if (send_period == 'WEEK'){
                        
                        datesValues.push('Week '+dataVal[i].new_week+' of '+makeMonthYear(dataVal[i].new_date));

                    } else if (send_period == 'DAY'){
                        
                        datesValues.push(changeDateFormat(dataVal[i].event_datetime));

                    } else {
                        
                        datesValues.push(changeDateFormat(dataVal[i].event_datetime));

                    }
                    // ids += dataVal[i].males+',';

                    avgValues.push(aveOfNum(dataVal[i].males, dataVal[i].females, dataVal[i].children, dataVal[i].first_timers));
                    totalValues.push(sumOfNum(dataVal[i].males, dataVal[i].females, dataVal[i].children, dataVal[i].first_timers));
                }

                // console.log(totalValues);
                // console.log(datesValues);

                options = {
                    series: [
                        {
                            name: "Males", type: "column",
                            data: maleValues
                        },
                        {
                            name: "Females", type: "column",
                            data: femalesValues
                        },
                        {
                            name: "Children", type: "column",
                            data: childrenValues
                        },
                        {
                            name: "First Timers", type: "column",
                            data: ftValues
                        },
                        {
                            name: "Average Attendance", type: "line",
                            data: avgValues
                        },
                        {
                            name: "Total Attendance", type: "line",
                            data: totalValues
                        }
                    ],
                    chart: {
                        height: 350,
                        type: "line",
                        stacked: false,
                        toolbar: { show: !1 }
                    },
                    stroke: {
                        width: [0, 2, 5],
                        curve: "smooth"
                    },

                    plotOptions: { bar: { horizontal: !1, columnWidth: "34%" } },
                    dataLabels: { enabled: !1 },
                    markers: {
                        size: [0, 3.5, 2, 3, 5],
                        colors: ["#6fd088"],
                        strokeWidth: 2,
                        strokeColors: "#6fd088",
                        hover: { size: 4 }
                    },

                    legend: { show: !1 },
                    yaxis: {
                        labels: { formatter: function (e) { return e } },
                        tickAmount: 5,
                        min: 0,
                        max: 50
                    },
                    yaxis: {
                        title: {
                            text: 'CHURCH ATTENDANCE',
                        },
                        min: 0
                    },
                    fill: {
                        opacity: [0.85, 0.25, 1],
                        gradient: {
                            inverseColors: false,
                            shade: 'light',
                            type: "vertical",
                            opacityFrom: 0.85,
                            opacityTo: 0.55,
                            stops: [0, 100, 100, 100]
                        }
                    },
                    tooltip: {
                        shared: true,
                        intersect: false,
                        y: {
                            formatter: function(y) {
                                if (typeof y !== "undefined") {
                                    return y.toFixed(0);
                                }
                                return y;

                            }
                        }
                    },
                    // legend: { show: !1 }, yaxis: { labels: { formatter: function (e) { return e + "k" } }, tickAmount: 5, min: 0, max: 50 },
                    colors: ["#0f9cf3", "#6fd088", "#aad045", "#ff9574", "#aae23d", "#4b0a24"],
                    labels: datesValues
                };
                var charts = new ApexCharts(document.querySelector("#column_line_chart"), options);
                // charts.clear();
                charts.render();
                // (chart = new ApexCharts(document.querySelector("#column_line_chart"), options)).render();

            },
            error: function (response) {
                console.log(response);
            }
        });


    }


    // console.log(ids);
    // For Area Chart
    fetchAttCurrentYr();

    function fetchAttCurrentYr() {

        var maleValues = [];
        var femalesValues = [];
        var childrenValues = [];
        var ftValues = [];
        var datesValues = [];
        // var avgValues = [];
        // var totalValues = [];

        $.ajax({
            url: 'fetch_church_att_yr',
            method: 'GET',
            dataType: 'json',
            success: function (response) {

                // console.log(response);

                var dataVal = response.data;

                for (let i = 0; i < dataVal.length; i++) {

                    maleValues.push(dataVal[i].males);
                    femalesValues.push(dataVal[i].females);
                    childrenValues.push(dataVal[i].children);
                    ftValues.push(dataVal[i].first_timers);
                    datesValues.push(changeDateFormat(dataVal[i].event_datetime));

                    // avgValues.push(aveOfNum(dataVal[i].males, dataVal[i].females, dataVal[i].children, dataVal[i].first_timers));
                    // totalValues.push(sumOfNum(dataVal[i].males, dataVal[i].females, dataVal[i].children, dataVal[i].first_timers));
                }

                // console.log(totalValues);
                // console.log(datesValues);

                var options = {
                    series: [
                        {
                            name: "Males",
                            data: maleValues
                        },
                        {
                            name: "Females",
                            data: femalesValues
                        },
                        {
                            name: "Children",
                            data: childrenValues
                        },
                        {
                            name: "First Timers",
                            data: ftValues
                        },
                    ],
                    chart: { 
                        toolbar: { show: !1 }, 
                        height: 350, type: "area" },
                    dataLabels: { enabled: !1 }, 
                    yaxis: {
                        labels: { formatter: function (e) { return e + "k" } },
                        tickAmount: 4, min: 0, 
                    },
                    stroke: { curve: "smooth", width: 2 },
                    grid: {
                        show: !0, borderColor: "#90A4AE", strokeDashArray: 0, position: "back",
                        xaxis: { lines: { show: !0 } }, yaxis: { lines: { show: !0 } },
                        row: { colors: void 0, opacity: .8 }, column: { colors: void 0, opacity: .8 },
                        padding: { top: 10, right: 0, bottom: 10, left: 10 }
                    },
                    legend: { show: !1 },
                    colors: ["#0f9cf3", "#6fd088", "#ff9574", "#4b0a24"],
                    labels: datesValues
                };
                
                var chart = new ApexCharts(document.querySelector("#area_chart"), options);
                chart.render();

                // (chart = new ApexCharts(document.querySelector("#column_line_chart"), options)).render();

            },
            error: function (response) {
                console.log(response);
            }
        });


    }





    fetchAttTotalAVG();

    function fetchAttTotalAVG() {

        var datesValues = [];
        var avgValues = [];
        var totalValues = [];

        $.ajax({
            url: 'fetch_church_att_yr',
            method: 'GET',
            dataType: 'json',
            success: function (response) {

                // console.log(response);

                var dataVal = response.data;

                for (let i = 0; i < dataVal.length; i++) {
                    datesValues.push(changeDateFormat(dataVal[i].event_datetime));

                    avgValues.push(aveOfNum(dataVal[i].males, dataVal[i].females, dataVal[i].children, dataVal[i].first_timers));
                    totalValues.push(sumOfNum(dataVal[i].males, dataVal[i].females, dataVal[i].children, dataVal[i].first_timers));
                }

            
                var options = {
                    series: [
                        {
                            name: "Males",
                            data: totalValues
                        },
                        {
                            name: "Females",
                            data: avgValues
                        },
                    ],
                    chart: { 
                        toolbar: { show: !1 }, 
                        height: 350, type: "area" },
                    dataLabels: { enabled: !1 }, 
                    yaxis: {
                        labels: { formatter: function (e) { return e + "k" } },
                        tickAmount: 4, min: 0, 
                    },
                    stroke: { curve: "smooth", width: 2 },
                    grid: {
                        show: !0, borderColor: "#90A4AE", strokeDashArray: 0, position: "back",
                        xaxis: { lines: { show: !0 } }, yaxis: { lines: { show: !0 } },
                        row: { colors: void 0, opacity: .8 }, column: { colors: void 0, opacity: .8 },
                        padding: { top: 10, right: 0, bottom: 10, left: 10 }
                    },
                    legend: { show: !1 },
                    colors: ["#ff9574", "#4b0a24"],
                    labels: datesValues
                };
                
                var chart = new ApexCharts(document.querySelector("#area_chart_total_avg"), options);
                chart.render();

                // (chart = new ApexCharts(document.querySelector("#column_line_chart"), options)).render();

            },
            error: function (response) {
                console.log(response);
            }
        });


    }


    
    fetchDashboardInfo();

    function fetchDashboardInfo() {


        $.ajax({
            url: 'get_dashboard_items',
            method: 'GET',
            dataType: 'json',
            async: false,
            data: {
                'year': myYear,
                'pre_year': (myYear-1),
                'month': '1'
            },
            success: function (response) {

                // console.log(response);

                var att_val_ft = [];
                var att_val_ft_now_yr = [];
                var att_val_ft_pre_yr = [];

                var tottal_users = response.tottal_users;
                var active_users = response.active_users;
                var de_active_users = response.de_active_users;
                var verified_users = response.verified_users;
                var un_verified_users = response.un_verified_users;
                var total_ft = response.total_ft;
                var total_members = response.total_members;
                var total_members_now = response.total_members_now;
                var total_members_pre = response.total_members_pre;
                var attendance_last_now = response.attendance_last;
                var attendance_last_pre = response.attendance_last;
                var attendance_record = response.attendance_record;
                var total_pre_yr_ft = response.total_pre_yr_ft;
                var att_now_yr_record = response.att_now_record;
                var att_pre_yr_record = response.att_pre_record;


                var last_att_total_now = [attendance_last_now[0].males, attendance_last_now[0].females, attendance_last_now[0].children, attendance_last_now[0].first_timers];
                var last_att_total_pre = [attendance_last_pre[1].males, attendance_last_pre[1].females, attendance_last_pre[1].children, attendance_last_pre[1].first_timers];

                console.log(sumOfArray(last_att_total_now, 2));
                console.log(last_att_total_now);
                console.log(sumOfArray(last_att_total_pre, 2));
                console.log(last_att_total_pre);

                attendance_record.forEach(element => {

                    att_val_ft.push(element.first_timers);
                    
                });

                att_now_yr_record.forEach(element => {

                    att_val_ft_now_yr.push(element.first_timers);
                    
                });

                att_pre_yr_record.forEach(element => {

                    att_val_ft_pre_yr.push(element.first_timers);
                    
                });

                console.log(sumOfArray(att_val_ft, 2));

                $("#total_admin_users").text(tottal_users);
                $("#total_activated_accounts").text(active_users);
                $("#total_de_activated_accounts").text(de_active_users);
                $("#verified_users").text(verified_users);
                $("#un_verified_users").text(un_verified_users);

                $("#total_members").text(total_members);
                $("#total_members_percentage").html('<span class="text-'+compareFigs(total_members_now, total_members_pre).color+' fw-bold font-size-12 me-2">'+compareFigs(total_members_now, total_members_pre).arrows+''+percentIncreaseOfArray([total_members_now, total_members_pre], 2)+'%</span>from previous year');

                $("#total_ft").text(total_ft);
                $("#total_ft_percentage").html('<span class="text-'+compareFigs(total_ft, total_pre_yr_ft).color+' fw-bold font-size-12 me-2">'+compareFigs(total_ft, total_pre_yr_ft).arrows+''+percentIncreaseOfArray([total_ft, total_pre_yr_ft], 2)+'%</span>from previous year');

                $("#total_attendance").text(sumOfArray(last_att_total_now, 2));
                $("#total_attendance_percentage").html('<span class="text-'+compareFigs(sumOfArray(last_att_total_now, 2), sumOfArray(last_att_total_pre, 2)).color+' fw-bold font-size-12 me-2">'+compareFigs(sumOfArray(last_att_total_now, 2), sumOfArray(last_att_total_pre, 2)).arrows+''+percentIncreaseOfArray([sumOfArray(last_att_total_now, 2), sumOfArray(last_att_total_pre, 2)], 2)+'%</span>from previous year');

                
                $("#total_att_ft").text(sumOfArray(att_val_ft, 2));
                $("#total_att_ft_percentage").html('<span class="text-'+compareFigs(sumOfArray(att_val_ft_now_yr, 2), sumOfArray(att_val_ft_pre_yr, 2)).color+' fw-bold font-size-12 me-2">'+compareFigs(sumOfArray(att_val_ft_now_yr, 2), sumOfArray(att_val_ft_pre_yr, 2)).arrows+''+percentIncreaseOfArray([sumOfArray(att_val_ft_now_yr, 2), sumOfArray(att_val_ft_pre_yr, 2)], 2)+'%</span>from previous year');

                

            },
            error: function (response) {
                console.log(response);
            }
        });


    }



    // var options = {
    //     series: [
    //         { name: "series1", data: [0, 180, 60, 220, 85, 190, 70] },
    //         { name: "series2", data: [0, 15, 250, 21, 365, 120, 30] }],
    //     chart: { toolbar: { show: !1 }, height: 350, type: "area" },
    //     dataLabels: { enabled: !1 }, yaxis: {
    //         labels: { formatter: function (e) { return e + "k" } },
    //         tickAmount: 4, min: 0, max: 400
    //     },
    //     stroke: { curve: "smooth", width: 2 },
    //     grid: {
    //         show: !0, borderColor: "#90A4AE", strokeDashArray: 0, position: "back",
    //         xaxis: { lines: { show: !0 } }, yaxis: { lines: { show: !0 } },
    //         row: { colors: void 0, opacity: .8 }, column: { colors: void 0, opacity: .8 },
    //         padding: { top: 10, right: 0, bottom: 10, left: 10 }
    //     },
    //     legend: { show: !1 },
    //     colors: ["#0f9cf3", "#6fd088", "#54d22a"],
    //     labels: ["2015", "2016", "2017", "2018", "2019", "2020", "2021"]
    // },
    //     chart = new ApexCharts(document.querySelector("#area_chart"), options);
    // chart.render();




    // For Column, Line Chart

    // options = {
    //     series: [
    //         {
    //             name: "Males", type: "column",
    //             data: maleValues
    //         },
    //         {
    //             name: "Females", type: "line",
    //             data: femalesValues
    //         },
    //         {
    //             name: "Children", type: "column",
    //             data: childrenValues
    //         },
    //         {
    //             name: "First Timers", type: "column",
    //             data: ftValues
    //         }
    //     ],
    //     chart: {
    //         height: 350,
    //         type: "line",
    //         toolbar: { show: !1 }
    //     },
    //     stroke: {
    //         width: [0, 2.3],
    //         curve: "straight"
    //     },

    //     plotOptions: { bar: { horizontal: !1, columnWidth: "34%" } },
    //     dataLabels: { enabled: !1 },
    //     markers: {
    //         size: [0, 3.5, 2],
    //         colors: ["#6fd088"],
    //         strokeWidth: 2,
    //         strokeColors: "#6fd088",
    //         hover: { size: 4 }
    //     },

    //     legend: { show: !1 }, yaxis: { labels: { formatter: function (e) { return e + "k" } }, tickAmount: 5, min: 0, max: 50 },
    //     colors: ["#0f9cf3", "#6fd088", "#aad045", "#ff9574"],
    //     labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
    // };

    // (chart = new ApexCharts(document.querySelector("#column_line_chart"), options)).render();





    // For Pie Chart

    options = {
        series: [42, 26, 15],
        chart: { height: 286, type: "donut" },
        labels: ["Market Place", "Last Week", "Last Month"],
        plotOptions: {
            pie: {
                donut: {
                    size: "73%", labels: {
                        show: !0, name: { show: !0, fontSize: "18px", offsetY: 5 },
                        value: { show: !1, fontSize: "20px", color: "#343a40", offsetY: 8 },
                        total: { show: !0, fontSize: "17px", label: "Ethereum", color: "#6c757d", fontWeight: 600 }
                    }
                }
            }
        },
        dataLabels: { enabled: !1 }, legend: { show: !1 }, colors: ["#0f9cf3", "#6fd088", "#ffbb44"]
    }; (chart = new ApexCharts(document.querySelector("#donut-chart"), options)).render();

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

    function compareFigs(num1, num2) {
        var fig1 = parseInt(num1);
        var fig2 = parseInt(num2);

        var arrowShow = '';
        var showColor = '';

        if (fig1 > fig2) {
            arrowShow = '<i class="ri-arrow-right-up-line me-1 align-middle"></i>';
            showColor = 'success';
        }
        
        if (fig1 < fig2) {
            arrowShow = '<i class="ri-arrow-right-down-line me-1 align-middle"></i>';
            showColor = 'danger';
        } 
        
        if (fig1 === fig2) {
            arrowShow = '<i class="ri-close-line me-1 align-middle"></i>';
            showColor = 'primary';
        }

        return {'arrows': arrowShow, 'color': showColor}
    }


    // var mmm = [10, 20, 30, 40, 50, 2, 3];

    // aveOfNumArray();

    function aveOfNumArray(nums, decimalPlaces) {

        var fig1 = nums;

        // var sum;

        var total = 0;

        for (var i = 0; i < fig1.length; i++) {
            // total += parseFloat(fig1[i]) << 0;
            total += fig1[i];
        }

        var avg = Math.abs(total / mmm.length);

        // console.log('Number of elements: '+mmm.length);
        // console.log('Total: '+total);
        // console.log('Average: '+naiveRound(avg, 2));

        return naiveRound(avg, decimalPlaces);
    }



    function sumOfArray(nums, decimalPlaces) {

        var fig1 = nums;

        var total = 0;

        for (var i = 0; i < fig1.length; i++) {
            // total += parseFloat(fig1[i]) << 0;
            total += fig1[i];
        }

        return naiveRound(total, decimalPlaces);
    }

    // perc();
    // function perc() {
    //     console.log(compareFigs(8, 7));
    //     console.log(percentIncreaseOfArray([8, 7], 2));
    // }

    function percentOfArray(nums, decimalPlaces) {

        var fig1 = nums;

        // var sum;

        var total = 0;

        for (var i = 0; i < fig1.length; i++) {
            // total += parseFloat(fig1[i]) << 0;
            total += fig1[i];
        }

        var avg = Math.abs((fig1[0] / fig1[1])*100);

        // console.log('Number of elements: '+mmm.length);
        // console.log('Total: '+total);
        // console.log('Average: '+naiveRound(avg, 2));

        return naiveRound(avg, decimalPlaces);
    }

    
    function percentIncreaseOfArray(nums, decimalPlaces) {

        var fig1 = nums;

        // var sum;

        var diffs = 0;
        var perc = 0;

        if (fig1[0] >= fig1[1]) {
            diffs = fig1[0] - fig1[1];

            perc = Math.abs((diffs/fig1[0])*100);

        } else {
            diffs = fig1[1] - fig1[0];
            perc = Math.abs((diffs/fig1[1])*100);

        }

        return naiveRound(perc, decimalPlaces);
    }



    function naiveRound(num, decimalPlaces = 0) {
        var p = Math.pow(10, decimalPlaces);
        return Math.round(num * p) / p;
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
    function chaangeDateTimeFormat(datetimes) {
        // var d = new Date(Date.parse(datetimes.replace(/-/g, "/")));

        var d = new Date(datetimes);
        var month = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        var date = d.getDate() + " " + month[d.getMonth()] + ", " + d.getFullYear();
        var time = d.toLocaleTimeString().toUpperCase().replace(/([\d]+:[\d]+):[\d]+(\s\w+)/g, "$1$2");
        return (date + " " + time);
    }


});