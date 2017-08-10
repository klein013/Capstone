<!DOCTYPE html>
<html>
<head>
    <title></title>
    @include('admin.layout.head');
</head>
<body class="signup-page" style="background-image: url('../../images/bg1.jpg'); background-size: cover; height: auto; "> 
    <div class="imgcontainer" style="text-align: center;margin: 0px;color:black;">
        <img src="{{asset('images/payatas.png')}}" alt="Avatar" class="avatar" style="width: 40%; border-radius: 50%;">
        <h1>BARANGAY PAYATAS</h1>
        <h4>Blotter and Clearance Management Sytem</h4>
        <hr>
      </div>
    <div class="signup-box">
        <div class="card">
            <div class="body">
                <form id="sign_up">
                    <div class="msg">Register for new account</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">account_circle</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" id="officialid" name="officialid" placeholder="Official ID" required autofocus>
                        </div>
                    </div>
                    
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="user" id="user" placeholder="Username" required autofocus>
                        </div>
                    </div>
            
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" id="password1" name="password1" minlength="6" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirm Password" required>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-6">
                        <button class="btn btn-block btn-lg bg-teal waves-effect" type="submit">SIGN UP</button>
                        </div>
                        <div class="col-md-6">
                        <button class="btn btn-block btn-lg bg-teal waves-effect" type="button" id="back">BACK</button>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <center><label style="color:red" id ="error1"></label></center>
                    </div>
                </form>
            </div>
        </div>
    @include('admin.layout.scripts');
    <script>
        $(document).ready(function(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $('#back').on('click', function(){
                window.location.href = '/';
            });

            $.validator.addMethod("uservalid", function(value, element) {
                return this.optional(element) || value == value.match(/^[a-zA-Z0-9._]*$/);
            },"Letters, numbers, period and underscore only");

            
            $('#sign_up').validate({
                rules: {
                    officialid: {
                        required: true
                    },
                    user: {
                        required: true,
                        minlength: 6,
                        maxlength: 30
                    },
                    password1:{
                        required: true,
                        minlength: 6,
                        maxlength: 30
                    },
                    password2: {
                        required: true,
                        equalTo: password1,
                        minlength: 6,
                        maxlength: 30
                    }
                },
                submitHandler: function(form){
                    $.ajax({
                        url: '/signup_confirm',
                        method: 'POST',
                        data:{
                            official: $('#officialid').val(),
                            user: $('#user').val(),
                            pass: $('#password1').val(),
                            _token :  CSRF_TOKEN
                        },
                        success: function(response){
                            if(response=="Registration successful"){
                                $('#error1').text(response);
                                $('#error1').css('color', 'blue');
                            }
                            else{
                                $('#error1').text(response);
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