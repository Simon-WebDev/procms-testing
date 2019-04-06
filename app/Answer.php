<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
    	'user_id',
    	'board_id',
    	'body',
        'is_active'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function board()
    {
    	return $this->belongsTo('App\Board');
    }

    public function getBodyHtmlAttribute($value)
    {
        return $this->body ? strip_tags(nl2br($this->body),'<br></br>') : NULL;
    }

    public function dateFormatted($showTimes = false)
    {
        $format = "Y/m/d";
        if($showTimes) $format = $format . " H:i:s";
        return $this->created_at->format($format);
    }
}
