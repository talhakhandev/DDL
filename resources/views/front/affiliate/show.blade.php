<!-- Affiliate Refferal section start -->
@extends('theme.master')
@section('title', 'Reffer Link')
@section('content')

@include('admin.message')

<!-- affiliate-header start -->
<section id="blog-home" class="blog-home-main-block">
    <div class="container">
        <h1 class="blog-home-heading text-white">{{ __('frontstaticword.Refer&Earn') }}</h1>
    </div>
</section> 
<!-- affiliate-header end -->

<!-- affiliate-user-link start -->
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
                        <li><i class="fas fa-chalkboard-teacher"></i><a href="#" data-toggle="modal" data-target="#myModalinstructor" title="Become An Instructor">{{ __('frontstaticword.BecomeAnInstructor') }}</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8">

                <div class="profile-info-block user-bank-button">

                    <h4 class="">{{ __('Your Refferal Link') }}</h4>

      				@auth


                    <div class="input-group mb-3">
                      <input type="text" id="myInput" class="form-control" value="{{ url('/register') . '/?ref=' . Auth::user()->affiliate_id }}" >
                      <div class="input-group-append">
                        <button onclick="myFunction()" class="btn btn-primary" type="button"><i data-feather="copy"></i></button>
                      </div>
                    </div>


					@endauth

                    @if(auth()->user()->affiliate_id == NULL)

		            <form id="mainform" action="{{ route('generate.affiliate') }}" method="POST">
		              @csrf

		                <button type="submit" class="pull-left btn btn-primary">
		                  {{ __('frontstaticword.GenerateAffiliateLink') }}
		                </button>
		              </div>

		            </form>

                    @endif

                    @php
                      $affilates = App\Affiliate::first();
                    @endphp
                      
                    @if(isset($affilates))
                        @if($affilates['image'] !== NULL && $affilates['image'] !== '')
                        
                            <div class="recommendation-main-block  text-center" style="background-image: url('{{ asset('images/affiliate/'.$affilates['image']) }}')">
                           
                            </div>
                            <br>
                        @endif
                        <div class="info">{!! $affilates->text !!}</div>
                    @endif
                 
                    <br>
                </div>
                
            </div>
        </div>
    </div>
</section>
<!-- affiliate-user-link end -->
@endsection
<!-- Affiliate Refferal section end -->