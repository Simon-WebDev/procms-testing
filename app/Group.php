<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
    	'title', 'slug','is_open'
    ];

    public function boards()
    {
    	return $this->hasMany('App\Board');
    }

    public function getRouteKeyName()
    {
    	return 'slug';
    }

    public function dateFormatted($showTimes = false)
    {
        $format = "Y/m/d";
        if($showTimes) $format = $format . " H:i:s";
        return $this->created_at->format($format);
    }
}
