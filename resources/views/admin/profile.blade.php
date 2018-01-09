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
                <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12">
                   
                </div>
                <div class="col-lg-8 col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header" style="background-image: url('../../images/user-img-background.jpg'); background-size: cover; height: auto;"> 
                            
                                <img style="width:100px; height:100px;" src="{{asset($return['image'])}}">
                                <h3><div class="name" color="white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:#FFFFFF">{{$return['name']}}</div></h3>
                                <h2><div class="email" style="color:#FFFFFF">Official ID: <strong id="sessionpos">{{$return['official']}}</strong></div></h2>
                        </div>
                                <div class="body">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                        <li role="presentation" class="active"><a href="#profile" data-toggle="tab">PROFILE</a></li>
                                        <li role="presentation"><a href="#settings" data-toggle="tab">ACCOUNT SETTINGS</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="profile">
                                            <h3>PROFILE: {{$return['name']}} </h3>
                                                    <div class="modal-body">
                                    <form enctype='multipart/form-data' id="profile">
                                        {{ csrf_field() }}
                                        <div class='row'>
                                            <div class='col-sm-4 col-sm-offset-4'>
                                            <center><img src='../uploads/human.png' class='img-responsive thumbnail' id="toimage"></center>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row clearfix">
                                        </div>
                                        <br>
                                        <div class="row clearfix">
                                        <div class="col-sm-4">
                                            <label for="f_name">First Name</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" value="{{$profile[0]->resident_fname}}" class="form-control" id="fname" required 
                                                    @if($return['official']==0)
                                                        disabled
                                                    @endif 
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="l_name">Middle Name</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" value="{{$profile[0]->resident_mname}}" id="mname" 
                                                    @if($profile[0]->resident_gender=='M')
                                                        disabled
                                                    @endif
                                                    @if($return['official']==0)
                                                        disabled
                                                    @endif >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="m_name">Last Name</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="lname" required value="{{$profile[0]->resident_lname}}"
                                                    @if($return['official']==0)
                                                        disabled
                                                    @endif >
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                     <div class="row clearfix">
                                        <div class="col-sm-4">
                                        <label for="date">Birth Date</label>
                                           <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" value="{{$profile[0]->resident_bdate}}" id="bdate"
                                                    @if($return['official']==0)
                                                        disabled
                                                    @endif disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                        <label for="gender">Gender</label>
                                           <div class="form-line">
                                                         <select class="form-control show-tick" id="gender" @if($return['official']==0)
                                                        disabled
                                                    @endif disabled>
                                                            <option value="" disabled>Choose gender 
                                                            </option>
                                                            @if($profile[0]->resident_gender=='M')
                                                                <option value="M" selected>Male</option>
                                                                <option value="F">Female</option>
                                                            @else
                                                                <option value="M" selected>Male</option>
                                                                <option value="F">Female</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                        
                                        <div class="col-sm-4">
                                            <label>Year of Residency</label>
                                            <div class="form-group">
                                            <div class="form-line">
                                                <input type="number" class="form-control" id="year" name="year" @if($return['official']==0)
                                                        disabled
                                                    @endif value="{{$profile[0]->resident_yearstayed}}">
                                            </div>
                                            </div>
                                        </div>
                                    </div>

                                    <label for="res_address">Address</label>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Lot No./Blk No./Phase No./Subdivision</label>    
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Street</label>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class="form-group">
                                            <div class="col-sm-6">
                                                <div class=" form-line">
                                                <input type="text" id="house" class="form-control" @if($return['official']==0)
                                                        disabled
                                                    @endif value="{{$profile[0]->resident_hno}}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                            <select class="form-control show tick" id="street" @if($return['official']==0)
                                                        disabled
                                                    @endif>
                                                <option value="" disabled selected>Choose Street</option>
                                                @foreach($streets as $street)
                                                    @if($profile[0]->resident_street==$street->street_id)
                                                    <option value="{{ $street->street_id }}" selected>{{ $street->street_name }}, {{ $street->area_name }}</option>
                                                    @else
                                                    <option value="{{ $street->street_id }}" >{{ $street->street_name }}, {{ $street->area_name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row clearfix">
                                        <div class="col-sm-6">
                                            <label for="contact_no">Contact No.</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="contact" name="contact" @if($return['official']==0)
                                                        disabled
                                                    @endif value="{{$profile[0]->resident_contact}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Allow Message</label>
                                            <div class="demo-radio-button">
                                            <input name="radio" type="radio" value="1" id="radio_yes" class="radio-col-blue-grey" checked disabled/>
                                            <label for="radio_yes">YES</label>
                                            <input name="radio" type="radio" value="0" id="radio_no" class="radio-col-blue-grey" disabled/>
                                            <label for="radio_no">NO</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                                
                            </div>


                            <div role="tabpanel" class="tab-pane fade" id="settings">
                                <div class="body">

                                            <h3>USERNAME</h3>
                                            <hr>
                                            <form id="userdet">
                                            <label for="username">Change Username</label>
                                                <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">person</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="username" placeholder="Username" id="username" required autofocus>
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
                                                <input type="password" class="form-control" name="oldpassword" minlength="6" id="oldpassword" placeholder="Old Password" required>
                                            </div>
                                        </div>
                                        
                                        <label for="username">New Password</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">lock</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="password" class="form-control" name="password1" minlength="6" id="password1" placeholder="New Password" required>
                                            </div>
                                        </div>

                                        <label for="username">Confirm Password</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">lock</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="password" class="form-control" name="password2" minlength="6" id="password2" placeholder="Confirm Password" required>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                               
                                                
                                                <button type="submit" class="btn bg-teal btn waves-effect">
                                                <i class="material-icons">update</i> UPDATE</button>
                                                <button type="button" class="btn bg-teal btn waves-effect" data-dismiss="modal"> <i class="material-icons">error_outline</i> CANCEL</button>
                                            </div>
                                        </div>
                                </div>
                                </form>
                                
                            </div>
                        </div>
                </div>
            </div>
    </section>
@include('admin.layout.scripts');
<script>
    
    $(document).ready(function(){

         $.validator.addMethod("alpha", function(value, element) {
            return this.optional(element) || value.trim() == value.match(/^[a-zA-Z]*$/);
        },"Letters, spaces, period and comma only");


        $.validator.addMethod("alphanum", function(value, element) {
            return this.optional(element) || value.trim() == value.match(/^[a-zA-Z0-9]*$/);
        },"Letters, Numbers, spaces, period and comma only");

          $.validator.addMethod("uservalid", function(value, element) {
                return this.optional(element) || value == value.match(/^[a-zA-Z0-9._]*$/);
            },"Letters, numbers, period and underscore only");

            

        $('#userdet').validate({
            rules:{
                username: {
                        minlength: 6,
                        maxlength: 30
                },
                password1:{
                    minlength: 6,
                    maxlength: 30
                },
                password2: {
                    equalTo: password1,
                    minlength: 6,
                    maxlength: 30
                },
                oldpassword : {
                    minlength: 6,
                    maxlength: 30
                }
            },
            submitHandler: function(form){
                if($('#username').val()==""){
                    if($('#oldpassword').val()==""){

                    }
                }
                else if($('#username').val()!=""){
                    
                }

                
            },
            highlight: function (input) {
                $(input).parents('.form-line').addClass('error');
            },
            unhighlight: function (input) {
                $(input).parents('.form-line').removeClass('error');
            },
            errorPlacement: function (error, element) {
                $(element).parents('.form-group').append(error);
            }
       });
    });
</script>
</body>
</html>

