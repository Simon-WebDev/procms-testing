<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Chapter extends Model
{
    protected $fillable = ['title', 'slug'];

    public function pages()
    {
    	return $this->hasMany('App\Page');
    }

    public function getRouteKeyName()
    {
    	return 'slug';
    }
}
