@extends('layouts.app')

@section('content')
    @if($discussion->count() === 0)
        <h4 class="text-center" >No post for this channel</h4>
    @else

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
                        {{ str_limit($d->content, 100) }}
                    </p>
                </div>

                <div class="panel-footer">
                    <p>
                        {{ $d->replies->count() }} 
                            @if($d->replies->count() === 1) 
                                Reply
                            @else
                                replies
                            @endif
                    </p>
                </div>
            </div>

        @endforeach

    @endif

    <div class="text-center">
        {{ $discussion->links() }}
    </div>

@endsection
