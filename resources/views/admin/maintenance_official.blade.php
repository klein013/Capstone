<!DOCTYPE html>
<html>
<head>
	<title>Maintenance | Officials</title>
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
	  </aside>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                <div class="col-lg-5 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-teal">
                        <div class="icon">
                            <i class="material-icons">account_circle</i>
                        </div>
                        <div class="content">
                            <div class="text"><h3> BARANGAY OFFICIAL</h3></div>
                        </div>
                    </div>
                </div>


            </div>
            </div>
            <!-- Basic Table -->
            <div class="row clearfix">
                                    <div class="col-lg-offset-11 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <a href="javacript:void(0);" data-toggle="tooltip" title="Add Barangay Official"><button type="button" class="btn bg-teal btn-circle-lg waves-effect waves-circle waves-float" data-toggle="modal" data-target="#defaultModal"><i class="material-icons">add</i></button></a>
                                    </div>
                                </div>
                                <br>
            <div class="row">    
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                	<div class="card">
                        <div class="body table-responsive">
                            <table class="table table-hover dataTable js-exportable" id="OfficialTable">
                                <thead>
                                    <tr class="bg-blue-grey">
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Birthdate</th>
                                        <th>Gender</th>
                                        <th>Address</th>
                                        <th>Position</th>
                                        <th>Action</th>
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
                    <div class="col-lg-9 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-teal">
                            <div class="icon">
                                <i class="material-icons">person_add</i>
                            </div>
                            <div class="content">
                                <div class="text"><h3> ADD BARANGAY OFFICIAL</h3></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" id="official">
                    {{ csrf_field() }}
                        <div class="imgcontainer" style="text-align: center; margin: 24px 0 12px 0;" >
                            <center><img src="{{asset('images/human.png')}}" style="width: 30%;" class="img-responsive thumbnail" alt="profile" class="avatar" style="width: 40%;border-radius: 50%;text-align: center;" id="toimage"></center>
                        </div>
                        <br>
                        <label for="prof_pic">Official Picture</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="file" class="form-control-file" placeholder="Upload Image" accept="image/*" id="image" name="image1">
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-4">
                                <label for="f_name">First Name</label>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="fname" name="fname">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="l_name">Middle Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="mname" name="mname">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="m_name">Last Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="lname" name="lname">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-4">
                                <label for="date">Birthdate</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control date" id="bdate" name="bdate">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="contact_no">Contact No.</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="contact" name="contact">
                                        </div>
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
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <label for="password">Address</label>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-2">
                                    <label>House No.</label>
                                </div>
                                <div class="col-md-10">
                                    <label>Street</label>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="house" name="house">
                                        </div>
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
                            <br>
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <label for="gender">Gender</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                             <select  id="gender" name="gender">
                                                <option value="" disabled selected>Choose gender</option>
                                                <option value="M">Male</option>
                                                <option value="F">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="position">Position</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select id="position" name="position">
                                                    @foreach($positions as $position)
                                                        <option value="{{ $position->Pos_ID }}">{{ $position->Pos_Name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <br>
                            <div class="row clearfix">
                                <div class="col-md-4 col-md-offset-8">
                                    <button type="submit" class="btn bg-teal btn-lg waves-effect" id="add">ADD</button>
                                    <button type="button" class="btn bg-teal btn-lg waves-effect" data-dismiss="modal">CANCEL</button>
                                </div>
                            </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <div class="modal fade" id="updatemodal" tabindex="-1" role="dialog">
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
                            <div class="text"><h3> UPDATE BARANGAY OFFICIAL</h3></div>
                            </div>
                    </div>
                </div>
                        </div>
                        <div class="modal-body">
                            <form enctype="multipart/form-data" id="updateofficial">
                            {{ csrf_field() }}
                            <div class="imgcontainer" style="text-align: center; margin: 24px 0 12px 0;" >
                                <center><img src="{{asset('images/human.png')}}" style="width: 30%;" class="img-responsive thumbnail" alt="profile" class="avatar" style="width: 40%;border-radius: 50%;text-align: center;" id="updatetoimage"></center>
                            </div>
                            <br>
                            <label for="prof_pic">Official Picture</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file" class="form-control-file" placeholder="Upload Image" accept="image/*" id="updateimage" name="updateimage1">
                                    </div>
                                </div>
                                <div class="row clearfix">
                                <div class="col-md-4">
                                    <label for="f_name">First Name</label>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="updatefname" name="updatefname" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="l_name">Middle Name</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="updatemname" name="updatemname">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="m_name">Last Name</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="updatelname" name="updatelname">
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="row clearfix">
                                <div class="col-md-4">
                                <label for="date">Birthdate</label>
                                   <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control date" id="updatebdate" name="updatebdate" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                <label for="contact_no">Contact No.</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="updatecontact" name="updatecontact">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Year Stayed</label>
                                    <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" min="1950" max=date('Y') class="form-control" id="updateyear" name="updateyear">
                                    </div>
                                    </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <label for="password">Address</label>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-md-6">
                                <label>House No.</label>
                                </div>
                                <div class="col-md-6">
                                <label>Street</label>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="updatehouse" name="updatehouse">
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control show tick" id="updatestreet">
                                        <option value="" disabled selected>Choose Street</option>
                                        @foreach($streets as $street)
                                            <option value="{{ $street->street_id }}">{{ $street->street_name }}, {{ $street->area_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row clearfix">
                                <div class="col-md-6">
                                <label for="gender">Gender</label>
                                <div class="form-group">
                                   <div class="form-line">
                                                 <select  id="updategender" name="updategender" disabled>
                                                    <option value="" disabled selected>Choose gender</option>
                                                    <option value="M">Male</option>
                                                    <option value="F">Female</option>
                                                </select>
                                            </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                <label for="position">Position</label>
                                <div class="form-group">
                                    <div class="form-line">
                                                 <select id="updateposition" name="updateposition">
                                                    @foreach($positions as $position)
                                                        <option value="{{ $position->Pos_ID }}">{{ $position->Pos_Name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                    </div>
                            </div>
                            <br>
                            <br>
                            <br>
                            <br>
                        <div class="modal-footer">
                            <button type="submit" class="btn bg-teal btn-lg waves-effect" id="updateadd">UPDATE</button>
                            <button type="button" class="btn bg-teal btn-lg waves-effect" data-dismiss="modal">CANCEL</button>
                            </form>
                        </div>
                    </div>
                </div>
    @include('admin.layout.scripts');
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{asset('plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
    <!--<script src="{{asset('plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>-->
    <script>
        $(document).ready(function(){

            $('#bdate').inputmask("9999-99-99",{"placeholder" : "yyyy-mm-dd"});

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var file="";

            var table = $('#OfficialTable').DataTable({
                "bSort": false,
                "ajax" : {
                    "url": "/maintenance_official/get",
                    "dataSrc" : function (json) {
                        var return_data = new Array();
                        for(var i=0;i< json.length; i++){
                            var sex ;
                            if(json[i].resident_gender=='M'){
                                sex="Male";
                            }
                            else{
                                sex="Female";
                            }
                            return_data.push({
                            'ID' : json[i].official_id,
                            'Image'  : '<img src="../' + json[i].resident_image +'" width="40px" height="40px">',
                            'Name' : json[i].name,
                            'Bdate' : json[i].resident_bdate,
                            'Gender' : sex,
                            'Add' : json[i].street,
                            'Pos' : json[i].position_name
                            })
                        }     
                        return return_data;
                    }
                },
                "columns": [
                    { "data": "ID" },
                    { "data": "Image"},
                    { "data": "Name" },
                    { "data": "Bdate" },
                    { "data": "Gender" },
                    { "data": "Add" },
                    { "data": "Pos" },
                    { "defaultContent": "<button type = 'button' class = 'update btn btn-space bg-blue waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Update Record'><i class='material-icons'>create</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button>" }
                ],
                "columnDefs": [
                    { 
                        className : "dt-right",
                        "targets" : [6]
                    }
                ],
            });

            //var table = $('#OfficialTable').DataTable();

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

            $('#official').validate({
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
                    position: {
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
                    formData.append('pos', $('#position').val());
                    formData.append('area', $('#area').val());
                    formData.append('year', $('#year').val());
                    var pos = $('#position option:selected').text();
                    $.ajax({
                        url : '/maintenance_official',
                        method : 'POST',
                        data : formData,
                        processData : false,
                        contentType : false,
                        cache : false,
                        headers : {
                            'X-CSRF-TOKEN' : CSRF_TOKEN
                        },
                        success : function(response){
                            if(response['official'][0].Off_Gender=='M'){
                                var sex = "Male";
                            }
                            else{
                                var sex = "Female";
                            }
                            $('#defaultModal').modal('toggle');

                            var newRow = "<tr><td>"+response['official'][0].Off_ID+"</td><td><img src='"+response['official'][0].Off_Image+"' width='40px;' height='40px;'></td><td>"+response['official'][0].Off_Fname+' '+response['official'][0].Off_Lname+"</td><td>"+(response['official'][0].Off_Bdate).split(' ')[0]+"</td><td>"+sex+"</td><td>"+response['official'][0].Off_House+" "+response['official'][0].Off_Street+" "+response['official'][0].Off_Area+"</td><td>"+pos+"</td><td><button type = 'button' class = 'update btn btn-space bg-blue waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Update Record'><i class='material-icons'>create</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button></td></tr>";
                            table.row.add($(newRow)).draw();
                            swal({
                                title : "Record Added",
                                type : "success",
                                timer : 1000,
                                showConfirmButton : false
                            });
                            var pos1 = response['position'];
                            var i;
                            
                            $('#position').empty();
                            for (i = 0; i < pos1.length; ++i) {
                                $('#position').append($('<option></option>')).attr("value", pos1[i].Pos_ID).text(pos1[i].Pos_Name);
                            }
                            $('#position').selectpicker('refresh');
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
            
            $('#OfficialTable tbody').on('click', 'button.update', function(){
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

            $('#OfficialTable tbody').on('click', 'button.delete', function(){
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
</body>
</html>