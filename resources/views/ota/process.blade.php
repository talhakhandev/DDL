@extends('admin.layouts.master')
@section('title', 'Update Process - Admin')
@section('maincontent')
@component('components.breadcumb',['fourthactive' => 'active'])
@slot('heading')
   {{ __('Update Process') }}
@endslot
@slot('menu1')
{{ __('Update Process') }}
@endslot
@endcomponent
<div class="contentbar">
    <div class="row">
@if ($errors->any())  
  <div class="alert alert-danger" role="alert">
  @foreach($errors->all() as $error)     
  <p>{{ $error}}<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true" style="color:red;">&times;</span></button></p>
      @endforeach  
  </div>
  @endif
    <!-- row started -->
    <div class="col-lg-12">
    
        <div class="card m-b-30">
        @include('admin.message')
                <!-- Card header will display you the heading -->
                <div class="card-header">
                    <h5 class="card-box">{{ __('Update Process') }}</h5>
                </div> 
               
                <!-- card body started -->
                <div class="card-body bg-primary-rgba ml-5 mr-5 mb-5">
                <!-- ===================== -->
          <small class="text-info process-fonts"><i class="fa fa-info-circle"></i> Important Note:

    <br>
<ul class="process-font">
    <li>Note: Before Update Take Backup of All Files And Database. Make .zip file and download all file, Go To phpmyadmin and select your database and export it.<br/></li>
    <li>Copy All files and paste to you folder replace file. Only be careful when replace files in public folder, don't copy<code> .env </code>file. Any user customize design and code please do not update.</li>
    <li>Update to Latest Version </li>
    <li>Copy All files of folder and paste to you folder and replace files, only be careful when replace files in public folder, don't copy<code> .env </code>file.Any user customize design and code please do not update.</li>
    <li>After replacing the files successfully 
    <li>login with admin goto yourdomain.com/ota/update. If your domain contain public then goto </li>
    <li>yourdomain.com/public/ota/update</li><li>. Read update pre-notes and FAQ properly, then check the agreement box and click on update. After the update completion you will be redirected to yourdomain with a successful update message.</li>
    <li> Once the process is complete you will see a successful message on your home page.</li>
    <li>You successfully upgraded to latest version </li>

</ul>
</small>

        <!-- ===================== -->
                </div>
        <!-- card body end -->
            
        </div><!-- col end -->
    </div>

   
</div>
</div><!-- row end -->
    <br><br>
@endsection
<!-- main content section ended -->
<!-- This section will contain javacsript start -->
@section('script')
@endsection
<!-- This section will contain javacsript end -->