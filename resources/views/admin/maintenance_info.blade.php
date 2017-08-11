<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
    <title>Utilities | Barangay Information</title>
    @include('admin.layout.head');
</head>
<body class="theme-blue-grey">
	@include('admin.layout.nav');
	
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
                <div class="col-lg-5 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-teal">
                        <div class="icon">
                            <i class="material-icons">info_outline</i>
                        </div>
                        <div class="content">
                            <div class="text"><h3>BARANGAY INFORMATION</h3></div>
                        </div>
                    </div>
                </div>


            </div>
            </div>
            <!-- Vertical Layout | With Floating Label -->
            <!-- Horizontal Layout -->
             <div class="col-lg-2 col-md-4 col-sm-12 col-xs-10">
               
                </div>
                <div class="col-lg-9 col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                             <form class="form-horizontal" enctype="multipart/form-data" id="infoform">
                             {{ csrf_field() }}
                                <div class="row clearfix">
                                    <div>
                                    @if(empty($info))
                                        <img class="img-responsive centered" src="" name="brgylogo" style="width:20%; height:20%; margin: 0 auto;" id="oldimage">
                                    @else
                                        <img class="img-responsive centered" src="{{ $info->BrgyInfo_Image }}" id="oldimage" name="brgylogo" style="width:20%; height:20%; margin: 0 auto;">
                                    @endif
                                    </div> 
                                    <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label>Barangay Logo</label>
                                    </div>
                                    <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file" class="form-control" id="image" accept="image/jpg,image/jpeg,image/png" required>
                                        </div>
                                    </div>
                                    </div>
                                </div>

                                <div class="row clearfix">                    
                                <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label>Barangay Name</label>
                                </div>
                                <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            @if(!empty($info))
                                            <input type="text" class="form-control" value="{{ $info->BrgyInfo_Name }}" id="oldname"  required>
                                            @else
                                            <input type="text" class="form-control" value="p" id="oldname" required>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                </div>

                                <div class="row clearfix">                                
                                 <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label>Website</label>
                                </div>
                                <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            @if(!empty($info))
                                            <input type="text" class="form-control" value="{{ $info->BrgyInfo_Web  }}" id="oldweb" required>
                                            @else
                                            <input type="text" class="form-control" value="" id="oldweb" required>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                </div>

                                <div class="row clearfix">
                                 <div class="col-lg-3 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label>Email</label>
                                </div>
                                <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            @if(!empty($info))
                                            <input type="text" class="form-control" value="{{ $info->BrgyInfo_Email }}" id="oldemail" required>
                                            @else
                                            <input type="text" class="form-control" value="" id="oldemail" required>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <br>
                                <div class="row clearfix">
                                    <div class="col-lg-offset-10 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <input type="submit" data-color="teal" class="btn bg-teal waves-effect" id="save" data-toggle="modal" data-target="#smallModal" value="SAVE">
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</section>
    @include('admin.layout.scripts');
    <script>
        $(document).ready(function (){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var file="";
            $('#image').change(function (event){
                $("#oldimage").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
                    file = event.target.files[0];
            });

            $('#save').on('click', function(){
                var formData = new FormData();
                formData.append('file', file);
                formData.append('name', $('#oldname').val());
                formData.append('web', $('#oldweb').val());
                formData.append('email', $('#oldemail').val());
                $.ajax({
                    url : '/maintenance_info',
                    method : 'POST',
                    data : formData,
                    contentType : false,
                    cache : false,
                    processData : false,
                    headers : {
                        'X-CSRF-TOKEN' : CSRF_TOKEN
                    }
                });
            });
        });
    </script>
</body>
</html>
