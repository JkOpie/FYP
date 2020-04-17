<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';

    protected $fillable = [
        'keyboard', 'mouse', 'camera', 'thermal', 'GPS', 'Battery',
    ];
}
