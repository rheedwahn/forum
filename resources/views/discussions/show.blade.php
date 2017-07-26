@extends('layouts.app')

@section('content')

    <div class="panel panel-default">

        <div class="panel-heading">
            <img src="{{ asset($d->user->avater) }}" width="40px" height="40px" alt="" /> &nbsp;&nbsp;
            <span>{{ $d->user->name }}, <b><i>{{ $d->created_at->diffForHumans() }}</i></b></span>
            @if(Auth::check())
                
                @if($d->best_answer)
                    <span class="btn btn pull-right btn-success btn-xs" style="margin-left:9px;">closed</span>
                @else
                    <span class="btn btn pull-right btn-danger btn-xs"style="margin-left:9px;">open</span>
                    @if(Auth::id() === $d->user->id)
                        <a class="btn btn pull-right btn-info btn-xs" href="{{ route('edit.discussion', ['slug' => $d->slug]) }}" style="margin-left:9px;">edit discussion</a>
                    @endif
                @endif

                @if($d->is_followed_by_auth_user())
                    <a href="{{ route('discussions.unfollow', ['id' => $d->id]) }}" class="btn btn-danger btn-xs pull-right" >  unfollow</a>
                @else
                    <a href="{{ route('discussions.follow', ['id' => $d->id]) }}" class="btn btn-success btn-xs pull-right" > + follow</a>
                @endif
            @endif
        </div>

        <div class="panel-body">
            <h4 class="text-center">
                <b>{{ $d->title }}</b><hr>
            </h4>
            <p class="text-center">
               {!! Markdown::convertToHtml($d->content) !!};
            </p>
        </div>

        @if($best_answer)
            <hr>
            <div class="text-center" style="padding:40px;">
                <h3>Best Answer</h3>
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <img src="{{ asset($best_answer->reply->user->avater) }}" width="40px" height="40px" alt="" /> &nbsp;&nbsp;
                        <span>{{ $best_answer->reply->user->name }} <b></b></span>
                    </div>

                    <div class="panel-body">
                        <h4>
                            <b>{{ $best_answer->reply->title }}</b><hr>
                        </h4>
                        <p>
                            {!! Markdown::convertToHtml($best_answer->reply->content) !!}
                        </p>
                    </div>
                </div>
            </div>

        @endif

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

    <div class="row">
        <div class="col-lg-11 col-lg-offset-1">
            <h4><b>All Replies</b></h4><hr>

                @foreach($d->replies as $r)
                    <div class="panel panel-default">

                        <div class="panel-heading">
                            <img src="{{ asset($r->user->avater) }}" width="40px" height="40px" alt="" /> &nbsp;&nbsp;
                            <span>{{ $r->user->name }}, <b><i>{{ $r->created_at->diffForHumans() }}</i></b></span>
                            @if(empty($best_answer))
                            @if(!$best_answer)
                                @if(Auth::user()->id === $r->user->id)
                                    <a href="{{ route('reply.edit', ['id' => $r->id]) }}" class="btn btn-primary btn-xs pull-right" style="margin-left: 9px;"> Edit Reply</a>
                                @endif
                                @if(Auth::user()->id === $d->user_id)
                                    <a href="{{ route('reply.bestanswer', ['id' => $r->id]) }}" class="btn btn-info btn-xs pull-right" > Mark as best answer</a>  
                                @endif
                            @endif
                            @endif
                        </div>

                        <div class="panel-body">
                            <p class="text-center">
                                {!! Markdown::convertToHtml($r->content) !!}
                            </p>
                        </div>

                        <div class="panel-footer">
                            @if(Auth::check())
                                @if($r->is_liked_by_auth_user())
                                    <a href="{{ route('unlike', ['id' => $r->id]) }}" class="btn btn-danger btn-xs" >Unlike</a> 
                                    &nbsp;&nbsp;&nbsp;      
                                                            @if($r->likes()->count() > 0) 
                                                                liked by {{ $r->likes()->count() }}  
                                                                @if($r->likes()->count() === 1) 
                                                                    person 
                                                                @else 
                                                                    people 
                                                                @endif 
                                                            @endif
                                @else
                                    <a href="{{ route('like', ['id' => $r->id]) }}" class="btn btn-success btn-xs" >Like</a>
                                    &nbsp;&nbsp;&nbsp;      
                                                            @if($r->likes()->count() > 0) 
                                                                liked by {{ $r->likes()->count() }}  
                                                                @if($r->likes()->count() === 1) 
                                                                    person 
                                                                @else 
                                                                    people 
                                                                @endif 
                                                            @endif
                                @endif
                            @else
                                @if($r->likes()->count() > 0) 
                                    liked by {{ $r->likes()->count() }}  
                                    @if($r->likes()->count() === 1) 
                                        person 
                                    @else 
                                        people 
                                    @endif 
                                @else
                                    0 like
                                @endif
                            @endif
                        </div>

                    </div>

                @endforeach
                @if(Auth::check())
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form method="post" action="{{ route('submit.reply', ['id' => $d->id]) }}" >
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('reply') ? ' has-error' : '' }}">
                                <label for="reply">Leave a reply...</label>

                                <textarea name="reply" id="" cols="30" rows="10" class="form-control"></textarea>

                                @if($errors->has('reply'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reply') }}</strong>
                                    </span>
                                @endif

                            </div>

                            <div class="form-group">
                                <button class="btn btn-default pull-right" type="submit">Reply</button>
                            </div>

                        </form>
                    </div>
                </div>
                @else
                    <h4 class="text-center">
                        Please login to leave a reply
                    </h4>
                @endif
        </div>
    </div>



@endsection