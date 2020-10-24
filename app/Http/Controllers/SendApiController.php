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
        ]);

        //dd($response->successful(), $response->status());
    }
}
