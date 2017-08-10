<!DOCTYPE html>
<html>
<head>
    <title>Barangay Blotter | Record</title>
    @include('admin.layout.head')
</head>
<body class="theme-blue-grey">
@include('admin.layout.nav')
@include('admin.layout.aside')
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
                            <table class="table dataTable js-exportable" id='complaintTable'>
                                <thead>
                                    <tr class="bg-blue-grey">
                                        <th>ID</th>
                                        <th>Involved Person/s</th>
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
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h3>UPDATE STATUS</h3>
            </div>
            <div class="modal-body">
                <div class="card">
                    
                    <div class="row clearfix">
                        <br><br>
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-2">
                                <label>Current Status</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                        <select class="form-control show tick" id="stat" name="stat">
                                            <option value="Pending">Pending</option>
                                            <option value="On-going">On-going</option>
                                            <option value="Done">Done</option>
                                        </select>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                        <div class="col-md-6 col-md-offset-6">
                            <button type="submit" class="btn btn-lg bg-teal waves-effect" id="updatebtn">Update</button>
                            <button type="button" class="btn bg-teal btn-lg waves-effect" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                    <br>
                </div>
            </div>            
        </div>
    </div>
</div>

@include('admin.layout.scripts');
<script src="{{asset('plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
<script>
$(document).ready(function(){
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    var table = $('#complaintTable').DataTable({
        "bSort": false,
                "ajax" : {
                    "url": "/brecords/get",
                    "dataSrc" : function (json) {
                        var return_data = new Array();
                        for(var i=0;i< json.length; i++){
                            return_data.push({
                            'ID' : json[i].BrgyBlotter_ID,
                            'Name' : json[i].Name,
                            'Case' : json[i].CasesKP_Name,
                            'Status' : json[i].BrgyBlotter_Status,
                            })
                        }     
                        return return_data;
                    }
                },
                "columns": [
                    { "data": "ID" },
                    { "data": "Name"},
                    { "data": "Case" },
                    { "data": "Status" },
                    { "defaultContent": "<button type = 'button' class = 'update btn btn-space bg-blue waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Update Record'><i class='material-icons'>update</i></button><button type = 'button' class = 'delete btn btn-space bg-red waves-effect' data-toggle = 'tooltip' data-placement = 'bottom' title data-original-title='Delete Record'><i class='material-icons'>delete</i></button>" }
                ],
                "columnDefs": [
                    { 
                        className : "dt-right",
                        "targets" : [3]
                    }
                ]
    });

    var finid;

    $('#complaintTable').on('click', 'button.update', function(){
        var id = table.row($(this).parents('tr')).data().ID;
        finid = id;
        $.ajax({
            url : '/record_getstat/'+id,
            method : 'GET',
            data : {
                        _token : CSRF_TOKEN,
                        id : id
                    },
                    dataType : 'json',
                    success : function(response){
                        $('#stat').val(response[0].BrgyBlotter_Status).change();
                        $('#largeModal').modal('toggle');
                    }
        });
    });

    $('#complaintTable').on('click', 'button.delete', function(){
        var id = table.row($(this).parents('tr')).data().ID;
        $.ajax({
            url : '/record_delete/'+id,
            method: 'POST',
            data: {
                _token : CSRF_TOKEN,
                id : id,
                _method: 'DELETE'
            },
            success : function(response){
                if(response=="success"){
                    swal({
                            title : "Record Deleted",
                            type : "success",
                            timer : 1000,
                            showConfirmButton : false
                        });

                    table.ajax.reload();
                }
                else{
                    swal({
                            title : "Record not Deleted",
                            type : "error",
                            timer : 1500,
                            showConfirmButton : false
                        });

                }
            }
        });
    });


     $('#updatebtn').on('click', function(){
            $.ajax({
                url : '/record_update',
                method: 'POST',
                data:{
                    _token : CSRF_TOKEN,
                    id : finid,
                    stat : $('#stat').val()
                },
                success: function(){
                    swal({
                            title : "Record Update",
                            type : "success",
                            timer : 1000,
                            showConfirmButton : false
                        });
                    table.ajax.reload();
                    $('#largeModal').modal('toggle');
                }
            })
         });

})
</script>
</body>
</html>