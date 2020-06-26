@extends('layouts.app')

@section('styles')
    <link href="https://vjs.zencdn.net/7.8.3/video-js.css" rel="stylesheet" />
@endsection


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $video->title }}</div>

                    <div class="card-body">
                        <video
                            id="my-video"
                            class="video-js"
                            controls
                            preload="auto"
                            width="640"
                            height="264"
                            poster="{{ $video->thumbnail }}"
                            data-setup="{}"
                        >
                            <source src="{{ asset(Storage::url('videos/'.$video->id.'/'.$video->id.'.m3u8')) }}" type="application/x-mpegURL" />
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="https://vjs.zencdn.net/7.8.3/video.js"></script>
@endsection
