@extends('admin.layouts.app')


@section('style')
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
        
                            

                            
                            <div class="row  mb-3">
                                <div class="col-md-12">
                                    {{-- @include('admin.layouts._my_alerts') --}}
                                </div>
                                
                            </div>

                            
                            <div class="row">
                                <div class="col-xl--12">
                                    <div class="card">
                                        <div class="card-body">
            
                                            <h3 class="card-title">Recycle Bin</h3>

                                            <div class="btn-toolbar p-3" role="toolbar">
                                                <div class="btn-group me-2 mb-2 mb-sm-0">
                                                    <button type="button" class="btn btn-primary waves-light waves-effect"><i class="fa fa-inbox"></i></button>
                                                    <button type="button" class="btn btn-primary waves-light waves-effect"><i class="fa fa-exclamation-circle"></i></button>
                                                    <button type="button" class="btn btn-success waves-light waves-effect restore_sel_form" title="Restore First Timers"><i class="ri-restart-line"></i></button>
                                                    <button type="button" class="btn btn-danger waves-light waves-effect perm_del_sel_form" title="Delete First Timers"><i class="ri-delete-bin-2-line "></i></button>
                                                    <input type="hidden" name="select_all" id="get_select_all">
                                                </div>
                                                {{-- <div class="btn-group me-2 mb-2 mb-sm-0">
                                                    <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-folder"></i> <i class="mdi mdi-chevron-down ms-1"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Updates</a>
                                                        <a class="dropdown-item" href="#">Social</a>
                                                        <a class="dropdown-item" href="#">Team Manage</a>
                                                    </div>
                                                </div> --}}
                                                
                                            </div>

            
                                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                <tr>
                                                    <th>
                                                        {{-- <input class="form-check-input chooseAllItems" data-val="0" value="" name="select_all" type="checkbox" id="select_all"> --}}
                                                        <input type="checkbox" data-val="0" class="form-check-input largerCheckbox" id="chkAll" />
                                                    </th>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>User Code</th>
                                                    {{-- <th>User Role</th> --}}
                                                    <th>Phone</th>
                                                    {{-- <th>Chapter</th> --}}
                                                    <th>Created On</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
            
            
                                                <tbody>
                                               
                                                    @foreach ($getRecord as $row)

                                                        <tr>
                                                            <td>
                                                                {{-- <input class="form-check-input chooseItem" data-val="0" value="{{$row->id}}" name="select_data_{{ $row->id }}" type="checkbox" id="{{ $row->id }}"> --}}

                                                                <input type='checkbox' value="{{ $row->id }}" data-val="0"  data-id="{{ $row->id }}" class="form-check-input largerCheckbox tblChk chooseItem" />
                                                            </td>
                                                            <td>{{ $row->id }}</td>
                                                            <td>{{ $row->first_name .' '. $row->last_name }}</td>
                                                            <td>{{ $row->email }}</td>
                                                            <td>{{ $row->gender }}</td>
                                                            <td>{{ $row->cell_number }}</td>
                                                            <td>{{ date( 'D d M Y, h:i A', strtotime( $row->created_at )) }}</td>
                                                            <td>
                                                                <a href="avascript:void(0)" id="{{ $row->id }}" class="view_first_timer_btn mx-2" title="View First Timer"><i class="ri-eye-line" style="font-size: 20px;"></i></a>
                                                                <a href="avascript:void(0)" id="{{ $row->id }}" class="restore_first_timers_btn mx-2" title="Restore First Timer"><i class="ri-restart-line text-danger" style="font-size: 20px;"></i></a>
                                                                
                                                                <a href="avascript:void(0)" id="{{ $row->id }}" class="perm_delete_first_timers_btn mx-2" title="Delete First Timer"><i class="ri-delete-bin-2-line text-danger" style="font-size: 20px;"></i></a>
                                                                
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                            
                                               
                                                </tbody>
                                            </table>
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

        @include('admin.layouts._modals')

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

        <script src="{{ url('public/assets/js/app.js') }}">></script>

        <script src="{{ url('public/assets/js/first_timers.js') }}">></script>

        @endsection

