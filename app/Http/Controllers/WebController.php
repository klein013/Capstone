<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use PDF;

class WebController extends Controller
{
   public function test(){

   		$head = DB::select('select brgyinfo_name, brgyinfo_city, brgyinfo_region, brgyinfo_website, brgyinfo_email, brgyinfo_fb, brgyinfo_logo, brgyinfo_citylogo from tbl_brgyinfo');

   		$foot = DB::select('select concat(r.resident_fname," ",coalesce(r.resident_mname,"")," ",r.resident_lname) as name, p.position_name from tbl_resident r join tbl_official o on o.resident_id = r.resident_id join tbl_position p on p.position_id = o.position_id where p.position_id = 1');

   		$html = '<html>
   					<head>
   						<style>
   						@font-face {
  							font-family: "RobotoRegular";
  							src: url("{{public_path()}}/Roboto/Roboto-Regular.ttf")  format("truetype")
						}
						body{
  							font-family: "RobotoRegular", sans-serif;
						}
						@page { margin: 0in 0in 0in 0in;} 
						</style>
   					</head>
   					<body>
   						<div style="margin: 50px 50px 0px 50px;">
   						<span><img src="'.$head[0]->brgyinfo_logo.'" style="width:130px; height: 130px; float:left;">
   						<img src="'.$head[0]->brgyinfo_citylogo.'" style="width:130px; height: 130px; margin-left: 566px; float:right;">
   						<center><p><strong>'.$head[0]->brgyinfo_name.'</strong><br>'.$head[0]->brgyinfo_city.', '.$head[0]->brgyinfo_region.'<br>
   						Email: '.$head[0]->brgyinfo_email.'<br>Website: '.$head[0]->brgyinfo_website.'<br>Facebook: '.$head[0]->brgyinfo_fb.'</p></center>
   						</span>
   						</div>
   						<div style="margin: 50px;">
   							<div style="width:250px; float:left;">
   								<p style="width: 250px;"><hr style="color:solid black 1px;"></p>
   								<br><p style="width: 250px;"><center>'.$foot[0]->name.'<br><strong>Applicant</strong></center></p>
   							</div>
   							<div style="width:250px; float:right; margin-left:196px;">
   							<p style="width: 250px;"><hr style="color:solid black 1px;"></p>
   							<br><p style="width: 250px;"><center>'.$foot[0]->name.'<br><strong>'.$foot[0]->position_name.'</strong></center></p>
   							</div>
   						</div>
   					</body>
   				</html>';
   		$pdf = PDF::loadHTML($html)->setPaper('letter', 'portrait');

   		return $pdf->stream();
   }

}
