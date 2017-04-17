<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    public $fillable = ['self_id', 'model', 'protocol'];

    public function readings()
    {
        return $this->hasMany('App\Readings');
    }
}
