@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Create a Channel
        <a href="{{ route('channels.index') }}" class="btn btn-default btn-xs pull-right">All Channels</a>
        </div>
        <div class="panel-body">
            <form method="post" action="{{ route('channels.store') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title">Channel Name</label>
                    <input type="text" name="title" placeholder="Name of the Channel" class="form-control"></input>

                    @if($errors->has('title'))
                        <span class="help-block">{{ $errors->first('title') }}</span>
                    @endif
                </div>
                
                <div class="form-group">
                    <button class="btn btn-success">Store Channel</button>
                </div>
            </form>
        </div>
    </div>

@endsection
