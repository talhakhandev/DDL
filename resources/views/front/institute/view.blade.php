@extends('theme.master')
@section('title', 'Institute Profile')
@section('content')

@include('admin.message')
<!-- about-home start -->
<section id="blog-home" class="blog-home-main-block">
    <div class="container">
        <h1 class="blog-home-heading">{{ __('Institute Profile') }}</h1>
    </div>
</section> 
<!-- about-home end --> 
<style>
    .border1{
        border-style: dotted;
  border-width: 2px;
    }
    .instructor-img img {
     
        height: 500px;
        position: relative;
        width:100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    .top-right {
  position: absolute;
  top: 8px;
  right: 16px;
}
.instructor-img {
    
}
.blog-main-block {
    margin-top: -200px;
    margin-bottom: 40px;
    border
}

.left-course{
    margin-left: 16rem!important;
}

.border-color{
    border:2px solid;
    width: 75px;
    border-color: orange;
    border-radius: 10px;

    box-shadow:0 3px 6px 0 orange;
    padding:15px;
}
.course-icon{
    color:orange;
    font-size: 30px;
}
.border2-color{
    border:2px solid;
    width: 75px;
    border-color: #00BFFF;
    border-radius: 10px;

    box-shadow:0 3px 6px 0 #00BFFF;
    padding:15px;
}
.course2-icon{
    color:#00BFFF;
    font-size: 30px;
}
.border1-color{
    border:2px solid;
    width: 75px;
    border-color: #A52A2A;
    border-radius: 10px;

    box-shadow:0 3px 6px 0 #A52A2A;
    padding:15px;
}
.course1-icon{
    color:#A52A2A;
    font-size: 30px;
}

</style>
<div class="instructor-img">
    <img src="{{ asset('images\default\insti_back.png') }}" alt="" class="back_img ">
</div>
<section id="blog" class="blog-main-block">
   
    <div class="container">
       
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <img src="{{ asset('files/institute/'.$data->image) }}" class="img-fluid" alt="" style="height:200px; width:200px; border-radius:50%">
                    </div>
                    <div class="col-md-9">
                        <h5 class="card-title">{{ $data->title }}
                        @if($data->verified)
                            <img src="{{ url('admin_assets\assets\images\verified.png') }}" alt="">
                            @endif
                        </h5>
                        @php
                            $year = Carbon\Carbon::parse($data->created_at)->year;
                            $course_count = App\Course::where('institude_id',$data->id)->count();
                            $enroll_count = App\Order::where('course_id', $course->id)->count();
                            $live_1 = App\Meeting::where('course_id','=',$course->id)->count();
                            $live_2 = App\Googlemeet::where('course_id','=',$course->id)->count();
                            $live_3 = App\JitsiMeeting::where('course_id','=',$course->id)->count();
                            $live_4 = App\BBL::where('course_id','=',$course->id)->count();

                            $live_class = $live_1 + $live_2 + $live_3 + $live_4;
                        @endphp

                        <div class="about-reward-badges text-left">
                            <img src="{{url('images/badges/1.png')}}" class="img-fluid" alt="" data-toggle="tooltip" data-placement="bottom" title="Member Since {{ $year }}">
                            @if($course_count >= 5)
                            <img src="{{url('images/badges/2.png')}}" class="img-fluid" alt="" data-toggle="tooltip" data-placement="bottom" title="Has {{ $course_count }} courses">
                            @endif
                            <img src="{{url('images/badges/3.png')}}" class="img-fluid" alt="" data-toggle="tooltip" data-placement="bottom" title="rating from 4 to 5">
                            <img src="{{url('images/badges/4.png')}}" class="img-fluid" alt="" data-toggle="tooltip" data-placement="bottom" title="{{ $enroll_count }} users has enrolled">
                            <img src="{{url('images/badges/5.png')}}" class="img-fluid" alt="" data-toggle="tooltip" data-placement="bottom" title="Live classes {{ $live_class }}">
                        </div>
                    </div>
                    
                    <div class="col-md-3 left-course"> 
                        @php
                            $inst_count = App\Course::where('institude_id',$data->id)->count();
                        @endphp
                        
                            <div class="border-color text-center">
                                <i class="fa fa-users course-icon"  aria-hidden="true"></i>
                            </div>
                            <p class="mt-2">{{ $inst_count }}</p>
                           

                            <p>Courses</p>
                        
                    </div>
                    <div class="col-md-3 border2">
                        @php
                            $instii= App\Course::where('institude_id',$data->id)->get();
                            $count = 0;
                            $count1 = 0;
                        @endphp
                        
                            
                        @foreach($instii as $value)
                        @php

                            $instii_count = App\Order::where('course_id',$value->id)->count();
                            $count  = $count + $instii_count;
                            
                        @endphp
                        
                        
                        @endforeach
                        

                        

                      
                        <div class="border1-color text-center">
                            <i class="fa fa-graduation-cap  course1-icon" aria-hidden="true"></i>
                           
                        </div>
                        <p class="mt-2">{{ $count }}</p>
                        
                        <p>Students</p>
                    </div>

                   
                        
                    <div class="col-md-3 border3 ">
                       
                        <div class="border2-color text-center">
                            <i class="fa fa-video-camera  course2-icon" aria-hidden="true"></i>
                            
                           
                        </div>
                        
                        <p class="mt-2">{{ $live_class }}</p>
                        <p>Meetings</p>

                    </div>
                </div>
              
                
                
            </div>
        </div>
    </div>
  
</section>

<section id="blog" class="blog--block mb-4">
   
    <div class="container">
<div class="card mt-3">
    <div class="card-body">
        
        <div class="row">
            <div class="col-md-12">
                <h5>About</h5>
                <p >{{ $data->detail }}</p>
            </div>
            <div class="col-md-12">
                <h5>Skill</h5>
                <p >{{ $data->skill }}</p>
            </div>
            @if(isset($data->email))
             <div class="col-md-12">
                <h5>Email</h5>
                <p >{{ $data->email ?? '' }}</p>
            </div>
            @endif
            @if(isset($data->mobile))
            <div class="col-md-12">
                <h5>Mobile</h5>
                <p >{{ $data->mobile ?? '' }}</p>
            </div>
            @endif
        </div>
      
        
    </div>
</div>
</div>
  
</section>


<!-- blog end -->

@endsection
