<!DOCTYPE html>
<html>
<head>
    <title>Barangay Blotter | Record</title>
    @include('admin.layout.head')
</head>
<body class="theme-blue-grey">
@include('admin.layout.nav')
<aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="../{{$return['image']}}" width="48" height="48" alt="User" />
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
                            <i class="material-icons">book</i>
                        </div>
                        <div class="content">
                            <div class="text"><h3>RECORD</h3></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  	</div>
   <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="card">
                        <div class="body table-responsive">
                            <table class="table dataTable js-exportable" id='recordtable'>
                                <thead>
                                    <tr class="bg-blue-grey">
                                        <th>Case ID</th>
                                        <th>Complainant/s</th>
                                        <th>Respondent/s</th>
                                        <th>Case</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 
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
                                                        Table Hearing
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
                                                        Table of Hearing
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
                                                        Table of Hearing
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
<script src="{{asset('plugins/jquery-steps/jquery.steps.js')}}"></script>
<script>
$(document).ready(function(){
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

    var table =$('#recordtable').dataTable({
        bSort : false,
        "ajax": {
                "url" : '/records',
                "dataSrc" : function (json) {
                        var return_data = new Array();
                        var id = json[0].case_id;
                        var com = "";
                        var res = "";
                        for(var i=0;i< json.length; i++){
                            if(id==json[i].case_id){
                                if(json[i].personinvolve_type=='C'){
                                    com = json[i].name;
                                }
                                else{
                                    res = json[i].name;
                                    
                            return_data.push({
                            'id' : json[i].case_id,
                            'com' : com,
                            'res' : res,
                            'case' : json[i].caseskp_name,
                            'status' : json[i].case_status,
                            'action' : "<button type = 'button' class = 'update btn btn-space bg-blue waves-effect' data-toggle='modal' data-target='#largeModal'><i class='material-icons'>cached</i></button>"
                            });
                                }
                            }
                            else{
                                id = json[i].case_id;
                                 if(json[i].personinvolve_type=='C'){
                                    com = json[i].name;
                                }
                            }
                        } 
                        return return_data;
                }
            },
            "columns": [
                    { "data": 'id' },
                    { "data": 'com' },
                    { "data": 'res' },
                    { "data": 'case' },
                    { "data": 'status' },
                    { "data": 'action' }
            ]
    });

})
</script>
<script src="{{asset('plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
</body>
</html>