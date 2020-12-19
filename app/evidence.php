<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class evidence extends Model
{ 
    protected $table = 'evidence';

    protected $fillable = [
        'DateTime', 'Picture', 'Thermal', 'Longitude', 'Latitude', 'Temperature'
    ];

    protected $dates = ['DateTime'];
}


