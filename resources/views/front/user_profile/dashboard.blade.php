@extends('theme.master')
@section('title', 'Profile & Setting')
@section('content')

@include('admin.message')


<!-- about-home start -->
<section id="blog-home" class="blog-home-main-block">
    <div class="container">
        <h1 class="blog-home-heading text-white">{{ __('Dashboard') }}</h1>
    </div>
</section> 
<!-- profile update start -->
<section id="profile-item" class="profile-item-block">
    <div class="container">
    	

        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <div class="dashboard-author-block text-center">
                    <div class="author-image">
					    <div class="avatar-upload">
					        
					        <div class="avatar-preview">
					        	@if(Auth::User()->user_img != null || Auth::User()->user_img !='')
						            <div class="avatar-preview-img" id="imagePreview" style="background-image: url({{ url('/images/user_img/'.Auth::User()->user_img) }});">
						            </div>
						        @else
						        	<div class="avatar-preview-img" id="imagePreview" style="background-image: url({{ asset('images/default/user.jpg')}});">
						            </div>
						        @endif
					        </div>
					    </div>
                    </div>
                    <div class="author-name">{{ Auth::User()->fname }}&nbsp;{{ Auth::User()->lname }}</div>

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

                </div>
                <div class="dashboard-items">
                    <ul>

                        @php
                        $fullname = isset($user['fname']) . ' ' . isset($user['lname']);
                        $fullname = preg_replace('/\s+/', '', $fullname);
                        @endphp

                        <li><i class="fa fa-bookmark"></i><a href="{{ route('instructor.profile', ['id' => $user->id, 'name' => $fullname] ) }}" title="Dashboard">{{ __('My Profile') }}</a></li>

                        <li><i class="fa fa-bookmark"></i><a href="{{ route('mycourse.show') }}" title="Dashboard">{{ __('MyCourses') }}</a></li>
                        
                        <li><i class="fa fa-heart"></i><a href="{{ route('get.affiliate') }}" title="Profile Update">{{ __('Marketing') }}</a></li>
                        
                        <li><i class="fa fa-bank"></i><a href="{{route('profile.show',Auth::User()->id)}}" title="Upload Items">{{ __('Settings') }}</a></li>

                        <li><i class="fa fa-check"></i>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                              
                                    {{ __('frontstaticword.Logout') }}
                                    
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="display-none">
                                        @csrf
                                    </form>
                               
                            </a>
                        </li>

                         
                    </ul>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8">

                
            </div>
        </div>

    </div>
</section>
<!-- profile update end -->
@endsection

@section('custom-script')

<script>
(function($) {
  "use strict";
	function readURL(input) {
	if (input.files && input.files[0]) {
	    var reader = new FileReader();
	    reader.onload = function(e) {
	        $('#imagePreview').css('background-image', 'url('+e.target.result +')');
	        $('#imagePreview').hide();
	        $('#imagePreview').fadeIn(650);
	    }
	    reader.readAsDataURL(input.files[0]);
		}
	}
	$("#imageUpload").change(function() {
	    readURL(this);
	});
})(jQuery);
</script>


@endsection
