<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    protected $fillable = ['title','body','excerpt'];
    protected $date = ['published_at'];


    public function getImageUrlAttribute()
    {
    	$imageUrl="";
    	if (! is_null($this->image)) {
    		$image_path = public_path()."/img/".$this->image;
    		if (file_exists($image_path)) {
    			$imageUrl = asset("/img/".$this->image);

    		}
    	}
        
    	return $imageUrl;
    }

    public function getDateAttribute()
    {
    	return is_null($this->published_at) ? '' : $this->created_at->diffForHumans();
    }

    public function author()
    {
    	return $this->belongsTo('App\User');
    }

    public function scopePublished($query)
    {
    	return $query->where('published_at','<=', Carbon::now());
    }
}
