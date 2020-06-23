<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class evidence2 extends Model
{
    public function report()
    {
        return $this->belongsTo('App\report', 'report_id', 'id');
    }

    protected $dates = ['DateTime'];

    protected $table = 'evidence2';
}
