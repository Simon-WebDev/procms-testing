<?php

namespace App;

use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $fillable = [
    	'user_id',
    	'image1',
    	'image2',
    	'title',
    	'slug',
    	'body',
        'is_active',
        'is_notice',
        'group_id',
        'view_count'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function group()
    {
    	return $this->belongsTo('App\Group');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    public function getImage1UrlAttribute($value)
    {
    	$imageUrl = "";
    	if (! is_null($this->image1)) {
    		$imagePath = public_path() . '/upload/' . $this->image1;
    		if (file_exists($imagePath)) {
    			$imageUrl = asset('upload/' . $this->image1);
    		}
    	}
    	return $imageUrl;
    }

    public function getImage2UrlAttribute($value)
    {
    	$imageUrl = "";
    	if (! is_null($this->image2)) {
    		$imagePath = public_path() . '/upload/' . $this->image2;
    		if (file_exists($imagePath)) {
    			$imageUrl = asset('upload/' . $this->image2);
    		}
    	}
    	return $imageUrl;
    }

    public function getDateAttribute($value)
    {
    	return $this->created_at->diffForHumans();
    }

    public function getBodyHtmlAttribute($value)
    {
        return $this->body ? strip_tags(nl2br($this->body),'<br></br>') : NULL;
    }

    public function getRouteKeyName()
    {
    	return 'slug';
    }

    public function scopeLatestFirst($query)
    {
    	return $query->orderBy('created_at','desc');
    }

    public function dateFormatted($showTimes = false)
    {
        $format = "Y/m/d";
        if($showTimes) $format = $format . " H:i:s";
        return $this->created_at->format($format);
    }

    public function nameFormated()
    {
        if (!$this->group->is_open) {
          $name = $this->user->name;
          $name = substr($name,0,3)."**";
          return $name;
        }
        return $this->user->name;
    }
}
