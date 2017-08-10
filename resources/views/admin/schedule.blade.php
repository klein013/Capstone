<!DOCTYPE html>
<html>
<head>
	<title>Barangay Blotter | Schedule</title>
	@include('admin.layout.head')
	<link rel="stylesheet" href="{{asset('js/fullcalendar.min.css')}}">
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
                    <img src="../../images/human.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$return['name']}}</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li class="user-header">
                            <div class="imgcontainer">
                                <img src="../../{{$return['image']}}" alt="Avatar" class="avatar">
                            </div>
                            </li>
                            <li><a href="{{URL('/profile')}}"><i class="material-icons">person</i>Profile</a></li>
                            <li><a href="{{URL('/')}}"><i class="material-icons">input</i>Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            @if($return['position']==0)
                @include('admin.aside_admin');
            @elseif($return['position'==1])
                @include('admin.aside_pb');
            @elseif($return['position_id'==2])
                @include('admin.aside_pb');
            @elseif($return['position_id'==3])
                @include('admin.aside_admin');
            @elseif($return['position_id'==4])
                @include('admin.aside_sec');
            @elseif($return['position_id'==5])
                @include('admin.aside_desk');
            @elseif($return['position_id'==6])
                @include('admin.aside_bpso');
            @elseif($return['position_id'==7])
                @include('admin.aside_cashier');
            @endif
            </aside>
<section class="content">
    <div class="container-fluid">
            <div class="header text-center">
                        <div class="info-box bg-teal">
                            <div class="content">
                            <div class="text"><h1> SCHEDULE </h1></div>
                            </div>
                        </div>
                    </div>
            </div>


           
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
          </div><!-- /.row -->
      </div><!-- /.content-wrapper -->

      <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="card">
                        <div class="body table-responsive">
                            <table class="table dataTable js-exportable" id='residentTable'>
                                <thead>
                                    <tr class="bg-blue-grey">
                                        <th>ID</th>
                                        <th>Complainant</th>
                                        <th>Respondent</th>
                                        <th>Case</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                        <td>1</td>
                                        <td>Erwin Tarun</td>
                                        <td>Joshua Glenn Maano</td>
                                        <td>Threat</td>
                                        <td>Pending</td>
                                        <td><a href="javascript:void(0)" data-toggle="tooltip" title="Process Schedule"><button type = 'button' class = 'update btn btn-space bg-blue waves-effect' data-toggle="modal" data-target="#largeModal"><i class="material-icons">cached</i></button></td>
                                  </tr>
                                </tbody>
                              </table>
                        </div>
                    </div>
                </div>
            </div>

  </div>
</section>
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        </div>
                        <div class="modal-body">
                        <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="body">
                            <div id="wizard_horizontal">
                                <h2>Mediation</h2>
                                <section>
                                <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
                                    <div class="panel-group" id="accordion_11" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-col-teal">
                                            <div class="panel-heading" role="tab" id="headingOne_11">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" data-parent="#accordion_11" href="#collapseOne_11" aria-expanded="true" aria-controls="collapseOne_11">
                                                        Hearing
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne_11" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_11">
                                                <div class="panel-body">
                                                    <div class="body table-responsive">
                                                        <table class="table dataTable js-exportable" id='residentTable'>
                                                            <thead>
                                                                <tr class="bg-blue-grey">
                                                                    <th>Hearing Date</th>
                                                                    <th>Hearing Type</th>
                                                                    <th>Complainant</th>
                                                                    <th>Respondent</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                              <tr>
                                                                    <td>02/13/17</td>
                                                                    <td>1st Hearing</td>
                                                                    <td>Joshua Glenn Maano/Attended</td>
                                                                    <td>Erwin Tarun/Not Attended</td>
                                                              </tr>
                                                            </tbody>
                                                          </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </section>

                                <h2>Conciliation</h2>
                                <section>
                                    <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
                                    <div class="panel-group" id="accordion_10" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-col-teal">
                                            <div class="panel-heading" role="tab" id="headingOne_10">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" data-parent="#accordion_10" href="#collapseOne_10" aria-expanded="true" aria-controls="collapseOne_10">
                                                        Hearing
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne_10" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_10">
                                                <div class="panel-body">
                                                    <div class="body table-responsive">
                                                        <table class="table dataTable js-exportable" id='residentTable'>
                                                            <thead>
                                                                <tr class="bg-blue-grey">
                                                                    <th>Hearing Date</th>
                                                                    <th>Hearing Type</th>
                                                                    <th>Complainant</th>
                                                                    <th>Respondent</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                              <tr>
                                                                    <td>02/13/17</td>
                                                                    <td>1st Hearing</td>
                                                                    <td>Joshua Glenn Maano/Attended</td>
                                                                    <td>Erwin Tarun/Not Attended</td>
                                                              </tr>
                                                            </tbody>
                                                          </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </section>

                                <h2>Arbitration</h2>
                                <section>
                                 <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
                                    <div class="panel-group" id="accordion_12" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-col-teal">
                                            <div class="panel-heading" role="tab" id="headingOne_12">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" data-parent="#accordion_12" href="#collapseOne_12" aria-expanded="true" aria-controls="collapseOne_12">
                                                        Hearing
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne_12" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_12">
                                                <div class="panel-body">
                                                    <div class="body table-responsive">
                                                        <table class="table dataTable js-exportable" id='residentTable'>
                                                            <thead>
                                                                <tr class="bg-blue-grey">
                                                                    <th>Hearing Date</th>
                                                                    <th>Hearing Type</th>
                                                                    <th>Complainant</th>
                                                                    <th>Respondent</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                              <tr>
                                                                    <td>02/13/17</td>
                                                                    <td>1st Hearing</td>
                                                                    <td>Joshua Glenn Maano/Attended</td>
                                                                    <td>Erwin Tarun/Not Attended</td>
                                                              </tr>
                                                            </tbody>
                                                          </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.layout.scripts');
<script src="{{asset('js/moment.min.js')}}"></script>
<script src="{{asset('js/fullcalendar.min.js')}}"></script>
<script src="{{asset('plugins/jquery-steps/jquery.steps.js')}}"></script>
<script>

$(document).ready(function(){
    $('#calendar').fullCalendar({
        header : {
        },
        selectable: true,
        selectHelper: true,
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