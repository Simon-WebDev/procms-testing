<?php

namespace App;

use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable =[
    	'author_name',
    	'author_email',
    	'body',
    	'post_id',
        'is_active'
    ];

    public function post()
    {
    	return $this->belongsTo('App\Post');
    }

    public function getDateAttribute()
    {
    	return $this->created_at->diffForHumans();
    }

    public function getBodyHtmlAttribute()
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
