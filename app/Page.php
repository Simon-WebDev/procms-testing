<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'user_id', 'title', 'excerpt', 'body',
    	'is_active','image', 'view_count','chapter_id'
    ];

    protected $table = "pages";

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function getImageUrlAttribute($value)
    {
    	//make upload folder match with post image upload folder
        $imageUrl = "";

        if ( ! is_null($this->image))
        {
            $directory = config('cms.image.directory');
            $imagePath = public_path() . "/{$directory}/" . $this->image;
            if (file_exists($imagePath)) $imageUrl = asset("{$directory}/" . $this->image);
        }

        return $imageUrl;
    }

    public function getThumbUrlAttribute($value)
    {
        $imageUrl = "";
        if (! is_null($this->image)) {
           $fileName = $this->image;
           $ext = substr(strrchr($fileName, '.'), 1);
           $thumbnail = str_replace(".{$ext}","_thumb.{$ext}", $fileName);
           $directory = config('cms.image.directory');
           $imagePath = public_path() . "/{$directory}/" . $thumbnail;
           if (file_exists($imagePath)) $imageUrl = asset("{$directory}/" . $thumbnail);
        }
       
        
        return $imageUrl;
    }

    public function dateFormatted($showTimes = false)
    {
        $format = "Y/m/d";
        if($showTimes) $format = $format . " H:i:s";
        return $this->created_at->format($format);
    }
}
