<!DOCTYPE html>
<html>

<head>
        <title>Dashboard</title>
        @include('admin.layout.head');

</head>
<body class="theme-blue-grey">
   
    @include('admin.layout.nav');
    <section>
        

        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="{{asset($return['image'])}}" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$return['name']}}</div>
                    <div class="email">Official ID: <strong id="sessionpos">{{$return['official']}}</strong></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="{{URL('/profile')}}"><i class="material-icons">person</i>Profile</a></li>
                            <li><a href="{{URL('/logout')}}"><i class="material-icons">input</i>Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            @if($return['position']==0)
                @include('admin.aside_admin');
            @elseif($return['position']==1)
                @include('admin.aside_pb');
            @elseif($return['position']==2)
                @include('admin.aside_pb');
            @elseif($return['position']==3)
                @include('admin.aside_admin');
            @elseif($return['position']==4)
                @include('admin.aside_sec');
            @elseif($return['position']==5)
                @include('admin.aside_desk');
            @elseif($return['position']==6)
                @include('admin.aside_bpso');
            @elseif($return['position']==7)
                @include('admin.aside_cashier');
            @endif
            

        </aside>

        <section class="content">
            <div class="container-fluid">
            <div class="block header">
                <h3>DASHBOARD</h3>
                 <div class="form-group">
                        <div class="form-line">
                                                
                        </div>
                 </div>
            </div>
         <div class="row clearfix">
                <div class="col-sm-4 col-sm-offset-2">
                    <div class="card">
                        <div class="body bg-teal">
                            <div class="font-bold m-b--35">BARANGAY ANNOUNCEMENTS</div>
                            <center>
                            <ul class="dashboard-stat-list">
                                @if(!empty($events[0]->hs_id))
                                    @foreach($events as $event)
                                        <li>{{$event->hs_name}}</li>
                                    @endforeach
                                @else
                                    <li>No Events Found</li>
                                @endif
                                
                            </ul>
                        </center>
                        </div>
                    </div>
                </div>
                @if($return['position']==1||$return['position']==2||$return['position']==0)
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="card">
                        <div class="body bg-teal">
                            <div class="font-bold m-b--35">CASES FOR TODAY</div>
                            <center>
                            <ul class="dashboard-stat-list">
                                @if(!empty($cases[0]->caseid))
                                    @foreach($cases as $case)
                                        <li>{{$case->case_id}} - {{$case->caseskp_name}}</li>
                                    @endforeach
                                @else
                                    <li>No Cases Found</li>
                                @endif
                            </ul>
                            </center>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            
<br>
                 <div class="form-group">
                        <div class="form-line">
                                                
                        </div>
                 </div>

        @if($return['position']==1||$return['position']==2||$return['position']==0)   
        <div class="card">
        <div class="row clearfix">
            <div class="col-sm-6">
                <br>
            <center><h4>Barangay Blotter</h4></center>
            <br>
                <div class="col-sm-6">
                    <div class="info-box bg-amber hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">fiber_new</i>
                        </div>
                        <div class="content">
                            <div class="text">NEW COMPLAINTS</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">{{$complaintsforadmin[0]->number}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="info-box bg-amber hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">gavel</i>
                        </div>
                        <div class="content">
                            <div class="text">HEARING</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">{{$hearingsforadmin[0]->number}}</div>
                        </div>
                    </div>
                </div>
            </div>
            @if($return['position']==1||$return['position']==5||$return['position']==6||$return['position']==0) 
        
            <div class="col-sm-6">
                
            <br>
            <center><h4>Incident Blotter</h4></center>
            <br>
                <div class="col-sm-6">
                    <div class="info-box bg-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">error</i>
                        </div>
                        <div class="content">
                            <div class="text">NEW INCIDENTS</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">{{$incidentsall[0]->number}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="info-box bg-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">error</i>
                        </div>
                        <div class="content">
                            <div class="text">PENDING INCIDENTS</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">{{$incidentsreported[0]->number}}</div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            @endif
            </div>
        </div>
            @endif
            
        
            
            @if($return['position']==3||$return['position']==4||$return['position']==5||$return['position']==6||$return['position']==0) 
            <div class="card">
            <div class="row clearfix">
                
            <br>
            <center><h4>Clearance</h4></center>
            <br>
                <div class="col-sm-12">
                <div class="col-sm-3">
                    <div class="info-box bg-blue hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">fiber_new</i>
                        </div>
                        <div class="content">
                            <div class="text">NEW REQUESTS</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">{{$clearancesrequest[0]->number}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="info-box bg-blue hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">assignment</i>
                        </div>
                        <div class="content">
                            <div class="text">PENDING REQUESTS</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">{{$clearancepending[0]->number}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="info-box bg-blue hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">new_releases</i>
                        </div>
                        <div class="content">
                            <div class="text">RELEASED</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">{{$clearancereleased[0]->number}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="info-box bg-blue hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">attach_money</i>
                        </div>
                        <div class="content">
                            <div class="text">AMOUNT COLLECTED</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">
                                @if(empty($clearancecollected[0]->number))
                                    0.00
                                @else
                                    {{$clearancecollected[0]->number}}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
            @endif

        </div>
    </section>

@include('admin.layout.scripts');
<script>
    $(document).ready(function(){

    });
</script>
</body>
</html>