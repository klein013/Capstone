
                <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="../../images/human.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">John Doe</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li class="user-header">
                            <div class="imgcontainer">
                                <img src="../../images/human.png" alt="Avatar" class="avatar">
                            </div>
                            </li>
                            <li><a href="../../pages/account/profile.html"><i class="material-icons">person</i>Profile</a></li>
                            <li><a href="{{URL('')}}"><i class="material-icons">input</i>Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li>
                        <a href="{{URL('index')}}">
                            <i class="material-icons">home</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL('resident') }}">
                            <i class="material-icons">person_outline</i>
                            <span>Resident</span>
                        </a>
                    </li>
                        <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">report</i>
                            <span>Incidents</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <li>
                                <span><a href="{{URL('incident')}}">Incident Blotter</a></span>
                                </li>
                            </li>

                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Barangay Blotter</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="{{URL('brecords')}}">Records</a>
                                    </li>
                                    <li>
                                        <a href="{{URL('complaint')}}">Complaint</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                     <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">markunread_mailbox</i>
                            <span>Clearance</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{URL('clearance')}}">Requests</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Reports</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Blotter  Report</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="{{URL('/reports_incident')}}">Incident Report</a>
                                    </li>
                                    <li>
                                        <a href="{{URL('/reports_barangay')}}">Barangay Report</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                 <li>
                                 <span><a href="{{URL('/reports_clearance')}}">Clearance Report</a></span>
                                </li>
                            </li>
                        </ul>
                    </li>
                   <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">settings</i>
                            <span>Maintenance</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{URL('maintenance_official')}}">Officials</a>
                            </li>
                             <li>
                                <a href="{{ URL('maintenance_pos')}}">Position</a>
                            </li>
                            <li>
                                <a href="{{URL('maintenance_cases')}}">Cases Under KP Law</a>
                            </li>
                            <li>
                                <a href="{{URL('maintenance_clearance')}}">Clearances</a>
                            </li>
                            <li>
                                <a href="{{URL('maintenance_info')}}">Barangay Information</a>
                            </li>
                            <li>
                                <a href="{{URL('maintenance_branch')}}">Branch</a>
                            </li>
                            <li>
                                <a href="{{ URL('maintenance_access') }}">Access</a>
                            </li>
                        </ul>
                    </li>
                    
            </div>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        
            <!-- #Footer -->
        </aside>