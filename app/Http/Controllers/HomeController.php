<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Status;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

   
    public function index(Request $request) 
    {
        $status = Status::all();

        if($request->ajax()){
            return response()->json(array('status'=>$status));
         }

        //return $status;
        return view('home', compact('status'));
    }
}
