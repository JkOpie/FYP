<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class report extends Model
{  
    protected $fillable = [
        'DateTime', 'EventName', 'EventDescription',
    ];
    protected $table = 'report';

    protected $dates = ['DateTime'];
    

    public function evidence()
    {
        return $this->hasMany('App\evidence2');
    }
}
