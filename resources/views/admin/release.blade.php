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
                        <div class="body table-responsive">
                            <table class="table dataTable" width="100%" id="releaseTable">
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
    </section>
   

@include('admin.layout.scripts');
<script src="{{asset('plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
<script>
    $(document).ready(function(){
        var csrf_token = $('meta[name="csrf-token"]').attr('content');

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
                                row += "<tr><td>" + json[i].clearance_type + "</td><td>" + json[i].request_status + "</td><td><button type = 'button' class = 'download btn btn-space bg-black waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Download Document' value='"+json[i].request_id+"'><i class='material-icons'>file_download</i></button></td></tr>";
                                if(i==json.length-1){
                                    return_data.push({
                                        'ID' : json[i].trans_id,
                                        'Name' : json[i].name,
                                        'RDate' : json[i].trans_date,
                                        'Type': "<table width='100%;'>"+row+"</table>"
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
                                        'Type': "<table width='100%;'>"+row+"</table>"
                                        });
                                        console.log("he");
                                        id = json[i].trans_id;
                                        row="";
                                        row +=  "<tr><td>" + json[i].clearance_type + "</td><td>" + json[i].request_status + "</td><td><button type = 'button' class = 'download btn btn-space bg-black waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Download Document' value='"+json[i].request_id+"'><i class='material-icons'>file_download</i></button></td></tr>";
                                        return_data.push({
                                        'ID' : json[i].trans_id,
                                        'Name' : json[i].name,
                                        'RDate' : json[i].trans_date,
                                        'Type': "<table width='100%;'>"+row+"</table>"
                                        });
                                    }
                                    else{
                                        id = json[i].trans_id;
                                        row +=  "<tr><td>" + json[i].clearance_type + "</td><td>" + json[i].request_status + "</td><td><button type = 'button' class = 'download btn btn-space bg-black waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Download Document' value='"+json[i].request_id+"'><i class='material-icons'>file_download</i></button></td></tr>";
                                        return_data.push({
                                        'ID' : json[i].trans_id,
                                        'Name' : json[i].name,
                                        'RDate' : json[i].trans_date,
                                        'Type': "<table width='100%;'>"+row+"</table>"
                                        });
                                    }
                                }
                            else{
                                if(id!=json[i].trans_id){
                                    return_data.push({
                                        'ID' : json[i-1].trans_id,
                                        'Name' : json[i-1].name,
                                        'RDate' : json[i-1].trans_date,
                                        'Type': "<table width='100%;'>"+row+"</table>"
                                    });
                                    id = json[i].trans_id;
                                    row =  "<tr><td>" + json[i].clearance_type + "</td><td>" + json[i].request_status + "</td><td><button type = 'button' class = 'download btn btn-space bg-black waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Download Document' value='"+json[i].request_id+"'><i class='material-icons'>file_download</i></button></td></tr>";
                                }
                                else{
                                    row += "<tr><td>   " + json[i].clearance_type + "</td><td>" + json[i].request_status + "</td><td><button type = 'button' class = 'download btn btn-space bg-black waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Download Document' value='"+json[i].request_id+"'><i class='material-icons'>file_download</i></button></td></tr>";
                                }
                                if(i==json.length-1){
                                    return_data.push({
                                        'ID' : json[i].trans_id,
                                        'Name' : json[i].name,
                                        'RDate' : json[i].trans_date,
                                        'Type': "<table width='100%;'>"+row+"</table>"
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

        $('#releaseTable tbody').on('click', 'button.download', function(){
            window.open(window.location.href+"/"+$(this).val(),'_blank');
            return false;
        });

    });
</script>
</body>
</html>