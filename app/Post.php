<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title','body','excerpt'];


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
    	return $this->created_at->diffForHumans();
    }

    public function author()
    {
    	return $this->belongsTo('App\User');
    }
}
