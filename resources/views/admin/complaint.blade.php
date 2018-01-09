<!DOCTYPE html>
<html>
<head>
	<title>Barangay Blotter | Complaint</title>
	@include('admin.layout.head')
</head>
<body class="theme-blue-grey">
@include('admin.layout.nav')
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
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-teal">
                        <div class="icon">
                            <i class="material-icons">announcement</i>
                        </div>
                        <div class="content">
                            <div class="text"><h3>COMPLAINT</h3></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  	</div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">
                <form  id="complaint">
                    <br>
                   	<div class="row clearfix">
                        <div class="col-md-2">
                            <a href="javascript:void(0)" data-toggle="tooltip" title="Add Complainant"><button type="button" class="btn bg-teal btn-circle waves-effect waves-circle waves-float" id="combtn" data-toggle="modal" data-target="#defaultModal"><i class="material-icons">add</i></button></a>
                       		<label>Complainant/s </label>
                        </div>
                        <div class="col-md-10" id='comcon' style="border-style:solid; border-color:#b3cccc; border-width:1px; border-radius: 3px;height: 75px;">
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-2"><button type="button" class="btn bg-teal btn-circle waves-effect waves-circle waves-float" id="resbtn" data-toggle="modal" data-target="#defaultModal2"><i class="material-icons">add</i></button></a>
                            <label>Respondent/s </label>
                        </div>
                        <div class="col-md-10" id="rescon" style="border-style:solid; border-color:#b3cccc; border-width: 1px; border-radius: 3px; height: 75px;">
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-2"><button type="button" class="btn bg-teal btn-circle waves-effect waves-circle waves-float" id="witbtn" data-toggle="modal" data-target="#defaultModal3"><i class="material-icons">add</i></button></a>
                            <label>Witness/es </label>
                        </div>
                        <div class="col-md-10" id="witcon" style="border-style:solid; border-color:#b3cccc; border-width: 1px; border-radius: 3px; height: 75px;">
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-2">
                            <label>Nature of Complaint</label>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control show-tick" id="case">
                                        <option value="">-- Please select the nature of case --</option>
                                        @foreach($cases as $case)
                                        <option value="{{ $case->caseskp_id }}">{{ $case->caseskp_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-2">
                            <label>Brief Statement of Complaint</label>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea rows="10" id="statement" class="form-control no-resize" placeholder="Please type the details" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                    <div class="col-md-2">
                            <label>Turnover to</label>
                        </div>
                    <div class="col-md-10">
                    <div class="form-group">
                    <div class="form-line">
                        <select class="form-control show-tick" id="turnover">
                            <option value="Lupon">Barangay Chairman for Hearing</option>
                            <option value="PS6">Police Station</option>
                            <option value="VAWC">Violence Against Women and their Children(VAWC)</option>
                            <option value="Record">For Record Only</option>
                        </select>
                    </div>
                </div>
                </div>
                </div>
                    <div class="row clearfix">
                        <div class="col-md-1 col-md-offset-11">
                            <button type="submit" data-color="teal" class="btn bg-teal waves-effect">SUBMIT</button>
                        </div>
                    </div>
	            </form>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row clearfix">
                    <div class="col-lg-8 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-teal">
                            <div class="icon"><i class="material-icons">person_add</i></div>
                            	<div class="content">
                            		<div class="text"><h3>PICK COMPLAINANT</h3></div>
                        		</div>
                    	</div>
	                </div>
                </div>
            </div>
            <div class="modal-body">
            	<div class="card">
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <table class="table table-responsive table-condensed table-striped table-hover table-bordered dataTable" width="100%" id="restable1">
                                <thead class="bg-blue-grey">
                                    <tr>
                                        <td>ID</td>
                                        <td>Resident Name</td>
                                        <td>Birthdate</td>
                                        <td>Address</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row clearfix"> 
                        <div class="col-sm-4 col-sm-offset-8">
                            <button class="btn btn-lg bg-teal pull-right" type="button" id="addnon">Add non-resident</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="defaultModal2" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
            <div class="modal-header">
                <div class="row clearfix">
                    <div class="col-lg-8 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-teal">
     	                    <div class="icon"><i class="material-icons">person_add</i></div>
                            <div class="content">
                            	<div class="text"><h3>PICK RESPONDENT</h3></div>
                        	</div>
                    	</div>
                	</div>
                </div>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <table class="table table-responsive table-condensed table-striped table-hover table-bordered dataTable" width="100%" id="restable">
                                <thead class="bg-blue-grey">
                                    <tr>
                                        <td>ID</td>
                                        <td>Resident Name</td>
                                        <td>Birthdate</td>
                                        <td>Address</td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="row clearfix"> 
                        <div class="col-sm-3 col-sm-offset-9">
                            <button class="btn btn-lg bg-teal pull-right" type="button" id="pickres">PICK</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="defaultModal3" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row clearfix">
                    <div class="col-lg-8 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-teal">
                            <div class="icon"><i class="material-icons">person_add</i></div>
                            <div class="content">
                                <div class="text"><h3>PICK WITNESS</h3></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <table class="table table-responsive table-condensed table-striped table-hover table-bordered dataTable" width="100%" id="restable2">
                                <thead class="bg-blue-grey">
                                    <tr>
                                        <td>ID</td>
                                        <td>Resident Name</td>
                                        <td>Birthdate</td>
                                        <td>Address</td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="row clearfix"> 
                        <div class="col-sm-3 col-sm-offset-9">
                            <button class="btn btn-lg bg-teal pull-right" type="button" id="pickres">PICK</button>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="nonresmodal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row clearfix">
                    <div class="col-lg-8 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-teal">
                            <div class="icon"><i class="material-icons">person_add</i></div>
                            <div class="content">
                                <div class="text"><h3>ADD COMPLAINANT</h3></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="card">
                    <form id="nonresform">
                        <br>
                    <div class="row clearfix">
                        <br>
                        <div class="col-sm-12">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="fname" name="fname">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Middle Name</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="mname" name="mname">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="lname" name='lname'>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-sm-12">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Birthdate</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="bdate" name="bdate">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <div class="form-line">
                                        <select class="form-control show-tick" id="gender" name="gender"> 
                                            <option value="M" selected>Male</option>
                                            <option value="F">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Contact Number</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="contact" name="contact">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-sm-12">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label>Address</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="address" name="address">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-sm-12">
                            <div class="col-sm-4 col-sm-offset-8 pull-right">
                                <button type="submit" id="noneressubmit" class="btn btn-space waves-effect bg-teal">Submit</button>
                                <button type="button" id="nonrescancel" class="btn btn-space waves-effect bg-teal">Cancel</button>
                            </div>
                        </div>
                        <br>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.layout.scripts')

    <script src="{{asset('plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
<script>
	$(document).ready(function(){
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$('#dt').daterangepicker({
    			time : true,
    			format : 'YYYY-MM-DD HH:mm',
    			clearButton : false
    	});

        var used = ['"'+{{$return['official']}}+'"'];
        var com = [];
        var res = [];
        var wit = [];
        var table1 = $("#restable1").DataTable();
        var table = $("#restable").DataTable();
        var table2 = $("#restable2").DataTable();

        $('#witbtn').on('click', function(){
            var return_data = new Array();
            table2.destroy();
            table2 = $('#restable2').DataTable({
            bSort: false,
            "ajax": {
                "url" : '/blotter/barangay/complaint_res',
                "dataType" : "json",
                "data" : {
                    used : used.join()
                },
                "dataSrc" : function (json) {
                        var return_data = new Array();
                        for(var i=0;i< json.length; i++){
                            return_data.push({
                            'resident_id' : json[i].resident_id,
                            'name' : json[i].name,
                            'resident_bdate' : json[i].resident_bdate,
                            'address' : json[i].address
                            });
                        } 
                        return return_data;
                }
            },
            "columns": [
                    { "data": 'resident_id' },
                    { "data": 'name' },
                    { "data": 'resident_bdate' },
                    { "data": 'address' },
            ]
            });

        });

        $('#combtn').on('click', function(){
            var return_data = new Array();
            table1.destroy();
            table1 = $('#restable1').DataTable({
            bSort: false,
            "ajax": {
                "url" : '/blotter/barangay/complaint_res',
                "dataType" : "json",
                "data" : {
                    used : used.join()
                },
                "dataSrc" : function (json) {
                        var return_data = new Array();
                        for(var i=0;i< json.length; i++){
                            return_data.push({
                            'resident_id' : json[i].resident_id,
                            'name' : json[i].name,
                            'resident_bdate' : json[i].resident_bdate,
                            'address' : json[i].address
                            });
                        } 
                        return return_data;
                }
            },
            "columns": [
                    { "data": 'resident_id' },
                    { "data": 'name' },
                    { "data": 'resident_bdate' },
                    { "data": 'address' },
            ]
            });

        });

        $('#resbtn').on('click', function(){
            var return_data = new Array();

            table.destroy();
            table = $('#restable').DataTable({
            bSort: false,
            "ajax": {
                "url" : '/blotter/barangay/complaint_res',
                "dataType" : "json",
                "data" : {
                    used : used.join()
                },
                "dataSrc" : function (json) {
                        var return_data = new Array();
                        for(var i=0;i< json.length; i++){
                            return_data.push({
                            'resident_id' : json[i].resident_id,
                            'name' : json[i].name,
                            'resident_bdate' : json[i].resident_bdate,
                            'address' : json[i].address
                            });
                        } 
                        return return_data;
                }
            },
            "columns": [
                    { "data": 'resident_id' },
                    { "data": 'name' },
                    { "data": 'resident_bdate' },
                    { "data": 'address' },
            ]
            });

        });

        $('#restable1 tbody').on('dblclick', 'tr', function () {
            var data = table1.row( this ).data();
            var $input = $('<button type="button" value='+data['resident_id']+' class="removecom btn btn-success waves-effect "><span>'+data['name']+'</span>  <i class="material-icons">remove</i></button>');
            $input.appendTo($("#comcon"));
            $('#defaultModal').modal('toggle');
            used.push('"'+data['resident_id']+'"');
            com.push('"'+data['resident_id']+'"');
        } );

        $('#restable2 tbody').on('dblclick', 'tr', function () {
            var data = table2.row( this ).data();
            var $input = $('<button type="button" value='+data['resident_id']+' class="removewit btn btn-success waves-effect "><span>'+data['name']+'</span>  <i class="material-icons">remove</i></button>');
            $input.appendTo($("#witcon"));
            $('#defaultModal3').modal('toggle');
            used.push('"'+data['resident_id']+'"');
            wit.push('"'+data['resident_id']+'"');
        } );
        
		
        $(document).on("click", "button.removecom", function(){
            $(this).remove();
            for(var i = used.length; i--;) {
                if(used[i] == '"'+$(this).val()+'"') {
                    used.splice(i, 1);
                }
            }
            for(var i = com.length; i--;) {
                if(com[i] == '"'+$(this).val()+'"') {
                    com.splice(i, 1);
                }
            }
            
        });	

        $(document).on("click", "button.removewit", function(){
            $(this).remove();
            for(var i = used.length; i--;) {
                if(used[i] == '"'+$(this).val()+'"') {
                    used.splice(i, 1);
                }
            }
            for(var i = com.length; i--;) {
                if(wit[i] == '"'+$(this).val()+'"') {
                    wit.splice(i, 1);
                }
            }
            
        }); 


        $('#restable tbody').on('dblclick', 'tr', function () {
            var data = table.row( this ).data();
            var $input = $('<button type="button" value='+data['resident_id']+' class="removeres btn btn-success waves-effect "><span>'+data['name']+'</span>  <i class="material-icons">remove</i></button>');
            $input.appendTo($("#rescon"));
            $('#defaultModal2').modal('toggle');
            used.push('"'+data['resident_id']+'"');
            res.push('"'+data['resident_id']+'"');
        } );
        
        
        $(document).on("click", "button.removeres", function(){
            $(this).remove();
            for(var i = used.length; i--;) {
                if(used[i] == '"'+$(this).val()+'"') {
                    used.splice(i, 1);
                }
            }
            for(var i = com.length; i--;) {
                if(res[i] == '"'+$(this).val()+'"') {
                    res.splice(i, 1);
                }
            }
            
        }); 

        $.validator.addMethod("alphanumbasic", function(value, element) {
                return this.optional(element) || value == value.match(/^[a-zA-Z0-9 .,!?()"'<>;:+=-_#*/@]*$/);
            },"Letters, Numbers and basic punctuations only");

        $('#complaint').validate({
                rules: {
                    statement: {
                        required: true,
                        alphanumbasic: true
                    }
                },
                submitHandler: function(form) { // for demo
                    console.log(com.join()+" "+res.join());
                    var formData = new FormData();
                    formData.append('res', res.join());
                    formData.append('com', com.join());
                    formData.append('wit', wit.join());
                    formData.append('statement', $('#statement').val());
                    formData.append('case', $('#case').val());
                    formData.append('turnover', $('#turnover').val());
                    $.ajax({
                        url : '/blotter/barangay/complaint_process',
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
                            swal({
                                title : "Record Added",
                                type : "success",
                                showConfirmButton : true
                            });
                            $('#comcon').empty();
                            $('#rescon').empty();
                            $('#witcon').empty();
                            com = [];
                            res = [];
                            wit = [];
                            used = [];
                            $('#statement').val("");
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

        $('#addnon').on('click', function(){
            $('#defaultModal').modal('toggle');
            $('#nonresmodal').modal('toggle');
        });

        $('#nonrescancel').on('click', function(){
            $('#nonresmodal').modal('toggle');
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

            $('#bdate').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: 'YYYY-MM-DD'
                },
                maxDate: moment().subtract(18,'years')
            });



        $('#nonresform').validate({
                rules: {
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
                    address: {
                        required: true,
                        alphanum: true,
                        maxlength: 50
                    },
                    gender: {
                        required: true
                    }
                },
                submitHandler: function(form) {
                    console.log(com.join()+" "+res.join());
                    $.ajax({
                        url : '/resident/nonres',
                        method : 'POST',
                        data : {
                            _token: CSRF_TOKEN,
                            fname: $('#fname').val(),
                            mname: $('#mname').val(),
                            lname: $('#lname').val(),
                            bdate: $('#bdate').val(),
                            contact: $('#contact').val(),
                            gender: $('#gender').val(),
                            address: $('#address').val()
                        },
                        success : function(response){
                            console.log(response);
                            if(response=="Contact Number already used"){
                                swal({
                                    title : response,
                                    type : "error",
                                    showConfirmButton : true
                                });
                            }
                            else{
                                swal({
                                    title : "Record Added",
                                    type : "success",
                                    showConfirmButton : true
                                });
                                var $input = $('<button type="button" value='+response.resident_id+' class="removecom btn btn-success waves-effect "><span>'+response.resident_fname+' '+response.resident_lname+'</span>  <i class="material-icons">remove</i></button>');
                                $input.appendTo($("#comcon"));
                                used.push('"'+response.resident_id+'"');
                                com.push('"'+response.resident_id+'"');
                            }
                            $('#nonresmodal').modal('toggle');
                            $('#fname').val("");
                            $('#mname').val("");
                            $('#lname').val("");
                            $('#bdate').val("");
                            $('#address').val("");
                            $('#contact').val("");
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