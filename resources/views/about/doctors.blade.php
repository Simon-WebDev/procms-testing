@extends('layouts.main')


@section('mainnav')
    @include('layouts.mainnav')
@endsection


@section('content')
   <div class="container">
   	<div class="row">
   		<div class="col-md-6 doctor">
   			<figure>
   				<img src="{{asset('images/doctor-chase.jpg')}}" class="img-responsive">
   				<figcaption>
   					<h3>Dr. Jonathon Alex</h3>
   					<h5>MBBS (Sydney), FRACS (Paediatric Surgery)</h5>
   					<p>Suite 27, Medical Centre, The Sunshine Coast Private Hospital, QLD 4556</p>
   				</figcaption>
   			</figure>
   		</div>
   		<div class="col-md-6 doctor">
            <div class="box">
               <div class="box-header">
                  <h3>Dr. Jonathon Alex</h3>
               </div>
      			<div class="box-body">
         			<h5>MBBS (Sydney), FRACS (Paediatric Surgery)</h5>
         			<p>Suite 27, Medical Centre, The Sunshine Coast Private Hospital, QLD 4556</p>
         			<hr>
         			<h3>SPECIALTIES & QUALIFICATIONS</h3>
         			<h5>Specialtiy: Endocrinology</h5>
         			<p>Specialty of medicine; some would say a sub-specialty of internal medicine, which deals with the diagnosis and treatment of diseases related to hormones.</p>
         			<h5>Specialtiy: Paediatric Medicine</h5>
         			<p>Specialty of medicine; some would say a sub-specialty of internal medicine, which deals with the diagnosis and treatment of diseases related to hormones.</p>
         			<p>이미지 사이즈는 720픽셀 이상이어야 한다. 730 이상이 맞다고 본다.</p>
               </div>
            </div>
   		</div>
   	</div>
      <hr>

   	<div class="row">
         <div class="m-t-40"></div>
   		<div class="col-md-6 doctor col-md-push-6">
   			<figure>
   				<img src="{{asset('images/doctor-sanders.jpg')}}" class="img-responsive">
   				<figcaption>
   					<h3>Dr. Jonathon Alex</h3>
   					<h5>MBBS (Sydney), FRACS (Paediatric Surgery)</h5>
   					<p>Suite 27, Medical Centre, The Sunshine Coast Private Hospital, QLD 4556</p>
   				</figcaption>
   			</figure>
   		</div>
   		<div class="col-md-6 doctor col-md-pull-6">
            <div class="box">
               <div class="box-header">
         			<h3>Dr. Jonathon Alex</h3>
               </div>
               <div class="box-body">
         			<h5>MBBS (Sydney), FRACS (Paediatric Surgery)</h5>
         			<p>Suite 27, Medical Centre, The Sunshine Coast Private Hospital, QLD 4556</p>
         			<hr>
         			<h3>SPECIALTIES & QUALIFICATIONS</h3>
         			<h5>Specialtiy: Endocrinology</h5>
         			<p>Specialty of medicine; some would say a sub-specialty of internal medicine, which deals with the diagnosis and treatment of diseases related to hormones.</p>
         			<h5>Specialtiy: Paediatric Medicine</h5>
         			<p>Specialty of medicine; some would say a sub-specialty of internal medicine, which deals with the diagnosis and treatment of diseases related to hormones.</p>
         			<p>이미지 사이즈는 720픽셀 이상이어야 한다. 730 이상이 맞다고 본다.</p>
               </div>
            </div>
   		</div>
   	</div>
      <hr>
   </div>
@endsection



@section('mainfooter')
    @include('layouts.mainfooter')
@endsection