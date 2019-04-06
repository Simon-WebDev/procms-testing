<?php

namespace App\Http\Controllers;

use App\Notifications\ReservationNotification;
use App\Reservation;
use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ReservationsController extends Controller
{
    /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */

        public function __construct()
        {
            $this->middleware('auth',['except' => ['index']]);
            
            
        }
        

        public function index()
        {
            
            // $data = Reservation::get(['id', 'title', 'start', 'end', 'staff_id','user_id','color','phone']);
            if (Auth::check()) {
                $data = Reservation::where('user_id',Auth::user()->id)->get();
            }else{
                $data = Reservation::all();
            }
           
           
            $data=Response()->json($data);
            
            
            return $data;
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            //
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
                 // 'title' => 'required',
                 'date_start' => 'required',
                 'time_start' => 'required',
                 'staff_id'   => 'required',
                 'phone' => 'required'
                 // 'date_end'  =>'required'
            ]);
            // Validator::extend('phone', function($attribute, $value, $parameters, $validator) {
            //         return preg_match('/^(01[016789]{1}|070|02|0[3-9]{1}[0-9]{1})-[0-9]{3,4}-[0-9]{4}$/', $value) && strlen($value) >= 10;
            //     });
            
            $reservation = new Reservation();
            
            $reservation->title = Auth::user()->name;
            $reservation->start = $request->date_start . ' ' . $request->time_start;
            $mystart_time=strtotime($reservation->start);
            $endTime = date('Y-m-d H:i',strtotime("+20 minutes", $mystart_time));
            $reservation->end = $endTime;

            $reservation->user_id = Auth::user()->id;
            $reservation->staff_id=$request->staff_id;
            $staff= Staff::find($request->staff_id);
            $reservation->color = $staff->color;
            $reservation->phone = $request->phone;
            $reservation->save();
            Auth::user()->notify(new ReservationNotification($reservation));
            Session::flash('success', Auth::user()->name.'님  '.$request->date_start.'일  '.$request->time_start.'에 '.$staff->name.'님으로 예약 되었습니다.');

            return redirect('/reservation');
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
           $this->validate($request,[
                // 'title' => 'required',
                '_date_start' => 'required',
                '_time_start' => 'required',
                '_staff_id'   => 'required',
                '_phone' => 'required'
                // 'date_end'  =>'required'
           ]);
           
           $reservation = Reservation::find($id);
          
           $reservation->title = Auth::user()->name;

           $reservation->start = $request->_date_start . ' ' . $request->_time_start;
          $mystart_time=strtotime($reservation->start);
          $endTime = date('Y-m-d H:i',strtotime("+20 minutes", $mystart_time));
          $reservation->end = $endTime;
          
          $reservation->user_id = Auth::user()->id;
          $reservation->staff_id=$request->_staff_id;
          $staff= Staff::find($request->_staff_id);
          $reservation->color = $staff->color;
          $reservation->phone = $request->_phone;
           
           if($reservation->save()==null){
            Session::flash('error','예약이 되지 않았습니다.');
            return Response()->json([
                'message'   => "update faulure"
            ]);
           }
           Session::flash('success', Auth::user()->name.'님,  '.$request->_date_start.'일  '.$request->_time_start.'  '.$staff->name.'님으로 예약이 변경 되었습니다.');
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
            Session::flash('success','예약을 취소하셨습니다.');
            return Response()->json([
                'message'   =>  'success delete.'
            ]);


            

        }
}
