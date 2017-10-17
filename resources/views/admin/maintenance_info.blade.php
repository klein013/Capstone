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
                <div class="col-sm-12">
                    <div class="card">
                        <div class="body">
                             <form class="form-horizontal" enctype="multipart/form-data" id="infoform">
                             {{ csrf_field() }}
                             <br>
                             <br>
                                <div class="row clearfix">
                                    <div class='col-sm-4 col-sm-offset-1'>
                                    @if(empty($info))
                                        <img class="img-responsive centered" src="" name="brgylogo" style="width:200px; height:200px; margin: 0 auto;" id="oldimagebrgy"></br>
                                        <center><h4>Barangay Logo</h4></center>
                                    @else
                                        <img class="img-responsive centered" src="../{{ $info->brgyinfo_logo }}" id="oldimagebrgy" name="brgylogo" style="width:200px; height:200px; margin: 0 auto;"></br>
                                        <center><h4>Barangay Logo</h4></center>
                                    @endif
                                    </div>
                                    <div class='col-sm-4 col-sm-offset-2'>
                                    @if(empty($info))
                                        <img class="img-responsive centered" src="" name="citylogo" style="width:200px; height:200px; margin: 0 auto;" id="oldimagecity">
                                        </br>
                                        <center><h4>City Logo</h4></center>
                                    @else
                                        <img class="img-responsive centered" src="../{{ $info->brgyinfo_citylogo }}" id="oldimagecity" name="citylogo" style="width:200px; height:200px; margin: 0 auto;">
                                        </br>
                                        <center><h4>City Logo</h4></center>
                                    @endif
                                    </div>
                                </div>
                                <br>
                                <br>
                                        <div class="row clearfix">
                                            <div class="col-sm-4">
                                                <label class="pull-right">Barangay Logo</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="file" class="form-control" id="imagebrgy" accept="image/jpg,image/jpeg,image/png" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-sm-4">
                                                <label class="pull-right">City Logo</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="file" class="form-control" id="imagecity" accept="image/jpg,image/jpeg,image/png" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-sm-4">
                                                <label class="pull-right">Barangay Name</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="name" name="name" value="{{$info->brgyinfo_name}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-sm-4">
                                                <label class="pull-right">City</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="city" name="city" value="{{$info->brgyinfo_city}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-sm-4">
                                                <label class="pull-right">Region</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="region" name="region" value="{{$info->brgyinfo_region}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-sm-4">
                                                <label class="pull-right">Website</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="web" name="web" value="{{$info->brgyinfo_website}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-sm-4">
                                                <label class="pull-right">Facebook</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="fb" name="fb" value="{{$info->brgyinfo_fb}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-sm-4">
                                                <label class="pull-right">Email</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="email" name="email" value="{{$info->brgyinfo_email}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-sm-4 col-sm-offset-8">
                                            <button type="submit" class="btn btn-lg bg-teal waves-effect" id="save" name="save">SAVE</button>
                                        </div>
                                    </div>
                                    <br>
                                    <br>

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
            var cityfile=null;
            var brgyfile=null;

            $('#imagebrgy').change(function (event){
                $("#oldimagebrgy").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
                    brgyfile = event.target.files[0];
            });

            $('#imagecity').change(function (event){
                $("#oldimagecity").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
                    cityfile = event.target.files[0];
            });

            
            $.validator.addMethod("alpha", function(value, element) {
                return this.optional(element) || value.trim() == value.match(/^[a-zA-Z .,]*$/);
            },"Letters, spaces, period and comma only");


            $.validator.addMethod("alphanum", function(value, element) {
                return this.optional(element) || value.trim() == value.match(/^[a-zA-Z0-9 .,]*$/);
            },"Letters, Numbers, spaces, period and comma only");

            $.validator.addMethod("cellno", function(value, element){
                return this.optional(element) || value.trim() == value.match(/\+639.[0-9]{8}/);
            }, "Must start +639 and followed by 9 digits");


            $('#infoform').validate({
                rules: {
                    name:{
                        required: true,
                        alphanum: true,
                        maxlength: 50,
                    },
                    city: {
                        required: true,
                        alphanum: true,
                        maxlength : 50
                    },
                    region: {
                        required: false,
                        maxlength: 50,
                        alpha: true
                    },
                    web: {
                        required: true,
                        maxlength : 100
                    },
                    fb: {
                        required: true,
                        maxlength : 100
                    },
                    email: {
                        required: true,
                        maxlength : 100  
                    }
                },
                submitHandler: function(form) { // for demo
                    var formData = new FormData();
                    formData.append('cityfile', cityfile);
                    formData.append('brgyfile', brgyfile);
                    formData.append('name', $('#name').val());
                    formData.append('web', $('#web').val());
                    formData.append('email', $('#email').val());
                    formData.append('fb', $('#fb').val());
                    formData.append('city', $('#city').val());
                    formData.append('region', $('#region').val());
                    $.ajax({
                        url : '/utilities/info/store',
                        method : 'POST',
                        data : formData,
                        processData : false,
                        contentType : false,
                        cache : false,
                        headers : {
                            'X-CSRF-TOKEN' : CSRF_TOKEN
                        },
                        success : function(response){
                            if(response=="success"){
                                swal({
                                title : "Barangay Information Updated",
                                type : "success",
                                showConfirmButton : true
                                });
                            }else{
                                swal({
                                title : "File exceeded the size limit of 2mb",
                                type : "error",
                                showConfirmButton : true
                                });
                            }
                        }
                    });
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

