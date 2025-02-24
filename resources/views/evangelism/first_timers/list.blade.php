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
                                        <button id="add_first_timer_btn" class="btn btn-primary add_first_timer_btn" style="width: 100%">Add First Timer</button>
                                    </div>
                                </div>
                            @endif
                            

                            {{-- Add New First Timers Start --}}
                            <div class="row">

                                <div class="col-xl-12" style="display: none;" id="add_first_timers_div">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Add First Timers</h4>
                                            <p class="card-title-desc">Provide valuable, information of the first timers.</p>
                                            <p class="text-danger" id="passError"></p>
                                            <form action="{{ url('add_first_timer') }}" method="POST" class="needs-validation">
                                                
                                                {{ csrf_field() }}
    
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="first_name" class="form-label">First Name</label>
                                                            <input type="text" name="first_name" class="form-control" required placeholder="First Name">
                                                            
                                                        </div>
                                                    </div>
        
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="last_name" class="form-label">Last Name</label>
                                                            <input type="text" class="form-control" name="last_name" required placeholder="Last Name" id="last_name" >
                                                            
                                                        </div>
                                                    </div>
        
                                                </div>
        
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="eamil" class="form-label">E-mail</label>
                                                            <input type="email" name="email" class="form-control" id="email" placeholder="E-mail" >
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="gender" class="form-label">Gender</label>
                                                            <select class="form-select" name="gender" id="gender" required>
                                                                <option selected disabled value="">Choose Gender...</option>
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
        
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="cell_number" class="form-label">Phone Number</label>
                                                            <input type="tel" name="cell_number" class="form-control" id="cell_number" placeholder="Phone Number" >
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="ft_location"  class="form-label">Residential Address</label>
                                                            <input class="form-control" type="text" name="ft_location" required placeholder="Residential Address" id="ft_location" >
                                                        </div>
                                                    </div>
                                                </div>
        
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="ft_interest" class="form-label">Interest</label>
                                                            <select class="form-select" name="ft_interest" id="ft_interest">
                                                                <option selected disabled value="">What Is Your Interest...</option>
                                                                <option value="Visitor">Visitor</option>
                                                                <option value="Regular">Regular</option>
                                                                <option value="Member">Member</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="ft_accept_jesus" class="form-label">Received Jesus?</label>
                                                            <select class="form-select" name="ft_accept_jesus" id="ft_accept_jesus">
                                                                <option selected disabled value="">Have you received? ...</option>
                                                                <option value="Yes">Yes</option>
                                                                <option value="No">No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
        
                                                
                                                <div class="row mb-5">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="ft_rec_holy" class="form-label">Received Holy Spirit?</label>
                                                            <select class="form-select" name="ft_rec_holy" id="ft_rec_holy">
                                                                <option selected disabled value="">Have you received? ...</option>
                                                                <option value="Yes">Yes</option>
                                                                <option value="No">No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="branch_name" class="form-label">Branch</label>
                                                            <select class="form-select" name="branch_id" id="branch_name">
                                                                <option selected disabled value="">Choose Branch...</option>

                                                                @foreach ($getBranch as $row)
                                                                    <option value="{{ $row->id }}">{{ $row->branchName }}</option>
                                                                @endforeach
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
        
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-6">
                                                            <div>
                                                                <input id="registerftBtn" class="btn btn-primary" type="submit" value="Add New First Timer" style="width: 100%;"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Add New First Timers End --}}


                            {{-- Edit First Timer Start --}}
                            <div class="row">

                                <div class="col-xl-12" style="display: none;" id="edit_first_timers_div">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Update First Timers</h4>
                                            <p class="card-title-desc">Provide valuable, information of first timers.</p>
                                            
                                            <form action="{{ url('update_first_timer') }}" method="POST" class="needs-validation">
                                                
                                                {{ csrf_field() }}
    
                                            <input type="hidden" name="id" id="edit_ft_id">
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="edit_fname" class="form-label">First Name</label>
                                                        <input type="text" name="fname" class="form-control" id="edit_fname">
                                                        
                                                    </div>
                                                </div>
    
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="edit_lname" class="form-label">Last Name</label>
                                                        <input type="text" class="form-control" name="lname" id="edit_lname" >
                                                        
                                                    </div>
                                                </div>
    
                                            </div>
    
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="edit_email" class="form-label">E-mail</label>
                                                        <input type="email" name="email" class="form-control" id="edit_email">
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="edit_gender" class="form-label">Gender</label>
                                                        <select class="form-select" name="gender" id="edit_gender">
                                                            <option selected disabled value="">Choose Gender...</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="edit_phone" class="form-label">Phone Number</label>
                                                        <input type="tel" name="phone" class="form-control" id="edit_phone">
                                                        
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="edit_location"  class="form-label">Residential Address</label>
                                                        <input class="form-control" type="text" name="location" id="edit_location" >
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="edit_ft_interest" class="form-label">Interest</label>
                                                        <select class="form-select" name="ft_interest" id="edit_ft_interest">
                                                            <option selected disabled value="">What Is Your Interest...</option>
                                                            <option value="Visitor">Visitor</option>
                                                            <option value="Regular">Regular</option>
                                                            <option value="Member">Member</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="edit_ft_accept_jesus" class="form-label">Received Jesus?</label>
                                                        <select class="form-select" name="ft_accept_jesus" id="edit_ft_accept_jesus">
                                                            <option selected disabled value="">Have you received? ...</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
    
                                            
                                            <div class="row mb-5">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="edit_ft_rec_holy" class="form-label">Received Holy Spirit?</label>
                                                        <select class="form-select" name="ft_rec_holy" id="edit_ft_rec_holy">
                                                            <option selected disabled value="">Have you received? ...</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="edit_branch_name" class="form-label">Branch</label>
                                                        <select class="form-select" name="branch_id" id="edit_branch_name">
                                                            <option selected disabled value="">Choose Branch...</option>

                                                            @foreach ($getBranch as $row)
                                                                <option value="{{ $row->id }}">{{ $row->branchName }}</option>
                                                            @endforeach
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-6">
                                                        <div>
                                                            <input id="updateftBtn" class="btn btn-primary" type="submit" value="Update First Timer" style="width: 100%;"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                                                         
                                        </div>
                                    </div>
                                </div>

                            </div>
                            {{-- Edit User End --}}

                            <div class="row">
                                <div class="col-xl--12">
                                    <div class="card">
                                        <div class="card-body">
            

                                            <h3 class="card-title">First Timers</h3>

                                            <div class="btn-toolbar p-3" role="toolbar">
                                                <div class="btn-group me-2 mb-2 mb-sm-0">
                                                    <button type="button" class="btn btn-primary waves-light waves-effect"><i class="fa fa-inbox"></i></button>
                                                    <button type="button" class="btn btn-primary waves-light waves-effect"><i class="fa fa-exclamation-circle"></i></button>
                                                    <button type="button" class="btn btn-danger waves-light waves-effect del_sel_form" title="Delete First Timers"><i class="far fa-trash-alt"></i></button>
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
                                                    <th>Phone</th>
                                                    <th>Last Updated</th>
                                                    <th>Created By</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
            
            
                                                <tbody>
                                                    @foreach ($getRecord as $row)

                                                        <tr>
                                                            <td>
                                                                <input type='checkbox' value="{{ $row->id }}" data-val="0"  data-id="{{ $row->id }}" class="form-check-input largerCheckbox tblChk chooseItem" />
                                                            </td>
                                                            <td>{{ $row->id }}</td>
                                                            
                                                            <td>{{ $row->last_name .' '. $row->first_name }}</td>
                                                            <td>{{ $row->email }}</td>
                                                            <td>{{ $row->cell_number }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($row->updated_at)->diffForHumans() }}</td>
                                                            <td>{{ $row->created_by_fname .' '.$row->created_by_lname }}</td>
                                                            <td>
                                                                <a href="javascript:void(0)" id="{{ $row->id }}" class="view_first_timer_btn mx-2" title="View First Timer"><i class="ri-eye-line" style="font-size: 20px;"></i></a>
                                                                
                                                                @if (Auth::user()->verified == 1)
                                                                    <a href="javascript:void(0)" id="{{ $row->id }}" class="edit_first_timer_btn mx-2" title="Edit First Timer"><i class="ri-edit-line text-success" style="font-size: 20px;"></i></a>
                                                                
                                                                    <a href="javascript:void(0)" id="{{ $row->id }}" class="delete_first_timer_btn mx-2" title="Delete First Timer"><i class="ri-delete-bin-6-line text-danger" style="font-size: 20px;"></i></a>
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

        <script src="{{ url('public/assets/js/first_timers.js') }}">></script>

        @endsection

