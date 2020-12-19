<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class EvidenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $current = Carbon::now();
        $date_format = $current->toDateTimeString();
        

        DB::table('users')->insert(
            [ 'name' => 'syaafi', 'email'=>'syaafi@gmail.com', 'occupation'=>'doctor','picture'=> '1587307976.jpeg', 'phone'=>'01111385109', 'password' => Hash::make('12345678')] 
         );


    }
}
