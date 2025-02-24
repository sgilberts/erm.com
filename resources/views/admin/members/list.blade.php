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
                                        <button id="add_members_btn" class="btn btn-primary add_members_btn" style="width: 100%">Add Member</button>
                                    </div>
                                </div>
 
                            @endif
                            
                            
                            {{-- Add New First Timers Start --}}
                            <div class="row">

                                <div class="col-xl-12" style="display: none;" id="add_members_div">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Add New Member</h4>
                                            <p class="card-title-desc">Provide valuable, information of the member.</p>
                                            <p class="text-danger" id="passError"></p>
                                            <form id="register-member-form" action="{{ url('add_members') }}" method="POST" class="needs-validation">

                                                {{ csrf_field() }}

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="fname" class="form-label">First Name</label>
                                                            <input type="text" name="fname" class="form-control" id="fname" required placeholder="First Name" autofocus>
                                                        </div>
                                                    </div>
    
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="lname" class="form-label">Last Name</label>
                                                            <input type="text" class="form-control" name="lname" required placeholder="Last Name" id="lname" >
                                                            
                                                        </div>
                                                    </div>
    
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="oname" class="form-label">Other Names</label>
                                                            <input type="text" class="form-control" name="oname" placeholder="Other Name" id="oname">
                                                            
                                                        </div>
                                                    </div>
                                                </div>
    
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="eamil" class="form-label">E-mail</label>
                                                            <input type="email" name="email" class="form-control" id="email" required placeholder="E-mail" >
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="gender" class="form-label">Gender</label>
                                                            <select class="form-select" name="gender" id="gender" required>
                                                                <option selected disabled value="">Choose Gender...</option>
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="dob" class="form-label">Birth Date</label>
                                                            <input class="form-control" type="date" name="dob" required placeholder="2011-08-19" id="dob">
                                                        </div>
                                                    </div>
                                                </div>
    
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="contact" class="form-label">Phone Number</label>
                                                            <input type="tel" name="contact" class="form-control" id="contact"
                                                                placeholder="Phone Number" >
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="gps" class="form-label">GPS Address</label>
                                                            <input type="text" name="gps" class="form-control" id="gps" placeholder="GPS Address" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="location" class="form-label">Residential Address</label>
                                                            <input class="form-control" type="text" name="location" required placeholder="Residential Address" id="location">
                                                        </div>
                                                    </div>
                                                </div>
    
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="baptized" class="form-label">Baptized?</label>
                                                            <select class="form-select" name="baptized" id="baptized">
                                                                <option selected disabled value="">Have you been baptized...</option>
                                                                <option value="Yes">Yes</option>
                                                                <option value="No">No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="bapDate" class="form-label">Baptism Date</label>
                                                            <input class="form-control" type="date" name="bapDate" placeholder="2011-08-19" id="bapDate">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="accept_jesus" class="form-label">Received Jesus?</label>
                                                            <select class="form-select" name="accept_jesus" id="accept_jesus" required>
                                                                <option selected disabled value="">Have you received? ...</option>
                                                                <option value="Yes">Yes</option>
                                                                <option value="No">No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>


                                         
                                                
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="recHolySpirit" class="form-label">Received Holy Spirit?</label>
                                                            <select class="form-select" name="recHolySpirit" id="recHolySpirit" required>
                                                                <option selected disabled value="">Have you received? ...</option>
                                                                <option value="Yes">Yes</option>
                                                                <option value="No">No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="nationality_select" class="form-label">Nationality</label>
                                                        <select class="form-select" name="nationality_id" id="nationality_select"  data-url="{{ url('admin/members/get_state_country') }}" >
                                                            <option selected disabled value="">Choose Your Country ...</option>

                                                            @foreach ($getCountry as $row)
                                                                <option value={{ $row->id }}>{{ $row->name }}</option>
                                                            @endforeach
                                                            
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="edit_region_name" class="form-label">Region</label>
    
                                                            <select class="form-select" id="state_id" name="state_id" required>
                                                                {{-- <input type="text" name="" value="{{ $getASubCat->id }}" id=""> --}}
                                                                <option selected disabled value="">Please select State ...</option>
                                        
                                                              </select>
                                                                
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-5">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="chapter_id" class="form-label">Chapter</label>
                                                            <select class="form-select" name="chapter_id" id="chapter_id">
                                                                <option selected disabled value="">Select Member Chapter...</option>

                                                                @foreach ($getChapter as $row)
                                                                   
                                                                    <option value="{{  $row->id }}">{{ $row->chapter_name ." has [ " .  $row->getManyChapter()->count() ." ] members." }}</option>
                                                       
                                                                 @endforeach

                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="branch_id" class="form-label">Branch</label>
                                                            <select class="form-select" name="branch_id" id="branch_id" required>
                                                                <option selected disabled value="">Select Branch ...</option>
                                                                @foreach ($getBranch as $row)
                                                                    <option value="{{  $row->id }}">{{  $row->branchName }}</option>
                                                                @endforeach
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
    
    
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-6">
                                                            <div>
                                                                <input id="registerMemBtn" class="btn btn-primary" type="submit" value="Add New Member" style="width: 100%;"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Add New Members End --}}


                            {{-- Edit Member Start --}}
                            <div class="row">

                                <div class="col-xl-12" style="display: none;" id="edit_members_div">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Update Member</h4>
                                            <p class="card-title-desc">Provide valuable, information of Member.</p>
                                            <p class="text-danger" id="passError"></p>
                                            <form id="edit-member-form" action="{{ url('update_member') }}" method="POST" class="needs-validation">

                                                {{ csrf_field() }}

                                                <input type="hidden" name="id" id="edit_member_id">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="edit_fname" class="form-label">First Name</label>
                                                        <input type="text" name="edit_fname" class="form-control" id="edit_fname" placeholder="First Name">
                                                        
                                                    </div>
                                                </div>
    
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="edit_lname" class="form-label">Last Name</label>
                                                        <input type="text" class="form-control" name="edit_lname" placeholder="Last Name" id="edit_lname" >
                                                        
                                                    </div>
                                                </div>
    
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="edit_other_names" class="form-label">Other Names</label>
                                                        <input type="text" class="form-control" name="edit_other_names" placeholder="Other Name" id="edit_other_names">
                                                        
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="edit_email" class="form-label">E-mail</label>
                                                        <input type="email" name="edit_email" class="form-control" placeholder="E-mail" id="edit_email" >
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="edit_gender" class="form-label">Gender</label>
                                                        <select class="form-select" name="edit_gender" id="edit_gender">
                                                            <option selected disabled value="">Choose Gender...</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="edit_bdate" class="form-label">Birth Date</label>
                                                        <input class="form-control" type="date" name="edit_bdate" placeholder="2011-08-19" id="edit_bdate">
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="edit_phone" class="form-label">Phone Number</label>
                                                        <input type="tel" name="edit_phone" class="form-control" id="edit_phone"
                                                            placeholder="Phone Number" >
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="edit_gps" class="form-label">GPS Address</label>
                                                        <input type="text" name="edit_gps" class="form-control" id="edit_gps"
                                                           placeholder="GPS Address" >
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="edit_location" class="form-label">Residential Address</label>
                                                        <input class="form-control" type="text" name="edit_location" placeholder="Residential Address" id="edit_location">
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="edit_baptized" class="form-label">Baptized?</label>
                                                        <select class="form-select" name="edit_baptized" id="edit_baptized">
                                                            <option selected disabled value="">Have you been baptized...</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="edit_bap_date" class="form-label">Baptism Date</label>
                                                        <input class="form-control" type="date" name="edit_bap_date" placeholder="2011-08-19" id="edit_bap_date">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="edit_accept_jesus" class="form-label">Received Jesus?</label>
                                                        <select class="form-select" name="edit_accept_jesus" id="edit_accept_jesus">
                                                            <option selected disabled value="">Have you received? ...</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
    
                                            
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="edit_holy_spirit" class="form-label">Received Holy Spirit?</label>
                                                        <select class="form-select" name="edit_holy_spirit" id="edit_holy_spirit">
                                                            <option selected disabled value="">Have you received? ...</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    </div>
                                                </div>
    
                                                <div class="col-md-4">
    
                                                     <div class="mb-3">
                                                        <label for="edit_branch_name" class="form-label">Branch</label>
                                                        <select class="form-select" name="edit_branch_name" id="edit_branch_name">
                                                            @foreach ($getBranch as $row)
                                                                <option value="{{  $row->id }}">{{  $row->branchName }}</option>
                                                            @endforeach
                                                            
                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="edit_chapter" class="form-label">Chapter Name</label>
                                                        <select class="form-select" name="edit_chapter" id="edit_chapter">
                                                            @foreach ($getChapter as $row)
                                                            <option value="{{  $row->id }}">{{ $row->chapter_name ." has [ " .  $row->getManyChapter()->count() ." ] members." }}</option>
                                                            @endforeach
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
    
    
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="nationality_select" class="form-label">Nationality</label>
                                                        <select class="form-select nationality_select" name="edit_nationality_id" id="edit_nationality_select"  data-url="{{ url('admin/members/get_state_country') }}" >
                                                            <option selected disabled value="">Choose Your Country ...</option>

                                                            @foreach ($getCountry as $row)
                                                                <option value={{ $row->id }}>{{ $row->name }}</option>
                                                            @endforeach
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="edit_region_name" class="form-label">Region</label>

                                                        <select class="form-select" id="edit_state_id" name="edit_state_id">
                                                            {{-- <input type="text" name="" value="{{ $getASubCat->id }}" id=""> --}}
                                                            <option selected disabled value="">Please select state ...</option>
                                    
                                                          </select>
                                                            
                                                    </div>
                                                </div>
                                            </div>
    
                                            {{-- <div class="row mb-5">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="chapter_id" class="form-label">Chapter</label>
                                                        <select class="form-select" name="chapter_id" id="edit_chapter_id">
                                                            <option selected disabled value="">Select Member Chapter...</option>

                                                            @foreach ($getChapter as $row)
                                                               
                                                                <option value="{{  $row->id }}">{{ $row->chapter_name ." has [ " .  $row->getManyChapter()->count() ." ] members." }}</option>
                                                   
                                                             @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                            </div> --}}


                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-6">
                                                        <div>
                                                            <input id="updateMemBtn" class="btn btn-primary" type="submit" value="Update Member" style="width: 100%;"/>
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
            

                                            <h3 class="card-title">Church Members</h3>

                                            <div class="btn-toolbar p-3" role="toolbar">
                                                <div class="btn-group me-2 mb-2 mb-sm-0">
                                                    <button type="button" class="btn btn-primary waves-light waves-effect"><i class="fa fa-inbox"></i></button>
                                                    <button type="button" class="btn btn-primary waves-light waves-effect"><i class="fa fa-exclamation-circle"></i></button>
                                                    <button type="button" class="btn btn-danger waves-light waves-effect del_sel_form" title="Delete Church Members"><i class="far fa-trash-alt"></i></button>
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
                                              
                                                {{-- <div class="col-md-8 selectedDiv"> --}}
                                                <thead>
                                                <tr>
                                                    <th>
                                                        <input type="checkbox" data-val="0" class="form-check-input largerCheckbox" id="chkAll" />
                                                    </th>
                                                    <th>ID</th>
                                                    <th>Photo</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Status</th>
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
                                                            <td>
                                                                <div class="d-flex align-items-center btn-group">
                                                                    <img src="{{ url($row->getMemberImage()) }}" class="rounded-circle avatar-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" alt="">
                                                                    <span class="ms-2"></span>
                                                                    <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1">
                                                                        <a id="{{ $row->id }}" class="dropdown-item edit_member_image" href="#"><i class="ri-camera-line"></i> Update Image</a>
                                                                        {{-- <a class="dropdown-item" href="#">Do link</a> --}}
                                                                    </div>
                                                                    
                                                                </div>

                                                            </td>
                                                            <td>{{ $row->first_name .' '. $row->other_names .' '. $row->last_name }}</td>
                                                            <td>{{ $row->email }}</td>
                                                            <td>{{ $row->contact }}</td>
                                                            <td>
                                                                @php
                                                                    $status = '';
        
                                                                    if ($row->status == 1) {
                                                                        $status = 'checked';
                                                                    } else {
                                                                        $status = '';
                                                                    }

                                                                @endphp
                    
                                                            <input type="checkbox" id="switch{{ $row->id }}" data-member_id="{{ $row->id }}" class="change_member_status" switch="info"  {{ $status }} />
                                                            <label for="switch{{ $row->id }}" data-on-label="On" data-off-label="Off"></label>
        
                                                            </td>
                                                            <td>{{ \Carbon\Carbon::parse($row->updated_at)->diffForHumans() }}</td>
                                                            <td>{{ $row->created_by_fname .' '.$row->created_by_lname }}</td>
                                                            <td>
                                                                <a href="avascript:void(0)" id="{{ $row->id }}" class="view_members_btn mx-2" title="View Member"><i class="ri-eye-line" style="font-size: 20px;"></i></a>
                                                                @if (Auth::user()->verified == 1)

                                                                    <a href="javascript:void(0)" id="{{ $row->id }}" class="edit_members_btn mx-2" title="Edit Member"><i class="ri-edit-line text-success" style="font-size: 20px;"></i></a>
                                                                    <a href="javascript:void(0)" id="{{ $row->id }}" class="reset_member_password_btn mx-2" title="Reset Member Password"><i class="ri-restart-line text-warning" style="font-size: 20px;"></i></a>
                                                                    
                                                                    <a href="javascript:void(0)" id="{{ $row->id }}" class="delete_members_btn mx-2" title="Delete Member"><i class="ri-delete-bin-6-line text-danger" style="font-size: 20px;"></i></a>
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

        <script src="{{ url('public/assets/js/members.js') }}">></script>

        @endsection

