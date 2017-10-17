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
                
                                    <div class="col-sm-2 col-sm-offset-10">
                                        <button type="button" class="btn bg-teal btn-lg waves-effect waves-float pull-right" data-toggle="modal" data-target="#defaultModal"><i class="material-icons">add</i>Add incident</button>
                                    </div>
                                </div>
            <div class="row clearfix">
                <div class="col-sm-12" style="display: none;" id="btndisp">
                <span>
                    <button type="button" class="btn bg-teal btn-lg waves-effect waves-float pull-left" id="newinc"><i class="material-icons">refresh</i>New Incidents Found</button>
                </span>
                </div>
            </div>
                                <br>
            <!-- Basic Table -->
            <div class="row">    
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <br>
                        <div class="row">
                            <div class="col-sm-3 col-sm-offset-9">
                                <span><h4><span class="label label-primary" id="actiondone">Action Done</span> <span class="label label-warning" id="pending">Pending</span> <span class="label label-success" id="ongoing">On-going</span> <span class="label label-info" id="all">All</span></h4></span>
                            </div>
                        </div>
                        <br>
                        <div class="body table-responsive">
                            <table class="table table-condensed table-bordered table-striped table-hover dataTable js-exportable" id="incTable">
                                <thead>
                                    <tr class="bg-blue-grey">
                                        <th>ID</th>
                                        <th>Place</th>
                                        <th>Date and Time</th>
                                        <th>Incident Type</th>
                                        <th>Status</th>
                                        <th>Notes</th>
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
                            
                            <div class='row clearfix'>
                                <div class="col-md-6">
                                    <label>Street</label>
                                    <div class="form-group">
                                        <select class="form-control show tick" id="street" name="street">
                                            <option value="" disabled selected>Choose Street</option>
                                            @foreach($streets as $street)
                                                <option value ="{{$street->street_id}}">{{$street->street_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Area</label>
                                    <div class="form-group">
                                        <select class="form-control show tick" id="area" name="area">
                                            <option value="" disabled selected>Choose Area</option>
                                            @foreach($areas as $street)
                                                <option value ="{{$street->area_id}}">{{$street->area_name}}</option>
                                            @endforeach
                                            <option value="">All Area</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                             <div class="row clearfix">
                                <div class="col-md-6">
                                <label for="datetime">Date and Time</label>
                                   <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="dt" placeholder="Please choose date & time...">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="cat">Incident Type</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                        <select id="cat" name="cat" class="form-control show tick">
                                        <option value="" disabled selected>Choose Type</option>
                                        @foreach($incidentcats as $incidentcat)
                                            <option value="{{$incidentcat->incidentcat_id}}">{{$incidentcat->incidentcat_name}}</option>
                                        @endforeach
                                    </select>
                                    </div>  
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-12">
                                <label>Description</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea rows="4" class="form-control no-resize" id="desc" name="desc" placeholder="Please type incident's description" required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-md-12">
                                <label>Notes</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea rows="4" class="form-control no-resize" id="notes" name="notes" placeholder="Please type a note"></textarea>
                                        </div>
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

<div class="modal fade" tabindex="-1" id="view" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row clearfix">
                    <div class="col-md-12">
                        <h2>Incident Details</h2>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label>Incident ID</label>
                        </div>
                        <div class="col-sm-8">
                            <p id="vid"></p>
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label>Datetime</label>
                        </div>
                        <div class="col-sm-8">
                            <p id="vdt"></p>
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label>Statement</label>
                        </div>
                        <div class="col-sm-8">
                            <p id="vdesc"></p>
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label>Street</label>
                        </div>
                        <div class="col-sm-8">
                            <p id="vst"></p>
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label>Latitude</label>
                        </div>
                        <div class="col-sm-8">
                            <p id="vlat"></p>
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label>Longitude</label>
                        </div>
                        <div class="col-sm-8">
                            <p id="vlong"></p>
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label>Type</label>
                        </div>
                        <div class="col-sm-8">
                            <p id="vtype"></p>
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label>Status</label>
                        </div>
                        <div class="col-sm-8">
                            <p id="vstat"></p>
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label>Notes</label>
                        </div>
                        <div class="col-sm-8">
                            <p id="vnote"></p>
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label>Date Filed</label>
                        </div>
                        <div class="col-sm-8">
                            <p id="vdf"></p>
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-12">
                        <div class="col-sm-3 col-sm-offset-9">
                            <button type="button" class="btn btn-lg bg-teal waves-effect pull-right" id="okbtn">OKAY</button>
                        </div>
                    </div>
                </div>
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
               
                    <form id="updateinc">
                    <div class="row clearfix">
                        <br><br>
                        <div class="form-group">
                            <div class="col-sm-4">
                                <label>Current Status</label>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                        <select class="form-control show tick" id="stat" name="stat">
                                            <option value="On-going">On-going</option>
                                            <option value="Action Done">Action Done</option>
                                        </select>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="row clearfix">
                        <div class="form-group">
                            <div class="col-sm-4">
                                <label>Update Note</label>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-line">
                                    <textarea rows="4" class="form-control no-resize" id="updatedesc" name="updatedesc" placeholder="Please type incident's description"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                        <div class="row clearfix">
                        <div class="col-md-6 col-md-offset-6">
                            <button type="submit" class="btn btn-lg bg-teal waves-effect" id="updatebtn">Update</button>
                            <button type="button" class="btn bg-teal btn-lg waves-effect" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                    </form>
                    <br>
            </div>
        </div>
    </div>

@include('admin.layout.scripts');
<script src="{{asset('plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
<script>
    $(document).ready(function(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        var streets = [
            @foreach($streets as $street)
                [{{$street->street_id}}, {{$street->area_id}}],
            @endforeach
        ];

        console.log(streets);

        $('#street').change(function(){
            var street = $('#street').val();
            if($('#area').val()==""||$('#area').val()==null){
            $.each(streets, function(index, value){
                if(street==value[0]){
                    $('#area').val(streets[index][1]).change();
                    console.log(streets[index][1]);
                }
            });
            }
        });

        $('#ongoing').on('click', function(){
            table.destroy();
            table = $("#incTable").DataTable({
            bSort: false,
            "ajax" : {
                    "url": "/getIncident/ongoing",
                    "dataSrc" : function (json) {
                        var return_data = new Array();
                        tblctr = json.length;
                        for(var i=0;i< json.length; i++){
                            var notes = json[i].incident_notes;
                            if(notes==null){
                                notes="";
                            }
                            var button = "";
                            button = "<button type = 'button' class = 'update btn btn-space bg-blue waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Update Record'><i class='material-icons'>create</i></button><button type = 'button' class = 'view btn btn-space bg-green waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='View Record'><i class='material-icons'>view_module</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button>";
                            return_data.push({
                            'ID' : json[i].incident_id,
                            'Place' : json[i].place,
                            'DateTime' : json[i].incident_datetime,
                            'Desc' : json[i].incidentcat_name,
                            'Status': json[i].incident_status,
                            'Notes': notes,
                            'Button': button
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
                    { "data": "Notes" },
                    { "data": "Button" },
                    ]
            });
        });

        $('#all').on('click', function(){
            table.destroy();
            table = $("#incTable").DataTable({
            bSort: false,
            "ajax" : {
                    "url": "/getIncident",
                    "dataSrc" : function (json) {
                        var return_data = new Array();
                        tblctr = json.length;
                        for(var i=0;i< json.length; i++){
                            var notes = json[i].incident_notes;
                            if(notes==null){
                                notes="";
                            }
                            var button = "";
                            if(json[i].incident_status=="Pending"){
                                button = "<button type = 'button' class = 'approve btn btn-space bg-orange waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Approve Record'><i class='material-icons'>done</i></button><button type = 'button' class = 'view btn btn-space bg-green waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='View Record'><i class='material-icons'>view_module</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button>"
                            }
                            else{
                                button = "<button type = 'button' class = 'update btn btn-space bg-blue waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Update Record'><i class='material-icons'>create</i></button><button type = 'button' class = 'view btn btn-space bg-green waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='View Record'><i class='material-icons'>view_module</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button>"
                            }
                            return_data.push({
                            'ID' : json[i].incident_id,
                            'Place' : json[i].place,
                            'DateTime' : json[i].incident_datetime,
                            'Desc' : json[i].incidentcat_name,
                            'Status': json[i].incident_status,
                            'Notes': notes,
                            'Button': button
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
                    { "data": "Notes" },
                    { "data": "Button" },
                    ]
            });
        });

        $('#pending').on('click', function(){
            table.destroy();
            table = $("#incTable").DataTable({
            bSort: false,
            "ajax" : {
                    "url": "/getIncident/pending",
                    "dataSrc" : function (json) {
                        var return_data = new Array();
                        tblctr = json.length;
                        for(var i=0;i< json.length; i++){
                            var notes = json[i].incident_notes;
                            if(notes==null){
                                notes="";
                            }
                            var button = "";
                            if(json[i].incident_status=="Pending"){
                                button = "<button type = 'button' class = 'approve btn btn-space bg-orange waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Approve Record'><i class='material-icons'>done</i></button><button type = 'button' class = 'view btn btn-space bg-green waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='View Record'><i class='material-icons'>view_module</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button>"
                            }
                            else{
                                button = "<button type = 'button' class = 'update btn btn-space bg-blue waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Update Record'><i class='material-icons'>create</i></button><button type = 'button' class = 'view btn btn-space bg-green waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='View Record'><i class='material-icons'>view_module</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button>"
                            }
                            return_data.push({
                            'ID' : json[i].incident_id,
                            'Place' : json[i].place,
                            'DateTime' : json[i].incident_datetime,
                            'Desc' : json[i].incidentcat_name,
                            'Status': json[i].incident_status,
                            'Notes': notes,
                            'Button': button
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
                    { "data": "Notes" },
                    { "data": "Button" },
                    ]
            });
        });

        $('#actiondone').on('click', function(){
            table.destroy();
            table = $("#incTable").DataTable({
            bSort: false,
            "ajax" : {
                    "url": "/getIncident/actiondone",
                    "dataSrc" : function (json) {
                        var return_data = new Array();
                        tblctr = json.length;
                        for(var i=0;i< json.length; i++){
                            var notes = json[i].incident_notes;
                            if(notes==null){
                                notes="";
                            }
                            var button = "";
                            button = "<button type = 'button' class = 'update btn btn-space bg-blue waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Update Record'><i class='material-icons'>create</i></button><button type = 'button' class = 'view btn btn-space bg-green waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='View Record'><i class='material-icons'>view_module</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button>";
                            return_data.push({
                            'ID' : json[i].incident_id,
                            'Place' : json[i].place,
                            'DateTime' : json[i].incident_datetime,
                            'Desc' : json[i].incidentcat_name,
                            'Status': json[i].incident_status,
                            'Notes': notes,
                            'Button': button
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
                    { "data": "Notes" },
                    { "data": "Button" },
                    ]
            });
        })

        $('#okbtn').on('click', function(){
            $('#view').modal('toggle');
        });

        $('#area').change(function(){

            var area = $('#area').val();
            if(area==""){
                var newOptions = [
                    @foreach($streets as $street)
                        [{{$street->street_id}}, "{{$street->street_name}}"],
                    @endforeach
                ];
                var $el= $('#street');
                $el.empty();
                $el.html('');
                $.each(newOptions, function(index, value){
                    $el.append($("<option></option>").attr("value", value[0]).text(value[1]));
                });
            }
            else{
                console.log("dasdasd");
                var newOptions = [
                    @foreach($streets as $street)
                        [{{$street->street_id}}, "{{$street->street_name}}", {{$street->area_id}}],
                    @endforeach
                ];
                var $el= $('#street');
                $el.empty();
                $el.html('');
                $.each(newOptions, function(index, value){
                    if(value[2]==area){
                        $el.append($("<option></option>").attr("value", value[0]).text(value[1]));
                    }
                });
            }
            $('#street').val("");
            $('#street').selectpicker('refresh');
        });


        $('#dt').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                timePicker: true,
                locale: {
                    format: 'YYYY-MM-DD h:mm:ss'
                },
                minDate: moment().subtract(1,'months'),
                maxDate: moment()
        });

        var tblctr = 0; 
        var table = $('#incTable').DataTable({
            bSort: false,
            "ajax" : {
                    "url": "/getIncident",
                    "dataSrc" : function (json) {
                        var return_data = new Array();
                        tblctr = json.length;
                        for(var i=0;i< json.length; i++){
                            var notes = json[i].incident_notes;
                            if(notes==null){
                                notes="";
                            }
                            var button = "";
                            if(json[i].incident_status=="Pending"){
                                button = "<button type = 'button' class = 'approve btn btn-space bg-orange waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Approve Record'><i class='material-icons'>done</i></button><button type = 'button' class = 'view btn btn-space bg-green waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='View Record'><i class='material-icons'>view_module</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button>"
                            }
                            else{
                                button = "<button type = 'button' class = 'update btn btn-space bg-blue waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Update Record'><i class='material-icons'>create</i></button><button type = 'button' class = 'view btn btn-space bg-green waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='View Record'><i class='material-icons'>view_module</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button>"
                            }
                            return_data.push({
                            'ID' : json[i].incident_id,
                            'Place' : json[i].place,
                            'DateTime' : json[i].incident_datetime,
                            'Desc' : json[i].incidentcat_name,
                            'Status': json[i].incident_status,
                            'Notes': notes,
                            'Button': button
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
                    { "data": "Notes" },
                    { "data": "Button" },
                ]
        });

        var finid;

            $.validator.addMethod("alpha", function(value, element) {
                    return this.optional(element) || value.trim() == value.match(/^[a-zA-Z .,]*$/);
                },"Letters, spaces, period and comma only");

                $.validator.addMethod("letterwithbasicpunc", function(value, element) {
                    return this.optional(element) || value.trim() == value.match(/^[a-zA-Z0-9 !()?.,]*$/);
                },"Letters and numbers with basic punctuations only");            

            $('#incident').validate({
                rules: {
                    street:{
                        required: true
                    },
                    area:{
                        required: true
                    },
                    datetime:{
                        required: true
                    },
                    cat:{
                        required: true
                    },   
                    desc:{
                        required: true,
                        maxlength: 300,
                        letterwithbasicpunc: true
                    },
                    notes:{
                        required: false,
                        maxlength: 300,
                        letterwithbasicpunc: true
                    }
                },
                submitHandler: function(form){
                    $.ajax({
                    url : '/storeIncident',
                    method : 'POST',
                    data : {
                        _token : CSRF_TOKEN,
                        street_id: $('#street').val(),
                        street_name: $('#street option:selected').text(),
                        datetime: $('#dt').val(),
                        cat: $('#cat').val(),
                        desc: $('#desc').val(),
                        notes: $('#notes').val()
                    },
                    dataType : 'json',
                    success : function(response){
                        $('#defaultModal').modal('toggle');
                        tblctr++;
                        var newRow = "<tr><td>"+response[0].incident_id+"</td><td>"+response[0].place+"</td><td>"+response[0].incident_datetime+"</td><td>"+response[0].incidentcat_name+"</td><td>"+response[0].incident_status+"</td><td>"+response[0].incident_notes+"</td><td><button type = 'button' class = 'update btn btn-space bg-blue waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Update Record'><i class='material-icons'>create</i></button><button type = 'button' class = 'view btn btn-space bg-green waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='View Record'><i class='material-icons'>view_module</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button></td></tr>";
                        table.row.add($(newRow)).draw();
                        swal({
                            title : "Record Added",
                            type : "success",
                            timer : 1000,
                            showConfirmButton : false
                        });
                        $('#street').val("");
                        $('#street').selectpicker('refresh');
                        $('#area').val("");
                        $('#area').selectpicker('refresh');
                        $('#desc').val("");
                        $('#dt').val("");
                        $('#notes').val("");
                        $.ajax({
                            type: "get",
                            url: "/sendMessages",
                            data: {
                                incident : response[0].incidentcat_name
                            },
                            success: function(data) {
                                console.log("success"+" "+data);
                            }
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
        var updateid = "";

         $('#incTable tbody').on('click', 'button.update', function(){
                var id = table.row($(this).parents('tr')).data().ID;   
                updateid= id; 
                finid = id;
                $.ajax({
                    url: '/blotter/incident/getstat/'+id,
                    method: 'GET',
                    data : {
                        _token : CSRF_TOKEN,
                        id : id
                    },
                    dataType : 'json',
                    success : function(response){
                        $('#stat').val(response[0].incident_status).change();
                        $('#updatedesc').val(response[0].incident_notes);
                        $('#update').modal('toggle');
                    }
                });
                
                
            });

         $('#incTable tbody').on('click', 'button.approve', function(){
                var id = table.row($(this).parents('tr')).data().ID;    
                finid = id;
                $.ajax({
                    url: '/blotter/incident/updatestat/'+id,
                    method: 'GET',
                    data : {
                        _token : CSRF_TOKEN,
                        id : id
                    },
                    success : function(response){
                        if(response=="success"){
                            swal({
                                    title : "Record Approved!",
                                    type : "success",
                                    timer : 1000,
                                    showConfirmButton : false
                                });
                            table.ajax.reload();
                        }
                        else{
                            swal({
                                    title : "Error",
                                    type : "error",
                                    timer : 1000,
                                    showConfirmButton : false
                                });
                        }
                    }
                }); 
            });

         $('#incTable tbody').on('click', 'button.view', function(){
                var id = table.row($(this).parents('tr')).data().ID;    
                finid = id;
                $.ajax({
                    url: '/blotter/incident/getdetails/'+id,
                    method: 'GET',
                    data : {
                        _token : CSRF_TOKEN
                    },
                    success : function(response){
                        $('#vid').text(response[0].incident_id);
                        $('#vdt').text(response[0].incident_datetime);
                        $('#vst').text(response[0].street_name);
                        $('#vlat').text(response[0].incident_lat);
                        $('#vlong').text(response[0].incident_long);
                        $('#vtype').text(response[0].incidentcat_name);
                        $('#vstat').text(response[0].incident_status);
                        $('#vdesc').text(response[0].incident_statement);
                        $('#vnote').text(response[0].incident_notes);
                        $('#vdf').text(response[0].incident_filed);
                        $('#view').modal('toggle');
                    }
                }); 
            });


         $('#incTable tbody').on('click', 'button.delete', function(){
            var id = table.row($(this).parents('tr')).data().ID;    
                 swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this record!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Delete",
                    closeOnConfirm: false
                }, function (isConfirm) {
                    if(isConfirm){
                    $.ajax({
                        url: '/deleteIncident',
                        method: 'POST',
                        data : {
                            _token : CSRF_TOKEN,
                            id : id
                        },
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
                    }
                });                
            });

        $('#updateinc').validate({
            rules: {
                updatedesc:{
                    required: false,
                        maxlength: 300,
                        letterwithbasicpunc: true
                },
                stat: {
                    required: true
                }
            },
            submitHandler : function(form){
                $.ajax({
                    url : '/blotter/incident/updateincident',
                    method: 'POST',
                    data : {
                        _token: CSRF_TOKEN,
                        updateid : updateid,
                        stat : $('#stat').val(),
                        desc: $('#updatedesc').val()
                    },
                    success: function(response){
                        if(response=="success"){
                            swal({
                                    title : "Record Updated",
                                    type : "success",
                                    timer : 1000,
                                    showConfirmButton : false
                                });
                                table.ajax.reload();
                        }
                        else{
                             swal({
                                        title : "Record is not Updated",
                                        type : "error",
                                        timer : 1500,
                                        showConfirmButton : false
                                });
                        }
                        $('#update').modal('toggle');
                    }
                })
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
        })


    });
</script>
</body>
</html>
