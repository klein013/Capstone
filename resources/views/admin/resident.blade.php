<!DOCTYPE html>
<html>
<head>
	<title>Residents</title>
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
            @elseif($return['position']==1)
                @include('admin.aside_pb');
            @elseif($return['position_id']==2)
                @include('admin.aside_pb');
            @elseif($return['position_id']==3)
                @include('admin.aside_admin');
            @elseif($return['position_id']==4)
                @include('admin.aside_sec');
            @elseif($return['position_id']==5)
                @include('admin.aside_desk');
            @elseif($return['position_id']==6)
                @include('admin.aside_bpso');
            @elseif($return['position_id']==7)
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
                            <i class="material-icons">group_add</i>
                        </div>
                        <div class="content">
                            <div class="text"><h3> RESIDENTS</h3></div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
            <!-- Basic Table -->
            <div class="row clearfix">
                                    <div class="col-lg-offset-11 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <a href="javascript:void(0)" data-toggle="tooltip" title="Add Resident"><button type="button" class="btn bg-teal btn-circle-lg waves-effect waves-circle waves-float" data-toggle="modal" data-target="#defaultModal"><i class="material-icons">add</i></button></a>
                                    </div>
                                </div>
                                <br>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                	<div class="card">
                        <div class="body table-responsive">
                            <table class="table dataTable js-exportable" id='residentTable'>
                                <thead>
                                    <tr class="bg-blue-grey">
                                        <th>ID</th>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Address</th>
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

    <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                            <div class="row clearfix">
                            <div class="col-lg-7 col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box bg-teal">
                            <div class="icon">
                                <i class="material-icons">person_add</i>
                            </div>
                            <div class="content">
                            <div class="text"><h3> ADD RESIDENT</h3></div>
                            </div>
                    </div>
                </div>
               </div>
                        <div class="modal-body">
                            <form enctype='multipart/form-data' id="resident">
                            	{{ csrf_field() }}
                            	<div class='row'>
                            		<div class='col-md-4 col-md-offset-4'>
                            		<center><img src='../uploads/human.png' class='img-responsive thumbnail' id="toimage"></center>
                            		</div>
                            	</div>
                            	<br>
                            	<div class="row clearfix">
                            	<div class="form-group">
                            		<div class="col-md-2">
                            		<label for='resident_image'>Resident Picture</label>
                            		</div>
                            		<div class="col-md-6">
                            		<input type='file' accept="image/*" id='image'>
                            		</div>
                            		<!--<div class="col-md-2">
                            			<label>OR</label>
                            		</div>
                            		<div class="col-md-2">
                            			<button type='button' class='btn btn-default waves-effect' id="image2" data-toggle='tooltip' data-placement='bottom' title data-original-title='Capture image using webcam'><i class="material-icons">photo_camera</i></button>
                            		</div>-->
                            	</div>
                            	</div>
                            	<br>
                                <div class="row clearfix">
                                <div class="col-md-4">
                                    <label for="f_name">First Name</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="fname" required autofocus>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="l_name">Middle Name</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="mname">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="m_name">Last Name</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="lname" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                             <div class="row clearfix">
                                <div class="col-md-4">
                                <label for="date">Birth Date</label>
                                   <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="bdate">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                <label for="gender">Gender</label>
                                   <div class="form-lin e">
                                                 <select class="form-control show-tick" id="gender">
                                                    <option value="" disabled selected>Choose gender 
                                                    </option>
                                                    <option value="M">Male</option>
                                                    <option value="F">Female</option>
                                                </select>
                                            </div>
                                		</div>
                                
                                <div class="col-md-4">
                                    <label>Year Stayed in the Brgy</label>
                                    <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" class="form-control" id="year" name="year">
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <label for="res_address">Address</label>
                            <div class="row">
                            	<div class="col-md-6">
                            		<label>House No.</label>	
                            	</div>
                            	<div class="col-md-6">
                            		<label>Street</label>
                            	</div>
                            </div>
                            <div class='row'>
                                <div class="form-group">
                                    <div class="col-md-6">
                                    	<div class=" form-line">
                                        <input type="text" id="house" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    <select class="form-control show tick" id="street">
                                        <option value="" disabled selected>Choose Street</option>
                                        @foreach($streets as $street)
                                            <option value="{{ $street->street_id }}">{{ $street->street_name }}, {{ $street->area_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                </div>
                            </div>
                            <br>
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <label for="contact_no">Contact No.</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="contact" name="contact">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn bg-teal btn-lg waves-effect" id='add'>ADD</button>
                            <button type="button" class="btn bg-teal btn-lg waves-effect" data-dismiss="modal">CANCEL</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        
    @include('admin.layout.scripts');    
    <script>
    	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    	$(document).ready(function (){
    		
    		var file="";

    		$('#bdate').bootstrapMaterialDatePicker({
    			time : false,
    			clearButton : false
    		});

    		var table = $('#residentTable').DataTable({
                "bSort": false,
                "ajax" : {
                    "url": "/resident/getResidents",
                    "dataSrc" : function (json) {
                        var return_data = new Array();
                        for(var i=0;i< json.length; i++){
                            return_data.push({
                            'ID' : json[i].resident_id,
                            'Image'  : '<img src="../' + json[i].resident_image +'" width="40px" height="40px">',
                            'Name' : json[i].resident_fname+' '+json[i].resident_lname,
                            'Add' : json[i].resident_hno+' '+json[i].street_name+' '+json[i].area_name
                            })
                        }     
                        return return_data;
                    }
                },
                "columns": [
                    { "data": "ID" },
                    { "data": "Image"},
                    { "data": "Name" },
                    { "data": "Add" },
                    { "defaultContent": "<button type = 'button' class = 'update btn btn-space bg-blue waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Update Record'><i class='material-icons'>update</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button>" }
                ],
                "columnDefs": [
                    { 
                        className : "dt-right",
                        "targets" : [4]
                    }
                ],
            });

    		
            $('#image').change(function (event){
                $("#toimage").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
                    file = event.target.files[0];
            });

            $.validator.addMethod("dateISOF", function (value, element)
            {
                if (this.optional(element))
                {
                    return true;
                }
                if (!(/^\d{4}[\/-]\d{1,2}[\/-]\d{1,2}$/.test(value)))
                {
                    return false;
                }
                var split = value.replace(/\//g, "-").split("-");
                var year = parseInt(split[0]);
                var month = parseInt(split[1]) - 1;
                var date = parseInt(split[2]);
                var dateObj = new Date(year, month, date, 0, 0, 0, 0);
                return dateObj.getFullYear() == year && dateObj.getMonth() == month && dateObj.getDate() == date;
            }, "Please enter a valid date.");

            $.validator.addMethod("alpha", function(value, element) {
                return this.optional(element) || value == value.match(/^[a-zA-Z .,]*$/);
            },"Letters, spaces, period and comma only");


            $.validator.addMethod("alphanum", function(value, element) {
                return this.optional(element) || value == value.match(/^[a-zA-Z0-9 .,]*$/);
            },"Letters, Numbers, spaces, period and comma only");

            var date = new Date();

            $('#year').focus(function(){
                    $('#year').attr({'min': new Date($('#bdate').val()).getFullYear()});
            });

            $('#bdate').focus(function(){
                    $('#year').attr({'min': new Date($('#bdate').val()).getFullYear()});
            });

            $('#resident').validate({
                rules: {
                    image1: {
                        required: false,
                        accept: "image/*"
                    },
                    fname: {
                        required: true,
                        maxlength: 30,
                        alpha: true
                    },
                    mname: {
                        required: false,
                        maxlength: 30,
                        alpha: true
                    },
                    lname: {
                        required: true,
                        maxlength: 30,
                        alpha: true
                    },
                    bdate: {
                        required: true,
                        dateISOF: true
                    },
                    contact: {
                        required: false,
                        digits: true,
                        minlength: 11,
                        maxlength: 11
                    },
                    house: {
                        required: true,
                        alpha: true,
                        maxlength: 6
                    },
                    street: {
                        required: true
                    },
                    gender: {
                        required: true
                    },
                    year: {
                        required: true,
                        digits: true,
                        maxlength: 4,
                        minlength: 4,
                        max: new Date().getFullYear()
                    }
                },
                submitHandler: function(form) { // for demo
                    var formData = new FormData();
                    formData.append('file', file);
                    formData.append('fname', $('#fname').val());
                    formData.append('mname', $('#mname').val());
                    formData.append('lname', $('#lname').val());
                    formData.append('bdate', $('#bdate').val());
                    formData.append('contact', $('#contact').val());
                    formData.append('house', $('#house').val());
                    formData.append('street', $('#street').val());
                    formData.append('gender', $('#gender').val());
                    formData.append('area', $('#area').val());
                    formData.append('year', $('#year').val());
                    $.ajax({
                        url : '/resident',
                        method : 'POST',
                        data : formData,
                        processData : false,
                        contentType : false,
                        cache : false,
                        headers : {
                            'X-CSRF-TOKEN' : CSRF_TOKEN
                        },
                        success : function(response){
                            if(response[0].resident_gender=='M'){
                                var sex = "Male";
                            }
                            else{
                                var sex = "Female";
                            }
                            $('#defaultModal').modal('toggle');

                            var newRow = "<tr><td>"+response[0].resident_id+"</td><td><img src='"+response[0].resident_image+"' width='40px;' height='40px;'></td><td>"+response[0].resident_fname+' '+response[0].resident_lname+"</td><td>"+(response[0].resident_bdate).split(' ')[0]+"</td><td>"+sex+"</td><td>"+response[0].resident_add+"</td><td><button type = 'button' class = 'update btn btn-space bg-blue waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Update Record'><i class='material-icons'>update</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button></td></tr>";
                            table.row.add($(newRow)).draw();
                            swal({
                                title : "Record Added",
                                type : "success",
                                timer : 1000,
                                showConfirmButton : false
                            });
                            var pos1 = response['position'];
                            var i;
                            
                            for (i = 0; i < pos1.length; ++i) {
                                $('#position').empty();
                                $('#position').append($('<option></option>')).attr("value", pos1[i].Pos_ID).text(pos1[i].Pos_Name);
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

            var finid;
            var posid;
            
            $('#residentTable tbody').on('click', 'button.update', function(){
                var id = table.row($(this).parents('tr')).data().ID;    
                finid = id;
                $.ajax({
                    url: 'maintenance_official/'+id,
                    method: 'GET',
                    data : {
                        _token : CSRF_TOKEN,
                        id : id
                    },
                    dataType : 'json',
                    success : function(response){
                        posid = response[0].Pos_ID;
                        $('#updatetoimage').attr('src','../'+response[0].Off_Image);
                        $('#updatefname').val(response[0].Off_Fname);
                        $('#updatemname').val(response[0].Off_Mname);
                        $('#updatelname').val(response[0].Off_Lname);
                        $('#updatebdate').val(response[0].Off_Bdate);
                        $('#updatecontact').val(response[0].Off_Contact);
                        $('#updateyear').val(response[0].Off_Year);
                        $('#updatehouse').val(response[0].Off_House);
                        $('#updatestreet').val(response[0].Off_Street).change();
                        if($("#updateposition option[value='"+response[0].Pos_ID+"']").length > 0){
                           $('#updateposition').val(response[0].Pos_ID).change();
                        }
                        else{
                            $('#updateposition').append($('<option>', {
                                value: response[0].Pos_ID,
                                text: response[0].Pos_Name   
                            }));
                            $('#updateposition').val(response[0].Pos_ID).change();
                        }
                        if(response[0].Off_Sex=="M"){
                            $('#updategender').val("M").change();
                        }
                        else{
                            $('#updategender').val("F").change();   
                        }
                    }
                });
                $('#updatemodal').modal('toggle');
                
            })

            $('#residentTable tbody').on('click', 'button.delete', function(){
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
                            url : 'maintenance_official/'+id,
                            method : 'POST',
                            data : {
                                _token : CSRF_TOKEN,
                                _method : 'DELETE',
                            },
                            success : function(response){
                                if(response != null){
                                table.row(row).remove().draw();
                                 swal({
                                    title : "Deleted!", 
                                    text : "Record has been deleted",
                                    type :  "success",
                                    showConfirmButton : false,
                                    timer : 1000
                                });
                                
                                    $('#position option').remove();
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

            var updatefile;
            $('#updateimage').change(function (event){
                $("#updatetoimage").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
                    updatefile = event.target.files[0];
            });

            $('#updateofficial').validate({
                rules: {
                    updateimage: {
                        required: false,
                        accept: "image/*"
                    },
                    updatefname: {
                        required: true,
                        maxlength: 30,
                        alpha: true
                    },
                    updatemname: {
                        required: false,
                        maxlength: 30,
                        alpha: true
                    },
                    updatelname: {
                        required: true,
                        maxlength: 30,
                        alpha: true
                    },
                    updatebdate: {
                        required: true,
                        dateISOF: true
                    },
                    updatecontact: {
                        required: false,
                        digits: true,
                        minlength: 11,
                        maxlength: 11
                    },
                    updatehouse: {
                        required: true,
                        alpha: true,
                        maxlength: 6
                    },
                    updatestreet: {
                        required: true,
                        alphanum: true,
                        maxlength: 50,
                        minlength: 5
                    },
                    updatearea: {
                        required: true
                    },
                    updategender: {
                        required: true
                    },
                    updateposition: {
                        required: true
                    },
                    updateyear: {
                        required: true,
                        digits: true,
                        maxlength: 4,
                        minlength: 4,
                        max: new Date().getFullYear()
                    }
                },
                submitHandler: function(form) { // for demo
                    var formData = new FormData();
                    formData.append('id', finid);
                    formData.append('file', updatefile);
                    formData.append('fname', $('#updatefname').val());
                    formData.append('mname', $('#updatemname').val());
                    formData.append('lname', $('#updatelname').val());
                    formData.append('bdate', $('#updatebdate').val());
                    formData.append('contact', $('#updatecontact').val());
                    formData.append('house', $('#updatehouse').val());
                    formData.append('street', $('#updatestreet').val());
                    formData.append('gender', $('#updategender').val());
                    formData.append('pos', $('#updateposition').val());
                    formData.append('year', $('#updateyear').val());
                    $.ajax({
                        url : '/maintenance_official/update',
                        method : 'POST',
                        data : formData,
                        processData : false,
                        contentType : false,
                        cache : false,
                        headers : {
                            'X-CSRF-TOKEN' : CSRF_TOKEN
                        },
                        success : function(){
                            table.ajax.reload();                            
                            $('#updatemodal').modal('toggle');

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
    <script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
</body>
</html>