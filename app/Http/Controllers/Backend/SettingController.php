<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;

class SettingController extends BackendController
{
    	public function index()
    	{
    		$setting = Setting::first();
    		return view('backend.setting.settings', compact('setting'));
    	}

        public function update()
        {
        	$this->validate(request(),[
        		'site_name' => 'required',
        		'site_phone' => 'required',
        		'site_email' => 'required|email',
        		'site_address' => 'required',
        		'site_agreement' => 'required',
        		'site_privacy' => 'required'
        	]);

        	$settings = Setting::first();
        	$settings->site_name = request()->site_name;
        	$settings->site_phone = request()->site_phone;
        	$settings->site_email = request()->site_email;
        	$settings->site_address = request()->site_address;
        	$settings->site_agreement = request()->site_agreement;
        	$settings->site_privacy = request()->site_privacy;
        	
        	if ($settings->save()) {
        		return redirect()->route('backend.setting.index')->with('success','설정이 완료되었습니다.');
        	}
        	return back()->withInput();

        }
}
