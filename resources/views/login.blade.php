<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    @include('admin.layout.head');
</head>
<body class="login-page" style="background-image: url('../../images/bg1.jpg'); background-size: cover; height: 100%; "> 
    <div class="imgcontainer" style="text-align: center;margin: 0px;color:black;">
        <img src="{{asset('images/payatas.png')}}" alt="Avatar" class="avatar" style="width: 40%;">
        <h1>BARANGAY PAYATAS</h1>
        <h4>Blotter and Clearance Management System</h4>
        <hr>
      </div>
    <div class="login-box">
        <div class="card">
            <div class="body">
                <form id="Login">
                {{csrf_field()}}
                    <div class="msg">Sign in with your barangay account</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" id="password" name= "password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row" style="display:none;" id="error1">
                            <center><span><h5 style="color:red;" id="error">Incorrect username or password</h5></span></center>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <button class="btn btn-block bg-teal waves-effect" type="submit" id="Login">LOG IN</button>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="col-md-4"></div>
                        <div class="col-md-6">
                            <a href="{{URL('/signup')}}">Register Now!</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('admin.layout.scripts');
    <script>
        $(document).ready(function(){
             var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $('#Login').validate({
                rules: {
                    username: {
                        required: true
                    },
                    password:{
                        required: true
                    }
                },
                submitHandler: function(form){
                    $.ajax({
                        url: '/login',
                        method: 'POST',
                        data:{
                            user: $('#username').val(),
                            pass: $('#password').val(),
                            _token :  CSRF_TOKEN
                        },
                        success: function(response){
                            if(response=="success"){
                                window.location.href = "/indexcheck";
                            }
                            else{
                                $('#error1').show();
                                $('#error').val(response);
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