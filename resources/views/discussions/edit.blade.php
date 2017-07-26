@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Edit Discussion: {{ $discussion->title }}</div>

        <div class="panel-body">
            <form action="{{ route('discussion.update', ['slug' => $discussion->slug]) }}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
					<label for="title">Discussion Title</label>
					<input type="text" value="{{ $discussion->title }}" name="title" placeholder="Title of the discussion" class="form-control"></input>

                    @if($errors->has('title'))
                        <span class="help-block">{{ $errors->first('title') }}</span>
                    @endif
				</div>
				<div class="{{ $errors->has('channel') ? ' has-error' : '' }}">
					<label for="title">Select a Channel:</label>
					<select class="form-control" name="channel">
						<option value="">Select a Channel</option>
						@foreach($channels as $channel)
							<option value="{{ $channel->id }}"
                                @if($discussion->channel->id === $channel->id)
                                    selected
                                @endif
                            >{{ $channel->title }}</option>
						@endforeach
					</select>
                    @if($errors->has('channel'))
                        <span class="help-block">{{ $errors->first('channel') }}</span>
                    @endif
				</div>
				<div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
					<label for="content">Ask a Question</label>
					<textarea class="form-control" name="content" cols="5" rows="5" id="">{{ $discussion->content }}</textarea>

                    @if($errors->has('content'))
                        <span class="help-block">{{ $errors->first('content') }}</span>
                    @endif
				</div>
				<div class="form-group" style="float:right;">
					<button class="btn btn-success">Update Discussion</button>
				</div>
			</form>
        </div>
    </div>

@endsection
