<!DOCTYPE html>
<html>
<head>
	<title>Reports | Clearance</title>
	@include('admin.layout.head');
	<link href="{{asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
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
                        <div class="body ">
                        <div class="row-clearfix">
                        	<div class="col-sm-12">
                                <div class="col-sm-2 col-sm-offset-8">
                        		    <label class="pull-right">Type of Report</label>
                        	   </div>
                               <div class="col-sm-2">
                                <select id="selecttype">
                                            <option value="1">Daily</option>
                                            <option value="2">Weekly</option>
                                            <option value="3">Monthly</option>
                                            <option value="4">Annually</option>
                                  </select>
                               </div>
                            </div>
                            <div class="col-sm-12" id="weekly" style="display:none;">
                                
                                <div class="col-sm-2 col-sm-offset-8">
                                    <label class="pull-right">Date: </label>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="weeklydate" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-sm-12" id="daily">
                                
                                <div class="col-sm-2 col-sm-offset-8">
                                    <label class="pull-right">Date: </label>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="dailydate" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-sm-12" id="monthly" style="display:none;">
                                
                                <div class="col-sm-2 col-sm-offset-8">
                                    <label class="pull-right">Month: </label>
                                </div>
                                <div class="col-sm-2">
                                    <select id='monthlymonth'>
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                  </select>
                                </div><br>
                                <br>
                                <div class="col-sm-2 col-sm-offset-8">
                                    <label class="pull-right">Year</label>
                                </div>
                                <div class="col-sm-2">
                                    <select id="monthlyyear">
                                        @foreach($years as $year)
                                            <option value="{{$year->yeardate}}">{{$year->yeardate}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                            </div>
                            <div class="col-sm-12" id="yearly" style="display:none;">
                                
                                <div class="col-sm-2 col-sm-offset-8">
                                    <label class="pull-right">Year</label>
                                </div>
                                <div class="col-sm-2">
                                    <select id="yearlyyear">
                                        @foreach($years as $year)
                                            <option value="{{$year->yeardate}}">{{$year->yeardate}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                            </div>
                            
                            <div class='col-sm-12'>
                                
                                <div class="col-sm-2 col-sm-offset-10">
                                    <button type="submit" id="generate" class="pull-right btn btn-space waves-effect bg-teal">Generate</button>
                                </div>
                                <br><br>
                            </div>
                        </div>
                        <div class="row clearfix" id="reportdiv" style="display:none;">
                            <div class="col-sm-8 col-sm-offset-2">
                                <canvas id="chart" width="75%;" height="30%;"></canvas>
                            </div>
                        <br>
                        <div class="col-sm-12">
                            <table class="table dataTable" id="reportTable">
                                <thead>
                                    <tr class="bg-blue-grey">
                                    	<th>Date</th>
                                        <th>Clearance Type</th>
                                        <th>Resident Name</th>
                                        <th>Status</th>
                                        <<th>Amount</th>>
                                    </tr>
                                </thead>
                               
                            </table>
                        </div>
                        </div>
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
<script src="{{asset('plugins/chartjs/Chart.js')}}"></script>
<script src="{{asset('plugins/chartjs/Chart.bundle.js')}}"></script>


    
    <script>
    	$(document).ready(function(){

            var csrf_token = $('meta[name="csrf-token"]').attr('content');

             $('#weeklydate').daterangepicker({
                showDropdowns: true,
                timePicker: false,
                locale: {
                    format: 'YYYY-MM-DD'
                },
                maxDate: moment()
        });

             $('#dailydate').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                timePicker: false,
                locale: {
                    format: 'YYYY-MM-DD'
                },
                maxDate: moment()
        });


            $('#selecttype').change(function(){
                var value =  $('#selecttype').val();

                $('#daily').hide();
                $('#monthly').hide();
                $('#weekly').hide();
                $('#yearly').hide();
                if(value==1){
                    $('#daily').show();

                }
                else if(value==2){
                    $('#weekly').show();
                }
                else if(value==3){
                    $('#monthly').show();
                }
                else{
                    $('#yearly').show();
                }
            });

    		$('#reportTable').DataTable({
    			bSort : false,
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

            $('#generate').on('click', function(){
                $('#reportdiv').show();
                var selecteddate = $('#dailydate').val();
                $.ajax({
                    url : "/reports_clearance/daily",
                    method: "POST",
                    data:{
                        _token : csrf_token,
                        date : $('#dailydate').val()
                    },
                    dataType: 'json',
                    success: function(response){
                        var unpaid = [];
                        var forrelease = [];
                        var released = [];
                        var clearances = [];
                        for (var i = 0; i < response.chartdata.length; i++) {
                            if(jQuery.inArray(response.chartdata[i].clearance_name, clearances)==-1){
                                clearances.push(response.chartdata[i].clearance_name);
                                if(response.chartdata[i].hours=="Released"){
                                released.push(response.chartdata[i].shit);
                                forrelease.push(0);
                                unpaid.push(0);
                                console.log("Released");
                            }
                            else if(response.chartdata[i].hours=="For Release"){
                                forrelease.push(response.chartdata[i].shit);
                                released.push(0);
                                unpaid.push(0);
                                console.log("For Released");
                            }
                            else{
                                unpaid.push(response.chartdata[i].shit);
                                released.push(0);
                                forrelease.push(0);
                                console.log("Unpaid");
                                }
                            }
                            else{
                                var enumber = jQuery.inArray(response.chartdata[i].clearance_name, clearances);

                                if(response.chartdata[i].hours=="Released"){
                                    released[enumber] = response.chartdata[i].shit;
                                }
                                else if(response.chartdata[i].hours=="For Release"){
                                    forrelease[enumber] = response.chartdata[i].shit;
                                }
                                else{
                                    unpaid[enumber] = response.chartdata[i].shit;
                                }
                            }
                            
                            console.log(released);
                            console.log(forrelease);
                            console.log(unpaid);
                        }

                        var chartdata = {
                            labels : clearances,
                            datasets : [
                                {   
                                    label: 'Released',
                                    borderWith: 1,
                                    backgroundColor : "rgba(197,225,165 ,1)",
                                    borderColor : "rgba(85,139,47 ,1)",
                                    data: released
                                },
                                {
                                    label: 'For Release',
                                    borderWith: 1,
                                    backgroundColor : "rgba(129,212,250 ,1)",
                                    borderColor : "rgba(2,119,189 ,1)",
                                    data: forrelease
                                },
                                {
                                    label: 'Unpaid',
                                    borderWith: 1,
                                    backgroundColor : "rgba(244,143,177 ,1)",
                                    borderColor : "rgba(173,20,87 ,1)",
                                    data: unpaid
                                }
                            ]
                        };
                        var options = {
                            title :{
                                display: true,
                                position: "top",
                                text : 'Clearance Status for '+ selecteddate,
                                fontSize : 16,
                                fontColor: '#00796B'
                            },
                            legend: {
                                display: true,
                                position: "bottom",
                            },
                            scales :{
                                yAxes : [{
                                    ticks: {
                                        min: 0
                                    }
                                }]
                            }
                        };

                        var ctx = document.getElementById("chart").getContext('2d');
                        var myChart = new Chart(ctx, {
                            type : 'bar',
                            data : chartdata,
                            options: options
                        });

                        for (var i = 0; i < response.tabledata.length; i++) {
                            
                        }
                    }
                });
                
            });
    	});
    </script>
</body>
</html>
