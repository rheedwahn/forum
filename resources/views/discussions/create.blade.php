@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Create a Discussion</div>

        <div class="panel-body">
            <form action="{{ route('discussions.store') }}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
					<label for="title">Discussion Title</label>
					<input type="text" value="{{ old('title') }}" name="title" placeholder="Title of the discussion" class="form-control"></input>

                    @if($errors->has('title'))
                        <span class="help-block">{{ $errors->first('title') }}</span>
                    @endif
				</div>
				<div class="{{ $errors->has('channel') ? ' has-error' : '' }}">
					<label for="title">Select a Channel:</label>
					<select class="form-control" name="channel">
						<option value="">Select a Channel</option>
						@foreach($channels as $channel)
							<option value="{{ $channel->id }}">{{ $channel->title }}</option>
						@endforeach
					</select>
                    @if($errors->has('channel'))
                        <span class="help-block">{{ $errors->first('channel') }}</span>
                    @endif
				</div>
				<div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
					<label for="content">Ask a Question</label>
					<textarea class="form-control" name="content" cols="5" rows="5" id="">{{ old('content') }}</textarea>

                    @if($errors->has('content'))
                        <span class="help-block">{{ $errors->first('content') }}</span>
                    @endif
				</div>
				<div class="form-group" style="float:right;">
					<button class="btn btn-success">Create Discussion</button>
				</div>
			</form>
			<a href="http://www.unexpected-vortices.com/sw/rippledoc/quick-markdown-example.html">Learn how to use markdown</a>
        </div>
    </div>

@endsection
