<!DOCTYPE html>
<html>
<head>
    <title>Reports | Clearance</title>
    @include('admin.layout.head')
    <link href="{{asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
</head>
<body class="theme-blue-grey">
    <br>
    <div class="container" style="width:100%">
        <div class="card">
            <div class="header text-center">
                            <h3>CLEARANCE REPORT</h3>
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
                                        <th>Transaction Number</th>
                                        <th>Date</th>
                                        <th>Clearance Type</th>
                                        <th>Resident Name</th>
                                        <th>Status</th>
                                        <th>Amount</th>
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

                var value =  "";

            $('#selecttype').change(function(){

                value = $('#selecttype').val();

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

           
            var chartvar;
            $('#generate').on('click', function(){
                $('#reportdiv').show();
                $('#todisplay').show();
                $('#nonsense').hide();
                $('#reportTablebody').empty();
                
                if(value==1){
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
                                text : 'Clearance Status Report for '+ selecteddate,
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
                        myChart.destroy();
                        myChart = new Chart(ctx, {
                            type : 'bar',
                            data : chartdata,
                            options: options
                        });

                        var pricetotal = 0;
                        for (var i = 0; i < response.tabledata.length; i++) {
                            pricetotal += response.tabledata[i].price_amt;
                            var row = "<tr><td>"+response.tabledata[i].trans_id+"</td><td>"+response.tabledata[i].trans_date+"</td><td>"+response.tabledata[i].clearance_name+"</td><td>"+response.tabledata[i].name+"</td><td>"+response.tabledata[i].request_status+"</td><td>"+(response.tabledata[i].price_amt).toFixed(2)+"</td></tr>"
                            $('#reportTable').append(row);
                        }
                        var additionalrow = "<tr><td colspan='5'><strong class='pull-right'>Total Amount: </strong></td><td>"+pricetotal.toFixed(2)+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total Number of Clearance: </strong></td><td>"+response.tabledata.length+"</td></tr>";
                        $('#reportTable').append(additionalrow);
                    }
                });
                }
                else if(value==2){
                    var weekdate = $('#weeklydate').val();
                    var fromdate = (weekdate.split('|'))[0];
                    var todate = (weekdate.split('|'))[1];
                    $.ajax({
                        url : "/reports_clearance/weekly",
                        method: "POST",
                        data:{
                            _token : csrf_token,
                            fromdate : fromdate,
                            todate: todate
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
                                text : 'Clearance Status Report between '+ fromdate +' and '+todate,
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
                        myChart.destroy();
                        myChart = new Chart(ctx, {
                            type : 'bar',
                            data : chartdata,
                            options: options
                        });

                        var pricetotal = 0;
                        var pricetotalif = 0;
                        for (var i = 0; i < response.tabledata.length; i++) {
                            pricetotal += response.tabledata[i].price_amt;
                            if(response.tabledata[i].request_status!="Unpaid"){
                                pricetotalif+=response.tabledata[i].price_amt;
                            }
                            var row = "<tr><td>"+response.tabledata[i].trans_id+"</td><td>"+response.tabledata[i].trans_date+"</td><td>"+response.tabledata[i].clearance_name+"</td><td>"+response.tabledata[i].name+"</td><td>"+response.tabledata[i].request_status+"</td><td>"+(response.tabledata[i].price_amt).toFixed(2)+"</td></tr>"
                            $('#reportTable').append(row);
                        }
                        var additionalrow = "<tr><td colspan='5'><strong class='pull-right'>Total Amount: </strong></td><td>"+pricetotal.toFixed(2)+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total Amount to be Collected: </strong></td><td>"+pricetotalif.toFixed(2)+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total Number of Clearance: </strong></td><td>"+response.tabledata.length+"</td></tr>";
                        $('#reportTable').append(additionalrow);
                    
                        }
                    });
                }
                else if(value==3){
                    var monthlymonth = $('#monthlymonth').val();
                    var monthlyyear = $('#monthlyyear').val();
                    var monthword = $('#monthlymonth option[value="'+monthlymonth+'"]').text();
                    $.ajax({
                        url : "/reports_clearance/monthly",
                        method: "POST",
                        data:{
                            _token : csrf_token,
                            monthlymonth : monthlymonth,
                            monthlyyear: monthlyyear
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
                                text : 'Clearance Status Report for the month of '+monthword+' '+monthlyyear,
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
                        myChart.destroy();
                        myChart = new Chart(ctx, {
                            type : 'bar',
                            data : chartdata,
                            options: options
                        });

                        var pricetotal = 0;
                        var pricetotalif = 0;
                        for (var i = 0; i < response.tabledata.length; i++) {
                            pricetotal += response.tabledata[i].price_amt;
                            if(response.tabledata[i].request_status!="Unpaid"){
                                pricetotalif+=response.tabledata[i].price_amt;
                            }
                            var row = "<tr><td>"+response.tabledata[i].trans_id+"</td><td>"+response.tabledata[i].trans_date+"</td><td>"+response.tabledata[i].clearance_name+"</td><td>"+response.tabledata[i].name+"</td><td>"+response.tabledata[i].request_status+"</td><td>"+(response.tabledata[i].price_amt).toFixed(2)+"</td></tr>"
                            $('#reportTable').append(row);
                        }
                        var additionalrow = "<tr><td colspan='5'><strong class='pull-right'>Total Amount: </strong></td><td>"+pricetotal.toFixed(2)+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total Amount to be Collected: </strong></td><td>"+pricetotalif.toFixed(2)+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total Number of Clearance: </strong></td><td>"+response.tabledata.length+"</td></tr>";
                        $('#reportTable').append(additionalrow);
                    
                        }
                    });
                }
                else{
                    var yearlyyear = $('#yearlyyear').val();
                    $.ajax({
                        url : "/reports_clearance/yearly",
                        method: "POST",
                        data:{
                            _token : csrf_token,
                            yearlyyear : yearlyyear,
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
                                text : 'Clearance Status Report for the YEAR '+ yearlyyear,
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
                        myChart.destroy();
                        myChart = new Chart(ctx, {
                            type : 'bar',
                            data : chartdata,
                            options: options
                        });

                        var pricetotal = 0;
                        var pricetotalif = 0;
                        for (var i = 0; i < response.tabledata.length; i++) {
                            pricetotal += response.tabledata[i].price_amt;
                            if(response.tabledata[i].request_status!="Unpaid"){
                                pricetotalif+=response.tabledata[i].price_amt;
                            }
                            var row = "<tr><td>"+response.tabledata[i].trans_id+"</td><td>"+response.tabledata[i].trans_date+"</td><td>"+response.tabledata[i].clearance_name+"</td><td>"+response.tabledata[i].name+"</td><td>"+response.tabledata[i].request_status+"</td><td>"+(response.tabledata[i].price_amt).toFixed(2)+"</td></tr>"
                            $('#reportTable').append(row);
                        }
                        var additionalrow = "<tr><td colspan='5'><strong class='pull-right'>Total Amount: </strong></td><td>"+pricetotal.toFixed(2)+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total Amount to be Collected: </strong></td><td>"+pricetotalif.toFixed(2)+"</td></tr><tr><td colspan='5'><strong class='pull-right'>Total Number of Clearance: </strong></td><td>"+response.tabledata.length+"</td></tr>";
                        $('#reportTable').append(additionalrow);
                    
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
