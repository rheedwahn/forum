@extends('layouts.app')

@section('content')

    @foreach($discussion as $d)

        <div class="panel panel-default">
            <div class="panel-heading">
                <img src="{{ asset($d->user->avater) }}" width="40px" height="40px" alt="" /> &nbsp;&nbsp;
                <span>{{ $d->user->name }}, <b><i>{{ $d->created_at->diffForHumans() }}</i></b></span>

                @if($d->best_answer)
                    <span class="btn btn pull-right btn-success btn-xs">closed</span>
                @else
                    <span class="btn btn pull-right btn-danger btn-xs">open</span>
                @endif
                <a href="{{ route('discussions.show', ['slug' => $d->slug]) }}" class="btn btn-default btn-xs pull-right" style="margin-right: 9px;" >View</a>
            </div>

            <div class="panel-body">
                <h4 class="text-center">
                    <b>{{ $d->title }}</b>
                </h4>
                <p class="text-center">
                    {!! Markdown::convertToHtml(str_limit($d->content, 100)) !!}
                </p>
            </div>

            <div class="panel-footer">
                <span>
                    {{ $d->replies->count() }} 
                        @if($d->replies->count() === 1) 
                            Reply
                        @else
                            replies
                        @endif
                </span>
                <a href="{{ route('channel', ['slug' => $d->channel->slug]) }}" class="btn btn-default btn-xs pull-right">{{ $d->channel->title }}</a>
            </div>
        </div>

    @endforeach

    <div class="text-center">
        {{ $discussion->links() }}
    </div>

@endsection
