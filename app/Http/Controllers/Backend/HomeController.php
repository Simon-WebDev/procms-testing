<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\AccountUpdateRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\Board;
use App\Charts\DashboardChart;
use App\Comment;

class HomeController extends BackendController
{
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $morris_users = User::where('created_at', '>=', Carbon::now()->subYears(1))
              ->select(DB::raw("COUNT(*) as date, DATE_FORMAT(created_at, '%Y-%m') as month"))
              ->groupBy('month')
        

              ->get();

        $chart =  new DashboardChart();
        $days = $this->generateDateRange(Carbon::now()->subDays(30), Carbon::now());

        $boards = [];        ;
        
        foreach ($days as $day) {
          $boards[] = Board::whereDate('created_at',$day)->count();
        } 
        $comments = [];
        foreach ($days as $day) {
          $comments[] = Comment::whereDate('created_at',$day)->count();
        } 
        $chart->dataset('게시판','line',$boards)->color('#e84118');
        $chart->dataset('블로그댓글','line',$comments)->color('#0097e6');
        $chart->labels($days)->height(400);
      
        
        return view('backend.home.index',compact('morris_users','chart'));
    }

    private function generateDateRange(Carbon $start_date, Carbon $end_date)
    {
        $dates = [];
        for ($date = $start_date; $date->lte($end_date)  ; $date->addDay()) { 
            $dates[] = $date->format('Y-m-d'); 
        }
        return $dates;
    }

    public function edit(Request $request)
    {
    	$user = $request->user();
    	return view('backend.home.edit', compact('user'));
    }

    public function update(AccountUpdateRequest $request)
    {
    	$user = $request->user();
    	$data = $request->all();
      
    	if ($data['password'] == "") {
    	    $data=$request->except('password');
    	    $data['password'] = $user->password;
    	}else{
    	    $data=$request->all();
    	    $data['password'] =bcrypt($request->password);
    	}
    	$user->update($data);


    	return redirect()->back()->with('message','프로필을 수정하셨습니다.');
    }


    
}
