@extends('admin.layouts.app')

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.css" integrity="sha512-MT4B7BDQpIoW1D7HNPZNMhCD2G6CDXia4tjCdgqQLyq2a9uQnLPLgMNbdPY7g6di3hHjAI8NGVqhstenYrzY1Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/jquery-clockpicker.min.css" integrity="sha512-Dh9t60z8OKsbnVsKAY3RcL2otV6FZ8fbZjBrFENxFK5H088Cdf0UVQaPoZd/E0QIccxqRxaSakNlmONJfiDX3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

{{-- <link rel="stylesheet" href="style.css"> --}}
<style>
    .icon-10 { font-size: 10px; }
    .icon-20 { font-size: 20px; }
    .icon-30 { font-size: 30px; }
</style>
@endsection

@section('content')
                 

        @include('admin.layouts._header')
            <!-- ========== Left Sidebar Start ========== -->
            @include('admin.layouts._sidenav')
            
            <!-- Left Sidebar End -->

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                 
                <div class="page-content">
                    <div class="container-fluid">
        
                        <!-- start page title -->
                        @include('admin.layouts._pagetitle')
                        <!-- end page title -->
        
                        <div class="row mb-4">
                            <div class="col-xl-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <button type="button" class="btn font-16 btn-primary waves-effect waves-light w-100" id="btn-new-event" data-bs-toggle="modal" data-bs-target="#event-modal">
                                            Create New Event
                                        </button>
        
                                       
                                            <div id="external-events">
                                                <br>
                                                <p class="text-muted">Drag and drop your event or click in the calendar</p>
                                                <div id="dragableTitle"></div>
                                            </div>
                                    </div>
                                </div>
                            </div> <!-- end col-->
                            <div class="col-xl-9">
                                <div class="card mb-0">
                                    <div class="card-body">
                                        <div id="calendar"></div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row-->
                        <div style='clear:both'></div>
        
                        <!-- Add New Event MODAL -->
                        <div class="modal fade" id="event-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header py-3 px-4">
                                        <h5 class="modal-title" id="modal-title">Event</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
        
                                    <div class="modal-body p-4">
                                        <form class="needs-validation" name="event-form" id="form-event" novalidate>
                                            <input type="hidden" name="eventid" id="eventid">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Event Name</label>
                                                        <input class="form-control" placeholder="Insert Event Name" type="text" name="title" id="event-title" required value="">
                                                        <div class="invalid-feedback">Please provide a valid event name
                                                        </div>
                                                    </div>
                                                </div> <!-- end col-->
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Category</label>
                                                        <select class="form-select" name="category" id="event-category">
                                                            <option selected> --Select-- </option>
                                                            <option value="bg-danger">Danger</option>
                                                            <option value="bg-success">Success</option>
                                                            <option value="bg-primary">Primary</option>
                                                            <option value="bg-info">Info</option>
                                                            <option value="bg-dark">Dark</option>
                                                            <option value="bg-warning">Warning</option>
                                                        </select>
                                                        <div class="invalid-feedback">Please select a valid event category</div>
                                                    </div>
                                                </div> <!-- end col-->
                                            </div> <!-- end row-->

                                            <div class="row mt-2">
                                                <div class="col-md-6 col-xl-3 col-xxl-6 mb-3">
                                                    <label class="form-label">Start Time</label>
                                                    <div class="input-group clockpicker" data-placement="right" data-align="top" data-autoclose="true">
                                                        <input type="text" id="start_time" name="start_time" class="form-control" placeholder="09:32">
                                                        <span class="input-group-addon">
                                                            <i class="ri-timer-line icon-30"></i>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-xl-3 col-xxl-6 mb-3">
                                                    <label class="form-label">Start Time</label>
                                                    <div class="input-group clockpicker" data-placement="right" data-align="top" data-autoclose="true">
                                                        <input type="text" id="end_time" name="end_time" class="form-control" placeholder="09:32">
                                                        <span class="input-group-addon">
                                                            <i class="ri-timer-line icon-30"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row mt-2">
                                                <div class="col-6">
                                                    <button type="button" class="btn btn-danger" id="btn-delete-event">Delete</button>
                                                </div> <!-- end col-->
                                                <div class="col-6 text-end">
                                                    <button type="button" class="btn btn-light me-1" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success" id="btn-save-event">Save</button>
                                            <button href="#" class="btn btn-sm btn-subtle-primary" id="edit-event-btn" data-id="edit-event"  role="button">Edit</button>
        
                                                </div> <!-- end col-->
                                            </div> <!-- end row-->
                                        </form>
                                    </div>
                                </div>
                                <!-- end modal-content-->
                            </div>
                            <!-- end modal dialog-->
                        </div>
                        <!-- end modal-->
        
                    </div> <!-- container-fluid -->
                </div>
                
                <!-- End Page-content -->
                @include('admin.layouts._footer')
                
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->
        
             <!-- Right Sidebar -->

             @include('admin.layouts._rightside')
        
             <!-- /Right-bar -->

        @endsection
                
   

        @section('script')
            <!-- plugin js -->
            <script src="{{ url('public/assets/libs/moment/min/moment.min.js') }}"></script>
            <script src="{{ url('public/assets/libs/jquery-ui-dist/jquery-ui.min.js') }}"></script>

            <script src="{{ url('public/assets/libs/fullcalendar/index.global.min.js') }}"></script>

            <!-- Calendar init -->
            <script src="{{ url('public/assets/js/pages/calendar.init.js') }}"></script>

            <script src="{{ url('public/assets/js/app.js') }}"></script>


            <script src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/jquery-clockpicker.min.js" integrity="sha512-x0qixPCOQbS3xAQw8BL9qjhAh185N7JSw39hzE/ff71BXg7P1fkynTqcLYMlNmwRDtgdoYgURIvos+NJ6g0rNg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.js" integrity="sha512-x0qixPCOQbS3xAQw8BL9qjhAh185N7JSw39hzE/ff71BXg7P1fkynTqcLYMlNmwRDtgdoYgURIvos+NJ6g0rNg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

            <script type="text/javascript">
                $('.clockpicker').clockpicker()
                    .find('input').change(function(){
                        // TODO: time changed
                        console.log(this.value);
                    });
                $('#demo-input').clockpicker({
                    autoclose: true
                });
                
                if (something) {
                    // Manual operations (after clockpicker is initialized).
                    $('#demo-input').clockpicker('show') // Or hide, remove ...
                            .clockpicker('toggleView', 'minutes');
                }
            </script>

        @endsection