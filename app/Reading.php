<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reading extends Model
{
    public $timestamps = false;
    public $dates = ['timestamp'];
    public $fillable = ['sensor_id', 'type', 'value', 'timestamp'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sensor()
    {
        return $this->belongsTo('App\Sensor');
    }
}
