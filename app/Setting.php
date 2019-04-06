<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
        protected $fillable=[
        	'site_name',
        	'site_phone',
        	'site_email',
        	'site_address',
        	'site_agreement',
        	'site_privacy',


    	];

    	public $table='settings';

    	//for makeing line break working
    	public function getAgreeHtmlAttribute($value)
    	{
    	    return $this->site_agreement ? nl2br($this->site_agreement) : NULL;
    	}
    	public function getPrivacyHtmlAttribute($value)
    	{
    	    return $this->site_privacy ? nl2br($this->site_privacy) : NULL;
    	}
}
