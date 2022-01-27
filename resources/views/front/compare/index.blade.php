@extends('theme.master')
@section('title', 'Compare')
@section('content')

@include('admin.message')
<style>
    .compare-image{
        height:150px;
        width:150px;
    }
</style>
<!-- about-home start -->
<section id="blog-home" class="blog-home-main-block">
    <div class="container">
        <h1 class="blog-home-heading">{{ __('Course Compare') }}</h1>
    </div>
</section> 

<section id="blog" class="blog-main-block">
    <div class="container">
       
      <div class="row">
          <div class="col-md-12">
            <div class="card-body">
                <!-- Start table div -->
                <div class="table-responsive">
                    <!-- Start table-->
                    <table  class="table table-striped table-bordered">
                       
                        
                        <tbody class="bg-white">
                            <tr>
                                <td>
                                    
                                </td>
                                @foreach($compare as $cour)
                                @php
                                $c = App\Course::where('id', $cour->course_id)->first();
                                @endphp
                                <td>
                                    <img src="{{ asset('images/course/'.$c->preview_image) }}" alt="course" class="img-fluid compare-image">
                                <h5 class="text-info mt-2">{{ $c->title }}</h5>

                                </td>
                                
                                @endforeach
                               
                            </tr>
                        </tbody>
                        <tbody>
                            <tr class="bg-white">
                                <td>
                                  <h5>Price</h5> 
                                </td>
                                @foreach($compare as $cour)
                                    @php
                                    $c = App\Course::where('id', $cour->course_id)->first();
                                    @endphp
                                    <td>{{ $c->price }}</td>
                                @endforeach
                               
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td>
                                 <h5>Discount Price</h5>  
                                </td>
                                @foreach($compare as $cour)
                                    @php
                                    $c = App\Course::where('id', $cour->course_id)->first();
                                    @endphp
                                    <td>@if($c->discount_price)
                                        {{  $c->discount_price }}
                                        @else
                                        <i class="fa fa-times text-danger" aria-hidden="true"></i>
                                        @endif
                                    </td>
                                @endforeach
                               
                            </tr>
                        </tbody >
                        <tbody>
                            <tr class="bg-white">
                                <td>
                                  <h5>Language</h5>  
                                </td>
                                @foreach($compare as $cour)
                                @php
                                $c = App\Course::where('id', $cour->course_id)->first();
                                @endphp
                                @php
                                $lang = App\Language::where('id', $c->language_id)->first();
                                @endphp
                               <td>
                               <p>{{ $lang->name }}</p>
                               </td>
                               @endforeach
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td>
                                 <h5>Last updated at</h5>   
                                </td>
                                @foreach($compare as $cour)
                                @php
                                $c = App\Course::where('id', $cour->course_id)->first();
                                @endphp
                               
                               <td>
                               <p>{{ date('d-M-Y', strtotime($c->updated_at)); }}</p>
                               </td>
                               @endforeach
                            </tr>
                        </tbody>
                        <tbody >
                            <tr class="bg-white">
                                <td>
                                    <h5>Duration end time</h5>
                                    
                                </td>
                                @foreach($compare as $cour)
                                @php
                                $c = App\Course::where('id', $cour->course_id)->first();
                                @endphp
                               
                               <td>
                                <p>@if($c->duration && $c->duration_type)
                                    {{ $c->duration }}  {{ $c->duration_type }}
                                    @else
                                    <span class="badge badge-pill badge-primary">Life time </span>
                                 @endif

                                </p>
                                </td>
                               @endforeach
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td>
                                   <h5>Requirements</h5> 
                                </td>
                                @foreach($compare as $cour)
                                @php
                                $c = App\Course::where('id', $cour->course_id)->first();
                                @endphp
                               
                               <td>
                                <p>{{ $c->requirement }}</p>
                                </td>
                               @endforeach
                            </tr>
                        </tbody>
                        <tbody>
                            <tr class="bg-white">
                                <td>
                                 <h5>Short Detail</h5>   
                                </td>
                                @foreach($compare as $cour)
                                @php
                                $c = App\Course::where('id', $cour->course_id)->first();
                                @endphp
                               
                               <td>
                                <p>{{ $c->short_detail }}</p>
                                </td>
                               @endforeach
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td>
                                   <h5>Category</h5> 
                                </td>
                                @foreach($compare as $cour)
                                @php
                                    $c = App\Course::where('id', $cour->course_id)->first();
                                @endphp
                                @php
                                    $cate = App\Categories::where('id', $c->category_id)->first();
                                @endphp
                               <td>
                                <p>{{ $cate->title }}</p>
                                </td>
                               @endforeach
                            </tr>
                        </tbody>
                        <tbody>
                            <tr class="bg-white">
                                <td>
                                  <h5>Sub Category</h5>  
                                </td>
                                @foreach($compare as $cour)
                                @php
                                    $c = App\Course::where('id', $cour->course_id)->first();
                                @endphp
                                @php
                                    $subcate = App\SubCategory::where('id', $c->subcategory_id)->first();
                                @endphp
                               <td>
                                <p>{{ $subcate->title }}</p>
                                </td>
                               @endforeach
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td>
                                   <h5>Certificate</h5> 
                                </td>
                                @foreach($compare as $cour)
                                @php
                                    $c = App\Course::where('id', $cour->course_id)->first();
                                @endphp
                               
                               <td>
                                <p>@if($c->certificate_enable == 1)</p>
                                <i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                  @else
                                  <i class="fa fa-times text-danger" aria-hidden="true"></i>
                                  @endif

                                </td>
                               @endforeach
                            </tr>
                        </tbody>
                        <tbody>
                            <tr class="bg-white">
                                <td>
                                   <h5>Appointment</h5> 
                                </td>
                                @foreach($compare as $cour)
                                @php
                                    $c = App\Course::where('id', $cour->course_id)->first();
                                @endphp
                               
                               <td>
                                <p>@if($c->appointment_enable == 1)</p>
                                <i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                  @else
                                  <i class="fa fa-times text-danger" aria-hidden="true"></i>
                                  @endif

                                </td>
                               @endforeach
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td>
                                   <h5>Assignment</h5> 
                                </td>
                                @foreach($compare as $cour)
                                @php
                                    $c = App\Course::where('id', $cour->course_id)->first();
                                @endphp
                               
                               <td>
                                <p>@if($c->assignment_enable == 1)</p>
                                <i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                  @else
                                  <i class="fa fa-times text-danger" aria-hidden="true"></i>
                                  @endif

                                </td>
                               @endforeach
                            </tr>
                        </tbody>
                        <tbody>
                            <tr class="bg-white">
                                <td>
                                    
                                </td>
                                @foreach($compare as $cour)
                               
                               
                               <td>
                               <a href="{{ route('compare.remove',['id' => $cour->id]) }}"><span class="badge badge-danger">{{ __("Remove") }}</span></a> 

                                </td>
                               @endforeach
                            </tr>
                        </tbody>
                    </table>
                    <!-- end table -->
                </div>
                <!-- end table div -->
            </div>
          </div>
      </div>
                   
                      
                        

    </div>
    <hr>
</section>

@endsection
