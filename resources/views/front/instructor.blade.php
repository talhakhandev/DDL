@extends('theme.master')
@section('title', "$user->fname")
@section('content')

@include('admin.message')
@include('sweetalert::alert')

<section id="instructor-block" class="instructor-main-block instructor-profile">
	 <div class="container">
	 	<div class="row">
	 		<div class="col-xl-8 col-lg-8 col-md-8">
	 			<div class="instructor-block">
	 				<div class="instructor-small-heading">{{ __('frontstaticword.Instructor') }}</div>
	 				<h1>{{ $user['fname'] }} {{ $user['lname'] }}</h1>
	 				@auth
	 				<div class="sub-heading">{{ $user['email'] }}</div>
	 				@endauth
	 				<div class="instructor-business-block">
		 				<div class="instructor-student">
		 					<div class="total-students">{{ __('frontstaticword.Totalstudents') }}</div>
		 					<div class="total-number">
		 						@php
	                                $data = App\Order::where('instructor_id', $user->id)->count();
	                                if($data > 0){

	                                    echo $data;
	                                }
	                                else{

	                                    echo "0";
	                                }
	                            @endphp
                        	</div>
		 				</div>
		 				
		 			</div>
		 			<div class="about-content-sidebar instructor-sidebar">
	                    <div class="row">
	                    	{{-- <div class="col-lg-4">
		                        <div class="about-content-img">
		                            <img src="https://image.flaticon.com/icons/png/512/149/149071.png" class="img-fluid" alt="">
		                        </div>
		                    </div> --}}
		                    <div class="col-lg-12">
		                    	<div class="row">
		                    		<div class="col-lg-8 col-12">
				                    	<div class="instructor-content-block">
					                        <h5 class="about-content-heading">{{ $user['fname'] }} {{ $user['lname'] }}</h5>

					                        

					                        @php

					                		$followers = App\Followers::where('user_id', '!=', $user->id)->where('follower_id', $user->id)->count();

					                		$followings = App\Followers::where('user_id', $user->id)->where('follower_id','!=', $user->id)->count();

					                		@endphp
					                       
					                        <div class="instructor-follower">
				                        		<div class="followers-status">
					                                <span class="followers-value">{{ $followers }}</span>
					                                <span class="followers-heading">Followers</span>
					                            </div>
				                        		<div class="following-status">
					                                <span class="followers-value">{{ $followings }}</span>
					                                <span class="followers-heading">Following</span>
					                            </div>
					                        </div>

					                        @php
			                    			$year = Carbon\Carbon::parse($user->created_at)->year;
			                    			$course_count = App\Course::where('user_id', $user->id)->count();
			                    			@endphp
					                        
					                        <div class="about-reward-badges">
					                            <img src="{{url('images/badges/1.png')}}" class="img-fluid" alt="" data-toggle="tooltip" data-placement="bottom" title="Member Since {{ $year }}">
					                            @if($course_count >= 5)
					                            <img src="{{url('images/badges/2.png')}}" class="img-fluid" alt="" data-toggle="tooltip" data-placement="bottom" title="Has {{ $course_count }} courses">
					                            @endif
					                            <img src="{{url('images/badges/3.png')}}" class="img-fluid" alt="" data-toggle="tooltip" data-placement="bottom" title="rating from 4 to 5">
					                            <img src="{{url('images/badges/4.png')}}" class="img-fluid" alt="" data-toggle="tooltip" data-placement="bottom" title=" {{ $data }} users has enrolled">
					                            <img src="{{url('images/badges/5.png')}}" class="img-fluid" alt="" data-toggle="tooltip" data-placement="bottom" title="Live classes {{ $live_class }}">
					                        </div>
					                    </div>
					                </div>
					                <div class="col-lg-4 col-12">
					                	<div class="instructor-btn">

					                		@auth

					                		@php

					                		$follow = App\Followers::where('follower_id', $user->id)->first();

					                		@endphp

					                		@if($follow == NULL)


					                		<form id="demo-form2" method="post" action="{{ route('follow') }}"
                                                data-parsley-validate class="form-horizontal form-label-left">
                                                    {{ csrf_field() }}

                                                <input type="hidden" name="follower_id"  value="{{$user->id}}" />

                                               
                                                 <button type="submit" class="btn btn-primary">&nbsp;Follow</button>
                                            </form>
					                		

                                            @else
                                            
					                		<form id="demo-form2" method="post" action="{{ route('unfollow') }}"
                                                data-parsley-validate class="form-horizontal form-label-left">
                                                    {{ csrf_field() }}

                                                <input type="hidden" name="user_id"value="{{$user->id}}" />
                                                <input type="hidden" name="instructor_id"  value="{{$user->id}}" />

                                                
                                                 <button type="submit" class="btn btn-secondary">&nbsp;Unfollow</button>
                                            </form>

                                            @endif

                                            @endauth

                                            

					                	</div>
					                </div>
				                </div>
		                    </div>
	                    </div>
	                </div>
		 			<div class="instructor-tabs">
            			<ul class="nav nav-tabs" id="tabs-tab" role="tablist">
			                <li class="nav-item">
			                    <a class="nav-link" id="about-tab" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="true">{{ __('frontstaticword.Aboutme') }}</a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" id="classes-tab" data-toggle="tab" href="#classes" role="tab" aria-controls="classes" aria-selected="false">{{ __('frontstaticword.MyCourses') }}</a>
			                </li>
			                <li class="nav-item">
			                    <a class="nav-link" id="badges-tab" data-toggle="tab" href="#badges" role="tab" aria-controls="badges" aria-selected="false">Badges</a>
			                </li>
			            </ul>
			            <div class="tab-content" id="nav-tabContent">
			                <div class="tab-pane active show" id="about" role="tabpanel" aria-labelledby="about-tab">
			                	<div class="instructor-tabs-content">
			                		{!! $user['detail'] !!}
			                	</div>
                			</div>
			                <div class="tab-pane fade" id="classes" role="tabpanel" aria-labelledby="classes-tab">
			                	<div class="about-instructor">
							        <div class="row">
					 					@foreach($course as $c)
					              @if($c->status == 1)
					                <div class="col-lg-6 col-sm-6">
					                	<div class="student-view-block">
					                        <div class="view-block">
					                            <div class="view-img">
					                                @if($c['preview_image'] !== NULL && $c['preview_image'] !== '')
					                                    <a href="{{ route('user.course.show',['id' => $c->id, 'slug' => $c->slug ]) }}"><img src="{{ asset('images/course/'.$c['preview_image']) }}" alt="course" class="img-fluid"></a>
					                                @else
					                                    <a href="{{ route('user.course.show',['id' => $c->id, 'slug' => $c->slug ]) }}"><img src="{{ Avatar::create($c->title)->toBase64() }}" alt="course" class="img-fluid"></a>
					                                @endif
					                            </div>
					                            <div class="view-dtl">
					                                <div class="view-heading btm-10"><a href="{{ route('user.course.show',['id' => $c->id, 'slug' => $c->slug ]) }}">{{ str_limit($c->title, $limit = 30, $end = '...') }}</a></div>
					                                <p class="btm-10"><a herf="#">by {{ $c->user['fname'] }}</a></p>
					                                <div class="rating">
					                                    <ul>
					                                        <li>
					                                            <?php 
					                                            $learn = 0;
					                                            $price = 0;
					                                            $value = 0;
					                                            $sub_total = 0;
					                                            $sub_total = 0;
					                                            $reviews = App\ReviewRating::where('course_id',$c->id)->get();
					                                            ?> 
					                                            @if(!empty($reviews[0]))
					                                            <?php
					                                            $count =  App\ReviewRating::where('course_id',$c->id)->count();

					                                            foreach($reviews as $review){
					                                                $learn = $review->price*5;
					                                                $price = $review->price*5;
					                                                $value = $review->value*5;
					                                                $sub_total = $sub_total + $learn + $price + $value;
					                                            }

					                                            $count = ($count*3) * 5;
					                                            $rat = $sub_total/$count;
					                                            $ratings_var = ($rat*100)/5;
					                                            ?>
					                            
					                                            <div class="pull-left">
					                                                <div class="star-ratings-sprite"><span style="width:<?php echo $ratings_var; ?>%" class="star-ratings-sprite-rating"></span>
					                                                </div>
					                                            </div>
					                                       
					                                             
					                                            @else
					                                                <div class="pull-left">{{ __('frontstaticword.NoRating') }}</div>
					                                            @endif
					                                        </li>
					                                        <!-- overall rating-->
					                                        <?php 
					                                        $learn = 0;
					                                        $price = 0;
					                                        $value = 0;
					                                        $sub_total = 0;
					                                        $count =  count($reviews);
					                                        $onlyrev = array();

					                                        $reviewcount = App\ReviewRating::where('course_id', $c->id)->WhereNotNull('review')->get();

					                                        foreach($reviews as $review){

					                                            $learn = $review->learn*5;
					                                            $price = $review->price*5;
					                                            $value = $review->value*5;
					                                            $sub_total = $sub_total + $learn + $price + $value;
					                                        }

					                                        $count = ($count*3) * 5;
					                                         
					                                        if($count != "")
					                                        {
					                                            $rat = $sub_total/$count;
					                                     
					                                            $ratings_var = ($rat*100)/5;
					                                   
					                                            $overallrating = ($ratings_var/2)/10;
					                                        }
					                                         
					                                        ?>

					                                        @php
					                                            $reviewsrating = App\ReviewRating::where('course_id', $c->id)->first();
					                                        @endphp
					                                        @if(!empty($reviewsrating))
					                                        <li>
					                                            <b>{{ round($overallrating, 1) }}</b>
					                                        </li>
					                                        @endif
					                                      <li>({{ $c->order->count() }})</li> 
					                                    </ul>
					                                </div>
					                                @if( $c->type == 1)
					                                    <div class="rate text-right">
					                                        <ul>
					                                            @php
					                                                $currency = App\Currency::first();
					                                            @endphp

					                                            @if($c->discount_price == !NULL)

					                                                <li><a><b><i class="{{ $currency->icon }}"></i>{{ $c->discount_price }}</b></a></li>&nbsp;
					                                                <li><a><b><strike><i class="{{ $currency->icon }}"></i>{{ $c->price }}</strike></b></a></li>
					                                                
					                                            @else
					                                                <li><a><b><i class="{{ $currency->icon }}"></i>{{ $c->price }}</b></a></li>
					                                            @endif
					                                        </ul>
					                                    </div>
					                                @else
					                                    <div class="rate text-right">
					                                        <ul>
					                                            <li><a><b>{{ __('frontstaticword.Free') }}</b></a></li>
					                                        </ul>
					                                    </div>
					                                @endif
					                            </div>
					                        </div>
					                    </div>
					                </div> 
					              @endif
					            @endforeach

							        </div>
									<div class="pull-right">{{ $course->links() }}</div>
		 						</div>
	                		</div>
	                		<div class="tab-pane fade" id="badges" role="tabpanel" aria-labelledby="badges-tab">
	                    		<div class="tab-reward-badges">

	                    		
	                    			<div class="row">
							            <div class="col-lg-6">
							                <div class="tab-badges-block text-center">
							                    <img src="{{url('images/badges/1.png')}}" class="img-fluid" alt="">
							                    <div class="tab-badges-heading">Trusted User</div>
							                    <p>Member since {{ $year }}</p>
							                </div>
							            </div>
							            @if($course_count >= 5)
							            <div class="col-lg-6">
							                <div class="tab-badges-block text-center">
							                    <img src="{{url('images/badges/2.png')}}" class="img-fluid" alt="">
							                    <div class="tab-badges-heading">Senior Instructor</div>
							                    <p>Has {{ $course_count }} Courses</p>
							                </div>
							            </div>
							            @endif
							            <div class="col-lg-6">
							                <div class="tab-badges-block text-center">
							                    <img src="{{url('images/badges/3.png')}}" class="img-fluid" alt="">
							                    <div class="tab-badges-heading">Golden Courses</div>
							                    <p>Courses Rating from 4 to 5</p>
							                </div>
							            </div>
							            <div class="col-lg-6">
							                <div class="tab-badges-block text-center">
							                    <img src="{{url('images/badges/4.png')}}" class="img-fluid" alt="">
							                    <div class="tab-badges-heading">Best Seller</div>
							                    <p>{{ $data }} Courses Sales</p>
							                </div>
							            </div>
							            <div class="col-lg-6">
							                <div class="tab-badges-block text-center">
							                    <img src="{{url('images/badges/5.png')}}" class="img-fluid" alt="">
							                    <div class="tab-badges-heading">Active Classes </div>
							                    <p>Live classes {{ $live_class }}</p>
							                </div>
							            </div>
							        </div>
	    						</div>
	                		</div>
	                	</div>
        			</div>
			 	</div>
	 		</div>
	 		<div class="col-xl-4 col-lg-4 col-md-4">
	 			<div class="instructor-img">
	 				@if($user['user_img'] != null || $user['user_img'] !='')
	 					<img src="{{ asset('images/user_img/'.$user['user_img']) }}" alt="img" class="img-fluid">
	 				@else
	 					<img src="{{ asset('images/default/user.jpg')}}" alt="img" class="img-fluid">
                    @endif

	 			</div>
	 			<div class="instructor-link">
					<ul>
						@if($user->linkedin_url != NULL)
							<li><a href="{{ $user->linkedin_url }}" target="_blank" title="linkedin"><i data-feather="linkedin"></i></a></li>
						@endif
						@if($user->twitter_url != NULL)
							<li><a href="{{ $user->twitter_url }}" target="_blank" title="twitter"><i data-feather="twitter"></i></a></li>
						@endif
						@if($user->fb_url != NULL)
							<li><a href="{{ $user->fb_url }}" target="_blank" title="facebook"><i data-feather="facebook"></i></a></li>
						@endif
						@if($user->youtube_url != NULL)
							<li><a href="{{ $user->youtube_url }}" target="_blank" title="youtube"><i data-feather="youtube"></i></a></li>
						@endif
					</ul>
	 			</div>
	 		</div>
		</div>
	 </div>
</section>
<hr>
@endsection


