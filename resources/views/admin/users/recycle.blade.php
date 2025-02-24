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
            
                                            <h4 class="card-title">Recycle Bin</h4>
                                            
            
                                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Photo</th>
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
                                               
                                                    @foreach ($getUsers as $row)

                                                         @php
                                                            $status = '';

                                                            if ($row->status == 1) {
                                                                $status = 'checked';
                                                            } else {
                                                                $status = '';
                                                            }

                                                            $disabledBtn = '';

                                                            if ($currentUser->id == $row->id) {
                                                                $disabledBtn = 'disabled';
                                                            } else {
                                                                $disabledBtn = '';
                                                            }

                                                        @endphp
                                                        <tr>
                                                            <td>{{ $row->id }}</td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <img src="{{ url($row->getAdminImage()) }}" class="rounded-circle avatar-sm" alt="">
                                                                    <span class="ms-2"></span>
                                                                </div>
                                                            </td>
                                                            <td>{{ $row->fname .' '. $row->lname }}</td>
                                                            <td>{{ $row->email }}</td>
                                                            <td>{{ $row->user_code }}</td>
                                                            {{-- <td>{{ $row->role_name }}</td> --}}
                                                            <td>{{ $row->phone }}</td>
                                                            {{-- <td>{{ $row->chapter_name }}</td> --}}
                                                            <td>{{ date( 'D d M Y, h:i A', strtotime( $row->created_at )) }}</td>
                                                            <td>
                                                                <a href="avascript:void(0)" id="{{ $row->id }}" class="view_user_btn mx-2" title="View User"><i class="ri-eye-line" style="font-size: 20px;"></i></a>
                                                                <a href="avascript:void(0)" id="{{ $row->id }}" class="restore_user_btn mx-2" title="Restore User"><i class="ri-restart-line text-danger" style="font-size: 20px;"></i></a>
                                                                @if ($disabledBtn == 'disabled')
                                                                    
                                                                @else
                                                                    <a href="avascript:void(0)" id="{{ $row->id }}" class="perm_delete_user_btn mx-2" title="Delete User"><i class="ri-delete-bin-2-line text-danger" style="font-size: 20px;"></i></a>
                                                                @endif
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

        <script src="{{ url('public/assets/js/users.js') }}">></script>

        @endsection
