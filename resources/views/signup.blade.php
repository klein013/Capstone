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
                <form id="sign_up" method="POST">
                    <div class="msg">Register for new account</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">account_circle</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="namesurname" placeholder="Official ID" required autofocus>
                        </div>
                    </div>
                    
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="namesurname" placeholder="Username" required autofocus>
                        </div>
                    </div>
            
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" minlength="6" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="confirm" minlength="6" placeholder="Confirm Password" required>
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
                </form>
            </div>
        </div>
    @include('admin.layout.scripts');
    <script>
        $(document).ready(function(){
            $('#back').on('click', function(){
                window.location.href = '/';
            });
        });
    </script>
</body>
</html>