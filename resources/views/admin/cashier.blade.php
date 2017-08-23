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
                <div class="col-sm-9">
                <div class="row clearfix">
                    <div class="card">
                        <div class="body table-responsive">
                            <table class="table" id="requestTable">
                                <thead>
                                    <tr class="bg-blue-grey">
                                        <th>Resident ID</th>
                                        <th>Resident Name</th>
                                        <th>Type</th>
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
                            <table class="table" id="requestTable">
                                <thead>
                                    <tr class="bg-blue-grey">
                                        <th>Resident ID</th>
                                        <th>Resident Name</th>
                                        <th>Type</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>                    
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="container">  
                        <br><br>
                            <ul id="keyboard">   
                            <li class="letter">1</li>  
                            <li class="letter">2</li>  
                            <li class="letter">3</li>  
                            <li class="letter clearl">4</li>  
                            <li class="letter">5</li>  
                            <li class="letter">6</li> 
      
                            <li class="letter clearl">7</li>  
                            <li class="letter ">8</li>  
                            <li class="letter">9</li>
                            <li class="switch">0</li>
                            </ul>  
                        <br><br>
                        </div>  
                    </div>
                </div>
            </div>


@include('admin.layout.scripts');
    <script src="{{asset('plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
    <script>
        $(document).ready(function(){
        });
    </script>
</body>
</html>