@extends('admin.layouts.master')
@section('title','All User')
@section('maincontent')
@component('components.breadcumb',['secondaryactive' => 'active'])
@slot('heading')
{{ __('Users') }}
@endslot

@slot('menu1')
{{ __('Users') }}
@endslot

@slot('button')

<div class="col-md-4 col-lg-4">
    <div class="widgetbar">
        <button type="button" class="float-right btn btn-danger-rgba mr-2 " data-toggle="modal"
            data-target="#bulk_delete"><i class="feather icon-trash mr-2"></i> {{ __('Delete Selected') }} </button>
        <a href="{{route('user.add')}}" class="float-right btn btn-primary-rgba mr-2"><i
                class="feather icon-plus mr-2"></i>{{ __('Add User') }} </a>

    </div>
</div>

@endslot
@endcomponent

<div class="contentbar">
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="box-title"> {{ __('All Users') }}</h5>
                </div>
                <div style="display:none" id="msg" class="alert alert-success">
                    <span id="res_message"></span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="userstable" class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>
                                        <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]"
                                            value="all" />
                                        <label for="checkboxAll" class="material-checkbox"></label> #
                                    </th>
                                    <th>#</th>
                                    <th>{{ __('adminstaticword.Image') }}</th>
                                    <th>{{ __('adminstaticword.Users') }}</th>
                                     <th>{{ __('adminstaticword.Role') }}</th>
                                    <th>{{ __('adminstaticword.Login As User') }}</th>
                                    <th>{{ __('adminstaticword.Status') }}</th>
                                    <th>{{ __('adminstaticword.Action') }}</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                         
                                        <div id="bulk_delete" class="delete-modal modal fade" role="dialog">
                                            <div class="modal-dialog modal-sm">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                        <div class="delete-icon"></div>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <h4 class="modal-heading">Are You Sure ?</h4>
                                                        <p>Do you really want to delete selected item names here? This
                                                            process
                                                            cannot be undone.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form id="bulk_delete_form" method="post"
                                                            action="{{ route('user.bulk_delete') }}">
                                                            @csrf
                                                            @method('POST')
                                                            <button type="reset" class="btn btn-gray translate-y-3"
                                                                data-dismiss="modal">No</button>
                                                            <button type="submit" class="btn btn-danger">Yes</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                   
                                   
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
@section('script')


<!-- script for datatable end -->
<script type="text/javascript">
    $(function () {
      
      var table = $('#userstable').DataTable({
          processing: true,
          serverSide: true,
          searchDelay : 1000,
          stateSave : true,
          ajax: "{{ route('user.index') }}",
          columns: [
              {data: 'checkbox', name: 'checkbox'},
              {data: 'DT_RowIndex', name: 'users.id'},
              {data: 'image', name: 'image' , orderable: false, searchable: false},
              {data: 'name',name: 'users.fname'},
              {data: 'role', name: 'users.role' , orderable: false, searchable: false},
              {data: 'loginasuser', name: 'loginasuser' , orderable: false, searchable: false},
              {data: 'status', name: 'status', orderable: false, searchable: false},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
      
    });
</script>

<script>

    $(document).on("change", ".user", function () {

        $.ajax({
            type: "GET",
            dataType: "json",
            url: 'user/status',
            data: {
                'status': $(this).is(':checked') ? 1 : 0,
                'id': $(this).data('id')
            },
            success: function(data){
                var warning = new PNotify( {
                title: 'success', text:'Status Update Successfully', type: 'success', desktop: {
                desktop: true, icon: 'feather icon-thumbs-down'
                }
            });
                warning.get().click(function() {
                    warning.remove();
                });
            }
        });
    });

    $("#checkboxAll").on('click', function () {
        $('input.check').not(this).prop('checked', this.checked);
    });
</script>
@endsection