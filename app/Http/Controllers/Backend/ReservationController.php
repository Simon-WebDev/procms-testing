<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Reservation;
use App\Staff;
use Auth;

class ReservationController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
            public function index()
            {
                
                // $staffs=Staff::all();
                $data = Reservation::get(['id', 'title', 'start', 'end', 'staff_id','user_id','color','phone']);
                
                foreach (Auth::user()->unreadNotifications as $unreadNotification) {
                   
                   if ($unreadNotification->type == "App\Notifications\ReservationNotification") {
                      $unreadNotification->markAsRead();
                   }
                }
               
                //$staffs=Staff::pluck('name','id')->all()->toArray();
                Response()->json($data);
                
                return $data;
                
            }

            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
                
                
            }

            /**
             * Store a newly created resource in storage.
             *
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response
             */
            public function store(Request $request)
            {
                
                $this->validate($request,[
                     'title' => 'required',
                     'date_start' => 'required',
                     'time_start' => 'required'
                     // 'date_end'  =>'required'
                ]);
                $reservation = new Reservation();
                
                $reservation->title = $request->input('title');
                $reservation->start = $request->input('date_start') . ' ' . $request->input('time_start');
                
                $mystart_time=strtotime($reservation->start);
                $endTime = date('Y-m-d H:i',strtotime("+20 minutes", $mystart_time));
                $reservation->end = $endTime;
                $reservation->staff_id=$request->input('staff_id');
                $staff= Staff::find($request->input('staff_id'));
                $reservation->color = $staff->color;
                $reservation->phone = $request->input('phone');
                
               
                $reservation->save();
                Session::flash('success','새예약 되었습니다.');

                return redirect('backend/reservation');
            }

            /**
             * Display the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
                //
            }

            /**
             * Show the form for editing the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
               
            }

            /**
             * Update the specified resource in storage.
             *
             * @param  \Illuminate\Http\Request  $request
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function update(Request $request, $id)
            {
               
               
               $reservation = Reservation::find($id);
               
               $reservation->title = $request->input('_title');
               $reservation->start = $request->input('_date_start') . ' ' . $request->input('_time_start');
               // $reservation->end = $request->date_end;
               $mystart_time=strtotime($reservation->start);
               $endTime = date('Y-m-d H:i',strtotime("+20 minutes", $mystart_time));
               $reservation->end = $endTime;

               // $staffs = Staff::pluck('name','id')->all();
               
               $reservation->staff_id=$request->input('_staff_id');
               $staff= Staff::find($request->input('_staff_id'));
               $reservation->color = $staff->color;
               $reservation->phone = $request->input('_phone');
                          
               
               if($reservation->update()){
                return Response()->json([
                    'message'   => "update faulure"
                ]);
               }
               return Response()->json([
                   'message'   =>  'update success.'
               ]);
               
            }

            /**
             * Remove the specified resource from storage.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {
                $reservation = Reservation::find($id);

                if($reservation == null)
                    return Response()->json([
                        'message'   =>  'error delete.'
                    ]);

                $reservation->delete();

                return Response()->json([
                    'message'   =>  'success delete.'
                ]);

            }

            public function allStaffData()
            {
                $staffs=Staff::all();
                return view('backend.reservation', compact('staffs'));
            }
}
