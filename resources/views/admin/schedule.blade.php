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
            @elseif($return['position']==6)
                @include('admin.aside_bpso');
            @elseif($return['position']==7)
                @include('admin.aside_cashier');
            @endif
            </aside>
<section class="content">
    <div class="card">
        <div class="container-fluid">
            <div class="header text-center">
                <div class="info-box bg-teal">
                    <div class="content">
                        <div class="text"><h1> SCHEDULE </h1></div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row clearfix">
        <div class="w3-container w3-center w3-light-grey">
            <div class="w3-container">
            <br>
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-body no-padding">
                            <div id="calendar"></div>
                        </div><!-- /.box-body -->
                    </div><!-- /. box -->
                </div><!-- /.col -->
            </div>
            </div>
        </div><!-- /.row -->
      </div><!-- /.content-wrapper -->


</section>

@include('admin.layout.scripts');
<script src="{{asset('js/moment.min.js')}}"></script>
<script src="{{asset('js/fullcalendar.min.js')}}"></script>
<script src="{{asset('js/scheduler.min.js')}}"></script>
<script src="{{asset('plugins/jquery-steps/jquery.steps.js')}}"></script>
<script>

$(document).ready(function(){
    var calendar = $('#calendar').fullCalendar({
        defaultView: 'agendaDay',
        header : {
            center: 'title',
            left: 'month,basicWeek, agendaDay'
        },
        selectable: true,
        selectHelper: true
    });

     $.ajax({
        url: '/getSchedule',
        method: 'GET',
        dataType: 'json',
        success: function(response){
            var events = [];
            $.each(response,function(index,value){
                events.push({
                    title : value.id+"\n"+value.case,
                    start : moment(value.hearing_sched).format('YYYY-MM-DD hh:mm:ss'),
                    end :  moment(value.hearing_sched).add(240, 'm'),
                });
            });
            calendar.fullCalendar( 'addEventSource', events);
            
        }
    });

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