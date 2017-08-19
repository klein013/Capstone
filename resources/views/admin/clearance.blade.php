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
                            <table class="table dataTable" width="100%" id="requestTable">
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
                <div class="modal-dialog modal-lg" role="document">
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
                        </div>
                        <div class="modal-body">
                        <form id="reqID">
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                <label for="clearance_id">Clearance Type</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <select class="form-control show-tick" multiple id="ctype" name="ctype">
                                        <option value="" disabled>Pick a Clearance Type</option>
                                        @foreach($clearances as $clearance)
                                            <option value="{{ $clearance->clearance_id }}">{{ $clearance->clearance_type }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                <label>Purpose</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="purpose" name="purpose" class="form-control">
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-9">
                                <label>Resident ID</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="resID" name="resID" class="form-control">
                                    </div>
                                </div>
                                </div>
                                <div class="col-sm-3">
                                <label class="pull-right" >Choose from Table</label>
                                <div class="form-group">
                                <button type="button" class="btn bg-teal btn-lg waves-effect pull-right" id="choose">Show Table</button>
                                </div>
                                </div>
                            </div>
                            <div class="row clearfix" id="lol" style="display:none;">
                                <div class="body table-responsive">
                                    <table class="table dataTable" width="100%" id="residentTable">
                                        <thead>
                                            <tr class="bg-blue-grey">
                                                <th>ID</th>
                                                <th>Resident Name</th>
                                                <th>Birthdate</th>
                                                <th>Address</th>
                                                <th>Contact Number</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>
                        <div class="row clearfix">    
                            <div class="col-sm-4 col-sm-offset-8">
                            <button type="submit" class="btn bg-teal btn-lg waves-effect" id="add">PROCESS REQUEST</button>
                            <button type="button" class="btn bg-teal btn-lg waves-effect pull-right" data-dismiss="modal">CANCEL</button>
                            </div>
                        </div>
                        
                        </form>
                        </div>
                        
                    </div>
                </div>
            </div>

   

@include('admin.layout.scripts');
<script>
	$(document).ready(function(){

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        var id= {{$return['official']}};

        // var requestTable = $('#requestTable').DataTable({
        //     "bSort": false,
        //     "ajax": {

        //     },
        //     "columns": {
        //         {"data" : "ID"},
        //         {"data" : "Name"},
        //         {"data" : "Type"},
        //         {"data" : "Purpose"},
        //         {"data" : "Status"},
        //         {"data" : "Actions"}
        //     }
        // });

        var residentTable = $('#residentTable').DataTable({
            "bSort": false,
            "ajax": {
                "url" : "/clearance/getResidents/"+id,
                "method": "GET",
                "data" : "json",
                "dataSrc": function (json) {
                        var return_data = new Array();
                        for(var i=0;i< json.length; i++){
                            return_data.push({
                            'ID' : json[i].resident_id,
                            'Name' : json[i].name,
                            'Bdate' : json[i].resident_bdate,
                            'Address': json[i].address,
                            'Contact': json[i].contact
                            });
                        }     
                        return return_data;
                    }
            },
            "columns" : [
                {"data" : "ID"},
                {"data" : "Name"},
                {"data" : "Bdate"},
                {"data" : "Address"},
                {"data" : "Contact"}
            ]
        });

        $('#choose').on('click', function(){
            $('#lol').toggle();
        });

        $('#residentTable tbody').on('dblclick', 'tr', function () {
            var data = residentTable.row( this ).data();
            $('#resID').val(data['ID']);
        } );

        $('#reqID').validate({
            rules: {
                ctype: {
                    required: true
                },
                purpose:{
                    required: true,
                    maxlength: 30,
                },
                resID:{
                    required: true
                }
            },
            submitHandler: function(form){
                $.ajax({
                    url: '/clearance/storeClearance',
                    method: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        resID: $('#resID').val(),
                        ctype: $('#ctype').val(),
                        purpose: $('#purpose').val()
                    },
                    success: function(response){
                        // if($req->request_id!=""){

                        // }
                        // else{

                        // }
                    }
                });
            }
        })
	});
</script>
	<script src="{{asset('plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
   	<script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
</body>
</html>