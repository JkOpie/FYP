<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\evidence;
use App\report;
use App\evidence2;
use App\User;
use PDF;
use App;


class EvidenceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
    }
    public function index(){

        $evis  = evidence::all();

        //return $evis;
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

    public function delete_report($id){
        $rep = report::where('id', $id)->first();
        //return $rep;

        $rep->evidence->each->delete();
        $delete =  $rep->delete();

        return redirect('/report');

    }

    public function delete_evidence_report($id){

        $evi = report::where('id', $id)->first();
        return redirect()->back()->with('delete','Evidence deleted successfully');
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

    public function view_event($id){

        $evis = report::with('evidence')->where('id', $id)->get();
        $count = $evis->count();

        //return $evis;

        return view('evidence_report', compact('evis', 'count')) ;
    }

    public function pdf($id){

        //return $evis;
        $user_id = Auth::id();
        $users = User::where('id', '=', $user_id)->get();
        $evis = report::where('id', $id)->with('evidence')->get();
        view()->share('users', $users);
        view()->share('evis', $evis);

        $pdf = PDF::loadView('test_pdf', $users);
        return $pdf->stream('report.pdf');
        //return view('pdf');
    }

    public function test_pdf($id){

        $user_id = Auth::id();
        $evis = report::where('id', $id)->with('evidence')->get();
        $users = User::where('id', '=', $user_id)->get();

        return view('test_pdf', compact('evis', 'users'));

        //return $evis;
       
        //return view('pdf');
    }

    public function UserPage($id){
        $user = User::where('id', $id)->first();
        //return $user;
        return view("user", compact('user'));
        
    }

    public function UserUpdate(Request $request){
        
        $user_id = Auth::id();
        $request->validate([
            'name' => 'required',
            'occupation'=> 'required',
            'email'=> 'required',
            'password' => 'min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:6',
            'Tel_Number'=>'required',
        ]);

        $user = User::where('id', $user_id)->update([
            'name'=>  $request->name,
            'occupation' => $request->occupation,
            'email'=> $request->email,
            'phone' => $request->Tel_Number,
            'password'=>  Hash::make($request->password),
            
            
        ]);

        return back()->with('update_success','You have successfully update the user.');
    }

    public function imageUploadPost(Request $request)
    {

        //return  $request->image;
        $user_id = Auth::id();
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
  
        $imageName = time().'.'.$request->image->extension();  
   
        $request->image->move(public_path('userImages'), $imageName);

        $user = User::where('id', $user_id)->update(['picture'=>  $imageName]);

        return back()
            ->with('img_success','You have successfully upload image.');

    }

    public function report_search(Request $request){

        if($request->ajax())
     {
      $output = '';
      $query = $request->get('value');
      if($query != '')
      {
        $data = DB::table('evidence')
        ->where('DateTime', '=', $query)
        ->orWhere('Temperature', '=',$query)
        ->orWhere('Longitude', '=', $query)
        ->orWhere('Latitude', '=', $query)
        ->get(); 
         
      }
      else
      {
       $data = DB::table('evidence')
         ->orderBy('id', 'desc')
         ->get();
      }
      $total_row = $data->count();
      if($total_row > 0)
      {
       foreach($data as $row)
       {
        $output .= '
          <tr>
           <td>'.$row->DateTime.'</td>
           <td>  <img src="img/'.$row->Picture.'" width="100" height="80" ></td>
           <td>  <img src="img/'.$row->Thermal.'" width="100" height="80" ></td>
           <td>'.$row->Temperature.'</td>
           <td>'.$row->Longitude.'</td>
           <td>'.$row->Latitude.'</td>
           <td> <a type="button" class="btn btn-danger btn-rounded btn-sm m-0" href="/evidence/'.$row->id.'"><i class="fas fa-trash-alt fa-lg"></i> Delete</a> </td>
          </tr>
          ';
       }
      }
      else
      {
       $output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
      }
      $data = array(
       'table_data'  => $output,
       'total_data'  => $total_row
      );

      echo json_encode($data);
     }

    }

    public function report_evidence_search(Request $request){
    if($request->ajax())
        {
         $output = '';
         $query = $request->get('value');

        if($query != '')
         {
           $data = DB::table('evidence2')
           ->where('DateTime', '=', $query)
           ->orWhere('Temperature', '=',$query)
           ->orWhere('Longitude', '=', $query)
           ->orWhere('Latitude', '=', $query)
           ->get(); 
         }

         else{
          $data = DB::table('evidence2')
            ->orderBy('id', 'desc')
            ->get();
         }
         $total_row = $data->count();
         if($total_row > 0)
         {
          foreach($data as $row)
          {
           $output .= '
             <tr>
              <td>'.$row->DateTime.'</td>
              <td>  <img src="/img/'.$row->Picture.'" width="100" height="80" ></td>
              <td>  <img src="/img/'.$row->Thermal.'" width="100" height="80" ></td>
              <td>'.$row->Temperature.'</td>
              <td>'.$row->Longitude.'</td>
              <td>'.$row->Latitude.'</td>
              <td> <a type="button" class="btn btn-danger btn-rounded btn-sm m-0" href="/evidence/'.$row->id.'"><i class="fas fa-trash-alt fa-lg"></i> Delete</a> </td>
             </tr>
             ';
          }
         }
         else
         {
          $output = '
          <tr>
           <td align="center" colspan="5">No Data Found</td>
          </tr>
          ';
         }
         $data = array(
          'table_data'  => $output,
          'total_data'  => $total_row
         );
   
         echo json_encode($data);
        }
    }

        public function report_search_go(Request $request){

       
            $ttl = 0;
            $report = report::with('evidence')->get();


        if($request->ajax())
            {
             $output = '';
             $query = $request->get('value');
    
            if($query != '')
             {
               $data = report::with('evidence')
               ->where('DateTime', '=', $query)
               ->orWhere('EventName', '=',$query)
               ->orWhere('EventDescription', '=', $query)
               ->get(); 
             }
    
             else{
              $data = report::with('evidence')
                ->orderBy('id', 'desc')
                ->get();
             }


             $total_row = $data->count();
             if($total_row > 0)
             {
              foreach($data as $row)
              {
               $output .= '
                 <tr>
                  <td>'.$row->DateTime.'</td>
                  <td>'.$row->evidence->count().'</td>
                  <td>'.$row->EventName.'</td>
                  <td>'.$row->EventDescription.'</td>
                  <td>
                    <a type="button" class="btn btn-danger btn-rounded btn-sm m-0" href="/report_delete/'.$row->id.'"><i class="fas fa-trash-alt fa-lg"></i> Delete</a>
                    <a type="button" class="btn btn-primary btn-rounded btn-sm m-0" href="/report/'.$row->id.'"><i class="fas fa-eye fa-lg"></i> View</a>
                    <a type="button" class="btn btn-success btn-rounded btn-sm m-0" href="/pdf/'.$row->id.'"><i class="fas fa-file-pdf fa-lg"></i> PDF</a>
                </td>
                 </tr>
                 ';
              }
             }
             else
             {
              $output = '
              <tr>
               <td align="center" colspan="5">No Data Found</td>
              </tr>
              ';
             }
             $data = array(
              'table_data'  => $output,
              'total_data'  => $total_row
             );
       
             echo json_encode($data);
            }
        }



       

    public function maps()
    {
        return view('maps');
    }


}
