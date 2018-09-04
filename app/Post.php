<?php

namespace App;

use Carbon\Carbon;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title','body','excerpt', 'category_id'];
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
    public function getImageThumbUrlAttribute()
    {
        $imageUrl="";
        if (! is_null($this->image)) {
            $ext = substr(strrchr($this->image, '.'), 1);
            $thumbnail = str_replace(".{$ext}","_thumb.{$ext}", $this->image);
            $image_path = public_path()."/img/".$thumbnail;
            if (file_exists($image_path)) {
                $imageUrl = asset("/img/".$thumbnail);

            }
        }
           
        return $imageUrl;
    }

    public function getDateAttribute()
    {
    	return is_null($this->published_at) ? '' : $this->created_at->diffForHumans();
    }

    public function getBodyHtmlAttribute()
    {
    	return $this->body ? Markdown::convertToHtml(e($this->body)) : NULL ;
    }

    public function getExcerptHtmlAttribute()
    {
    	return $this->excerpt ? Markdown::convertToHtml(e($this->excerpt)) : NULL ;
    }

    public function author()
    {
    	return $this->belongsTo('App\User');
    }

    public function category()
    {
    	return $this->belongsTo('App\Category');
    }

    public function scopePublished($query)
    {
    	return $query->where('published_at','<=', Carbon::now());
    }
    public function scopePopular($query)
    {
        return $query->orderBy('view_count','desc');
    }

 
}
