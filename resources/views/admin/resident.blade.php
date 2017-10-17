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
                    <img src="{{asset($return['image'])}}" id="userimage" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" id="userfullname" aria-haspopup="true" aria-expanded="false">{{$return['name']}}</div>
                    <div class="email">Official ID: <strong id="userposition">{{$return['official']}}</strong></div>
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
                                    <div class="col-sm-2 col-sm-offset-10 ">
                                        <a href="javascript:void(0)" data-toggle="tooltip" title="Add Resident"><button type="button" class="btn pull-right bg-teal btn-space waves-effect waves-float" data-toggle="modal" data-target="#defaultModal"><i class="material-icons">add</i>Add Resident</button></a>
                                    </div>
                                </div>
                                <br>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                	<div class="card">
                        <div class="body table-responsive">
                            <table class="table table-bordered table-hover table-striped table-condensed dataTable js-exportable" id='residentTable'>
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
                            		<div class='col-sm-4 col-sm-offset-4'>
                            		<center><img src='../uploads/human.png' class='img-responsive thumbnail' id="toimage"></center>
                            		</div>
                            	</div>
                            	<br>
                            	<div class="row clearfix">
                            	<div class="form-group">
                            		<div class="col-sm-2">
                            		<label for='resident_image'>Resident Picture</label>
                            		</div>
                            		<div class="col-sm-6">
                            		<input type='file' accept="image/*" id='image'>
                            		</div>
                            	</div>
                            	</div>
                            	<br>
                                <div class="row clearfix">
                                <div class="col-sm-4">
                                    <label for="f_name">First Name</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="fname" required autofocus>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="l_name">Middle Name</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="mname">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="m_name">Last Name</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="lname" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                             <div class="row clearfix">
                                <div class="col-sm-4">
                                <label for="date">Birth Date</label>
                                   <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="bdate">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
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
                                
                                <div class="col-sm-4">
                                    <label>Year of Residency</label>
                                    <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" class="form-control" id="year" name="year">
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <label for="res_address">Address</label>
                            <div class="row">
                            	<div class="col-sm-6">
                            		<label>Lot No./Blk No./Phase No./Subdivision</label>	
                            	</div>
                            	<div class="col-sm-6">
                            		<label>Street</label>
                            	</div>
                            </div>
                            <div class='row'>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                    	<div class=" form-line">
                                        <input type="text" id="house" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
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
                                <div class="col-sm-6">
                                    <label for="contact_no">Contact No.</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="contact" name="contact">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label>Allow Message</label>
                                    <div class="demo-radio-button">
                                    <input name="radio" type="radio" value="1" id="radio_yes" class="radio-col-blue-grey" checked disabled/>
                                    <label for="radio_yes">YES</label>
                                    <input name="radio" type="radio" value="0" id="radio_no" class="radio-col-blue-grey" disabled/>
                                    <label for="radio_no">NO</label>
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
        </div>

    <div class="modal fade" id="updateModal" tabindex="-2" role="dialog">
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
                            <div class="text"><h3> UPDATE RESIDENT</h3></div>
                            </div>
                    </div>
                </div>
               </div>
                        <div class="modal-body">
                            <form enctype='multipart/form-data' id="upresident">
                                {{ csrf_field() }}
                                <div class='row'>
                                    <div class='col-sm-4 col-sm-offset-4'>
                                    <center><img class='img-responsive thumbnail' id="uptoimage"></center>
                                    </div>
                                </div>
                                <br>
                                <div class="row clearfix">
                                <div class="form-group">
                                    <div class="col-sm-2">
                                    <label for='resident_image'>Resident Picture</label>
                                    </div>
                                    <div class="col-sm-6">
                                    <input type='file' accept="image/*" id='upimage'>
                                    </div>
                                </div>
                                </div>
                                <br>
                                <div class="row clearfix">
                                <div class="col-sm-4">
                                    <label for="f_name">First Name</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="upfname" disabled name ="upfname" required autofocus>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="l_name">Middle Name</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="upmname" name="upmname">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="m_name">Last Name</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="uplname" name="uplname" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                             <div class="row clearfix">
                                <div class="col-sm-4">
                                <label for="date">Birth Date</label>
                                   <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="upbdate" disabled  name="upbdate">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                <label for="gender">Gender</label>
                                   <div class="form-lin e">
                                                 <select class="form-control show-tick" disabled id="upgender" name="upgender">
                                                    <option value="" disabled selected>Choose gender 
                                                    </option>
                                                    <option value="M">Male</option>
                                                    <option value="F">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                
                                <div class="col-sm-4">
                                    <label>Year of Residency</label>
                                    <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" class="form-control" id="upyear" name="upyear">
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <label for="res_address">Address</label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Lot No./Blk No./Phase No./Subdivision</label>    
                                </div>
                                <div class="col-sm-6">
                                    <label>Street</label>
                                </div>
                            </div>
                            <div class='row'>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <div class=" form-line">
                                        <input type="text" id="uphouse" name="uphouse" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                    <select class="form-control show tick" id="upstreet" name="upstreet">
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
                                <div class="col-sm-6">
                                    <label for="contact_no">Contact No.</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="upcontact" name="upcontact">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label>Allow Message</label>
                                    <div class="demo-radio-button">
                                    <input name="upradio" type="radio" value="1" id="upradio_yes" class="radio-col-blue-grey" checked disabled/>
                                    <label for="upradio_yes">YES</label>
                                    <input name="upradio" type="radio" value="0" id="upradio_no" class="radio-col-blue-grey" disabled/>
                                    <label for="radio_no">NO</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn bg-teal btn-lg waves-effect" id='updatebtn'>UPDATE</button>
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

    		$('#bdate').daterangepicker({
    			singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: 'YYYY-MM-DD'
                },
                maxDate: moment()
    		});

            $('#contact').keyup(function(){
                if($('#contact').val().match(/\+639.[0-9]{8}/)){
                    $('input[name=radio]').attr("disabled",false);
                }
                else{
                    $('input[name=radio]').attr("disabled",true);
                }
            });


            $('#upcontact').keyup(function(){
                if($('#upcontact').val().match(/\+639.[0-9]{8}/)){
                    $('input[name=upradio]').attr("disabled",false);
                }
                else{
                    $('input[name=upradio]').attr("disabled",true);
                }
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
                    { "defaultContent": "<button type = 'button' class = 'update btn btn-space bg-blue waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Update Record'><i class='material-icons'>create</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button>" }
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

             $('#upimage').change(function (event){
                $("#uptoimage").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
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
                return this.optional(element) || value.trim() == value.match(/^[a-zA-Z .,]*$/);
            },"Letters, spaces, period and comma only");


            $.validator.addMethod("alphanum", function(value, element) {
                return this.optional(element) || value.trim() == value.match(/^[a-zA-Z0-9 .,]*$/);
            },"Letters, Numbers, spaces, period and comma only");

            $.validator.addMethod("cellno", function(value, element){
                return this.optional(element) || value.trim() == value.match(/\+639.[0-9]{8}/);
            }, "Must start +639 and followed by 9 digits");

            var date = new Date();

            $('#year').focus(function(){
                    $('#year').attr({'min': new Date($('#bdate').val()).getFullYear()});
            });

            $('#bdate').focus(function(){
                    $('#year').attr({'min': new Date($('#bdate').val()).getFullYear()});
            });

            $('#upresident').validate({
                rules: {
                    upimage: {
                        required: false,
                        accept: "image/*"
                    },
                    upfname: {
                        required: true,
                        maxlength: 50,
                        alpha: true
                    },
                    upmname: {
                        required: false,
                        maxlength: 50,
                        alpha: true
                    },
                    uplname: {
                        required: true,
                        maxlength: 50,
                        alpha: true
                    },
                    upbdate: {
                        required: true,
                        dateISOF: true
                    },
                    upcontact: {
                        required: false,
                        cellno: true,
                        maxlength: 13
                    },
                    uphouse: {
                        required: true,
                        alphanum: true,
                        maxlength: 50
                    },
                    upstreet: {
                        required: true
                    },
                    upgender: {
                        required: true
                    },
                    upyear: {
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
                    formData.append('file', file);
                    formData.append('fname', $('#upfname').val());
                    formData.append('mname', $('#upmname').val());
                    formData.append('lname', $('#uplname').val());
                    formData.append('bdate', $('#upbdate').val());
                    formData.append('contact', $('#upcontact').val());
                    formData.append('house', $('#uphouse').val());
                    formData.append('street', $('#upstreet').val());
                    formData.append('gender', $('#upgender').val());
                    formData.append('year', $('#upyear').val());
                    formData.append('allow', $('input[name=upradio]:checked').val());
                    $.ajax({
                        url : '/resident/update',
                        method : 'POST',
                        data : formData,
                        processData : false,
                        contentType : false,
                        cache : false,
                        headers : {
                            'X-CSRF-TOKEN' : CSRF_TOKEN
                        },
                        success : function(response){
                            if(response=="Contact Number already used"){
                                table.ajax.reload();
                                swal({
                                    title : response,
                                    type : "error",
                                    showConfirmButton : true
                                });
                            }
                            else if(response=="exceed"){
                                table.ajax.reload();
                                swal({
                                    title : "File Size must be less than 2mb",
                                    type : "error",
                                    showConfirmButton : true
                                });
                            }
                            else{
                                $("#userimage").removeAttr("src").attr("src", response[0].resident_image);
                                $('#userfullname').text(response[0].name);
                                table.ajax.reload();
                                swal({
                                    title : "Record Updated",
                                    type : "success",
                                    showConfirmButton : true
                                });
                            }

                            $('#updateModal').modal('toggle');
                            $('#upfname').val("");
                            $('#upmname').val("");
                            $('#uplname').val("");
                            $('#upbdate').val("");
                            $('#uphouse').val("");
                            $('#upcontact').val("");
                            $('#upyear').val("");
                            file = null;
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
                file = null;
                var id = table.row($(this).parents('tr')).data().ID;    
                finid = id;
                $.ajax({
                    url: '/resident/update/'+id,
                    method: 'GET',
                    dataType : 'json',
                    success : function(response){
                        posid = response[0].Pos_ID;
                        $('#uptoimage').attr('src','../'+response[0].resident_image);
                        $('#upfname').val(response[0].resident_fname);
                        $('#upmname').val(response[0].resident_mname);
                        $('#uplname').val(response[0].resident_lname);
                        $('#upbdate').val(response[0].resident_bdate);
                        $('#upcontact').val(response[0].resident_contact);
                        $('#upyear').val(response[0].resident_yearstayed);
                        $('#uphouse').val(response[0].resident_hno);
                        $('#upstreet').val(response[0].resident_street).change();
                        if(response[0].resident_gender=="M"){
                            $('#upgender').val("M").change();
                            $('#upmname').attr('disabled', true);
                            $('#uplname').attr('disabled', true);
                        }
                        else{
                            $('#upgender').val("F").change();   
                            $('#upmname').attr('disabled', false);
                            $('#uplname').attr('disabled', false);
                        }
                    }
                });
                $('#updateModal').modal('toggle');
                
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
                            url : '/resident/delete',
                            method : 'POST',
                            data : {
                                _token : CSRF_TOKEN,
                                _method : 'DELETE',
                                id : id
                            },
                            success : function(response){
                                if(response != null){
                                table.row(row).remove().draw();
                                 swal({
                                    title : "Deleted!", 
                                    text : "Record has been deleted",
                                    type :  "success",
                                    showConfirmButton : true
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
                            showConfirmButton : true
                        });
                    }
                });     
            });

            var updatefile;
            $('#updateimage').change(function (event){
                $("#updatetoimage").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
                    updatefile = event.target.files[0];
            });
                
            $('#resident').validate({
                rules: {
                    image1: {
                        required: false,
                        accept: "image/*"
                    },
                    fname: {
                        required: true,
                        maxlength: 50,
                        alpha: true
                    },
                    mname: {
                        required: false,
                        maxlength: 50,
                        alpha: true
                    },
                    lname: {
                        required: true,
                        maxlength: 50,
                        alpha: true
                    },
                    bdate: {
                        required: true,
                        dateISOF: true
                    },
                    contact: {
                        required: false,
                        cellno: true,
                        maxlength: 13
                    },
                    house: {
                        required: true,
                        alphanum: true,
                        maxlength: 50
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
                    formData.append('year', $('#year').val());
                    formData.append('allow', $('input[name=radio]:checked').val());
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
                            if(response=="success"){
                                table.ajax.reload();
                                swal({
                                    title : "Record Added",
                                    type : "success",
                                    showConfirmButton : true
                                });
                            }
                            else if(response=="exceed"){
                                table.ajax.reload();
                                swal({
                                    title : "File Size must be less than 2mb",
                                    type : "error",
                                    showConfirmButton : true
                                });
                            }
                            else{
                                table.ajax.reload();
                                swal({
                                    title : response,
                                    type : "error",
                                    showConfirmButton : true
                                });
                            }
                            $('#defaultModal').modal('toggle');
                            $('#fname').val("");
                            $('#mname').val("");
                            $('#lname').val("");
                            $('#bdate').val("");
                            $('#house').val("");
                            $('#contact').val("");
                            $('#year').val("");
                            file = null;
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