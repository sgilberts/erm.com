@extends('admin.layouts.app')

@section('style')
    <!-- jquery.vectormap css -->
    <link href="{{ url('public/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />

    <!-- DataTables -->
    <link href="{{ url('public/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- DataTables -->
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
        

                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-truncate font-size-14 mb-2">Total Admin Users</p>
                                                <h4 class="mb-2" id="total_admin_users">{{ $getRecord->get()->count() }}</h4>
                                                <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>9.23%</span>from previous period</p>
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-primary rounded-3">
                                                    <i class="ri-shopping-cart-2-line font-size-24"></i>  
                                                </span>
                                            </div>
                                        </div>                                            
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-truncate font-size-14 mb-2">Activated Account Users</p>
                                                <h4 class="mb-2" id="total_activated_accounts">{{ $getRecord->where('status', '=', 1)->get()->count() }}</h4>
                                                <p class="text-muted mb-0"><span class="text-danger fw-bold font-size-12 me-2"><i class="ri-arrow-right-down-line me-1 align-middle"></i>1.09%</span>from previous period</p>
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-success rounded-3">
                                                    <i class="mdi mdi-currency-usd font-size-24"></i>  
                                                </span>
                                            </div>
                                        </div>                                              
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-truncate font-size-14 mb-2">Deactivated Account Users</p>
                                                <h4 class="mb-2" id="total_de_activated_accounts">{{ $getRecord->where('status', '=', 0)->get()->count() }}</h4>
                                                <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>16.2%</span>from previous period</p>
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-primary rounded-3">
                                                    <i class="ri-user-3-line font-size-24"></i>  
                                                </span>
                                            </div>
                                        </div>                                              
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-truncate font-size-14 mb-2">Verified Users</p>
                                                <h4 class="mb-2" id="verified_users">{{ $getRecord->where('verified', '=', 1)->get()->count() }}</h4>
                                                <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>11.7%</span>from previous period</p>
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-success rounded-3">
                                                    <i class="mdi mdi-currency-btc font-size-24"></i>  
                                                </span>
                                            </div>
                                        </div>                                              
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        </div><!-- end row -->

                        
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-truncate font-size-14 mb-2">Unverfied Account Users</p>
                                                <h4 class="mb-2" id="un_verified_users">{{ $getRecord->where('verified', '=', 0)->get()->count() }}</h4>
                                                <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>9.23%</span>from previous period</p>
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-primary rounded-3">
                                                    <i class="ri-shopping-cart-2-line font-size-24"></i>  
                                                </span>
                                            </div>
                                        </div>                                            
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-truncate font-size-14 mb-2">Website Hits</p>
                                                <h4 class="mb-2">{{ $getRecord->where('status', '=', 1)->get()->count() }}</h4>
                                                <p class="text-muted mb-0"><span class="text-danger fw-bold font-size-12 me-2"><i class="ri-arrow-right-down-line me-1 align-middle"></i>1.09%</span>from previous period</p>
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-success rounded-3">
                                                    <i class="mdi mdi-currency-usd font-size-24"></i>  
                                                </span>
                                            </div>
                                        </div>                                              
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-truncate font-size-14 mb-2">Prayer Requests</p>
                                                <h4 class="mb-2">{{ $getRecord->where('status', '=', 0)->get()->count() }}</h4>
                                                <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>16.2%</span>from previous period</p>
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-primary rounded-3">
                                                    <i class="ri-user-3-line font-size-24"></i>  
                                                </span>
                                            </div>
                                        </div>                                              
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-truncate font-size-14 mb-2">Total Notifications</p>
                                                <h4 class="mb-2">{{ $getRecord->where('verified', '=', 1)->get()->count() }}</h4>
                                                <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>11.7%</span>from previous period</p>
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-success rounded-3">
                                                    <i class="mdi mdi-currency-btc font-size-24"></i>  
                                                </span>
                                            </div>
                                        </div>                                              
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        </div><!-- end row -->


                         
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-truncate font-size-14 mb-2">Total Members</p>
                                                <h4 class="mb-2" id="total_members">{{ $getRecord->where('verified', '=', 0)->get()->count() }}</h4>
                                                <p class="text-muted mb-0" id="total_members_percentage"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>9.23%</span>from previous period</p>
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-primary rounded-3">
                                                    <i class="ri-shopping-cart-2-line font-size-24"></i>  
                                                </span>
                                            </div>
                                        </div>                                            
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-truncate font-size-14 mb-2">Total First Timers (This Year)</p>
                                                <h4 class="mb-2" id="total_ft">{{ $getRecord->where('status', '=', 1)->get()->count() }}</h4>
                                                <p class="text-muted mb-0" id="total_ft_percentage"><span class="text-danger fw-bold font-size-12 me-2"><i class="ri-arrow-right-down-line me-1 align-middle"></i>1.09%</span> from previous period</p>
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-success rounded-3">
                                                    <i class="mdi mdi-currency-usd font-size-24"></i>  
                                                </span>
                                            </div>
                                        </div>                                              
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-truncate font-size-14 mb-2">Total Attendance (Resent)</p>
                                                <h4 class="mb-2" id="total_attendance">{{ $getRecord->where('status', '=', 0)->get()->count() }}</h4>
                                                <p class="text-muted mb-0" id="total_attendance_percentage"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>16.2%</span>from previous period</p>
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-primary rounded-3">
                                                    <i class="ri-user-3-line font-size-24"></i>  
                                                </span>
                                            </div>
                                        </div>                                              
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-truncate font-size-14 mb-2">Attendance FT</p>
                                                <h4 class="mb-2" id="total_att_ft">{{ $getRecord->where('verified', '=', 1)->get()->count() }}</h4>
                                                <p class="text-muted mb-0" id="total_att_ft_percentage"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>11.7%</span>from previous period</p>
                                            </div>
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-success rounded-3">
                                                    <i class="mdi mdi-currency-btc font-size-24"></i>  
                                                </span>
                                            </div>
                                        </div>                                              
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        </div><!-- end row -->


                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body pb-0">

                                        <div class="float-end d-none d-md-inline-block">
                                            {{-- <div class="dropdown">
                                                <a class="text-reset" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="text-muted">This Years<i class="mdi mdi-chevron-down ms-1"></i></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end"> --}}
                                                    <select  class="dropdown text-reset px-2 filterChartYear" name="filterChartYear" id="filterChartYear">
                                                        <option class="px-2" value="" disabled>This Year</option>
                                                        @foreach ($getAttChartYears as $row)
                                                        <option class="px-2" value="{{ $row->year }}">{{ $row->year }}</option>
                                                        {{-- <a class="dropdown-item filterChartYear" id="{{ $row->year }}" href="javascript:void(0);">{{ $row->year }}</a> --}}
                                                        @endforeach
                                                    </select>
                                                    {{-- <a class="dropdown-item" href="{{ url('todayChart') }}">Today</a>
                                                    <a class="dropdown-item" href="#">Last Week</a>
                                                    <a class="dropdown-item" href="#">Last Month</a>
                                                    <a class="dropdown-item" href="#">This Year</a> --}}
                                                {{-- </div>
                                            </div> --}}

                                        </div>

                                        <div class="float-end d-none d-md-inline-block mx-3">
                                        
                                            {{-- <div class="dropdown">
                                                <a class="text-reset" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="text-muted">Month <i class="mdi mdi-chevron-down ms-1"></i></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end"> --}}
                                                    
                                                    <select  class="dropdown text-reset px- month_chart" name="month_chart" id="month_chart">
                                                        {{-- <option value="Yearly">Yearly</option>
                                                        <option value="Monthly">Monthly</option>
                                                        <option value="Weekly">Weekly</option>
                                                        <option value="Daily">Daily</option> --}}
                                                        <option class="px-2" value="" selected>Month</option>
                                                        
                                                    @php

                                                        $monthArray = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
                                                        $arrlength=count($monthArray);
                                                
                                                        for ($i=0; $i < $arrlength ; $i++) { 
                                                        
                                                            echo '<option class="px-2" value="'.($i+1).'">'.$monthArray[$i].'</option>';
                                                            // echo '<a class="dropdown-item" id="'.$i.'" href="javascript:void(0);">'.$monthArray[$i].'</a>';

                                                        //     // $yearArray = $mee-$i;
                                                        }

                                                    @endphp
                                                    </select>
                                                    {{-- @foreach ($monthArray as $row)
                                                        <a class="dropdown-item" href="#">{{ $row }}</a>
                                                    @endforeach --}}
                                                    {{-- <a class="dropdown-item" href="{{ url('todayChart') }}">{{ $mee }}</a>
                                                    {{-- <a class="dropdown-item" href="#">Last Week</a> --}}
                                                    {{-- <a class="dropdown-item" href="#">Last Month</a> --}}
                                                    {{-- <a class="dropdown-item" href="#">This Year</a> --}}
                                                {{-- </div>
                                            </div> --}}
                                        </div>

                                        <div class="float-end d-none d-md-inline-block">
                                        
                                            {{-- <div class="dropdown"> --}}
                                                {{-- <a class="text-reset" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="text-muted">Month <i class="mdi mdi-chevron-down ms-1"></i></span>
                                                </a> --}}
                                                {{-- <div class="dropdown-menu dropdown-menu-end"> --}}
                                                    <select  class="dropdown text-reset px-2 period_chart" name="period_chart" id="period_chart">
                                                        <option class="px-2" value="" selected>Period</option>
                                                        <option value="YEAR">Yearly</option>
                                                        <option value="MONTH">Monthly</option>
                                                        <option value="WEEK">Weekly</option>
                                                        <option value="DAY">Daily</option>
                                                    </select>
                                                    {{-- <a class="dropdown-item" href="javascript:void(0);">Yearly</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Monthly</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Weekly</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Daily</a> --}}
                                                    {{-- <a class="dropdown-item" href="#">This Year</a> --}}
                                                {{-- </div> --}}
                                            {{-- </div> --}}
                                        </div>


                                        {{-- <button type="button" class="btn btn-primary mybtn">Trying Me</button> --}}
                                        <h4 class="card-title mb-4">Revenue</h4>

                                        <div class="text-center pt-3">
                                            <div class="row">
                                                
                                            </div><!-- end row -->
                                        </div>
                                    </div>
                                    <div class="card-body py-0 px-2">
                                        <div id="column_line_chart" class="apex-charts" dir="ltr"></div>
                                    </div>
                                </div><!-- end card -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-6">
    
                                <div class="card">
                                    <div class="card-body pb-0">
                                        <div class="float-end d-none d-md-inline-block">
                                            <div class="dropdown card-header-dropdown">
                                                <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="text-muted">Report<i class="mdi mdi-chevron-down ms-1"></i></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Export</a>
                                                    <a class="dropdown-item" href="#">Import</a>
                                                    <a class="dropdown-item" href="#">Download Report</a>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="card-title mb-4">Email Sent</h4>

                                        <div class="text-center pt-3">
                                            <div class="row">
                                                
                                            </div><!-- end row -->
                                        </div>
                                    </div>
                                    <div class="card-body py-0 px-2">
                                        <div id="area_chart" class="apex-charts" dir="ltr"></div>
                                    </div>
                                </div><!-- end card -->
                            </div>

                            
                            <!-- end col -->
                            <div class="col-xl-6">
    
                                <div class="card">
                                    <div class="card-body pb-0">
                                        <div class="float-end d-none d-md-inline-block">
                                            <div class="dropdown card-header-dropdown">
                                                <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="text-muted">Report<i class="mdi mdi-chevron-down ms-1"></i></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Export</a>
                                                    <a class="dropdown-item" href="#">Import</a>
                                                    <a class="dropdown-item" href="#">Download Report</a>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="card-title mb-4">Email Sent</h4>

                                        <div class="text-center pt-3">
                                            <div class="row">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body py-0 px-2">
                                        <div id="area_chart_total_avg" class="apex-charts" dir="ltr"></div>
                                    </div>
                                </div><!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
    
                        <div class="row">
                            <div class="col-xl-6 my-4">
                                {{-- 
                                    <div class="dropdown float-end">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                        </div>
                                    </div> --}}
    
                                <h4 class="card-title mb-4">Current Birthdays</h4>

                                @include('admin.dashboard._birthday')
                                        
                            </div>
                            <!-- end col -->
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <select class="form-select shadow-none form-select-sm">
                                                <option selected>Apr</option>
                                                <option value="1">Mar</option>
                                                <option value="2">Feb</option>
                                                <option value="3">Jan</option>
                                            </select>
                                        </div>
                                        <h4 class="card-title mb-4">Monthly Earnings</h4>
                                        
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="text-center mt-4">
                                                    <h5>3475</h5>
                                                    <p class="mb-2 text-truncate">Market Place</p>
                                                </div>
                                            </div>
                                            <!-- end col -->
                                            <div class="col-4">
                                                <div class="text-center mt-4">
                                                    <h5>458</h5>
                                                    <p class="mb-2 text-truncate">Last Week</p>
                                                </div>
                                            </div>
                                            <!-- end col -->
                                            <div class="col-4">
                                                <div class="text-center mt-4">
                                                    <h5>9062</h5>
                                                    <p class="mb-2 text-truncate">Last Month</p>
                                                </div>
                                            </div>
                                            <!-- end col -->
                                        </div>
                                        <!-- end row -->

                                        <div class="mt-4">
                                            <div id="donut-chart" class="apex-charts"></div>
                                        </div>
                                    </div>
                                </div><!-- end card -->
                            </div><!-- end col -->
                        </div>
                        <!-- end row -->
                    </div>
                    
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

                
        <!-- apexcharts -->
        <script src="{{ url('public/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

        <!-- jquery.vectormap map -->
        <script src="{{ url('public/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
        <script src="{{ url('public/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js') }}"></script>

    
        <script src="{{ url('public/assets/js/pages/dashboard.init.js') }}"></script>

        
        <!-- Required datatable js -->
        <script src="{{ url('public/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}">></script>
        <script src="{{ url('public/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}">></script>
        <!-- Buttons examples -->
        <script src="{{ url('public/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}">></script>
        {{-- <script src="{{ url('public/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}">></script>
        <script src="{{ url('public/assets/libs/jszip/jszip.min.js') }}">></script>
        <script src="{{ url('public/assets/libs/pdfmake/build/pdfmake.min.js') }}">></script>
        <script src="{{ url('public/assets/libs/pdfmake/build/vfs_fonts.js') }}">></script> --}}
        {{-- <script src="{{ url('public/assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}">></script>
        <script src="{{ url('public/assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}">></script>
        <script src="{{ url('public/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}">></script> --}}

        <script src="{{ url('public/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}">></script>
        <script src="{{ url('public/assets/libs/datatables.net-select/js/dataTables.select.min.js') }}">></script>
        
        <!-- Responsive examples -->
        <script src="{{ url('public/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}">></script>
        <script src="{{ url('public/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}">></script>

        <!-- Datatable init js -->
        <script src="{{ url('public/assets/js/pages/datatables.init.js') }}">></script>

                    

        <!-- App js -->
        <script src="{{ url('public/assets/js/app.js') }}"></script>

        <script src="{{ url('public/assets/js/my_dashboard.js') }}">></script>
            
        {{-- <script type="text/javascript">
        $(window).on('hashchange', function (event) {
            event.preventDefault();

           if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                // var page = $(this).attr('href').split('page=')[1];

                if (page != Number.NaN || page <= 0) {
                    return true;
                } else {
                    getData(page);
                }
           }
        });

        $(document).ready(function() {
            $(document).on('click', '.pagination a', function(event){
                event.preventDefault(); 

                $("li").removeClass('active');
                $(this).parent('li').addClass('active');

                var myUrl = $(this).attr('href');
                var page = $(this).attr('href').split('page=')[1];
                console.log(page);
                getData(page);
            });
        });

        function getData(page) {
            $.ajax({
                url: '?page='+page,
                type: 'GET',
                dataType: 'html',
                success: function(response) {
                    console.log(response);

                    $(".birthday_table").empty().html("<div class='row'>"+response+"</div>");
                    location.hash = page;
                }
            })
            .done(function(data) {
                $(".birthday_table").empty().html("<div class='row'>"+data+"</div>");
                    location.hash = page;
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                // alert('No Responseees'+jqXHR)
            });
        }

        </script> --}}
        @endsection