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
                @include('admin.aside_admin')
            @elseif($return['position']==1)
                @include('admin.aside_pb')
            @elseif($return['position']==2)
                @include('admin.aside_pb')
            @elseif($return['position']==3)
                @include('admin.aside_admin')
            @elseif($return['position']==4)
                @include('admin.aside_sec')
            @elseif($return['position']==5)
                @include('admin.aside_desk')
            @elseif($return['position']==6)
                @include('admin.aside_bpso')
            @elseif($return['position']==7)
                @include('admin.aside_cashier')
            @endif
    </aside>
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
                		<table class="table table-bordered table-condensed table-striped table-hover dataTable" id="accessTable">
                			<thead>
                				<tr class='bg-blue-grey'>
                					<td>ID</td>
                					<td>Name</td>
                					<td>Position</td>
                					<td>Access</td>
                				</tr>
                			</thead>
                			<tbody>
                			</tbody>
                		</table>
                	</div>
                	<div class="row clearfix">
                		<div class="col-md-2 col-md-offset-10">
                			<center><button type="submit" class="btn bg-teal btn-lg waves-effect" id="updateall">Update Changes</button></center>
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

            var arr = [];
            var csrf_token = $('meta[name="csrf-token"]').attr('content');

            $('#updateall').on('click', function(){
                $.ajax({
                    'url': '/utilities/access/update',
                    'method': 'POST',
                    'data' : {
                        _token: csrf_token,
                        checks : arr
                    },
                    'success' : function(response){
                        if(response=="success"){
                            swal({
                                title : "Success!", 
                                text : "Changes successfully made",
                                type :  "success",
                                showConfirmButton : true
                            });
                        }
                    }
                })
            });
    		$('#accessTable').dataTable({
    			bSort : false,
                "ajax": {
                "url" : "/utilities/access/show",
                "method": "GET",
                "data" : "json",
                "dataSrc": function (json) {
                        var return_data = new Array();
                        for(var i=0;i< json.length; i++){
                            var rre;
                            if(json[i].official_admin==0){
                                rre = "<select class='access form-control show-tick'><option value='1|"+json[i].official_id+"' >Admin</option><option value='0|"+json[i].official_id+"' selected>Non-Admin</option></select>";
                                arr.push([json[i].official_id, 0]);
                            }
                            else{
                                rre = "<select class='access form-control show-tick'><option value='1|"+json[i].official_id+"' selected>Admin</option><option value='0|"+json[i].official_id+"'>Non-Admin</option></select>";
                                arr.push([json[i].official_id, 1]);
                            }

                            return_data.push({
                            'ID' : json[i].official_id,
                            'Name' : json[i].name,
                            'Position' : json[i].position_name,
                            'Access': rre
                            });
                        }     
                        return return_data;
                    }
            },
            "columns" : [
                {"data" : "ID"},
                {"data" : "Name"},
                {"data" : "Position"},
                {"data" : "Access"}
            ]
            });

            $('#accessTable tbody').on('change', 'select.access', function(){
                    var off = ($(this).val()).split('|')[1];
                    var admin = ($(this).val()).split('|')[0];
                    $.each(arr, function(key, value) {
                        if(value["0"]==off){
                            value["0"] = off;
                            value["1"] = admin;
                        }
                    });

                    console.log(arr);
            })
    	});
    </script>
</body>
</html>
