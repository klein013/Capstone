<!DOCTYPE html>
<html>
<head>
	<title>Utilities | Holidays and Suspension</title>
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
   <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-teal">
                        <div class="icon">
                            <i class="material-icons">event</i>
                        </div>
                        <div class="content">
                            <div class="text"><h3> SCHEDULE</h3></div>
                        </div>
                    </div>
                </div>


            </div>
            </div>
            <!-- Basic Table -->
            <div class="row clearfix">
                                    <div class="col-lg-offset-7 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <a href="#" data-toggle="tooltip" title="Set Holiday and Suspension"><button type="button" class="btn bg-teal btn-rectangle-lg waves-effect waves-rectangle waves-float" data-toggle="modal" data-target="#defaultModal">
                                                       <div class="content">
                                                            <div class="text"><h3> SET HOLIDAY AND SUSPENSION</h3></div>
                                                       </div></button></a>
                                    </div>

            </div>
            <!-- #END# With Material Design Colors -->
        </div>
    </section>

    <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                            <div class="row clearfix">
                            <div class="col-lg-11 col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box bg-teal">
                            <div class="icon">
                                <i class="material-icons">event</i>
                            </div>
                            <div class="content">
                            <div class="text"><h3> SET HOLIDAY AND SUSPENSION</h3></div>
                            </div>
                    </div>
                </div>
                        </div>
                        <div class="modal-body">
                            <form>
                                <label for="date">Date</label>
                                   <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="datepicker form-control">
                                        </div>
                                    </div>
                               

                            <label for="category">Category</label>
                            <div class="form-group">
                                    <div class="form-line">
                                                 <select class="form-control show-tick">
                                                    <option value="" disabled selected>Choose category 
                                                    </option>
                                                </select>
                                    </div>
                            </div>
                           <label>Description</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea rows="4" class="form-control no-resize" placeholder="Please type what you want..." required></textarea>
                                        </div>
                                    </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-teal btn-lg waves-effect">ADD</button>
                            <button type="button" class="btn bg-teal btn-lg waves-effect" data-dismiss="modal">CANCEL</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
@include('admin.layout.scripts');
</body>
</html>