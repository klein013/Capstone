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
                  <div class="card" style="height: 1000px;">
                    <div class="body">
                        <div class="col-sm-12 body table-responsive">
                            <table class="table table-bordered table-condensed">
                                <tr>
                                    <td colspan="2"><h4>Case ID: {{$records[0]->case_id}}</h4></td>
                                </tr>
                                <tr>
                                    <td style="width:50%;"><h5>Case Filed: </h5><p>&nbsp;{{$records[0]->case_filed}}</p></td>
                                    <td style="width:50%;"><h5>Case Status: </h5><p>&nbsp;{{$records[0]->case_status}}</p>
                                        @if($records[0]->case_status=="Settled")
                                            <button type="button" class="settled btn btn-space waves-effect bg-teal" value="{{$records[0]->case_id}}">View Settlement</button>
                                        @elseif($records[0]->case_status=="Police Station")
                                            <button type="button" class="letterprintps btn btn-space waves-effect bg-teal" value="{{$records[0]->case_id}}">Print Letter</button>
                                        @elseif($records[0]->case_status=="Violence Against Women and Children")
                                            <button type="button" class="letterprintvawc btn btn-space waves-effect bg-teal" value="{{$records[0]->case_id}}">Print Letter</button>
                                        @endif</td>
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
                        @if(!(($records[0]->case_status!='Record')&&($records[0]->case_status!='Police Station')&&($records[0]->case_status!='Violence Against Women and Children')))
                            </div>
                            </div>
                            </div>
                            </div>
                        @else
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
                                                                <td><button type="button" value="{{$hearing->hearing_id}}|{{$hearing->hearing_status}}" class="view btn btn-space btn-group waves-effect bg-blue">Proceeed to Hearing</button></td>
                                                                @elseif($hearing->hearing_status=="Pending")
                                                                <td><button type="button" value="{{$hearing->hearing_id}}|{{$hearing->hearing_status}}" class="view btn btn-space btn-group waves-effect bg-indigo">View</button></td>
                                                                @elseif($hearing->hearing_status=="Done")
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
                                                                <td><button type="button" value="{{$hearing->hearing_id}}|{{$hearing->hearing_status}}" class="view btn btn-space btn-group waves-effect bg-blue">Proceed to Hearing</button></td>
                                                                @elseif($hearing->hearing_status=="Pending")
                                                                <td><button type="button" value="{{$hearing->hearing_id}}|{{$hearing->hearing_status}}" class="view btn btn-space btn-group waves-effect bg-indigo">View</button></td>
                                                                @elseif($hearing->hearing_status=="Done")
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
                                                                <td><button type="button" value="{{$hearing->hearing_id}}|{{$hearing->hearing_status}}" class="view btn btn-space btn-group waves-effect bg-blue">Proceed to Hearing</button></td>
                                                                @elseif($hearing->hearing_status=="Pending")
                                                                <td><button type="button" value="{{$hearing->hearing_id}}|{{$hearing->hearing_status}}" class="view btn btn-space btn-group waves-effect bg-indigo">View</button></td>
                                                                @elseif($hearing->hearing_status=="Done")
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
                        @endif
                    
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

    var hearingid = null;

    $('#mtable tbody').on('click', 'button.view', function(){
        var id = ($(this).val()).split('|')[0];
        hearingid = id;
        var status = ($(this).val()).split('|')[1]
        
        if(status=="Pending"){
            $.ajax({
                url : '/blotter/barangay/forprint/'+id,
                method : 'GET',
                success : function(response){
                    var todisplay = "<div class='col-sm-12'><div class='body table-responsive'><table class='table table-condensed table-bordered table-striped table-hover' id='printtable'><thead><tr class='bg-blue-grey'><td>Person</td><td>Letter Type</td><td></td></tr></thead><tbody>";
                    for (var i = 0; i < response.length; i++) {
                        todisplay += '<tr><td>'+response[i].name+'</td><td>'+response[i].hl_lettertype+'</td>';
                        if(response[i].hl_datereceive==null&&response[i].hl_printdate==null){
                            todisplay += '<td><button type="button" class="print btn btn-space waves-effect bg-black" value="'+response[i].resident_id+'|'+response[i].personinvolve_type+'|'+response[i].hl_lettertype+'"><i class="material-icons">print</i></button></td>';
                        }
                        else if(response[i].hl_datereceive==null&&response[i].hl_printdate!=null){
                            todisplay += '<td><button type="button" class="save btn btn-space waves-effect bg-teal pull-right" value="'+response[i].resident_id+'_'+response[i].hl_lettertype+'">Received</button></span></td>';
                        }
                        else{
                            todisplay += '<td><button type="button" class="btn btn-space waves-effect bg-teal pull-right" disabled>Received last '+response[i].hl_datereceive+'</button><button type="button" class="print btn btn-space waves-effect bg-black" value="'+response[i].resident_id+'|'+response[i].personinvolve_type+'|'+response[i].hl_lettertype+'"><i class="material-icons">print</i> Reprint</button></td>';
                        }
                        todisplay+='</tr>';
                    }

                    todisplay+="</tbody></table></div></div>";

                    $('#modalbody').empty();
                    $('#modalbody').append(todisplay);
                    $('#largeModal').modal('toggle');
                }
            });
        }
        else if(status=="For Reschedule"){

        }
        else if(status=="For Process"){
            $(location).attr('href', '/blotter/barangay/schedule/'+id);
        }
        else if(status=='Done'){
            $.ajax({
                url : '/blotter/barangay/viewhearing/'+id,
                method: 'GET',
                success: function(response){
                    console.log(response);
                    var todisplay = "<div class='col-sm-12'><div class='body'><div class='col-sm-6'>";
                    todisplay += '<h4>Hearing ID : '+response.rows[0].hearing_id+'</h4><h5>Hearing Type : '+response.rows[0].casestage+'</h5><h5>Hearing Schedule : '+response.rows[0].hearing_sched+'</h5><h5>Time Started : '+response.rows[0].minutes_start+'</h5><h5>Time Ended : '+response.rows[0].minutes_end+'</h5><h5>Attendance</h5>';
                    var comp = "<ul>";
                    var res = "<ul>";
                    for (var i = 0; i < response.attendances.length; i++) {
                        if(response.attendances[i].personinvolve_type=='C'){
                            if(response.attendances[i].ha_attented==1){
                                comp += '<li>'+response.attendances[i].name+' - Attended</li>';
                            }
                            else{
                                comp += '<li>'+response.attendances[i].name+' - Not Attended</li>';
                            }
                        }
                        else if(response.attendances[i].personinvolve_type=='R'){
                            if(response.attendances[i].ha_attented==1){
                                res += '<li>'+response.attendances[i].name+' - Attended</li>';
                            }
                            else{
                                res += '<li>'+response.attendances[i].name+' - Not Attended</li>';
                            }
                        }
                    }
                    res += '</ul>';
                    comp += '</ul>';
                    todisplay += '<h5>Complainant/s</h5>'+comp+'<h5>Respondent/s</h5>'+res+'</div><div class="col-sm-6"><h5>Minutes of Hearing</h5>'+response.rows[0].minutes_details+'</div><br><div class="col-sm-12"><button type="button" class="closemodal btn btn-space bg-teal pull-right waves-effect">Close</button></div></div></div>';

                    $('#modalbody').empty();
                    $('#modalbody').append(todisplay);
                    $('#largeModal').modal('toggle');
                }
            }); 
        }
    });

    $('#ctable tbody').on('click', 'button.view', function(){
        var id = ($(this).val()).split('|')[0];
        hearingid = id;
        var status = ($(this).val()).split('|')[1]
        
        if(status=="Pending"){
            $.ajax({
                url : '/blotter/barangay/forprint/'+id,
                method : 'GET',
                success : function(response){
                    var todisplay = "<div class='col-sm-12'><div class='body table-responsive'><table class='table table-condensed table-bordered table-striped table-hover' id='printtable'><thead><tr class='bg-blue-grey'><td>Person</td><td>Letter Type</td><td></td></tr></thead><tbody>";
                    for (var i = 0; i < response.length; i++) {
                        todisplay += '<tr><td>'+response[i].name+'</td><td>'+response[i].hl_lettertype+'</td>';
                        if(response[i].hl_datereceive==null&&response[i].hl_printdate==null){
                            todisplay += '<td><button type="button" class="print btn btn-space waves-effect bg-black" value="'+response[i].resident_id+'|'+response[i].personinvolve_type+'|'+response[i].hl_lettertype+'"><i class="material-icons">print</i></button></td>';
                        }
                        else if(response[i].hl_datereceive==null&&response[i].hl_printdate!=null){
                            todisplay += '<td><button type="button" class="save btn btn-space waves-effect bg-teal pull-right" value="'+response[i].resident_id+'_'+response[i].hl_lettertype+'">Received</button></span></td>';
                        }
                        else{
                            todisplay += '<td><button type="button" class="btn btn-space waves-effect bg-teal pull-right" disabled>Received last '+response[i].hl_datereceive+'</button><button type="button" class="print btn btn-space waves-effect bg-black" value="'+response[i].resident_id+'|'+response[i].personinvolve_type+'|'+response[i].hl_lettertype+'"><i class="material-icons">print</i> Reprint</button></td>';
                        }
                        todisplay+='</tr>';
                    }

                    todisplay+="</tbody></table></div></div>";

                    $('#modalbody').empty();
                    $('#modalbody').append(todisplay);
                    $('#largeModal').modal('toggle');
                }
            });
        }
        else if(status=="For Reschedule"){

        }
        else if(status=="For Process"){
            $(location).attr('href', '/blotter/barangay/schedule/'+id);
        }
        else if(status=='Done'){

        }
    });    
   
    $('#atable tbody').on('click', 'button.view', function(){
        var id = ($(this).val()).split('|')[0];
        hearingid = id;
        var status = ($(this).val()).split('|')[1]
        
        if(status=="Pending"){
            $.ajax({
                url : '/blotter/barangay/forprint/'+id,
                method : 'GET',
                success : function(response){
                    var todisplay = "<div class='col-sm-12'><div class='body table-responsive'><table class='table table-condensed table-bordered table-striped table-hover' id='printtable'><thead><tr class='bg-blue-grey'><td>Person</td><td>Letter Type</td><td></td></tr></thead><tbody>";
                    for (var i = 0; i < response.length; i++) {
                        todisplay += '<tr><td>'+response[i].name+'</td><td>'+response[i].hl_lettertype+'</td>';
                        if(response[i].hl_datereceive==null&&response[i].hl_printdate==null){
                            todisplay += '<td><button type="button" class="print btn btn-space waves-effect bg-black" value="'+response[i].resident_id+'|'+response[i].personinvolve_type+'|'+response[i].hl_lettertype+'"><i class="material-icons">print</i></button></td>';
                        }
                        else if(response[i].hl_datereceive==null&&response[i].hl_printdate!=null){
                            todisplay += '<td><button type="button" class="save btn btn-space waves-effect bg-teal pull-right" value="'+response[i].resident_id+'_'+response[i].hl_lettertype+'">Received</button></span></td>';
                        }
                        else{
                            todisplay += '<td><button type="button" class="btn btn-space waves-effect bg-teal pull-right" disabled>Received last '+response[i].hl_datereceive+'</button><button type="button" class="print btn btn-space waves-effect bg-black" value="'+response[i].resident_id+'|'+response[i].personinvolve_type+'|'+response[i].hl_lettertype+'"><i class="material-icons">print</i> Reprint</button></td>';
                        }
                        todisplay+='</tr>';
                    }

                    todisplay+="</tbody></table></div></div>";

                    $('#modalbody').empty();
                    $('#modalbody').append(todisplay);
                    $('#largeModal').modal('toggle');
                }
            });
        }
        else if(status=="For Reschedule"){

        }
        else if(status=="For Process"){
            $(location).attr('href', '/blotter/barangay/schedule/'+id);
        }
        else if(status=='Done'){
           
        }
    });

    $(document).on('click', 'button.print', function(){
        console.log(hearingid);
        var resid= ($(this).val()).split('|')[0];
        var restype = ($(this).val()).split('|')[1];
        var lettertype = ($(this).val()).split('|')[2];
        if(lettertype=="Summon"){
            $(location).attr('href', '/blotter/barangay/print/summon/'+resid+'_'+hearingid);
        }
        else if(lettertype=="Notice of Hearing - Mediation Proceedings"){
            $(location).attr('href', '/blotter/barangay/print/noticemed/'+resid+'_'+hearingid);   
        }
    });
    
    
    $(document).on( 'focus', '.datarec', function(){
        var classes = $(this).attr('class');
        var dateofprint = classes.split(' ')[2];
        $(this).daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: 'YYYY-MM-DD'
                },
                minDate: dateofprint,
                maxDate: moment()
        });
    });

    $(document).on('click', 'button.closemodal', function(){
        $('#largeModal').modal('toggle');
    });

    $(document).on('click', 'button.save', function(){
        var tosend = $(this).val();
        $(this).html('Received last '+moment().format('MM-DD-YYYY'));
        $(this).attr('disabled', true);
        $.ajax({
            url: '/blotter/barangay/received/'+tosend+'_'+hearingid,
            method: 'GET',
            success: function(response){
                
            }
        });
    });

    $(document).on('click', 'button.letterprintps', function(){
        $(location).attr('href', '/blotter/barangay/printps/'+$(this).val());
    });

    $(document).on('click', 'button.letterprintvawc', function(){
        $(location).attr('href', '/blotter/barangay/printvawc/'+$(this).val());
    });

    $(document).on('click', 'button.settled', function(){
        $(location).attr('href', '/blotter/barangay/printsettlement/'+$(this).val());
    });    
});
</script>
</body>
</html>
