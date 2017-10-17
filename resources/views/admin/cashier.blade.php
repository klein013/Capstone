<!DOCTYPE html>
<html>
<head>
    <title>Clearance | Cashier</title>
    @include('admin.layout.head');
    <link href="{{asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">

<style>
 
#keyboard {  
margin-left: 3%;  
padding: 10;  
list-style: none;  
}  
    #keyboard li {  
    float: left;  
    margin: 0 7px 7px 0;  
    width: 70px;  
    height: 60px;  
    font-size: 24px;
    line-height: 60px;  
    text-align: center;  
    background: #fff;  
    border: 1px solid black;  
    border-radius: 5px;  
    }  
        .capslock, .tab, .left-shift, .clearl, .switch {  
        clear: left;  
        }  
            

            #keyboard .switch {
            width: 223px;
            }
    
       
        , #keyboard .space, #keyboard .return{
        font-size: 16px;
        }
        #keyboard li:hover {  
        position: relative;  
        top: 1px;  
        left: 1px;  
        border-color: #e5e5e5;  
        cursor: pointer;  
        }  
</style>
</head>
<body class="theme-blue-grey">
    @include('admin.layout.nav');
    <br>
    <br>
    <br>
    <br>
    <br>
        <div class="container-fluid">

            <!-- Basic Table -->
            <div class="row clearfix">
           
                <div class="col-sm-8">
                <div class="row clearfix">
                    <div class="card">
                        <div class="body table-responsive">
                            <table class="table table-condensed table-hover table-striped table-bordered" id="unpaidTable">
                                <thead>
                                    <tr class="bg-blue-grey">
                                        <th>ID</th>
                                        <th>Resident Name</th>
                                        <th>Request Date</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        </div>
                    </div>

                
                <div class="row clearfix">
                    <div class="card">
                        <div class="body table-responsive">
                            <table class="table table-condensed table-hover table-striped table-bordered" id="paidTable">
                                <thead>
                                    <tr class="bg-blue-grey">
                                        <th>ID</th>
                                        <th>Resident Name</th>
                                        <th>Payment Date</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Receipt</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>                    
                </div>
                 <div class="col-sm-4">
                    <div class="card" >
                        <br>
                        <br>
                        <form id="trans">
                        <div class="row clearfix">
                            <div class="col-sm-12">
                            <div class="col-sm-4">
                                <label>Transaction Number</label>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" disabled class="form-control" id="tnum" name="tnum">
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <br>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="col-sm-4">
                                    <label>Resident Name</label>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" disabled class="form-control" id="rname" name="rname">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="col-sm-4">
                                    <label>Amount to Pay</label>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" disabled class="form-control" id="amtpay" name="amtpay">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="col-sm-4">
                                    <label>Amount Tendered</label>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="amtten" name="amtten">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="col-sm-4">
                                    <label>Change</label>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" disabled id="change" name="change">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="col-sm-3 col-sm-offset-9">
                                    <button type="submit" id="proceed" class="btn btn-lg bg-teal waves-effect">PROCEED</button>
                                </div>
                            </div>
                        </div>
                        </form>
                        <br>
                        <br>
                    </div>
                </div>
                
            </div>
        <div class="modal fade" tabindex="-1" role="dialog" id="updatemodal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <div class="row clearfix">
                                <div class="col-lg-7 col-md-3 col-sm-6 col-xs-12">
                                    <h4>Update Request</h4>
                                </div>
                            </div>
                </div>
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-sm-4">
                            <label id="name"></label>
                            <br>
                            <label id="transaction"></label>
                        </div>
                        <br>
                        <div class="col-sm-12">
                            <table class="table table-responsive table-bordered table-condensed table-hover table-striped" id="editTable">
                                <thead>
                                    <tr class="bg-teal">
                                        <td><label>Clearance ID</label></td>
                                        <td><label>Clearance Name</label></td>
                                        <td><label>Price</label></td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody id="editTablebody">
                                </tbody>
                            </table>
                        </div>
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

            var tblunpaid = $('#unpaidTable').DataTable({
            'bSort': false,
            'ajax': {
                'url' : '/clearance/payments/getunpaid',
                'method' : 'GET',
                'data' : 'json',
                'dataSrc' : function(json){
                    var return_data = new Array();
                        for(var i=0;i< json.length; i++){
                            return_data.push({
                            'ID' : json[i].request_transaction,
                            'Name' : json[i].name,
                            'Date' : json[i].trans_date,
                            'Price': (json[i].total).toFixed(2),
                            'Status': json[i].request_status,
                            'Button' : "<button class='update btn btn-space waves-effect bg-blue' value='"+json[i].request_transaction+"'><i class='material-icons'>create</i></button><button class='delete btn waves-effect bg-red' value='"+json[i].request_transaction+"'><i class='material-icons'>delete</i></button>"
                            });
                        }     
                        return return_data;
                }
            },
            'columns' : [
                {'data' : 'ID' },
                {'data' : 'Name' },
                {'data' : 'Date' },
                {'data' : 'Price' },
                {'data' : 'Status' },
                {'data' : 'Button' }
            ]
            });

            var tblpaid = $('#paidTable').DataTable({
            'bSort': false,
            'ajax': {
                'url' : '/clearance/payments/getpaid',
                'method' : 'GET',
                'data' : 'json',
                'dataSrc' : function(json){
                    var return_data = new Array();
                        for(var i=0;i< json.length; i++){
                            return_data.push({
                            'ID' : json[i].request_transaction,
                            'Name' : json[i].name,
                            'Date' : json[i].request_paymentdate,
                            'Price': (json[i].total).toFixed(2),
                            'Status': json[i].request_status,
                            'Button': '<button type="button" class="print btn btn-lg bg-black" value="'+json[i].request_transaction+'"><i class="material-icons">print</i></button>'
                            });
                        }     
                        return return_data;
                }
            },
            'columns' : [
                {'data' : 'ID' },
                {'data' : 'Name' },
                {'data' : 'Date' },
                {'data' : 'Price' },
                {'data' : 'Status' },
                {'data' : 'Button' }
            ]
            });

            $('#unpaidTable').on('click', 'button.delete', function(){
                tblunpaid.ajax.reload();
                var id = $(this).val();
            swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this record!",
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
                            url : '/clearance/clearance/removetrans/'+id,
                            method : 'DELETE',
                            data : {
                                _token : CSRF_TOKEN,
                                _method: 'DELETE'
                            },
                            success : function(response){
                                if(response=="success"){
                                $('#'+id+'row').remove();
                                 swal({
                                    title : "Deleted!", 
                                    text : "Record has been deleted",
                                    type :  "success",
                                    showConfirmButton : false,
                                    timer : 1000
                                });
                                 tblunpaid.ajax.reload();
                             }
                             else{
                                $('#'+id+'row').remove();
                                 swal({
                                    title : "Deleted!", 
                                    text : "Record has been deleted",
                                    type :  "success",
                                    showConfirmButton : false,
                                    timer : 1000
                                });
                                 tblunpaid.ajax.reload();
                             }
                            }
                        });
                    } 
                    else {
                        swal({
                            title : "Cancelled", 
                            text : "Record is not deleted",
                            type :  "error",
                            showConfirmButton : false,
                            timer : 1000
                        });
                    }
            });
            });

            $('#unpaidTable').on('click', 'button.update', function(){
                $.ajax({
                url : '/clearance/clearance/clearancedetails/'+$(this).val(),
                method: 'GET',
                data: {
                    _token : CSRF_TOKEN
                },
                dataType: 'json',
                success: function(response){
                    console.log(response);
                    var text = "";
                    for (var i = 0; i < response.length; i++) {
                        text += "<tr id='"+response[i].request_id+"row'><td>"+response[i].clearance_id+"</td><td>"+response[i].clearance_name+"</td><td>"+response[i].price_amt+"</td><td><button type='button' value='"+response[i].request_id+"'  class='delete1 btn btn-lg bg-red waves-effect pull-right'><i class='material-icons'>delete</i></button></td></tr>";
                    }
                    $('#editTablebody').empty();
                    $('#editTablebody').append(text);

                }
            });
            tblunpaid.ajax.reload();
            $('#updatemodal').modal('toggle');
            
            });

            $('#editTablebody').on('click', 'button.delete1', function(){
                var id = $(this).val();
            swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this record!",
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
                            url : '/clearance/clearance/removerequest/'+id,
                            method : 'DELETE',
                            data : {
                                _token : CSRF_TOKEN,
                                _method: 'DELETE'
                            },
                            success : function(response){
                                if(response=="success"){
                                $('#'+id+'row').remove();
                                 swal({
                                    title : "Deleted!", 
                                    text : "Record has been deleted",
                                    type :  "success",
                                    showConfirmButton : false,
                                    timer : 1000
                                });
                                 tblunpaid.ajax.reload();
                             }
                             else{
                                $('#'+id+'row').remove();
                                 swal({
                                    title : "Deleted!", 
                                    text : "Record has been deleted",
                                    type :  "success",
                                    showConfirmButton : false,
                                    timer : 1000
                                });
                                 tblunpaid.ajax.reload();
                             }
                            }
                        });
                    } 
                    else {
                        swal({
                            title : "Cancelled", 
                            text : "Record is not deleted",
                            type :  "error",
                            showConfirmButton : false,
                            timer : 1000
                        });
                    }
            });
            });

            $('#unpaidTable tbody').on('dblclick', 'tr', function(){

                var data = tblunpaid.row( this ).data();
                $('#tnum').val(data['ID']);
                $('#rname').val(data['Name']);
                $('#amtpay').val(data['Price']);
            });

            var amttopay = null;


            $('#amtten').on('keyup', function(){
                amttopay = $('#amtpay').val();
                $('#change').val(($('#amtten').val()-$('#amtpay').val()).toFixed(2));
            });


            $('#trans').validate({
            rules:{
                tnum:{
                    required: true
                },
                rname: {
                    required: true
                },
                amtpay: {
                    required: true,
                    number: true,
                    min: 0,
                    maxlength: 10
                },
                amtten: {
                    required: true,
                    number: true,
                    maxlength: 10,
                },
                change: {
                    min : 0,
                    required: true,
                }
            },
            submitHandler: function(form){
                var transnum = "";
                transnum = $('#tnum').val();
                var wala = $('#change').val();
                if(parseFloat(wala)<0){
                    alert("Please pay correctly");
                }
                else{
                $.ajax({
                    url: '/clearance/payments/pay',
                    method: 'POST',
                    data: {
                        _token : CSRF_TOKEN,
                        tnum : $('#tnum').val(),
                        amtpay : $('#amtpay').val(),
                        amtten : $('#amtten').val()
                    },
                    success: function(response) {

                        if(response=="success"){
                            $('#tnum').val("");
                            $('#rname').val("");
                            $('#amtpay').val("");
                            $('#amtten').val("");
                            $('#change').val("");                            

                            tblunpaid.ajax.reload();
                            tblpaid.ajax.reload();
                        }

                            
                            
                      
                    }
                });
                window.open(window.location.href+"/makereceipt/"+transnum,'_blank');
                }
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

            $('#paidTable tbody').on('click', 'button.print', function(){
                window.open(window.location.href+"/payreceipt/"+$(this).val(),'_blank');
                return false;
            });
        });
    </script>
</body>
</html>

