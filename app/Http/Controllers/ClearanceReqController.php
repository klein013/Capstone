<?php

namespace App\Http\Controllers;

use DB;
use App\Models\TblClearancereq;
use Illuminate\Http\Request;
use App\Http\Requests;
use Response;
use Illuminate\Support\Facedes\Input;
use Fpdf;

class ClearanceReqController extends Controller
{
 
    public function create()
    {
        $clearances = DB::select('select Clearance_ID, Clearance_Type from tbl_clearance');

        $residents = DB::select('select Resident_ID, concat(Resident_Fname," ",Resident_Lname) as "Resident_Name", Resident_Bdate, Resident_Sex, concat(Resident_House," ",Resident_Street) as Resident_Add, Resident_Image from tbl_residents');

        $requests = DB::select('select c.ClearanceReq_ID as ID, concat(r.Resident_Fname," ",r.Resident_Lname) as Name, t.Clearance_Type as Type, c.ClearanceReq_Purpose as Purpose, c.ClearanceReq_Status as Status, t.Clearance_ID as cid from tbl_clearancereq c join tbl_residents r on c.ClearanceReq_Resident = r.Resident_ID join tbl_clearance t on c.ClearanceReq_Type = t.Clearance_ID where c.ClearanceReq_Status <> "Finished" order by c.ClearanceReq_Status desc, 2 desc, c.ClearanceReq_Date desc');

        $return = ['name'=>Session::get('name') ,'image'=>Session::get('image'), 'position'=>Session::get('position'), 'official'=>Session::get('official')];

        return view('admin.clearance')->with(array('clearances'=>$clearances, 'residents'=>$residents, 'requests'=>$requests), 'return'=>$return);
    }

    public function store(Request $request)
    {
        $check = DB::select('select ClearanceReq_ID from tbl_clearancereq where (ClearanceReq_Resident = '.$request->id.' and ClearanceReq_Type = '.$request->ctype.' and ClearanceReq_Date = "'.date('Y-m-d').'") or (ClearanceReq_Resident = '.$request->id.' and ClearanceReq_Type = '.$request->ctype.' and ClearanceReq_Status in("Pending","On-going"))');

        $count = DB::select('select count(ClearanceReq_ID) as num from tbl_clearancereq where ClearanceReq_Resident = '.$request->id.' and ClearanceReq_Status in("Pending","On-going")');

        if(empty($check[0])){
            if($count[0]->num < 5){
                $req = new TblClearancereq;

                $date = date('Y-m-d', strtotime('+1 year'));
                $req->ClearanceReq_Resident = $request->id;
                $req->ClearanceReq_Type = $request->ctype;
                $req->ClearanceReq_Date = date('Y-m-d');
                $req->ClearanceReq_Expiry = $date;
                $req->ClearanceReq_Status = 'Pending';

                $req->save();

                $ret = DB::select('select c.ClearanceReq_ID as ID, concat(r.Resident_Fname," ",r.Resident_Lname) as Name, t.Clearance_Type as Type, c.ClearanceReq_Purpose as Purpose, c.ClearanceReq_Status as Status, t.Clearance_ID as cid from tbl_clearancereq c join tbl_residents r on c.ClearanceReq_Resident = r.Resident_ID join tbl_clearance t on c.ClearanceReq_Type = t.Clearance_ID where c.ClearanceReq_ID = "'.$req->ClearanceReq_ID.'"');
                return response()->json($ret);
            }
            else{
                return response()->json("too many");
            }
        }
        else{
            if($count[0]->num <5){
                return response()->json(null);
            }
            else{
                return response()->json("too many");
            }
        }
    }

    public function destroy(Request $id)
    {
        $req = TblClearancereq::findOrFail($id);
        $req->delete();

        return null;
    }

    public function get_residency($id){
        $doc = DB::select('select ClearanceReq_Doc from tbl_clearancereq where ClearanceReq_ID = '.$id);

        $file= public_path(). "/".$doc[0]->ClearanceReq_Doc;

        $headers = array(
              'Content-Type: application/pdf',
        );

        return response()->download($file, $id.'.pdf', $headers);

    }

    public function get_indigency($id){
        $doc = DB::select('select ClearanceReq_Doc from tbl_clearancereq where ClearanceReq_ID = '.$id);

        $file= public_path(). "/".$doc[0]->ClearanceReq_Doc;

        $headers = array(
              'Content-Type: application/pdf',
        );

        return response()->download($file, $id.'.pdf', $headers);

    }

    public function get_transpo($id){
        $doc = DB::select('select ClearanceReq_Doc from tbl_clearancereq where ClearanceReq_ID = '.$id);

        $file= public_path(). "/".$doc[0]->ClearanceReq_Doc;

        $headers = array(
              'Content-Type: application/pdf',
        );

        return response()->download($file, $id.'.pdf', $headers);

    }

    public function get_businessa($id){
        $doc = DB::select('select ClearanceReq_Doc from tbl_clearancereq where ClearanceReq_ID = '.$id);

        $file= public_path(). "/".$doc[0]->ClearanceReq_Doc;

        $headers = array(
              'Content-Type: application/pdf',
        );

        return response()->download($file, $id.'.pdf', $headers);

    }

    public function get_businessb($id){
        $doc = DB::select('select ClearanceReq_Doc from tbl_clearancereq where ClearanceReq_ID = '.$id);

        $file= public_path(). "/".$doc[0]->ClearanceReq_Doc;

        $headers = array(
              'Content-Type: application/pdf',
        );

        return response()->download($file, $id.'.pdf', $headers);

    }

    public function get_businessc($id){
        $doc = DB::select('select ClearanceReq_Doc from tbl_clearancereq where ClearanceReq_ID = '.$id);

        $file= public_path(). "/".$doc[0]->ClearanceReq_Doc;

        $headers = array(
              'Content-Type: application/pdf',
        );

        return response()->download($file, $id.'.pdf', $headers);

    }

    public function get_businessd($id){
        $doc = DB::select('select ClearanceReq_Doc from tbl_clearancereq where ClearanceReq_ID = '.$id);

        $file= public_path(). "/".$doc[0]->ClearanceReq_Doc;

        $headers = array(
              'Content-Type: application/pdf',
        );

        return response()->download($file, $id.'.pdf', $headers);

    }

    public function get_businesse($id){
        $doc = DB::select('select ClearanceReq_Doc from tbl_clearancereq where ClearanceReq_ID = '.$id);

        $file= public_path(). "/".$doc[0]->ClearanceReq_Doc;

        $headers = array(
              'Content-Type: application/pdf',
        );

        return response()->download($file, $id.'.pdf', $headers);

    }

    public function get_noDerogatory($id){
        $doc = DB::select('select ClearanceReq_Doc from tbl_clearancereq where ClearanceReq_ID = '.$id);

        $file= public_path(). "/".$doc[0]->ClearanceReq_Doc;

        $headers = array(
              'Content-Type: application/pdf',
        );

        return response()->download($file, $id.'.pdf', $headers);

    }

    public function get_water($id){
        $doc = DB::select('select ClearanceReq_Doc from tbl_clearancereq where ClearanceReq_ID = '.$id);

        $file= public_path(). "/".$doc[0]->ClearanceReq_Doc;

        $headers = array(
              'Content-Type: application/pdf',
        );

        return response()->download($file, $id.'.pdf', $headers);

    }

    public function get_electric($id){
        $doc = DB::select('select ClearanceReq_Doc from tbl_clearancereq where ClearanceReq_ID = '.$id);

        $file= public_path(). "/".$doc[0]->ClearanceReq_Doc;

        $headers = array(
              'Content-Type: application/pdf',
        );

        return response()->download($file, $id.'.pdf', $headers);

    }

    public function get_construction($id){
        $doc = DB::select('select ClearanceReq_Doc from tbl_clearancereq where ClearanceReq_ID = '.$id);

        $file= public_path(). "/".$doc[0]->ClearanceReq_Doc;

        $headers = array(
              'Content-Type: application/pdf',
        );

        return response()->download($file, $id.'.pdf', $headers);

    }

    public function get_excavation($id){
        $doc = DB::select('select ClearanceReq_Doc from tbl_clearancereq where ClearanceReq_ID = '.$id);

        $file= public_path(). "/".$doc[0]->ClearanceReq_Doc;

        $headers = array(
              'Content-Type: application/pdf',
        );

        return response()->download($file, $id.'.pdf', $headers);

    }
    public function create_noDerogatory(Request $request){
        $details = DB::select('select * from tbl_brgyinfo');
        $resdetails = DB::select(' select Resident_Fname, Resident_Lname, Resident_Image, Resident_House, Resident_Street, Resident_Area ,Resident_Year from tbl_residents join tbl_clearancereq on Resident_ID=ClearanceReq_Resident where ClearanceReq_ID = '.$request->id);

        $pdf = new Fpdf();        
        $pdf::AddPage("P","Letter");
        $pdf::setMargins(2.54,2.54,2.54);
        $pdf::SetFont('Arial','',12);
        $pdf::Image('../public/'.$details[0]->BrgyInfo_Image ,10,10,30);
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Barangay ".$details[0]->BrgyInfo_Name,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"District 2, Quezon City",0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Email: ".$details[0]->BrgyInfo_Email,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Website: ".$details[0]->BrgyInfo_Web,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(142.875);
        $pdf::Image('../public/'.$resdetails[0]->Resident_Image,171.45,60,30);
        $pdf::Ln();
        $pdf::Ln();
        $text = "\n\n\n\n\nTO WHOM IT MAY CONCERN:\n\n      THIS IS TO CERTIFY THAT ".$resdetails[0]->Resident_Fname." ".$resdetails[0]->Resident_Lname." of legal age, filipino is a bonafide resident of ".$resdetails[0]->Resident_House." ".$resdetails[0]->Resident_Street." Street, ".$resdetails[0]->Resident_Area.",".$details[0]->BrgyInfo_Name." ,Quezon City since ".$resdetails[0]->Resident_Year." up to present\n\n      THIS FURTHER CERTIFIES that upon verificatio of records filed in this office, the subject inidividual was a person of good standing in the community with good moral character and found to have\n\n                      NO DEROGATORY RECORD ON FILE\n\n        THIS CERTIFICATION is being issued upon the request for securing clearance of  RESIDENCY for ".$request->purpose.".\n\n       ISSUED this ".date('jS \of F Y')." at Barangay ".$details[0]->BrgyInfo_Name." Quezon City.";

        $pdf::Cell(47.625);
        $pdf::MultiCell(142.875,7,$text,0,"L");

        DB::table('tbl_clearancereq')->where('ClearanceReq_ID',$request->id)->update(['ClearanceReq_Status' => 'Done','ClearanceReq_Doc' => 'clearances/'.$request->id.'.pdf', 'ClearanceReq_Purpose' => $request->purpose]);

        $pdf::Output('../public/clearances/'.$request->id.".pdf","F");
        $pdf::Output($request->id.".pdf", "D");
        exit();
    }

    public function create_indigency(Request $request){
        $details = DB::select('select * from tbl_brgyinfo');
        $resdetails = DB::select(' select Resident_Fname, Resident_Lname, Resident_Image, Resident_House, Resident_Street, Resident_Area ,Resident_Year from tbl_residents join tbl_clearancereq on Resident_ID=ClearanceReq_Resident where ClearanceReq_ID = '.$request->id);

        $pdf = new Fpdf();        
        $pdf::AddPage("P","Letter");
        $pdf::setMargins(2.54,2.54,2.54);
        $pdf::SetFont('Arial','',12);
        $pdf::Image('../public/'.$details[0]->BrgyInfo_Image ,10,10,30);
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Barangay ".$details[0]->BrgyInfo_Name,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"District 2, Quezon City",0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Email: ".$details[0]->BrgyInfo_Email,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Website: ".$details[0]->BrgyInfo_Web,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(142.875);
        $pdf::Image('../public/'.$resdetails[0]->Resident_Image,171.45,60,30);
        $pdf::Ln();
        $pdf::Ln();
        $text = "\n\n\n\n\n\n\n\n\n\nTO WHOM IT MAY CONCERN\n\n   THIS IS TO CERTIFY THAT ".$resdetails[0]->Resident_Fname." ".$resdetails[0]->Resident_Lname." is a bonafide resident of ".$resdetails[0]->Resident_House." ".$resdetails[0]->Resident_Street." Street, ".$resdetails[0]->Resident_Area.", ".$details[0]->BrgyInfo_Name." ,Quezon City since ".$resdetails[0]->Resident_Year." up to present, a known depresser area of this barangay were residents belong to low income bracket.\n\n     THE ".$resdetails[0]->Resident_Lname." family income falls below the poverty level, just to sustain their daily subsistence and could hardly afford to defray additional expenses.\n\n  THIS CERTIFICATION is being issued upon the request of the abovementioned name as requirement for ".$request->purpose.".\n\n    ISSUED this ".date('jS \of F Y')." at Barangay ".$details[0]->BrgyInfo_Name." Quezon City";

        $pdf::Cell(47.625);
        $pdf::MultiCell(142.875,7,$text,0,"L");

        DB::table('tbl_clearancereq')->where('ClearanceReq_ID',$request->id)->update(['ClearanceReq_Status' => 'Done','ClearanceReq_Doc' => 'clearances/'.$request->id.'.pdf', 'ClearanceReq_Purpose' => $request->purpose]);

        $pdf::Output('../public/clearances/'.$request->id.".pdf","F");
        $pdf::Output($request->id.".pdf", "D");
        exit();
    }

    public function create_residency(Request $request){
        $details = DB::select('select * from tbl_brgyinfo');
        $resdetails = DB::select(' select Resident_Fname, Resident_Lname, Resident_Image, Resident_House, Resident_Street, Resident_Area ,Resident_Year from tbl_residents join tbl_clearancereq on Resident_ID=ClearanceReq_Resident where ClearanceReq_ID = '.$request->id);

        $pdf = new Fpdf();        
        $pdf::AddPage("P","Letter");
        $pdf::setMargins(2.54,2.54,2.54);
        $pdf::SetFont('Arial','',12);
        $pdf::Image('../public/'.$details[0]->BrgyInfo_Image ,10,10,30);
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Barangay ".$details[0]->BrgyInfo_Name,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"District 2, Quezon City",0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Email: ".$details[0]->BrgyInfo_Email,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Website: ".$details[0]->BrgyInfo_Web,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(142.875);
        $pdf::Image('../public/'.$resdetails[0]->Resident_Image,171.45,60,30);
        $pdf::Ln();
        $pdf::Ln();
        $text = "\n\n\n\n\n\n\n\n\n\n   THIS IS TO CERTIFY THAT ".$resdetails[0]->Resident_Fname." ".$resdetails[0]->Resident_Lname." of legal age, filipino is a bonafide resident of ".$resdetails[0]->Resident_House." ".$resdetails[0]->Resident_Street." Street, ".$resdetails[0]->Resident_Area.", ".$details[0]->BrgyInfo_Name." ,Quezon City since ".$resdetails[0]->Resident_Year." up to present\n\n  THIS CERTIFICATION is being issued upon the request of the subject resident for securing clearance for ".$request->purpose.".\n\n    ISSUED this ".date('jS \of F Y')." at Barangay ".$details[0]->BrgyInfo_Name." Quezon City\n\n\n ____________________\nApplicants Signature";

        $pdf::Cell(47.625);
        $pdf::MultiCell(142.875,7,$text,0,"L");

        DB::table('tbl_clearancereq')->where('ClearanceReq_ID',$request->id)->update(['ClearanceReq_Status' => 'Done','ClearanceReq_Doc' => 'clearances/'.$request->id.'.pdf', 'ClearanceReq_Purpose' => $request->purpose]);

        $pdf::Output('../public/clearances/'.$request->id.".pdf","F");
        $pdf::Output($request->id.".pdf", "D");
        exit();
    }

    public function create_businessliquor(Request $request){
        $resdetails = DB::select('select Resident_Fname, Resident_Lname, Resident_Image, Resident_House, Resident_Street, Resident_Area, ClearanceReq_Status from tbl_residents join tbl_clearancereq on Resident_ID=ClearanceReq_Resident where ClearanceReq_ID = '.$request->id);
        if($resdetails[0]->ClearanceReq_Status!="Done"){
            $details = DB::select('select * from tbl_brgyinfo');    
            $pdf = new Fpdf();        
            $pdf::AddPage("P","Letter");
            $pdf::setMargins(2.54,2.54,2.54);
            $pdf::SetFont('Arial','',12);
            $pdf::Image('../public/'.$details[0]->BrgyInfo_Image ,10,10,30);
            $pdf::Ln();
            $pdf::Cell(55.4);
            $pdf::Cell(109.7,7,"Barangay ".$details[0]->BrgyInfo_Name,0,0,"C");
            $pdf::Ln();
            $pdf::Cell(55.4);
            $pdf::Cell(109.7,7,"District 2, Quezon City",0,0,"C");
            $pdf::Ln();
            $pdf::Cell(55.4);
            $pdf::Cell(109.7,7,"Email: ".$details[0]->BrgyInfo_Email,0,0,"C");
            $pdf::Ln();
            $pdf::Cell(55.4);
            $pdf::Cell(109.7,7,"Website: ".$details[0]->BrgyInfo_Web,0,0,"C");
            $pdf::Image('../public/'.$resdetails[0]->Resident_Image,171.45,60,30);
            $pdf::Ln();
            $pdf::Ln();
            $text = "\n\n\n\n\nThe Chairman/ Executive Officer\nLiquor Licensing and Regulatory Board\nQuezon City\n\n   This is to certify that this office interpose no objection to the application of ".$resdetails[0]->Resident_Fname." ".$resdetails[0]->Resident_Lname." of ".$resdetails[0]->Resident_House." ".$resdetails[0]->Resident_Street." Street, ".$resdetails[0]->Resident_Area.", ".$details[0]->BrgyInfo_Name." ,Quezon City up to time allowed by the Quezon City Ordinance No. NC-85-s-98.\n\n  Application for securing Permit is hereby granted subject to the following condition:\n\n A. That this establishment is more than 50 meters away from an academic school(Sec. 17, Ord. 85)\nB. That this business establishment is not erected on a public sidewalk, street, avenue, park or plaza, on a government(Sec. 17, Ord. 85).\nC. That this establishment is not nuissance to the public safety and order. D. That the proprietor/owner are good moral character.\n\n    ISSUED this ".date('jS \of F Y')." at Barangay ".$details[0]->BrgyInfo_Name." Quezon City.";

            $pdf::Cell(47.625);
            $pdf::MultiCell(142.875,7,$text,0,"L");

            DB::table('tbl_clearancereq')->where('ClearanceReq_ID',$request->id)->update(['ClearanceReq_Status' => 'Done','ClearanceReq_Doc' => 'clearances/'.$request->id.'.pdf']);

            $pdf::Output('../public/clearances/'.$request->id.".pdf","F");
            $pdf::Output($request->id.".pdf", "D");
            exit();
        }   
        else{
            $doc = DB::select('select ClearanceReq_Doc from tbl_clearancereq where ClearanceReq_ID = '.$request->id);

            $file= public_path(). "/".$doc[0]->ClearanceReq_Doc;

            $headers = array(
                  'Content-Type: application/pdf',
            );

            return response()->download($file, $request->id.'.pdf', $headers);            
        }
    }

    public function create_transpo(Request $request){
        $resdetails = DB::select('select Resident_Fname, Resident_Lname, Resident_Image, Resident_House, Resident_Street, Resident_Area from tbl_residents join tbl_clearancereq on Resident_ID=ClearanceReq_Resident where ClearanceReq_ID = '.$request->id);
        $details = DB::select('select * from tbl_brgyinfo');
        $pdf = new Fpdf();        
        $pdf::AddPage("P","Letter");
        $pdf::setMargins(2.54,2.54,2.54);
        $pdf::SetFont('Arial','',12);
        $pdf::Image('../public/'.$details[0]->BrgyInfo_Image ,10,10,30);
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Barangay ".$details[0]->BrgyInfo_Name,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"District 2, Quezon City",0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Email: ".$details[0]->BrgyInfo_Email,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Website: ".$details[0]->BrgyInfo_Web,0,0,"C");
        $pdf::Image('../public/'.$resdetails[0]->Resident_Image,171.45,60,30);
        $pdf::Ln();
        $pdf::Ln();
        $text = "\n\n\n\n\n\n\nTO WHOM IT MAY CONCERN:\n\n      THIS IS TO CERTIFY that ".$resdetails[0]->Resident_Fname." ".$resdetails[0]->Resident_Lname." of legal age, Filipino and resident of ".$resdetails[0]->Resident_House." ".$resdetails[0]->Resident_Street." Street, ".$resdetails[0]->Resident_Area.", ".$details[0]->BrgyInfo_Name." ,Quezon City and bonafide member of ".$request->toda.".\n\n      This office interpose no objection to the application of PUBLIC MOTORIZED TRICYCLE/UTILITY MOTORIZED TRICYCLE for franchise NEW/RENEWAL of application to operate herein describe within the Barangay subject to provisions:\n\nMaker/ Type : ".$request->maker."\nMotor Number : ".$request->motor."\nChassis Number : ".$request->chassis."\nPlate Number : ".$request->plate."\nBody Number : ".$request->body."\nColor Code : ".$request->color."\nTODA : ".$request->toda."\n\n        ISSUED this ".date('jS \of F Y')." at Barangay ".$details[0]->BrgyInfo_Name." Quezon City.";

        $pdf::Cell(47.625);
        $pdf::MultiCell(142.875,7,$text,0,"L");

        DB::table('tbl_clearancereq')->where('ClearanceReq_ID',$request->id)->update(['ClearanceReq_Status' => 'Done','ClearanceReq_Doc' => 'clearances/'.$request->id.'.pdf']);

        $pdf::Output('../public/clearances/'.$request->id.".pdf","F");
        $pdf::Output($request->id.".pdf", "D");
        exit();
    }

    public function create_businessa(Request $request){
        $details = DB::select('select * from tbl_brgyinfo');
        $resdetails = DB::select(' select Resident_Fname, Resident_Lname, Resident_Image, Resident_House, Resident_Street, Resident_Area ,Resident_Year from tbl_residents join tbl_clearancereq on Resident_ID=ClearanceReq_Resident where ClearanceReq_ID = '.$request->id);

        $pdf = new Fpdf();        
        $pdf::AddPage("P","Letter");
        $pdf::setMargins(2.54,2.54,2.54);
        $pdf::SetFont('Arial','',12);
        $pdf::Image('../public/'.$details[0]->BrgyInfo_Image ,10,10,30);
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Barangay ".$details[0]->BrgyInfo_Name,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"District 2, Quezon City",0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Email: ".$details[0]->BrgyInfo_Email,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Website: ".$details[0]->BrgyInfo_Web,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(142.875);
        $pdf::Image('../public/'.$resdetails[0]->Resident_Image,171.45,30,30);
        $pdf::Ln();
        $pdf::Ln();
        $text = "\n\n\nTO WHOM IT MAY CONCERN\n\n   THIS IS TO CERTIFY THAT this Office hereby approves the herein application of ".$resdetails[0]->Resident_Fname." ".$resdetails[0]->Resident_Lname." of legal age, Filipino and a bonafide resident of ".$resdetails[0]->Resident_House." ".$resdetails[0]->Resident_Street." Street, ".$resdetails[0]->Resident_Area.", ".$details[0]->BrgyInfo_Name." ,Quezon City for a clearance to engage/ or operate and/ new or renew the business, ".$request->purpose." located in this barangay.\n\n       THIS FURTHER CERTIFIES that the nature of the business does not destroy moral values of its residents especially the youth and the children, nor does it cause the breach of peace and order and harmony in the barangay, nor endangers the safety and health of its constituents, nor unnecessarily destroys the environment to the detriment of the residents thereof.\n\n        THIS FURTHERMORE CERTIFIES that the applicant shall be abide all pertinent ordinances of this barangay are hereby complied with and shall henceforth be observed with due respect and obidience to the local authorities.\n\n       This certification is being issued upon the request of ".$resdetails[0]->Resident_Fname." ".$resdetails[0]->Resident_Lname." for presentation to the Market Development and Administration Department - Business Permits and License Unit (MDAD- BPLU), Quezon City Hall, which is a prerequisites in the issuance of any permit and/ or license for said business activity, pursuant to Sec. 73 of Quezon City Revenue Code.\n\n    ISSUED this ".date('jS \of F Y')." at Barangay ".$details[0]->BrgyInfo_Name." District 2, Quezon City, Philippines";

        $pdf::Cell(47.625);
        $pdf::MultiCell(142.875,7,$text,0,"L");

        DB::table('tbl_clearancereq')->where('ClearanceReq_ID',$request->id)->update(['ClearanceReq_Status' => 'Done','ClearanceReq_Doc' => 'clearances/'.$request->id.'.pdf', 'ClearanceReq_Purpose' => $request->purpose]);

        $pdf::Output('../public/clearances/'.$request->id.".pdf","F");
        $pdf::Output($request->id.".pdf", "D");
        exit();
    }

    public function create_businessb(Request $request){
        $details = DB::select('select * from tbl_brgyinfo');
        $resdetails = DB::select(' select Resident_Fname, Resident_Lname, Resident_Image, Resident_House, Resident_Street,Resident_Area, Resident_Year from tbl_residents join tbl_clearancereq on Resident_ID=ClearanceReq_Resident where ClearanceReq_ID = '.$request->id);

        $pdf = new Fpdf();        
        $pdf::AddPage("P","Letter");
        $pdf::setMargins(2.54,2.54,2.54);
        $pdf::SetFont('Arial','',12);
        $pdf::Image('../public/'.$details[0]->BrgyInfo_Image ,10,10,30);
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Barangay ".$details[0]->BrgyInfo_Name,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"District 2, Quezon City",0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Email: ".$details[0]->BrgyInfo_Email,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Website: ".$details[0]->BrgyInfo_Web,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(142.875);
        $pdf::Image('../public/'.$resdetails[0]->Resident_Image,171.45,30,30);
        $pdf::Ln();
        $pdf::Ln();
        $text = "\n\n\nTO WHOM IT MAY CONCERN\n\n   THIS IS TO CERTIFY THAT this Office hereby approves the herein application of ".$resdetails[0]->Resident_Fname." ".$resdetails[0]->Resident_Lname." of legal age, Filipino and a bonafide resident of ".$resdetails[0]->Resident_House." ".$resdetails[0]->Resident_Street." Street, ".$resdetails[0]->Resident_Area.", ".$details[0]->BrgyInfo_Name." ,Quezon City for a clearance to engage/ or operate and/ new or renew the business, ".$request->purpose." located in this barangay.\n\n       THIS FURTHER CERTIFIES that the nature of the business does not destroy moral values of its residents especially the youth and the children, nor does it cause the breach of peace and order and harmony in the barangay, nor endangers the safety and health of its constituents, nor unnecessarily destroys the environment to the detriment of the residents thereof.\n\n        THIS FURTHERMORE CERTIFIES that the applicant shall be abide all pertinent ordinances of this barangay are hereby complied with and shall henceforth be observed with due respect and obidience to the local authorities.\n\n       This certification is being issued upon the request of ".$resdetails[0]->Resident_Fname." ".$resdetails[0]->Resident_Lname." for presentation to the Market Development and Administration Department - Business Permits and License Unit (MDAD- BPLU), Quezon City Hall, which is a prerequisites in the issuance of any permit and/ or license for said business activity, pursuant to Sec. 73 of Quezon City Revenue Code.\n\n    ISSUED this ".date('jS \of F Y')." at Barangay ".$details[0]->BrgyInfo_Name." District 2, Quezon City, Philippines";

        $pdf::Cell(47.625);
        $pdf::MultiCell(142.875,7,$text,0,"L");

        DB::table('tbl_clearancereq')->where('ClearanceReq_ID',$request->id)->update(['ClearanceReq_Status' => 'Done','ClearanceReq_Doc' => 'clearances/'.$request->id.'.pdf', 'ClearanceReq_Purpose' => $request->purpose]);

        $pdf::Output('../public/clearances/'.$request->id.".pdf","F");
        $pdf::Output($request->id.".pdf", "D");
        exit();
    }

    public function create_businessc(Request $request){
        $details = DB::select('select * from tbl_brgyinfo');
        $resdetails = DB::select(' select Resident_Fname, Resident_Lname, Resident_Image, Resident_House, Resident_Street,Resident_Area, Resident_Year from tbl_residents join tbl_clearancereq on Resident_ID=ClearanceReq_Resident where ClearanceReq_ID = '.$request->id);

        $pdf = new Fpdf();        
        $pdf::AddPage("P","Letter");
        $pdf::setMargins(2.54,2.54,2.54);
        $pdf::SetFont('Arial','',12);
        $pdf::Image('../public/'.$details[0]->BrgyInfo_Image ,10,10,30);
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Barangay ".$details[0]->BrgyInfo_Name,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"District 2, Quezon City",0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Email: ".$details[0]->BrgyInfo_Email,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Website: ".$details[0]->BrgyInfo_Web,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(142.875);
        $pdf::Image('../public/'.$resdetails[0]->Resident_Image,171.45,30,30);
        $pdf::Ln();
        $pdf::Ln();
        $text = "\n\n\nTO WHOM IT MAY CONCERN\n\n   THIS IS TO CERTIFY THAT this Office hereby approves the herein application of ".$resdetails[0]->Resident_Fname." ".$resdetails[0]->Resident_Lname." of legal age, Filipino and a bonafide resident of ".$resdetails[0]->Resident_House." ".$resdetails[0]->Resident_Street." Street, ".$resdetails[0]->Resident_Area.", ".$details[0]->BrgyInfo_Name." ,Quezon City for a clearance to engage/ or operate and/ new or renew the business, ".$request->purpose." located in this barangay.\n\n       THIS FURTHER CERTIFIES that the nature of the business does not destroy moral values of its residents especially the youth and the children, nor does it cause the breach of peace and order and harmony in the barangay, nor endangers the safety and health of its constituents, nor unnecessarily destroys the environment to the detriment of the residents thereof.\n\n        THIS FURTHERMORE CERTIFIES that the applicant shall be abide all pertinent ordinances of this barangay are hereby complied with and shall henceforth be observed with due respect and obidience to the local authorities.\n\n       This certification is being issued upon the request of ".$resdetails[0]->Resident_Fname." ".$resdetails[0]->Resident_Lname." for presentation to the Market Development and Administration Department - Business Permits and License Unit (MDAD- BPLU), Quezon City Hall, which is a prerequisites in the issuance of any permit and/ or license for said business activity, pursuant to Sec. 73 of Quezon City Revenue Code.\n\n    ISSUED this ".date('jS \of F Y')." at Barangay ".$details[0]->BrgyInfo_Name." District 2, Quezon City, Philippines";

        $pdf::Cell(47.625);
        $pdf::MultiCell(142.875,7,$text,0,"L");

        DB::table('tbl_clearancereq')->where('ClearanceReq_ID',$request->id)->update(['ClearanceReq_Status' => 'Done','ClearanceReq_Doc' => 'clearances/'.$request->id.'.pdf', 'ClearanceReq_Purpose' => $request->purpose]);

        $pdf::Output('../public/clearances/'.$request->id.".pdf","F");
        $pdf::Output($request->id.".pdf", "D");
        exit();
    }    

    public function create_businessd(Request $request){
        $details = DB::select('select * from tbl_brgyinfo');
        $resdetails = DB::select(' select Resident_Fname, Resident_Lname, Resident_Image, Resident_House, Resident_Street, Resident_Area,Resident_Year from tbl_residents join tbl_clearancereq on Resident_ID=ClearanceReq_Resident where ClearanceReq_ID = '.$request->id);

        $pdf = new Fpdf();        
        $pdf::AddPage("P","Letter");
        $pdf::setMargins(2.54,2.54,2.54);
        $pdf::SetFont('Arial','',12);
        $pdf::Image('../public/'.$details[0]->BrgyInfo_Image ,10,10,30);
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Barangay ".$details[0]->BrgyInfo_Name,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"District 2, Quezon City",0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Email: ".$details[0]->BrgyInfo_Email,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Website: ".$details[0]->BrgyInfo_Web,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(142.875);
        $pdf::Image('../public/'.$resdetails[0]->Resident_Image,171.45,30,30);
        $pdf::Ln();
        $pdf::Ln();
        $text = "\n\n\nTO WHOM IT MAY CONCERN\n\n   THIS IS TO CERTIFY THAT this Office hereby approves the herein application of ".$resdetails[0]->Resident_Fname." ".$resdetails[0]->Resident_Lname." of legal age, Filipino and a bonafide resident of ".$resdetails[0]->Resident_House." ".$resdetails[0]->Resident_Street." Street, ".$resdetails[0]->Resident_Area.", ".$details[0]->BrgyInfo_Name." ,Quezon City for a clearance to engage/ or operate and/ new or renew the business, ".$request->purpose." located in this barangay.\n\n       THIS FURTHER CERTIFIES that the nature of the business does not destroy moral values of its residents especially the youth and the children, nor does it cause the breach of peace and order and harmony in the barangay, nor endangers the safety and health of its constituents, nor unnecessarily destroys the environment to the detriment of the residents thereof.\n\n        THIS FURTHERMORE CERTIFIES that the applicant shall be abide all pertinent ordinances of this barangay are hereby complied with and shall henceforth be observed with due respect and obidience to the local authorities.\n\n       This certification is being issued upon the request of ".$resdetails[0]->Resident_Fname." ".$resdetails[0]->Resident_Lname." for presentation to the Market Development and Administration Department - Business Permits and License Unit (MDAD- BPLU), Quezon City Hall, which is a prerequisites in the issuance of any permit and/ or license for said business activity, pursuant to Sec. 73 of Quezon City Revenue Code.\n\n    ISSUED this ".date('jS \of F Y')." at Barangay ".$details[0]->BrgyInfo_Name." District 2, Quezon City, Philippines";

        $pdf::Cell(47.625);
        $pdf::MultiCell(142.875,7,$text,0,"L");

        DB::table('tbl_clearancereq')->where('ClearanceReq_ID',$request->id)->update(['ClearanceReq_Status' => 'Done','ClearanceReq_Doc' => 'clearances/'.$request->id.'.pdf', 'ClearanceReq_Purpose' => $request->purpose]);

        $pdf::Output('../public/clearances/'.$request->id.".pdf","F");
        $pdf::Output($request->id.".pdf", "D");
        exit();
    }

    public function create_businesse(Request $request){
        $details = DB::select('select * from tbl_brgyinfo');
        $resdetails = DB::select(' select Resident_Fname, Resident_Lname, Resident_Image, Resident_House, Resident_Street,Resident_Area, Resident_Year from tbl_residents join tbl_clearancereq on Resident_ID=ClearanceReq_Resident where ClearanceReq_ID = '.$request->id);

        $pdf = new Fpdf();        
        $pdf::AddPage("P","Letter");
        $pdf::setMargins(2.54,2.54,2.54);
        $pdf::SetFont('Arial','',12);
        $pdf::Image('../public/'.$details[0]->BrgyInfo_Image ,10,10,30);
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Barangay ".$details[0]->BrgyInfo_Name,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"District 2, Quezon City",0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Email: ".$details[0]->BrgyInfo_Email,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Website: ".$details[0]->BrgyInfo_Web,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(142.875);
        $pdf::Image('../public/'.$resdetails[0]->Resident_Image,171.45,30,30);
        $pdf::Ln();
        $pdf::Ln();
        $text = "\n\n\nTO WHOM IT MAY CONCERN\n\n   THIS IS TO CERTIFY THAT this Office hereby approves the herein application of ".$resdetails[0]->Resident_Fname." ".$resdetails[0]->Resident_Lname." of legal age, Filipino and a bonafide resident of ".$resdetails[0]->Resident_House." ".$resdetails[0]->Resident_Street." Street, ".$resdetails[0]->Resident_Area.", ".$details[0]->BrgyInfo_Name." ,Quezon City for a clearance to engage/ or operate and/ new or renew the business, ".$request->purpose." located in this barangay.\n\n       THIS FURTHER CERTIFIES that the nature of the business does not destroy moral values of its residents especially the youth and the children, nor does it cause the breach of peace and order and harmony in the barangay, nor endangers the safety and health of its constituents, nor unnecessarily destroys the environment to the detriment of the residents thereof.\n\n        THIS FURTHERMORE CERTIFIES that the applicant shall be abide all pertinent ordinances of this barangay are hereby complied with and shall henceforth be observed with due respect and obidience to the local authorities.\n\n       This certification is being issued upon the request of ".$resdetails[0]->Resident_Fname." ".$resdetails[0]->Resident_Lname." for presentation to the Market Development and Administration Department - Business Permits and License Unit (MDAD- BPLU), Quezon City Hall, which is a prerequisites in the issuance of any permit and/ or license for said business activity, pursuant to Sec. 73 of Quezon City Revenue Code.\n\n    ISSUED this ".date('jS \of F Y')." at Barangay ".$details[0]->BrgyInfo_Name." District 2, Quezon City, Philippines";

        $pdf::Cell(47.625);
        $pdf::MultiCell(142.875,7,$text,0,"L");

        DB::table('tbl_clearancereq')->where('ClearanceReq_ID',$request->id)->update(['ClearanceReq_Status' => 'Done','ClearanceReq_Doc' => 'clearances/'.$request->id.'.pdf', 'ClearanceReq_Purpose' => $request->purpose]);

        $pdf::Output('../public/clearances/'.$request->id.".pdf","F");
        $pdf::Output($request->id.".pdf", "D");
        exit();
    }

    public function create_construction(Request $request){
        $details = DB::select('select * from tbl_brgyinfo');
        $resdetails = DB::select(' select Resident_Fname, Resident_Lname, Resident_Image, Resident_House, Resident_Street,Resident_Area Resident_Year from tbl_residents join tbl_clearancereq on Resident_ID=ClearanceReq_Resident where ClearanceReq_ID = '.$request->id);

        $pdf = new Fpdf();        
        $pdf::AddPage("P","Letter");
        $pdf::setMargins(2.54,2.54,2.54);
        $pdf::SetFont('Arial','',12);
        $pdf::Image('../public/'.$details[0]->BrgyInfo_Image ,10,10,30);
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Barangay ".$details[0]->BrgyInfo_Name,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"District 2, Quezon City",0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Email: ".$details[0]->BrgyInfo_Email,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Website: ".$details[0]->BrgyInfo_Web,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(142.875);
        $pdf::Image('../public/'.$resdetails[0]->Resident_Image,171.45,30,30);
        $pdf::Ln();
        $pdf::Ln();
        $text = "\n\n\nTO WHOM IT MAY CONCERN:\n\n   THIS IS TO CERTIFY THAT ".$resdetails[0]->Resident_Fname." ".$resdetails[0]->Resident_Lname." intent to construct a certain building/ structure at ".$resdetails[0]->Resident_House." ".$resdetails[0]->Resident_Street." Street, ".$resdetails[0]->Resident_Area.", ".$details[0]->BrgyInfo_Name." ,Quezon City\n\n       THIS FURTHER CERTIFIES that the construction of the building/ structure does not endanger the health, safety, peace and order in the barangay.\n\n      THIS FURTHERMORE CERTIFIES that the applicant shall abide all pertinent ordinances of this barangay and shall henceforth observed with due respect and obidience to the local authorities.\n\n      THIS FINALLY CERTIFIES THAT the applicant shall abide the Rules and Regulations of the Philippine Building code and such other requirements as maybe imposed by the city governing agency/ department.\n\n The Certification is being issued upon the request of the abovementioned name for the purpose of securing CLEARANCE as required for presentation to the Department of Building Officials of Quezon City Hall, which is  a prerequisites in the issuance of any permit for said construction activity which is for ".$request->purpose." purpose only.\n\n    ISSUED this ".date('jS \of F Y')." at Barangay ".$details[0]->BrgyInfo_Name." District 2, Quezon City, Philippines";

        $pdf::Cell(47.625);
        $pdf::MultiCell(142.875,7,$text,0,"L");

        DB::table('tbl_clearancereq')->where('ClearanceReq_ID',$request->id)->update(['ClearanceReq_Status' => 'Done','ClearanceReq_Doc' => 'clearances/'.$request->id.'.pdf', 'ClearanceReq_Purpose' => $request->purpose]);

        $pdf::Output('../public/clearances/'.$request->id.".pdf","F");
        $pdf::Output($request->id.".pdf", "D");
        exit();
    }

    public function create_water(Request $request){
        $details = DB::select('select * from tbl_brgyinfo');
        $resdetails = DB::select(' select Resident_Fname, Resident_Lname, Resident_Image, Resident_House, Resident_Street, Resident_Area,Resident_Year from tbl_residents join tbl_clearancereq on Resident_ID=ClearanceReq_Resident where ClearanceReq_ID = '.$request->id);

        $pdf = new Fpdf();        
        $pdf::AddPage("P","Letter");
        $pdf::setMargins(2.54,2.54,2.54);
        $pdf::SetFont('Arial','',12);
        $pdf::Image('../public/'.$details[0]->BrgyInfo_Image ,10,10,30);
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Barangay ".$details[0]->BrgyInfo_Name,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"District 2, Quezon City",0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Email: ".$details[0]->BrgyInfo_Email,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Website: ".$details[0]->BrgyInfo_Web,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(142.875);
        $pdf::Image('../public/'.$resdetails[0]->Resident_Image,171.45,60,30);
        $pdf::Ln();
        $pdf::Ln();
        $text = "\n\n\n\n\n\n\nTO WHOM IT MAY CONCERN:\n\n   THIS IS TO CERTIFY THAT ".$resdetails[0]->Resident_Fname." ".$resdetails[0]->Resident_Lname." of legal age, Filipino and a bonafide resident of ".$resdetails[0]->Resident_House." ".$resdetails[0]->Resident_Street." Street, ".$resdetails[0]->Resident_Area.", ".$details[0]->BrgyInfo_Name." ,Quezon City since ".$resdetails[0]->Resident_Year." up to present.\n\n       THIS FURTHER CERTIFIES that the applicant shall abide by the rules and regulations of ".$request->provider." and such other requirements as may be imposed by the city governing agency/ department and for the purpose of securing a permit/ clearance as requirement for ".$request->purpose.".\n\n    ISSUED this ".date('jS \of F Y')." at Barangay ".$details[0]->BrgyInfo_Name." District 2, Quezon City, Philippines";

        $pdf::Cell(47.625);
        $pdf::MultiCell(142.875,7,$text,0,"L");

        DB::table('tbl_clearancereq')->where('ClearanceReq_ID',$request->id)->update(['ClearanceReq_Status' => 'Done','ClearanceReq_Doc' => 'clearances/'.$request->id.'.pdf', 'ClearanceReq_Purpose' => $request->purpose]);

        $pdf::Output('../public/clearances/'.$request->id.".pdf","F");
        $pdf::Output($request->id.".pdf", "D");
        exit();
    }

    public function create_electric(Request $request){
        $details = DB::select('select * from tbl_brgyinfo');
        $resdetails = DB::select(' select Resident_Fname, Resident_Lname, Resident_Image, Resident_House, Resident_Street, Resident_Area, Resident_Year from tbl_residents join tbl_clearancereq on Resident_ID=ClearanceReq_Resident where ClearanceReq_ID = '.$request->id);

        $pdf = new Fpdf();        
        $pdf::AddPage("P","Letter");
        $pdf::setMargins(2.54,2.54,2.54);
        $pdf::SetFont('Arial','',12);
        $pdf::Image('../public/'.$details[0]->BrgyInfo_Image ,10,10,30);
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Barangay ".$details[0]->BrgyInfo_Name,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"District 2, Quezon City",0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Email: ".$details[0]->BrgyInfo_Email,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Website: ".$details[0]->BrgyInfo_Web,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(142.875);
        $pdf::Image('../public/'.$resdetails[0]->Resident_Image,171.45,60,30);
        $pdf::Ln();
        $pdf::Ln();
        $text = "\n\n\n\n\n\n\nTO WHOM IT MAY CONCERN:\n\n   THIS IS TO CERTIFY THAT ".$resdetails[0]->Resident_Fname." ".$resdetails[0]->Resident_Lname." of legal age, Filipino and a bonafide resident of ".$resdetails[0]->Resident_House." ".$resdetails[0]->Resident_Street." Street, ".$resdetails[0]->Resident_Area.", ".$details[0]->BrgyInfo_Name." ,Quezon City since ".$resdetails[0]->Resident_Year." up to present.\n\n       THIS FURTHER CERTIFIES that the applicant whose name mentioned above shall abide the rules and regulations of the PHILIPPINE ELECTRICAL CODE and such other requirements as may be imposed by the city governing agency/ department and for the purpose of securing a wiring permit/ clearance as requirement for ".$request->purpose.".\n\n    ISSUED this ".date('jS \of F Y')." at Barangay ".$details[0]->BrgyInfo_Name." District 2, Quezon City, Philippines";

        $pdf::Cell(47.625);
        $pdf::MultiCell(142.875,7,$text,0,"L");

        DB::table('tbl_clearancereq')->where('ClearanceReq_ID',$request->id)->update(['ClearanceReq_Status' => 'Done','ClearanceReq_Doc' => 'clearances/'.$request->id.'.pdf', 'ClearanceReq_Purpose' => $request->purpose]);

        $pdf::Output('../public/clearances/'.$request->id.".pdf","F");
        $pdf::Output($request->id.".pdf", "D");
        exit();
    }

    public function create_excavation(Request $request){
        $details = DB::select('select * from tbl_brgyinfo');
        $resdetails = DB::select(' select Resident_Fname, Resident_Lname, Resident_Image, Resident_House, Resident_Street,Resident_Area, Resident_Year from tbl_residents join tbl_clearancereq on Resident_ID=ClearanceReq_Resident where ClearanceReq_ID = '.$request->id);

        $pdf = new Fpdf();        
        $pdf::AddPage("P","Letter");
        $pdf::setMargins(2.54,2.54,2.54);
        $pdf::SetFont('Arial','',12);
        $pdf::Image('../public/'.$details[0]->BrgyInfo_Image ,10,10,30);
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Barangay ".$details[0]->BrgyInfo_Name,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"District 2, Quezon City",0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Email: ".$details[0]->BrgyInfo_Email,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(55.4);
        $pdf::Cell(109.7,7,"Website: ".$details[0]->BrgyInfo_Web,0,0,"C");
        $pdf::Ln();
        $pdf::Cell(142.875);
        $pdf::Image('../public/'.$resdetails[0]->Resident_Image,171.45,60,30);
        $pdf::Ln();
        $pdf::Ln();
        $text = "\n\n\n\n\n\n\nTO WHOM IT MAY CONCERN:\n\n   THIS IS TO CERTIFY THAT ".$resdetails[0]->Resident_Fname." ".$resdetails[0]->Resident_Lname." of legal age, Filipino and a bonafide resident of ".$resdetails[0]->Resident_House." ".$resdetails[0]->Resident_Street." Street, ".$resdetails[0]->Resident_Area.", ".$details[0]->BrgyInfo_Name." ,Quezon City for a Clearance for shallow excavation activities at this barangay.\n\n       THIS FURTHER CERTIFIES that the applicant shall abide by the rules and regulations of Philippine Excavation Code and such other requirements as may be imposed by the city governing agency/ department.\n\n       THIS FURTHERMORE CERTIFIES that the construction does not endanger any health, safety, peace and order in the barangay and all affected pavements will be restored to its original status.\n\n      THIS CERTIFICATION is being issued upon the request of the abovementioned name for the purpose of securing a clearance as a requirement for ".$request->purpose." located at Barangay ".$details[0]->BrgyInfo_Name.".\n\n    ISSUED this ".date('jS \of F Y')." at Barangay ".$details[0]->BrgyInfo_Name." District 2, Quezon City, Philippines";

        $pdf::Cell(47.625);
        $pdf::MultiCell(142.875,7,$text,0,"L");

        DB::table('tbl_clearancereq')->where('ClearanceReq_ID',$request->id)->update(['ClearanceReq_Status' => 'Done','ClearanceReq_Doc' => 'clearances/'.$request->id.'.pdf', 'ClearanceReq_Purpose' => $request->purpose]);

        $pdf::Output('../public/clearances/'.$request->id.".pdf","F");
        $pdf::Output($request->id.".pdf", "D");
        exit();
    }
}
