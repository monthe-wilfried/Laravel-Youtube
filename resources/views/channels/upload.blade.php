@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <channel-uploads :channel="{{ $channel }}"></channel-uploads>

            </div>
        </div>
    </div>
@endsection
