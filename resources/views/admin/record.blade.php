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
                    <br>
    <div class="col-sm-12">
    </div>
                        <div class="body table-responsive">
                            <table class="table table-hover table-striped table-bordered table-condensed dataTable js-exportable" id='recordtable'>
                                <thead>
                                    <tr class="bg-blue-grey">
                                        <th>Case ID</th>
                                        <th>Complainant/s</th>
                                        <th>Respondent/s</th>
                                        <th>Witness/es</th>
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

<div class="modal fade" id="yesu" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>Raffled Lupons</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row clearfix" id="palit">
                            </div>
                        </div>
                    </div>
                </div>
</div>

@include('admin.layout.scripts');
<script src="{{asset('plugins/jquery-steps/jquery.steps.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
<script>
$(document).ready(function(){
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');


    var table = $('#recordtable').DataTable({
        bSort : false,
        "ajax": {
                "url" : '/blotter/barangay/records',
                "dataSrc" : function (json) {
                    console.log(json);
                        var return_data = new Array();
                        if(json.length!=0){
                        var id = json[0].case_id;
                        var com = "";
                        var res = "";
                        var wit = "";
                        for(var i=0;i< json.length; i++){
                            if(id==json[i].case_id){
                                if(json[i].personinvolve_type=='C'){
                                    com += json[i].name + "<br>";
                                }
                                else if(json[i].personinvolve_type=='R'){
                                    res += json[i].name + "<br>";
                                }
                                else{
                                    wit += json[i].name + "<br>";   
                                }
                                var button = "";
                                if(i==json.length-1){
                                    if((json[i].case_status=="Captain")||(json[i].case_status=="Pangkat")){
                                        button = "<button type='button' class='assign btn btn-space bg-indigo waves-effect' data-toggle='tooltip' data-placement='bottom' title data-original-title='Assign Case'><i class='material-icons'>assignment_ind</i></button><button class='delete btn btn-space bg-red waves-effect'><i class='material-icons'>delete</i></button>";
                                    }
                                    else{
                                        button = "<button type = 'button' value='"+json[i].case_id+"' class = 'process btn btn-space bg-blue waves-effect'><i class='material-icons'>navigate_next</i></button>";
                                    }
                                    return_data.push({
                                        'id' : json[i].case_id,
                                        'com' : com,
                                        'res' : res,
                                        'wit' : wit,
                                        'case' : json[i].caseskp_name,
                                        'status' : json[i].case_status,
                                        'action' : button
                                    });
                                }
                            }                                    
                            else{
                                var button="";
                                 if((json[i-1].case_status=="Captain")||(json[i-1].case_status=="Pangkat")){
                                        button = "<button type='button' class='assign btn btn-space bg-indigo waves-effect' data-toggle='tooltip' data-placement='bottom' title data-original-title='Assign Case'><i class='material-icons'>assignment_ind</i></button><button class='delete btn btn-space bg-red waves-effect'><i class='material-icons'>delete</i></button>";
                                    }
                                    else{
                                        button = "<button type = 'button' value='"+json[i-1].case_id+"' class = 'process btn btn-space bg-blue waves-effect'><i class='material-icons'>navigate_next</i></button>";
                                    }
                                 return_data.push({
                                        'id' : json[i-1].case_id,
                                        'com' : com,
                                        'res' : res,
                                        'wit' : wit,
                                        'case' : json[i-1].caseskp_name,
                                        'status' : json[i-1].case_status,
                                        'action' : button
                                    });
                                id = json[i].case_id;
                                com = "";
                                res = "";
                                wit = "";
                                if(json[i].personinvolve_type=='C'){
                                    com = json[i].name+'<br>';
                                }
                                else if(json[i].personinvolve_type=='R'){
                                    res = json[i].name+'<br>';
                                }
                                else{
                                    wit = json[i].name+'<br>';   
                                }
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
                    { "data": 'wit' },
                    { "data": 'case' },
                    { "data": 'status' },
                    { "data": 'action' }
            ]
    });

    var id="";

    $('#recordtable tbody').on('click','button.assign', function(){
        var row = table.row($(this).parents('tr')).index();
        id = table.row($(this).parents('tr')).data().id;
        var stat = table.row($(this).parents('tr')).data().status;
        if(stat=="Lupon"){
        $.ajax({
            url : '/blotter/barangay/getcasestat',
            method: 'GET',
            data: {
                id : id,
                stat : stat
            },
            success: function(response){
                // console.log(response.length);
                $('#cont').empty();
                for(var i = 0 ; i < response.length; i++){
                    $('#cont').append('<input type="radio" name="rbtnCount" id="'+response[i].id+'" value="'+response[i].id+'" /><label for="'+response[i].id+'">'+response[i].name+'</label><br>');
                }
                $('#yesu').modal('toggle');
                table.ajax.reload();
            }
        });
        }
        else if(stat=="Captain"){
            $.ajax({
                url : '/blotter/barangay/allocatecasecap',
                method : 'POST',
                data : {
                    id : id,
                    _token : CSRF_TOKEN,
                    number : 3  
                },
                success : function(response){
                    console.log(response);
                    if(response[0]=="No Barangay Captain Assigned"){
                        swal({
                        title: "Error",
                        text: response,
                        type: "error",
                        showConfirmButton: true
                        });
                    }
                    else{
                        swal({
                        title: "Case Allocated!",
                        text: "Case Number: "+response[0].case+"\nScheduled Date: "+response[0].sched,
                        type: "success",
                        showConfirmButton: true
                    });
                        table.ajax.reload();
                    }
                }
            });
        }
        else{
            $.ajax({
                url: '/blotter/barangay/allocatepangkat',
                method: 'POST',
                data : {
                    _token: CSRF_TOKEN,
                    id: id
                },
                success: function(response){
                    console.log(response);
                    var todiv = "<div class='col-sm-12'>";
                    for (var i = 0; i < response.length; i++) {
                        todiv += '<label>'+response[i].official_id+'-'+response[i].name+'</label><div class="demo-radio-button"><input type="radio" class="radio-col-teal" name="group'+(i+1)+'" value="'+response[i].official_id+'_pp" id="pp'+(i+1)+'"><label for="pp'+(i+1)+'">Pangkat President</label><input type="radio" class="radio-col-teal" name="group'+(i+1)+'" value="'+response[i].official_id+'_ps" id="ps'+(i+1)+'"><label for="ps'+(i+1)+'">Pangkat Secretary</label><input type="radio" class="radio-col-teal" value="'+response[i].official_id+'_pm" name="group'+(i+1)+'" id="pm'+(i+1)+'"><label for="pm'+(i+1)+'">Pangkat Member</label></div><br>';
                    }
                    todiv+="</div><div class='col-sm-12'><button type='button' class='savep btn pull-right btn-space waves-effect bg-teal' id='savepangkat'>SAVE</button></div>";
                    console.log(todiv);
                    $('#palit').empty();
                    $('#palit').append(todiv);
                    $('#yesu').modal('toggle');
                }
            });
        }

    });

    $('#recordtable tbody').on('click', 'button.delete', function(){
        var row = table.row($(this).parents('tr')).index();
        id = table.row($(this).parents('tr')).data().id;
        $.ajax({
            url: '/blotter/barangay/delete/'+id,
            method: 'DELETE',
            data:{
                _token: CSRF_TOKEN
            },
            success: function(response){
                if(response=="success"){
                    swal({
                        title: "Case Deleted!",
                        type: "success",
                        timer: 1000,
                        showConfirmButton: false
                    });
                }
                else{
                    swal({
                        title: "Case not Deleted",
                        type: "error",
                        timer: 1000,
                        showConfirmButton: false
                    });
                }
                table.ajax.reload();
            }
        });
    });

    $('#recordtable tbody').on('click', 'button.process', function(){
        var rowid = $(this).val();
        $(location).attr('href', '/blotter/barangay/show/'+rowid);
    });

    $('#save').on('click', function(){
        $.ajax({
            url: '/blotter/barangay/allocatecase',
            method: 'POST',
            data: {
                _token : CSRF_TOKEN,
                offid : $('input[name=rbtnCount]:checked').val(),
                id: id
            },
            success: function(response){
                if(response.length!=0){
                    swal({
                        title: "Case Allocated!",
                        text: "Case Number: "+response[0].case+"\nScheduled Date: "+response[0].sched,
                        type: "success",
                        timer: 1000,
                        showConfirmButton: false
                    });
                }
                else{
                    swal({
                        title: "Error",
                        text: "Error",
                        type: "error",
                        timer: 1000,
                        showConfirmButton: false
                    });
                }
                $('#yesu').modal('toggle');
                table.ajax.reload();
            }
        }); 
    }); 

    $(document).on('click', 'button.savep', function(){

        var group1 = $("input[name='group1']:checked").val();
        var group2 = $("input[name='group2']:checked").val();
        var group3 = $("input[name='group3']:checked").val();

        $.ajax({
            url : '/barangay/blotter/assignpangkat',
            method: 'POST',
            data :{
                _token: CSRF_TOKEN,
                group1 : group1,
                group2: group2,
                group3: group3,
                id: id
            },
            success: function(response){
                if(response=="success"){
                    swal({
                        title: "Case Allocated!",
                        text: "CasevSuccessfully allocated to a pangkat",
                        type: "success",
                        showConfirmButton: true
                    });
                    $('#yesu').modal('toggle');
                    table.ajax.reload();
                }
            }
        });
    });

    
});
</script>
<script src="{{asset('plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
</body>
</html>
