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

        DB::table('status')->insert([
           [ 'keyboard' => 'on', 'mouse'=>'off',  'camera' => 'on', 'thermal' => 'off', 'Gps' => 'on','Battery' => 'off'],
        ]);

        DB::table('report')->insert([ 
            ['DateTime' => $date_format, 'EventName'=> 'Bangsar Earthquake' , 'EventDescription'=> '30 injuries, 3 trap in the building'],
            ['DateTime' => $date_format, 'EventName'=> 'Sabah Earthquake' , 'EventDescription'=> '3 trap in the building'],
            ['DateTime' => $date_format, 'EventName'=> 'Gombak Earthquake' , 'EventDescription'=> '3 trap in the building'],
            ['DateTime' => $date_format, 'EventName'=> 'Kajang Earthquake' , 'EventDescription'=> '3 trap in the building'],
            ['DateTime' => $date_format, 'EventName'=> 'Melaka Earthquake' , 'EventDescription'=> '3 trap in the building'],
            ['DateTime' => $date_format, 'EventName'=> 'Sarawak Earthquake' , 'EventDescription'=> '3 trap in the building'],
        ]);
      
        DB::table('evidence2')->insert([
            [ 'DateTime' => $date_format, 'Picture'=>'earth1.jpg',  'Thermal' => '1.jpg', 'Temperature'=> '31','Longitude' => '101.714508', 'Latitude' => '3.039040', 'report_id' => '1'],
            [ 'DateTime' => $date_format, 'Picture'=>'earth2.jpg',  'Thermal' => '2.jfif', 'Temperature'=> '32','Longitude' => '101.518580', 'Latitude' => '3.074150', 'report_id' => '1'],
            [ 'DateTime' => $date_format, 'Picture'=>'earth3.jpg',  'Thermal' => '3.jpg', 'Temperature'=> '33','Longitude' => '101.750908', 'Latitude' => '2.983470', 'report_id' => '1'],

            [ 'DateTime' => $date_format, 'Picture'=>'earth1.jpg',  'Thermal' => '1.jpg', 'Temperature'=> '34','Longitude' => '116.796783', 'Latitude' => '5.420404', 'report_id' => '2'],
            [ 'DateTime' => $date_format, 'Picture'=>'earth2.jpg',  'Thermal' => '2.jfif', 'Temperature'=> '35','Longitude' => '116.427879', 'Latitude' => '6.353248', 'report_id' => '2'],
            [ 'DateTime' => $date_format, 'Picture'=>'earth3.jpg',  'Thermal' => '3.jpg', 'Temperature'=> '36','Longitude' => '116.054251', 'Latitude' => '5.905653', 'report_id' => '2'],

            [ 'DateTime' => $date_format, 'Picture'=>'earth1.jpg',  'Thermal' => '1.jpg', 'Temperature'=> '37','Longitude' => '101.714598', 'Latitude' => '3.233413', 'report_id' => '3'],
            [ 'DateTime' => $date_format, 'Picture'=>'earth2.jpg',  'Thermal' => '2.jfif', 'Temperature'=> '38','Longitude' => '101.701901', 'Latitude' => '3.23247', 'report_id' => '3'],
            [ 'DateTime' => $date_format, 'Picture'=>'earth3.jpg',  'Thermal' => '3.jpg', 'Temperature'=> '36','Longitude' => '101.721636', 'Latitude' => '3.217559', 'report_id' => '3'],

            [ 'DateTime' => $date_format, 'Picture'=>'earth1.jpg',  'Thermal' => '1.jpg', 'Temperature'=> '21','Longitude' => '101.785241', 'Latitude' => '2.991385', 'report_id' => '4'],
            [ 'DateTime' => $date_format, 'Picture'=>'earth2.jpg',  'Thermal' => '2.jfif', 'Temperature'=> '22','Longitude' => '101.794766', 'Latitude' => '3.005184', 'report_id' => '4'],
            [ 'DateTime' => $date_format, 'Picture'=>'earth3.jpg',  'Thermal' => '3.jpg', 'Temperature'=> '23','Longitude' => '101.76722', 'Latitude' => '3.005441', 'report_id' => '4'],

            [ 'DateTime' => $date_format, 'Picture'=>'earth1.jpg',  'Thermal' => '1.jpg', 'Temperature'=> '24','Longitude' => '102.259025', 'Latitude' => '2.191753', 'report_id' => '5'],
            [ 'DateTime' => $date_format, 'Picture'=>'earth2.jpg',  'Thermal' => '2.jfif', 'Temperature'=> '10','Longitude' => '102.29181', 'Latitude' => '2.1993', 'report_id' => '5'],
            [ 'DateTime' => $date_format, 'Picture'=>'earth3.jpg',  'Thermal' => '3.jpg', 'Temperature'=> '11','Longitude' => '102.233796', 'Latitude' => '2.244413', 'report_id' => '5'],

            [ 'DateTime' => $date_format, 'Picture'=>'earth1.jpg',  'Thermal' => '1.jpg', 'Temperature'=> '12','Longitude' => '110.346852', 'Latitude' => '1.53241', 'report_id' => '6'],
            [ 'DateTime' => $date_format, 'Picture'=>'earth2.jpg',  'Thermal' => '2.jfif', 'Temperature'=> '13','Longitude' => '110.43181', 'Latitude' => '1.312751', 'report_id' => '6'],
            [ 'DateTime' => $date_format, 'Picture'=>'earth3.jpg',  'Thermal' => '3.jpg', 'Temperature'=> '14','Longitude' => '109.83866', 'Latitude' => '1.644977', 'report_id' => '6'],
           
         ]);

         DB::table('evidence')->insert([
            [ 'DateTime' => $date_format, 'Picture'=>'earth1.jpg',  'Thermal' => '1.jpg', 'Temperature'=> '30','Longitude' => '101.714508', 'Latitude' => '3.039040'],
            [ 'DateTime' => $date_format, 'Picture'=>'earth2.jpg',  'Thermal' => '2.jfif', 'Temperature'=> '20','Longitude' => '101.518580', 'Latitude' => '3.074150'],
            [ 'DateTime' => $date_format, 'Picture'=>'earth3.jpg',  'Thermal' => '3.jpg', 'Temperature'=> '10','Longitude' => '101.750908', 'Latitude' => '2.983470']
         ]);
    }
}
