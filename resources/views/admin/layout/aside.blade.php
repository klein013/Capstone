

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
                            <li><a href="{{URL('/profile')}}"><i class="material-icons">person</i>Profile</a></li>
                            <li><a href="{{URL('/')}}"><i class="material-icons">input</i>Log Out</a></li>
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
                            <span>Blotter</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle"><span>Incident Blotter</span></a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="{{URL('incident')}}">Incidents</a>
                                    </li>
                                    <li>
                                        <a href="{{URL('incident_mapping')}}">Incident Mapping</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Barangay Blotter</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="{{URL('schedule')}}">Schedules</a>
                                    </li>
                                    <li>
                                        <a href="{{URL('complaint')}}">Complaint</a>
                                    </li>
                                    <li>
                                        <a href="{{URL('record')}}">Records</a>
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
                            <li>
                                <a href="{{URL('payments')}}">Payments</a>
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
                                        <a href="{{URL('/reports_incident')}}">Incidents Report</a>
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
                        <a href="{{URL('queries')}}">
                            <i class="material-icons">live_help</i>
                            <span>Queries</span>
                        </a>
                    </li>
                   <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">build</i>
                            <span>Maintenance</span>
                        </a>

                        <ul class="ml-menu">
                            <li>
                                <a href="javascript:void(0)" class="menu-toggle">Barangay</a>
                            
                            <ul class="ml-menu">
                                <li>
                                    <a href="{{URL('maintenance_official')}}">Officials</a>
                                </li>
                                <!-- <li>
                                    <a href="{{ URL('maintenance_pos')}}">Position</a>
                                </li>-->
                                <li>
                                    <a href="{{ URL('maintenance_street')}}">Street</a>
                                </li>
                                <li>
                                    <a href="{{ URL('maintenance_area')}}">Area</a>
                                </li>
                            </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="menu-toggle">Blotter</a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="{{URL('maintenance_cases')}}">Cases Under KP Law</a>
                                    </li>
                                    <li>
                                        <a href="{{URL('maintenance_incident')}}">Incident Category</a>
                                    </li>
                                    <!--<li>
                                        <a href="{{ URL('maintenance_luponsched') }}">Lupon Schedule</a>
                                    </li>-->
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="menu-toggle">Clearance</a>
                                <ul class="ml-menu">
                                    <li>
                                      <a href="{{ URL('maintenance_clearance')}}">Clearances</a>  
                                    </li>
                                    <li>
                                        <a href="{{ URL('maintenance_requirement')}}">Requirements</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">settings</i>
                            <span>Utilities</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{ URL('maintenance_info') }}">Barangay Information</a>
                            </li>
                            <li>
                                <a href="{{ URL('maintenance_branch') }}">Branch</a>
                            </li>
                            <li>
                                <a href="{{ URL('maintenance_access') }}">Access</a>
                            </li>

                                <li>
                                    <a href="{{URL('maintenance_holidays')}}">Holiday and Suspension</a>
                                </li>
                        </ul>
                    </li>
                    
            </div>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        
            <!-- #Footer -->
        </aside>
