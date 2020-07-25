<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EndPoint extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'end_point'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function apis()
    {
        return $this->hasMany(Api::class);
    }
}
