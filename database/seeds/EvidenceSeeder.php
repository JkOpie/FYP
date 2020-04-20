<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EvidenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [ 'name' => 'syaafi', 'email'=>'syaafi@gmail.com', 'occupation'=>'doctor','picture'=> '1587307976.jpeg', 'phone'=>'01111385109', 'password' => Hash::make('12345678')] 
         );

        DB::table('status')->insert([
           [ 'keyboard' => 'on', 'mouse'=>'off',  'camera' => 'on', 'thermal' => 'off', 'Gps' => 'on','Battery' => 'off'],
        ]);

        DB::table('report')->insert([ 
            ['DateTime' => '11/11/2019', 'EventName'=> 'Bangsar Earthquake' , 'EventDescription'=> '30 injuries, 3 trap in the building'],
        ]);

        DB::table('evidence2')->insert([
            [ 'DateTime' => '11/11/2019', 'Picture'=>'earth1.jpg',  'Thermal' => '1.jpg', 'Temperature'=> '30','Longitude' => '3.2535', 'Latitude' => '101.6533', 'report_id' => '1'],
            [ 'DateTime' => '12/11/2019', 'Picture'=>'earth2.jpg',  'Thermal' => '2.jfif', 'Temperature'=> '20','Longitude' => '3.2454', 'Latitude' => '101.7019', 'report_id' => '1'],
            [ 'DateTime' => '13/11/2019', 'Picture'=>'earth3.jpg',  'Thermal' => '3.jpg', 'Temperature'=> '10','Longitude' => '3.2454', 'Latitude' => '101.7019', 'report_id' => '1']
           
         ]);

         DB::table('evidence')->insert([
            [ 'DateTime' => '11/11/2019', 'Picture'=>'earth1.jpg',  'Thermal' => '1.jpg',  'Temperature'=> '30','Longitude' => '3.2535', 'Latitude' => '101.6533'],
            [ 'DateTime' => '12/11/2019', 'Picture'=>'earth2.jpg',  'Thermal' => '2.jfif',  'Temperature'=> '30','Longitude' => '3.2454', 'Latitude' => '101.7019'],
            [ 'DateTime' => '13/11/2019', 'Picture'=>'earth3.jpg',  'Thermal' => '3.jpg',  'Temperature'=> '30','Longitude' => '3.2454', 'Latitude' => '101.7019']
           
         ]);
    }
}
