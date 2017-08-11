<!DOCTYPE html>
<html>
<head>
	<title>Utilities | Branches</title>
	@include('admin.layout.head');

    <link href="{{asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
     <link href="{{asset('bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}" rel="stylesheet" />
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
                            <i class="material-icons">call_split</i>
                        </div>
                        <div class="content">
                            <div class="text"><h3> BRANCH</h3></div>
                        </div>
                    </div>
                </div>


            </div>
            </div>
            <!-- Basic Table -->
            <div class="row clearfix">
                                    <div class="col-lg-offset-11 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <a href="javascript:void(0)" data-toggle="tooltip" title="Add Branch"><button type="button" class="btn bg-teal btn-circle-lg waves-effect waves-circle waves-float" data-toggle="modal" data-target="#defaultModal"><i class="material-icons">add</i></button></a>
                                    </div>
                                </div>
                                <br>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                	<div class="card">
                        <div class="body table-responsive">
                            <table class="table table-hover dataTable js-exportable" id="branchTable">
                                <thead>
                                    <tr class="bg-blue-grey">
                                        <th>ID</th>
                                        <th>NAME</th>
                                        <th>ADDRESS</th>
                                        <th>CONTACT NUMBER</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                               	<tbody>
                               	@foreach($branches as $branch)
                               		<tr>
                               			<td>{{ $branch->Branch_ID }}</td>
                               			<td>{{ $branch->Branch_Name }}</td>
                               			<td>{{ $branch->Branch_Address }}</td>
                               			<td>{{ $branch->Branch_Contact }}</td>
                               			<td><button type = 'button' class = 'edit btn btn-space bg-blue waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Update Record'><i class='material-icons'>update</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button></td>
                               		</tr>
                               	@endforeach
                               	</tbody>
                            </table>
                        </div>
                    </div>
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
                <div class="col-lg-7 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-teal">
                        <div class="icon">
                            <i class="material-icons">call_split</i>
                        </div>
                        <div class="content">
                            <div class="text"><h3> ADD BRANCH</h3></div>
                        </div>
                    </div>
                </div>
                        </div>
                        <div class="modal-body">
                            <form>
                            	{{ csrf_field() }}
                                <div class="row clearfix">
                                <div class="col-md-12">
                                <label for="contact_no">Branch Name</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id='name'>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <label for="address">Address</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="address" class="form-control" id='address'>
                                    </div>
                                </div>

                            <div class="row clearfix">
                                <div class="col-md-12">
                                <label for="contact_no">Contact Number</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id='contact'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-teal btn-lg waves-effect" id='add'>ADD</button>
                            <button type="button" class="btn bg-teal btn-lg waves-effect" data-dismiss="modal">CANCEL</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
    @include('admin.layout.scripts');
    <script>
    	$(document).ready(function (){
    		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    		
    		$('#branchTable').dataTable({
                bSort: false,
                "columnDefs": [
                    { 
                        className : "dt-right",
                        "targets" : [4]
                    }
                ]
    		});

    		var table = $('#branchTable').DataTable();

    		$('#add').on('click', function(){
    			$.ajax({
    				url : '/maintenance_branch',
    				method : 'POST',
    				data : {
    					_token : CSRF_TOKEN,
    					name : $('#name').val(),
    					address : $('#address').val(),
    					contact : $('#contact').val()
    				},
    				dataType : 'json',
    				success : function(response){
    					$('#defaultModal').modal('toggle');
    					var newrow = "<tr><td>"+response.Branch_ID+"</td><td>"+response.Branch_Name+"</td><td>"+response.Branch_Address+"</td><td>"+response.Branch_Contact+"</td><td><button type = 'button' class = 'edit btn btn-space bg-blue waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Update Record'><i class='material-icons'>update</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button></td></tr>";
    					table.row.add($(newrow)).draw();
    					swal({
    						title : "Branch Added",
    						type : "success",
    						timer : 1000,
    						showConfirmButton : false
    					});
    				}
    			});
    		});

    		$('#branchTable tbody').on('click', 'button.delete', function(){
    			var row = table.row($(this).parents('tr')).index();
    			var id = table.row($(this).parents('tr')).data()[0];
    			swal({
	  				title: "Are you sure?\nYou will not be able to recover this record!",
  					text: "Make Sure that this Branch is not available anymore and all of it's official will be vacant!",
  					type: "warning",
	  				showCancelButton: true,
  					confirmButtonClass: "btn-danger",
  					confirmButtonText: "Delete",
  					cancelButtonText: "Cancel",
  					closeOnConfirm: false,
	  				closeOnCancel: false
				},	
				function(isConfirm) {
  					if (isConfirm) {
  						$.ajax({
    						url : 'maintenance_branch',
    						method : 'POST',
	    					data : {
    							_token : CSRF_TOKEN,
    							_method : 'DELETE',
    							id : id 
    						},
    						success : function(){
    							table.row(row).remove().draw();
    							swal({
                                    title : "Deleted!", 
                                    text : "Record has been deleted",
                                    type :  "success",
                                    showConfirmButton : false,
                                    timer : 1000
                                });
    						}
	    				});
  					} 
  					else {
    					swal({
                            title : "Cancelled", 
                            text : "Record is not deleted",
                            type :  "error",
                            showConfirmButton : false,
                            timer : 1000
                        });
  					}
				});		
    		});
    	});
    </script>
    <script src="{{asset('plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
</body>
</html>