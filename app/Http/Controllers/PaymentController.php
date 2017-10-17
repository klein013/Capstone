<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use PDF;
use Response;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function index()
    {
    	$return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official'),'admin'=>Session::get('admin')];
        return view('admin.cashier')->with(array('return'=>$return));
    }

    public function getunpaid(){

        $unpaid = DB::select('select lpad(re.request_transaction,8,"0") as request_transaction, concat(r.resident_fname," ",r.resident_lname) as name, t.trans_date, sum(p.price_amt) as total, re.request_status from tbl_request re join tbl_resident r on r.resident_id = re.request_resident join tbl_clearancevalidity v on re.request_validity = v.validity_id join tbl_clearance c on c.clearance_id = v.clearance_id join tbl_price p on p.clearance_id = c.clearance_id join tbl_trans t on t.trans_id= re.request_transaction where re.request_status = "Unpaid" and t.trans_date between p.created_at and COALESCE(p.updated_at,now()) group by re.request_transaction');

        return response()->json($unpaid);
    }

    public function getpaid(){

        $paid = DB::select('select lpad(re.request_transaction,8,"0") as request_transaction, concat(r.resident_fname," ",r.resident_lname) as name, re.request_paymentdate, sum(p.price_amt) as total, re.request_status from tbl_request re join tbl_resident r on r.resident_id = re.request_resident join tbl_clearancevalidity v on re.request_validity = v.validity_id join tbl_clearance c on c.clearance_id = v.clearance_id join tbl_price p on c.clearance_id = p.clearance_id join tbl_trans t on t.trans_id = re.request_transaction where DATE(re.request_paymentdate) = curdate() and t.trans_date between p.created_at and coalesce(p.updated_at,now()) and re.request_status ="For Release" group by re.request_transaction');

        return response()->json($paid);
    }

    public function payment(Request $request){

        $newdate = date('Y-m-d H:i:s');
        DB::table('tbl_request')->where('request_transaction', $request->tnum)->update(['request_status'=> "For Release", 'request_paymentdate'=> $newdate]);

        $head = DB::select('select brgyinfo_name, brgyinfo_city, brgyinfo_region, brgyinfo_website, brgyinfo_email, brgyinfo_fb, brgyinfo_logo, brgyinfo_citylogo from tbl_brgyinfo');

        $bodies = DB::select(' select c.clearance_name, p.price_amt from tbl_clearance c join tbl_clearancevalidity v on v.clearance_id = c.clearance_id join tbl_request re on re.request_validity = v.validity_id join tbl_price p on p.clearance_id = c.clearance_id join tbl_trans t on t.trans_id = re.request_transaction where t.trans_date between p.created_at and coalesce(p.updated_at, now()) and re.request_transaction = '.$request->tnum);

        $row = "";

        foreach($bodies as $body){
            $row .= '<tr><td>1</td><td>'.$body->clearance_name.'</td><td style="text-align: right;">'.sprintf("%0.2f",$body->price_amt).'</td></tr>';
        }

        $row .= '<tr><td></td><td style="text-align: right;"><strong>Total</strong></td><td style="text-align: right;">'.sprintf("%0.2f",$request->amtpay).'</td></tr>';
        $row .= '<tr><td></td><td style="text-align: right;"><strong>Amount Tendered</strong></td><td style="text-align: right;">'.sprintf("%0.2f",$request->amtten).'</td></tr>';
        $row .= '<tr><td></td><td style="text-align: right;"><strong>Change</strong></td><td style="text-align: right;">'.sprintf("%0.2f",$request->amtten-$request->amtpay).'</td></tr>';
        
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
                                <p><strong>Transaction Number : </strong>'.$request->tnum.'</p>
                                <br>
                                <p><strong>Transaction Date: </strong>'.$newdate.'</p>
                            </div>
                            <div class="row">
                                <table style="width: 100%;">
                                    <tr>
                                        <th>Qty</th>
                                        <th>Item</th>
                                        <th>Price</th>
                                    </tr>'.$row.'
                                </table>
                            </div>
                        </div>
                    </body>
                </html>';
        
        session(['html'=> $html]);

        return response("success");
    }

    public function getreceipt($id){

        $filename = public_path()."/receipts/".$id.".pdf";

        return Response::make(file_get_contents($filename), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$id.'.pdf"'
        ]);

    
    }

    public function makereceipt($id){

        $pdf = PDF::loadHTML(Session::get('html'));
        $pdf->setPaper([0,0, 288, 576],'portrait');

        $pdf->save(public_path().'/receipts/'.$id.'.pdf');
        return $pdf->download($id.".pdf");
        
    }
}
