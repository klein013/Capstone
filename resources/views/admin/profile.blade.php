<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	@include('admin.layout.head');
</head>
<body class="theme-blue-grey">
  @include('admin.layout.nav')
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

          <div class="row clearfix">
                <div class="col-sm-12">
                    
                    <div class="card">
                        <div class="header" style="background-image: url('../../images/user-img-background.jpg'); background-size: cover; height: auto;"> 
                            <img style="width:100px; height:100px;" src="{{asset($return['image'])}}">
                                <h3><div class="name" color="white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:#FFFFFF">{{$return['name']}}</div></h3>
                                <h2><div class="email" style="color:#FFFFFF">Official ID: <strong id="sessionpos">{{$return['official']}}</strong></div></h2>
                        </div>
                        <div class="body">
                            <div class="col-sm-8 col-sm-offset-2">
                            <div class="card">
                            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                <li role="presentation" class="active"><a href="#profile" data-toggle="tab">PROFILE</a></li>
                                <li role="presentation"><a href="#settings" data-toggle="tab">ACCOUNT SETTINGS</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="profile">
                                    <div class='row clearfix'>
                                        
                                    </div>
                                            
                                </div>


                                <div role="tabpanel" class="tab-pane fade" id="settings">
                                    <div class="body">
                                        <h3>PROFILE PICTURE</h3>
                                        <hr>
                                        <label for="username">Change Profile Picture</label>
                                        <br>
                                        <div class="input-group">
                                            <div class="form-line">
                                                <input type="file" class="form-control-file" placeholder="Upload Image" accept="image/*" required>
                                            </div>
                                        </div>
                                        <h3>USERNAME</h3>
                                        <hr>
                                        <label for="username">Change Username</label>
                                            <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">person</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="namesurname" placeholder="Username" required autofocus>
                                            </div>
                                            </div>
                                            <h3>PASSWORD</h3>
                                            <hr>
                                        <label for="username">Old Password</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">lock</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="password" class="form-control" name="password" minlength="6" placeholder="Old Password" required>
                                            </div>
                                        </div>
                                        
                                        <label for="username">New Password</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">lock</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="password" class="form-control" name="confirm" minlength="6" placeholder="New Password" required>
                                            </div>
                                        </div>

                                        <label for="username">Confirm Password</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">lock</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="password" class="form-control" name="confirm" minlength="6" placeholder="Confirm Password" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                               
                                                
                                                <button type="button" class="btn bg-teal btn waves-effect">
                                                <i class="material-icons">update</i> UPDATE</button>
                                                <button type="button" class="btn bg-teal btn waves-effect" data-dismiss="modal"> <i class="material-icons">error_outline</i> CANCEL</button>
                                            </div>
                                            
                                        </div>
                                </div>
                                
                            </div>
                        </div>
                        </div>
                        </div>
                </div>
            </div>
    </section>
@include('admin.layout.scripts');
</body>
</html>
