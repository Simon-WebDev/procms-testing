<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservations';

    /**
     * [$fillable description]
     * @var [type]
     */
    protected $fillable = [
        'title', 'start', 'end', 'color','user_id','staff_id','phone'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function staff()
    {
        return $this->belongsTo('App\Staff');
    }

}
