@extends('admin.layouts.master')
@section('title','All Coupans')
@section('maincontent')
@component('components.breadcumb',['secondaryactive' => 'active'])
@slot('heading')
   {{ __('Coupan') }}
@endslot

@slot('menu1')
   {{ __('Coupan') }}
@endslot

@slot('button')
<div class="col-md-4 col-lg-4">
  <button type="button" class="float-right btn btn-danger-rgba mr-2 " data-toggle="modal" data-target="#bulk_delete"><i
    class="feather icon-trash mr-2"></i> {{ __('Delete Selected') }}</button>
  <a href="{{ route('coupon.create') }}"  class="float-right btn btn-primary-rgba mr-2"><i class="feather icon-plus mr-2"></i>{{ __('Add Coupon') }}</a>

</div> 
@endslot
@endcomponent

<div class="contentbar"> 
  <div class="row">
      
      <div class="col-lg-12">
          <div class="card m-b-30">
              <div class="card-header">
                  <h5 class="card-box">{{ __('All Coupans') }}</h5>
              </div>
              <div class="card-body">
              
                  <div class="table-responsive">
                      <table id="datatable-buttons" class="table table-striped table-bordered">
                          <thead>
                          
                                 
                             
                    <th> <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]"
                      value="all" /> {{ __('adminstaticword.ID') }}  </th>
                  <label for="checkboxAll" class="material-checkbox"></label></th>
                    <th>{{ __('adminstaticword.CODE') }}</th>
                    <th>{{ __('adminstaticword.Amount') }}</th>
                    <th>{{ __('adminstaticword.MaxUsage') }}</th>
                    <th>{{ __('adminstaticword.Detail') }}</th>
                    <th>{{ __('adminstaticword.Action') }}</th>
                  </thead>
  
                  <tbody>
                    @foreach($coupans as $key=> $cpn)
                      <tr>
                        <td>
                         
                              <input type='checkbox' form='bulk_delete_form' class='check filled-in material-checkbox-input'
                                  name='checked[]' value='{{ $cpn->id }}' id='checkbox{{ $cpn->id }}'>
                              <label for='checkbox{{ $cpn->id }}' class='material-checkbox'></label>
                        
                          <div id="bulk_delete" class="delete-modal modal fade" role="dialog">
                              <div class="modal-dialog modal-sm">
                                  <!-- Modal content-->
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          <div class="delete-icon"></div>
                                      </div>
                                      <div class="modal-body text-center">
                                          <h4 class="modal-heading">{{ __('Are You Sure') }} ?</h4>
                                          <p>{{ __('Do you really want to delete selected item names here? This process
                                              cannot be undone') }}.</p>
                                      </div>
                                      <div class="modal-footer">
                                          <form id="bulk_delete_form" method="post"
                                              action="{{ route('coupon.bulk_delete') }}">
                                              @csrf
                                              @method('POST')
                                              <button type="reset" class="btn btn-gray translate-y-3"
                                                  data-dismiss="modal">{{ __('No') }}</button>
                                              <button type="submit" class="btn btn-danger">{{ __('Yes') }}</button>
                                          </form>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          {{ $key+1 }}
                      </td>
                       
                        <td>{{ $cpn->code }}</td>
                        
                        <td>@if($cpn->distype == 'fix') <i class="fa {{ $currency->icon }}"></i> @endif {{ $cpn->amount }}@if($cpn->distype == 'per')% @endif </td>
                        <td>{{ $cpn->maxusage }}</td>
                        <td>
                          <p>{{ __('adminstaticword.Linkedto') }}: <b>{{ ucfirst($cpn->link_by) }}</b></p>
                          <p>{{ __('adminstaticword.ExpiryDate') }}: <b>{{ date('d-M-Y',strtotime($cpn->expirydate)) }}</b></p>
                          <p>{{ __('adminstaticword.DiscountType') }}: <b>{{ $cpn->distype == 'per' ? "Percentage" : "Fixed Amount" }}</b></p>
                           <p>{{ __('Coupon Code display on front') }}: <b> 
                             @if($cpn->show_to_users == '1')
                                {{ __('Yes') }}
                              @else
                                {{ __('No') }}
                              @endif
    
                           </b></p>
                        </td>
                        <td>
                            @if (isset($cpn->stripe_coupon_id))
                            -
                        @else
                        <div class="btn-group mr-2">
                          <div class="dropdown">
                              <button class="btn btn-round btn-primary-rgba" type="button" id="CustomdropdownMenuButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                              <div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton3">
                                  <a class="dropdown-item" href="{{ route('coupon.edit',$cpn->id) }}" class="btn btn-xs btn-success-rgba"><i class="feather icon-edit-2"></i>{{ __('Edit') }}</a>
                                  <a class="dropdown-item btn btn-link" data-toggle="modal" data-target="#delete{{$cpn->id}}" >
                                    <i class="feather icon-delete mr-2"></i>{{ __("Delete") }}</a>
                                </a>
                 
                          </div>
                      </div>
                          @endif
                        </td>
                        
    
                        <div id="coupon{{ $cpn->id }}" class="delete-modal modal fade" role="dialog">
                            <div class="modal-dialog modal-sm">
                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <div class="delete-icon"></div>
                                </div>
                                <div class="modal-body text-center">
                                  <h4 class="modal-heading">{{ __('Are You Sure') }} ?</h4>
                                  <p>{{ __('Do you really want to delete this Coupon ? This process cannot be undone') }}.</p>
                                </div>
                                <div class="modal-footer">
                                     <form method="post" action="{{route('coupon.destroy',$cpn->id)}}" class="pull-right">
                                        {{csrf_field()}}
                                        {{method_field("DELETE")}}
    
                                     <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{ __('adminstaticword.No') }}</button>
                                    <button type="submit" class="btn btn-danger">{{ __('adminstaticword.Yes') }}</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                        </div>
                      </tr>
                    @endforeach
                  </tbody>
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
@section('scripts')

<script>
      $("#checkboxAll").on('click', function () {
  $('input.check').not(this).prop('checked', this.checked);
});
</script>
@endsection
