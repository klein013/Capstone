<!DOCTYPE html>
<html>
<head>
	<title>Reports | Incidents</title>
	@include('admin.layout.head');
	<link href="{{asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
</head>
<body class="theme-blue-grey">
@include('admin.layout.nav');
@include('admin.layout.aside');
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
                            <h3>INCIDENT REPORT</h3>
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
                                    	<th>Date and Time</th>
                                    	<th>Place</th>
                                    	<th>Description</th>
                                        <th>Status</th>
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
                "url": "/reports_incident/get",
                "dataSrc" : ""
                },
                "columns": [
                    { "data": "Incident_Datetime" },
                    { "data": "Place"},
                    { "data": "Incident_Statement" },
                    { "data": "Incident_Status" }
                ]
    		});
    	});
    </script>
</body>
</html>