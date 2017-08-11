<!DOCTYPE html>
<html>
<head>
	<title>Blotter | Incident</title>
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
            
        </aside>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-teal">
                            <div class="icon">
                                <i class="material-icons">error</i>
                            </div>
                                <div class="content">
                                    <div class="text"><h3>INCIDENT</h3></div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row clearfix">
                                    <div class="col-lg-offset-11 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <a href="#" data-toggle="tooltip" title="Add Incident"><button type="button" class="btn bg-teal btn-circle-lg waves-effect waves-circle waves-float" data-toggle="modal" data-target="#defaultModal"><i class="material-icons">add</i></button></a>
                                    </div>
                                </div>
                                <br>
            <!-- Basic Table -->
            <div class="row">    
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body table-responsive">
                            <table class="table table-hover dataTable js-exportable" id="incTable">
                                <thead>
                                    <tr class="bg-blue-grey">
                                        <th>ID</th>
                                        <th>Place</th>
                                        <th>Date and Time</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
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
                                        <i class="material-icons">error</i>
                                        </div>
                                            <div class="content">
                                                <div class="text"><h3> ADD INCIDENT</h3></div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        
                        <div class="modal-body">
                            <form id="incident">
                                <div class="row clearfix">
                                <div class="col-md-2">
                                    <label>House No.</label>
                                </div>
                                <div class="col-md-6">
                                    <label>Street</label>
                                </div>
                                <div class="col-md-4">
                                    <label>Area</label>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="house" name="house">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="street" name="street">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control show tick" id="area" name="area">
                                            <option value="" disabled selected>Choose Area</option>
                                            <option value="Area A">Area A</option>
                                            <option value="Area B">Area B</option>
                                            <option value="Area C">Area C</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                             <div class="row clearfix">
                                <div class="col-md-6">
                                <label for="datetime">Incident Date and Time</label>
                                   <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="datetimepicker form-control" id="dt" placeholder="Please choose date & time...">
                                        </div>
                                    </div>
                                </div>
                            </div>

                                <label>Incident Description</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea rows="4" class="form-control no-resize" id="desc" name="desc" placeholder="Please type what you want..." required></textarea>
                                        </div>
                                    </div>
                            </div>
                        
                        <div class="modal-footer">
                            <button type="submit" class="btn bg-teal btn-lg waves-effect">ADD</button>
                            <button type="button" class="btn bg-teal btn-lg waves-effect" data-dismiss="modal">CANCEL</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>

<div class="modal fade" tabindex="-1" id="update" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row clearfix">
                    <div class="col-md-12">
                        <h2>Update Status</h2>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="card">
                    
                    <div class="row clearfix">
                        <br><br>
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-2">
                                <label>Current Status</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                        <select class="form-control show tick" id="stat" name="stat">
                                            <option value="Pending">Pending</option>
                                            <option value="On-going">On-going</option>
                                            <option value="Action Done">Action Done</option>
                                        </select>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="col-md-6 col-md-offset-6">
                            <button type="submit" class="btn btn-lg bg-teal waves-effect" id="updatebtn">Update</button>
                            <button type="button" class="btn bg-teal btn-lg waves-effect" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>

@include('admin.layout.scripts');
<script src="{{asset('plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
<script>
    $(document).ready(function(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var table = $('#incTable').DataTable({
            bSort: false,
            "ajax" : {
                    "url": "/incident/index",
                    "dataSrc" : function (json) {
                        var return_data = new Array();
                        for(var i=0;i< json.length; i++){
                            return_data.push({
                            'ID' : json[i].Incident_ID,
                            'Place' : json[i].Place,
                            'DateTime' : json[i].Incident_Datetime,
                            'Desc' : json[i].Incident_Statement,
                            'Status': json[i].Incident_Status,
                            'Button': "<button type = 'button' class = 'update btn btn-space bg-blue waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Update Record'><i class='material-icons'>update</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button>"
                            });
                        }     
                        return return_data;
                    }
                },
                "columns": [
                    { "data": "ID" },
                    { "data": "Place"},
                    { "data": "DateTime" },
                    { "data": "Desc" },
                    { "data": "Status" },
                    { "data": "Button" },
                ]
        });

        var finid;

        $.validator.addMethod("alpha", function(value, element) {
                return this.optional(element) || value == value.match(/^[a-zA-Z .,]*$/);
            },"Letters, spaces, period and comma only");

            $.validator.addMethod("letterwithbasicpunc", function(value, element) {
                return this.optional(element) || value == value.match(/^[a-zA-Z0-9 !()?.,]*$/);
            },"Letters and numbers with basic punctuations only");            

            $('#incident').validate({
                rules: {
                    house: {
                        required: false,
                        alphanumeric: true,
                        maxlength: 6
                    },
                    street:{
                        required: true,
                        letterwithbasicpunc: true,
                        maxlength: 50
                    },
                    area:{
                        required: true
                    },
                    desc:{
                        required: false,
                        maxlength: 300,
                        letterwithbasicpunc: true
                    }
                },
                submitHandler: function(form){
                    $.ajax({
                    url : '/incidentput',
                    method : 'POST',
                    data : {
                        _token : CSRF_TOKEN,
                        house : $('#huose').val(),
                        street : $('#street').val(),
                        desc : $('#desc').val(),
                        area : $('#area').val(),
                        datetime : $('#dt').val()
                    },
                    dataType : 'json',
                    success : function(response){
                        $('#defaultModal').modal('toggle');
                        var newRow = "<tr><td>"+response.Incident_ID+"</td><td>"+response.Incident_House+" "+response.Incident_Street+" '"+response.Incident_Area+"</td><td>"+response.Incident_Datetime+"</td><td>"+response.Incident_Statement+"</td><td>"+response.Incident_Status+"</td><td><button type = 'button' class = 'update btn btn-space bg-blue waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Update Record'><i class='material-icons'>update</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button></td></tr>";
                        table.row.add($(newRow)).draw();
                        swal({
                            title : "Record Added",
                            type : "success",
                            timer : 1000,
                            showConfirmButton : false
                        });
                        
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

         $('#incTable tbody').on('click', 'button.update', function(){
                var id = table.row($(this).parents('tr')).data().ID;    
                finid = id;
                $.ajax({
                    url: 'incident_getstat/'+id,
                    method: 'GET',
                    data : {
                        _token : CSRF_TOKEN,
                        id : id
                    },
                    dataType : 'json',
                    success : function(response){
                        $('#stat').val(response[0].Incident_Status).change();
                        $('#update').modal('toggle');
                    }
                });
                
                
            });

         $('#incTable tbody').on('click', 'button.delete', function(){
                var id = table.row($(this).parents('tr')).data().ID;    
                finid = id;
                $.ajax({
                    url: 'incident_delete/'+id,
                    method: 'POST',
                    data : {
                        _token : CSRF_TOKEN,
                        method: 'DELETE',
                        id : id
                    },
                    dataType : 'json',
                    success : function(response){
                        if(response=="success"){
                                swal({
                                    title : "Record Deleted",
                                    type : "success",
                                    timer : 1000,
                                    showConfirmButton : false
                                });
                                table.ajax.reload();
                        }
                        else{
                            swal({
                                    title : "Record is not Deleted",
                                    type : "erro",
                                    timer : 1500,
                                    showConfirmButton : false
                                });
                        }
                    }
                });
                
                
            });

         $('#updatebtn').on('click', function(){
            $.ajax({
                url : '/incident_update',
                method: 'POST',
                data:{
                    _token : CSRF_TOKEN,
                    id : finid,
                    stat : $('#stat').val()
                },
                success: function(){
                    swal({
                            title : "Record Update",
                            type : "success",
                            timer : 1000,
                            showConfirmButton : false
                        });
                    table.ajax.reload();
                    $('#update').modal('toggle');
                }
            })
         });

    });
</script>
</body>
</html>
