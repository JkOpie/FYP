<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class evidence2 extends Model
{
    

    protected $dates = ['DateTime'];

    protected $table = 'evidence2';

    protected $fillable = [
        'DateTime', 'Picture', 'Thermal', 'Longitude', 'Latitude'
    ];

    public function report()
    {
        return $this->belongsTo('App\report', 'report_id', 'id');
    }
}
