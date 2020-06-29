@extends('layouts.app')

@section('styles')
    <link href="https://vjs.zencdn.net/7.8.3/video-js.css" rel="stylesheet" />
@endsection


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @if($video->editable())
                        <form action="{{ route('videos.update', $video->id) }}" method="post">
                            @csrf
                            @method('put')
                    @endif
                        <div class="card-header">{{ $video->title }}</div>

                        <div class="card-body">
                            <video
                                id="video"
                                class="video-js"
                                controls
                                preload="auto"
                                width="640"
                                height="264"
                                poster="{{ $video->thumbnail }}"
                                data-setup="{}"
                                style="width: 100%"
                            >
                                <source src="{{ asset(Storage::url('videos/'.$video->id.'/'.$video->id.'.m3u8')) }}" type="application/x-mpegURL" />
                            </video>

                            <div class="mt-3 d-flex justify-content-between">
                                <div>
                                    @if($video->editable())
                                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ $video->title }}">
                                        @error('title')
                                            <span class="invalid-feedback alert">{{ $errors->first('title') }}</span>
                                        @enderror
                                    @else
                                       <h4>{{ $video->title }} </h4>
                                    @endif
                                    <p>{{ $video->views }} {{ Str::plural('view', $video->views) }}</p>
                                </div>

                                <vote-component :default_votes="{{ $video->votes }}" entity_id="{{ $video->id }}" entity_owner="{{ $video->channel->user_id }}"></vote-component> <!-- no : symbol to entity_owner because it comes as a string -->

                            </div>

                            @if($video->editable())
                                <hr>
                                <div>
                                    <textarea placeholder="Enter video description here..." name="description" class="form-control @error('description') is-invalid @enderror">{{ $video->description }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback alert">{{ $errors->first('description') }}</span>
                                    @enderror
                                    <div class="text-right mt-3">
                                        <button type="submit" class="btn btn-primary btn-sm">Update Video Details</button>
                                    </div>

                                </div>
                            @else
                                <p>{{ $video->description }}</p>
                            @endif

                            <hr>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div class="media">
                                    <img class="rounded-circle mr-3" src="{{ $video->channel->image() ? $video->channel->image() : 'https://picsum.photos/id/42/200/200' }}" width="50" height="50">
                                    <div class="media-body ml-2">
                                        <h5 class="mt-0 mb-0">
                                            {{ $video->channel->name }}
                                        </h5>
                                        <span class="small">Published on {{ $video->created_at->toFormattedDateString() }}</span>
                                    </div>
                                </div>

                                <subscribe-button :channel="{{ $video->channel }}" :initial-subscriptions="{{ $video->channel->subscriptions }}"></subscribe-button>
                            </div>

                        </div>

                    @if($video->editable())
                    </form>
                    @endif
                </div>

                <div class="card mt-5 p-5">
                    <comment-component :video="{{ $video }}"></comment-component>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="https://vjs.zencdn.net/7.8.3/video.js"></script>

    <style>
        .vjs-default-skin {
            width: 100%;
        }
        .thumbs-up, .thumbs-down {
            width: 20px;
            height: 20px;
            cursor: pointer;
            fill: currentColor;
        }

        .thumbs-down-active, .thumbs-up-active {
            color: #3EA6FF;
        }

        .thumbs-down {
            margin-left: 1rem;
        }
    </style>

    <style>
        .w-full {
            width: 100% !important;
        }
        .w-80 {
            width: 80% !important;
        }
    </style>

    <script>
        window.CURRENT_VIDEO = '{{ $video->id }}'
    </script>
    <script defer src="{{ asset('js/player.js') }}"></script>
@endsection
