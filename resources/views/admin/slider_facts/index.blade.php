@extends('admin.layouts.master')
@section('title', 'Facts Slider - Admin')
@section('maincontent')
 


@component('components.breadcumb',['thirdactive' => 'active'])
@slot('heading')
   {{ __('Facts Slider') }}
@endslot
@slot('menu1')
   {{ __('Front Settings') }}
@endslot
@slot('menu2')
   {{ __('Facts Slider') }}
@endslot

@slot('button')
<div class="col-md-4 col-lg-4">
  <div class="widgetbar">
      <a  href="{{url('facts/create')}}" class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>{{ __("Add Slider facts")}}</a>
      <a href="page-product-detail.html" class="btn btn-danger-rgba"  data-toggle="modal" data-target=".bd-example-modal-sm1"><i class="feather icon-trash mr-2"></i>{{ __("Delete Selected")}}</a>
                                
      <div class="modal fade bd-example-modal-sm1" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-sm">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleSmallModalLabel">{{ __("Delete")}}</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body text-center">
                      <p class="text-muted">{{ __("Do you really want to delete these records? This process cannot be undone.")}}</p>
                  </div>
                  <div class="modal-footer">
                    <form method="post" action="{{ action('BulkdeleteController@factssliderdeleteAll') }}
                    " id="bulk_delete_form" data-parsley-validate class="form-horizontal form-label-left">
                    {{ csrf_field() }}


                    
                    
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("No")}}</button>
                      <button type="submit" class="btn btn-danger">{{ __("Yes")}}</button>
                  </form>
                  </div>
              </div>
          </div>
      </div>
  </div>                        
</div>
@endslot
@endcomponent

  <div class="contentbar">                
    <!-- Start row -->
    <div class="row">
    
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="box-title">{{ __('Facts Sliders')}}</h5>
                </div>
                <div class="card-body">
                 
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                              <th>
                                <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all" id="checkboxAll">
                                <label for="checkboxAll" class="material-checkbox"></label> 
                                #</th>
                              <th>{{ __('adminstaticword.Icon') }}</th>
                              <th>{{ __('adminstaticword.Heading') }}</th>
                              <th>{{ __('adminstaticword.SubHeading') }}</th>
                              <th>{{ __('adminstaticword.Action') }}</th>
                            
                            </tr>
                            </thead>
                            <tbody>
                              <?php $i=0;?>
                              @foreach($facts as $fact)
                              <?php $i++;?>
                              <tr>
                                <td><input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="{{$fact->id}}" id="checkbox{{$fact->id}}">
                                    <label for="checkbox{{$fact->id}}" class="material-checkbox"></label><?php echo $i;?></td>
                                <td><i class="fa {{$fact->icon}}"></i></td>
                                <td>{{$fact->heading}}</td>
                                <td>{{$fact->sub_heading}}</td>
                                <td>
                                 <div class="dropdown">
                                     <button class="btn btn-round btn-primary-rgba" type="button" id="CustomdropdownMenuButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                     <div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton3">
                                         <a class="dropdown-item"    href="{{route('facts.edit',$fact->id)}}" ><i class="feather icon-edit mr-2"></i>{{ __("Edit")}}</a>
                                         <a class="dropdown-item" data-toggle="modal" data-target=".bd-example-modal-sm"><i class="feather icon-delete mr-2"></i>{{ __("Delete")}}</a>
                                       
                                     </div>
                                 </div>
                               </td>
                                

                              
                              
                                  

                                
                                  
                                  <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                                      <div class="modal-dialog modal-sm">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleSmallModalLabel">{{ __('Delete') }}</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                  </button>
                                              </div>
                                              <div class="modal-body">
                                                  <p class="text-muted">{{ __("Do you really want to delete these records? This process cannot be undone.")}}</p>
                                              </div>
                                              <div class="modal-footer">
                                                <form  method="post" action="{{url('facts/'.$fact->id)}}
                                                  "data-parsley-validate class="form-horizontal form-label-left">
                                                  {{ csrf_field() }}
                                                  {{ method_field('DELETE') }}
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("No")}}</button>
                                                  <button type="submit" class="btn btn-danger">{{ __("Yes")}}</button>
                                              </form>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              
                
                
                                @endforeach
                             
                              </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End col -->
    </div>
    <!-- End row -->
</div>        


@endsection
