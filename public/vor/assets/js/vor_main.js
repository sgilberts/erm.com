
$(document).ready(function () {


    // View Song Details
    $("body").on("click", ".view_song_details", function (e) {
        e.preventDefault();

        var song_id = $(this).attr('id');

        // var myUrl = "list";

        $.ajax({
            url: 'edit_song_details',
            method: 'GET',
            dataType: 'json',
            async: false,
            data: {
                'id': song_id,
            },
            success: function (response) {

                // console.log(response.data);

                if (response.success == 'success') {

                    $(".header_artiste").text(response.data.artiste);
                    $(".top_artiste_image").html('<img class="card-img-top img-fluid" src="public/vor/songimg/' + response.data.cover_image + '" alt="Card image cap">');
                    $("#artiste_name").html('Artiste: ' + response.data.artiste);
                    $("#song_title").html('Song Title: ' + response.data.songTitle);
                    $("#song_downloads").html('Downlodas: ' + response.data.downloads);
                    $("#song_genre").html('Song Genre: ' + response.data.genre);
                    $("#song_album").html('Song Album: ' + response.data.album);
                    $("#song_created_at").html(changeDateTimeFormat(response.data.created_at));
                    $("#song_updated_at").html(changeDateTimeFormat(response.data.updated_at));
                    $("#song_category").html('Song Category: ' + response.data.song_cat);
                    $("#song_lyrics").html(response.data.lyrics);
                    $("#mysongdetail").modal('show');
                } else {

                }

            },
            error: function (response) {
                console.log(response);
            }
        });


    });


           

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // Download Files  edit_song_details  download_song_file
    $("body").on("click", ".download_file_btn", function (e) {
        e.preventDefault();

        var song_id = $(this).attr('id');

        // var myUrl = "list";
        
        $.ajax({
            url: 'edit_song_details',
            method: 'GET',
            dataType: 'json',
            async: false,
            data: {
                'id': song_id,
                '_token': "{{ csrf_field() }}"
            },
            success: function (response) {

            
                var song = response.data;

                if (response.success == 'success') {

                    $.ajax({
                        url: 'downloads_files/'+song_id,
                        method: 'GET',
                        async: false,
                        data: { 
                            'song': song_id, 
                            '_token': "{{ csrf_field() }}"
                        },
    
                        success: function(response) {
                            console.log(response);
                            // console.log(song.file_names);
                            // location.href = "public/downloads.php?song=" + song.file_names; //set your file url which want to download
    
                        },
                        error: function (response) {
                            console.log(response);
                            // location.href = "public/downloads.php?song=" + song.file_names; //set your file url which want to download
                        }
                    });
                    // location.href = myUrl;
                    // var locate = location.href = "public/downloads.php?song=" + response.data.file_names; //set your file url which want to download

                    // if (locate) {
                    //     toast('info', 'Downloading the song ' + response.data.songTitle + ' By ' + response.data.artiste, 'Song Download', 'toast-top-center', 10000);
                    //     fetchAllSongs();
                    // }


                } else {

                }

            },
            error: function (response) {
                console.log(response);
            }
        });


    });


    // Play Song Add Info 
    $("body").on("click", ".play_my_song", function (e) {
        e.preventDefault();

        var song_id = $(this).attr('id');

        // var myUrl = "list";
        
        $.ajax({
            url: 'edit_song_details',
            method: 'GET',
            dataType: 'json',
            async: false,
            data: {
                'id': song_id,
                '_token': "{{ csrf_field() }}"
            },
            success: function (response) {

            
                var song = response.data;

                if (response.success == 'success') {

                    $.ajax({
                        url: 'played_song_info/'+song_id,
                        method: 'GET',
                        async: false,
                        data: { 
                            'song': song_id, 
                            '_token': "{{ csrf_field() }}"
                        },
    
                        success: function(response) {
                            console.log(response);
                            // console.log(song.file_names);
                            // location.href = "public/downloads.php?song=" + song.file_names; //set your file url which want to download
    
                        },
                        error: function (response) {
                            console.log(response);
                            // location.href = "public/downloads.php?song=" + song.file_names; //set your file url which want to download
                        }
                    });
                    // location.href = myUrl;
                    // var locate = location.href = "public/downloads.php?song=" + response.data.file_names; //set your file url which want to download

                    // if (locate) {
                    //     toast('info', 'Downloading the song ' + response.data.songTitle + ' By ' + response.data.artiste, 'Song Download', 'toast-top-center', 10000);
                    //     fetchAllSongs();
                    // }


                } else {

                }

            },
            error: function (response) {
                console.log(response);
            }
        });


    });
    


    fetchAllSongs();

    function fetchAllSongs() {

        var html_head = '<table id="scroll-vertical-datatable" class="table dt-responsive nowrap w-100" style="width:100%, overflow: hidden;">' +
            '<thead>' +
            '<tr>' +
            '<th>#</th>' +
            '<th>Song Title</th>' +
            '<th>Artiste</th>' +
            '<th>Genre</th>' +
            '<th>Downloads</th>' +
            '<th>Action</th>' +
            '</tr>' +
            '</thead>' +
            '<tbody>';


        var html_foot = '</tbody></table>';

        $.ajax({
            url: 'get_all_songs',
            method: 'GET',
            dataType: 'json',
            async: false,
            success: function (response) {
                // console.log(response);

                var dataVal = response.data;
                var songList = [];
                var songsTable = [];
                var songsTableRows = '';

                dataVal.forEach(element => {
                    songList.push('<a href="javascript:void(0)" class="play play_my_song" data-id="' + element.id + '" data-album="' + element.album + '" data-artist=' + element.artiste + '" data-title="' + element.songTitle + '" data-albumart="public/vor/songimg/' + element.cover_image + '" data-url="public/vor/songs/' + element.file_names + '"></a>');


                    songsTable.push('<tr>' +
                        '<td>' + element.id + '</td>' +
                        '<td>' + element.songTitle + '</td>' +
                        '<td>' + element.artiste + '</td>' +
                        // '<td style="display: none; width: 50px" id="' + element.id + '" class="myTblRowEdits' + element.id + '"><input id="" class="form-control" name="lname" type="text" value="' + element.males + '"/></td>' +
                        '<td >' + element.genre + '</td>' +

                        '<td >' + element.downloads + '</td>' +
                        '<td>' +
                        '<a href="javascript:void(0)" id="' + element.id + '" class="view_song_details mx-2" title="Song Details"><i class="ri-disc-fill text-warning" style="font-size: 20px;"></i></a>' +
                        '<a href="javascript:void(0)" id="' + element.id + '" class="my_play_table_list mx-2"  data-id="' + element.id + '" data-album="' + element.album + '" data-artist=' + element.artiste + '" data-title="' + element.songTitle + '" data-albumart="public/vor/songimg/' + element.cover_image + '" data-url="public/vor/songs/' + element.file_names + '" title="Play Song"><i class="ri-play-circle-line text-primary" style="font-size: 20px;"></i></a>' +
                        '<a href="downloads_files/' + element.id + '" id="' + element.id + '" class=" mx-2" title="Download Song"><i class="ri-download-cloud-2-fill text-success" style="font-size: 20px;"></i></a>' +
                        // '<a href="downloads_files/' + element.id + '" id="' + element.id + '" class=" mx-2" title="Download Song"><i class="ri-download-cloud-2-fill text-success" style="font-size: 20px;"></i><input type="hidden" name="id" id="' + element.id + '" class="download_file_btn"/></a>' +
                        // download_file_btn

                        '</td>' +
                        '</tr>');


                    songsTableRows += '<tr>' +
                        '<td>' + element.id + '</td>' +
                        '<td>' + element.songTitle + '</td>' +
                        '<td>' + element.artiste + '</td>' +
                        // '<td style="display: none; width: 50px" id="' + element.id + '" class="myTblRowEdits' + element.id + '"><input id="" class="form-control" name="lname" type="text" value="' + element.males + '"/></td>' +
                        '<td >' + element.genre + '</td>' +

                        '<td >' + element.downloads + '</td>' +
                        '<td>' +
                        '<a href="javascript:void(0)" id="' + element.id + '" class="view_song_details mx-2" title="Song Details"><i class="ri-disc-fill text-warning" style="font-size: 20px;"></i></a>' +
                        '<a href="javascript:void(0)" id="' + element.id + '" class="my_play_table_list mx-2 play_my_song"  data-id="' + element.id + '" data-album="' + element.album + '" data-artist=' + element.artiste + '" data-title="' + element.songTitle + '" data-albumart="public/vor/songimg/' + element.cover_image + '" data-url="public/vor/songs/' + element.file_names + '" title="Play Song"><i class="ri-play-circle-line text-primary" style="font-size: 20px;"></i></a>' +
                        '<a href="downloads_files/' + element.id + '" id="' + element.id + '" class=" mx-2" title="Download Song"><i class="ri-download-cloud-2-fill text-success" style="font-size: 20px;"></i></a>' +
                        // '<a href="downloads_files/' + element.id + '" id="' + element.id + '" class=" mx-2" title="Download Song"><i class="ri-download-cloud-2-fill text-success" style="font-size: 20px;"></i><input type="hidden" name="id" id="' + element.id + '" class="download_file_btn"/></a>' +
                        // download_file_btn

                        '</td>' +
                    '</tr>';

                });


                var playList = songList;

                $("#play_list").html(playList);

                $("#play_list_table").html(html_head + songsTableRows + html_foot);


                $("#scroll-vertical-datatable").DataTable({
                    order: [0, 'desc'],
                    paging: false,
                    scrollCollapse: true,
                    // scrollY: '500px',
                    // overflow: 'hidden',
                    // scrollX: '100px'
                });

            },
            error: function (response) {
                console.log(response);
            }
        });
    }



    
    fetchAllSchedules();

    function fetchAllSchedules() {

        
        $.ajax({
            url: 'get_all_schedules',
            method: 'GET',
            dataType: 'json',
            async: false,
            success: function (response) {
                // console.log(response);

                var dataVal = response.data;
                var scheduleList = [];

                var scheduleListRows = '';

                // console.log(dataVal);

                dataVal.forEach(element => {

                 scheduleList.push('<div class="col-lg-4">'+
                    '<div class="card">'+
                      '<div class="card-header bg-dark text-light text-center">'+
                        '<h5 class="card-title text-light">'+element.event_title+'</h5>'+
                        '<h5 class="card-title text-light"><i class="ri-calendar-2-line text-light" style="font-size: 18px;"></i> '+changeDateTimeFormat(element.event_date)+'</h5>'+
                        '<h5 class="card-title text-light">[ '+element.eve_theme+' ]</h5>'+
                    '</div>'+
                        '<div class="card-body">'+
                            '<p class="card-text">First Session</p>'+
                            '<textarea class="schedule_song">'+element.worship_song+'</textarea>'+
                            // '<p class="card-text">2. Song</p>'+
                            // '<p class="card-text">3. Song</p>'+

                            '<h5>...............................................</h5>'+
                            '<h5>...............................................</h5>'+

                            '<p class="card-text">Second Session</p>'+
                            '<textarea class="schedule_song">'+element.praise_song+'</textarea>'+

                            'Song Ministration'+
                            '<p  style="font-size: 0.8rem;">'+element.mini_song+'</p>'+

                            'Offertory Song'+
                            '<p  style="font-size: 0.8rem;">'+element.offer_song+'</p>'+

                        '</div>'+
                    '</div>'+
                 '</div>');

                 scheduleListRows += '<div class="col-lg-4">'+
                 '<div class="card">'+
                   '<div class="card-header bg-dark text-light text-center">'+
                     '<h5 class="card-title text-light">'+element.event_title+'</h5>'+
                     '<h5 class="card-title text-light"><i class="ri-calendar-2-line text-light" style="font-size: 18px;"></i> '+changeDateTimeFormat(element.event_date)+'</h5>'+
                     '<h5 class="card-title text-light">[ '+element.eve_theme+' ]</h5>'+
                 '</div>'+
                     '<div class="card-body">'+
                         '<p class="card-text">First Session</p>'+
                         '<textarea class="schedule_song">'+element.worship_song+'</textarea>'+
                         // '<p class="card-text">2. Song</p>'+
                         // '<p class="card-text">3. Song</p>'+

                         '<h5>...............................................</h5>'+
                         '<h5>...............................................</h5>'+

                         '<p class="card-text">Second Session</p>'+
                         '<textarea class="schedule_song">'+element.praise_song+'</textarea>'+

                         'Song Ministration'+
                         '<p  style="font-size: 0.8rem;">'+element.mini_song+'</p>'+

                         'Offertory Song'+
                         '<p  style="font-size: 0.8rem;">'+element.offer_song+'</p>'+

                     '</div>'+
                 '</div>'+
              '</div>';



                });

            $("#schedule_list").html(scheduleListRows);

            },
            error: function (response) {
                console.log(response);
            }
        });
    }


    $(function () {
        Audio.init();
    });

    var intval;
    var autoplay;
    var Audio = {
        init: function () {
            this.info.init();
            this.player();
            this.scrollbar();
        },
        formatTime: function (secs) {
            var hr, min, sec;
            hr = Math.floor(secs / 3600);
            min = Math.floor((secs - hr * 3600) / 60);
            sec = Math.floor(secs - hr * 3600 - min * 60);

            min = min > 9 ? min : "0" + min;
            sec = sec > 9 ? sec : "0" + sec;
            return min + ":" + sec;
        },
        info: {
            init: function () {
                $(".play-list .play").each(function () {
                    var album, albumart, artist, title;
                    album = $(this).data("album");
                    albumart = $(this).data("albumart");
                    artist = $(this).data("artist");
                    title = $(this).data("title");

                    album = album
                        ? '<span class="album">' + album + "</span>"
                        : "Unknown Album";
                    albumart = albumart ? '<img src="' + albumart + '">' : "";
                    artist = artist
                        ? '<span class="song-artist">' + artist + "</span>"
                        : "Unknown Artist";
                    title = title
                        ? '<div class="song-title">' + title + "</div>"
                        : "Unknown Title";

                    $(this).html(
                        '<div class="album-thumb pull-left">' +
                        albumart +
                        '</div><div class="songs-info pull-left">' +
                        title +
                        '<div class="songs-detail">' +
                        artist +
                        " - " +
                        album +
                        "</div></div></div>"
                    );
                });
            },
            load: function (id, album, artist, title, albumart, mp3) {
                var currentTrack, totalTrack;
                totalTrack = $(".play-list>a").length;
                currentTrack = $(".play-list a").index($(".play-list .active")) + 1;
                $(".play-position").text(currentTrack + " / " + totalTrack);
                albumart = albumart ? '<img src="' + albumart + '">' : "";
                album = album ? album : "Unknown Album";
                title = title ? title : "Unknown Title";
                artist = artist ? artist : "Unknown Artist";
                $(".album-art").html(albumart);
                $(".current-info .song-album").html('<i class="fa fa-music"></i> ' + album);
                $(".current-info .song-title").html(
                    '<i class="fa fa-headphones"></i> ' + title
                );
                $(".current-info .song-artist").html('<i class="fa fa-user"></i> ' + artist);
                if (mp3)
                    $(".audio").html(
                        '<audio class="music" data-id="' + id + '" src="' + mp3 + '"></audio>'
                    );
            }
        },
        player: function () {
            var id, album, artist, albumart, title, mp3;
            $(".play-list .play").each(function () {
                $(this).on("click", function (e) {
                    e.preventDefault();
                    $(this).siblings().removeClass("active");
                    $(this).addClass("active");
                    clearInterval(intval);
                    id = $(this).data("id");
                    album = $(this).data("album");
                    artist = $(this).data("artist");
                    albumart = $(this).data("albumart");
                    title = $(this).data("title");
                    mp3 = $(this).data("url");
                    Audio.info.load(id, album, artist, title, albumart, mp3);
                    Audio.play($(".music"));
                    $(".music").prop("volume", $(".volume").val());
                    Audio.playlist.hide();
                });
            });


            $(".my_play_table_list").each(function () {
                $(this).on("click", function (e) {
                    e.preventDefault();
                    $(this).siblings().removeClass("active");
                    $(this).addClass("active");
                    clearInterval(intval);
                    id = $(this).data("id");
                    album = $(this).data("album");
                    artist = $(this).data("artist");
                    albumart = $(this).data("albumart");
                    title = $(this).data("title");
                    mp3 = $(this).data("url");
                    Audio.info.load(id, album, artist, title, albumart, mp3);
                    Audio.play($(".music"));
                    $(".music").prop("volume", $(".volume").val());
                    Audio.playlist.hide();
                });
            });


            $(".play-pause").on("click", function (e) {
                e.preventDefault();
                if ($(".audio").is(":empty")) {
                    $(".play-list a:first-child").click();
                } else {
                    var music = $(".music")[0];
                    if (music.paused) {
                        setInterval(intval);
                        Audio.play($(".music"));
                        $(this).addClass("active");
                    } else {
                        clearInterval(intval);
                        Audio.pause($(".music"));
                        $(this).removeClass("active");
                    }
                }
            });

            $(".stop").on("click", function (e) {
                e.preventDefault();
                clearInterval(intval);
                Audio.stop($(".music"));
                $(".music")[0].currentTime = 0;
                $(".progress .bar").css("width", 0);
            });
            $(".volume").on("change", function () {
                var vol, css;
                vol = $(this).val();
                $(this).attr("data-css", vol);
                $(".music").prop("volume", vol);
            });
            $(".prev").on("click", function (e) {
                var index, firstIndex;
                e.preventDefault();
                index = $(".play-list a").length - $(".play-list a").index();
                firstIndex =
                    $(".play-list a").length -
                    $(".play-list a").index($(".play-list a.active"));
                if (index == firstIndex) {
                    $(".play-list a:last-child").click();
                } else {
                    Audio.prev();
                }
            });
            $(".next").on("click", function (e) {
                var index, lastIndex;
                e.preventDefault();
                index = $(".play-list a").length;
                lastIndex = $(".play-list a").index($(".play-list a.active")) + 1;
                if (index == lastIndex) {
                    $(".play-list a:first-child").click();
                } else {
                    Audio.next();
                }
            });
            $(".toggle-play-list").on("click", function (e) {
                e.preventDefault();
                var toggle = $(this);
                if (toggle.hasClass("active")) {
                    Audio.playlist.hide();
                } else {
                    Audio.playlist.show();
                }
            });
        },
        playlist: {
            show: function () {
                $(".play-list").fadeIn(500);
                $(".toggle-play-list").addClass("active");
                $(".album-art").addClass("blur");
            },
            hide: function () {
                $(".play-list").fadeOut(500);
                $(".toggle-play-list").removeClass("active");
                $(".album-art").removeClass("blur");
            }
        },
        play: function (e) {
            var bar, current, total;
            e.trigger("play").bind("ended", function () {
                $(".next").click();
            });
            intval = setInterval(function () {
                current = e[0].currentTime;
                $(".play-current-time").text(Audio.formatTime(current));

                bar = (current / e[0].duration) * 100;
                $(".progress .bar").css("width", bar + "%");
            }, 1000);

            var totalDur = setInterval(function (t) {
                if ($(".audio .music")[0].readyState > 0) {
                    total = e[0].duration;
                    $(".play-total-time").text(Audio.formatTime(total));
                    clearInterval(totalDur);
                }
            }, 1000);
            $(".play-pause").addClass("active");
        },
        pause: function (e) {
            e.trigger("pause");
            $(".play-pause").removeClass("active");
        },
        stop: function (e) {
            e.trigger("pause").prop("currentTime", 0);
            $(".play-pause").removeClass("active");
        },
        mute: function (e) {
            prop("muted", !e.prop("muted"));
        },
        volumeUp: function (e) {
            var volume = e.prop("volume") + 0.2;
            if (volume > 1) {
                volume = 1;
            }
            e.prop("volume", volume);
        },
        volumeDown: function (e) {
            var volume = e.prop("volume") - 0.2;
            if (volume < 0) {
                volume = 0;
            }
            e.prop("volume", volume);
        },
        prev: function () {
            var curr = $(".music").data("id");
            var prev = $('a[data-id="' + curr + '"]').prev();
            if (curr && prev) {
                prev.click();
            }
        },
        next: function () {
            var curr = $(".music").data("id");
            var next = $('a[data-id="' + curr + '"]').next();
            if (curr && next) {
                next.click();
            }
        },
        scrollbar: function () {
            if (typeof $.fn.enscroll !== "undefined") {
                $(".play-list").enscroll({
                    showOnHover: true,
                    verticalTrackClass: "track",
                    verticalHandleClass: "handle"
                });
            }
        }
    };


    mostHighestSongs();
    function mostHighestSongs() {
        $.ajax({
            url: 'get_all_songs',
            method: 'GET',
            dataType: 'json',
            async: false,
            success: function (response) {
                // console.log(response);

                var dataVal = response.data;
               
                var totalDownloads = 0;
                var myVals = [];

                dataVal.forEach(element => {

                    myVals += element.downloads;
                    
                });


                // totalDownloads = sumOfNum(myVals);
                // var text = gh.childNodes.item(0).data;


                // $("#total_downloads").childNodes.item(0).data;



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



    function sumOfNum(myArrayValue) {

        var total = 0;

        // fig1 = parseInt(myValue);
        myArrayValue.forEach(function(num){total+=parseFloat(num) || 0;});

        // myArrayValue.forEach(element => {

        //     total += element.downloads;
            
        // });

        // total = Math.abs(fig1 + fig2 + fig3 + fig4);

        return total;
    }



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