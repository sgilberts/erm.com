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
                                        <button id="add_user_btn" class="btn btn-primary add_user_btn" style="width: 100%">Add User</button>
                                    </div>
                                </div>
                            @endif
                            

                            {{-- Add New User Start --}}
                            <div class="row">

                                <div class="col-xl-12" style="display: none;" id="add_user_div">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Add New User Account</h4>
                                            <p class="card-title-desc">Provide valuable, information of user.</p>
                                            <p class="text-danger" id="passError"></p>
                                            <form action="{{ url('add_user') }}" method="POST" class="needs-validation">
                                                
                                                 {{ csrf_field() }}
    
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="fname" class="form-label">First name</label>
                                                            <input type="text" name="fname" class="form-control" id="fname" placeholder="First name" required>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="validationCustom02" class="form-label">Last name</label>
                                                            <input type="text" class="form-control" name="lname" placeholder="Last Name" id="lname" >
                                                            
                                                        </div>
                                                    </div>
                                                </div>
        
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="username" class="form-label">Username</label>
                                                            <input type="text" name="username" class="form-control" id="username" placeholder="Username" >
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="eamil" class="form-label">E-mail</label>
                                                            <input type="email" name="email" class="form-control" placeholder="E-mail" id="email" required>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
        
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="password" class="form-label">Password</label>
                                                            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="cpassword" class="form-label">Confirm Password</label>
                                                            <input type="password" name="cpassword" class="form-control" id="cpassword" placeholder="Confirm Password"  required>
                                                            <div id="validate_form"></div>
                                                        </div>
                                                    </div>
                                                </div>
        
                                                
                                                <div class="row">
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
                                                    <div class="col-md-6">
                                                        <label for="user_role" class="form-label">User Role</label>
                                                        <select class="form-select" name="user_role" id="user_role" required>
                                                            <option selected disabled value="">Choose User Role...</option>

                                                            @foreach ($getUserRole as $row)

                                                                <option value="{{ $row->id }}">{{ $row->role_name }}</option>
                                                           
                                                            @endforeach
                                                           
                                                        </select>
        
                                                    </div>
                                                    
                                                </div>

                                                <div class="row mb-4">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="chapter_role" class="form-label">Chapter Role</label>
                                                            <select class="form-select" name="chapter_role" required>
                                                                <option value="" selected disabled>Select Chapter Role ...</option>
                                                                <option value="Leader">Leader</option>
                                                                <option value="Assistant">Assistant</option>
                                                            </select>
                                                            <div class="invalid-feedback">
        
                                                            </div>
        
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
    
                                                        <div class="mb-3">
                                                            <label for="chapter_id" class="form-label">Chapter Name</label>
                                                            <select class="form-select" name="chapter_id" id="chapter_id" required>
                                                                <option value="" selected disabled>Select Chapter ...</option>

                                                                @foreach ($getUserChapter as $row)
                                                                    <option value="{{ $row->id }}">{{ $row->chapter_name }}</option>
                                                                @endforeach
                                                                
                                                            </select>
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                </div>


                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-6">
                                                            <div>
                                                                <input id="register-btn" class="btn btn-primary" type="submit" value="Add New User" style="width: 100%;"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Add New User End --}}


                            {{-- Edit User Start --}}
                            <div class="row">

                                <div class="col-xl-12" style="display: none;" id="edit_user_div">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Update User Account</h4>
                                            <p class="card-title-desc">Provide valuable, information of user.</p>
                                            <p class="text-danger" id="passError"></p>
                                            <form action="{{ url('update_user')}}" method="POST" id="edit-user-form" class="needs-validation">
                                                
                                                {{ csrf_field() }}
    
                                                <input type="hidden" name="id" id="id">
                                                <div class="row">

                                                    <input type="hidden" name="id" id="edit_user_id">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="edit_fname" class="form-label">First name</label>
                                                            <input type="text" name="edit_fname" class="form-control" id="edit_fname" >
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="edit_lname" class="form-label">Last name</label>
                                                            <input type="text" class="form-control" name="edit_lname" id="edit_lname" >
                                                            
                                                        </div>
                                                    </div>
                                                </div>
    
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="edit_username" class="form-label">Username</label>
                                                            <input type="text" name="edit_username" class="form-control" id="edit_username" >
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="edit_email" class="form-label">E-mail</label>
                                                            <input type="email" name="edit_email" id="edit_email" class="form-control" >
                                                            
                                                        </div>
                                                    </div>
                                                </div>
    
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="edit_phone" class="form-label">Phone</label>
                                                            <input type="tel" name="edit_phone" class="form-control" id="edit_phone" >
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="edit_user_role" class="form-label">User Role</label>

                                                            <select class="form-select" name="user_role" id="edit_user_role" >
                                                                
                                                                @foreach ($getUserRole as $row)
                                                                    <option value="{{ $row->id }}">{{ $row->role_name }}</option>
                                                                @endforeach
                                                                
                                                            </select>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
    
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="edit_gender" class="form-label">Gender</label>
                                                            <select class="form-select" name="edit_gender" id="edit_gender" >
                                                                <option selected disabled value="">Choose Gender...</option>
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
    
                                                        <div class="mb-3">
                                                            <label for="edit_chapter_id" class="form-label">Chapter Name</label>
                                                            <select class="form-select" name="edit_chapter" id="edit_chapter_id" >
                                                                
                                                                @foreach ($getUserChapter as $row)
                                                                    <option value="{{ $row->id }}">{{ $row->chapter_name }}</option>
                                                                @endforeach
                                                                
                                                            </select>
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                </div>
    
    
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="chapter_role" class="form-label">Chapter Role</label>
                                                        <select class="form-select" name="chapter_role" id="edit_chapter_role" required>
                                                            <option value="Leader">Leader</option>
                                                            <option value="Assistant">Assistant</option>
                                                        </select>
                                                        <div class="invalid-feedback">
    
                                                        </div>
    
                                                    </div>
                                                </div>
                                                
                                                
                                            </div>
    
    
    
                                                <div class="row p-xl-4">
                                                    <div class="col-md-12">
                                                        <div class="mb-6">
                                                            <label for="edit_about_user">About Admin User</label>
                                                            <div>
                                                                <textarea class="form-control" rows="5" name="about_user" id="edit_about_user">
    
                                                                </textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-6">
                                                            <div>
                                                                <input id="updateUserBtn" class="btn btn-primary" type="submit" value="Update User" style="width: 100%;"/>
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
            
                                            <h4 class="card-title">Buttons Example</h4>
                                            
                                            {{-- <div id="myTimer">

                                                Current time: {{ now() }}
                                            
                                            </div> --}}
                                            
                                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Photo</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Chapter</th>
                                                    <th>Online</th>
                                                    <th>Status</th>
                                                    <th>Last Seen</th>
                                                    <th>Created On</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
            
            
                                                <tbody>
                                               
                                                    @foreach ($getUsers as $row)
                                                        <tr>
                                                            <td>{{ $row->id }}</td>
                                                            <td>
                                                                <div class="d-flex align-items-center btn-group">
                                                                    <img src="{{ url($row->getAdminImage()) }}" class="rounded-circle avatar-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" alt="">
                                                                    <span class="ms-2"></span>
                                                                    <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1">
                                                                        <a id="{{ $row->id }}" class="dropdown-item edit_image" href="#"><i class="ri-camera-line"></i> Update Image</a>
                                                                        {{-- <a class="dropdown-item" href="#">Do link</a> --}}
                                                                    </div>
                                                                    
                                                                </div>

                                                            </td>
                                                            <td>{{ $row->fname .' '. $row->lname }}</td>
                                                            <td>{{ $row->email }}</td>
                                                            {{-- <td>{{ $row->role_name }}</td> --}}
                                                            <td>{{ $row->phone }}</td>
                                                            <td>{{ $row->chapter_name }}</td>
                                                           
                                                            <td>
                                                                @if($row->isOnline())
                                                                <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-16 text-success"></i> <span id="myTDOnline" class="badge bg-success">Online</span></span>
                                                                @else
                                                                <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-16 text-danger"></i> <span id="myTDOffline" class="badge bg-danger">Offline</span></span>
                                                                @endif
                                                                
                                                            </td>
                                                        
                                                            <td>
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
                    
                                                            <input type="checkbox" id="switch{{ $row->id }}" data-user_id="{{ $row->id }}" class="change_user_status" switch="info"  {{ $status }} {{ $disabledBtn }} />
                                                            <label for="switch{{ $row->id }}" data-on-label="On" data-off-label="Off"></label>
        
                                                            </td>
                                                            <td>{{ \Carbon\Carbon::parse($row->last_seen)->diffForHumans() }}</td>
                                                            <td>{{ date( 'D d M Y, h:i A', strtotime( $row->created_at )) }}</td>
                                                            <td>
                                                                <a href="javascript:void(0)" id="{{ $row->id }}" class="view_user_btn mx-2" title="View User"><i class="ri-eye-line" style="font-size: 20px;"></i></a>
                                                                @if (Auth::user()->verified == 1)
                                                                    <a href="javascript:void(0)" id="{{ $row->id }}" class="edit_user_btn mx-2" title="Edit User"><i class="ri-edit-line text-success" style="font-size: 20px;"></i></a>
                                                                    <a href="javascript:void(0)" id="{{ $row->id }}" class="reset_user_password_btn mx-2" title="Reset User Password"><i class="ri-restart-line text-warning" style="font-size: 20px;"></i></a>

                                                                    @if ($disabledBtn == 'disabled')
                                                                        
                                                                    @else
                                                                        
                                                                            <a href="javascript:void(0)" id="{{ $row->id }}" class="delete_user_password_btn mx-2" title="Delete User"><i class="ri-delete-bin-6-line text-danger" style="font-size: 20px;"></i></a>
                                                                    
                                                                        
                                                                    @endif
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

        <script src="{{ url('public/assets/js/users.js') }}">></script>

        @endsection
