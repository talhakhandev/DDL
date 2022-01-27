<form class="form" action="{{ route('login.update') }}" method="POST" novalidate enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="form-group col-md-12">
            <label class="text-dark" for="exampleInputSlug">{{ __('adminstaticword.Image') }}: </label>


            <div class="input-group mb-3">

                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">{{ __('Upload') }}</span>
                </div>
                <div class="custom-file">

                    <input type="file" name="img" class="custom-file-input" id="img"
                        aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="inputGroupFile01">{{ __('Choose file') }}</label>
                </div>
            </div>
            @if($setting['img'] !== NULL && $setting['img'] !== '')
            <img src="{{ url('/images/login/'.$setting->img) }}" height="100px;" width="100px;"/>
          @else
            <img src="{{ Avatar::create($setting->text)->toBase64() }}" alt="course" class="img-fluid">
          @endif
        </div>
        <div class="form-group col-md-12">
            <label class="text-dark">{{ __('adminstaticword.Text') }}:</label>
            <input name="text" value="{{ $setting->text }}" autofocus="" type="text"
                class="{{ $errors->has('text') ? ' is-invalid' : '' }} form-control" placeholder="Enter text"
                 required="">
            <div class="invalid-feedback">
                {{ __('Please enter text!') }}.
            </div>
        </div>
    </div>
    <div class="form-group">
        <button type="reset" class="btn btn-danger-rgba mr-1"><i class="fa fa-ban"></i>
            {{ __("Reset")}}</button>
        <button type="submit" class="btn btn-primary-rgba"><i class="fa fa-check-circle"></i>
            {{ __("Update")}}</button>
    </div>
</form>