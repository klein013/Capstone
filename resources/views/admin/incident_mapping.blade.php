<!DOCTYPE html>
<html>
<head>
	<title>Blotter | Incident Mapping</title>
	@include('admin.layout.head');
	<style>
		#myMap{
			height: 500px;
		}
	</style>
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
                <div class="col-lg-5 col-md-5 col-sm-8 col-xs-12">
                    <div class="info-box bg-teal">
                        <div class="icon">
                            <i class="material-icons">pin_drop</i>
                        </div>
                        <div class="content">
                            <div class="text"><h3>INCIDENT MAPPING</h3></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <div class="card">
              	<div class="row clearfix">
                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                		<div class="body" style="height:150%;">
                        <form id="search">
                            <div class="row clearfix">
                                <div class="col-sm-3 col-sm-offset-5">   
                                <label>Categories</label>
                                <div class="form-group">
                                <div class="form-line">
                                <select class="form-control show-tick" id="incidentcat" name="incidentcat" multiple>
                                    @foreach($incidentcats as $incidentcat)
                                        <option value="{{$incidentcat->incidentcat_id}}">{{$incidentcat->incidentcat_name}}</option>
                                    @endforeach
                                </select>
                                </div>
                                </div>
                                </div>
                                <div class="col-sm-3">
                                    <label>Date<\s>:</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="Select a date" id="fdate" name="fdate">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <button class="btn bg-teal btn-lg waves-effect" id="search">SEARCH</button>
                                </div>
                            </div>
                        </form>
                            <div class="row clearfix">
                			<div class="col-sm-12" id="myMap">
                			</div>
                            </div>
                		</div>
                	</div>
                </div>
            </div>
        </div>
	</section>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJ_OtJXKaXF7UGSqnrjLAiA66uh2WH5hw&callback=initMap"
  type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OverlappingMarkerSpiderfier/1.0.3/oms.min.js"></script>
@include('admin.layout.scripts');
<script>

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

	

function initMap() {

        var limits = [];
        
        var infowindow;

        var map, i;
        var myLatLng = {lat: 14.7161486, lng: 121.101643};
        

        map = new google.maps.Map(document.getElementById('myMap'), {
          zoom: 15,
          center: myLatLng,
          mapTypeId: google.maps.MapTypeId.HYBRID
        });

    
    var oms = new OverlappingMarkerSpiderfier(map, { 
        markersWontMove: true, 
        markersWontHide: true,
        basicFormatEvents: true
    });

    infowindow = new google.maps.InfoWindow();
    

    var ctr = 0;  
    var final;

    $('#fdate').daterangepicker({
        autoUpdateInput: false,
        locale: {
            format: 'YYYY-MM-DD'
        },
        maxDate: moment()
    });

    $('#fdate').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD') + '|' + picker.endDate.format('YYYY-MM-DD'));
      final = $('#fdate').val().split('|');
    console.log(final);
    });

    $('#fdate').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
    });


    var ctr =0, last=0;
    var marker;
    $('#search').validate({
        rules:{
            fdate: {
                required: true
            },
            incidentcat: {
                required: true
            }
        },
        submitHandler: function(form){
            $.ajax({
                url: '/blotter/incident/getIncidentLoc',
                method: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    incidentcat: $('#incidentcat').val().join(),
                    fdate: final[0],
                    tdate: final[1]
                },
                dataType: 'json',
                success: function(response){
                    console.log(response[0].incident_id);
                    if(ctr!=0){
                        console.log(ctr+" "+last+" "+response.length);
                        for(i=0;i<last;i++){
                            marker[i].setMap(null);
                        }
                    }
                    marker = new Array(response.length);
                    for(i = 0; i < response.length; i++){
                        marker[i] = new google.maps.Marker({
                        position: new google.maps.LatLng(response[i].incident_lat, response[i].incident_long),
                            map: map
                        });


                        google.maps.event.addListener(marker[i], 'click', (function(marker, i) {
                            return function() {
                                infowindow.setContent('<div class="content"><div class="header"><h5>Incident ID: '+response[i].incident_id+'</h5><h5>Type: '+response[i].incidentcat_name+'</h5></div><div class="body"><p><b>Place</b> : '+response[i].place+'</p><p><b>Date and Time </b> : '+response[i].incident_datetime+'</p><p><b>Status </b>: '+response[i].incident_status+'</p><p><b>Notes</b> : '+response[i].incident_notes+'</p></div></div>');
                                infowindow.open(map, marker);
                            }
                        })(marker[i], i));
                        oms.addMarker(marker[i]);
                    }
                    ctr++;
                    last=response.length;
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
    })

    
}
</script>

  
</body>
</html>
