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
        'name', 'email', 'password','slug','bio','site_agree','privacy_agree',
        'provider', 'socialid', 'token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'socialid', 'token'
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
        return $this->bio ? nl2br($this->bio) : NULL;
    }

    //gravatar.com  if user signedup, possible
    public function gravatar()
    {
        $email = $this->email;
        $default = "https://image.freepik.com/free-icon/profile-user_318-80283.jpg";
        // $default = asset('images/customer.png');
        // $default = "http://procms.devv/images/customer.png";
        $size = 40;
        return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . ( $default ) . "&s=" . $size;
    }
    
    // public function gravatar($value='')
    // {
    //     $imagePath = public_path() . "/images/" . 'customer.png';
    //     if (file_exists($imagePath)) $imageUrl = asset("images/" . 'customer.png');
    //     return $imageUrl;
    // }



    public function boards()
    {
        return $this->hasMany('App\Board');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }

    public function pages()
    {
        return $this->hasMany('App\Page');
    }

    public function dateFormatted($showTimes = false)
    {
        $format = "Y/m/d";
        if($showTimes) $format = $format . " H:i:s";
        return $this->created_at->format($format);
    }

  

  
}
