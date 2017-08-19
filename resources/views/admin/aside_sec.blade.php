<div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="{{Request::is('index') ? 'active' : '' }}">
                        <a href="{{URL('index')}}">
                            <i class="material-icons">home</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="{{Request::is('resident') ? 'active' : '' }}">
                        <a href="{{ URL('resident') }}">
                            <i class="material-icons">person_outline</i>
                            <span>Resident</span>
                        </a>
                    </li>
                     <li class="{{Request::is('clearance/*') ? 'active' : ''}}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">markunread_mailbox</i>
                            <span>Clearance</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{{Request::is('clearance/clearance') ? 'active' : '' }}">
                                <a href="{{URL('clearance/clearance')}}">Requests</a>
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
                                    <li class="{{Request::is('reports_incident') ? 'active' : '' }}">
                                        <a href="{{URL('reports_incident')}}">Incident Report</a>
                                    </li>
                                    <li class="{{Request::is('reports_barangay') ? 'active' : '' }}">
                                        <a href="{{URL('reports_barangay')}}">Barangay Report</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                 <li class="{{Request::is('reports_clearance') ? 'active' : '' }}">
                                 <span><a href="{{URL('reports_clearance')}}">Clearance Report</a></span>
                                </li>
                            </li>
                        </ul>
                    </li>
                    <li class="{{Request::is('queries') ? 'active' : '' }}">
                        <a href="{{URL('queries')}}">
                            <i class="material-icons">live_help</i>
                            <span>Queries</span>
                        </a>
                    </li>
                    <li class="{{Request::is('utilities/*') ? 'active' : ''}}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">settings</i>
                            <span>Utilities</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{{Request::is('utilities/info') ? 'active' : '' }}">
                                <a href="{{ URL('utilities/info') }}">Barangay Information</a>
                            </li>
                            <li class="{{Request::is('utitilities/branch') ? 'active' : '' }}">
                                <a href="{{ URL('utilities/branch') }}">Branch</a>
                            </li>
                            <li class="{{Request::is('utilities/access') ? 'active' : '' }}">
                                <a href="{{ URL('utilities/access') }}">Access</a>
                            </li>

                                <li class="{{Request::is('utilities/holidays_events') ? 'active' : '' }}">
                                    <a href="{{URL('utilities/holidays_events')}}">Holiday and Suspension</a>
                                </li>
                        </ul>
                    </li>
                    </ul>
            </div>