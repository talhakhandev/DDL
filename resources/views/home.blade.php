@extends('theme.master')
@section('title', 'Online Courses')
@section('content')

@include('admin.message')
@include('sweetalert::alert')

@section('meta_tags')

<meta name="title" content="{{ $gsetting['project_title'] }}">
<meta name="description" content="{{ $gsetting['meta_data_desc'] }} ">
<meta property="og:title" content="{{ $gsetting['project_title'] }} ">
<meta property="og:url" content="{{ url()->full() }}">
<meta property="og:description" content="{{ $gsetting['meta_data_desc'] }}">
<meta property="og:image" content="{{ asset('images/logo/'.$gsetting['logo']) }}">
<meta itemprop="image" content="{{ asset('images/logo/'.$gsetting['logo']) }}">
<meta property="og:type" content="website">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:image" content="{{ asset('images/logo/'.$gsetting['logo']) }}">
<meta property="twitter:title" content="{{ $gsetting['project_title'] }} ">
<meta property="twitter:description" content="{{ $gsetting['meta_data_desc'] }}">
<meta name="twitter:site" content="{{ url()->full() }}" />

<link rel="canonical" href="{{ url()->full() }}" />
<meta name="robots" content="all">
<meta name="keywords" content="{{ $gsetting->meta_data_keyword }}">

@endsection

<!-- categories-tab start-->
@if($gsetting->category_enable == 1)
<section id="categories-tab" class="categories-tab-main-block">
    <div class="container">
        <div id="categories-tab-slider" class="categories-tab-block owl-carousel">

            @foreach($category as $cat)
            @if($cat->status == 1)
            <div class="item categories-tab-dtl">
                <a href="{{ route('category.page',['id' => $cat->id, 'category' => str_slug(str_replace('-','&',$cat->slug))]) }}"
                    title="{{ $cat->title }}"><i class="fa {{ $cat->icon }}"></i>{{ $cat->title }}</a>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>
@endif
<!-- categories-tab end-->

@if(isset($sliders))
<section id="home-background-slider" class="background-slider-block owl-carousel">
    <div class="lazy item home-slider-img">
        @foreach($sliders as $slider)

        @if($slider->status == 1)
        <div id="home" class="home-main-block"
            style="background-image: url('{{ asset('images/slider/'.$slider['image']) }}')">
            <div class="container">
                <div class="row">
                    <div
                        class="col-lg-12 {{$slider['left'] == 1 ? 'col-md-offset-6 col-sm-offset-6 col-sm-6 col-md-6 text-right' : ''}}">
                        <div class="home-dtl">
                            <div class="home-heading">{{ $slider['heading'] }}</div>
                            <p class="btm-10">{{ $slider['sub_heading'] }}</p>
                            <p class="btm-20">{{ $slider['detail'] }}
                        </div>

                        @if($slider->search_enable == 1)
                        <div class="home-search">
                            <form method="GET" id="searchform" action="{{ route('search') }}">
                                <div class="search">

                                    <input type="text" name="searchTerm" class="searchTerm"
                                        placeholder="What do you want to learn?">
                                    <button type="submit" class="searchButton">
                                        <i class="fa fa-search"></i>
                                    </button>

                                </div>
                            </form>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endforeach
    </div>
</section>
@endif
<!-- home end -->
<!-- learning-work start -->
@if(isset($facts))
<section id="learning-work" class="learning-work-main-block">
    <div class="container">
        <div class="row">
            @foreach($facts as $fact)
            <div class="col-lg-4 col-sm-6">
                <div class="learning-work-block">
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <div class="learning-work-icon">
                                <i class="fa {{ $fact['icon'] }}"></i>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="learning-work-dtl">
                                <div class="work-heading">{{ $fact['heading'] }}</div>
                                <p>{{ $fact['sub_heading'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
<!-- learning-work end -->

<!-- Advertisement -->
@if(isset($advs))
@foreach($advs as $adv)
@if($adv->position == 'belowslider')
<br>
<section id="student" class="student-main-block top-40">
    <div class="container">
        <a href="{{ $adv->url1 }}" title="{{ __('Click to visit') }}">

        </a>
    </div>
</section>

@endif
@endforeach
@endif

<!-- Student start -->

@if(Auth::check())
@if( isset($recent_course_id) && isset($recent_course) && optional($recent_course)->status == 1)
<section id="student" class="student-main-block top-40">
    <div class="container">

        @if($total_count >= '0')
        <h4 class="student-heading">{{ __('Recently Viewed Courses') }}</h4>
        <div id="recent-courses-slider" class="student-view-slider-main-block owl-carousel">
            @foreach($recent_course_id as $view)
            @php

            $recent_course = App\Course::where('id', $view)->with('user')->first();

            @endphp
            @if(isset($recent_course))

            @if($recent_course->status == 1)
            <div class="item student-view-block student-view-block-1">
                <div class="genre-slide-image">
                    <div class="view-block">
                        <div class="view-img">
                            @if($recent_course['preview_image'] !== NULL && $recent_course['preview_image'] !== '')
                            <a
                                href="{{ route('user.course.show',['id' => $recent_course->id, 'slug' => $recent_course->slug ]) }}"><img
                                    data-src="{{ asset('images/course/'.$recent_course['preview_image']) }}"
                                    alt="course" class="img-fluid owl-lazy"></a>
                            @else
                            <a
                                href="{{ route('user.course.show',['id' => $recent_course->id, 'slug' => $recent_course->slug ]) }}"><img
                                    data-src="{{ Avatar::create($recent_course->title)->toBase64() }}" alt="course"
                                    class="img-fluid owl-lazy"></a>
                            @endif
                        </div>
                        <div class="advance-badge">
                            @if($recent_course['level_tags'] == !NULL)
                            <span class="badge bg-primary">{{ $recent_course['level_tags'] }}</span>
                            @endif
                        </div>
                        <div class="view-user-img">

                            @if($recent_course->user['user_img'] !== NULL && $recent_course->user['user_img'] !== '')
                            <a href="" title=""><img
                                    src="{{ asset('images/user_img/'.$recent_course->user['user_img']) }}"
                                    class="img-fluid user-img-one" alt=""></a>
                            @else
                            <a href="" title=""><img src="{{ asset('images/default/user.png') }}"
                                    class="img-fluid user-img-one" alt=""></a>
                            @endif
                        </div>
                        <div class="view-dtl">
                            <div class="view-heading"><a
                                    href="{{ route('user.course.show',['id' => $recent_course->id, 'slug' => $recent_course->slug ]) }}">{{ str_limit($recent_course->title, $limit = 30, $end = '...') }}</a>
                            </div>
                            <div class="user-name">
                                <h6>By <span>{{ optional($recent_course->user)['fname'] }}</span></h6>
                            </div>
                            <div class="rating">
                                <ul>
                                    <li>
                                        <?php 
                                            $learn = 0;
                                            $price = 0;
                                            $value = 0;
                                            $sub_total = 0;
                                            $sub_total = 0;
                                            $reviews = App\ReviewRating::where('course_id',$recent_course->id)->get();
                                            ?>
                                        @if(!empty($reviews[0]))
                                        <?php
                                            $count =  App\ReviewRating::where('course_id',$recent_course->id)->count();

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
                                            <div class="star-ratings-sprite"><span
                                                    style="width:<?php echo $ratings_var; ?>%"
                                                    class="star-ratings-sprite-rating"></span>
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

                                        $reviewcount = App\ReviewRating::where('course_id', $recent_course->id)->WhereNotNull('review')->get();

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
                                    $reviewsrating = App\ReviewRating::where('course_id', $recent_course->id)->first();
                                    @endphp
                                    <!-- @if(!empty($reviewsrating))
                                        <li>
                                            <b>{{ round($overallrating, 1) }}</b>
                                        </li>
                                        @endif -->

                                    <li class="reviews">
                                        (@php
                                        $data = App\ReviewRating::where('course_id', $recent_course->id)->count();
                                        if($data>0){

                                        echo $data;
                                        }
                                        else{

                                        echo "0";
                                        }
                                        @endphp Reviews)
                                    </li>
                                </ul>
                            </div>
                            <div class="view-footer">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="count-user">
                                            <i data-feather="user"></i><span>
                                                @php
                                                $data = App\Order::where('course_id', $recent_course->id)->count();
                                                if(($data)>0){

                                                echo $data;
                                                }
                                                else{

                                                echo "0";
                                                }
                                                @endphp</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        @if( $recent_course->type == 1)
                                        <div class="rate text-right">
                                            <ul>

                                                @if($recent_course->discount_price == !NULL)

                                                <li><a><b>
                                                    {{ currency($recent_course->discount_price, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = true) }}
                                                </b></a>
                                                </li>

                                                <li><a><b><strike>{{ currency($recent_course->price, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = true) }}</strike></b></a>
                                                </li>


                                                @else
                                                <li><a><b>
                                                            {{ currency($recent_course->price, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = true) }}</b></a>
                                                </li>


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
                            <div class="img-wishlist">
                                <div class="protip-wishlist">
                                    <ul>
                                        @if(Auth::check())
                                        @php
                                        $wish = App\Wishlist::where('user_id', auth()->user()->id)->where('course_id',
                                        $recent_course->id)->first();
                                        @endphp
                                        @if ($wish == NULL)
                                        <li class="protip-wish-btn">
                                            <form id="demo-form2" method="post"
                                                action="{{ url('show/wishlist', $recent_course->id) }}"
                                                data-parsley-validate class="form-horizontal form-label-left">
                                                {{ csrf_field() }}

                                                <input type="hidden" name="user_id" value="{{auth()->user()->id}}" />
                                                <input type="hidden" name="course_id" value="{{$recent_course->id}}" />

                                                <button class="wishlisht-btn" title="Add to wishlist" type="submit"><i
                                                        data-feather="heart" class="rgt-10"></i></button>
                                            </form>
                                        </li>
                                        @else
                                        <li class="protip-wish-btn-two">
                                            <form id="demo-form2" method="post"
                                                action="{{ url('remove/wishlist', $recent_course->id) }}"
                                                data-parsley-validate class="form-horizontal form-label-left">
                                                {{ csrf_field() }}

                                                <input type="hidden" name="user_id" value="{{auth()->user()->id}}" />
                                                <input type="hidden" name="course_id" value="{{$recent_course->id}}" />

                                                <button class="wishlisht-btn heart-fill" title="Remove from Wishlist"
                                                    type="submit"><i data-feather="heart" class="rgt-10"></i></button>
                                            </form>
                                        </li>
                                        @endif
                                        @else
                                        <li class="protip-wish-btn"><a href="{{ route('login') }}" title="heart"><i
                                                    data-feather="heart" class="rgt-10"></i></a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            @endif
            @endif
            @endforeach
        </div>
        @endif

    </div>
</section>
@endif
@endif
<!-- Students end -->

<!-- Student start -->
@if(Auth::check())
@php
if(Schema::hasColumn('orders', 'refunded')){
$enroll = App\Order::where('refunded', '0')->where('user_id', auth()->user()->id)->where('status',
'1')->with('courses')->with(['user','courses.user'] )->get();
}
else{
$enroll = NULL;
}
@endphp
@if( isset($enroll) )
<section id="student" class="student-main-block top-40">
    <div class="container">

        @if(count($enroll) > 0)
        <h4 class="student-heading">{{ __('My Purchased Courses') }}</h4>
        <div id="my-courses-slider" class="student-view-slider-main-block owl-carousel">
            @foreach($enroll as $enrol)
            @if(isset($enrol->courses) && $enrol->courses['status'] == 1 )
            <div class="item student-view-block student-view-block-1">
                <div class="genre-slide-image">
                    <div class="view-block">
                        <div class="view-img">
                            @if($enrol->courses['preview_image'] !== NULL && $enrol->courses['preview_image'] !== '')
                            <a
                                href="{{ route('course.content',['id' => $enrol->courses->id, 'slug' => $enrol->courses->slug ]) }}"><img
                                    data-src="{{ asset('images/course/'.$enrol->courses['preview_image']) }}"
                                    alt="course" class="img-fluid owl-lazy"></a>
                            @else
                            <a
                                href="{{ route('course.content',['id' => $enrol->courses->id, 'slug' => $enrol->courses->slug ]) }}"><img
                                    data-src="{{ Avatar::create($enrol->courses->title)->toBase64() }}" alt="course"
                                    class="img-fluid owl-lazy"></a>
                            @endif
                        </div>
                        <div class="view-user-img">

                            @if($enrol->user['user_img'] !== NULL && $enrol->user['user_img'] !== '')
                            <a href="" title=""><img src="{{ asset('images/user_img/'.$enrol->user['user_img']) }}"
                                    class="img-fluid user-img-one" alt=""></a>
                            @else
                            <a href="" title=""><img src="{{ asset('images/default/user.png') }}"
                                    class="img-fluid user-img-one" alt=""></a>
                            @endif
                        </div>
                        <div class="view-dtl">
                            <div class="view-heading"><a
                                    href="{{ route('course.content',['id' => $enrol->courses->id, 'slug' => $enrol->courses->slug ]) }}">{{ str_limit($enrol->courses->title, $limit = 30, $end = '...') }}</a>
                            </div>
                            <div class="user-name">
                                <h6>By <span>{{ optional($enrol->user)['fname'] }}</span></h6>
                            </div>
                            <div class="rating">
                                <ul>
                                    <li>
                                        <?php 
                                            $learn = 0;
                                            $price = 0;
                                            $value = 0;
                                            $sub_total = 0;
                                            $sub_total = 0;
                                            $reviews = App\ReviewRating::where('course_id',$enrol->courses->id)->get();
                                            ?>
                                        @if(!empty($reviews[0]))
                                        <?php
                                            $count =  App\ReviewRating::where('course_id',$enrol->courses->id)->count();

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
                                            <div class="star-ratings-sprite"><span
                                                    style="width:<?php echo $ratings_var; ?>%"
                                                    class="star-ratings-sprite-rating"></span>
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

                                        $reviewcount = App\ReviewRating::where('course_id', $enrol->courses->id)->WhereNotNull('review')->get();

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
                                    $reviewsrating = App\ReviewRating::where('course_id', $enrol->courses->id)->first();
                                    @endphp

                                    <li class="reviews">
                                        (@php
                                        $data = App\ReviewRating::where('course_id', $enrol->courses->id)->count();
                                        if($data>0){

                                        echo $data;
                                        }
                                        else{

                                        echo "0";
                                        }
                                        @endphp Reviews)
                                    </li>
                                </ul>
                            </div>
                            <div class="view-footer">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        @if( $enrol->courses->type == 1)
                                        <div class="rate text-right">
                                            <ul>


                                                @if($enrol->courses->discount_price == !NULL)

                                                <li><a><b>{{ activeCurrency()->symbol }}{{ price_format( currency($enrol->courses->discount_price, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false)) }}</b></a>
                                                </li>

                                                <li><a><b><strike>{{ activeCurrency()->symbol }}{{ price_format( currency($enrol->courses->price, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false)) }}</strike></b></a>
                                                </li>




                                                @else

                                                <li><a><b>
                                                    {{ activeCurrency()->symbol }}{{ price_format( currency($enrol->courses->price, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false)) }}</b></a>
                                                </li>

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
                    </div>
                </div>

            </div>
            @endif
            @endforeach
        </div>
        @endif

    </div>
</section>
@endif
@endif
<!-- Students end -->

<!-- learning-courses start -->
@if(isset($categories))
<section id="learning-courses" class="learning-courses-main-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                <h4 class="student-heading">{{ __('frontstaticword.RecentCourses') }}</h4>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                <div class="btn_more float-right">

                </div>
            </div>
        </div>

        <div class="row">



            <div class="col-lg-12">
                <div class="learning-courses">
                    @if(isset($categories))
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        @foreach($categories as $cats)

                        <li class="btn nav-item"><a class="nav-item nav-link" id="home-tab" data-toggle="tab"
                                href="#content-tabs" role="tab" aria-controls="home"
                                onclick="showtab('{{ $cats->id }}')" aria-selected="true">{{ $cats['title'] }}</a></li>

                        @endforeach
                    </ul>
                    @endif
                </div>
                <div class="tab-content" id="myTabContent">
                    @if(!empty($categories))


                    @foreach($categories as $cate)
                    <div class="tab-pane fade show active" id="content-tabs" role="tabpanel" aria-labelledby="home-tab">

                        <div id="tabShow">

                        </div>

                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- learning-courses end -->


<!-- Advertisement -->
@if(isset($advs))
@foreach($advs as $adv)
@if($adv->position == 'belowrecent')
<br>
<section id="student" class="student-main-block btm-40">
    <div class="container">
        <a href="{{ $adv->url1 }}" title="{{ __('Click to visit') }}">
            <img class="lazy img-fluid advertisement-img-one" data-src="{{ url('images/advertisement/'.$adv->image1) }}"
                alt="{{ $adv->image1 }}">
        </a>
    </div>
</section>
@endif

@endforeach

@endif
<!-- Advertisement -->
<!-- Student start -->

@if( ! $cors->isEmpty() )
<section id="student" class="student-main-block">
    <div class="container">
        <h4 class="student-heading">{{ __('frontstaticword.FeaturedCourses') }}</h4>
        <div id="student-view-slider" class="student-view-slider-main-block owl-carousel">
            @foreach($cors as $c)


            @if($c->status == 1 && $c->featured == 1)
            <div class="item student-view-block student-view-block-1">
                <div class="genre-slide-image @if($gsetting['course_hover'] == 1) protip @endif"
                    data-pt-placement="outside" data-pt-interactive="false"
                    data-pt-title="#prime-next-item-description-block{{$c->id}}">
                    <div class="view-block">
                        <div class="view-img">
                            @if($c['preview_image'] !== NULL && $c['preview_image'] !== '')
                            <a href="{{ route('user.course.show',['id' => $c->id, 'slug' => $c->slug ]) }}"><img
                                    data-src="{{ asset('images/course/'.$c['preview_image']) }}" alt="course"
                                    class="img-fluid owl-lazy"></a>
                            @else
                            <a href="{{ route('user.course.show',['id' => $c->id, 'slug' => $c->slug ]) }}"><img
                                    data-src="{{ Avatar::create($c->title)->toBase64() }}" alt="course"
                                    class="img-fluid owl-lazy"></a>
                            @endif
                        </div>
                        <div class="advance-badge">
                            @if($c['level_tags'] == !NULL)
                            <span class="badge bg-primary">{{ $c['level_tags'] }}</span>
                            @endif
                        </div>
                        <div class="view-user-img">

                            @if(optional($c->user)['user_img'] !== NULL && optional($c->user)['user_img'] !== '')
                            <a href="" title=""><img src="{{ asset('images/user_img/'.$c->user['user_img']) }}"
                                    class="img-fluid user-img-one" alt=""></a>
                            @else
                            <a href="" title=""><img src="{{ asset('images/default/user.png') }}"
                                    class="img-fluid user-img-one" alt=""></a>
                            @endif


                        </div>

                        <div class="view-dtl">
                            <div class="view-heading"><a
                                    href="{{ route('user.course.show',['id' => $c->id, 'slug' => $c->slug ]) }}">{{ str_limit($c->title, $limit = 30, $end = '...') }}</a>
                            </div>
                            <div class="user-name">
                                <h6>By <span>{{ optional($c->user)['fname'] }}</span></h6>
                            </div>
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
                                            <div class="star-ratings-sprite"><span
                                                    style="width:<?php echo $ratings_var; ?>%"
                                                    class="star-ratings-sprite-rating"></span>
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
                                    <!-- <li>
                                            <b>{{ round($overallrating, 1) }}</b>
                                        </li> -->
                                    @endif
                                    <li class="reviews">
                                        (@php
                                        $data = App\ReviewRating::where('course_id', $c->id)->count();
                                        if($data>0){

                                        echo $data;
                                        }
                                        else{

                                        echo "0";
                                        }
                                        @endphp Reviews)
                                    </li>

                                </ul>
                            </div>
                            <div class="view-footer">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="count-user">
                                            <i data-feather="user"></i><span>
                                                @php
                                                $data = App\Order::where('course_id', $c->id)->count();
                                                if(($data)>0){

                                                echo $data;
                                                }
                                                else{

                                                echo "0";
                                                }
                                                @endphp</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        @if( $c->type == 1)
                                        <div class="rate text-right">
                                            <ul>

                                                @if($c->discount_price == !NULL)

                                                <li><a><b>{{ activeCurrency()->symbol }}{{ price_format( currency($c['discount_price'], $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false)) }}</b></a>
                                                </li>

                                                <li><a><b><strike>{{ activeCurrency()->symbol }}{{ price_format( currency($c['price'], $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false) ) }}</strike></b></a>
                                                </li>


                                                @else

                                                @if($c->price == !NULL)
                                                <li><a><b>{{ activeCurrency()->symbol }}{{ price_format( currency($c['price'], $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false) ) }}</b></a>
                                                </li>
                                                @endif

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



                            <div class="img-wishlist">
                                <div class="protip-wishlist">
                                    <ul>

                                        <li class="protip-wish-btn"><a
                                                href="https://calendar.google.com/calendar/r/eventedit?text={{ $c['title'] }}"
                                                target="__blank" title="reminder"><i data-feather="bell"></i></a></li>

                                        @if(Auth::check())

                                        <li class="protip-wish-btn"><a class="compare" data-id="{{filter_var($c->id)}}"
                                                title="compare"><i data-feather="bar-chart"></i></a></li>

                                        @php
                                        $wish = App\Wishlist::where('user_id', Auth::User()->id)->where('course_id',
                                        $c->id)->first();
                                        @endphp
                                        @if ($wish == NULL)
                                        <li class="protip-wish-btn">
                                            <form id="demo-form2" method="post"
                                                action="{{ url('show/wishlist', $c->id) }}" data-parsley-validate
                                                class="form-horizontal form-label-left">
                                                {{ csrf_field() }}

                                                <input type="hidden" name="user_id" value="{{Auth::User()->id}}" />
                                                <input type="hidden" name="course_id" value="{{$c->id}}" />

                                                <button class="wishlisht-btn" title="Add to wishlist" type="submit"><i
                                                        data-feather="heart"></i></button>
                                            </form>
                                        </li>
                                        @else
                                        <li class="protip-wish-btn-two">
                                            <form id="demo-form2" method="post"
                                                action="{{ url('remove/wishlist', $c->id) }}" data-parsley-validate
                                                class="form-horizontal form-label-left">
                                                {{ csrf_field() }}

                                                <input type="hidden" name="user_id" value="{{Auth::User()->id}}" />
                                                <input type="hidden" name="course_id" value="{{$c->id}}" />

                                                <button class="wishlisht-btn heart-fill" title="Remove from Wishlist"
                                                    type="submit"><i data-feather="heart"></i></button>
                                            </form>
                                        </li>
                                        @endif
                                        @else
                                        <li class="protip-wish-btn"><a href="{{ route('login') }}" title="heart"><i
                                                    data-feather="heart"></i></a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div id="prime-next-item-description-block{{$c->id}}" class="prime-description-block">
                    <div class="prime-description-under-block">
                        <div class="prime-description-under-block">
                            <h5 class="description-heading">{{ $c['title'] }}</h5>
                            <div class="main-des">
                                <p>Last Updated: {{ date('jS F Y', strtotime($c->updated_at)) }}</p>
                            </div>

                            <ul class="description-list">
                                <li>
                                    <i data-feather="play-circle"></i>
                                    <div class="class-des">
                                        {{ __('frontstaticword.Classes') }}:
                                        @php
                                        $data = App\CourseClass::where('course_id', $c->id)->count();
                                        if($data > 0){

                                        echo $data;
                                        }
                                        else{

                                        echo "0";
                                        }
                                        @endphp
                                    </div>
                                </li>
                                &nbsp;
                                <li>
                                    <div>
                                        <div class="time-des">
                                            <span class="">
                                                <i data-feather="clock"></i>
                                                @php

                                                $classtwo = App\CourseClass::where('course_id',
                                                $c->id)->sum("duration");

                                                @endphp
                                                {{ $classtwo }} Minutes
                                            </span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="lang-des">
                                        @if($c['language_id'] == !NULL)
                                        @if(isset($c->language))
                                        <i data-feather="globe"></i> {{ $c->language['name'] }}
                                        @endif
                                        @endif
                                    </div>
                                </li>

                            </ul>

                            <div class="product-main-des">
                                <p>{{ $c->short_detail }}</p>
                            </div>
                            <div>
                                @if($c->whatlearns->isNotEmpty())
                                @foreach($c->whatlearns as $wl)
                                @if($wl->status ==1)
                                <div class="product-learn-dtl">
                                    <ul>
                                        <li><i
                                                data-feather="check-circle"></i>{{ str_limit($wl['detail'], $limit = 120, $end = '...') }}
                                        </li>
                                    </ul>
                                </div>
                                @endif
                                @endforeach
                                @endif
                            </div>
                            <div class="des-btn-block">
                                <div class="row">
                                    <div class="col-lg-8">
                                        @if($c->type == 1)
                                        @if(Auth::check())
                                        @if(Auth::User()->role == "admin")
                                        <div class="protip-btn">
                                            <a href="{{ route('course.content',['id' => $c->id, 'slug' => $c->slug ]) }}"
                                                class="btn btn-secondary"
                                                title="course">{{ __('frontstaticword.GoToCourse') }}</a>
                                        </div>
                                        @else
                                        @php
                                        $order = App\Order::where('user_id', Auth::User()->id)->where('course_id',
                                        $c->id)->first();
                                        @endphp
                                        @if(!empty($order) && $order->status == 1)
                                        <div class="protip-btn">
                                            <a href="{{ route('course.content',['id' => $c->id, 'slug' => $c->slug ]) }}"
                                                class="btn btn-secondary"
                                                title="course">{{ __('frontstaticword.GoToCourse') }}</a>
                                        </div>
                                        @else
                                        @php
                                        $cart = App\Cart::where('user_id', Auth::User()->id)->where('course_id',
                                        $c->id)->first();
                                        @endphp
                                        @if(!empty($cart))
                                        <div class="protip-btn">
                                            <form id="demo-form2" method="post"
                                                action="{{ route('remove.item.cart',$cart->id) }}">
                                                {{ csrf_field() }}

                                                <div class="box-footer">
                                                    <button type="submit"
                                                        class="btn btn-primary">{{ __('frontstaticword.RemoveFromCart') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                        @else
                                        <div class="protip-btn">
                                            <form id="demo-form2" method="post"
                                                action="{{ route('addtocart',['course_id' => $c->id, 'price' => $c->price, 'discount_price' => $c->discount_price ]) }}"
                                                data-parsley-validate class="form-horizontal form-label-left">
                                                {{ csrf_field() }}

                                                <input type="hidden" name="category_id"
                                                    value="{{$c->category['id'] ?? '-'}}" />

                                                <div class="box-footer">
                                                    <button type="submit"
                                                        class="btn btn-primary">{{ __('frontstaticword.AddToCart') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                        @endif
                                        @endif
                                        @endif
                                        @else
                                        @if($gsetting->guest_enable == 1)
                                        <form id="demo-form2" method="post"
                                            action="{{ route('guest.addtocart', $c->id) }}" data-parsley-validate
                                            class="form-horizontal form-label-left">
                                            {{ csrf_field() }}


                                            <div class="box-footer">
                                                <button type="submit" class="btn btn-primary"><i class="fa fa-cart-plus"
                                                        aria-hidden="true"></i>&nbsp;{{ __('frontstaticword.AddToCart') }}</button>
                                            </div>
                                        </form>

                                        @else

                                        <div class="protip-btn">
                                            <a href="{{ route('login') }}" class="btn btn-primary"><i
                                                    class="fa fa-cart-plus"
                                                    aria-hidden="true"></i>&nbsp;{{ __('frontstaticword.AddToCart') }}</a>
                                        </div>
                                        @endif
                                        @endif
                                        @else
                                        @if(Auth::check())
                                        @if(Auth::User()->role == "admin")
                                        <div class="protip-btn">
                                            <a href="{{ route('course.content',['id' => $c->id, 'slug' => $c->slug ]) }}"
                                                class="btn btn-secondary"
                                                title="course">{{ __('frontstaticword.GoToCourse') }}</a>
                                        </div>
                                        @else
                                        @php
                                        $enroll = App\Order::where('user_id', Auth::User()->id)->where('course_id',
                                        $c->id)->first();
                                        @endphp
                                        @if($enroll == NULL)
                                        <div class="protip-btn">
                                            <a href="{{url('enroll/show',$c->id)}}" class="btn btn-primary"
                                                title="Enroll Now">{{ __('frontstaticword.EnrollNow') }}</a>
                                        </div>
                                        @else
                                        <div class="protip-btn">
                                            <a href="{{ route('course.content',['id' => $c->id, 'slug' => $c->slug ]) }}"
                                                class="btn btn-secondary"
                                                title="Cart">{{ __('frontstaticword.GoToCourse') }}</a>
                                        </div>
                                        @endif
                                        @endif
                                        @else
                                        <div class="protip-btn">
                                            <a href="{{ route('login') }}" class="btn btn-primary"
                                                title="Enroll Now">{{ __('frontstaticword.EnrollNow') }}</a>
                                        </div>
                                        @endif
                                        @endif
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="img-wishlist">
                                            <div class="protip-wishlist">
                                                <ul>
                                                    @if(Auth::check())

                                                    @php
                                                    $wish = App\Wishlist::where('user_id',
                                                    Auth::User()->id)->where('course_id', $c->id)->first();
                                                    @endphp
                                                    @if ($wish == NULL)
                                                    <li class="protip-wish-btn">
                                                        <form id="demo-form2" method="post"
                                                            action="{{ url('show/wishlist', $c->id) }}"
                                                            data-parsley-validate
                                                            class="form-horizontal form-label-left">
                                                            {{ csrf_field() }}

                                                            <input type="hidden" name="user_id"
                                                                value="{{Auth::User()->id}}" />
                                                            <input type="hidden" name="course_id" value="{{$c->id}}" />

                                                            <button class="wishlisht-btn" title="Add to wishlist"
                                                                type="submit"><i data-feather="heart"></i></button>
                                                        </form>
                                                    </li>
                                                    @else
                                                    <li class="protip-wish-btn-two">
                                                        <form id="demo-form2" method="post"
                                                            action="{{ url('remove/wishlist', $c->id) }}"
                                                            data-parsley-validate
                                                            class="form-horizontal form-label-left">
                                                            {{ csrf_field() }}

                                                            <input type="hidden" name="user_id"
                                                                value="{{Auth::User()->id}}" />
                                                            <input type="hidden" name="course_id" value="{{$c->id}}" />

                                                            <button class="wishlisht-btn heart-fill" title="Remove from Wishlist"
                                                                type="submit"><i data-feather="heart"></i></button>
                                                        </form>
                                                    </li>
                                                    @endif
                                                    @else
                                                    <li class="protip-wish-btn"><a href="{{ route('login') }}"
                                                            title="heart"><i data-feather="heart"></i></a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
@endif
<!-- Students end -->


<!-- Subscription Bundle start -->
<section id="subscription" class="student-main-block">
    <div class="container">
        @if (isset($subscriptionBundles) && !$subscriptionBundles->isEmpty())
        <h4 class="student-heading">{{ __('frontstaticword.SubscriptionBundles') }}</h4>
        <div id="subscription-bundle-view-slider" class="student-view-slider-main-block owl-carousel">
            @foreach ($subscriptionBundles as $bundle)
            @if ($bundle->status == 1 && $bundle->is_subscription_enabled == 1)

            <div class="item student-view-block student-view-block-1">
                <div class="genre-slide-image protip" data-pt-placement="outside" data-pt-interactive="false"
                    data-pt-title="#prime-next-item-description-block-3{{ $bundle->id }}">
                    <div class="view-block">
                        <div class="view-img">
                            @if ($bundle['preview_image'] !== null && $bundle['preview_image'] !== '')
                            <a href="{{ route('bundle.detail', $bundle->id) }}"><img
                                    data-src="{{ asset('images/bundle/' . $bundle['preview_image']) }}" alt="course"
                                    class="img-fluid owl-lazy"></a>
                            @else
                            <a href="{{ route('bundle.detail', $bundle->id) }}"><img
                                    data-src="{{ Avatar::create($bundle->title)->toBase64() }}" alt="course"
                                    class="img-fluid owl-lazy"></a>
                            @endif
                        </div>
                        <div class="view-user-img">
                            <a href="" title=""><img src="http://eclass.test/images/user_img/159116548431.jpg" class="img-fluid user-img-one" alt=""></a>
                        </div>
                        <div class="view-dtl">
                            <div class="view-heading"><a
                                    href="{{ route('bundle.detail', $bundle->id) }}">{{ str_limit($bundle->title, $limit = 30, $end = '...') }}</a>
                            </div>
                            <div class="user-name">
                                <h6>By <span>{{ optional($bundle->user)['fname'] }}</span></h6>
                            </div>
                            <div class="view-footer">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-date">
                                            <a href="#"><i data-feather="calendar"></i> {{ date('d-m-Y', strtotime($bundle['created_at'])) }}</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        @if ($bundle->type == 1 && $bundle->price != null)
                            <div class="rate text-right">
                                <ul>
                                    @if ($bundle->discount_price == !null)

                                    <li><a><b>{{ activeCurrency()->symbol }}{{ price_format( currency($bundle->discount_price, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false)) }}</b></a>
                                    </li>

                                    <li><a><b><strike>{{ activeCurrency()->symbol }}{{ price_format( currency($bundle->price, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false)) }}</strike></b></a>
                                    </li>


                                    @else



                                    <li><a><b>
                                                {{ activeCurrency()->symbol }}{{ price_format( currency($bundle->price, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false)) }}</b></a>
                                    </li>


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

                    </div>
                </div>
                <div id="prime-next-item-description-block-3{{ $bundle->id }}" class="prime-description-block">
                    <div class="prime-description-under-block">
                        <div class="prime-description-under-block">
                            <h5 class="description-heading">{{ $bundle['title'] }}</h5>
                            <div class="main-des">
                                @if($bundle['short_detail'] != NUll)

                                <p>{{ str_limit($bundle['short_detail'], $limit = 200, $end = '...') }}</p>
                                @else
                                <p>{{ str_limit($bundle['detail'], $limit = 200, $end = '...') }}</p>
                                @endif
                            </div>
                            <div class="des-btn-block">
                                <div class="row">
                                    <div class="col-lg-12">
                                        @if ($bundle->type == 1)
                                        @if (Auth::check())
                                        @if (Auth::User()->role == 'admin')
                                        <div class="protip-btn">
                                            <a href="" class="btn btn-secondary"
                                                title="course">{{ __('frontstaticword.Purchased') }}</a>
                                        </div>
                                        @else
                                        @php
                                        $order = App\Order::where('user_id',
                                        Auth::User()->id)->where('bundle_id',
                                        $bundle->id)->first();
                                        @endphp
                                        @if (!empty($order) && $order->status == 1)
                                        <div class="protip-btn">
                                            <a href="" class="btn btn-secondary"
                                                title="course">{{ __('frontstaticword.Purchased') }}</a>
                                        </div>
                                        @else
                                        @php
                                        $cart = App\Cart::where('user_id',
                                        Auth::User()->id)->where('bundle_id',
                                        $bundle->id)->first();
                                        @endphp
                                        @if (!empty($cart))
                                        <div class="protip-btn">
                                            <form id="demo-form2" method="post"
                                                action="{{ route('remove.item.cart', $cart->id) }}">
                                                {{ csrf_field() }}

                                                <div class="box-footer">
                                                    <button type="submit"
                                                        class="btn btn-primary">{{ __('frontstaticword.RemoveFromCart') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                        @else
                                        <div class="protip-btn">
                                            <form id="demo-form2" method="post"
                                                action="{{ route('bundlecart', $bundle->id) }}" data-parsley-validate
                                                class="form-horizontal form-label-left">
                                                {{ csrf_field() }}

                                                <input type="hidden" name="user_id" value="{{ Auth::User()->id }}" />
                                                <input type="hidden" name="bundle_id" value="{{ $bundle->id }}" />

                                                <div class="box-footer">
                                                    <button type="submit"
                                                        class="btn btn-primary">{{ __('frontstaticword.SubscribeNow') }}</button>
                                                </div>


                                            </form>
                                        </div>
                                        @endif
                                        @endif
                                        @endif
                                        @else
                                        <div class="protip-btn">

                                            <a href="{{ route('login') }}" class="btn btn-primary"><i
                                                    class="fa fa-cart-plus"
                                                    aria-hidden="true"></i>&nbsp;{{ __('frontstaticword.SubscribeNow') }}</a>

                                        </div>
                                        @endif
                                        @else
                                        @if (Auth::check())
                                        @if (Auth::User()->role == 'admin')
                                        <div class="protip-btn">
                                            <a href="" class="btn btn-secondary"
                                                title="course">{{ __('frontstaticword.Purchased') }}</a>
                                        </div>
                                        @else
                                        @php
                                        $enroll = App\Order::where('user_id',
                                        Auth::User()->id)->where('course_id', $c->id)->first();
                                        @endphp
                                        @if ($enroll == null)
                                        <div class="protip-btn">
                                            <a href="{{ url('enroll/show', $bundle->id) }}" class="btn btn-primary"
                                                title="Enroll Now">{{ __('frontstaticword.SubscribeNow') }}</a>
                                        </div>
                                        @else
                                        <div class="protip-btn">
                                            <a href="" class="btn btn-secondary"
                                                title="Cart">{{ __('frontstaticword.Purchased') }}</a>
                                        </div>
                                        @endif
                                        @endif
                                        @else
                                        <div class="protip-btn">
                                            <a href="{{ route('login') }}" class="btn btn-primary"
                                                title="Enroll Now">{{ __('frontstaticword.SubscribeNow') }}</a>
                                        </div>
                                        @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            @endif

            @endforeach
        </div>
        @endif
    </div>
</section>
<!-- Subscription Bundle end -->

<!-- Bundle start -->
@if(isset($bundles))
<section id="bundle-block" class="student-main-block">
    <div class="container">
        @if(count($bundles) > 0)
        <h4 class="student-heading">{{ __('frontstaticword.BundleCourses') }}</h4>

        <div id="bundle-view-slider" class="student-view-slider-main-block owl-carousel">
            @foreach($bundles as $bundle)
            @if($bundle->status == 1)

            <div class="item student-view-block student-view-block-1">
                <div class="genre-slide-image @if($gsetting['course_hover'] == 1) protip @endif"
                    data-pt-placement="outside" data-pt-interactive="false"
                    data-pt-title="#prime-next-item-description-block-4{{$bundle->id}}">
                    <div class="view-block">
                        <div class="view-img">
                            @if($bundle['preview_image'] !== NULL && $bundle['preview_image'] !== '')
                            <a href="{{ route('bundle.detail', $bundle->id) }}"><img
                                    data-src="{{ asset('images/bundle/'.$bundle['preview_image']) }}" alt="course"
                                    class="img-fluid owl-lazy"></a>
                            @else
                            <a href="{{ route('bundle.detail', $bundle->id) }}"><img
                                    data-src="{{ Avatar::create($bundle->title)->toBase64() }}" alt="course"
                                    class="img-fluid owl-lazy"></a>
                            @endif
                        </div>
                        <div class="view-user-img">
                            <a href="" title=""><img src="http://eclass.test/images/user_img/159116548431.jpg"
                                    class="img-fluid user-img-one" alt=""></a>
                        </div>
                        <div class="view-dtl">
                            <div class="view-heading"><a
                                    href="{{ route('bundle.detail', $bundle->id) }}">{{ str_limit($bundle->title, $limit = 30, $end = '...') }}</a>
                            </div>
                            <div class="user-name">
                                <h6>By <span>{{ optional($bundle->user)['fname'] }}</span></h6>
                            </div>
                            <!-- <p class="btm-10"><a herf="#">{{ __('frontstaticword.by') }} @if(isset($bundle->user)) {{ $bundle->user['fname'] }} {{ $bundle->user['lname'] }} @endif</a></p> -->

                            <div class="view-footer">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <p class="view-date"><a herf="#"><i data-feather="calendar"></i>
                                                {{ date('d-m-Y',strtotime($bundle['created_at'])) }}</a></p>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        @if($bundle->type == 1 && $bundle->price != null)
                                        <div class="rate text-right">
                                            <ul>

                                                @if($bundle->discount_price == !NULL)

                                                <li><a><b>{{ activeCurrency()->symbol }}{{ price_format(  currency($bundle->discount_price, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false)) }}</b></a>
                                                </li>

                                                <li><a><b><strike>{{ activeCurrency()->symbol }}{{ price_format( currency($bundle->price, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false)) }}</strike></b></a>
                                                </li>


                                                @else
                                                <li><a><b>
                                                    {{ activeCurrency()->symbol }}{{ price_format(  currency($bundle->price, $from = $currency->code, $to = Session::has('changed_currency') ? Session::get('changed_currency') : $currency->code, $format = false)) }}</b></a>
                                                </li>
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

                    </div>
                </div>
                <div id="prime-next-item-description-block-4{{$bundle->id}}" class="prime-description-block">
                    <div class="prime-description-under-block">
                        <div class="prime-description-under-block">
                            <h5 class="description-heading">{{ $bundle['title'] }}</h5>

                            <div class="product-main-des">
                                <p>{{ strip_tags(str_limit($bundle['detail'], $limit = 200, $end = '...')) }}</p>
                            </div>
                            <div>
                                <div class="product-learn-dtl">
                                    <ul>

                                        @foreach ($bundle->course_id as $bundles)

                                        @php
                                        $course = App\Course::where('id', $bundles)->first();
                                        @endphp
                                        @isset($course)
                                        <li><i data-feather="check-circle"></i>
                                            <a href="#">{{ $course['title'] }}</a>
                                        </li>
                                        @endisset

                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="des-btn-block">
                                <div class="row">
                                    <div class="col-lg-12">
                                        @if($bundle->type == 1)
                                        @if(Auth::check())
                                        @if(Auth::User()->role == "admin")
                                        <div class="protip-btn">
                                            <a href="" class="btn btn-secondary"
                                                title="course">{{ __('frontstaticword.Purchased') }}</a>
                                        </div>
                                        @else
                                        @php
                                        $order = App\Order::where('user_id', Auth::User()->id)->where('bundle_id',
                                        $bundle->id)->first();
                                        @endphp
                                        @if(!empty($order) && $order->status == 1)
                                        <div class="protip-btn">
                                            <a href="" class="btn btn-secondary"
                                                title="course">{{ __('frontstaticword.Purchased') }}</a>
                                        </div>
                                        @else
                                        @php
                                        $cart = App\Cart::where('user_id', Auth::User()->id)->where('bundle_id',
                                        $bundle->id)->first();
                                        @endphp
                                        @if(!empty($cart))
                                        <div class="protip-btn">
                                            <form id="demo-form2" method="post"
                                                action="{{ route('remove.item.cart',$cart->id) }}">
                                                {{ csrf_field() }}

                                                <div class="box-footer">
                                                    <button type="submit"
                                                        class="btn btn-primary">{{ __('frontstaticword.RemoveFromCart') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                        @else
                                        <div class="protip-btn">
                                            <form id="demo-form2" method="post"
                                                action="{{ route('bundlecart', $bundle->id) }}" data-parsley-validate
                                                class="form-horizontal form-label-left">
                                                {{ csrf_field() }}

                                                <input type="hidden" name="user_id" value="{{Auth::User()->id}}" />
                                                <input type="hidden" name="bundle_id" value="{{$bundle->id}}" />

                                                <div class="box-footer">
                                                    <button type="submit"
                                                        class="btn btn-primary">{{ __('frontstaticword.AddToCart') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                        @endif
                                        @endif
                                        @endif
                                        @else
                                        <div class="protip-btn">
                                            <a href="{{ route('login') }}" class="btn btn-primary"><i
                                                    class="fa fa-cart-plus"
                                                    aria-hidden="true"></i>&nbsp;{{ __('frontstaticword.AddToCart') }}</a>
                                        </div>
                                        @endif
                                        @else
                                        @if(Auth::check())
                                        @if(Auth::User()->role == "admin")
                                        <div class="protip-btn">
                                            <a href="" class="btn btn-secondary"
                                                title="course">{{ __('frontstaticword.Purchased') }}</a>
                                        </div>
                                        @else
                                        @php
                                        $enroll = App\Order::where('user_id', Auth::User()->id)->where('bundle_id',
                                        $bundle->id)->first();
                                        @endphp
                                        @if($enroll == NULL)
                                        <div class="protip-btn">
                                            <a href="{{url('enroll/show',$bundle->id)}}" class="btn btn-primary"
                                                title="Enroll Now">{{ __('frontstaticword.EnrollNow') }}</a>
                                        </div>
                                        @else
                                        <div class="protip-btn">
                                            <a href="" class="btn btn-secondary"
                                                title="Cart">{{ __('frontstaticword.Purchased') }}</a>
                                        </div>
                                        @endif
                                        @endif
                                        @else
                                        <div class="protip-btn">
                                            <a href="{{ route('login') }}" class="btn btn-primary"
                                                title="Enroll Now">{{ __('frontstaticword.EnrollNow') }}</a>
                                        </div>
                                        @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            @endif

            @endforeach
        </div>
        @endif

    </div>
</section>
@endif
<!-- Bundle end -->

<!-- Advertisement -->
@if(isset($advs))
@foreach($advs as $adv)
@if($adv->position == 'belowbundle')
<br>
<section id="student" class="student-main-block btm-40">
    <div class="container">
        <a href="{{ $adv->url1 }}" title="{{ __('Click to visit') }}">
            <img class="lazy img-fluid advertisement-img-one" data-src="{{ url('images/advertisement/'.$adv->image1) }}"
                alt="{{ $adv->image1 }}">
        </a>
    </div>
</section>
@endif

@endforeach

@endif


<!-- Batch start -->
@if(isset($batches))

<section id="batch-block" class="student-main-block">
    <div class="container">
        @if(count($batches) > 0)
        <h4 class="student-heading">{{ __('frontstaticword.Batches') }}</h4>

        <div id="batch-view-slider" class="student-view-slider-main-block owl-carousel">
            @foreach($batches as $batch)
            @if($batch->status == 1)

            <div class="item student-view-block student-view-block-1">
                <div class="genre-slide-image @if($gsetting['course_hover'] == 1) protip @endif"
                    data-pt-placement="outside" data-pt-interactive="false"
                    data-pt-title="#prime-next-item-description-block-5{{$batch->id}}">
                    <div class="view-block">
                        <div class="view-img">
                            @if($batch['preview_image'] !== NULL && $batch['preview_image'] !== '')
                            <a href="{{ route('batch.detail', $batch->id) }}"><img
                                    data-src="{{ asset('images/batch/'.$batch['preview_image']) }}" alt="course"
                                    class="img-fluid owl-lazy"></a>
                            @else
                            <a href="{{ route('batch.detail', $batch->id) }}"><img
                                    data-src="{{ Avatar::create($batch->title)->toBase64() }}" alt="course"
                                    class="img-fluid owl-lazy"></a>
                            @endif
                        </div>
                        <div class="view-user-img">
                            <a href="" title=""><img src="http://eclass.test/images/user_img/159116548431.jpg" class="img-fluid user-img-one" alt=""></a>
                        </div>
                        <div class="view-dtl">
                            <div class="view-heading"><a href="{{ route('batch.detail', $batch->id) }}">{{ str_limit($batch->title, $limit = 30, $end = '...') }}</a></div>
                            <div class="user-name">
                                <h6>By <span>{{ optional($c->user)['fname'] }}</span></h6>
                            </div>
                            <div class="view-footer">
                                <div class="view-date">
                                    <a href="#"><i data-feather="calendar"></i> {{ date('d-m-Y',strtotime($batch['created_at'])) }}</a>
                                </div>
                            </div>                              
                        </div>

                    </div>
                </div>
                <div id="prime-next-item-description-block-5{{$batch->id}}" class="prime-description-block">
                    <div class="prime-description-under-block">
                        <div class="prime-description-under-block">
                            <h5 class="description-heading">{{ $batch['title'] }}</h5>
                            <div class="main-des">
                                <p>{!! str_limit($batch['detail'], $limit = 200, $end = '...') !!}</p>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            @endif

            @endforeach
        </div>

        @endif

    </div>
</section>

@endif
<!-- Batch end -->

<!-- Zoom start -->
@if($gsetting->zoom_enable == '1' || $gsetting->bbl_enable == '1' || $gsetting->googlemeet_enable == '1' ||
$gsetting->jitsimeet_enable == '1')
<section id="student" class="student-main-block">
    <div class="container">
        @php
        $mytime = Carbon\Carbon::now();
        @endphp
        @if( count($meetings) > 0 || count($bigblue) > 0 || count($allgooglemeet) > 0 || count($jitsimeeting) > 0 )
        <h4 class="student-heading">{{ __('frontstaticword.LiveMeetings') }}</h4>
        <div id="zoom-view-slider" class="student-view-slider-main-block owl-carousel">

            @if( ! $meetings->isEmpty() )
            @foreach($meetings as $meeting)
            <div class="item student-view-block student-view-block-1">
                <div class="genre-slide-image @if($gsetting['course_hover'] == 1) protip @endif"
                    data-pt-placement="outside" data-pt-interactive="false"
                    data-pt-title="#prime-next-item-description-block-6{{$meeting->id}}">
                    <div class="view-block">
                        <div class="view-img">

                            @if($meeting['image'] !== NULL && $meeting['image'] !== '')
                            <a href="{{ route('zoom.detail', $meeting->id) }}"><img
                                    data-src="{{ asset('images/zoom/'.$meeting['image']) }}" alt="course"
                                    class="img-fluid owl-lazy"></a>
                            @else
                            <a href="{{ route('zoom.detail', $meeting->id) }}"><img
                                    data-src="{{ Avatar::create($meeting['meeting_title'])->toBase64() }}" alt="course"
                                    class="img-fluid owl-lazy"></a>
                            @endif


                        </div>

                        @if(asset('images/meeting_icons/zoom.png') == !NULL)
                        <div class="meeting-icon"><img src="{{ asset('images/meeting_icons/zoom.png')}}"
                                class="img-circle" alt=""></div>
                        @endif


                        <div class="view-dtl">
                            <div class="view-heading"><a href="#">
                                    {{ str_limit($meeting->meeting_title, $limit = 30, $end = '...') }}</a></div>
                            <div class="user-name">
                                <h6>By <span>{{ optional($meeting->user)['fname'] }}</span></h6>
                            </div>
                            <div class="view-footer">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-date">
                                            <a href="#"><i data-feather="calendar"></i>
                                                {{ date('d-m-Y',strtotime($meeting['start_time'])) }}</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-time">
                                            <a href="#"><i data-feather="clock"></i>
                                                {{ date('h:i:s A',strtotime($meeting['start_time'])) }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="prime-next-item-description-block-6{{$meeting->id}}" class="prime-description-block">
                    <div class="prime-description-under-block">
                        <div class="prime-description-under-block">
                            <h5 class="description-heading"><a
                                    href="{{ route('zoom.detail', $meeting->id) }}">{{ $meeting['meeting_title'] }}</a>
                            </h5>
                            <div class="protip-img">
                                <h3 class="description-heading">{{ __('frontstaticword.by') }}
                                    @if(isset($meeting->user)) {{ $meeting->user['fname'] }} @endif</h>
                                    <p class="meeting-owner btm-10"><a herf="#">Meeting Owner:
                                            {{ $meeting->owner_id }}</a></p>
                            </div>
                            <div class="main-des meeting-main-des">
                                <div class="main-des-head">Start At: </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-date">
                                            <a href="#"><i data-feather="calendar"></i> {{ date('d-m-Y',strtotime($meeting['start_time'])) }}</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-time">
                                            <a href="#"><i data-feather="clock"></i> {{ date('h:i:s A',strtotime($meeting['start_time'])) }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="des-btn-block">
                                <a href="{{ $meeting->zoom_url }}" class="iframe btn btn-light">Join Meeting</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif

            @if( ! $bigblue->isEmpty() )
            @foreach($bigblue as $bbl)


            <div class="item student-view-block student-view-block-1">
                <div class="genre-slide-image @if($gsetting['course_hover'] == 1) protip @endif"
                    data-pt-placement="outside" data-pt-interactive="false"
                    data-pt-title="#prime-next-item-description-block-7{{$bbl->id}}">
                    <div class="view-block">
                        <div class="view-img">
                            <a href="{{ route('bbl.detail', $bbl->id) }}"><img
                                    data-src="{{ Avatar::create($bbl['meetingname'])->toBase64() }}" alt="course"
                                    class="img-fluid owl-lazy"></a>
                        </div>

                        @if(asset('images/meeting_icons/bigblue.png') == !NULL)
                        <div class="meeting-icon"><img src="{{ asset('images/meeting_icons/bigblue.png')}}"
                                class="img-circle" alt=""></div>
                        @endif

                        <div class="view-dtl">
                            <div class="view-heading"><a
                                    href="{{ route('bbl.detail', $bbl->id) }}">{{ str_limit($bbl['meetingname'], $limit = 30, $end = '...') }}</a>
                            </div>
                            <div class="user-name">
                                <h6>By <span>{{ optional($bbl->user)['fname'] }}</span></h6>
                            </div>
                            <div class="view-footer">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-date">
                                            <a href="#"><i data-feather="calendar"></i>
                                                {{ date('d-m-Y',strtotime($bbl['start_time'])) }}</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-time">
                                            <a href="#"><i data-feather="clock"></i>
                                                {{ date('h:i:s A',strtotime($bbl['start_time'])) }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div id="prime-next-item-description-block-7{{$bbl->id}}" class="prime-description-block">
                    <div class="prime-description-under-block">
                        <div class="prime-description-under-block">
                            <h5 class="description-heading">{{ $bbl['meetingname'] }}</h5>
                            <div class="protip-img">
                                <a href="{{ route('bbl.detail', $bbl->id) }}"><img
                                        src="{{ Avatar::create($bbl['meetingname'])->toBase64() }}" alt="course"
                                        class="img-fluid"></a>
                            </div>

                            <div class="main-des">
                                <p>{!! $bbl['detail'] !!}</p>
                            </div>
                            <div class="des-btn-block">
                                <div class="row">
                                    <div class="col-lg-12">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
            @endif

            @if( isset($allgooglemeet) )
            @foreach($allgooglemeet as $meeting)
            <div class="item student-view-block student-view-block-1">
                <div class="genre-slide-image @if($gsetting['course_hover'] == 1) protip @endif"
                    data-pt-placement="outside" data-pt-interactive="false"
                    data-pt-title="#prime-next-item-description-block-6{{ $meeting['meeting_id'] }}">
                    <div class="view-block">
                        <div class="view-img">

                            @if($meeting['image'] !== NULL && $meeting['image'] !== '')
                            <a href="{{ route('googlemeetdetailpage.detail', $meeting['id']) }}"><img
                                    data-src="{{ asset('images/googlemeet/profile_image/'.$meeting['image']) }}"
                                    alt="course" class="img-fluid owl-lazy"></a>
                            @else
                            <a href="{{ route('googlemeetdetailpage.detail', $meeting['id']) }}"><img
                                    data-src="{{ Avatar::create($meeting['meeting_title'])->toBase64() }}" alt="course"
                                    class="img-fluid owl-lazy"></a>
                            @endif


                        </div>

                        @if(asset('images/meeting_icons/google.png') == !NULL)
                        <div class="meeting-icon"><img src="{{ asset('images/meeting_icons/google.png')}}"
                                class="img-circle" alt=""></div>
                        @endif

                        <div class="view-dtl">
                            <div class="view-heading"><a href="#">
                                    {{ str_limit($meeting->meeting_title, $limit = 30, $end = '...') }}</a></div>
                            <div class="user-name">
                                <h6>By <span>{{ optional($meeting->user)['fname'] }}</span></h6>
                            </div>
                            <div class="view-footer">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-date">
                                            <a href="#"><i data-feather="calendar"></i>
                                                {{ date('d-m-Y',strtotime($meeting['start_time'])) }}</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-time">
                                            <a href="#"><i data-feather="clock"></i>
                                                {{ date('h:i:s A',strtotime($meeting['start_time'])) }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="prime-next-item-description-block-6{{$meeting['meeting_id']}}" class="prime-description-block">
                    <div class="prime-description-under-block">
                        <div class="prime-description-under-block">
                            <h5 class="description-heading"><a
                                    href="{{ route('zoom.detail', $meeting->id) }}">{{ $meeting['meeting_title'] }}</a>
                            </h5>
                            <div class="protip-img">
                                <h3 class="description-heading">{{ __('frontstaticword.by') }}
                                    @if(isset($meeting->user)) {{ $meeting->user['fname'] }} @endif</h>
                                    <p class="meeting-owner btm-10"><a herf="#">Meeting Owner:
                                            {{ $meeting->owner_id }}</a></p>
                            </div>
                            <div class="main-des meeting-main-des">
                                <div class="main-des-head">Start At: </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-date">
                                            <a href="#"><i data-feather="calendar"></i> {{ date('d-m-Y',strtotime($meeting['start_time'])) }}</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-time">
                                            <a href="#"><i data-feather="clock"></i> {{ date('h:i:s A',strtotime($meeting['start_time'])) }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="main-des meeting-main-des">
                                <div class="main-des-head">End At: </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-date">
                                            <a href="#"><i data-feather="calendar"></i> {{ date('d-m-Y',strtotime($meeting['end_time'])) }}</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-time">
                                            <a href="#"><i data-feather="clock"></i> {{ date('h:i:s A',strtotime($meeting['end_time'])) }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="des-btn-block">
                                <a href="{{ $meeting->meet_url }}" target="_blank" class="btn btn-light">Join
                                    Meeting</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif

            @if( ! $jitsimeeting->isEmpty() )
            @foreach($jitsimeeting as $meeting)
            <div class="item student-view-block student-view-block-1">
                <div class="genre-slide-image @if($gsetting['course_hover'] == 1) protip @endif"
                    data-pt-placement="outside" data-pt-interactive="false"
                    data-pt-title="#prime-next-item-description-block-6{{ $meeting['meeting_id'] }}">
                    <div class="view-block">
                        <div class="view-img">

                            @if($meeting['image'] !== NULL && $meeting['image'] !== '')
                            <a href="{{ route('jitsipage.detail', $meeting['id']) }}"><img
                                    data-src="{{ asset('images/jitsimeet/'.$meeting['image']) }}" alt="course"
                                    class="img-fluid owl-lazy"></a>
                            @else
                            <a href="{{ route('jitsipage.detail', $meeting['id']) }}"><img
                                    data-src="{{ Avatar::create($meeting['meeting_title'])->toBase64() }}" alt="course"
                                    class="img-fluid owl-lazy"></a>
                            @endif


                        </div>

                        @if(asset('images/meeting_icons/jitsi.png') == !NULL)
                        <div class="meeting-icon"><img src="{{ asset('images/meeting_icons/jitsi.png')}}"
                                class="img-circle" alt=""></div>
                        @endif

                        <div class="view-dtl">
                            <div class="view-heading"><a href="#">
                                    {{ str_limit($meeting->meeting_title, $limit = 30, $end = '...') }}</a></div>
                            <div class="user-name">
                                <h6>By <span>{{ optional($meeting->user)['fname'] }}</span></h6>
                            </div>
                            <div class="view-footer">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-date">
                                            <a href="#"><i data-feather="calendar"></i>
                                                {{ date('d-m-Y',strtotime($meeting['start_time'])) }}</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-time">
                                            <a href="#"><i data-feather="clock"></i>
                                                {{ date('h:i:s A',strtotime($meeting['start_time'])) }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="prime-next-item-description-block-6{{$meeting['meeting_id']}}" class="prime-description-block">
                    <div class="prime-description-under-block">
                        <div class="prime-description-under-block">
                            <h5 class="description-heading"><a
                                    href="{{ route('zoom.detail', $meeting->id) }}">{{ $meeting['meeting_title'] }}</a>
                            </h5>
                            <div class="protip-img">
                                <h3 class="description-heading">{{ __('frontstaticword.by') }}
                                    @if(isset($meeting->user)) {{ $meeting->user['fname'] }} @endif</h>
                                    <p class="meeting-owner btm-10"><a herf="#">Meeting Owner:
                                            {{ $meeting->owner_id }}</a></p>
                            </div>
                            <div class="main-des meeting-main-des">
                                <div class="main-des-head">Start At: </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-date">
                                            <a href="#"><i data-feather="calendar"></i> {{ date('d-m-Y',strtotime($meeting['start_time'])) }}</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-time">
                                            <a href="#"><i data-feather="clock"></i> {{ date('h:i:s A',strtotime($meeting['start_time'])) }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="main-des meeting-main-des">
                                <div class="main-des-head">End At: </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-date">
                                            <a href="#"><i data-feather="calendar"></i> {{ date('d-m-Y',strtotime($meeting['end_time'])) }}</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-time">
                                            <a href="#"><i data-feather="clock"></i> {{ date('h:i:s A',strtotime($meeting['end_time'])) }}</a>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                            <div class="des-btn-block">
                                <a href="{{url('meetup-conferencing/'.$meeting->meeting_id) }}" target="_blank"
                                    class="btn btn-light">Join Meeting</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif


        </div>

        @endif

    </div>
</section>
@endif
<!-- Zoom end -->

<!-- google class room start -->
@if(Schema::hasTable('googleclassrooms') && Module::has('Googleclassroom') &&
Module::find('Googleclassroom')->isEnabled())

@include('googleclassroom::frontend.home')

@endif

<!-- google class room end -->

<!-- Bundle start -->
@if( ! $blogs->isEmpty() )
<section id="student" class="student-main-block">
    <div class="container">

        <h4 class="student-heading">{{ __('frontstaticword.RecentBlogs') }}</h4>
        <div id="blog-post-slider" class="student-view-slider-main-block owl-carousel">
            @foreach($blogs as $blog)


            <div class="item student-view-block student-view-block-1">
                <div class="genre-slide-image @if($gsetting['course_hover'] == 1) protip @endif"
                    data-pt-placement="outside" data-pt-interactive="false"
                    data-pt-title="#prime-next-item-description-block-8{{$blog->id}}">
                    <div class="view-block">
                        <div class="view-img">
                            @if($blog['image'] !== NULL && $blog['image'] !== '')
                            @if($blog->slug != NULL)
                            <a href="{{ route('blog.detail', ['id' => $blog->id, 'slug' => $blog->slug ]) }}">
                                @else
                                <a
                                    href="{{ route('blog.detail', ['id' => $blog->id, 'slug' => str_slug(str_replace('-','&',$blog->heading)) ]) }}">
                                    @endif

                                    <img data-src="{{ asset('images/blog/'.$blog['image']) }}" alt="course"
                                        class="img-fluid owl-lazy">
                                </a>
                                @else
                                @if($blog->slug != NULL)
                                <a href="{{ route('blog.detail', ['id' => $blog->id, 'slug' => $blog->slug ]) }}">
                                    @else
                                    <a
                                        href="{{ route('blog.detail', ['id' => $blog->id, 'slug' => str_slug(str_replace('-','&',$blog->heading)) ]) }}">
                                        @endif
                                        <img data-src="{{ Avatar::create($blog->heading)->toBase64() }}" alt="course"
                                            class="img-fluid owl-lazy">
                                    </a>
                                    @endif


                        </div>
                        <div class="view-dtl">
                            <div class="view-heading">
                                @if($blog->slug != NULL)
                                <a href="{{ route('blog.detail', ['id' => $blog->id, 'slug' => $blog->slug ]) }}">
                                    {{ str_limit($blog['heading'], $limit = 25, $end = '...') }}
                                    @else
                                    <a
                                        href="{{ route('blog.detail', ['id' => $blog->id, 'slug' => str_slug(str_replace('-','&',$blog->heading)) ]) }}">

                                        {{ str_limit($blog['heading'], $limit = 25, $end = '...') }}
                                        @endif
                                    </a>
                            </div>
                            <div class="user-name">
                                <h6>By <span>{{ optional($blog->user)['fname'] }}</span></h6>
                            </div>
                            <div class="view-footer">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-date">
                                            <a href="#"><i data-feather="calendar"></i>
                                                {{ date('d-m-Y',strtotime($blog['ceated_at'])) }}</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="view-time">
                                            <a href="#"><i data-feather="clock"></i>
                                                {{ date('h:i:s A',strtotime($blog['ceated_at'])) }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div id="prime-next-item-description-block-8{{$blog->id}}" class="prime-description-block">
                    <div class="prime-description-under-block">
                        <div class="prime-description-under-block">
                            <h5 class="description-heading">{{ $blog['heading'] }}</h5>
                            <div class="row btm-20">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                    <div class="view-date">
                                        <a href="#"><i data-feather="calendar"></i> {{ date('d-m-Y',strtotime($blog['start_time'])) }}</a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                    <div class="view-time">
                                        <a href="#"><i data-feather="clock"></i> {{ date('h:i:s A',strtotime($blog['start_time'])) }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="main-des">
                                <p>{{substr(preg_replace("/\r\n|\r|\n/",'',strip_tags(html_entity_decode($blog->detail))), 0, 400)}}
                                </p>
                            </div>
                            <div class="des-btn-block">
                                <div class="row">
                                    <div class="col-lg-12">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
        </div>

    </div>
</section>
@endif
<!-- Bundle end -->
<!-- recommendations start -->
<section id="border-recommendation" class="border-recommendation">
    @php
    $gets = App\GetStarted::first();
    @endphp
    @if(isset($gets))
    <div class="recommendation-main-block  text-center"
        style="background-image: url('{{ asset('images/getstarted/'.$gets['image']) }}')">
        <div class="container">
            <h3 class="text-white">{{ $gets['heading'] }}</h3>
            <p class="text-white btm-20">{{ $gets['sub_heading'] }}</p>
            @if($gets->button_txt == !NULL)
            <div class="recommendation-btn text-white">
                <a href="{{ $gets['link'] }}" class="btn btn-primary" title="search">{{ $gets['button_txt'] }}</a>
            </div>
            @endif
        </div>
    </div>
    @endif
</section>
<!-- recommendations end -->
<!-- categories start -->

@if(!$category->isEmpty())
<section id="categories" class="categories-main-block">
    <div class="container">
        @if( count($category->where('featured', '1')) > 0)

        <h3 class="categories-heading btm-30">{{ __('frontstaticword.FeaturedCategories') }}</h3>
        <div class="row">
            @foreach($category as $t)
            @if($t->status == 1 && $t->featured == 1)

            <div class="col-lg-2 col-md-2 col-sm-6 col-6">

                <div class="image-container btm-20">
                    <a
                        href="{{ route('category.page',['id' => $t->id, 'category' => str_slug(str_replace('-','&',$t->slug))]) }}">

                        <div class="image-overlay">
                            <i class="fa {{ $t['icon'] }}"></i>{{ $t['title'] }}
                        </div>

                        @if($t['cat_image'] == !NULL)
                        <img src="{{ asset('images/category/'.$t['cat_image']) }}">
                        @else
                        <img src="{{ Avatar::create($t->title)->toBase64() }}">
                        @endif
                    </a>
                </div>

            </div>

            @endif
            @endforeach
        </div>

        @endif
    </div>
</section>



@endif

<!-- categories end -->
<!-- testimonial start -->

@if( ! $testi->isEmpty() )
<section id="testimonial" class="testimonial-main-block">
    <div class="container">
        <h4 class="btm-30">{{ __('frontstaticword.HomeTestimonial') }}</h4>
        <div id="testimonial-slider" class="testimonial-slider-main-block owl-carousel">
            @foreach($testi as $tes)
            <div class="item testimonial-block text-center">
                <div class="row mx-4">
                    <div class="col-lg-4 col-md-3 col-sm-12 col-12">
                        <div class="testimonial-img">
                            <img data-src="{{ asset('images/testimonial/'.$tes['image']) }}" alt="blog" class="img-fluid owl-lazy">
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-9 col-sm-12 col-12">
                        <div class="testimonial-name">
                            <h5 class="testimonial-heading">{{ $tes['client_name'] }}</h5>
                            <p class="testimonial-para">{{ $tes['designation'] }}</p>
                        </div>
                        <div class="testimonial-rating">
                            @for($i = 1; $i <= 5; $i++) @if($i<=$tes->rating)
                                <i class='fa fa-star' style='color:orange'></i>
                                @else
                                <i class='fa fa-star' style='color:#ccc'></i>
                                @endif
                            @endfor
                        </div>
                    </div>
                </div>
                <p>{{ str_limit(preg_replace("/\r\n|\r|\n/",'',strip_tags(html_entity_decode($tes->details))) , $limit = 300, $end = '...') }}</p>
            </div>

            @endforeach
        </div>
    </div>
</section>
@endif
<!-- testimonial end -->


<!-- Advertisement -->
@if(isset($advs))
@foreach($advs as $adv)
@if($adv->position == 'belowtestimonial')
<br>
<section id="student" class="student-main-block btm-40">
    <div class="container">
        <a href="{{ $adv->url1 }}" title="{{ __('Click to visit') }}">
            <img class="lazy img-fluid advertisement-img-one" data-src="{{ url('images/advertisement/'.$adv->image1) }}"
                alt="{{ $adv->image1 }}">
        </a>
    </div>
</section>

@endif
@endforeach
@endif


@if( !$trusted->isEmpty() )
<section id="trusted" class="trusted-main-block">
    <div class="container">
        <div class="patners-block">

            <h6 class="patners-heading text-center btm-40">{{ __('frontstaticword.Trusted') }}</h6>
            <div id="patners-slider" class="patners-slider owl-carousel">
                @foreach($trusted as $trust)
                <div class="item-patners-img">
                    <a href="{{ $trust['url'] }}" target="_blank"><img
                            data-src="{{ asset('images/trusted/'.$trust['image']) }}" class="img-fluid owl-lazy"
                            alt="patners-1"></a>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</section>
@endif

<section id="trusted" class="trusted-main-block">
    <!-- google adsense code -->
    <div class="container-fluid" id="adsense">
        @php
        $ad = App\Adsense::first();
        @endphp
        <?php
            if (isset($ad) ) {
             if ($ad->ishome==1 && $ad->status==1) {
                $code = $ad->code;
                echo html_entity_decode($code);
             }
            }
        ?>
    </div>
</section>

@endsection

@section('custom-script')
<script>
    (function ($) {
        "use strict";
        $(function () {
            $("#home-tab").trigger("click");
        });
    })(jQuery);

    function showtab(id) {
        $.ajax({
            type: 'GET',
            url: '{{ url('/tabcontent') }}/' + id,
            dataType: 'json',
            success: function (data) {

                $('.btn_more').html(data.btn_view);
                $('#tabShow').html(data.tabview);

            }
        });
    }
</script>

<script src="{{ url('js/colorbox-script.js')}}"></script>


<script>
    "use Strict";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(function () {
        $('.compare').on('click', function (e) {
            var id = $(this).data('id');
            $.ajax({
                type: "POST",
                dataType: "json",
                url: 'compare/dataput',
                data: {
                    id: id
                },
                success: function (data) {}
            });
        });
    });
</script>



@endsection