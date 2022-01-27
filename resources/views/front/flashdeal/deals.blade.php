@extends('theme.master')
@section('title', 'Flash Deals')
@section('content')

@include('admin.message')

<!-- about-home start -->
<section id="wishlist-home" class="wishlist-home-main-block">
    <div class="container">
        <h1 class="wishlist-home-heading text-white">{{ __('Flash Deals') }}</h1>
    </div>
</section> 


@if($deals!= NULL)
<section id="learning-courses" class="learning-courses-main-block">
    <div class="container">
        <div class="row">
        	@foreach($deals as $deal)
            @if($deal->status == '1')
        	
                <div class="col-lg-3 col-sm-6 col-md-4">
                    <div class="view-block">
                        <div class="view-img">
                            @if($deal['background_image'] !== NULL && $deal['background_image'] !== '')
                                <a href="{{ route('deal.items',$deal->id) }}"><img src="{{ asset('images/flashdeals/'.$deal->background_image) }}" class="img-fluid" alt="course">
                            @else
                                <a href="{{ route('deal.items',$deal->id) }}"><img src="{{ Avatar::create($deal->title)->toBase64() }}" class="img-fluid" alt="course">
                            @endif
                            </a>
                        </div>
                        
                        <div class="view-dtl">
                            <div class="view-heading btm-10"><a href="{{ route('deal.items', $deal->id) }}">{{ str_limit($deal->title, $limit = 35, $end = '...') }}</a></div>
                            <p class="btm-10"><a href="#">{{ __('Sale Start Date') }}: {{ date('jS F Y', strtotime($deal->start_date)) }}</a></p>

                            <p class="btm-10"><a href="#">{{ __('Sale End Date') }}: {{ date('jS F Y', strtotime($deal->end_date)) }}</a></p>
                          
                            
                        </div>
                    </div>
                    <div class="wishlist-action">
                        <div class="row">
                        	<div class="col-md-12 col-12">
                        		<div class="flash-button">
                               		<a href="{{ route('deal.items',$deal->id) }}" class="btn btn-primary">{{ __('View Deal') }}</a>
                               	</div>
                              
                        	</div>
                        	
                        </div>
                    </div>
                </div>
           
            @endif
            @endforeach
        </div>
    </div>
    
</section>
@else
    <section id="search-block" class="search-main-block search-block-no-result text-center">
        <div class="container">
            <div class="no-result-courses btm-10">{{ __('No Deals Found') }}</div>
            <div class="recommendation-btn text-white text-center">
                <a href="{{ url('/') }}" class="btn btn-primary" title="search"><b>{{ __('frontstaticword.Browse') }}</b></a>
            </div> 
        </div>
    </section>
@endif


@endsection