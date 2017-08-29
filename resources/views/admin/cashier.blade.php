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
                <div class="col-sm-8">
                <div class="row clearfix">
                    <div class="card">
                        <div class="body table-responsive">
                            <table class="table" id="unpaidTable">
                                <thead>
                                    <tr class="bg-blue-grey">
                                        <th>ID</th>
                                        <th>Resident Name</th>
                                        <th>Request Date</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        </div>
                    </div>
                
                <div class="row clearfix">
                    <div class="card">
                        <div class="body table-responsive">
                            <table class="table" id="paidTable">
                                <thead>
                                    <tr class="bg-blue-grey">
                                        <th>ID</th>
                                        <th>Resident Name</th>
                                        <th>Payment Date</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                            </table>
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
                            'Status': json[i].request_status
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
                {'data' : 'Status' }
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

            $('#unpaidTable tbody').on('dblclick', 'tr', function(){

                var data = tblunpaid.row( this ).data();
                $('#tnum').val(data['ID']);
                $('#rname').val(data['Name']);
                $('#amtpay').val(data['Price']);
            });

            $('#amtten').on('keyup', function(){
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
                    maxlength: 10
                }
            },
            submitHandler: function(form){
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
                            swal({
                                title : "Success!", 
                                text : "Transaction Success",
                                type :  "success",
                                showConfirmButton : false,
                                timer : 1000
                            });
                            tblunpaid.ajax.reload();
                            tblpaid.ajax.reload();
                            
                            $('#tnum').val("");
                            $('#rname').val("");
                            $('#amtpay').val("");
                            $('#amtten').val("");
                            $('#change').val("");
                       }
                       else{
                            swal({
                                title : "Failed!", 
                                text : "Transaction Failed",
                                type :  "error",
                                showConfirmButton : false,
                                timer : 1000
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

            $('#paidTable tbody').on('click', 'button.print', function(){
                window.open(window.location.href+"/getreceipt/"+$(this).val(),'_blank');
                return false;
            });
        });
    </script>
</body>
</html>
