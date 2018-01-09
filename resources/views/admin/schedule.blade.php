<!DOCTYPE html>
<html>
<head>
	<title>Barangay Blotter | Schedule</title>
	@include('admin.layout.head')
	<link rel="stylesheet" href="{{asset('js/fullcalendar.min.css')}}">
    <link rel="stylesheet" href="{{asset('js/scheduler.min.css')}}">
    <link rel="stylesheet" href="{{asset('js/fullcalendar.print.css')}}" media="print">
    <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.css')}}">
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
            @elseif($return['posit  ion']==6)
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
                            <i class="material-icons">date_range</i>
                        </div>
                        <div class="content">
                            <div class="text"><h3>SCHEDULE</h3></div>
                        </div>
                    </div>
                </div>


            </div>
            </div>
    <div class="card">


        <div class="row clearfix">
            <div class="container-fluid">
            <br>
                <div class="col-sm-12">
                            <div id="calendar"></div>
                </div><!-- /.col -->
            </div>
            </div>
        </div><!-- /.row -->
      </div><!-- /.content-wrapper -->


    <div class="modal fade" id="modal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="largeModalLabel">CASE</h4>
                        </div>
                        <div class="modal-body" id="modalbody">
                        </div>    
                        
                    </div>
                </div>
            </div>
        </div>

    <div class="modal fade" id="modalresched" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="largeModalLabel">Update Schedule</h4>
                        </div>
                        <form id="scheddate">
                        <div class="modal-body">
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label>Select a Date : </label>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-line">
                                        <input type="text" class="form-control" id="datechange" name="datechange">

                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                          
                        <br>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                            <div class="col-sm-4 col-sm-offset-8">
                                <button type="submit" class="btn btn-space bg-teal">Submit</button>
                                <button type="button" class="btn pull-right btn-space bg-teal" id="cancelresched">Cancel</button>
                            </div>
                        </div>
                        </div>
                    </form>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
</section>

@include('admin.layout.scripts');
<script src="{{asset('js/moment.min.js')}}"></script>
<script src="{{asset('js/fullcalendar.min.js')}}"></script>
<script src="{{asset('js/scheduler.min.js')}}"></script>
<script src="{{asset('plugins/jquery-steps/jquery.steps.js')}}"></script>
<script>

$(document).ready(function(){

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    var id = "";
    var caseno = "";
    var rescheddate = "";
    check();

    $('#update').on('click', function(){

    });

    $('#delete').on('click', function(){

    }); 

    $('#cancelresched').on('click', function(){
        $('#modal').modal('toggle');
        $('#modalresched').modal('toggle');
    });

    $('#modalbody').on('click','button.resched', function(){
        $('#modal').modal('toggle');
        $('#modalresched').modal('toggle');
    });

    $('#modalbody').on('click', 'button.process', function(){
        window.open(window.location.href+"/"+id,'_self');
    });

     $.validator.addMethod("dateISOF", function (value, element)
            {
                if (this.optional(element))
                {
                    return true;
                }
                if (!(/^\d{4}[\/-]\d{1,2}[\/-]\d{1,2}$/.test(value)))
                {
                    return false;
                }
                var split = value.replace(/\//g, "-").split("-");
                var year = parseInt(split[0]);
                var month = parseInt(split[1]) - 1;
                var date = parseInt(split[2]);
                var dateObj = new Date(year, month, date, 0, 0, 0, 0);
                return dateObj.getFullYear() == year && dateObj.getMonth() == month && dateObj.getDate() == date;
            }, "Please enter a valid date.");

    $('#scheddate').validate({
        rules: {
            datename : {
                required: true,
                dateISOF : true
            }
        },
        submitHandler: function(form){
            $.ajax({
                url : '/blotter/barangay/resched',
                method : 'POST',
                data : {
                    _token : CSRF_TOKEN,
                    id: id,
                    caseno : caseno,
                    number : 0,
                    rescheddate: $('#datechange').val()
                    },
                    success : function(response){
                        if(response=="No available slot for the selected date"){
                            swal({
                            title: "Error",
                            text: response,
                            type: "error",
                            showConfirmButton: true
                            });
                            $('#modalresched').modal('toggle');
                        }
                        else{
                            swal({
                            title: "Case Allocated!",
                            text: "Case Number: "+response[0].case+"\nScheduled Date: "+response[0].sched,
                            type: "success",
                            showConfirmButton: true
                            });
                            $('#modalresched').modal('toggle');
                            check();
                        }
                    }
                });
                },
                highlight: function (input) {
                    $(input).parents('.form-line').addClass('error');
                },
                unhighlight: function (input) {
                    $(input).parents('.form-line').removeClass('error');
                },
                errorPlacement: function (error, element) {
                    $(element).parents('.form-group').append(error);
                }
    });
    

    function check(){
        setTimeout(check, 60000);
        var calendar = $('#calendar').fullCalendar({
        defaultView: 'agendaDay',
        header : {
            center: 'title',
            left: 'month,basicWeek, agendaDay'
        },
        selectable: true,
        selectHelper: true,
        eventClick: function(event) {
            var word = (event.title).split("\n");
            console.log(word);
            id = ((word[1]).split(" "))[2];
            caseno = ((word[2]).split(" "))[2];
            console.log(id+" "+caseno);
            var date = moment(event.start).format("YYYY-MM-DD");
            var time = moment(event.start).format("hh:mm:ss");
            $('#datechange').daterangepicker({
                "singleDatePicker": true,
                "autoApply": true,
                "dateLimit": {
                "days": 7
            },
                "locale" :{
                    "format" : "YYYY-MM-DD"
                },
                "linkedCalendars": false,
                "alwaysShowCalendars": true,
                "minDate": moment(event.start).add(1,'day').format("YYYY-MM-DD"),
                "maxDate": moment(event.start).add(7,'days').format("YYYY-MM-DD"),
                "opens": "center"
            });


           $.ajax({
                url : "/blotter/barangay/getdetails/"+id,
                method : "GET",
                dataType : 'json',
                success : function(response){
                    $('#modalbody').empty();
                    var complainant = "";
                    var respondent = "";
                    var witness = "";
                    $.each(response[1].cresidents,function(index,value){
                        complainant += value.name + "\n";
                    });
                    $.each(response[2].rresidents,function(index,value){
                        respondent += value.name + "\n";
                    });
                    $.each(response[3].wresidents,function(index,value){
                        witness += value.name + "\n";
                    });
                    var buttons = "";
                    if((word[0].split("\n"))[0]=="For Reschedule"){
                        buttons = "<div class='col-sm-3'><label>Reschedule</label></div><div class='col-sm-2'><button type='button' class='resched btn btn-lg bg-green' id='resched'><i class='material-icons'>schedule</i></button></div>";
                    }
                    else if((word[0].split("\n"))[0]=="Pending"){
                        buttons = "<div class='col-sm-3'><label>Reschedule</label></div><div class='col-sm-2'><button type='button' class='resched btn btn-lg bg-green' id='resched'><i class='material-icons'>schedule</i></button></div>";
                    }
                    else if((word[0].split("\n"))[0]=="For Process"){
                        buttons = "<div class='col-sm-3'><label>Reschedule</label></div><div class='col-sm-2'><button type='button' class='resched btn btn-lg bg-red' id='resched'><i class='material-icons'>schedule</i></button></div><div class='col-sm-3'><label>Process</label></div><div class='col-sm-2'><button type='button' class='process btn btn-lg bg-green' id='process'><i class='material-icons'>launch</i></button></div>";   
                    }
                    var toinput = "<div class='row clearfix'>"+
                        "<div class='col-sm-12'><table class='table table-bordered'>"
                        +"<tbody><tr><td><label>Hearing ID : "+response[0].case[0].hearing_id+"</label></td><td><label>Hearing Type: "+response[0].case[0].hearing_type+"</label></td></tr><tr><td><label>Case ID: "+response[0].case[0].case_id+"</label></td><td><label>Case Type: "+response[0].case[0].caseskp_name+"</label></td></tr><tr><td><label>Complainant/s : "+complainant+"</label></td><td><label>Respondent/s : "+respondent+"</label></td></tr><tr><td><label>Witness/es : "+witness+"</label></td><td><label>Official Assigned : "+response[0].case[0].official+"</label></td></tr></tbody>"
                        +"</table></div><div class='col-sm-12'>"+buttons+"</div>"
                        +"</div>";

                    $('#modalbody').append(toinput);
                    $('#modal').modal('toggle');
                }
           });
        }
    });
        calendar.fullCalendar('removeEvents');

     $.ajax({
        url: '/getSchedule',
        method: 'GET',
        dataType: 'json',
        success: function(response){
            var events = [];
            $.each(response,function(index,value){
                var color = "";
                if(value.hearing_status=="Done"){
                    color = "green";

                }
                else if(value.hearing_status=="Pending"){
                    color = "Orange";
                }
                else if(value.hearing_status=="For Reschedule"){
                    color= "red";
                }
                else{
                    color = "blue";
                }
                events.push({
                    title : value.hearing_status+"\n"+value.id+"\n"+value.case+"\n"+value.casename,
                    start : moment(value.hearing_sched).format('YYYY-MM-DD HH:mm:ss'),
                    end :  moment(value.hearing_sched).add(90, 'm'),
                    backgroundColor : color
                });
            });

            calendar.fullCalendar( 'addEventSource', events);
            
        }
    });
    }
    

    $('#wizard_horizontal').steps({
                headerTag: 'h2',
                bodyTag: 'section',
                transitionEffect: 'slideLeft',
                onInit: function (event, currentIndex) {
                    setButtonWavesEffect(event);
                    
                },
                onStepChanged: function (event, currentIndex, priorIndex) {
                    setButtonWavesEffect(event);
                }
            });
            function setButtonWavesEffect(event) {
                $(event.currentTarget).find('[role="menu"] li a').removeClass('waves-effect');
                $(event.currentTarget).find('[role="menu"] li:not(.disabled) a').addClass('waves-effect');
            }
});
</script>
</body>
</html>
