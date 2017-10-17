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

             <center> <h2>On This Day</h2></center>
             <br>

            <h4>Clearance</h4>
            <br>
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">accessibility</i>
                        </div>
                        <div class="content">
                            <div class="text">NEW RESIDENTS</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">4 </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">announcement</i>
                        </div>
                        <div class="content">
                            <div class="text">COMPLAINT</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">0</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">file_download</i>
                        </div>
                        <div class="content">
                            <div class="text">RELEASE</div>
                            <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20">4</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">gavel</i>
                        </div>
                        <div class="content">
                            <div class="text">CLEARANCE</div>
                            <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20">Php 432</div>
                        </div>
                    </div>
                </div>
            </div>
            <h4>Barangay Blotter</h4>
            <br>
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">report</i>
                        </div>
                        <div class="content">
                            <div class="text">NEW COMPLAINTS</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"> 0 </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">gavel</i>
                        </div>
                        <div class="content">
                            <div class="text">HEARING</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"> 1</div>
                        </div>
                    </div>
                </div>
            </div>
             <h4>Incident</h4>
            <br>
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">error</i>
                        </div>
                        <div class="content">
                            <div class="text">NEW INCIDENTS</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"> 0 </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">error</i>
                        </div>
                        <div class="content">
                            <div class="text">PENDING INCIDENTS</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"> 1</div>
                        </div>
                    </div>
                </div>
            </div>

                 <div class="form-group">
                        <div class="form-line">
                                                
                        </div>
                 </div>

                <div class="row clearfix">
                <!-- Visitors -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                
                </div>
                <!-- #END# Visitors -->
                <!-- Latest Social Trends -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-6">
                    <div class="card">
                        <div class="body bg-teal">
                            <div class="m-b--35 font-bold">LATEST RECORD TRENDS</div>
                            <ul class="dashboard-stat-list">
                                <li>
                                    #newresidents
                                    <span class="pull-right">
                                        4
                                    </span>
                                </li>
                                <li>
                                    #release
                                    <span class="pull-right">
                                        4
                                    </span>
                                </li>
                                <li>#clearance</li>
                                <li>#hearing</li>
                                <li>#pendingincidents</li>
                                <li>
                                    #newcomplaint
                                </li>

                                <li>
                                    #newincidents
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #END# Latest Social Trends -->
                <!-- Answered Tickets -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-2">
                    
                </div>
                <!-- #END# Answered Tickets -->
            </div>
    </section>

    </section>

@include('admin.layout.scripts');
</body>
</html>