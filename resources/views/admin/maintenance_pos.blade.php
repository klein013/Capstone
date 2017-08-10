<!DOCTYPE html>
<html>
<head>
	<title>Maintenance | Position</title>
	@include('admin.layout.head');
	<!-- JQuery DataTable Css -->
    <link href="{{asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
</head>
<body class="theme-blue-grey">
	@include('admin.layout.nav');
	@include('admin.layout.aside');
	  <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                <div class="col-lg-5 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-teal">
                        <div class="icon">
                            <i class="material-icons">add_location</i>
                        </div>
                        <div class="content">
                            <div class="text"><h3> BARANGAY POSITION</h3></div>
                        </div>
                    </div>
                </div>


            </div>
            </div>
            <!-- Basic Table -->
            <div class="col-lg-offset-11 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                	<a href="javascript:void(0)" data-toggle="tooltip" title="Add Barangay Position"><button type="button" class="btn bg-teal btn-circle-lg waves-effect waves-circle waves-float" data-toggle="modal" data-target="#defaultModal"><i class="material-icons">add</i></button></a>
                </div>
            <br>
            <div class="row">    
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                	<div class="card">
                        <div class="body table-responsive">
                            <table class="table table-hover dataTable js-exportable" id="PosTable">
                                <thead>
                                    <tr class="bg-blue-grey">
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Manages</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
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
                                <div class="col-lg-9 col-md-3 col-sm-6 col-xs-12">
                                    <div class="info-box bg-teal">
                                        <div class="icon">
                                            <i class="material-icons">person_add</i>
                                        </div>
                                        <div class="content">
                                            <div class="text"><h3> ADD BARANGAY POSITION</h3></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <form id="positionform">
                                {{ csrf_field() }}
                                <label for="Position">Position</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="name" name="pos" class="form-control">
                                    </div>
                                </div>
                                <label for="description">Description</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea rows="4" name="desc" class="form-control no-resize" placeholder="Please type the position's description..." id="desc"></textarea>
                                    </div>
                                </div>
                                <br>
                                <label>Manages</label>
                                <div class="row clearfix">
                                    <div class ="col-md-12">
                                        <div class="form-group">
                                            <select class="form-control show-tick" id="manage" name="manage">
                                                <option value="" disabled>Pick</option>
                                                <option value="Blotter">Blotter</option>
                                                <option value="Clearance">Clearance</option>
                                                <option value="Both">Both</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="count">Count</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="number" class="form-control" id="count" name="count">
                                            </div>
                                        </div>
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
                            <div class="text"><h3>UPDATE BARANGAY POSITION</h3></div>
                        </div>
                    </div>
                </div>
                        </div>
                        <div class="modal-body">
                            <form id="updatePositionform">
                                {{ csrf_field() }}
                                <label for="Position">Position</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="upname" name="uppos" class="form-control">
                                    </div>
                                </div>
                          

                           
                            <label for="description">Description</label>
                                <div class="form-group">
                                        <div class="form-line">
                                            <textarea rows="4" name="updesc" class="form-control no-resize" placeholder="Please type the position's description..." id="updesc"></textarea>
                                        </div>
                            <br>
                            <label>Manages</label>
                            <div class="row clearfix">
                                <div class ="col-md-12">
                                <div class="form-group">
                                    <select class="form-control show-tick" id="upmanage" name="upmanage">
                                    <option value="" disabled>Pick</option>
                                    <option value="Blotter">Blotter</option>
                                    <option value="Clearance">Clearance</option>
                                    <option value="Both">Both</option>
                                    </select>
                                </div>
                                </div>
                            </div>
                            <br>
                            <div class="row clearfix">
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-6">
                                    <label for="count">Count</label>
                                       <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" class="form-control" id="upcount" name="upcount">
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn bg-teal btn-lg waves-effect" id="upadd">UPDATE</button>
                            <button type="button" class="btn bg-teal btn-lg waves-effect" data-dismiss="modal">CANCEL</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
    @include('admin.layout.scripts');
    <script src="{{asset('plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){
            
            var table = $('#PosTable').DataTable({
                "bSort": false,
                "ajax" : {
                    "url": "/maintenance_pos/getPositions",
                    "dataSrc" : function (json) {
                        var return_data = new Array();
                        for(var i=0;i< json.length; i++){
                            var desc ;
                            if(json[i].position_desc==null){
                                desc="";
                            }
                            else{
                                desc=json[i].position_desc;
                            }
                            return_data.push({
                            'ID' : json[i].position_id,
                            'Name' : json[i].position_name,
                            'Desc' : desc,
                            'Manage': json[i].position_manage,
                            'Button': "<button type = 'button' class = 'update btn btn-space bg-blue waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Update Record'><i class='material-icons'>update</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button>"
                            });
                        }     
                        return return_data;
                    }
                },
                "columns": [
                    { "data": "ID" },
                    { "data": "Name"},
                    { "data": "Desc" },
                    { "data": "Manage" },
                    { "data": "Button" },
                ]
            });

            $.validator.addMethod("alpha", function(value, element) {
                return this.optional(element) || value == value.match(/^[a-zA-Z .,]*$/);
            },"Letters, spaces, period and comma only");

            $.validator.addMethod("letterwithbasicpunc", function(value, element) {
                return this.optional(element) || value == value.match(/^[a-zA-Z0-9 !()?.,]*$/);
            },"Letters and numbers with basic punctuations only");            

            $('#positionform').validate({
                rules: {
                    pos: {
                        required: true,
                        alpha: true,
                        maxlength: 30
                    },
                    desc:{
                        required: false,
                        maxlength: 300,
                        letterwithbasicpunc: true
                    },
                    count:{
                        required: true,
                        min: 1,
                        max: 50   
                    },
                    manage:{
                        required: true
                    }
                },
                submitHandler: function(form){
                    $.ajax({
                    url : '/maintenance_pos',
                    method : 'POST',
                    data : {
                        _token : CSRF_TOKEN,
                        name : $('#name').val(),
                        desc : $('#desc').val(),
                        count : $('#count').val(),
                        manage : $('#manage').val()
                    },
                    dataType : 'json',
                    success : function(response){
                        if(response!=""){
                        $('#defaultModal').modal('toggle');
                        var newRow = "<tr><td>"+response.position_id+"</td><td>"+response.position_name+"</td><td>"+response.position_desc+"</td><td>"+response.position_manage+"</td><td><button type = 'button' class = 'update btn btn-space bg-blue waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Update Record'><i class='material-icons'>update</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button></td></tr>";
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
                                title: "Record not Added",
                                text: "Position exists",
                                type: "error",
                                timer: 1000,
                                showConfirmButton: false
                            });
                            $('#defaultModal').modal('toggle');
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


            $('#PosTable tbody').on('click', 'button.delete', function(){
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
                            url : 'maintenance_pos',
                            method : 'POST',
                            data : {
                                _token : CSRF_TOKEN,
                                _method : 'DELETE',
                                id : id 
                            },
                            success : function(response){
                                if(response=="success"){
                                    table.row(row).remove().draw();
                                    swal({
                                        title : "Deleted!", 
                                        text : "Record has been deleted",
                                        type :  "success",
                                        showConfirmButton : false,
                                        timer : 1000
                                  });
                                }
                                else{
                                    swal({
                                        title : "Cancelled", 
                                        text : "Record is not deleted, Position is taken by an Official",
                                        type :  "error",
                                        showConfirmButton : false,
                                        timer : 1500
                                    });
                                }
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

            var count =1 ; 
            var finid;

            $('#PosTable tbody').on('click', 'button.update', function(){
                var id = table.row($(this).parents('tr')).data();
                finid = id.ID;
                $.ajax({
                    url: 'maintenance_pos/'+id.ID,
                    method: 'GET',
                    data: {
                        id : id.ID
                    },
                    success: function(response){
                        $('#upname').val(response[0].position_name);
                        $('#updesc').val(response[0].position_desc);
                        $('#upcount').val(response[0].position_count);
                        if(response[0].Off_Count==0){
                            count = 1;
                        }
                        else{
                            count = response[0].Off_Count;
                        }
                        $('#upmanage').val(response[0].position_manage).change();
                        $('#updateModal').modal('toggle');
                    }
                });
            });

            $('#updatePositionform').validate({
                rules: {
                    uppos: {
                        required: true,
                        alpha: true,
                        maxlength: 30
                    },
                    updesc:{
                        required: false,
                        maxlength: 300,
                        letterwithbasicpunc: true
                    },
                    upcount:{
                        required: true,
                        min: count,
                        max: 50   
                    },
                    upmanage:{
                        required: true
                    }
                },
                submitHandler: function(form){
                    $.ajax({
                    url : '/maintenance_pos/update',
                    method : 'POST',
                    data : {
                        _token : CSRF_TOKEN,
                        id : finid,
                        name : $('#upname').val(),
                        desc : $('#updesc').val(),
                        count : $('#upcount').val(),
                        manage : $('#upmanage').val()
                    },
                    dataType : 'json',
                    success : function(response){
                        $('#updateModal').modal('toggle');
                        table.ajax.reload();
                        swal({
                            title : "Updated!", 
                            text : "Record has been updated",
                            type :  "success",
                            showConfirmButton : false,
                            timer : 1000
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
        });
    </script>
    <!-- Jquery DataTable Plugin Js -->
    
    <!--<script src="{{asset('plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>
    <script src="{{asset('js/pages/tables/jquery-datatable.js')}}"></script>
    <script src="{{asset('js/pages/tables/jquery-datatable.min.js')}}"></script>-->
</body>
</html>