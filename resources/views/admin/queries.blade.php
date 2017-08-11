<!DOCTYPE html>
<html>
<head>
    <title>Queries</title>
    @include('admin.layout.head')
</head>
<body class="theme-blue-grey">
@include('admin.layout.nav')
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
           <div class="user-info">
                <div class="image">
                    <img src="../{{$return['image']}}" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$return['name']}}</div>
                    <div class="email">Official ID: <strong id="sessionpos">{{$return['position']}}</strong></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="{{URL('/profile')}}"><i class="material-icons">person</i>Profile</a></li>
                            <li><a href="{{URL('/')}}"><i class="material-icons">input</i>Log Out</a></li>
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
            <div class="block-header">
                <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-teal">
                        <div class="icon">
                            <i class="material-icons">help_outline</i>
                        </div>
                        <div class="content">
                            <div class="text"><h3> QUERIES</h3></div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div class="row clearfix">
                <!-- Spinners -->
                <div class="col-lg-1 col-md-6 col-sm-12 col-xs-12">
                </div>
                <!-- #END# Spinners -->
                <!-- Tags Input -->
                <div class="col-lg-9 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                    <div class="header">
                    <h4>Barangay Payatas</h4>
                    </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <select class="form-control show-tick">
                                        <option value="1">Most....</option>
                                        <option value="2">Most....</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                     <select class="form-control show-tick">
                                        <option value="1">Daily</option>
                                        <option value="2">Weekly</option>
                                        <option value="3">Monthly</option>
                                        <option value="4">Yearly</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <br>
                            <br>
                            <div class="col-md-14" id="rescon" style="border-style:solid; border-color:#b3cccc; border-width: 2px; border-radius: 3px; height: 75px;">
                        </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Tags Input -->
            </div>
        </div>
    </section>
    @include('admin.layout.scripts')

</body>
</html>
    
