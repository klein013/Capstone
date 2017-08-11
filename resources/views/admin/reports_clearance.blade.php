<!DOCTYPE html>
<html>
<head>
	<title>Reports | Clearance</title>
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
	<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-teal">
                        <div class="icon">
                            <i class="material-icons">assessment</i>
                        </div>
                        <div class="content">
                            <div class="text"><h3>REPORTS</h3></div>
                        </div>
                    </div>
                </div>


            </div>
            </div>
            <div class="card">
            <!-- Basic Table -->
            <div class="row clearfix">
            
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="header text-center">
                            <h3>CLEARANCE REPORT</h3>
                        </div>
                        <br>
                        <!--<div class="row-clearfix">
                        	<div class="col-md-4 col-md-offset-9">
                        		<label>Type of Report</label>
                        		<select>
                        			<option value="1">Daily</option>
                        			<option value="2">Weekly</option>
                        			<option value="3">Monthly</option>
                        			<option value="4">Quarterly</option>
                        			<option value="5">Annually</option>
                        		</select>
                        	</div>
                        </div>-->
                        <div class="body table-responsive">
                            <table class="table table-dataTable js-exportable" id="reportTable">
                                <thead>
                                    <tr class="bg-blue-grey">
                                    	<th>Date</th>
                                        <th>Clearance Type</th>
                                        <th>Resident Name</th>
                                        <th>Purpose</th>
                                        <!--<th>Amount</th>-->
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

@include('admin.layout.scripts');
<script src="{{asset('plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>


    
    <script>
    	$(document).ready(function(){

    		$('#reportTable').dataTable({
    			bSort : false,
                dom: 'Bfrtip',
                buttons: [
                    'pdf'
                ],  
                "ajax" : {
                "url": "/reports_clearance/get",
                "dataSrc" : ""
                },
                "columns": [
                    { "data": "ClearanceReq_Date" },
                    { "data": "Clearance_Type"},
                    { "data": "Name" },
                    { "data": "ClearanceReq_Purpose" }
                ]
            });
    	});
    </script>
</body>
</html>