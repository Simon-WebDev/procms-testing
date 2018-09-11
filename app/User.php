<?php

namespace App;

use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use Notifiable;
    use LaratrustUserTrait; // add this trait to your user model

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','slug','bio'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany('App\Post','author_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getBioHtmlAttribute()
    {
        return $this->bio ? Markdown::convertToHtml(e($this->bio)) : NULL ;
    }

    public function gravatar()
    {
        $email = $this->email;
        $default = '';
        $size = 40;
        return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;

    }
}
