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
                    <img src="../../images/human.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$return['name']}}</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li class="user-header">
                            <div class="imgcontainer">
                                <img src="../../{{$return['image']}}" alt="Avatar" class="avatar">
                            </div>
                            </li>
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
            @elseif($return['position_id']==2)
                @include('admin.aside_pb');
            @elseif($return['position_id']==3)
                @include('admin.aside_admin');
            @elseif($return['position_id']==4)
                @include('admin.aside_sec');
            @elseif($return['position_id']==5)
                @include('admin.aside_desk');
            @elseif($return['position_id']==6)
                @include('admin.aside_bpso');
            @elseif($return['position_id']==7)
                @include('admin.aside_cashier');
            @endif
            

        </aside>

        <section class="content">
                <div class="container-fluid">
            <div class="block header">
                <h3>DASHBOARD</h3>
            </div>

            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">error</i>
                        </div>
                        <div class="content">
                            <div class="text">INCIDENT</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">3 </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">announcement</i>
                        </div>
                        <div class="content">
                            <div class="text">COMPLAINT</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">20</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">markunread_mailbox</i>
                        </div>
                        <div class="content">
                            <div class="text">CLEARANCE</div>
                            <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20">120</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-yellow hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">gavel</i>
                        </div>
                        <div class="content">
                            <div class="text">HEARING</div>
                            <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20">4</div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    </section>

@include('admin.layout.scripts');
</body>
</html>