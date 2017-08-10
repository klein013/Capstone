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
                    <img src="../../images/human.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$return['name']}}</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li class="user-header">
                            <div class="imgcontainer">
                                <img src="../../{{$return['image']}}" alt="Avatar" class="avatar">
                            </div>
                            </li>
                            <li><a href="{{URL('/profile')}}"><i class="material-icons">person</i>Profile</a></li>
                            <li><a href="{{URL('/')}}"><i class="material-icons">input</i>Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            @if($return['position']==0)
                @include('admin.aside_admin');
            @elseif($return['position'==1])
                @include('admin.aside_pb');
            @elseif($return['position_id'==2])
                @include('admin.aside_pb');
            @elseif($return['position_id'==3])
                @include('admin.aside_admin');
            @elseif($return['position_id'==4])
                @include('admin.aside_sec');
            @elseif($return['position_id'==5])
                @include('admin.aside_desk');
            @elseif($return['position_id'==6])
                @include('admin.aside_bpso');
            @elseif($return['position_id'==7])
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
                		<div class="header">
    	            			<h3>Barangay Payatas</h3>
            	    	</div>	
                		<div class="body" style="height:100%;">
                			<div class="col-md-12" id="myMap">
                			</div>
                		</div>
                	</div>
                </div>
            </div>
        </div>
	</section>
@include('admin.layout.scripts');
<script>
	  var map;
      function initMap() {
        var myLatLng = {lat: 14.715078, lng: 121.103241};

        map = new google.maps.Map(document.getElementById('myMap'), {
          zoom: 15,
          center: myLatLng,
          mapTypeId: google.maps.MapTypeId.HYBRID
        });

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: 'Hello World!'
        });

      }
    </script>
     <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJ_OtJXKaXF7UGSqnrjLAiA66uh2WH5hw&callback=initMap"
  type="text/javascript"></script>
  
</body>
</html>
