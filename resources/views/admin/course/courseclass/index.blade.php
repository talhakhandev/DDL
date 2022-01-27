<div class="row">
  <div class="col-lg-12">
    <div class="card m-b-30">
      <div class="card-header">
        <button type="button" class="btn btn-danger-rgba mr-2 " data-toggle="modal" data-target="#bulk_delete4"><i
            class="feather icon-trash mr-2"></i> Delete Selected</button>


        <a data-toggle="modal" data-target="#myModalab" href="#" class="btn btn-primary-rgba"><i
            class="feather icon-plus "></i>{{ __('Add Course Classes') }}</a>


        <a href="http://www.webdesign-flash.ro/vs/" target="_blank" class="float-right btn btn-primary-rgba mr-2" ><i class="feather icon-navigation mr-2"></i>{{ __('Encrypt Link') }}</a>
      </div>

      <div class="card-body">

        <div class="table-responsive">
          <table id="" class="displaytable table table-striped table-bordered w-100">
            <thead>
              <tr>
                <th>

                  <input id="checkboxAll4" type="checkbox" class="filled-in" name="checked[]" value="all" />
                  <label for="checkboxAll" class="material-checkbox"></label> #</th>
                <th>{{ __('adminstaticword.CourseChapter') }}</th>
                <th>{{ __('adminstaticword.Title') }}</th>
                <th>{{ __('adminstaticword.Status') }}</th>
                <th>{{ __('adminstaticword.Featured') }}</th>
                <th>{{ __('adminstaticword.Action') }}</th>

              </tr>
            </thead>
            <tbody id="sortable">
              <?php $ij=0; ?>
              @foreach($courseclass as $cat)
              <?php $ij++; ?>
              <tr class="sortable row1" data-id="{{ $cat->id }}">
               
                <td>
                  <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input4" name="checked[]" value="{{$cat->id}}" id="checkbox{{$cat->id}}">
                    <label for="checkbox{{$cat->id}}" class="material-checkbox"></label> <?php echo $ij; ?>

                    
                  <div id="bulk_delete4" class="delete-modal modal fade" role="dialog">
                    <div class="modal-dialog modal-sm">
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <div class="delete-icon"></div>
                        </div>
                        <div class="modal-body text-center">
                          <h4 class="modal-heading">Are You Sure ?</h4>
                          <p>Do you really want to delete selected item ? This process
                            cannot be undone.</p>
                        </div>
                        <div class="modal-footer">
                          <form id="bulk_delete_form" method="post" action="{{ route('courseclass.bulk_delete') }}">
                            @csrf
                            @method('POST')
                            <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-danger">Yes</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
                @php
                $chname = App\CourseChapter::where('id','=',$cat->coursechapter_id)->get();
                @endphp
                <td>
                  @foreach($chname as $cc)
                  {{ $cc->chapter_name }}
                  @endforeach
                </td>
                <td>{{$cat->title}}</td>
                 <td>
                    <label class="switch">
                      <input class="slider" type="checkbox"  data-id="{{$cat->id}}" name="status" {{ $cat->status == '1' ? 'checked' : '' }} onchange="courceclassstatus('{{$cat->id}}')" />
                      <span class="knob"></span>
                    </label>
                </td>
                <td>
                    <label class="switch">
                      <input class="slider" type="checkbox"  data-id="{{$cat->id}}" name="featured" {{ $cat->featured ==1 ? 'checked' : ''}} onchange="courceclassfeatured('{{$cat->id}}')" />
                      <span class="knob"></span>
                    </label>
                </td>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-round btn-outline-primary" type="button" id="CustomdropdownMenuButton1"
                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                        class="feather icon-more-vertical-"></i></button>
                    <div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton1">
                      <a class="dropdown-item" href="{{url('courseclass/'.$cat->id)}}"><i
                          class="feather icon-edit mr-2"></i>Edit</a>
                      <a class="dropdown-item btn btn-link" data-toggle="modal" data-target="#delete{{ $cat->id}}">
                        <i class="feather icon-delete mr-2"></i>{{ __("Delete") }}</a>
                      </a>
                    </div>
                  </div>
                  <div class="modal fade bd-example-modal-sm" id="delete{{ $cat->id }}" tabindex="-1" role="dialog"
                    aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleSmallModalLabel">Delete</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <h4>{{ __('Are You Sure ?')}}</h4>
                          <p>{{ __('Do you really want to delete')}} ? {{ __('This process cannot be undone.')}}</p>
                        </div>
                        <div class="modal-footer">
                          <form method="post" action="{{url('courseclass/'.$cat->id)}}" class="pull-right">
                            {{csrf_field()}}
                            {{method_field("DELETE")}}
                            <button type="reset" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-primary">Yes</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>

              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="modal fade" id="myModalab" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="my-modal-title">
              <b>Add Course Class</b>
          </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
          </div>
          <div class="box box-primary">
            <div class="panel panel-sum">
              <div class="modal-body">
                <form enctype="multipart/form-data" id="demo-form2" method="post"
                  action="{{ route('courseclass.store') }}" data-parsley-validate
                  class="form-horizontal form-label-left">
                  {{ csrf_field() }}

                     <select class="d-none" name="course_id" class="form-control select2">
                  <option value="{{ $cor->id }}">{{ $cor->title }}</option>
                </select>

                  <div class="row">
                    <div class="col-md-12">
                      <label for="exampleInputDetails">{{ __('adminstaticword.ChapterName') }}:<sup
                          class="redstar">*</sup></label>
                      <select name="course_chapters" class="form-control select2" required>
                        @foreach($coursechapters as $c)
                        <option value="{{ $c->id }}">{{ $c->chapter_name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <br>


                  <div class="row">
                    <div class="col-md-12">
                      <label for="exampleInputDetails">{{ __('adminstaticword.Title') }}:<sup
                          class="redstar">*</sup></label>
                      <input type="text" class="form-control " name="title" id="exampleInputTitle"
                        placeholder="Enter Your Title" value="" required>
                    </div>
                  </div>
                  <br>

                  <div class="row">
                    <div class="col-md-12">
                      <label for="exampleInputDetails">{{ __('adminstaticword.Detail') }}:</label>
                      <textarea id="details" name="detail" rows="3" class="form-control"></textarea>
                    </div>
                  </div>
                  <br>

                  <div class="row">
                    <div class="col-md-12 btm-20">
                      <label for="type">{{ __('adminstaticword.Type') }}:<sup class="redstar">*</sup></label>
                      <select name="type" id="filetype" class="form-control select2" required>
                        <option>{{ __('adminstaticword.ChooseFileType') }}</option>
                        <option value="video">{{ __('adminstaticword.Video') }}</option>
                        <option value="audio">{{ __('adminstaticword.Audio') }}</option>
                        <option value="image">{{ __('adminstaticword.Image') }}</option>
                        <option value="zip">{{ __('adminstaticword.Zip') }}</option>
                        <option value="pdf">{{ __('Pdf / Powerpoint / Notepad') }}</option>
                      </select>
                    </div>
                    <br>
                    
                    <!--for audio -->
                    <div class="col-md-12 btm-20" id="audioChoose" style="display:none">
                      <input type="radio" name="checkAudio" id="ch11" value="audiourl"> {{ __('adminstaticword.URL') }}
                      <input type="radio" name="checkAudio" id="ch12" value="uploadaudio">
                      {{ __('adminstaticword.UploadAudio') }}
                    </div>

                    <div class="col-md-12" id="audioURL" style="display:none">
                      <label for="">{{ __('adminstaticword.URL') }}: </label>
                      <input type="text" name="audiourl" placeholder="Enter Your URL" class="form-control">
                    </div>

                    <div class="col-md-12" id="audioUpload" style="display:none">
                      <label for="">{{ __('adminstaticword.UploadAudio') }}: </label>
                      <!-- =========== -->
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="audioupload" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" >
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                      </div>
                      <!-- =========== -->
                      <!-- <input type="file" name="audioupload" class="form-control"> -->
                    </div>
                    <!--for image -->
                    <div class="col-md-12" id="imageChoose" style="display:none">
                      <input type="radio" name="checkImage" id="ch3" value="url"> {{ __('adminstaticword.URL') }}
                      <input type="radio" name="checkImage" id="ch4" value="uploadimage">
                      {{ __('adminstaticword.UploadImage') }}
                    </div>

                    <div class="col-md-12" id="imageURL" style="display:none">
                      <label for="">{{ __('adminstaticword.URL') }}: </label>
                      <input type="text" name="imgurl" placeholder="Enter Your URL" class="form-control">
                    </div>

                    <div class="col-md-12" id="imageUpload" style="display:none">
                      <label for="">{{ __('adminstaticword.UploadImage') }}: </label>
                      <!-- =========== -->
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                      </div>
                      <!-- =========== -->
                      <!-- <input type="file" name="image" class="form-control"> -->
                    </div>
                    <br>

                    <!--video-->
                    <div class="col-md-12 btm-20" id="videotype" style="display:none">
                      <input type="radio" name="checkVideo" id="ch1" value="url">&nbsp;{{ __('adminstaticword.URL') }}
                      &emsp;
                      <input type="radio" name="checkVideo" id="ch2"
                        value="uploadvideo">&nbsp;{{ __('adminstaticword.UploadVideo') }}
                      &emsp;
                      <input type="radio" name="checkVideo" id="ch9"
                        value="iframeurl">&nbsp;{{ __('adminstaticword.IframeURL') }}
                      &emsp;
                      <input type="radio" name="checkVideo" id="ch10"
                        value="liveurl">&nbsp;{{ __('adminstaticword.LiveClass') }}
                      &emsp;

                      @if($gsetting->aws_enable == 1)
                      <input type="radio" name="checkVideo" id="ch13"
                        value="aws_upload">&nbsp;{{ __('adminstaticword.AWSUpload') }}
                      @endif

                      @if($gsetting->youtube_enable == 1)
                      <input type="radio" name="checkVideo" id="youtubeurl"
                        value="youtube">&nbsp;{{ __('Youtube API') }}
                      &emsp;
                      @endif

                      @if($gsetting->vimeo_enable == 1)
                      <input type="radio" name="checkVideo" id="vimeourl" value="vimeo">&nbsp;{{ __('Vimeo API') }}
                      &emsp;
                      @endif

                      <br>
                    </div>

                    <div class="col-md-12" id="videoURL" style="display:none">
                      <label for="">{{ __('adminstaticword.URL') }}: </label>
                      <input type="text" id="apiUrl" name="vidurl" placeholder="Enter Your URL" class="form-control">
                    </div>

                    <div class="col-md-12" id="videoUpload" style="display:none">
                      <label for="">{{ __('adminstaticword.UploadVideo') }}: </label>
                      <!-- =========== -->
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="video_upld" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                      </div>
                      <!-- =========== -->
                      <!-- <input type="file" name="video_upld" class="form-control"> -->
                    </div>

                    <div class="col-md-12" id="iframeURLBox" style="display:none">
                      <label for="">{{ __('adminstaticword.IframeURL') }}: </label>
                      <input type="text" name="iframe_url" placeholder="Enter Your Iframe URL" class="form-control">
                    </div>


                    <div class="col-md-12" id="liveclassBox" style="display:none">
                      <label for="appt">Select a Date & Time:</label>
                      <br>
                      <input type="default-date" id="date_time" name="date_time" placeholder="dd/mm/yyyy"
                        class="datepicker-here form-control">
                    </div>

                    <!-- aws insert -->
                    @if($gsetting->aws_enable == 1)
                    <div class="col-md-12" id="awsBox" style="display:none">
                      <label for="appt">{{ __('adminstaticword.AWSUpload') }}</label>
                      <!-- =========== -->
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="aws_upload" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                      </div>
                      <!-- =========== -->
                      <!-- <input type="file" name="aws_upload" class="form-control"> -->
                    </div>
                    @endif


                    <!-- zip -->
                    <div class="col-md-12 btm-20" id="zipChoose" style="display:none">
                      <input type="radio" value="zipURLEnable" name="checkZip" id="ch5"> {{ __('adminstaticword.URL') }}
                      <input type="radio" value="zipEnable" name="checkZip" id="ch6">
                      {{ __('adminstaticword.UploadZip') }}
                    </div>

                    <div class="col-md-12" id="zipURL" style="display:none">
                      <label for="">{{ __('adminstaticword.URL') }}: </label>
                      <input type="text" name="zipurl" placeholder="Enter Your URL" class="form-control">
                    </div>

                    <div class="col-md-12" id="zipUpload" style="display:none">
                      <label for="">{{ __('adminstaticword.UploadZip') }}: </label>
                       <!-- =========== -->
                       <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="uplzip" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                      </div>
                      <!-- =========== -->
                      <!-- <input type="file" name="uplzip" class="form-control"> -->
                    </div>


                    <!-- pdf -->
                    <div class="col-md-12 btm-20" id="pdfChoose" style="display:none">
                      <input type="radio" value="pdfURLEnable" name="checkPdf" id="ch7"> {{ __('adminstaticword.URL') }}
                      <input type="radio" value="pdfEnable" name="checkPdf" id="ch8">
                      {{ __('adminstaticword.UploadPdf') }}
                    </div>

                    <div class="col-md-12" id="pdfURL" style="display:none">
                      <label for=""> {{ __('adminstaticword.URL') }}: </label>
                      <input type="text" name="pdfurl" placeholder="Enter Your URL" class="form-control">
                    </div>

                    <div class="col-md-12" id="pdfUpload" style="display:none">
                      <label for=""> {{ __('adminstaticword.UploadPdf') }}: </label>
                       <!-- =========== -->
                       <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="pdf" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                      </div>
                      <!-- =========== -->
                      <!-- <input type="file" name="pdf" class="form-control"> -->
                    </div>
                    <br>


                    <div class="col-md-12" id="duration_video" style="display:none">
                      <label for=""> {{ __('adminstaticword.Duration') }}:</label>
                      <input type="text" name="duration" placeholder="Enter class duration in (mins) Eg:160"
                        class="form-control">
                    </div>
                    <br>

                    <div class="col-md-12" id="size" style="display:none">
                      <label for="">{{ __('adminstaticword.Size') }}:</label>
                      <input type="text" name="size" placeholder="Enter Your Size" class="form-control">
                    </div>
                  </div>
                  <br>


                  <!-- preview video -->
                  <div class="row" style="display:none">
                    <div class="col-md-12" id="previewUrl">
                      <label for="exampleInputDetails">{{ __('adminstaticword.PreviewVideo') }}:</label>
                      <li class="tg-list-item">
                        <input name="preview_type" class="tgl tgl-skewed" id="previewvid" type="checkbox" />
                        <label class="tgl-btn" data-tg-off="URL" data-tg-on="Upload" for="previewvid"></label>
                      </li>
                      <input type="hidden" name="free" value="0" id="cxv">

                      <div id="document11">
                        <label for="exampleInputSlug">Preview {{ __('adminstaticword.UploadVideo') }}:</label>
                         <!-- =========== -->
                       <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="video" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                      </div>
                      <!-- =========== -->
                        <!-- <input type="file" name="video" id="video" value="" class="form-control"> -->
                      </div>
                      <div id="document22">
                        <label for="">Preview {{ __('adminstaticword.URL') }}: </label>
                        <input type="text" name="url" id="url" placeholder="Enter Your URL" class="form-control">
                      </div>
                    </div>
                  </div>
                  <br>
                  <!-- end preview video -->

                  <div class="row">
                    <div class="col-md-12">

                      <label for="exampleInputDetails">{{ __('adminstaticword.LearningMaterial') }}</label> - <p
                        class="inline info">eg: zip or pdf files</p>

                      

                        <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="file" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>

                      </div>


                    </div>
                  </div>

                  <br>


                  <div class="row">
                    <div class="col-md-4">
                      <label for="exampleInputDetails">{{ __('adminstaticword.Status') }}:</label><br>
                      <label class="switch">
                      <input class="slider" type="checkbox" name="status" checked />
                      <span class="knob"></span>
                    </label>
                    </div>
                    <div class="col-md-4">
                      <label for="exampleInputDetails">{{ __('adminstaticword.Featured') }}:</label><br>
                      <label class="switch">
                      <input class="slider" type="checkbox" name="featured" checked />
                      <span class="knob"></span>
                      </label>
                    </div>
                  </div>
                  <br>
                
                  <div id="subtitle" style="display:none">
                    <label>{{ __('adminstaticword.Subtitle') }}:</label>
                    <table class="table table-bordered" id="dynamic_field">
                      <tr>
                        <td>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                            </div>
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" name="sub_t[]" id="inputGroupFile01"
                                aria-describedby="inputGroupFileAddon01">
                              <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                          </div>

                        </td>

                        <td>
                          <input type="text" name="sub_lang[]" placeholder="Subtitle Language"
                            class="form-control name_list" />
                        </td>
                        <td><button type="button" name="add" id="add" class="btn btn-xs btn-success">
                            <i class="fa fa-plus"></i>
                          </button></td>
                      </tr>
                    </table>
                  </div>


                  @if($cor->drip_enable == 1)
                  <hr>

                  <div class="row">
                    <div class="col-md-6">
                      <label for="married_status">{{ __('Drip Content Type') }}: </label>
                      <select class="form-control js-example-basic-single" id="drip_type2" name="drip_type">
                        <option value="" selected hidden>
                          {{ __('Select an Option ') }}
                        </option>
                        <option value="date">{{ __('Specific Date') }}</option>
                        <option value="days">{{ __('Days After Enrollment') }}</option>
                      </select>
                      <br>
                    </div>

                    <div class="col-md-6" style="display: none;" id="dripdate2">
                      <label>{{ __('Specific Date') }} :</label>
                      <input type="date" id="" class="form-control" name="drip_date">
                      <small class="text-muted"><i class="fa fa-question-circle"></i>
                        {{ __('When section should be unlock') }}.</small>
                    </div>

                    <div class="col-md-6" style="display: none;" id="dripdays2">
                      <label>{{ __('Days After Enrollment') }} :</label>
                      <input type="number" min="1" class="form-control" value="{{ old('drip_days') }}" name="drip_days">
                      <small class="text-muted"><i class="fa fa-question-circle"></i> {{ __('Enter days') }}.</small>
                    </div>
                  </div>
                  <br>
                  @endif
  
                  <div class="form-group">
                    <button type="reset" class="btn btn-danger-rgba"><i class="fa fa-ban"></i> Reset</button>
                    <button type="submit" class="btn btn-primary-rgba"><i class="fa fa-check-circle"></i>
                      Create</button>
                  </div>

                  <div class="clear-both"></div>
              </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--Model close -->



  <!--youtube API Modal -->
  <div id="myyoutubeModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

      <!--youtube API Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h1 class="modal-title">Search From Youtube API</h1>
        </div>
        <div class="modal-body">
          @if(is_null(env('YOUTUBE_API_KEY')))
          <p>Make Sure You Have Added Youtube API Key in <a href="{{url('admin/api-settings')}}">API Settings</a></p>
          @endif

          <div id="hyv-page-container" style="clear:both;">
            <div class="hyv-content-alignment">
              <div id="hyv-page-content" class="" style="overflow:hidden;">
                <div class="container-4">
                  <form action="" method="post" name="hyv-yt-search" id="hyv-yt-search">
                    <input type="search" name="hyv-search" id="hyv-search" placeholder="Search..."
                      class="ui-autocomplete-input" autocomplete="off">
                    <button class="icon" id="hyv-searchBtn"></button>
                  </form>
                </div>
                <div>
                  <input type="hidden" id="pageToken" value="">
                  <div class="btn-group" role="group" aria-label="...">
                    <button type="button" id="pageTokenPrev" value="" class="btn btn-default">Prev</button>
                    <button type="button" id="pageTokenNext" value="" class="btn btn-default">Next</button>
                  </div>
                </div>
                <div id="hyv-watch-content" class="hyv-watch-main-col hyv-card hyv-card-has-padding">
                  <ul id="hyv-watch-related" class="hyv-video-list">
                  </ul>
                </div>

              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>


  <!--vimeo API Modal -->
  <div id="myvimeoModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

      <!--vimeo API Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h1 class="modal-title">Search From Vimeo API</h1>
        </div>
        <div class="modal-body">
          @if(is_null(env('VIMEO_ACCESS')))
          <p>Make Sure You Have Added Vimeo API Key in <a href="{{url('admin/api-settings')}}">API Settings</a></p>
          @endif

          <div id="vimeo-page-container" style="clear:both;">
            <div class="vimeo-content-alignment">
              <div id="vimeo-page-content" class="" style="overflow:hidden;">
                <div class="container-4">
                  <form action="" method="post" name="vimeo-yt-search" id="vimeo-yt-search">
                    <input type="search" name="vimeo-search" id="vimeo-search" placeholder="Search..."
                      class="ui-autocomplete-input" autocomplete="off">
                    <button class="icon" id="vimeo-searchBtn"></button>
                  </form>
                </div>
                <div>
                  <input type="hidden" id="vpageToken" value="">
                  <div class="btn-group" role="group" aria-label="...">
                    <button type="button" id="vpageTokenPrev" value="" class="btn btn-default">Prev</button>
                    <button type="button" id="vpageTokenNext" value="" class="btn btn-default">Next</button>
                  </div>
                </div>
                <div id="vimeo-watch-content" class="vimeo-watch-main-col vimeo-card vimeo-card-has-padding">
                  <ul id="vimeo-watch-related" class="vimeo-video-list">
                  </ul>
                </div>

              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- script to change status start -->
<script>
  function courceclassstatus(id){
    var status = $(this).prop('checked') == true ? 1 : 0; 
    
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{url('/course-class/status/')}}/" + id,
            data: {'status': status, 'id': id},
            success: function(data){
              console.log(id)
            }
        });
    };

    // to change featured status
    function courceclassfeatured(id){
    var featured = $(this).prop('checked') == true ? 1 : 0; 
    
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{url('/course-class/featured/')}}/" + id,
            data: {'featured': featured, 'id': id},
            success: function(data){
              console.log(id)
            }
        });
    };
 
</script>
<!-- script to change status end -->
@section('script')

<!--courseclass.js is included -->
<script type="text/javascript">
  $('#previewvid').on('change', function () {

    if ($('#previewvid').is(':checked')) {
      $('#document11').show('fast');
      $('#document22').hide('fast');
    } else {
      $('#document22').show('fast');
      $('#document11').hide('fast');
    }

  });
</script>

<script>
  $("#sortable").sortable({
    items: "tr",
    cursor: 'move',
    opacity: 0.6,
    update: function () {
      sendOrderToServer();
    }
  });

  function sendOrderToServer() {

    var order = [];
    var token = $('meta[name="csrf-token"]').attr('content');
    $('tr.row1').each(function (index, element) {
      order.push({
        id: $(this).attr('data-id'),
        position: index + 1
      });
    });

    $.ajax({
      type: "POST",
      dataType: "json",
      url: "{{ route('class-sort') }}",
      data: {
        order: order,
        _token: "{{ csrf_token() }}",
      },
      success: function (response) {
        if (response.status == "success") {
          console.log(response);
        } else {
          console.log(response);
        }
      }
    });
  }
</script>

<script>
    $("#checkboxAll").on('click', function () {
$('input.check').not(this).prop('checked', this.checked);
});
</script>


@endsection

@section('stylesheets')

<style type="text/css">
  .modal {
    overflow-y: auto;
  }


  body {
    background-color: #efefef;
  }

  .container-4 input#hyv-search {
    width: 500px;
    height: 30px;
    border: 1px solid #c6c6c6;
    font-size: 10pt;
    float: left;
    padding-left: 15px;
    -webkit-border-top-left-radius: 5px;
    -webkit-border-bottom-left-radius: 5px;
    -moz-border-top-left-radius: 5px;
    -moz-border-bottom-left-radius: 5px;
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
  }

  .container-4 input#vimeo-search {
    width: 500px;
    height: 30px;
    border: 1px solid #c6c6c6;
    font-size: 10pt;
    float: left;
    padding-left: 15px;
    -webkit-border-top-left-radius: 5px;
    -webkit-border-bottom-left-radius: 5px;
    -moz-border-top-left-radius: 5px;
    -moz-border-bottom-left-radius: 5px;
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
  }

  .container-4 button.icon {
    height: 34px;
    background: #F0F0EF url(../../images/icons/searchicon.png) 10px 1px no-repeat;
    background-size: 24px;
    -webkit-border-top-right-radius: 5px;
    -webkit-border-bottom-right-radius: 5px;
    -moz-border-radius-topright: 5px;
    -moz-border-radius-bottomright: 5px;
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
    border: 1px solid #c6c6c6;
    width: 50px;
    margin-left: -44px;
    color: #4f5b66;
    font-size: 10pt;
  }

  button#pageTokenNext {
    margin-left: 5px;
    border-radius: 3px;
    margin-bottom: 20px;
  }

  button#vpageTokenNext {
    margin-left: 5px;
    border-radius: 3px;
    margin-bottom: 20px;
  }
</style>



@endsection