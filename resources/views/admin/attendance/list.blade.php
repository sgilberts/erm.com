@extends('admin.layouts.app')


@section('style')

    <!-- Plugins css -->
    <link href="{{ url('public/assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- DataTables -->
    <link href="{{ url('public/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/assets/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ url('public/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />     

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
        
                            

                            @if (Auth::user()->verified == 1)
                                <div class="row  mb-3">
                                    <div class="col-md-10">
                                        {{-- @include('admin.layouts._my_alerts') --}}
                                    </div>
                                    <div class="col-md-2">
                                        <button id="add_attendance_btn" class="btn btn-primary add_attendance_btn" style="width: 100%">Add Attendance</button>
                                    </div>
                                </div>
                            @endif


                             {{-- Add New User Start --}}
                             <div class="row">

                                <div class="col-xl-12" style="display: none;" id="add_attendance_div">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Add New Church Attendance</h4>
                                            <p class="text-danger" id="passError"></p>
                                            {{-- <form action="{{ url('add_church_attendance') }}" method="POST" class="needs-validation">
                                                
                                                 {{ csrf_field() }} --}}
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="gender" class="form-label">Event Title</label>
                                                            <select class="form-select event_title_id" name="event_title_id" id="event_title_id" required>
                                                                <option selected disabled value="">Choose Event Title ...</option>
    
                                                                @foreach ($getTitleRecord as $row)
    
                                                                    <option value="{{ $row->id }}">{{ $row->event_title }}</option>
                                                               
                                                                @endforeach
                                                               
                                                            </select>
        
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="user_role" class="form-label eventDateTitle">Event Date</label>

                                                        <div id="showEventTitleAttendance"></div>
                                                        {{-- <select class="form-select" name="user_role" id="user_role" required>
                                                            <option selected disabled value="">Choose User Role...</option>

                                                            <option value="{{ $row->id  }}">{{ $row->event_title }}</option>
                                                           
                                                        </select> --}}
        
                                                    </div>
                                                    
                                                </div>

                                               

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-6">
                                                            <div>
                                                                <input id="add_attendance_row_btn" class="btn btn-primary add_attendance_row_btn" type="submit" value="Add New Attendance" style="width: 100%;"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            {{-- </form> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Add New User End --}}


                        
                            <div class="row">
                                <div class="col-xl--12">
                                    <div class="card">
                                        <div class="card-body">
            

                                            <h3 class="card-title"></h3>
                                            {{-- <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                              
                                                <thead>
                                                <tr>
                                                    <th>Event Title</th>
                                                    <th>Date</th>
                                                    <th>Males</th>
                                                    <th>Females</th>
                                                    <th>Children</th>
                                                    <th>First Timers</th>
                                                    <th>Total</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
            
            
                                                <tbody> --}}
                                                    <div id="myTableRowList"></div>
                                                {{-- </tbody>
                                            </table> --}}
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->

                            

                            
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
               
        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>


       @endsection
     
        
        @section('script')
            
        <!-- Required datatable js -->
        <script src="{{ url('public/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}">></script>
        <script src="{{ url('public/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}">></script>
        <!-- Buttons examples -->
        <script src="{{ url('public/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}">></script>
        <script src="{{ url('public/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}">></script>
        <script src="{{ url('public/assets/libs/jszip/jszip.min.js') }}">></script>
        <script src="{{ url('public/assets/libs/pdfmake/build/pdfmake.min.js') }}">></script>
        <script src="{{ url('public/assets/libs/pdfmake/build/vfs_fonts.js') }}">></script>
        <script src="{{ url('public/assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}">></script>
        <script src="{{ url('public/assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}">></script>
        <script src="{{ url('public/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}">></script>

        <script src="{{ url('public/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}">></script>
        <script src="{{ url('public/assets/libs/datatables.net-select/js/dataTables.select.min.js') }}">></script>
        
        <!-- Responsive examples -->
        <script src="{{ url('public/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}">></script>
        <script src="{{ url('public/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}">></script>

        <!-- Datatable init js -->
        <script src="{{ url('public/assets/js/pages/datatables.init.js') }}">></script>

        <!-- Plugins js -->
        <script src="{{ url('public/assets/libs/dropzone/min/dropzone.min.js') }}"></script>


        <script src="{{ url('public/assets/js/app.js') }}">></script>

        <script src="{{ url('public/assets/js/ch_attendance.js') }}">></script>

        @endsection

