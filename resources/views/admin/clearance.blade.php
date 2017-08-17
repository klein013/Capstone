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
                            <div class="text"><h3> REQUEST</h3></div>
                        </div>
                    </div>
                </div>


            </div>
            </div>
            <!-- Basic Table -->
            <div class="row clearfix">
                                    <div class="col-lg-offset-11 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <a href="javascript:void(0)" data-toggle="tooltip" title="Add Request"><button type="button" class="btn bg-teal btn-circle-lg waves-effect waves-circle waves-float" data-toggle="modal" data-target="#defaultModal"><i class="material-icons">add</i></button></a>
                                    </div>
                                </div>
                                <br>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                	<div class="card">
                        <div class="body table-responsive">
                            <table class="table dataTable" id="requestTable">
                                <thead>
                                    <tr class="bg-blue-grey">
                                        <th>ID</th>
                                        <th>Resident Name</th>
                                        <th>Type</th>
                                        <th>Purpose</th>
                                        <th>Status</th>
                                        <th>Actions</th>
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
                            <div class="col-lg-7 col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box bg-teal">
                            <div class="icon">
                                <i class="material-icons">border_color</i>
                            </div>
                            <div class="content">
                            <div class="text"><h3> ADD REQUEST</h3></div>
                            </div>
                    </div>
                </div>
                        </div>
                        <div class="modal-body">
                            <div class="row clearfix">
                                <label for="clearance_id">Clearance Type</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <select class="form-control show-tick" id="ctype">
                                    	<option value="" disabled>Pick a Clearance Type</option>
                                    	@foreach($clearances as $clearance)
                                    		<option value="{{ $clearance->clearance_id }}">{{ $clearance->clearance_type }}</option>
                                    	@endforeach
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <label>Purpose</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="purpose" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <label>Resident ID</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="resID" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="body table-responsive">
                                    <table class="table dataTable" id="residentTable">
                                        <thead>
                                            <tr class="bg-blue-grey">
                                                <th>ID</th>
                                                <th>Resident Name</th>
                                                <th>Address</th>
                                                <th>Contact Number</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        <div class="row clearfix">    
                            <div class="col-md-4 col-md-offset-8">
                            <button type="button" class="btn bg-teal btn-lg waves-effect" id="add">ADD</button>
                            <button type="button" class="btn bg-teal btn-lg waves-effect" data-dismiss="modal">CANCEL</button>
                            </div>
                        </div>
                        <br>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

@include('admin.layout.scripts');
<script>
	$(document).ready(function(){

        var residentTable = $('#residentTable').DataTable({
            "bSort": false,
            "ajax": {
                "url" : "/getResidents/"+,
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
	});
</script>
	<script src="{{asset('plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
   	<script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
</body>
</html>