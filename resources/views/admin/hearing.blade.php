<!DOCTYPE html>
<html>
<head>
    <title>Clearance | Hearing</title>
    @include('admin.layout.head');
    <link href="{{asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
</head>
<style>
p {
  text-align: center;
  font-size: 20px;
}
</style>
<body class="theme-blue-grey">
@include('admin.layout.nav');
@include('admin.layout.aside');
    
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
                            <div class="text"><h3>HEARING</h3></div>
                        </div>
                    </div>
                </div>


            </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-9 col-md-4 col-sm-12 col-xs-12 col-md-offset-2">
                    <div class="card">
                        <div class="header">
                            <center><h2>
                                <b>HEARING</b>
                            </h2></center>
                        </div>
                        <div class="body">

                            <center><p id="demo"></p></center>
                            <form class="form-horizontal">
                
                            <div class="body">
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <b>Official ID</b>
                                    <div class="input-group">
                                        <div class="form-line">
                                                <input type="text" class="form-control" >
                                            </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <b>Hearing ID</b>
                                    <div class="input-group">
                                        <div class="form-line">
                                                <input type="text" class="form-control" >
                                            </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label for="email_address_2">Hearing Type</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Respondent/s</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Complainant/s</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text"  class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Witness/es</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label>Minutes</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <textarea rows="10" id="statement" class="form-control no-resize" placeholder="Please type the details" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                                
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>




@include('admin.layout.scripts');
    <script src="{{asset('plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('#requestTable').dataTable({
                "bSort" : false
            });
        });
    </script>
    <script>
// Set the date we're counting down to
var countDownDate = new Date("Jan 5, 2018 15:37:25").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
    
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="demo"
    document.getElementById("demo").innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s ";
    
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "EXPIRED";
    }
}, 1000);
</script>
</body>
</html>