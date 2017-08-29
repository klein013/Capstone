<!DOCTYPE html>
<html>
<head>
	<title>Maintenance | Clearance</title>
	@include('admin.layout.head');
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
                    <div class="email">Official ID: <strong id="sessionpos">{{$return['position']}}</strong></div>
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
                            <i class="material-icons">description</i>
                        </div>
                        <div class="content">
                            <div class="text"><h3> BARANGAY CLEARANCE</h3></div>
                        </div>
                    </div>
                </div>


            </div>
            </div>
    
            <div class="row clearfix">
                                    <div class="col-sm-2 col-sm-offset-10">
                                        <button type="button" class="btn bg-teal btn-lg waves-effect waves-float pull-right" data-toggle="modal" data-target="#defaultModal"><i class="material-icons">add</i>Add Clearance</button>
                                    </div>
                                </div>
                                <br>
            <br>
	
            <!-- Basic Table -->

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                	<div class="card">
                        <div class="body table-responsive">
                            <table class="table dataTable js-exportable" id='clearanceTable'>
                                <thead>
                                    <tr class="bg-blue-grey">
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Requirements</th>
                                        <th>Price</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# With Material Design Colors -->
        </div>
    </section>

<div id="updateModal" class="modal fade" tabindex="-1" role='dialog'>
	<div class="modal-dialog" role="document">
	    <div class="modal-content">
            <div class="modal-header">
                <div class="row clearfix">
                    <div class="col-lg-7 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-teal">
                            <div class="icon"><i class="material-icons">description</i></div>
                        	<div class="content">
                    			<div class="text"><h3> UPDATE CLEARANCE</h3></div>
                			</div>	
            			</div>
            		</div>
            	</div>
            </div>
            <div class="modal-body">
            	<form id="upclearance">
            		{{ csrf_field() }}
            		<div class="row clearfix">
            			<div class="col-md-12">
            				<div class="form-group">
	            				<label>Clearance Name</label>
    	        				<div class="form-line">
        	    					<input type="text" class="form-control" id="upcname" name="upcname" required>
            					</div>
            				</div>
            			</div>
            		</div>
            		<div class="row clearfix">
            			<div class="col-md-12">
            				<div class="form-group">
            					<label>Clearance Description</label>
            					<div class="form-line">
            						<textarea rows="3" class="form-control no-resize" placeholder="Please type the description..." id="updesc" name="updesc"></textarea>
            					</div>
            				</div>
            			</div>
            		</div>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Clearance Price</label>
                                <div class="form-line">
                                    <input type="number" class="form-control" step="0.01" id="upprice" name="upprice" required>
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Clearance Requirement</label>
                                    <div class="demo-checkbox">
                                        @foreach($reqs as $req)
                                            <input type="checkbox" class="cbup" id="up{{ $req->requirement_id }}" value="{{ $req->requirement_id }}"/>
                                        <label for="up{{ $req->requirement_id }}">{{ $req->requirement_name }}</label>
                                        @endforeach
                                    </div>
                            </div>
                        </div>
                    </div>
            		<div class="row clearfix">
            			<div class="col-md-6 col-md-offset-6">
            				<button type="submit" class="btn bg-teal btn-lg waves-effect" id='upadd'>UPDATE</button>
                            <button type="button" class="btn bg-teal btn-lg waves-effect" data-dismiss="modal">CANCEL</button>
            			</div>
            		</div>
            	</form>
            </div>
        </div>
	</div>
</div>
<form id="clearance">
{{ csrf_field() }}
<div id="defaultModal" class="modal fade" tabindex="-1" role='dialog'>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row clearfix">
                    <div class="col-lg-7 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-teal">
                            <div class="icon"><i class="material-icons">description</i></div>
                            <div class="content">
                                <div class="text"><h3> ADD CLEARANCE</h3></div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body">
            <form>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Clearance Name</label>
                                <div class="form-line">
                                    <input type="text" class="form-control" id="cname" name="cname" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Clearance Description</label>
                                <div class="form-line">
                                    <textarea rows="3" class="form-control no-resize" placeholder="Please type the description..." id="desc" name="desc"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Clearance Price</label>
                                <div class="form-line">
                                    <input type="number" class="form-control" step="0.01" id="price" name="price" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Clearance Requirement</label>
                                    <div class="demo-checkbox">
                                        @foreach($reqs as $req)
                                            <input type="checkbox" class="cbadd" id="{{ $req->requirement_id }}" value="{{ $req->requirement_id }}"/>
                                        <label for="{{ $req->requirement_id }}">{{ $req->requirement_name }}</label>
                                        @endforeach
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-4 col-md-offset-8">
                            <button type="button" class="btn bg-teal btn-lg waves-effect"  data-toggle="modal" data-target="#largeModal" id='next'>NEXT</button>
                            <button type="button" class="btn bg-teal btn-lg waves-effect" data-dismiss="modal">CANCEL</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="largeModalLabel">Create Content of Clearance</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                            <div class="form-line">
                            <textarea id="myTextarea" class="form-control" name="myTextarea"></textarea>
                            </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn bg-teal btn-lg waves-effect">SAVE</button>
                            <button type="button" class="btn bg-teal btn-lg waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
</form>
@include('admin.layout.scripts');
<script src="{{asset('plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
<script src='{{asset("tinymce/tinymce.min.js")}}'></script>
<script src="{{asset('tinymce/jquery.tinymce.min.js')}}"></script>
<script>
	$(document).ready(function(){
		var CSRF_TOKEN = $('meta[name="csrf-token"').attr('content');
		
        tinymce.init({
            selector: '#myTextarea',
            theme: 'modern',
            menubar: false,
            resize: false,
            branding: false,
            width: 850,
            height: 500,
            plugins: [
                'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                'save table contextmenu directionality emoticons template paste textcolor'
            ],
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons'
        });


        var row;
        var id;
		var table = $('#clearanceTable').DataTable({
            "bSort": false,
            "ajax": {
                "url" : "/maintenance/clearance/clearance/getClearances",
                "dataSrc": function (json) {
                        var return_data = new Array();
                        for(var i=0;i< json.length; i++){
                            return_data.push({
                            'ID' : json[i].clearance_id,
                            'Name' : json[i].clearance_type,
                            'Req' : json[i].clearance_requirements,
                            'Price': json[i].clearance_price,
                            'Button': "<button type = 'button' class = 'update btn btn-space bg-blue waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Update Record'><i class='material-icons'>create</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button>"
                            });
                        }     
                        return return_data;
                    }
            },
            "columns" : [
                {"data" : "ID"},
                {"data" : "Name"},
                {"data" : "Req"},
                {"data" : "Price"},
                {"data" : "Button"}
            ]

        });

	   $('#clearanceTable tbody').on('click', 'button.update', function(){
            row = table.row($(this).parents('tr')).index();
            id = table.row($(this).parents('tr')).data().ID;
            $('input:checkbox').removeAttr('checked');
            $.ajax({
                url: '/maintenance/clearance/clearance/'+id,
                method: 'POST',
                data: {
                    _token : CSRF_TOKEN,
                    id :  id
                },
                dataType: 'json',
                success: function(response){
                    $('#upcname').val(response[0].clearance_type);
                    $('#updesc').val(response[0].clearance_desc);
                    $('#upprice').val(response[0].clearance_price);
                    if(response[0].clearance_requirements!=null){
                        var reqs = response[0].clearance_requirements.split(',');
                        jQuery.each(reqs, function(i, valww){
                            var sss = '#up'+valww;
                            $(sss).prop('checked', true);
                        });
                    }
                    $('#updateModal').modal('toggle');
                }
            });
       });

       $('#clearanceTable tbody').on('click', 'button.delete', function(){
            row = table.row($(this).parents('tr')).index();
            id = table.row($(this).parents('tr')).data().ID;
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
                            url: '/maintenance/clearance/clearance/'+id,
                            method: 'POST',
                            data: {
                                _token : CSRF_TOKEN,
                                _method: "DELETE"
                                },
                            success: function(){
                                swal({  
                                title: "Success",
                                text: "Record Deleted",
                                type: "success",
                                timer: 1000,
                                showConfirmButton: false
                            });
                                table.ajax.reload();
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


       $.validator.addMethod("alphanum", function(value, element) {
                return this.optional(element) || value == value.match(/^[a-zA-Z0-9 .,]*$/);
            },"Letters, Numbers, spaces, period and comma only");

       $('#upclearance').validate({
            rules:{
                upcname:{
                    alphanum: true,
                    maxlength: 100,
                    minlength: 10
                },
                updesc: {
                    required: false,
                    alphanum: 300,
                    minlength: 10
                },
                upprice: {
                    required: true,
                    number: true,
                    min: 0,
                    maxlength: 10
                }
            },
            submitHandler: function(form){
                $.ajax({
                    url: '/maintenance/clearance/clearance/update/up',
                    method: 'POST',
                    data: {
                        _token : CSRF_TOKEN,
                        id : id,
                        name : $('#upcname').val(),
                        desc : $('#updesc').val(),
                        price : $('#upprice').val(),
                        req : $('.cbup:checked').map(function() {return this.value;}).get().join(',')
                    },
                    dataType: 'json',
                    success: function(response) {
                        table.ajax.reload();
                        if(response=="success"){
                        swal({
                                title: "Success",
                                text: "Record Update",
                                type: "success",
                                timer: 1000,
                                showConfirmButton: false
                            });
                        }
                        else{
                            
                        }

                            $('#updateModal').modal('toggle');

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

        $('#clearance').validate({
            rules:{
                cname:{
                    alphanum: true,
                    maxlength: 100,
                    minlength: 10
                },
                desc: {
                    required: false,
                    alphanum: 300,
                    minlength: 10
                },
                price: {
                    required: true,
                    number: true,
                    min: 0,
                    maxlength: 10
                },
                myTextarea: {
                    required: true
                }
            },
            submitHandler: function(form){
                $.ajax({
                    url: '/maintenance/clearance/clearance',
                    method: 'POST',
                    data: {
                        _token : CSRF_TOKEN,
                        name : $('#cname').val(),
                        desc : $('#desc').val(),
                        price : $('#price').val(),
                        req : $('.cbadd:checked').map(function() {return this.value;}).get().join(','),
                        cont: tinyMCE.get('myTextarea').getContent()
                    },
                    dataType: 'json',
                    success: function(response) {
                        if(response!=null){
                        table.ajax.reload();
                        swal({
                                title: "Success",
                                text: "Record Added",
                                type: "success",
                                timer: 1000,
                                showConfirmButton: false
                            });
                            $('#defaultModal').modal('toggle');
                        }
                        else{
                            $('#defaultModal').modal('toggle');   
                            swal({
                                title: "Error",
                                text: "Record Already exits",
                                type: "error",
                                timer: 1500,
                                showConfirmButton: false
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
</body>
</html>