<script>
    @if (Session::has('message'))
        var type = "{{ Session::get('alert_type') }}"
        var positionClass = "{{ Session::get('positionClass') }}";

        if (positionClass === '' || positionClass === null) {
            positionClass = "toast-top-right";
        } else {
            positionClass = "{{ Session::get('positionClass') }}";
        }

        var options = {
            "closeButton": true,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": positionClass,
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };


        switch (type) {
            case 'info':

                
                toastr.options = options;
                toastr.info("{{ Session::get('message') }}", "{{ Session::get('title') }}");
                var audio = new Audio('audio.mp3');
                audio.play();
                break;
            case 'success':

                // 
                toastr.options = options;
                toastr.success("{{ Session::get('message') }}", "{{ Session::get('title') }}");
                var audio = new Audio('audio.mp3');
                audio.play();

                break;
            case 'warning':

                // 
                toastr.options = options;
                toastr.warning("{{ Session::get('message') }}", "{{ Session::get('title') }}");
                var audio = new Audio('audio.mp3');
                audio.play();

                break;
            case 'error':

                // 
                toastr.options = options;
                toastr.error("{{ Session::get('message') }}", "{{ Session::get('title') }}");
                var audio = new Audio('audio.mp3');
                audio.play();

                break;
        }

    @endif
</script>