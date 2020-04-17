<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\evidence;
use App\report;


class EvidenceController extends Controller
{
    public function index(){

        $evis  = evidence::all();
        $count = evidence::all()->count();
        //return $evi;
        return view('evidence', compact('evis', 'count'));
    }

    public function delete($id){

        $evi = evidence::where('id', $id)->first();
        //return $evi;
        $evi->delete();

        return redirect('/evidence')->with('delete','Evidence deleted successfully');
    }

    public function CreateReport(Request $request){
        $request->validate([
            "event_date" => "required",
            "event_name" => "required",
            "event_desc" => "required"
        ]);

    
        $evi1 = evidence::all();
        $count_evi = evidence::all()->count();

        if ($count_evi == 0){
            return redirect('/evidence')->with('error_report','Report not created');
        }else{

            $rep = report::create([
                "DateTime" => $request->event_date,
                "EventName" => $request->event_name,
                "EventDescription" => $request->event_desc,
            ]);
            foreach($evi1 as $evi){
                DB::table('evidence2')->insert([
                    "DateTime" => $evi->DateTime,
                    "Picture" => $evi->Picture,
                    "Thermal" => $evi->Thermal,
                    "Longitude" => $evi->Longitude,
                    "Latitude" => $evi->Latitude,
                    "report_id" => $rep->id,
                ]);
            }

            DB::table('evidence')->truncate();

            return redirect('/evidence')->with('success_report','Report created successfully');
    
        }   
    }

    public function report(){

        $reports = report::with('evidence')->get();

        //return $reports;

        return view('report', compact('reports'));
    }
}
