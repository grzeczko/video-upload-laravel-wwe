<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>WWE Video Upload</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    <img src="{{ asset('images/logo.jpg') }}" /> Video Upload
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                      <img src="{{ asset('images/stunner.gif') }}" />
                      {{session('success')}}
                    </div>

                    <div class="metadata">
                      <b>(optional)</b> Add metadata for video <em>{{session('title')}}</em>
                      <br /><br />
                      <div class="form">
                        {{ Form::open(array('url' => 'metadata', 'method' => 'post')) }}
                          {{ Form::token() }}

                          {{ Form::label('keywords', 'Keywords (comma separated)') }}<br />
                          {!! Form::text('keywords') !!}<br /><br />

                          {{ Form::label('location', 'Location') }}<br />
                          {!! Form::text('location') !!}<br /><br />

                          {{ Form::submit(' Add Metadata ',['class'=>'submit-btn']) }} {{ Form::button(' Skip ',['class'=>'skip-btn']) }}
                        {{ Form::close() }}
                      </div>
                    </div>
                @endif

                @if (count($errors) > 0)
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <br /><br />
                <div class="form">
                  {{ Form::open(array('url' => 'upload', 'method' => 'post', 'files' => true)) }}
                    {{ Form::token() }}

                    {{ Form::label('title', 'Video title') }}<br />
                    {!! Form::text('title') !!}<br /><br />

                    {{ Form::label('video', 'Video (MP4)') }}<br />
                    {!! Form::file('video', $attributes = array()) !!}<br /><br />

                    {{ Form::submit(' Upload ') }}
                  {{ Form::close() }}
                </div>

                <br /><br />

                @if (count($videos) > 0)
                  <div class="slider">
                    @foreach ($videos as $video)
                      <div>
                        <a href="" class="video-modal" data-location="{{$video->location}}" data-title="{{$video->title}}" data-toggle="modal" data-target="#videoModal">
                          <img src="{{$video->thumbnail}}" width="150" />
                          <p>{{$video->title}}</p>
                        </a>
                        <p>
                          Duration: {{$video->duration}}<br />
                          Filesize: {{$video->filesize}}<br />
                          Bitrate: {{$video->bitrate}}bps
                        </p>
                      </div>
                    @endforeach
                  </div>

                  <div class="arrows">
                    <span><a class="prev">&lt;&lt; PREVIOUS</a></span>
                    <span class="align-right"><a class="next">NEXT &gt;&gt;</a></span>
                  </div>
                @endif

            </div>
        </div>

        <!-- Video Modal -->
        <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="videoModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
