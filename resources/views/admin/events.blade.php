<!DOCTYPE html>
<html>
<head>
	<title>Utilities | Events</title>
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
                            <i class="material-icons">event</i>
                        </div>
                        <div class="content">
                            <div class="text"><h3>EVENTS</h3></div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
                <div class="col-sm-1 col-sm-offset-11">
                    <button type="button" id="addmodal" class="btn btn-space bg-teal waves-effect"><i class="material-icons">add</i>Add Event</button>
                </div>
        </div>
<br><br>
        <div class="card">
            <div class="row clearfix">

                    
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                	<div class="body table-responsive">
                		<table class="table table-bordered table-condensed table-striped table-hover dataTable" id="event">
                			<thead>
                				<tr class='bg-blue-grey'>
                					<td>ID</td>
                					<td>Event Name</td>
                					<td>Event Description</td>
                					<td>Actions</td>
                				</tr>
                			</thead>
                			<tbody>
                			</tbody>
                		</table>
                	</div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="row clearfix">
                                <div class="col-lg-9 col-md-3 col-sm-6 col-xs-12">
                                    <div class="info-box bg-teal">
                                        <div class="icon">
                                            <i class="material-icons">person_add</i>
                                        </div>
                                        <div class="content">
                                            <div class="text"><h3> ADD EVENT</h3></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <form id="eventform">
                                {{ csrf_field() }}
                                <label for="eventname">Event Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="eventname" name="eventname" class="form-control">
                                    </div>
                                </div>
                                <br>
                                <label>Event Description</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea id="eventdesc" name="eventdesc" class="form-control"></textarea>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn bg-teal btn-lg waves-effect" id="add">ADD</button>
                            <button type="button" class="btn bg-teal btn-lg waves-effect" data-dismiss="modal">CANCEL</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="row clearfix">
                <div class="col-lg-9 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-teal">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text"><h3>UPDATE EVENT</h3></div>
                        </div>
                    </div>
                </div>
                        </div>
                        <div class="modal-body">
                            <form id="updateeventform">
                                {{ csrf_field() }}
                                <label for="eventname">Event Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="upeventname" name="upeventname" class="form-control">
                                    </div>
                                </div>
                                <br>
                                <label>Event Description</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea type="text" id="upeventdesc" name="upeventdesc" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn bg-teal btn-lg waves-effect" id="updatebtn">UPDATE</button>
                            <button type="button" class="btn bg-teal btn-lg waves-effect" data-dismiss="modal">CANCEL</button>
                        </div>
                        </form>
                </div>
            </div>
	</section>
	@include('admin.layout.scripts');
	<script src="{{asset('plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
    <script>
       $(document).ready(function(){


            var csrf_token = $('meta[name="csrf-token"]').attr('content');

            var idtoupdate = "";

            $('#addmodal').on('click', function(){
                $('#defaultModal').modal('toggle');
            });

            var table = $('#event').DataTable({
                "bSort": false,
                "ajax": {
                    "url" : "/utilities/events/show",
                    "method": "GET",
                    "data" : "json",
                    "dataSrc": function (json) {
                        var return_data = new Array();
                        for(var i=0;i< json.length; i++){
                            return_data.push({
                            'ID' : json[i].hs_id,
                            'Name' : json[i].hs_name,
                            'Desc' : json[i].hs_desc,
                            'Actions': "<button type = 'button' class = 'update btn btn-space bg-blue waves-effect' data-toggle = 'tooltip' value='"+json[i].hs_id+"' data-placement = 'bottom' title data-original-title='Update Record'><i class='material-icons'>create</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' value='"+json[i].hs_id+"' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button>"
                            });
                        }     
                        return return_data;
                    }
            },
            "columns" : [
                {"data" : "ID"},
                {"data" : "Name"},
                {"data" : "Desc"},
                {"data" : "Actions"}
            ]
            });

            $('#event tbody').on('click', 'button.update', function(){
                idtoupdate = $(this).val();
                $.ajax({
                    url: '/utilities/events/update/'+$(this).val(),
                    method: 'GET',
                    success: function(response){
                        $('#upeventname').val(response[0].hs_name);
                        $('#upeventdesc').val(response[0].hs_desc);
                    }
                });
                $('#updateModal').modal('toggle');
            });


            $.validator.addMethod("alpha", function(value, element) {
                return this.optional(element) || value.trim() == value.match(/^[a-zA-Z .,]*$/);
            },"Letters, spaces, period and comma only");

            $.validator.addMethod("letterwithbasicpunc", function(value, element) {
                return this.optional(element) || value.trim() == value.match(/^[a-zA-Z0-9 !()?.,\S\s]*$/);
            },"Letters and numbers with basic punctuations only");            

            $('#eventform').validate({
                rules: {
                   eventname: {
                        required: true,
                        alpha: true,
                        maxlength: 30
                    },
                    eventdesc:{
                        required: true,
                        letterwithbasicpunc: true,
                        maxlength: 500
                    }
                },
                submitHandler: function(form){
                    $.ajax({
                    url : '/utilities/events/store',
                    method : 'POST',
                    data : {
                        _token : csrf_token,
                        name : $('#eventname').val(),
                        desc : $('#eventdesc').val()
                    },
                    dataType : 'json',
                    success : function(response){
                        if(response!=null){
                        console.log(response);
                        var newRow = "<tr><td>"+response.hs_id+"</td><td>"+response.hs_name+"</td><td>"+response.hs_desc+"</td><td><button type = 'button' class = 'update btn btn-space bg-blue waves-effect' data-toggle = 'tooltip' value='"+response.hs_id+"' data-placement = 'bottom' title data-original-title='Update Record'><i class='material-icons'>create</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' value='"+response.hs_id+"' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button></td></tr>";
                        table.row.add($(newRow)).draw();
                        swal({
                            title : "Record Added",
                            type : "success",
                            showConfirmButton : true
                        });
                        }
                        else{
                            swal({
                                title: "Record not Added",
                                text: "Error",
                                type: "error",
                                showConfirmButton: true
                            });
                         
                        }
                        
                        $('#defaultModal').modal('toggle');
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

            $('#event tbody').on('click', 'button.delete', function(){
                var id = $(this).val();
                 swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this record!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Delete",
                    cancelButtonText: "Cancel",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },  
                function(isConfirm) {
                    if (isConfirm){
                $.ajax({
                    'url': '/utilities/events/delete',
                    'method' : 'delete' ,
                    'data' :{
                        _token : csrf_token,
                        id: id
                    },
                    'success' : function(response){
                        if(response=="success"){
                         swal({
                            title : "Record Removed",
                            type : "success",
                            showConfirmButton : true
                        });
                        table.ajax.reload();
                    }
                    }
                });
                    }else{
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

            $('#updateeventform').validate({
                rules: {
                   upeventname: {
                        required: true,
                        alpha: true,
                        maxlength: 30
                    },
                    upeventdesc:{
                        required: true,
                        letterwithbasicpunc: true,
                        maxlength: 500
                    }
                },
                submitHandler: function(form){
                    $.ajax({
                    url : '/utilities/events/update',
                    method : 'POST',
                    data : {
                        _token : csrf_token,
                        id : idtoupdate,
                        name : $('#upeventname').val(),
                        desc : $('#upeventdesc').val()
                    },
                    success : function(response){
                        
                        if(response=="success"){
                        $('#updateModal').modal('toggle');
                        table.ajax.reload();

                        swal({
                            title : "Record Updated",
                            type : "success",
                            showConfirmButton : true
                        });
                        }
                        else{
                            swal({
                                title: "Record not Updated",
                                text: "Error",
                                type: "error",
                                showConfirmButton: true
                            });
                            $('#updateModal').modal('toggle');
                         
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