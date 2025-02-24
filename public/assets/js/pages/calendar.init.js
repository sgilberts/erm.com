
$(document).ready(function () {



    !function (e) {
        "use strict";
        function t() { }

        var calArray = [];


        $.ajax({
            url: 'fetch_calendar_items',
            method: 'GET',
            dataType: 'json',
            async: false,
            success: function (response) {

                var dataVal = response.data;

                dataVal.forEach(element => {
                    calArray.push({ id: element.id, title: element.title, start: new Date(element.start), end: new Date(element.end), allDay: element.allDay, className: element.color, description: element.descript });
                });

            },
            error: function (response) {
                return response;
                // console.log(response);
            }
        });




        t.prototype.init = function () {

            var c = new bootstrap.Modal(document.getElementById("event-modal"), { keyboard: !1 });
            document.getElementById("event-modal"); var t = document.getElementById("modal-title"),
                n = document.getElementById("form-event"),
                v = null,
                m = document.getElementsByClassName("needs-validation"),
                e = new Date, u = null, a = e.getDate(), d = e.getMonth(), l = e.getFullYear(),
                i = FullCalendar.Draggable, r = document.getElementById("external-events");

            var g = calArray;


            // [
            //     { title: "All Day Event", start: new Date(l, d, 1) },
            //     { title: "Long Event", start: new Date(l, d, a - 5), end: new Date(l, d, a - 2), className: "bg-warning" },
            //     { id: 999, title: "Repeating Event", start: new Date(l, d, a - 3, 16, 0), allDay: !1, className: "bg-info" },
            //     { id: 999, title: "Repeating Event", start: new Date(l, d, a + 4, 16, 0), allDay: !1, className: "bg-primary" },
            //     { title: "Meeting", start: new Date(l, d, a, 10, 30), allDay: !1, className: "bg-success" },
            //     { title: "Lunch", start: new Date(l, d, a, 12, 0), end: new Date(l, d, a, 14, 0), allDay: !1, className: "bg-danger" },
            //     { title: "Birthday Party", start: new Date(l, d, a + 1, 19, 0), end: new Date(l, d, a + 1, 22, 30), allDay: !1, className: "bg-success" },
            //     { title: "Click for Google", start: new Date(l, d, 28), end: new Date(l, d, 29), url: "http://google.com/", className: "bg-dark" }
            // ];


            new i(r, {
                itemSelector: ".external-event",
                eventData: function (e) {
                    return {
                        // id: Math.floor(11e3 * Math.random()),
                        id: 'new',
                        title: e.innerText,
                        allDay: !0,
                        start: new Date,
                        className: e.getAttribute("data-class")
                    }
                }
            });


            var o = document.getElementById("calendar");
            function s(e) {
                document.getElementById("form-event").reset(),
                    document.getElementById("btn-delete-event").setAttribute("hidden", !0),
                    c.show(), n.classList.remove("was-validated"), n.reset(),
                    v = null,
                    t.innerText = "Add Event",
                    u = e,
                    document.getElementById("edit-event-btn").setAttribute("data-id", "new-event"),
                    document.getElementById("edit-event-btn").setAttribute("hidden", !0);


            }


            function y() {
                return 768 <= window.innerWidth && window.innerWidth < 1200 ? "timeGridWeek" : window.innerWidth <= 768 ? "listMonth" : "dayGridMonth";
            }

            var w = new FullCalendar.Calendar(o, {
                timeZone: "local", editable: !0, droppable: !0, selectable: !0, navLinks: !0, initialView: y(), themeSystem: "bootstrap",
                headerToolbar: { left: "prev,next today", center: "title", right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth" },
                windowResize: function (e) { var t = y(); w.changeView(t) }, eventResize: function (t) {
                    var e = g.findIndex(function (e) { return e.id == t.event.id });
                    g[e] && (g[e].title = t.event.title,
                        g[e].start = t.event.start,
                        g[e].end = t.event.end ? t.event.end : null,
                        g[e].allDay = t.event.allDay,
                        g[e].className = t.event.classNames[0],
                        g[e].description = t.event._def.extendedProps.description ? t.event._def.extendedProps.description : "",
                        g[e].location = t.event._def.extendedProps.location ? t.event._def.extendedProps.location : "")
                },


                eventClick: function (e) {
                    document.getElementById("edit-event-btn").removeAttribute("hidden"),
                        document.getElementById("btn-save-event").setAttribute("hidden", !0),
                        document.getElementById("edit-event-btn").setAttribute("data-id", "edit-event"),
                        document.getElementById("edit-event-btn").innerHTML = "Edit", c.show(), n.reset(), v = e.event,
                        document.getElementById("modal-title").innerHTML = "Edit Eevent",
                        document.getElementById("event-title").value = v.title,
                        document.getElementById("eventid").value = v.id,
                        document.getElementById("event-category").value = v.className,
                        console.log("selectedEvent", e), u = null, t.innerText = v.title,
                        document.getElementById("btn-delete-event").removeAttribute("hidden")
                },


                dateClick: function (e) {
                    s(e),
                        document.getElementById("btn-save-event").removeAttribute("hidden");

                },


                events: g, eventReceive: function (e) {
                    var t = {
                        id: parseInt(e.event.id),
                        title: e.event.title,
                        start: e.event.start,
                        end: e.event.end ? e.event.end : null,
                        allDay: e.event.allDay,
                        className: e.event.classNames[0]
                    };
                    g.push(t);

                },



                eventDrop: function (t) {
                    var e = g.findIndex(function (e) { return e.id == t.event.id });

                    g[e] && (
                        g[e].title = t.event.title,
                        g[e].start = t.event.start,
                        g[e].end = t.event.end ? t.event.end : null,
                        g[e].allDay = t.event.allDay,
                        g[e].className = t.event.classNames[0],
                        g[e].description = t.event._def.extendedProps.description ? t.event._def.extendedProps.description : "",
                        g[e].location = t.event._def.extendedProps.location ? t.event._def.extendedProps.location : ""
                    );

                    // TODO Update Drag And Drop Event

                    if (t.event.id != 'new') {
                        $.ajax({
                            url: 'update_church_events',
                            method: 'GET',
                            dataType: 'json',
                            async: false,
                            data: {
                                'id': t.event.id,
                                'title': t.event.title,
                                'start': t.event.start ? changeDateTimeDB(t.event.start) : null,
                                'end': t.event.end ? changeDateTimeDB(t.event.end) : null,
                                'allDay': t.event.allDay,
                                'color': t.event.classNames[0],
                                'descript': t.event.descript ? t.event.descript : "",
                            },
                            success: function (response) {

                                console.log(response);
                            },
                            error: function (response) {
                                console.log(response);
                            }
                        });

                    }


                }

            });


            w.render(),
                n.addEventListener("submit", function (e) {
                    e.preventDefault();

                    var t = document.getElementById("event-title").value, n = document.getElementById("event-category").value,
                        a = new Date,
                        d = null,
                        l = document.getElementById("eventid").value,
                        i = !1; 1 < a.length && ((d = new Date(a[1])).setDate(d.getDate() + 1), new Date(a[0]),
                            i = !0);

                    var r,
                        o,
                        s = g.length + 1; !1 === m[0].checkValidity() ? m[0].classList.add("was-validated") : (v ?
                            (
                                v.setProp("id", l),
                                v.setProp("title", t),
                                v.setProp("classNames", [n]),
                                v.setStart(v.start),
                                v.setAllDay(i),
                                r = g.findIndex(function (e) {


                                    return e.id == v.id;
                                }),

                                g[r] && (
                                    g[r].title = t,
                                    g[r].start = v.start,
                                    g[r].allDay = i,
                                    g[r].className = n
                                ),

                                w.render()
                            ) :

                            (
                                console.log("add updatedCategory", n),
                                o = {
                                    id: s == null ? null : s,
                                    title: t,
                                    start: u.date,
                                    allDay: i,
                                    className: n
                                },

                                w.addEvent(o), g.push(o), u = null


                            ),

                            c.hide()
                        );


                    // if (v.id == 'new') {
                    $.ajax({
                        url: 'update_church_events',
                        method: 'GET',
                        dataType: 'json',
                        async: false,
                        data: {
                            'id': v == null ? null : v.id,
                            'title': v == null ? $("#event-title").val() : v.title,
                            'start': v == null ? changeDateTimeDB($("#start_time").val()) : changeDateTimeDB(v.start),
                            'end': v == null ? changeDateTimeDB($("#end_time").val()) : changeDateTimeDB(v.end),
                            'allDay': v == null ? null : v.allDay,
                            'color': n,
                            'descript': v == null ? $("#start_time").val() : v.description,
                        },
                        success: function (response) {

                            if (response.success == 'success') {
                                toast('success', 'New Event is successfully created.', 'New Event', 'toast-top-center', 5000);
                            }
                        },
                        error: function (response) {
                            console.log(response);
                        }
                    });

                    // }

                    // console.log("ID:", v.id);
                    // console.log("Title:", v.title);
                    // console.log("Start:", changeDateTimeDB(v.start));
                    // console.log("End:", changeDateTimeDB(v.end));
                    // console.log("BgColor: ", n);
                    // console.log("Description:", v.description);

                }),


                document.getElementById("btn-delete-event").addEventListener("click",
                    function (e) {

                        if (v) {
                            for (var t = 0; t < g.length; t++) {
                                g[t].id == v.id && (g.splice(t, 1), t--);

                                // console.log(g[t].id);
                            };


                            // The ID To delete an event
                            // console.log(v._def);
                            // console.log(v._def.publicId);

                            $.ajax({
                                url: 'pem_delete_ft',
                                method: 'GET',
                                dataType: 'json',
                                data: {
                                    'id': v._def.publicId
                                },
                                success: function (response) {

                                    
                                    if (response.success == 'success') {
                                        toast('success', 'The Event is successfully deleted.', 'Event Deleted', 'toast-top-center', 5000);
                                    }
                                },
                                error: function (response) {
                                    console.log(response);
                                }
                            });

                            v.remove(), v = null, c.hide();

                        }

                    }),

                document.getElementById("btn-new-event").addEventListener("click", function (e) {
                    flatpicekrValueClear(),
                        flatPickrInit(),
                        s(),
                        document.getElementById("edit-event-btn").setAttribute("data-id", "new-event"),
                        document.getElementById("edit-event-btn").click(), document.getElementById("edit-event-btn").setAttribute("hidden", !0)

                })
        },

            e.CalendarPage = new t, e.CalendarPage.Constructor = t

    }
        (window.jQuery),
        function () { "use strict"; window.jQuery.CalendarPage.init() }();




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



    fetch_cal_title_names();
    // Fetch Event Titles
    function fetch_cal_title_names() {
        $.ajax({
            url: 'fetch_cal_title_names',
            method: 'GET',
            dataType: 'json',
            async: false,
            success: function (response) {

                var dataVal = response.data;

                var dragItems = [];

                dataVal.forEach(element => {

                    // console.log(element.bg_color);

                    dragItems.push('<div class="external-event fc-event ' + element.bg_color + '" data-class="' + element.bg_color + '">' +
                        '<i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>' + element.event_title + '' +
                        '</div>');

                });

                // var dragValHhml =  dragItems ;

                $("#dragableTitle").html(dragItems);

            },
            error: function (response) {
                return response;
                // console.log(response);
            }
        });
    }

    // Convert To DB Date And Time
    function changeDateTimeDB(datetimes) {


        if (datetimes != null) {
            var d = new Date(datetimes);
            var date = + d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate();
            var time = '0' + d.getHours() + ":" + '0' + d.getMinutes() + ":" + '0' + d.getSeconds();
            return (date + " " + time);

        }

    }

});