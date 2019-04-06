<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable=[
    	'name',
    	'major',
    	'color'
    ];
    protected $table = 'staffs';

    public function reservations($value='')
    {
    	return $this->hasMany('App\Reservation');
    }
}
