<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Board;
use App\Reservation;
use App\Page;

class FrontController extends Controller
{
    public function index()
    {
    	$posts = Post::published()->latest()->take(5)->get();
    	$boards = Board::latest()->where('is_active',1)->take(5)->get();
    	$reservations = Reservation::latest()->take(5)->get();
    	$pages = Page::latest()->where('is_active',1)->take(5)->get();

    	return view('welcome', compact('posts','boards','reservations','pages'));
    }
}
