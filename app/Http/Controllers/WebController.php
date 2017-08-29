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

        $body = DB::select('select c.clearance_type, p.price_amt from tbl_clearance c join tbl_request re on re.request_clearance = c.clearance_id join tbl_price p on p.price_id = c.clearance_price where re.request_transaction = 1');

        $html = '<html>
                    <head>
                        <style>
                        @font-face {
                            font-family: "RobotoRegular";
                            src: url("{{public_path()}}/Roboto/Roboto-Regular.ttf")  format("truetype")
                        }
                        body{
                            font-family: "RobotoRegular", sans-serif;
                            font-size: 8pt;
                        }
                        @page { margin: 0in 0in 0in 0in;} 
                        </style>
                    </head>
                    <body>
                        <div style="margin: 15px 15px 0px 15px;">
                        <span><img src="'.$head[0]->brgyinfo_logo.'" style="width:80px; height: 80px; float:left;">
                        <img src="'.$head[0]->brgyinfo_citylogo.'" style="width:80px; height: 80px; margin-left: 275px; float:right;">
                        <center><p><strong>'.$head[0]->brgyinfo_name.'</strong><br>'.$head[0]->brgyinfo_city.', '.$head[0]->brgyinfo_region.'<br>
                        Email: '.$head[0]->brgyinfo_email.'<br>Website: '.$head[0]->brgyinfo_website.'<br>Facebook: '.$head[0]->brgyinfo_fb.'</p></center>
                        </span>
                        </div>
                        <div style="margin: 15px 15px 0px 15px;">
                        	<div class="row">
                        		<p><strong>Cashier : </strong>'.Session::get('name').'</p>
                        	</div>
                        	<div class="row">
                        		<p><strong>Transaction Number : </strong>'.$request->trans.'</p>
                        	</div>
                        </div>
                    </body>
                </html>';
        $pdf = PDF::loadHTML($html);
        $pdf->setPaper([0,0, 288, 576],'portrait');
        return $pdf->stream();
   }

}
