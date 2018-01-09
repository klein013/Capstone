<!DOCTYPE html>
<html>
<head>
	<title>Clearance | Requests</title>
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
        @if(!empty($check[0]->official_id))
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-teal">
                        <div class="icon">
                            <i class="material-icons">border_color</i>
                        </div>
                        <div class="content">
                            <div class="text"><h3> RELEASE</h3></div>
                        </div>
                    </div>
                </div>


            </div>
            </div>
            <!-- Basic Table -->
            <div class="row clearfix">
            </div>
            <br>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                	<div class="card">
                        <br>
                        <div class="row">
                            <div class="col-sm-3 col-sm-offset-9">
                                <span><h4><span class="label label-primary" id="release">Released</span> <span class="label label-warning" id="forrelease">For Release</span> <span class="label label-info" id="all">All</span></h4></span>
                            </div>
                        </div>
                        <br>
                        <div class="body table-responsive">
                            <table class="table dataTable table-bordered table-hover table-condensed table-striped" width="100%" id="releaseTable">
                                <thead>
                                    <tr class="bg-blue-grey">
                                        <th></th>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Clearance Type</th>
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

        <div class="modal fade" id="reqmodal" tabindex="-2" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="row clearfix">
                                <div class="col-lg-7 col-md-3 col-sm-6 col-xs-12">
                                    <h4>Deficient Requirement/s</h4>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row clearfix">
                                <div class="col-sm-12" id="reqcont">
                                </div>
                            </div>
                            <br>
                            <div class="row clearfix">
                                <div class="col-sm-3 col-sm-offset-9">
                                    <button type="button" class="btn btn-lg waves-effect bg-teal" id="reqproc">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
    @else
        <div class="container-fluid">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="card">
                    <div class="row clearfix">
                        <br><br><br><br>
                        <div class="col-sm-12">
                        <center>
                            <h1>Releasing is not allowed</h1>
                        </center>
                        <center>
                        <h3>There is no registered barangay captain</h3>
                    </center>
                    <br><br><br><br>
                    </div>

                    </div>
                </div>
            </div>
        </div>

    @endif
    </section>
   

@include('admin.layout.scripts')
<script src="{{asset('plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
<script>
    $(document).ready(function(){
        var csrf_token = $('meta[name="csrf-token"]').attr('content');

        $('#release').on('click', function(){
            table.destroy();
                        table = $('#releaseTable').DataTable({
                'bSort': false,
            'ajax': {
                'url' : '/clearance/release/getRelease',
                'method' : 'GET',
                'data' : 'json',
                'dataSrc' : function(json){
                    console.log(json); 
                    var return_data = new Array();
                    var id;
                    var row = "";
                    var file = "";
                        for(var i=0;i< json.length; i++){
                            if(i==0){
                                id = json[i].trans_id
                                row += "<tr style='width:50%;'><td>" + json[i].clearance_type + "</td><td style='width:30%;'>" + json[i].request_status + "</td><td style='width:10%;'><button  type = 'button' class = 'download btn btn-space bg-black waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Download Document' value='"+json[i].request_id+"'><i class='material-icons'>file_download</i></button></td></tr>";
                                if(i==json.length-1){
                                    return_data.push({
                                        'ID' : json[i].trans_id,
                                        'Name' : json[i].name,
                                        'RDate' : json[i].trans_date,
                                        'Type': "<table class='table-bordered table-hover table-condensed table-striped' width='100%;'>"+row+"</table>"
                                        });
                                }
                            }
                            else if(i==json.length-1){
                                console.log(json.length-1);
                                    if(id!=json[i].trans_id){
                                        return_data.push({
                                        'ID' : json[i-1].trans_id,
                                        'Name' : json[i-1].name,
                                        'RDate' : json[i-1].trans_date,
                                        'Type': "<table class='table-bordered table-hover table-condensed table-striped' width='100%;'>"+row+"</table>"
                                        });
                                        console.log("he");
                                        id = json[i].trans_id;
                                        row="";
                                        row +=  "<tr><td style='width:50%;'>" + json[i].clearance_type + "</td><td style='width:30%;'>" + json[i].request_status + "</td><td style='width:10%;'><button type = 'button' class = 'download btn btn-space bg-black waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Download Document' value='"+json[i].request_id+"'><i class='material-icons'>file_download</i></button></td></tr>";
                                        return_data.push({
                                        'ID' : json[i].trans_id,
                                        'Name' : json[i].name,
                                        'RDate' : json[i].trans_date,
                                        'Type': "<table class='table-bordered table-hover table-condensed table-striped' width='100%;'>"+row+"</table>"
                                        });
                                    }
                                    else{
                                        id = json[i].trans_id;
                                        row +=  "<tr><td style='width:50%;'>" + json[i].clearance_type + "</td><td style='width:30%;'>" + json[i].request_status + "</td><td style='width:10%;'><button type = 'button' class = 'download btn btn-space bg-black waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Download Document' value='"+json[i].request_id+"'><i class='material-icons'>file_download</i></button></td></tr>";
                                        return_data.push({
                                        'ID' : json[i].trans_id,
                                        'Name' : json[i].name,
                                        'RDate' : json[i].trans_date,
                                        'Type': "<table class='table-bordered table-hover table-condensed table-striped' width='100%;'>"+row+"</table>"
                                        });
                                    }
                                }
                            else{
                                if(id!=json[i].trans_id){
                                    return_data.push({
                                        'ID' : json[i-1].trans_id,
                                        'Name' : json[i-1].name,
                                        'RDate' : json[i-1].trans_date,
                                        'Type': "<table class='table-bordered table-hover table-condensed table-striped' width='100%;'>"+row+"</table>"
                                    });
                                    id = json[i].trans_id;
                                    row =  "<tr><td style='width:50%;'>" + json[i].clearance_type + "</td><td style='width:30%;'>" + json[i].request_status + "</td><td style='width:10%;'><button type = 'button' class = 'download btn btn-space bg-black waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Download Document' value='"+json[i].request_id+"'><i class='material-icons'>file_download</i></button></td></tr>";
                                }
                                else{
                                    row += "<tr><td style='width:50%;'>   " + json[i].clearance_type + "</td><td style='width:30%;'>" + json[i].request_status + "</td><td style='width:10%;'><button type = 'button' class = 'download btn btn-space bg-black waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Download Document' value='"+json[i].request_id+"'><i class='material-icons'>file_download</i></button></td></tr>";
                                }
                                if(i==json.length-1){
                                    return_data.push({
                                        'ID' : json[i].trans_id,
                                        'Name' : json[i].name,
                                        'RDate' : json[i].trans_date,
                                        'Type': "<table class='table-bordered table-hover table-condensed table-striped' width='100%;'>"+row+"</table>"
                                        });
                                }
                                   
                            }
                        }
                          
                    return return_data;
                }
            },
            'columns': [
                {'data' : 'ID'},
                {'data' : 'Name'},
                {'data' : 'RDate'},
                {'data' : 'Type'}            ]

            });
        })

        $('#forrelease').on('click', function(){
            table.destroy();
            table = $('#releaseTable').DataTable({
                'bSort': false,
            'ajax': {
                'url' : '/clearance/release/getForRelease',
                'method' : 'GET',
                'data' : 'json',
                'dataSrc' : function(json){
                    console.log(json); 
                    var return_data = new Array();
                    var id;
                    var row = "";
                    var file = "";
                        for(var i=0;i< json.length; i++){
                            if(i==0){
                                id = json[i].trans_id
                                row += "<tr><td style='width:50%;'>" + json[i].clearance_type + "</td><td style='width:30%;'>" + json[i].request_status + "</td><td style='width:10%;'><button type = 'button' class = 'download btn btn-space bg-black waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Download Document' value='"+json[i].request_id+"'><i class='material-icons'>file_download</i></button></td></tr>";
                                if(i==json.length-1){
                                    return_data.push({
                                        'ID' : json[i].trans_id,
                                        'Name' : json[i].name,
                                        'RDate' : json[i].trans_date,
                                        'Type': "<table class='table-bordered table-hover table-condensed table-striped' width='100%;'>"+row+"</table>"
                                        });
                                }
                            }
                            else if(i==json.length-1){
                                console.log(json.length-1);
                                    if(id!=json[i].trans_id){
                                        return_data.push({
                                        'ID' : json[i-1].trans_id,
                                        'Name' : json[i-1].name,
                                        'RDate' : json[i-1].trans_date,
                                        'Type': "<table class='table-bordered table-hover table-condensed table-striped' width='100%;'>"+row+"</table>"
                                        });
                                        console.log("he");
                                        id = json[i].trans_id;
                                        row="";
                                        row +=  "<tr><td style='width:50%;'>" + json[i].clearance_type + "</td><td style='width:30%;'>" + json[i].request_status + "</td><td style='width:10%;'><button type = 'button' class = 'download btn btn-space bg-black waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Download Document' value='"+json[i].request_id+"'><i class='material-icons'>file_download</i></button></td></tr>";
                                        return_data.push({
                                        'ID' : json[i].trans_id,
                                        'Name' : json[i].name,
                                        'RDate' : json[i].trans_date,
                                        'Type': "<table class='table-bordered table-hover table-condensed table-striped' width='100%;'>"+row+"</table>"
                                        });
                                    }
                                    else{
                                        id = json[i].trans_id;
                                        row +=  "<tr><td style='width:50%;'>" + json[i].clearance_type + "</td><td style='width:30%;'>" + json[i].request_status + "</td><td style='width:10%;'><button type = 'button' class = 'download btn btn-space bg-black waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Download Document' value='"+json[i].request_id+"'><i class='material-icons'>file_download</i></button></td></tr>";
                                        return_data.push({
                                        'ID' : json[i].trans_id,
                                        'Name' : json[i].name,
                                        'RDate' : json[i].trans_date,
                                        'Type': "<table class='table-bordered table-hover table-condensed table-striped' width='100%;'>"+row+"</table>"
                                        });
                                    }
                                }
                            else{
                                if(id!=json[i].trans_id){
                                    return_data.push({
                                        'ID' : json[i-1].trans_id,
                                        'Name' : json[i-1].name,
                                        'RDate' : json[i-1].trans_date,
                                        'Type': "<table class='table-bordered table-hover table-condensed table-striped' width='100%;'>"+row+"</table>"
                                    });
                                    id = json[i].trans_id;
                                    row =  "<tr><td style='width:50%;'>" + json[i].clearance_type + "</td><td style='width:30%;'>" + json[i].request_status + "</td><td style='width:10%;'><button type = 'button' class = 'download btn btn-space bg-black waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Download Document' value='"+json[i].request_id+"'><i class='material-icons'>file_download</i></button></td></tr>";
                                }
                                else{
                                    row += "<tr><td style='width:50%;'>   " + json[i].clearance_type + "</td><td style='width:30%;'>" + json[i].request_status + "</td><td style='width:10%;'><button type = 'button' class = 'download btn btn-space bg-black waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Download Document' value='"+json[i].request_id+"'><i class='material-icons'>file_download</i></button></td></tr>";
                                }
                                if(i==json.length-1){
                                    return_data.push({
                                        'ID' : json[i].trans_id,
                                        'Name' : json[i].name,
                                        'RDate' : json[i].trans_date,
                                        'Type': "<table class='table-bordered table-hover table-condensed table-striped' width='100%;'>"+row+"</table>"
                                        });
                                }
                                   
                            }
                        }
                          
                    return return_data;
                }
            },
            'columns': [
                {'data' : 'ID'},
                {'data' : 'Name'},
                {'data' : 'RDate'},
                {'data' : 'Type'}            ]

            });
        })

        $('#all').on('click', function(){
            table.destroy();
            table = $('#releaseTable').DataTable({
                'bSort': false,
            'ajax': {
                'url' : '/clearance/release/get',
                'method' : 'GET',
                'data' : 'json',
                'dataSrc' : function(json){
                    console.log(json); 
                    var return_data = new Array();
                    var id;
                    var row = "";
                    var file = "";
                        for(var i=0;i< json.length; i++){
                            if(i==0){
                                id = json[i].trans_id
                                row += "<tr><td style='width:50%;'>" + json[i].clearance_type + "</td><td style='width:30%;'>" + json[i].request_status + "</td><td style='width:10%;'><button type = 'button' class = 'download btn btn-space bg-black waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Download Document' value='"+json[i].request_id+"'><i class='material-icons'>file_download</i></button></td></tr>";
                                if(i==json.length-1){
                                    return_data.push({
                                        'ID' : json[i].trans_id,
                                        'Name' : json[i].name,
                                        'RDate' : json[i].trans_date,
                                        'Type': "<table class='table-bordered table-hover table-condensed table-striped' width='100%;'>"+row+"</table>"
                                        });
                                }
                            }
                            else if(i==json.length-1){
                                console.log(json.length-1);
                                    if(id!=json[i].trans_id){
                                        return_data.push({
                                        'ID' : json[i-1].trans_id,
                                        'Name' : json[i-1].name,
                                        'RDate' : json[i-1].trans_date,
                                        'Type': "<table class='table-bordered table-hover table-condensed table-striped' width='100%;'>"+row+"</table>"
                                        });
                                        console.log("he");
                                        id = json[i].trans_id;
                                        row="";
                                        row +=  "<tr><td style='width:50%;'>" + json[i].clearance_type + "</td><td style='width:30%;'>" + json[i].request_status + "</td><td style='width:10%;'><button type = 'button' class = 'download btn btn-space bg-black waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Download Document' value='"+json[i].request_id+"'><i class='material-icons'>file_download</i></button></td></tr>";
                                        return_data.push({
                                        'ID' : json[i].trans_id,
                                        'Name' : json[i].name,
                                        'RDate' : json[i].trans_date,
                                        'Type': "<table class='table-bordered table-hover table-condensed table-striped' width='100%;'>"+row+"</table>"
                                        });
                                    }
                                    else{
                                        id = json[i].trans_id;
                                        row +=  "<tr><td style='width:50%;'>" + json[i].clearance_type + "</td><td style='width:30%;'>" + json[i].request_status + "</td><td style='width:10%;'><button type = 'button' class = 'download btn btn-space bg-black waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Download Document' value='"+json[i].request_id+"'><i class='material-icons'>file_download</i></button></td></tr>";
                                        return_data.push({
                                        'ID' : json[i].trans_id,
                                        'Name' : json[i].name,
                                        'RDate' : json[i].trans_date,
                                        'Type': "<table class='table-bordered table-hover table-condensed table-striped' width='100%;'>"+row+"</table>"
                                        });
                                    }
                                }
                            else{
                                if(id!=json[i].trans_id){
                                    return_data.push({
                                        'ID' : json[i-1].trans_id,
                                        'Name' : json[i-1].name,
                                        'RDate' : json[i-1].trans_date,
                                        'Type': "<table class='table-bordered table-hover table-condensed table-striped' width='100%;'>"+row+"</table>"
                                    });
                                    id = json[i].trans_id;
                                    row =  "<tr><td style='width:50%;'>" + json[i].clearance_type + "</td><td style='width:30%;'>" + json[i].request_status + "</td><td style='width:10%;'><button type = 'button' class = 'download btn btn-space bg-black waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Download Document' value='"+json[i].request_id+"'><i class='material-icons'>file_download</i></button></td></tr>";
                                }
                                else{
                                    row += "<tr><td style='width:50%;'>   " + json[i].clearance_type + "</td><td style='width:30%;'>" + json[i].request_status + "</td><td style='width:10%;'><button type = 'button' class = 'download btn btn-space bg-black waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Download Document' value='"+json[i].request_id+"'><i class='material-icons'>file_download</i></button></td></tr>";
                                }
                                if(i==json.length-1){
                                    return_data.push({
                                        'ID' : json[i].trans_id,
                                        'Name' : json[i].name,
                                        'RDate' : json[i].trans_date,
                                        'Type': "<table class='table-bordered table-hover table-condensed table-striped' width='100%;'>"+row+"</table>"
                                        });
                                }
                                   
                            }
                        }
                          
                    return return_data;
                }
            },
            'columns': [
                {'data' : 'ID'},
                {'data' : 'Name'},
                {'data' : 'RDate'},
                {'data' : 'Type'}            ]

            })
        })

        var table = $('#releaseTable').DataTable({
            'bSort': false,
            'ajax': {
                'url' : '/clearance/release/get',
                'method' : 'GET',
                'data' : 'json',
                'dataSrc' : function(json){
                    console.log(json); 
                    var return_data = new Array();
                    var id;
                    var row = "";
                    var file = "";
                        for(var i=0;i< json.length; i++){
                            if(i==0){
                                id = json[i].trans_id
                                row += "<tr><td style='width:50%;'>" + json[i].clearance_type + "</td><td style='width:30%;'>" + json[i].request_status + "</td><td style='width:10%;'><button type = 'button' class = 'download btn btn-space bg-black waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Download Document' value='"+json[i].request_id+"'><i class='material-icons'>file_download</i></button></td></tr>";
                                if(i==json.length-1){
                                    return_data.push({
                                        'ID' : json[i].trans_id,
                                        'Name' : json[i].name,
                                        'RDate' : json[i].trans_date,
                                        'Type': "<table class='table-bordered table-hover table-condensed table-striped' width='100%;'>"+row+"</table>"
                                        });
                                }
                            }
                            else if(i==json.length-1){
                                console.log(json.length-1);
                                    if(id!=json[i].trans_id){
                                        return_data.push({
                                        'ID' : json[i-1].trans_id,
                                        'Name' : json[i-1].name,
                                        'RDate' : json[i-1].trans_date,
                                        'Type': "<table class='table-bordered table-hover table-condensed table-striped' width='100%;'>"+row+"</table>"
                                        });
                                        console.log("he");
                                        id = json[i].trans_id;
                                        row="";
                                        row +=  "<tr><td style='width:50%;'>" + json[i].clearance_type + "</td><td style='width:30%;'>" + json[i].request_status + "</td><td style='width:10%;'><button type = 'button' class = 'download btn btn-space bg-black waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Download Document' value='"+json[i].request_id+"'><i class='material-icons'>file_download</i></button></td></tr>";
                                        return_data.push({
                                        'ID' : json[i].trans_id,
                                        'Name' : json[i].name,
                                        'RDate' : json[i].trans_date,
                                        'Type': "<table class='table-bordered table-hover table-condensed table-striped' width='100%;'>"+row+"</table>"
                                        });
                                    }
                                    else{
                                        id = json[i].trans_id;
                                        row +=  "<tr><td style='width:50%;'>" + json[i].clearance_type + "</td><td style='width:30%;'>" + json[i].request_status + "</td><td style='width:10%;'><button type = 'button' class = 'download btn btn-space bg-black waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Download Document' value='"+json[i].request_id+"'><i class='material-icons'>file_download</i></button></td></tr>";
                                        return_data.push({
                                        'ID' : json[i].trans_id,
                                        'Name' : json[i].name,
                                        'RDate' : json[i].trans_date,
                                        'Type': "<table class='table-bordered table-hover table-condensed table-striped' width='100%;'>"+row+"</table>"
                                        });
                                    }
                                }
                            else{
                                if(id!=json[i].trans_id){
                                    return_data.push({
                                        'ID' : json[i-1].trans_id,
                                        'Name' : json[i-1].name,
                                        'RDate' : json[i-1].trans_date,
                                        'Type': "<table class='table-bordered table-hover table-condensed table-striped' width='100%;'>"+row+"</table>"
                                    });
                                    id = json[i].trans_id;
                                    row =  "<tr><td style='width:50%;'>" + json[i].clearance_type + "</td><td style='width:30%;'>" + json[i].request_status + "</td><td style='width:10%;'><button type = 'button' class = 'download btn btn-space bg-black waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Download Document' value='"+json[i].request_id+"'><i class='material-icons'>file_download</i></button></td></tr>";
                                }
                                else{
                                    row += "<tr><td style='width:50%;'>   " + json[i].clearance_type + "</td><td style='width:30%;'>" + json[i].request_status + "</td><td style='width:10%;'><button type = 'button' class = 'download btn btn-space bg-black waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Download Document' value='"+json[i].request_id+"'><i class='material-icons'>file_download</i></button></td></tr>";
                                }
                                if(i==json.length-1){
                                    return_data.push({
                                        'ID' : json[i].trans_id,
                                        'Name' : json[i].name,
                                        'RDate' : json[i].trans_date,
                                        'Type': "<table class='table-bordered table-hover table-condensed table-striped' width='100%;'>"+row+"</table>"
                                        });
                                }
                                   
                            }
                        }
                          
                    return return_data;
                }
            },
            'columns': [
                {'data' : 'ID'},
                {'data' : 'Name'},
                {'data' : 'RDate'},
                {'data' : 'Type'}            ]

        });

        var requestid = null;
        $('#releaseTable tbody').on('click', 'button.download', function(){
            var id = $(this).val();
            requestid = id;
            $.ajax({
                url: '/clearance/release/check/'+$(this).val(),
                method: 'GET',
                success: function(response){
                    table.ajax.reload();
                    if(response[0]==null){

                        window.open(window.location.href+"/"+id);
                        return false;
                    }
                    else{
                         $('#reqcont').empty();
                        console.log(response);
                        for(var i=0;i< response.length;i++){
                            $('#reqcont').append('<input type="checkbox" class="req" value="'+id+','+response[i].requirement_id+'" id="'+id+','+response[i].requirement_id+'" class="cbreq"/><label for="'+id+','+response[i].requirement_id+'">'+response[i].requirement_name+'</label><br>');
                        }
                        $('#reqmodal').modal('toggle');
                    }
                }
            });
            
        });

        var sr = [];

        $('#reqproc').on('click', function(){
            $('#reqmodal').modal('toggle');

            var sThisVal = "";
            $('input:checkbox.req').each(function () {
                if($(this).is(":Checked")){
                    sr.push((($(this).val()).replace(',','|'))+"|1");
                }
                else{
                    sr.push((($(this).val()).replace(',','|'))+"|0");
                }
                
            });

            console.log(sr);
            $.ajax({
                url : '/clearance/release/req',
                method: 'POST',
                data: {
                    _token : csrf_token,
                    sr : sr,
                    id : requestid
                },
                success: function(response){
                    table.ajax.reload();
                    if(response=="success"){
                        window.open(window.location.href+"/"+requestid);
                        return false;
                    }
                    else{
                        
                        swal({
                                title : "Failed!", 
                                text : "Please complete all requirements needed",
                                type :  "error",
                                showConfirmButton : true
                            });
                    }
                }
            });
        });

    });
</script>
</body>
</html>