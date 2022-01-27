<!-- User Wallet page start -->
@extends('theme.master')
@section('title', __('My Wallet'))
@section('content')

@include('admin.message')

<!-- wallet-header start -->
<section id="blog-home" class="blog-home-main-block">
    <div class="container">
        <h1 class="blog-home-heading text-white">{{ __('frontstaticword.MyWallet') }}</h1>
    </div>
</section> 
<!-- wallet-header end -->
<!-- user wallet page start -->
<section id="profile-item" class="profile-item-block">
    <div class="container">

        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <div class="dashboard-author-block text-center">
                    <div class="author-image">
					    <div class="avatar-upload">
					        <div class="avatar-preview">
					        	@if(Auth::user()->user_img != null || Auth::user()->user_img !='')
						            <div class="avatar-preview-img" id="imagePreview" style="background-image: url({{ url('/images/user_img/'.Auth::user()->user_img) }});">
						            </div>
						        @else
						        	<div class="avatar-preview-img" id="imagePreview" style="background-image: url({{ asset('images/default/user.jpg')}});">
						            </div>
						        @endif
					        </div>
					    </div>
                    </div>
                    <div class="author-name">{{ Auth::user()->fname }}&nbsp;{{ Auth::user()->lname }}</div>
                </div>
                <div class="dashboard-items">
                    <ul>
                        <li><i class="fa fa-bookmark"></i><a href="{{ route('mycourse.show') }}" title="Dashboard">{{ __('frontstaticword.MyCourses') }}</a></li>
                        <li><i class="fa fa-heart"></i><a href="{{ route('wishlist.show') }}" title="Profile Update">{{ __('frontstaticword.MyWishlist') }}</a></li>
                        <li><i class="fa fa-history"></i><a href="{{ route('purchase.show') }}" title="Followers">{{ __('frontstaticword.PurchaseHistory') }}</a></li>
                        <li><i class="fa fa-user"></i><a href="{{route('profile.show',Auth::user()->id)}}" title="Upload Items">{{ __('frontstaticword.UserProfile') }}</a></li>
                        @if(Auth::user()->role == "user")
                        <li><i class="fas fa-chalkboard-teacher"></i><a href="#" data-toggle="modal" data-target="#myModalinstructor" title="{{ __("Become An Instructor") }}">{{ __('frontstaticword.BecomeAnInstructor') }}</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8">

                <div class="profile-info-block user-bank-button">

                	<h4 class="">{{ __('frontstaticword.MyWallet') }}</h4>
			            <h4 class="">{{ __('frontstaticword.CurrentBalance') }} :
			         

			            <div class="display-inline">
                        @if(isset($user->wallet))
                            <i class="{{ $currency->icon }}"></i>{{ sprintf("%.2f",strip_tags($user->wallet->balance)) }} 
                        @endif 
                  </div>
                  </h4>
			        
          			
          		 <div class="">{{ __('Add balance To Wallet') }}:</div>

                  <form id="" action="{{ route('wallet.payment') }}" method="POST">
                    @csrf

                    <div class="form-group">
                    
                      <input name="amount" required="" type="number" class="form-control" value="1.00" placeholder="0.00" min="1" step="0.01" aria-describedby="basic-addon1">
                    </div>
                    <br>
                  
                      <button type="submit" class="btn btn-primary">
                        {{ __('Procceed') }}
                      </button>

                  </form>
               
                   
                </div>
                
            </div>
        </div>
    </div>
</section>
@endsection
<!-- User Wallet page end -->
