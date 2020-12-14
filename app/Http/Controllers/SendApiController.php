<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SendApiController extends Controller
{
    public function index(Request $request){
  
        //dd($request->all());
        
        $response = Http::post('http://192.168.137.202:3000/', [
            'key' => $request->key,
            'data' => $request->data
        ]);

        //dd($response->successful(), $response->status());
    }
}
