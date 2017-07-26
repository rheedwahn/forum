@extends('layouts.app')
@section('content')

    <p></br></p> 
    <p></br></p>
    <div class="row equal-height-panels">
        @foreach($user as $users)
            <div class="col-md-6 text-center">
                <div class="panel panel-success">
                    <div class="panel-heading">
                    <img src="{{ asset($users->avater) }}" width="40px" height="40px" alt="" /> &nbsp;&nbsp;
                    <span>{{ $users->name }}</span>
                    </div>
                    <div class="panel-body">
                        @foreach($best_answer as $b)
                            @if($users->id === $b->replier_id)
                                <b>{{ count($b->replier_id) }}</b> Best Answer Award(s)</br>
                            @endif
                        @endforeach
                        <b>{{ $users->points }}</b> Experience
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="text-center">
        {{ $user->links() }}
    </div>
@endsection
