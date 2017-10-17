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
                    </li><li class="{{Request::is('clearance/*') ? 'active' : ''}}">
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
                    <li class="{{Request::is('queries') ? 'active' : '' }}">
                        <a href="{{URL('queries')}}">
                            <i class="material-icons">live_help</i>
                            <span>Queries</span>
                        </a>
                    </li>
                   @if($return['admin']==1)
                   <li class="{{Request::is('maintenance/*') ? 'active' : ''}}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">build</i>
                            <span>Maintenance</span>
                        </a>

                        <ul class="ml-menu">
                            <li class="{{Request::is('maintenance/barangay/*') ? 'active' : ''}}">
                                <a href="javascript:void(0)" class="menu-toggle">Barangay</a>
                            
                            <ul class="ml-menu">
                                <li class="{{Request::is('maintenance/barangay/street') ? 'active' : '' }}">
                                    <a href="{{ URL('maintenance/barangay/street')}}">Street</a>
                                </li>
                                <li class="{{Request::is('maintenance/barangay/area') ? 'active' : '' }}">
                                    <a href="{{ URL('maintenance/barangay/area')}}">Area</a>
                                </li>
                                <li class="{{Request::is('maintenance/barangay/official') ? 'active' : '' }}">
                                    <a href="{{URL('maintenance/barangay/official')}}">Officials</a>
                                </li>
                            </ul>
                            </li>
                            <li class="{{Request::is('maintenance/blotter/*') ? 'active' : ''}}">
                                <a href="javascript:void(0)" class="menu-toggle">Blotter</a>
                                <ul class="ml-menu">
                                    <li class="{{Request::is('maintenance/blotter/cases') ? 'active' : '' }}">
                                        <a href="{{URL('maintenance/blotter/cases')}}">Cases Under KP Law</a>
                                    </li>
                                    <li class="{{Request::is('maintenance/blotter/incident') ? 'active' : '' }}">
                                        <a href="{{URL('maintenance/blotter/incident')}}">Incident Category</a>
                                    </li>
                                    <!--<li>
                                        <a href="{{ URL('maintenance_luponsched') }}">Lupon Schedule</a>
                                    </li>-->
                                </ul>
                            </li>
                            <li class="{{Request::is('maintenance/clearance/*') ? 'active' : ''}}">
                                <a href="javascript:void(0)" class="menu-toggle">Clearance</a>
                                <ul class="ml-menu">
                                    <li class="{{Request::is('maintenance/clearance/requirement') ? 'active' : '' }}">
                                        <a href="{{ URL('maintenance/clearance/requirement')}}">Requirements</a>
                                    </li>
                                    <li class="{{Request::is('maintenance/clearance/clearance') ? 'active' : '' }}">
                                      <a href="{{ URL('maintenance/clearance/clearance')}}">Clearances</a>  
                                    </li>
                                </ul>
                            </li>
                        </ul>
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
                            <li class="{{Request::is('utilities/access') ? 'active' : '' }}">
                                <a href="{{ URL('utilities/access') }}">Access</a>
                            </li>
                            <li class="{{Request::is('utilities/events') ? 'active' : '' }}">
                                    <a href="{{URL('utilities/events')}}">Events</a>
                                </li>
                        </ul>
                    </li>
                    @endif
                    </ul>
            </div>