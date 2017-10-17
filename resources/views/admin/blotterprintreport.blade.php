<!DOCTYPE html>
<html>
<head>
    <title>Reports | Barangay Blotter</title>
    @include('admin.layout.head')
    <link href="{{asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
</head>
<body class="theme-blue-grey">
    <br>
    <div class="container" style="width:100%">
        <div class="card">
            <div class="header text-center">
                            <h3>BLOTTER CASE REPORT</h3>
                        </div>
                        <div class="body ">
                        <div class="row-clearfix" id="tohide">
                            <div class="col-sm-12">
                                <div class="col-sm-2 col-sm-offset-8">
                                    <label class="pull-right">Type of Report</label>
                               </div>
                               <div class="col-sm-2">
                                <select id="selecttype">
                                            <option value="1">Daily</option>
                                            <option value="2">Interval</option>
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
                                    <button type="submit" id="generate" class=" btn btn-space waves-effect bg-teal">Generate</button>
                                    <button type="button" id="back" class="btn btn-space waves-effect bg-teal">Back</button>
                                </div>
                                <br><br>
                            </div>
                        </div>
                        <div class="row clearfix" id="nonsense"></div>
                    <div class="row clearfix" style="display:none;" id="todisplay">
                 <div class="col-sm-12" >
                            <div class="col-sm-6 col-sm-offset-3">
                                <canvas id="chart" width="100%" height="100%"></canvas>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <table class="table table-bordered table-condensed" id="reportTable">
                                <thead>
                                    <tr class="bg-blue-grey">
                                        <th>Case Number</th>
                                        <th>Case Name</th>
                                        <th>Date Filed</th>
                                        <th>Complainants</th>
                                        <th>Respondents</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                               <tbody id="reportTablebody">
                               </tbody>
                            </table>
                        </div>
            </div>
        </div>
    </div>
</div>
@include('admin.layout.scripts')
<script src="{{asset('plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
<script src="{{asset('plugins/chartjs/Chart.js')}}"></script>
<script src="{{asset('plugins/chartjs/Chart.bundle.js')}}"></script>


    
    <script>
        $(document).ready(function(){

            var beforePrint = function() {
                $('#tohide').hide();
            };
            var afterPrint = function() {
                $('#tohide').show();
            };

            $('#back').on('click', function(){
                window.history.back()       ;
            });

            if (window.matchMedia) {
                var mediaQueryList = window.matchMedia('print');
                mediaQueryList.addListener(function(mql) {
                    if (mql.matches) {
                        beforePrint();
                    } else {
                        afterPrint();
                    }
                });
            }

            window.onbeforeprint = beforePrint;
            window.onafterprint = afterPrint;

            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            
            

            $('#weeklydate').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    format: 'YYYY-MM-DD'
                },
                maxDate: moment()
            });

            $('#weeklydate').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + '|' + picker.endDate.format('YYYY-MM-DD'));
            
            
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

                var value =  "1";

            $('#selecttype').change(function(){

                value = $('#selecttype').val();

                $('#daily').hide();
                $('#monthly').hide();
                $('#weekly').hide();
                $('#yearly').hide();
                if(value=="1"){
                    $('#daily').show();

                }
                else if(value=="2"){
                    $('#weekly').show();
                }
                else if(value=="3"){
                    $('#monthly').show();
                }
                else{
                    $('#yearly').show();
                }
            });

           
            $('#generate').on('click', function(){
                $('#reportdiv').show();
                $('#todisplay').show();
                $('#nonsense').hide();
                $('#reportTablebody').empty();
                if(value=="1"){
                var selecteddate = $('#dailydate').val();
                $.ajax({
                    url : "/reports_blotter/daily",
                    method: "POST",
                    data:{
                        _token : csrf_token,
                        date : $('#dailydate').val()
                    },
                    dataType: 'json',
                    success: function(response){
                        var unassigned = [];
                        var settled = [];
                        var mediation = [];
                        var conciliation = [];
                        var arbitration = [];
                        var vawc = [];
                        var ps6 = [];
                        var record = [];
                        var caseskp = [];
                        for (var i = 0; i < response.chartdata.length; i++) {
                            if(jQuery.inArray(response.chartdata[i].caseskp_name, caseskp)==-1){
                                caseskp.push(response.chartdata[i].caseskp_name);

                                if(response.chartdata[i].case_status=="Captain"||response.chartdata[i].case_status=="Pangkat"){
                                unassigned.push(response.chartdata[i].shit);
                                settled.push(0);
                                mediation.push(0);
                                arbitration.push(0);
                                conciliation.push(0);
                                mediation.push(0);
                                vawc.push(0);
                                ps6.push(0);
                                record.push(0);
                                console.log("Released");
                            }
                            else if(response.chartdata[i].case_status=="Settled"){
                                unassigned.push(0);
                                settled.push(response.chartdata[i].shit);
                                mediation.push(0);
                                arbitration.push(0);
                                conciliation.push(0);
                                mediation.push(0);
                                vawc.push(0);
                                ps6.push(0);
                                record.push(0);
                            }
                            else if(response.chartdata[i].case_status=="Mediation"){
                                unassigned.push(0);
                                settled.push(0);
                                mediation.push(response.chartdata[i].shit);
                                arbitration.push(0);
                                conciliation.push(0);
                                mediation.push(0);
                                vawc.push(0);
                                ps6.push(0);
                                record.push(0);
                            }
                            else if(response.chartdata[i].case_status=="Conciliation"){
                                unassigned.push(0);
                                settled.push(0);
                                mediation.push(0);
                                arbitration.push(0);
                                conciliation.push(response.chartdata[i].shit);
                                mediation.push(0);
                                vawc.push(0);
                                ps6.push(0);
                                record.push(0);
                            }
                            else if(response.chartdata[i].case_status=="Arbitration"){
                                unassigned.push(0);
                                settled.push(0);
                                mediation.push(0);
                                arbitration.push(response.chartdata[i].shit);
                                conciliation.push(0);
                                mediation.push(0);
                                vawc.push(0);
                                ps6.push(0);
                                record.push(0);
                            }
                            else if(response.chartdata[i].case_status=="Violence Against Women and Children"){
                                unassigned.push(0);
                                settled.push(0);
                                mediation.push(0);
                                arbitration.push(0);
                                conciliation.push(0);
                                mediation.push(0);
                                vawc.push(response.chartdata[i].shit);
                                ps6.push(0);
                                record.push(0);
                            }
                            else if(response.chartdata[i].case_status=="Police Station"){
                                unassigned.push(0);
                                settled.push(0);
                                mediation.push(0);
                                arbitration.push(0);
                                conciliation.push(0);
                                mediation.push(0);
                                vawc.push(0);
                                ps6.push(response.chartdata[i].shit);
                                record.push(0);
                            }
                            else{
                                unassigned.push(0);
                                settled.push(0);
                                mediation.push(0);
                                arbitration.push(0);
                                conciliation.push(0);
                                mediation.push(0);
                                vawc.push(0);
                                ps6.push(0);
                                record.push(response.chartdata[i].shit);
                            }
                                
                        }
                            else{
                                var enumber = jQuery.inArray(response.chartdata[i].caseskp_name, caseskp);
                                if(response.chartdata[i].case_status=="Captain"||response.chartdata[i].case_status=="Pangkat"){
                                unassigned[enumber] = response.chartdata[i].shit;
                            }
                            else if(response.chartdata[i].case_status=="Settled"){
                                settled[enumber] = response.chartdata[i].shit;
                            }
                            else if(response.chartdata[i].case_status=="Mediation"){
                                mediation[enumber] = response.chartdata[i].shit;
                            }
                            else if(response.chartdata[i].case_status=="Conciliation"){
                                conciliation[enumber] = response.chartdata[i].shit;
                            }
                            else if(response.chartdata[i].case_status=="Arbitration"){
                                arbitration[enumber] = response.chartdata[i].shit;
                            }
                            else if(response.chartdata[i].case_status=="Violence Against Women and Children"){
                                vawc[enumber] = response.chartdata[i].shit;
                            }
                            else if(response.chartdata[i].case_status=="Police Station"){
                                ps6[enumber] = response.chartdata[i].shit;
                            }
                            else{
                                record[enumber] = response.chartdata[i].shit;
                            }
                            
                        }
                        }
                        var chartdata = {
                            labels : caseskp,
                            datasets : [
                                {   
                                    label: 'Unassigned',
                                    borderWith: 1,
                                    backgroundColor : "rgba(197,225,165 ,1)",
                                    borderColor : "rgba(85,139,47 ,1)",
                                    data: unassigned
                                },
                                      {
                                    label: 'Mediation',
                                    borderWith: 1,
                                    backgroundColor : "rgba(129,212,250 ,1)",
                                    borderColor : "rgba(2,119,189 ,1)",
                                    data: mediation
                                },
                                {
                                    label: 'Conciliation',
                                    borderWith: 1,
                                    backgroundColor : "rgba(244,143,177 ,1)",
                                    borderColor : "rgba(173,20,87 ,1)",
                                    data: conciliation
                                },
                                {
                                    label: 'Arbitration',
                                    borderWith: 1,
                                    backgroundColor : "rgba(158,157,36 ,1)",
                                    borderColor : "rgba(230,238,156 ,1)",
                                    data: arbitration
                                },
                                {
                                    label: 'Settled',
                                    borderWith: 1,
                                    backgroundColor : "rgba(255,204,128 ,1)",
                                    borderColor : "rgba(239,108,0 ,1)",
                                    data: settled
                                },
                                {
                                    label: 'Record',
                                    borderWith: 1,
                                    backgroundColor : "rgba(255,171,145 ,1))",
                                    borderColor : "rgba(216,67,21 ,1)",
                                    data: record
                                },
                                {
                                    label: 'Violence Against Women and Children',
                                    borderWith: 1,
                                    backgroundColor : "rgba(179,157,219 ,1)",
                                    borderColor : "rgba(69,39,160 ,1)",
                                    data: vawc
                                },
                                {
                                    label: 'Police Station',
                                    borderWith: 1,
                                    backgroundColor : "rgba(159,168,218 ,1)",
                                    borderColor : "rgba(40,53,147 ,1)",
                                    data: ps6
                                }
                            ]
                        };
                        var options = {
                            title :{
                                display: true,
                                position: "top",
                                text : 'Blotter Case Status Report for '+ selecteddate,
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

                        var unassigned = 0;
                        var mediation = 0;
                        var conciliation = 0;
                        var arbitration = 0 ;
                        var record = 0;
                        var ps6 = 0;
                        var settled = 0;
                        var vawc = 0;
                        for (var i = 0; i < response.tabledata.length; i++) {
                            var comp = "";
                            var res = "";
                            for (var k = 0; k < response.resident.length; k++) {
                                if(response.resident[k].personinvolve_case = response.tabledata[i].case_id){
                                    if(response.resident[k].personinvolve_type=='C'){
                                        comp+= response.resident[k].name+"<br>";
                                    }
                                    else{
                                        res+= response.resident[k].name+"<br>";
                                    }
                                }

                            }
                            if((response.tabledata[i].case_status=="Captain")||(response.tabledata[i].case_status=="Pangkat")){
                                    unassigned+=1;
                                }
                                else if(response.tabledata[i].case_status=="Mediation"){
                                    mediation+=1;
                                }
                                else if(response.tabledata[i].case_status=="Conciliation"){
                                    conciliation+=1;
                                }
                                else if(response.tabledata[i].case_status=="Arbitration"){
                                    arbitration+=1;
                                }
                                else if(response.tabledata[i].case_status=="Record"){
                                    record+=1;
                                }
                                else if(response.tabledata[i].case_status=="Police Station"){
                                    ps6+=1;
                                }
                                else if(response.tabledata[i].case_status=="Settled"){
                                    settled+=1;
                                }
                                else{
                                    vawc+=1;
                                }
                            var row = "<tr><td>"+response.tabledata[i].case_id+"</td><td>"+response.tabledata[i].case_name+"</td><td>"+response.tabledata[i].case_filed+"</td><td>"+comp+"</td><td>"+res+"</td><td>"+response.tabledata[i].case_status+"</td></tr>";
                            $('#reportTable').append(row);
                        }
                        var additionalrow = "<tr><td colspan='5'><strong class='pull-right'>Total Unassigned Cases: </strong></td><td>"+unassigned+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total Mediation Cases: </strong></td><td>"+mediation+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total Conciliation Cases: </strong></td><td>"+conciliation+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total Arbitration Cases: </strong></td><td>"+arbitration+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total Settled Cases: </strong></td><td>"+settled+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total Record Only Cases: </strong></td><td>"+record+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total VAWC Cases: </strong></td><td>"+vawc+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total Police Station Cases: </strong></td><td>"+ps6+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total Number of Cases: </strong></td><td>"+(arbitration+unassigned+mediation+conciliation+record+ps6+vawc+settled)+"</td></tr>";
                        $('#reportTable').append(additionalrow);
                    }
                });
                }
                else if(value=="2"){
                    var weekdate = $('#weeklydate').val();
                    var fromdate = (weekdate.split('|'))[0];
                    var todate = (weekdate.split('|'))[1];
                    $.ajax({
                    url : "/reports_blotter/weekly",
                    method: "POST",
                    data:{
                        _token : csrf_token,
                        fromdate : fromdate,
                        todate : todate
                    },
                    dataType: 'json',
                    success: function(response){
                        var unassigned = [];
                        var settled = [];
                        var mediation = [];
                        var conciliation = [];
                        var arbitration = [];
                        var vawc = [];
                        var ps6 = [];
                        var record = [];
                        var caseskp = [];
                        for (var i = 0; i < response.chartdata.length; i++) {
                            if(jQuery.inArray(response.chartdata[i].caseskp_name, caseskp)==-1){
                                caseskp.push(response.chartdata[i].caseskp_name);

                                if(response.chartdata[i].case_status=="Captain"||response.chartdata[i].case_status=="Pangkat"){
                                unassigned.push(response.chartdata[i].shit);
                                settled.push(0);
                                mediation.push(0);
                                arbitration.push(0);
                                conciliation.push(0);
                                mediation.push(0);
                                vawc.push(0);
                                ps6.push(0);
                                record.push(0);
                                console.log("Released");
                            }
                            else if(response.chartdata[i].case_status=="Settled"){
                                unassigned.push(0);
                                settled.push(response.chartdata[i].shit);
                                mediation.push(0);
                                arbitration.push(0);
                                conciliation.push(0);
                                mediation.push(0);
                                vawc.push(0);
                                ps6.push(0);
                                record.push(0);
                            }
                            else if(response.chartdata[i].case_status=="Mediation"){
                                unassigned.push(0);
                                settled.push(0);
                                mediation.push(response.chartdata[i].shit);
                                arbitration.push(0);
                                conciliation.push(0);
                                mediation.push(0);
                                vawc.push(0);
                                ps6.push(0);
                                record.push(0);
                            }
                            else if(response.chartdata[i].case_status=="Conciliation"){
                                unassigned.push(0);
                                settled.push(0);
                                mediation.push(0);
                                arbitration.push(0);
                                conciliation.push(response.chartdata[i].shit);
                                mediation.push(0);
                                vawc.push(0);
                                ps6.push(0);
                                record.push(0);
                            }
                            else if(response.chartdata[i].case_status=="Arbitration"){
                                unassigned.push(0);
                                settled.push(0);
                                mediation.push(0);
                                arbitration.push(response.chartdata[i].shit);
                                conciliation.push(0);
                                mediation.push(0);
                                vawc.push(0);
                                ps6.push(0);
                                record.push(0);
                            }
                            else if(response.chartdata[i].case_status=="Violence Against Women and Children"){
                                unassigned.push(0);
                                settled.push(0);
                                mediation.push(0);
                                arbitration.push(0);
                                conciliation.push(0);
                                mediation.push(0);
                                vawc.push(response.chartdata[i].shit);
                                ps6.push(0);
                                record.push(0);
                            }
                            else if(response.chartdata[i].case_status=="Police Station"){
                                unassigned.push(0);
                                settled.push(0);
                                mediation.push(0);
                                arbitration.push(0);
                                conciliation.push(0);
                                mediation.push(0);
                                vawc.push(0);
                                ps6.push(response.chartdata[i].shit);
                                record.push(0);
                            }
                            else{
                                unassigned.push(0);
                                settled.push(0);
                                mediation.push(0);
                                arbitration.push(0);
                                conciliation.push(0);
                                mediation.push(0);
                                vawc.push(0);
                                ps6.push(0);
                                record.push(response.chartdata[i].shit);
                            }
                                
                        }
                            else{
                                var enumber = jQuery.inArray(response.chartdata[i].caseskp_name, caseskp);
                                if(response.chartdata[i].case_status=="Captain"||response.chartdata[i].case_status=="Pangkat"){
                                unassigned[enumber] = response.chartdata[i].shit;
                            }
                            else if(response.chartdata[i].case_status=="Settled"){
                                settled[enumber] = response.chartdata[i].shit;
                            }
                            else if(response.chartdata[i].case_status=="Mediation"){
                                mediation[enumber] = response.chartdata[i].shit;
                            }
                            else if(response.chartdata[i].case_status=="Conciliation"){
                                conciliation[enumber] = response.chartdata[i].shit;
                            }
                            else if(response.chartdata[i].case_status=="Arbitration"){
                                arbitration[enumber] = response.chartdata[i].shit;
                            }
                            else if(response.chartdata[i].case_status=="Violence Against Women and Children"){
                                vawc[enumber] = response.chartdata[i].shit;
                            }
                            else if(response.chartdata[i].case_status=="Police Station"){
                                ps6[enumber] = response.chartdata[i].shit;
                            }
                            else{
                                record[enumber] = response.chartdata[i].shit;
                            }
                            
                            console.log(released);
                            console.log(forrelease);
                            console.log(unpaid);
                        }
                        }
                        var chartdata = {
                            labels : caseskp,
                            datasets : [
                                {   
                                    label: 'Unassigned',
                                    borderWith: 1,
                                    backgroundColor : "rgba(197,225,165 ,1)",
                                    borderColor : "rgba(85,139,47 ,1)",
                                    data: unassigned
                                },
                                      {
                                    label: 'Mediation',
                                    borderWith: 1,
                                    backgroundColor : "rgba(129,212,250 ,1)",
                                    borderColor : "rgba(2,119,189 ,1)",
                                    data: mediation
                                },
                                {
                                    label: 'Conciliation',
                                    borderWith: 1,
                                    backgroundColor : "rgba(244,143,177 ,1)",
                                    borderColor : "rgba(173,20,87 ,1)",
                                    data: conciliation
                                },
                                {
                                    label: 'Arbitration',
                                    borderWith: 1,
                                    backgroundColor : "rgba(158,157,36 ,1)",
                                    borderColor : "rgba(230,238,156 ,1)",
                                    data: arbitration
                                },
                                {
                                    label: 'Settled',
                                    borderWith: 1,
                                    backgroundColor : "rgba(255,204,128 ,1)",
                                    borderColor : "rgba(239,108,0 ,1)",
                                    data: settled
                                },
                                {
                                    label: 'Record',
                                    borderWith: 1,
                                    backgroundColor : "rgba(255,171,145 ,1))",
                                    borderColor : "rgba(216,67,21 ,1)",
                                    data: record
                                },
                                {
                                    label: 'Violence Against Women and Children',
                                    borderWith: 1,
                                    backgroundColor : "rgba(179,157,219 ,1)",
                                    borderColor : "rgba(69,39,160 ,1)",
                                    data: vawc
                                },
                                {
                                    label: 'Police Station',
                                    borderWith: 1,
                                    backgroundColor : "rgba(159,168,218 ,1)",
                                    borderColor : "rgba(40,53,147 ,1)",
                                    data: ps6
                                }
                            ]
                        };
                        var options = {
                            title :{
                                display: true,
                                position: "top",
                                text : 'Blotter Case Status Report between '+fromdate+' to '+todate,
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

                        var unassigned = 0;
                        var mediation = 0;
                        var conciliation = 0;
                        var arbitration = 0 ;
                        var record = 0;
                        var ps6 = 0;
                        var vawc = 0;
                        var settled = 0;
                        for (var i = 0; i < response.tabledata.length; i++) {
                            var comp = "";
                            var res = "";
                            for (var k = 0; k < response.resident.length; k++) {
                                if(response.resident[k].personinvolve_case = response.tabledata[i].case_id){
                                    if(response.resident[k].personinvolve_type=='C'){
                                        comp+= response.resident[k].name+"<br>";
                                    }
                                    else{
                                        res+= response.resident[k].name+"<br>";
                                    }
                                }

                            }
                            if((response.tabledata[i].case_status=="Captain")||(response.tabledata[i].case_status=="Pangkat")){
                                    unassigned+=1;
                                }
                                else if(response.tabledata[i].case_status=="Mediation"){
                                    mediation+=1;
                                }
                                else if(response.tabledata[i].case_status=="Conciliation"){
                                    conciliation+=1;
                                }
                                else if(response.tabledata[i].case_status=="Arbitration"){
                                    arbitration+=1;
                                }
                                else if(response.tabledata[i].case_status=="Record"){
                                    record+=1;
                                }
                                else if(response.tabledata[i].case_status=="Police Station"){
                                    ps6+=1;
                                }
                                else if(response.tabledata[i].case_status=="Settled"){
                                    settled+=1;
                                }
                                else{
                                    vawc+=1;
                                }
                            var row = "<tr><td>"+response.tabledata[i].case_id+"</td><td>"+response.tabledata[i].case_name+"</td><td>"+response.tabledata[i].case_filed+"</td><td>"+comp+"</td><td>"+res+"</td><td>"+response.tabledata[i].case_status+"</td></tr>";
                            $('#reportTable').append(row);
                        }
                        var additionalrow = "<tr><td colspan='5'><strong class='pull-right'>Total Unassigned Cases: </strong></td><td>"+unassigned+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total Mediation Cases: </strong></td><td>"+mediation+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total Conciliation Cases: </strong></td><td>"+conciliation+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total Arbitration Cases: </strong></td><td>"+arbitration+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total Settled Cases: </strong></td><td>"+settled+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total Record Only Cases: </strong></td><td>"+record+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total VAWC Cases: </strong></td><td>"+vawc+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total Police Station Cases: </strong></td><td>"+ps6+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total Number of Cases: </strong></td><td>"+(arbitration+unassigned+mediation+conciliation+record+ps6+vawc+settled)+"</td></tr>";
                        $('#reportTable').append(additionalrow);
                    }
                });
                }
                else if(value=="3"){
                    var monthlymonth = $('#monthlymonth').val();
                    var monthlyyear = $('#monthlyyear').val();
                    var monthword = $('#monthlymonth option[value="'+monthlymonth+'"]').text();
                    $.ajax({
                    url : "/reports_blotter/monthly",
                    method: "POST",
                    data:{
                        _token : csrf_token,
                        monthlymonth : monthlymonth,
                        monthlyyear : monthlyyear
                    },
                    dataType: 'json',
                    success: function(response){
                        var unassigned = [];
                        var settled = [];
                        var mediation = [];
                        var conciliation = [];
                        var arbitration = [];
                        var vawc = [];
                        var ps6 = [];
                        var record = [];
                        var caseskp = [];
                        for (var i = 0; i < response.chartdata.length; i++) {
                            if(jQuery.inArray(response.chartdata[i].caseskp_name, caseskp)==-1){
                                caseskp.push(response.chartdata[i].caseskp_name);

                                if(response.chartdata[i].case_status=="Captain"||response.chartdata[i].case_status=="Pangkat"){
                                unassigned.push(response.chartdata[i].shit);
                                settled.push(0);
                                mediation.push(0);
                                arbitration.push(0);
                                conciliation.push(0);
                                mediation.push(0);
                                vawc.push(0);
                                ps6.push(0);
                                record.push(0);
                                console.log("Released");
                            }
                            else if(response.chartdata[i].case_status=="Settled"){
                                unassigned.push(0);
                                settled.push(response.chartdata[i].shit);
                                mediation.push(0);
                                arbitration.push(0);
                                conciliation.push(0);
                                mediation.push(0);
                                vawc.push(0);
                                ps6.push(0);
                                record.push(0);
                            }
                            else if(response.chartdata[i].case_status=="Mediation"){
                                unassigned.push(0);
                                settled.push(0);
                                mediation.push(response.chartdata[i].shit);
                                arbitration.push(0);
                                conciliation.push(0);
                                mediation.push(0);
                                vawc.push(0);
                                ps6.push(0);
                                record.push(0);
                            }
                            else if(response.chartdata[i].case_status=="Conciliation"){
                                unassigned.push(0);
                                settled.push(0);
                                mediation.push(0);
                                arbitration.push(0);
                                conciliation.push(response.chartdata[i].shit);
                                mediation.push(0);
                                vawc.push(0);
                                ps6.push(0);
                                record.push(0);
                            }
                            else if(response.chartdata[i].case_status=="Arbitration"){
                                unassigned.push(0);
                                settled.push(0);
                                mediation.push(0);
                                arbitration.push(response.chartdata[i].shit);
                                conciliation.push(0);
                                mediation.push(0);
                                vawc.push(0);
                                ps6.push(0);
                                record.push(0);
                            }
                            else if(response.chartdata[i].case_status=="Violence Against Women and Children"){
                                unassigned.push(0);
                                settled.push(0);
                                mediation.push(0);
                                arbitration.push(0);
                                conciliation.push(0);
                                mediation.push(0);
                                vawc.push(response.chartdata[i].shit);
                                ps6.push(0);
                                record.push(0);
                            }
                            else if(response.chartdata[i].case_status=="Police Station"){
                                unassigned.push(0);
                                settled.push(0);
                                mediation.push(0);
                                arbitration.push(0);
                                conciliation.push(0);
                                mediation.push(0);
                                vawc.push(0);
                                ps6.push(response.chartdata[i].shit);
                                record.push(0);
                            }
                            else{
                                unassigned.push(0);
                                settled.push(0);
                                mediation.push(0);
                                arbitration.push(0);
                                conciliation.push(0);
                                mediation.push(0);
                                vawc.push(0);
                                ps6.push(0);
                                record.push(response.chartdata[i].shit);
                            }
                                
                        }
                            else{
                                var enumber = jQuery.inArray(response.chartdata[i].caseskp_name, caseskp);
                                if(response.chartdata[i].case_status=="Captain"||response.chartdata[i].case_status=="Pangkat"){
                                unassigned[enumber] = response.chartdata[i].shit;
                            }
                            else if(response.chartdata[i].case_status=="Settled"){
                                settled[enumber] = response.chartdata[i].shit;
                            }
                            else if(response.chartdata[i].case_status=="Mediation"){
                                mediation[enumber] = response.chartdata[i].shit;
                            }
                            else if(response.chartdata[i].case_status=="Conciliation"){
                                conciliation[enumber] = response.chartdata[i].shit;
                            }
                            else if(response.chartdata[i].case_status=="Arbitration"){
                                arbitration[enumber] = response.chartdata[i].shit;
                            }
                            else if(response.chartdata[i].case_status=="Violence Against Women and Children"){
                                vawc[enumber] = response.chartdata[i].shit;
                            }
                            else if(response.chartdata[i].case_status=="Police Station"){
                                ps6[enumber] = response.chartdata[i].shit;
                            }
                            else{
                                record[enumber] = response.chartdata[i].shit;
                            }
                            
                            console.log(released);
                            console.log(forrelease);
                            console.log(unpaid);
                        }
                        }
                        var chartdata = {
                            labels : caseskp,
                            datasets : [
                                {   
                                    label: 'Unassigned',
                                    borderWith: 1,
                                    backgroundColor : "rgba(197,225,165 ,1)",
                                    borderColor : "rgba(85,139,47 ,1)",
                                    data: unassigned
                                },
                                      {
                                    label: 'Mediation',
                                    borderWith: 1,
                                    backgroundColor : "rgba(129,212,250 ,1)",
                                    borderColor : "rgba(2,119,189 ,1)",
                                    data: mediation
                                },
                                {
                                    label: 'Conciliation',
                                    borderWith: 1,
                                    backgroundColor : "rgba(244,143,177 ,1)",
                                    borderColor : "rgba(173,20,87 ,1)",
                                    data: conciliation
                                },
                                {
                                    label: 'Arbitration',
                                    borderWith: 1,
                                    backgroundColor : "rgba(158,157,36 ,1)",
                                    borderColor : "rgba(230,238,156 ,1)",
                                    data: arbitration
                                },
                                {
                                    label: 'Settled',
                                    borderWith: 1,
                                    backgroundColor : "rgba(255,204,128 ,1)",
                                    borderColor : "rgba(239,108,0 ,1)",
                                    data: settled
                                },
                                {
                                    label: 'Record',
                                    borderWith: 1,
                                    backgroundColor : "rgba(255,171,145 ,1))",
                                    borderColor : "rgba(216,67,21 ,1)",
                                    data: record
                                },
                                {
                                    label: 'Violence Against Women and Children',
                                    borderWith: 1,
                                    backgroundColor : "rgba(179,157,219 ,1)",
                                    borderColor : "rgba(69,39,160 ,1)",
                                    data: vawc
                                },
                                {
                                    label: 'Police Station',
                                    borderWith: 1,
                                    backgroundColor : "rgba(159,168,218 ,1)",
                                    borderColor : "rgba(40,53,147 ,1)",
                                    data: ps6
                                }
                            ]
                        };
                        var options = {
                            title :{
                                display: true,
                                position: "top",
                                text : 'Blotter Case Status Report for '+ monthlymonth + ' '+monthlyyear,
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

                        var unassigned = 0;
                        var mediation = 0;
                        var conciliation = 0;
                        var arbitration = 0 ;
                        var record = 0;
                        var ps6 = 0;
                        var vawc = 0;
                        var settled = 0;
                        for (var i = 0; i < response.tabledata.length; i++) {
                            var comp = "";
                            var res = "";
                            for (var k = 0; k < response.resident.length; k++) {
                                if(response.resident[k].personinvolve_case = response.tabledata[i].case_id){
                                    if(response.resident[k].personinvolve_type=='C'){
                                        comp+= response.resident[k].name+"<br>";
                                    }
                                    else{
                                        res+= response.resident[k].name+"<br>";
                                    }
                                }

                            }
                            if((response.tabledata[i].case_status=="Captain")||(response.tabledata[i].case_status=="Pangkat")){
                                    unassigned+=1;
                                }
                                else if(response.tabledata[i].case_status=="Mediation"){
                                    mediation+=1;
                                }
                                else if(response.tabledata[i].case_status=="Conciliation"){
                                    conciliation+=1;
                                }
                                else if(response.tabledata[i].case_status=="Arbitration"){
                                    arbitration+=1;
                                }
                                else if(response.tabledata[i].case_status=="Record"){
                                    record+=1;
                                }
                                else if(response.tabledata[i].case_status=="Police Station"){
                                    ps6+=1;
                                }
                                else if(response.tabledata[i].case_status=="Settled"){
                                    settled+=1;
                                }
                                else{
                                    vawc+=1;
                                }
                            var row = "<tr><td>"+response.tabledata[i].case_id+"</td><td>"+response.tabledata[i].case_name+"</td><td>"+response.tabledata[i].case_filed+"</td><td>"+comp+"</td><td>"+res+"</td><td>"+response.tabledata[i].case_status+"</td></tr>";
                            $('#reportTable').append(row);
                        }
                        var additionalrow = "<tr><td colspan='5'><strong class='pull-right'>Total Unassigned Cases: </strong></td><td>"+unassigned+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total Mediation Cases: </strong></td><td>"+mediation+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total Conciliation Cases: </strong></td><td>"+conciliation+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total Arbitration Cases: </strong></td><td>"+arbitration+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total Settled Cases: </strong></td><td>"+settled+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total Record Only Cases: </strong></td><td>"+record+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total VAWC Cases: </strong></td><td>"+vawc+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total Police Station Cases: </strong></td><td>"+ps6+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total Number of Cases: </strong></td><td>"+(arbitration+unassigned+mediation+conciliation+record+ps6+vawc+settled)+"</td></tr>";
                        $('#reportTable').append(additionalrow);
                    }
                });
                }
                else{
                    var yearlyyear = $('#yearlyyear').val();
                    $.ajax({
                    url : "/reports_blotter/yearly",
                    method: "POST",
                    data:{
                        _token : csrf_token,
                        yearlyyear : yearlyyear
                    },
                    dataType: 'json',
                    success: function(response){
                        var unassigned = [];
                        var settled = [];
                        var mediation = [];
                        var conciliation = [];
                        var arbitration = [];
                        var vawc = [];
                        var ps6 = [];
                        var record = [];
                        var caseskp = [];
                        for (var i = 0; i < response.chartdata.length; i++) {
                            if(jQuery.inArray(response.chartdata[i].caseskp_name, caseskp)==-1){
                                caseskp.push(response.chartdata[i].caseskp_name);

                                if(response.chartdata[i].case_status=="Captain"||response.chartdata[i].case_status=="Pangkat"){
                                unassigned.push(response.chartdata[i].shit);
                                settled.push(0);
                                mediation.push(0);
                                arbitration.push(0);
                                conciliation.push(0);
                                mediation.push(0);
                                vawc.push(0);
                                ps6.push(0);
                                record.push(0);
                                console.log("Released");
                            }
                            else if(response.chartdata[i].case_status=="Settled"){
                                unassigned.push(0);
                                settled.push(response.chartdata[i].shit);
                                mediation.push(0);
                                arbitration.push(0);
                                conciliation.push(0);
                                mediation.push(0);
                                vawc.push(0);
                                ps6.push(0);
                                record.push(0);
                            }
                            else if(response.chartdata[i].case_status=="Mediation"){
                                unassigned.push(0);
                                settled.push(0);
                                mediation.push(response.chartdata[i].shit);
                                arbitration.push(0);
                                conciliation.push(0);
                                mediation.push(0);
                                vawc.push(0);
                                ps6.push(0);
                                record.push(0);
                            }
                            else if(response.chartdata[i].case_status=="Conciliation"){
                                unassigned.push(0);
                                settled.push(0);
                                mediation.push(0);
                                arbitration.push(0);
                                conciliation.push(response.chartdata[i].shit);
                                mediation.push(0);
                                vawc.push(0);
                                ps6.push(0);
                                record.push(0);
                            }
                            else if(response.chartdata[i].case_status=="Arbitration"){
                                unassigned.push(0);
                                settled.push(0);
                                mediation.push(0);
                                arbitration.push(response.chartdata[i].shit);
                                conciliation.push(0);
                                mediation.push(0);
                                vawc.push(0);
                                ps6.push(0);
                                record.push(0);
                            }
                            else if(response.chartdata[i].case_status=="Violence Against Women and Children"){
                                unassigned.push(0);
                                settled.push(0);
                                mediation.push(0);
                                arbitration.push(0);
                                conciliation.push(0);
                                mediation.push(0);
                                vawc.push(response.chartdata[i].shit);
                                ps6.push(0);
                                record.push(0);
                            }
                            else if(response.chartdata[i].case_status=="Police Station"){
                                unassigned.push(0);
                                settled.push(0);
                                mediation.push(0);
                                arbitration.push(0);
                                conciliation.push(0);
                                mediation.push(0);
                                vawc.push(0);
                                ps6.push(response.chartdata[i].shit);
                                record.push(0);
                            }
                            else{
                                unassigned.push(0);
                                settled.push(0);
                                mediation.push(0);
                                arbitration.push(0);
                                conciliation.push(0);
                                mediation.push(0);
                                vawc.push(0);
                                ps6.push(0);
                                record.push(response.chartdata[i].shit);
                            }
                                
                        }
                            else{
                                var enumber = jQuery.inArray(response.chartdata[i].caseskp_name, caseskp);
                                if(response.chartdata[i].case_status=="Captain"||response.chartdata[i].case_status=="Pangkat"){
                                unassigned[enumber] = response.chartdata[i].shit;
                            }
                            else if(response.chartdata[i].case_status=="Settled"){
                                settled[enumber] = response.chartdata[i].shit;
                            }
                            else if(response.chartdata[i].case_status=="Mediation"){
                                mediation[enumber] = response.chartdata[i].shit;
                            }
                            else if(response.chartdata[i].case_status=="Conciliation"){
                                conciliation[enumber] = response.chartdata[i].shit;
                            }
                            else if(response.chartdata[i].case_status=="Arbitration"){
                                arbitration[enumber] = response.chartdata[i].shit;
                            }
                            else if(response.chartdata[i].case_status=="Violence Against Women and Children"){
                                vawc[enumber] = response.chartdata[i].shit;
                            }
                            else if(response.chartdata[i].case_status=="Police Station"){
                                ps6[enumber] = response.chartdata[i].shit;
                            }
                            else{
                                record[enumber] = response.chartdata[i].shit;
                            }
                        }
                        }
                        var chartdata = {
                            labels : caseskp,
                            datasets : [
                                {   
                                    label: 'Unassigned',
                                    borderWith: 1,
                                    backgroundColor : "rgba(197,225,165 ,1)",
                                    borderColor : "rgba(85,139,47 ,1)",
                                    data: unassigned
                                },
                                      {
                                    label: 'Mediation',
                                    borderWith: 1,
                                    backgroundColor : "rgba(129,212,250 ,1)",
                                    borderColor : "rgba(2,119,189 ,1)",
                                    data: mediation
                                },
                                {
                                    label: 'Conciliation',
                                    borderWith: 1,
                                    backgroundColor : "rgba(244,143,177 ,1)",
                                    borderColor : "rgba(173,20,87 ,1)",
                                    data: conciliation
                                },
                                {
                                    label: 'Arbitration',
                                    borderWith: 1,
                                    backgroundColor : "rgba(158,157,36 ,1)",
                                    borderColor : "rgba(230,238,156 ,1)",
                                    data: arbitration
                                },
                                {
                                    label: 'Settled',
                                    borderWith: 1,
                                    backgroundColor : "rgba(255,204,128 ,1)",
                                    borderColor : "rgba(239,108,0 ,1)",
                                    data: settled
                                },
                                {
                                    label: 'Record',
                                    borderWith: 1,
                                    backgroundColor : "rgba(255,171,145 ,1))",
                                    borderColor : "rgba(216,67,21 ,1)",
                                    data: record
                                },
                                {
                                    label: 'Violence Against Women and Children',
                                    borderWith: 1,
                                    backgroundColor : "rgba(179,157,219 ,1)",
                                    borderColor : "rgba(69,39,160 ,1)",
                                    data: vawc
                                },
                                {
                                    label: 'Police Station',
                                    borderWith: 1,
                                    backgroundColor : "rgba(159,168,218 ,1)",
                                    borderColor : "rgba(40,53,147 ,1)",
                                    data: ps6
                                }
                            ]
                        };
                        var options = {
                            title :{
                                display: true,
                                position: "top",
                                text : 'Blotter Case Status Report for '+ yearlyyear,
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

                        var unassigned = 0;
                        var mediation = 0;
                        var conciliation = 0;
                        var arbitration = 0 ;
                        var record = 0;
                        var ps6 = 0;
                        var vawc = 0;
                        var settled = 0;
                        for (var i = 0; i < response.tabledata.length; i++) {
                            var comp = "";
                            var res = "";
                            for (var k = 0; k < response.resident.length; k++) {
                                if(response.resident[k].personinvolve_case == response.tabledata[i].case_id){
                                    if(response.resident[k].personinvolve_type=='C'){
                                        comp+= response.resident[k].name+"<br>";
                                    }
                                    else{
                                        res+= response.resident[k].name+"<br>";
                                    }
                                }

                            }
                            if((response.tabledata[i].case_status=="Captain")||(response.tabledata[i].case_status=="Pangkat")){
                                    unassigned+=1;
                                }
                                else if(response.tabledata[i].case_status=="Mediation"){
                                    mediation+=1;
                                }
                                else if(response.tabledata[i].case_status=="Conciliation"){
                                    conciliation+=1;
                                }
                                else if(response.tabledata[i].case_status=="Arbitration"){
                                    arbitration+=1;
                                }
                                else if(response.tabledata[i].case_status=="Record"){
                                    record+=1;
                                }
                                else if(response.tabledata[i].case_status=="Police Station"){
                                    ps6+=1;
                                }
                                else if(response.tabledata[i].case_status=="Settled"){
                                    settled+=1;
                                }
                                else{
                                    vawc+=1;
                                }
                            var row = "<tr><td>"+response.tabledata[i].case_id+"</td><td>"+response.tabledata[i].case_name+"</td><td>"+response.tabledata[i].case_filed+"</td><td>"+comp+"</td><td>"+res+"</td><td>"+response.tabledata[i].case_status+"</td></tr>";
                            $('#reportTable').append(row);
                        }
                        var additionalrow = "<tr><td colspan='5'><strong class='pull-right'>Total Unassigned Cases: </strong></td><td>"+unassigned+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total Mediation Cases: </strong></td><td>"+mediation+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total Conciliation Cases: </strong></td><td>"+conciliation+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total Arbitration Cases: </strong></td><td>"+arbitration+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total Settled Cases: </strong></td><td>"+settled+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total Record Only Cases: </strong></td><td>"+record+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total VAWC Cases: </strong></td><td>"+vawc+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total Police Station Cases: </strong></td><td>"+ps6+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total Number of Cases: </strong></td><td>"+(arbitration+unassigned+mediation+conciliation+record+ps6+vawc+settled)+"</td></tr>";
                        $('#reportTable').append(additionalrow);
                    }
                });
                }
            });
        });
    </script>
</body>
</html>

