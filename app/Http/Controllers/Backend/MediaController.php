<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MediaController extends BackendController
{
    public function index()
    {
    	return view('backend.media.index');
    }
}
