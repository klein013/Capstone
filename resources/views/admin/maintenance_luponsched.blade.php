<!DOCTYPE html>
<html>
<head>
	<title>Maintenance | Lupon Schedule</title>
	@include('admin.layout.head');
     <link href="{{asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
     <link href="{{asset('plugins/multi-select/css/multi-select.css')}}" rel="stylesheet">
</head>
<body class="theme-blue-grey">
    @include('admin.layout.nav');
    @include('admin.layout.aside');
   <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-teal">
                        <div class="icon">
                            <i class="material-icons">event</i>
                        </div>
                        <div class="content">
                            <div class="text"><h3> LUPON SCHEDULE</h3></div>
                        </div>
                    </div>
                </div>


            </div>
            </div>
            <!-- Multi Select -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                             <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="row-clearfix">
                                        <div class="col-md-4 col-md-offset-9">
                                            <label>Barangay Payatas Branch</label>
                                            <select id="branch">
                                            @foreach($branches as $branch)
                                                <option value="{{$branch->Branch_ID}}">{{$branch->Branch_Name}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                        <div id="wizard_horizontal">
                        
                            
                            <h4>
                                MONDAY
                            </h4>
                            <section>
                            <div class="row clearfix">
                            <select id="mon" class="ms" multiple="multiple">
                                
                            </select>
                            </div>
                            </section>
                        
                            <h4>
                                TUESDAY
                            </h4>
                            <section>
                            <div class="row clearfix">
                            <select id="tues" class="ms" multiple="multiple">
                                
                            </select>
                            </div>
                            </section>
                        
                            <h4>
                                WEDNESDAY
                            </h4>
                            <section>
                            <div class="row clearfix">
                            <select id="wed" class="ms" multiple="multiple">
                                
                            </select>
                            </div>
                            </section>
                        
                        
                        
                            <h4>
                                THURSDAY
                            </h4>
                            <section>
                            <div class="row clearfix">
                            <select id="thur" class="ms" multiple="multiple">
                                
                            </select>
                            </div>
                            </section>
                            <h4>
                                FRIDAY
                            </h4>
                            <section>
                            <div class="row clearfix">
                            <select id="fri" class="ms" multiple="multiple">
                                
                            </select>
                            </div>
                            </section>
                        
                        
                            <h4>
                                SATURDAY
                            </h4>
                            <section>
                            <div class="row clearfix">
                            <select id="sat" class="ms" multiple="multiple">
                                
                            </select>
                            </div>
                            </section>
                            <h4>
                                SUNDAY
                            </h4>
                            <section>
                            <div class="row clearfix">
                            <select id="sun" class="ms" multiple="multiple">
                                
                            </select>
                            </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Multi Select -->
    </section>
    @include('admin.layout.scripts');
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{asset('plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
     <!-- Multi Select Plugin Js -->
    <script src="{{asset('plugins/multi-select/js/jquery.multi-select.js')}}"></script>
    <script src="{{asset('plugins/jquery-steps/jquery.steps.js')}}"></script>
    
    <!--<script src="{{asset('plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>-->
    <script>
        $(document).ready(function(){
            var day;
            $('#wizard_horizontal').steps({
                headerTag: 'h4',
                bodyTag: 'section',
                transitionEffect: 'slideLeft',
                onInit: function (event, currentIndex) {
                    setButtonWavesEffect(event);
                     $.ajax({
                        url: 'maintenance_luponsched/nosched',
                        method: "GET",
                        data:{
                            day : currentIndex
                        },
                        dataType: 'json',
                        success: function(response){
                            if(currentIndex==0){
                                var i;
                                for(i=0;i<response.length;i++){
                                    $('#mon').multiSelect('addOption', { value: response[i].Lupon_ID , text: response[i].Lupon_Name});
                                }
                            }
                        }
                    });
                },
                onStepChanged: function (event, currentIndex, priorIndex) {
                    setButtonWavesEffect(event);
                    day = currentIndex;
                    $.ajax({
                        url: 'maintenance_luponsched/nosched',
                        method: "GET",
                        data:{
                            day : currentIndex
                        },
                        dataType: 'json',
                        success: function(response){
                            if(currentIndex==0){
                                var i;
                                for(i=0;i<response.length;i++){
                                    $('#mon').multiSelect('addOption', { value: response[i].Lupon_ID , text: response[i].Lupon_Name});
                                    $('#mon').multiSelect('refresh');
                                }
                            }
                            else if(currentIndex==1){
                                for(i=0;i<response.length;i++){
                                    $('#tues').multiSelect('addOption', { value: response[i].Lupon_ID , text: response[i].Lupon_Name});
                                    $('#tues').multiSelect('refresh');
                                }
                            }
                            else if(currentIndex==2){
                                for(i=0;i<response.length;i++){
                                    $('#wed').multiSelect('addOption', { value: response[i].Lupon_ID , text: response[i].Lupon_Name});
                                    $('#wed').multiSelect('refresh');
                                }
                            }
                            else if(currentIndex==3){
                                for(i=0;i<response.length;i++){
                                    $('#thur').multiSelect('addOption', { value: response[i].Lupon_ID , text: response[i].Lupon_Name});
                                    $('#thur').multiSelect('refresh');
                                }
                            }
                            else if(currentIndex==4){
                                for(i=0;i<response.length;i++){
                                    $('#fri').multiSelect('addOption', { value: response[i].Lupon_ID , text: response[i].Lupon_Name});
                                    $('#fri').multiSelect('refresh');
                                }
                            }
                            else if(currentIndex==5){
                                for(i=0;i<response.length;i++){
                                    $('#sat').multiSelect('addOption', { value: response[i].Lupon_ID , text: response[i].Lupon_Name});
                                    $('#sat').multiSelect('refresh');
                                }
                            }
                            else{
                                for(i=0;i<response.length;i++){
                                    $('#sun').multiSelect('addOption', { value: response[i].Lupon_ID , text: response[i].Lupon_Name});
                                    $('#sun').multiSelect('refresh');
                                }
                            }
                        }
                    });
                }
            });
            function setButtonWavesEffect(event) {
                $(event.currentTarget).find('[role="menu"] li a').removeClass('waves-effect');
                $(event.currentTarget).find('[role="menu"] li:not(.disabled) a').addClass('waves-effect');
            }
            $('#mon').multiSelect({
                afterSelect: function(values){
                    $.ajax({
                        url: 'maintenance_luponsched/add', 
                        method : "GET",
                        data: {
                            day: day,
                            id: values,
                            area: $('#branch').val()
                        },
                        success: function(){
                            $('#mon').multiSelect('refresh');
                        }
                    });
                },
                afterDeselect: function(values){
                    $.ajax({
                        url: 'maintenance_luponsched/subtract', 
                        method : "GET",
                        data: {
                            day: day,
                            id: values,
                            area: $('#branch').val()
                        },
                        success: function(){
                            $('#mon').multiSelect('refresh');
                        }
                    });
                }
            });
            $('#tues').multiSelect({
                afterSelect: function(values){
                    $.ajax({
                        url: 'maintenance_luponsched/add', 
                        method : "GET",
                        data: {
                            day: day,
                            id: values,
                            area: $('#branch').val()
                        },
                        success: function(){
                            $('#tues').multiSelect('refresh');
                        }
                    });
                },
                afterDeselect: function(values){
                    $.ajax({
                        url: 'maintenance_luponsched/subtract', 
                        method : "GET",
                        data: {
                            day: day,
                            id: values,
                            area: $('#branch').val()
                        },
                        success: function(){
                            $('#tues').multiSelect('refresh');
                        }
                    });
                }
            });
            $('#wed').multiSelect({
                afterSelect: function(values){
                    $.ajax({
                        url: 'maintenance_luponsched/add', 
                        method : "GET",
                        data: {
                            day: day,
                            id: values,
                            area: $('#branch').val()
                        },
                        success: function(){
                            $('#wed').multiSelect('refresh');
                        }
                    });                    
                },
                afterDeselect: function(values){
                    $.ajax({
                        url: 'maintenance_luponsched/subtract', 
                        method : "GET",
                        data: {
                            day: day,
                            id: values,
                            area: $('#branch').val()
                        },
                        success: function(){
                            $('#wed').multiSelect('refresh');
                        }
                    });
                }
            });
            $('#thur').multiSelect({
                afterSelect: function(values){
                    $.ajax({
                        url: 'maintenance_luponsched/add', 
                        method : "GET",
                        data: {
                            day: day,
                            id: values,
                            area: $('#branch').val()
                        },
                        success: function(){
                            $('#thur').multiSelect('refresh');
                        }
                    });
                },
                afterDeselect: function(values){
                    $.ajax({
                        url: 'maintenance_luponsched/subtract', 
                        method : "GET",
                        data: {
                            day: day,
                            id: values,
                            area: $('#branch').val()
                        },
                        success: function(){
                            $('#thur').multiSelect('refresh');
                        }
                    });
                }
            });
            $('#fri').multiSelect({
                afterSelect: function(values){
                    $.ajax({
                        url: 'maintenance_luponsched/add', 
                        method : "GET",
                        data: {
                            day: day,
                            id: values,
                            area: $('#branch').val()
                        },
                        success: function(){
                            $('#fri').multiSelect('refresh');
                        }
                    });
                },
                afterDeselect: function(values){
                    $.ajax({
                        url: 'maintenance_luponsched/subtract', 
                        method : "GET",
                        data: {
                            day: day,
                            id: values,
                            area: $('#branch').val()
                        },
                        success: function(){
                            $('#fri').multiSelect('refresh');
                        }
                    });
                }
            });
            $('#sat').multiSelect({
                afterSelect: function(values){
                    $.ajax({
                        url: 'maintenance_luponsched/add', 
                        method : "GET",
                        data: {
                            day: day,
                            id: values,
                            area: $('#branch').val()
                        },
                        success: function(){
                            $('#sat').multiSelect('refresh');
                        }
                    });
                },
                afterDeselect: function(values){
                    $.ajax({
                        url: 'maintenance_luponsched/subtract', 
                        method : "GET",
                        data: {
                            day: day,
                            id: values,
                            area: $('#branch').val()
                        },
                        success: function(){
                            $('#sat').multiSelect('refresh');
                        }
                    });
                }
            });
            $('#sun').multiSelect({
                afterSelect: function(values){
                    $.ajax({
                        url: 'maintenance_luponsched/add', 
                        method : "GET",
                        data: {
                            day: day,
                            id: values,
                            area: $('#branch').val()
                        },
                        success: function(){
                            $('#sun').multiSelect('refresh');
                        }
                    });
                },
                afterDeselect: function(values){
                    $.ajax({
                        url: 'maintenance_luponsched/subtract', 
                        method : "GET",
                        data: {
                            day: day,
                            id: values,
                            area: $('#branch').val()
                        },
                        success: function(){
                            $('#sun').multiSelect('refresh');
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
