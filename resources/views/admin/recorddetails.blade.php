<!DOCTYPE html>
<html>
<head>
    <title>Barangay Blotter | Record Details</title>
    @include('admin.layout.head')
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
   <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="card">
                    <div class="body">
                        <div class="col-sm-12 body table-responsive">
                            <table class="table table-bordered table-condensed">
                                <tr>
                                    <td colspan="2"><h4>Case ID: {{$records[0]->case_id}}</h4></td>
                                </tr>
                                <tr>
                                    <td style="width:50%;"><h5>Case Filed: </h5><p>&nbsp;{{$records[0]->case_filed}}</p></td>
                                    <td style="width:50%;"><h5>Case Status: </h5><p>&nbsp;{{$records[0]->case_status}}</p></td>
                                </tr>
                                <tr>
                                    <td style="width:50%;"> <span><h5>Official/s Assigned :</h5>
                                        <ul>
                                        @foreach($allocated as $alloc)
                                            <li><p>{{$alloc->official_id}} - {{$alloc->name}}</p></li>
                                        @endforeach
                                        </ul>
                                    </td>
                                    <td style="width:50%;">
                                        <h5>Case Type : </h5>
                                        <p>&nbsp;{{$records[0]->caseskp_name}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:50%;"><h5>Complainant/s : </h5>
                                        <ul>
                                        @foreach($records as $record)
                                            @if($record->personinvolve_type=='C')
                                                <li><p>{{$record->name}}</p></li>
                                            @endif
                                        @endforeach
                                        </ul>
                                    </td>
                                    <td style="width:50%;"><h5>Respondent/s : </h5>
                                        <ul>
                                        @foreach($records as $record)
                                            @if($record->personinvolve_type=='R')
                                                <li><p>{{$record->name}}</p></li>
                                            @endif
                                        @endforeach
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:50%;"><h5>Witness/es : </h5>
                                        <ul>
                                        @foreach($records as $record)
                                            @if($record->personinvolve_type=='W')
                                                <li><p>{{$record->name}}</p></li>
                                            @endif
                                        @endforeach
                                        </ul>
                                    </td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                        <br>
                            <div id="wizard_horizontal">
                                <h2>Mediation</h2>
                                <section>
                                    <div class="row clearfix">
                                        <div class="col-sm-12" class="body table-responsive">
                                            <table class="table table-bordered table-condensed table-striped table-hover" id="mtable">
                                                <thead>
                                                    <tr class="bg-blue-grey">
                                                        <th>ID</th>
                                                        <th>Hearing Date</th>
                                                        <th>Hearing Type</th>
                                                        <th>Hearing Status</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if($hearingsmed!=null)
                                                        @foreach($hearingsmed as $hearing)
                                                            <tr>
                                                                <td>{{$hearing->hearing_id}}</td>
                                                                <td>{{$hearing->hearing_sched}}</td>
                                                                <td>{{$hearing->casestage}}</td>
                                                                <td>{{$hearing->hearing_status}}</td>
                                                                @if($hearing->hearing_status=='For Process')
                                                                <td><button type="button" value="{{$hearing->hearing_id}}|{{$hearing->hearing_status}}" class="view btn btn-space btn-group waves-effect bg-blue">Direct to Hearing</button></td>
                                                                @elseif($hearing->hearing_status=="Pending")
                                                                <td><button type="button" value="{{$hearing->hearing_id}}|{{$hearing->hearing_status}}" class="view btn btn-space btn-group waves-effect bg-indigo">View</button></td>
                                                                @elseif($hearing->hearing_status=='For Reschedule')
                                                                <td><button type="button" value="{{$hearing->hearing_id}}|{{$hearing->hearing_status}}" class="view btn btn-space btn-group waves-effect bg-red">Reschedule</button></td>
                                                                @else
                                                                <td></td>
                                                                @endif

                                                            }
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr><td colspan='5'><strong>No Data Found</strong></tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </section>

                                <h2>Conciliation</h2>
                                <section>
                                    <div class="row clearfix">
                                        <div class="col-sm-12" class="body table-responsive">
                                            <table class="table table-bordered table-condensed table-striped table-hover" id="ctable">
                                                <thead>
                                                    <tr  class="bg-blue-grey">
                                                        <th>ID</th>
                                                        <th>Hearing Date</th>
                                                        <th>Hearing Type</th>
                                                        <th>Hearing Status</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if($hearingscon!=null)
                                                        <tr>
                                                                <td>{{$hearing->hearing_id}}</td>
                                                                <td>{{$hearing->hearing_sched}}</td>
                                                                <td>{{$hearing->casestage}}</td>
                                                                <td>{{$hearing->hearing_status}}</td>
                                                                @if($hearing->hearing_status=='For Process')
                                                                <td><button type="button" value="{{$hearing->hearing_id}}|{{$hearing->hearing_status}}" class="view btn btn-space btn-group waves-effect bg-blue">Direct to Hearing</button></td>
                                                                @elseif($hearing->hearing_status=="Pending")
                                                                <td><button type="button" value="{{$hearing->hearing_id}}|{{$hearing->hearing_status}}" class="view btn btn-space btn-group waves-effect bg-indigo">View</button></td>
                                                                @elseif($hearing->hearing_status=='For Reschedule')
                                                                <td><button type="button" value="{{$hearing->hearing_id}}|{{$hearing->hearing_status}}" class="view btn btn-space btn-group waves-effect bg-red">Reschedule</button></td>
                                                                @else
                                                                <td></td>
                                                                @endif
                                                            </tr>
                                                    @else
                                                        <tr><td colspan='5'><strong>No Data Found</strong></tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </section>

                                <h2>Arbitration</h2>
                                <section>
                                    <div class="row clearfix">
                                        <div class="col-sm-12" class="body table-responsive">
                                            <table class="table table-bordered table-condensed table-striped table-hover" id="atable">
                                                <thead>
                                                    <tr class="bg-blue-grey">
                                                        <th>ID</th>
                                                        <th>Hearing Date</th>
                                                        <th>Hearing Type</th>
                                                        <th>Hearing Status</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if($hearingsarb!=null)
                                                        <tr>
                                                                <td>{{$hearing->hearing_id}}</td>
                                                                <td>{{$hearing->hearing_sched}}</td>
                                                                <td>{{$hearing->casestage}}</td>
                                                                <td>{{$hearing->hearing_status}}</td>
                                                                @if($hearing->hearing_status=='For Process')
                                                                <td><button type="button" value="{{$hearing->hearing_id}}|{{$hearing->hearing_status}}" class="view btn btn-space btn-group waves-effect bg-blue">Direct to Hearing</button></td>
                                                                @elseif($hearing->hearing_status=="Pending")
                                                                <td><button type="button" value="{{$hearing->hearing_id}}|{{$hearing->hearing_status}}" class="view btn btn-space btn-group waves-effect bg-indigo">View</button></td>
                                                                @elseif($hearing->hearing_status=='For Reschedule')
                                                                <td><button type="button" value="{{$hearing->hearing_id}}|{{$hearing->hearing_status}}" class="view btn btn-space btn-group waves-effect bg-red">Reschedule</button></td>
                                                                @else
                                                                <td></td>
                                                                @endif
                                                            </tr>
                                                    @else
                                                        <tr><td colspan='5'><strong>No Data Found</strong></tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                </div>
            </div>

  </div>
  <div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="body" id="modalbody">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</section>
                    
                
@include('admin.layout.scripts');
<script src="{{asset('plugins/jquery-steps/jquery.steps.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
<script>
$(document).ready(function(){
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
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


    $('#mtable tbody').on('click', 'button.view', function(){
        var id = ($(this).val()).split('|')[0];
        var status = ($(this).val()).split('|')[1]
        
        if(status=="Pending"){
            $.ajax({
                url : '/barangay/blotter/forprint/'+id,
                method : 'GET',
                success : function(response){
                    
                }
            });
        }
        else if(status=="For Reschedule"){

        }
        else if(status=="For Process"){
            $(location).attr('href', '/blotter/barangay/schedule/'+id);
        }
        
    });

    $('#ctable tbody').on('click', 'button.view', function(){

    });    
   
    $('#atable tbody').on('click', 'button.view', function(){

    });
    
});
</script>
</body>
</html>
