@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Edit Reply: {{ $reply->discussion->title }}</div>

        <div class="panel-body">
            <form action="{{ route('reply.update', ['slug' => $reply->id]) }}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
					<label for="content">Answer a Question:</label>
					<textarea class="form-control" name="content" cols="5" rows="5" id="">{{ $reply->content }}</textarea>

                    @if($errors->has('content'))
                        <span class="help-block">{{ $errors->first('content') }}</span>
                    @endif
				</div>
				<div class="form-group" style="float:right;">
					<button class="btn btn-success">Update Reply</button>
				</div>
			</form>
        </div>
    </div>

@endsection
