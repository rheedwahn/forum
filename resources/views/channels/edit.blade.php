@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Edit Channel: {{ $channel->title }}</div>
        <div class="panel-body">
            <form method="post" action="{{ route('channels.update', ['channel' => $channel->slug]) }}">
                {{ csrf_field() }}

                {{ method_field('PUT') }}

                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title">Channel Name</label>
                    <input type="text" name="title" value="{{ $channel->title }}" class="form-control"></input>

                    @if($errors->has('title'))
                        <span class="help-block">{{ $errors->first('title') }}</span>
                    @endif
                </div>
                
                <div class="form-group">
                    <button class="btn btn-success">Update Channel</button>
                </div>
            </form>
        </div>
    </div>

@endsection
