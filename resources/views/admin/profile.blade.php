<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	@include('admin.layout.head');
</head>
<body class="theme-blue-grey">
@include('admin.layout.nav');
@include('admin.layout.aside');
	    <section class="content">
        <div class="container-fluid">
            
          <div class="row clearfix">
                <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12">
                   
                </div>
                <div class="col-lg-8 col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header" style="background-image: url('../../images/user-img-background.jpg'); background-size: cover; height: auto;"> 
                            
                                <img src="../../images/human.png" style="width: 20%;" alt="profile" class="avatar">
                                <h1 class="col-white">Admin - John Doe</h1>
                        </div>
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
    </section>
@include('admin.layout.scripts');
</body>
</html>
