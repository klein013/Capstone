<!DOCTYPE html>
<html>
<head>
    <title>Clearance | Hearing</title>
    @include('admin.layout.head');
    <link href="{{asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
</head>
<body class="theme-blue-grey">
@include('admin.layout.nav');
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
                            <i class="material-icons">gavel</i>
                        </div>
                        <div class="content">
                            <div class="text"><h3>HEARING</h3></div>
                        </div>
                    </div>
                </div>


            </div>
            </div>

            <div class="row clearfix">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="body">
                            <div class="row clearfix">
                                <div class="body table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td><label class="pull-right">Time Consumed : </label></td>
                                                <td><div id="time">
    <span id="hours">00</span> :
    <span id="minutes">00</span> :
    <span id="seconds">00</span> ::
    <span id="milliseconds">000</span>
</div><button type="button" class="btn bg-blue" id="start_pause_resume">Start</button></p>
                                                <td><label class="pull-right">Case ID : </label></td>
                                                <td><p class="pull-left" id="caseid">{{$case[0]->case_id}}</p><p id="hearingid" style="display: none;">{{$case[0]->hearing_id}}</p></td>
                                            <tr>
                                            <tr>
                                                <td><label class="pull-right">Official Involved : </label></td>
                                                <td><p class="pull-left" id="official">{{$case[0]->official}}</p></td>
                                                <td><label class="pull-right">Case Type : </label></td>
                                                <td><p class="pull-left" id="casetype">{{$case[0]->caseskp_name}}</p></td>
                                            </tr>
                                            <tr>
                                                <td><label class="pull-right">Complainant/s : </label></td>
                                                <td><p id="complainant">{{$cresident[0]->name}}<button type="button" class="btn btn-circle waves-effect waves-circle waves-float bg-blue pull-right"><i class="material-icons">mode_edit</i></button></p></td>
                                                <td><label class="pull-right">Respondent/s : </label></td>
                                                <td><p id="respondent">{{$rresident[0]->name}}<button type="button" class="btn btn-circle waves-effect waves-circle waves-float bg-blue pull-right"><i class="material-icons">mode_edit</i></button></p></td>
                                            </tr>
                                            <tr>
                                                <td><label class="pull-right">Witness/es : </label></td>
                                                <td><p id="witness">
                                                {{$wresident[0]->name}}
                                                <button type="button" class="btn btn-circle waves-effect waves-circle waves-float bg-blue pull-right"><i class="material-icons">mode_edit</i></button></p></td>
                                                <td><label class="pull-right">Case Added : </label></td>
                                                <td><p id="caseadded">{{$case[0]->case_filed}}</p></td>
                                            </tr>
                                            <tr>
                                                <td><label class="pull-right">Hearing Type : </label></td>
                                                <td><p id="hearingtype">{{$case[0]->hearing_type}}</p></td>
                                                <td><label class="pull-right">Scheduled Date : </label></td>
                                                <td><p id="schedule">{{$case[0]->hearing_sched}}<button type="button" class="btn btn-circle waves-effect waves-circle waves-float bg-red pull-right"><i class="material-icons">mode_edit</i></button></p></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <form id = "hearing">
                                <div class="row clearfix">
                                    <div class="col-sm-2">
                                        <label>Minutes</label>
                                    </div>
                                    <br>
                                    <div class="col-sm-12">
                                        <textarea id="myTextarea" class="form-control" name="myTextarea"></textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="row clearfix">
                                    <div class="col-sm-1 col-sm-offset-11">
                                        <button type="submit" class="btn btn-lg bg-teal waves-effect">Submit</button>
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
    <script src="{{asset('plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
    <script src='{{asset("tinymce/tinymce.min.js")}}'></script>
    <script src="{{asset('tinymce/jquery.tinymce.min.js')}}"></script>
    <script>
        $(document).ready(function(){

            var CSRF_TOKEN = $('meta[name="csrf-token"').attr('content');

            var minuteid;
            $('#requestTable').dataTable({
                "bSort" : false
            });

            tinymce.init({
            selector: '#myTextarea',
            theme: 'modern',
            menubar: false,
            resize: true,
            branding: false,
            width: 1500,
            height: 500,
            plugins: [
                'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                'save table contextmenu directionality emoticons template paste textcolor'
            ],
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons'
        });


    $(function() {

    var hours = minutes = seconds = milliseconds = 0;
    var prev_hours = prev_minutes = prev_seconds = prev_milliseconds = undefined;
    var timeUpdate;

    // Start/Pause/Resume button onClick
    $("#start_pause_resume").button().click(function(){

        // Start button
        if($(this).text() == "Start"){  // check button label
            $(this).html("<span class='ui-button-text'>Pause</span>");
            $.ajax({
                url: '/blotter/barangay/starthearing',
                method: 'POST',
                data: {
                    _token : CSRF_TOKEN,
                    id : $('#hearingid').text(),
                    official : ($('#official').text()).split(" ")[0]
                },
                success: function(response){
                    minuteid = response;
                }
            });

            updateTime(0,0,0,0);
        }
        // Pause button
        else if($(this).text() == "Pause"){
            clearInterval(timeUpdate);
            $(this).html("<span class='ui-button-text'>Resume</span>");
        }
        // Resume button        
        else if($(this).text() == "Resume"){
            prev_hours = parseInt($("#hours").html());
            prev_minutes = parseInt($("#minutes").html());
            prev_seconds = parseInt($("#seconds").html());
            prev_milliseconds = parseInt($("#milliseconds").html());

            updateTime(prev_hours, prev_minutes, prev_seconds, prev_milliseconds);

            $(this).html("<span class='ui-button-text'>Pause</span>");
        }
    });

    // Update time in stopwatch periodically - every 25ms
    function updateTime(prev_hours, prev_minutes, prev_seconds, prev_milliseconds){
        var startTime = new Date();    // fetch current time

        timeUpdate = setInterval(function () {
            var timeElapsed = new Date().getTime() - startTime.getTime();    // calculate the time elapsed in milliseconds

            // calculate hours                
            hours = parseInt(timeElapsed / 1000 / 60 / 60) + prev_hours;

            // calculate minutes
            minutes = parseInt(timeElapsed / 1000 / 60) + prev_minutes;
            if (minutes > 60) minutes %= 60;

            // calculate seconds
            seconds = parseInt(timeElapsed / 1000) + prev_seconds;
            if (seconds > 60) seconds %= 60;

            // calculate milliseconds 
            milliseconds = timeElapsed + prev_milliseconds;
            if (milliseconds > 1000) milliseconds %= 1000;

            // set the stopwatch
            setStopwatch(hours, minutes, seconds, milliseconds);

        }, 25); // update time in stopwatch after every 25ms

    }

    // Set the time in stopwatch
    function setStopwatch(hours, minutes, seconds, milliseconds){
        $("#hours").html(prependZero(hours, 2));
        $("#minutes").html(prependZero(minutes, 2));
        $("#seconds").html(prependZero(seconds, 2));
        $("#milliseconds").html(prependZero(milliseconds, 3));
    }

    // Prepend zeros to the digits in stopwatch
    function prependZero(time, length) {
        time = new String(time);    // stringify time
        return new Array(Math.max(length - time.length + 1, 0)).join("0") + time;
    }
});

    $.validator.addMethod("alphanum", function(value, element) {
                return this.optional(element) || value == value.match(/^[a-zA-Z0-9 .,]*$/);
            },"Letters, Numbers, spaces, period and comma only");

     $('#hearing').validate({
            rules:{
                myTextarea : {
                    required: true,
                    alphanum: true
                }
            },
            submitHandler: function(form){
                clearInterval(timeUpdate);
                $(this).html("<span class='ui-button-text'>Resume</span>");
                $.ajax({
                    url: '/blotter/barangay/hearing',
                    method: 'POST',
                    data: {
                        _token : CSRF_TOKEN,
                        id : parseInt($('#hearingid').text()),
                        minutes: tinyMCE.get('myTextarea').getContent(),
                        official : ($('#official').text()).split(" ")[0],
                        rendered : $('#hours').html()+":"+$('#minutes').html()+":"+$('#seconds').html()
                    },
                    success: function(response) {
                        table.ajax.reload();
                        if(response=="success"){
                        swal({
                                title: "Success",
                                text: "Minutes Update",
                                type: "success",
                                timer: 1000,
                                showConfirmButton: false
                            });
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
});
    </script>
    
</body>
</html>