<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Api extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'api', 'type'];

    public function end_point()
    {
        return $this->belongsTo(EndPoint::class);
    }
}
