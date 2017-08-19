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
                        <li class="{{Request::is('blotter/*') ? 'active' : ''}}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">report</i>
                            <span>Blotter</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{{Request::is('blotter/incident/*') ? 'active' : ''}}">
                                <a href="javascript:void(0);" class="menu-toggle"><span>Incident Blotter</span></a>
                                <ul class="ml-menu">
                                    <li class="{{Request::is('blotter/incident/incident') ? 'active' : '' }}">
                                        <a href="{{URL('blotter/incident/incident')}}">Report Incident</a>
                                    </li>
                                    <li class="{{Request::is('blotter/incident/incident_mapping') ? 'active' : ''}}">
                                        <a href="{{URL('blotter/incident/incident_mapping')}}">Incident Mapping</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="{{Request::is('blotter/barangay/*') ? 'active' : ''}}">
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Barangay Blotter</span>
                                </a>
                                <ul class="ml-menu">
                                    <li class="{{Request::is('blotter/barangay/schedule') ? 'active' : '' }}">
                                        <a href="{{URL('blotter/barangay/schedule')}}">Schedules</a>
                                    </li>
                                    <li class="{{Request::is('blotter/barangay/complaint') ? 'active' : '' }}">
                                        <a href="{{URL('blotter/barangay/complaint')}}">Complaint</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    </ul>
            </div>