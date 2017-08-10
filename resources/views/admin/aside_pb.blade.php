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
                                        <a href="{{URL('record')}}">Records</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    </ul>
            </div>