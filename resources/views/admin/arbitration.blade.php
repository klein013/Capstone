<!DOCTYPE html>
<html>
<head>
    <title>Blotter | Arbitration</title>
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
                            <div class="text"><h3>ARBITRATION</h3></div>
                        </div>
                    </div>
                </div>


            </div>
            </div>

            <div class="row clearfix">
                <div class="col-sm-12">
                </div>
                    <div class="card" id="hearingbody">
                        <div class="body" >
                            <div class="row clearfix" >
                                <div class="body table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td><label class="pull-right">Case ID : </label></td>
                                                <td><p class="pull-left" id="caseid">{{$case[0]->case_id}}</p><p id="hearingid" style="display: none;">{{$case[0]->hearing_id}}</p></td><td></td><td></td>
                                            <tr>
                                            <tr>
                                                <td><label class="pull-right">Official Involved : </label></td>
                                                <td><p class="pull-left" id="official">{{$case[0]->official}}</p></td>
                                                <td><label class="pull-right">Case Type : </label></td>
                                                <td><p class="pull-left" id="casetype">{{$case[0]->caseskp_name}}</p></td>
                                            </tr>
                                            <tr>
                                                <td><label class="pull-right">Complainant/s : </label></td>
                                                <td>
                                                    @foreach($cresident as $resident)
                                                    <p id="complainant">{{$resident->name}}</p>
                                                    @endforeach
                                                </td>
                                                <td><label class="pull-right">Respondent/s : </label></td>
                                                <td>
                                                    @foreach($rresident as $resident)
                                                    <p id="respondent">{{$resident->name}}</p>
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label class="pull-right">Witness/es : </label></td>
                                                <td>
                                                    @if($rresident!=null)
                                                    @foreach($wresident as $resident)
                                                    <p id="witness">{{$resident->name}}</p>
                                                    @endforeach
                                                    @endif
                                                </td>
                                                <td><label class="pull-right">Case Filed : </label></td>
                                                <td><p id="caseadded">{{$case[0]->case_filed}}</p></td>
                                            </tr>
                                            <tr>
                                                <td><label class="pull-right">Hearing Type : </label></td>
                                                <td><p id="hearingtype">Arbitrstion</p></td>
                                                <td><label class="pull-right">Hearing ID : </label></td>
                                                <td><p>{{$case[0]->hearing_id}}</p><p id="minuteid" style="display: none;">{{$minutes->minute_id}}</p></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <form id = "hearing">
                                <div class="row clearfix">
                                    <div class="col-sm-2">
                                        <label>Arbitration Award</label>
                                    </div>
                                    <br>
                                    <div class="col-sm-12">
                                        <textarea id="myTextarea" class="form-control" name="myTextarea"></textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="row clearfix">
                                    <div class="col-sm-2 col-sm-offset-10">
                                        <button type="submit" class="btn btn-lg bg-teal btn-space waves-effect">Submit</button>
                                        <button type="button" id="cancelbtn" class="btn pull-right btn-lg bg-teal waves-effect">Cancel</button>
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
                swal({
                    title: "Are you sure you want to continue?",
                    text: "This will save the details for this hearing",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Delete",
                    cancelButtonText: "Cancel",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },  
                function(isConfirm) {
                    if (isConfirm){
                        $.ajax({
                            url: '/blotter/barangay/arbitration/save',
                            method: 'POST',
                            data: {
                                _token : CSRF_TOKEN,
                                id : parseInt($('#hearingid').text()),
                                case : parseInt($('#caseid').text()),
                                minutesid : parseInt($('#minutesid').text()),
                                minutes: tinyMCE.get('myTextarea').getContent(),
                                official : ($('#official').text()).split(" ")[0]
                            },
                            success: function(response) {
                                if(response=="success"){
                                    window.open("/blotter/barangay/arbitration/print/"+$('#caseid').text(),'_blank');
                                        return false;
                                swal({
                                    title: "Decide!",
                                    type: "success",
                                    showCancelButton: true,
                                    confirmButtonClass: "btn-danger",
                                    confirmButtonText: "Proceed to Settlement",
                                    cancelButtonText: "Back to Record",
                                    closeOnConfirm: true,
                                    closeOnCancel: true
                                },  
                                function(isConfirm) {
                                    if (isConfirm){
                                        $(location).attr('href', '/blotter/barangay/settlement/'+parseInt($('#minutesid').text()));
                                        
                                    }
                                    else{
                                       $(location).attr('href', '/blotter/barangay/show/'+$('#caseid').text());
                                    }
                                });
                            }
                        }
                        });

                    } 
                    else {
                        $.ajax({
                            url : '/blotter/barangay/removearb/'+$('#minutesid').text()+'_'+$('#hearingid').text()+'_'+$('#caseid').text(),
                            method: 'GET',
                            success: function(response){
                                swal({
                                title : "Cancelled", 
                                text : "Arbitration is not entered",
                                type :  "error",
                                showConfirmButton: true,
                                confirmButtonText: "Okay",
                            }, function(isConfirm){
                            if(isConfirm){
                                $(location).attr('href', '/blotter/barangay/show/'+$('#caseid').text());
                            }
                        });
                            }
                        });
                        
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

     $('#cancelbtn').on('click', function(){
        window.history.back();
     });

   
});
    </script>
    
</body>
</html>