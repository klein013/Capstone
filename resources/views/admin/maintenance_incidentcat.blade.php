<!DOCTYPE html>
<html>
<head>
	<title>Maintenance | Incident Category</title>
	@include('admin.layout.head');
	<!-- JQuery DataTable Css -->
    <link href="{{asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">

</head>
<body class="theme-blue-grey">
	@include('admin.layout.nav');
	<aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
           <div class="user-info">
                <div class="image">
                    <img src="{{asset($return['image'])}}" width="48" height="48" alt="User" />
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
                            <i class="material-icons">gavel</i>
                        </div>
                        <div class="content">
                            <div class="text"><h3> INCIDENT CATEGORY</h3></div>
                        </div>
                    </div>
                </div>


            </div> </div> <!-- Basic Table --> <div class="row clearfix"> <div
            class="col-sm-2 col-sm-offset-10">     <button type="button"
            class="btn bg-teal btn-lg waves-effect waves-float pull-right"
            data-toggle="modal" data-target="#defaultModal"><i class
            ="material-icons">add</i>Add Incident Category</button> </div>
            </div>
            
            <br>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body table-responsive">
                            <table class="table dataTable table-condensed table-bordered table-striped table-hover" width="100%;" id="CaseTable">
                                <thead>
                                    <tr class="bg-blue-grey">
                                        <th>ID</th>
                                        <th>INCIDENT NAME</th>
                                        <th>INCIDENT DESCRIPTION</th>
                                        <th>ACTIONS</th>
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
	</section>
	<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="row clearfix">
                <div class="col-lg-9 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-teal">
                        <div class="icon">
                            <i class="material-icons">note_add</i>
                        </div>
                        <div class="content">
                            <div class="text"><h3> ADD INCIDENT CATEGORY</h3></div>
                        </div>
                    </div>
                </div>
                        </div>
                        <div class="modal-body">
                            <form id="casesform">
                                {{ csrf_field() }}
                                <label for="Case Name">Incident Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type='text' id='txtname' name="txtname" class='form-control'>
                                    </div>
                                </div>
                            <label for="description">Description</label>
                                <div class="form-group">
                                        <div class="form-line">
											<input type='desc' id='txtdesc' name="txtdesc" class='form-control no-resize' placeholder="Please type the incident's description" rows='4'>
                                        </div>
                                    </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class='btn bg-teal btn-lg waves-effect' id='add'>ADD</button>
                            <button type="button" class="btn bg-teal btn-lg waves-effect" data-dismiss="modal">CANCEL</button>
                            </form>
                        </div>
                    </div>
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
                            <i class="material-icons">note_add</i>
                        </div>
                        <div class="content">
                            <div class="text"><h3> UPDATE INCIDENT CATEGORY</h3></div>
                        </div>
                    </div>
                </div>
                        </div>
                        <div class="modal-body">
                            <form id="casesupform">
                                {{ csrf_field() }}
                                <label for="Case Name">Incident Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type='text' id='uptxtname' name="uptxtname" class='form-control'>
                                    </div>
                                </div>
                            <label for="description">Description</label>
                                <div class="form-group">
                                        <div class="form-line">
                                            <input type='desc' id='uptxtdesc' name="uptxtdesc" class='form-control no-resize' placeholder="Please type the incident's description" rows='4'>
                                        </div>
                                    </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class='btn bg-teal btn-lg waves-effect' id='upadd'>UPDATE</button>
                            <button type="button" class="btn bg-teal btn-lg waves-effect" data-dismiss="modal">CANCEL</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>

	@include('admin.layout.scripts');
    <!-- Jquery DataTable Plugin Js -->
    <script>
		$(document).ready(function(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            var table = $('#CaseTable').DataTable({
                "bSort": false,
                "ajax" : {
                    "url": "/maintenance/blotter/incident/getincident",
                    "dataSrc" : function (json) {
                        var return_data = new Array();
                        for(var i=0;i< json.length; i++){
                            var desc ;
                            if(json[i].incidentcat_desc==null){
                                desc="";
                            }
                            else{
                                desc=json[i].incidentcat_desc;
                            }
                            return_data.push({
                            'ID' : json[i].incidentcat_id,
                            'Name' : json[i].incidentcat_name,
                            'Desc' : desc,
                            'Button': "<button type = 'button' class = 'update btn btn-space bg-blue waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Update Record'><i class='material-icons'>create</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button>"
                            });
                        }     
                        return return_data;
                    }
                },
                "columns": [
                    { "data": "ID" },
                    { "data": "Name"},
                    { "data": "Desc" },
                    { "data": "Button" },
                ]
            });

        $.validator.addMethod("alpha", function(value, element) {
                return this.optional(element) || value == value.match(/^[a-zA-Z .,]*$/);
            },"Letters, spaces, period and comma only");


        $.validator.addMethod("letterwithbasicpunc", function(value, element) {
            return this.optional(element) || value == value.match(/^[a-zA-Z0-9 !()?.,]*$/);
        },"Letters and numbers with basic punctuations only");            

        $('#casesform').validate({
            rules:{
                txtname: {
                    required: true,
                    alpha: true,
                    maxlength: 100
                },
                txtdesc: {
                    required: false,
                    maxlength: 300,
                    letterwithbasicpunc: true
                }
            },
            submitHandler : function(form){
                $.ajax({
                url : "/maintenance/blotter/incident",
                method : "POST",
                data : {
                    _token : CSRF_TOKEN,
                    name : $('#txtname').val(),
                    desc : $('#txtdesc').val()
                },
                dataType : 'json',
                success : function(response){
                    $('#defaultModal').modal('toggle');
                    if(response!=null){
                        var desc;
                        if(response.incidentcat_desc==null){
                            desc="";
                        }
                        else{
                            desc= response.incidentcat_desc;
                        }
                        var newRow = "<tr><td>"+response.incidentcat_id+"</td><td>"+response.incidentcat_name+"</td><td>"+desc+"</td><td><button type = 'button' class = 'update btn btn-space bg-blue waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Update Record'><i class='material-icons'>create</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button></td></tr>";
                        table.row.add($(newRow)).draw();
                        swal({
                            title : "Record Added",
                            type : "success",
                            timer : 1000,
                            showConfirmButton : false
                        });
                    }
                    else{
                        swal({
                            title : "Record already exists",
                            type : "error",
                            timer : 1000,
                            showConfirmButton : false
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

        $('#CaseTable tbody').on('click', 'button.delete', function(){
            var row = table.row($(this).parents('tr')).index();
            var id = table.row($(this).parents('tr')).data().ID;
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
                            url : '/maintenance/blotter/incident/'+id,
                            method : 'POST',
                            data : {
                                _token : CSRF_TOKEN,
                                _method: 'DELETE'
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

        var finid;
        $('#CaseTable').on('click','button.update', function(){
            var id = table.row($(this).parents('tr')).data().ID;
            finid = id;
            $.ajax({
                url: '/maintenance/blotter/incident/get/'+id,
                method: 'GET',
                success: function(response){
                    $('#uptxtname').val(response[0].incidentcat_name);
                    $('#uptxtdesc').val(response[0].incidentcat_desc);
                    $('#updateModal').modal('toggle');
                }
            });
        });

        $('#casesupform').validate({
            rules:{
                uptxtname: {
                    required: true,
                    alpha: true,
                    maxlength: 100
                },
                uptxtdesc: {
                    required: false,
                    maxlength: 300,
                    letterwithbasicpunc: true
                }
            },
            submitHandler : function(form){
                $.ajax({
                url : "/maintenance/blotter/incident/updated",
                method : "POST",
                data : {
                    _token : CSRF_TOKEN,
                    id : finid,
                    name : $('#uptxtname').val(),
                    desc : $('#uptxtdesc').val()
                },
                success : function(response){
                    table.ajax.reload();
                    $('#updateModal').modal('toggle');
                    if(response=="success"){
                        swal({
                            title : "Success!", 
                            text : "Record has been updated",
                            type :  "success",
                            showConfirmButton : false,
                            timer : 1000
                        });
                    }
                    else{
                        swal({
                            title : "Error!", 
                            text : "Record is not updated",
                            type :  "error",
                            showConfirmButton : false,
                            timer : 1000
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

    
    <script src="{{asset('plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script></body>
</html>
