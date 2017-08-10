<!DOCTYPE html>
<html>
<head>
	<title>Utilities | Access</title>
	@include('admin.layout.head');
	<link href="{{asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
</head>
<body class="theme-blue-grey">
	@include('admin.layout.nav');
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
            @elseif($return['position'==1])
                @include('admin.aside_pb');
            @elseif($return['position_id'==2])
                @include('admin.aside_pb');
            @elseif($return['position_id'==3])
                @include('admin.aside_admin');
            @elseif($return['position_id'==4])
                @include('admin.aside_sec');
            @elseif($return['position_id'==5])
                @include('admin.aside_desk');
            @elseif($return['position_id'==6])
                @include('admin.aside_bpso');
            @elseif($return['position_id'==7])
                @include('admin.aside_cashier');
            @endif
	<section class="content">
	<div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-teal">
                        <div class="icon">
                            <i class="material-icons">https</i>
                        </div>
                        <div class="content">
                            <div class="text"><h3>ACCESS</h3></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                	<div class="body table-responsive">
                		<table class="table dataTable" id="accessTable">
                			<thead>
                				<tr class='bg-blue-grey'>
                					<td>ID</td>
                					<td>Name</td>
                					<td>Position</td>
                					<td>Access</td>
                				</tr>
                			</thead>
                			<tbody>
                				@foreach($officials as $official)
                					<tr>
                						<td>{{ $official->ID }}</td>
                						<td>{{ $official->Name }}</td>
                						<td>{{ $official->Pos }}</td>
                						@if($official->Access == "non-admin")
                							<td><select class="access form-control show-tick"><option value="non-admin" selected>non-admin</option><option value="admin">admin</option></select></td>
                						@else
                							<td><select class="access form-control show-tick"><option value="admin" selected>admin</option><option value="non-admin">non-admin</option></select></td>
                						@endif
                					</tr>
                				@endforeach
                			</tbody>
                		</table>
                	</div>
                	<div class="row clearfix">
                		<div class="col-md-2 col-md-offset-10">
                			<button type="submit" class="btn bg-teal btn-lg waves-effect" id="updateall">Update Changes</button>
                		</div>
                	</div>
                	<br>
                	<br>
                </div>
            </div>
        </div>
    </div>
	</section>
	@include('admin.layout.scripts');
	<script src="{{asset('plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
    <script>
    	$(document).ready(function(){

    		$('#accessTable').dataTable({
    			bSort : false
    		});
    	});
    </script>
</body>
</html>
