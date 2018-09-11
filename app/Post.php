<?php

namespace App;

use Carbon\Carbon;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['title','body','excerpt', 'category_id','view_count','image', 'slug','published_at'];
    protected $dates = ['published_at','deleted_at'];


    public function getImageUrlAttribute()
    {
    	$imageUrl="";
    	if (! is_null($this->image)) {
            $directory = config('cms.image.directory');
    		$image_path = public_path()."/{$directory}/".$this->image;
    		if (file_exists($image_path)) {
    			$imageUrl = asset("/{$directory}/".$this->image);

    		}
    	}
        
    	return $imageUrl;
    }
    public function getImageThumbUrlAttribute()
    {
        $imageUrl="";
        if (! is_null($this->image)) {
            $directory = config('cms.image.directory');
            $ext = substr(strrchr($this->image, '.'), 1);
            $thumbnail = str_replace(".{$ext}","_thumb.{$ext}", $this->image);
            $image_path = public_path()."/{$directory}/".$thumbnail;
            if (file_exists($image_path)) {
                $imageUrl = asset("/{$directory}/".$thumbnail);

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

    public function setPublishedAtAttribute($value)
    {
        $this->attributes['published_at'] = is_null($value) ? NULL : $value;

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
    public function scopeScheduled($query)
    {
        return $query->where('published_at','>', Carbon::now());
    }
    public function scopeDraft($query)
    {
        return $query->whereNull('published_at');
    }
    public function scopePopular($query)
    {
        return $query->orderBy('view_count','desc');
    }

    
    public function dateFormatted($showTimes = false)
    {
        $format = "Y/m/d";
        if($showTimes) $format = $format . " H:i:s";
        return $this->created_at->format($format);
    }

    public function publicationLabel()
    {

        if ( ! $this->published_at) {
            return "<span class='label label-warning'>Draft</span>";
        }
        elseif ($this->published_at && $this->published_at->isFuture()) {
            return "<span class='label label-info'>Schedule</span>";
        }
        else {

            return "<span class='label label-success'>Published</span>";
        }
    }

    public function scopeFilter($query, $term)
    { 
        //check if any "term" search entered
        if ($term) {
            $query->where(function($q) use($term){
                // deopend on developer descision
                
                // $q->whereHas('author', function($qr) use ($term){
                //     $qr->where('name', 'LIKE', "%{$term}%");
                // });
                // $q->orWhereHas('category', function($qr) use ($term){
                //     $qr->where('title', 'LIKE', "%{$term}%");
                // });
                $q->orWhere('title', 'LIKE', "%{$term}%");
                $q->orWhere('excerpt', 'LIKE', "%{$term}%");
            });
        }        
    }

 
}
