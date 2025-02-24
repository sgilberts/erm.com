<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                <img src="{{  Auth::user()->getAdminImage() }}" alt="{{  Auth::user()->lname }}" class="avatar-md rounded-circle">
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1">{{ Auth::user() ->lname . ' ' . Auth::user() ->fname}}</h4>
                <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i> Online</span>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>

                <li>
                    <a href="{{ url('admin') }}" class="waves-effect">
                        <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">3</span>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('admin/calendar/home') }}" class=" waves-effect">
                        <i class="ri-calendar-2-line"></i>
                        <span>Calendar</span>
                    </a>
                </li>
    
                <li>
                    <a href="{{ url('admin/attendance/list') }}" class=" waves-effect">
                        <i class="ri-calendar-2-line"></i>
                        <span>Attendance</span>
                    </a>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>Prayer Requests</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('admin/prayer/inbox') }}">Inbox</a></li>
                        <li><a href="{{ url('admin/prayer/read') }}">Read Prayer</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>Chapters</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('admin/chapters/list') }}">All Chapters</a></li>
                        <li><a href="{{ url('admin/chapters/recycle') }}">Recyle Chapter</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>Cell System</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('admin/cells/list') }}">All Cells</a></li>
                        <li><a href="{{ url('admin/cells/recycle') }}">Read Cells</a></li>
                    </ul>
                </li>

                <li class="menu-title">People</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-vip-crown-2-line"></i>
                        <span>Admin User Info</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('admin/users/list') }}">Admin Users</a></li>
                        <li><a href="{{ url('admin/users/recycle') }}">Recycle Bin</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-account-circle-line"></i>
                        <span>Members</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('admin/members/list') }}">Members</a></li>
                        <li><a href="{{ url('admin/members/recycle') }}">Recycle Bin</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-account-circle-line"></i>
                        <span>First Timers</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('admin/first_timers/list') }}">All First Timers</a></li>
                        <li><a href="{{ url('admin/first_timers/recycle') }}">Recycle Bin</a></li>
                    </ul>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-account-circle-line"></i>
                        <span>Evangelism</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('admin/evangelism/list') }}">New Souls</a></li>
                        <li><a href="{{ url('admin/evangelism/recycle') }}">Recycle Bin</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-profile-line"></i>
                        <span>Utility</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="pages-starter.html">Starter Page</a></li>
                        <li><a href="pages-timeline.html">Timeline</a></li>
                        <li><a href="pages-directory.html">Directory</a></li>
                        <li><a href="pages-invoice.html">Invoice</a></li>
                        <li><a href="pages-404.html">Error 404</a></li>
                        <li><a href="pages-500.html">Error 500</a></li>
                    </ul>
                </li>

                <li class="menu-title">Finance</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-pencil-ruler-2-line"></i>
                        <span>UI Elements</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="ui-alerts.html">Alerts</a></li>
                        <li><a href="ui-buttons.html">Buttons</a></li>
                        <li><a href="ui-cards.html">Cards</a></li>
                        <li><a href="ui-carousel.html">Carousel</a></li>
                        <li><a href="ui-dropdowns.html">Dropdowns</a></li>
                        <li><a href="ui-grid.html">Grid</a></li>
                        <li><a href="ui-images.html">Images</a></li>
                        <li><a href="ui-lightbox.html">Lightbox</a></li>
                        <li><a href="ui-modals.html">Modals</a></li>
                        <li><a href="ui-offcanvas.html">Offcavas</a></li>
                        <li><a href="ui-progressbars.html">Progress Bars</a></li>
                        <li><a href="ui-tabs-accordions.html">Tabs & Accordions</a></li>
                        <li><a href="ui-typography.html">Typography</a></li>
                        <li><a href="ui-video.html">Video</a></li>
                        <li><a href="ui-general.html">General</a></li>
            
                    </ul>
                </li>

    
                <li class="menu-title">System Settings</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-table-2"></i>
                        <span>Tables</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="tables-basic.html">Basic Tables</a></li>
                        <li><a href="tables-datatable.html">Data Tables</a></li>
                        <li><a href="tables-responsive.html">Responsive Table</a></li>
                        <li><a href="tables-editable.html">Editable Table</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-share-line"></i>
                        <span>Multi Level</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="javascript: void(0);">Level 1.1</a></li>
                        <li><a href="javascript: void(0);" class="has-arrow">Level 1.2</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="javascript: void(0);">Level 2.1</a></li>
                                <li><a href="javascript: void(0);">Level 2.2</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>