<header>
        <nav class="navbar navbar-light bg-light header">
            <div class="container">
                <div class="d-flex align-items-center py-3 header">
                  <img style="object-fit:scale-down;" src="{{ url('images/logo/'.$gsetting->logo) }}"
                  class="img-fluid" alt="logo">
                   
                </div>
                <div class="col-md-4 col-lg-4">
                  <a href="{{ url()->previous() }}" class="float-right btn btn-primary-rgba mr-2"><i
                      class="feather icon-arrow-left mr-2"></i>{{ __('Back') }}</a>
                </div>
            </div>
        </nav>
    </header>