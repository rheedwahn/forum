@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">{{ $user->name }}'s Profile</div>

        <div class="panel-body">
            <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
					<label for="title">Name</label>
					<input type="text" value="{{ $user->name }}" name="name" placeholder="Your Full Name" class="form-control"></input>

                    @if($errors->has('name'))
                        <span class="help-block">{{ $errors->first('name') }}</span>
                    @endif
				</div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					<label for="title">Email Address</label>
					<input type="email" value="{{ $user->email }}" name="email" placeholder="Your email address" class="form-control"></input>

                    @if($errors->has('email'))
                        <span class="help-block">{{ $errors->first('email') }}</span>
                    @endif
				</div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					<label for="title"> Change Password</label>
					<input type="text"  name="password" placeholder="Enter a new password" class="form-control"></input>

                    @if($errors->has('password'))
                        <span class="help-block">{{ $errors->first('password') }}</span>
                    @endif
				</div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					<label for="title">Points</label>
					<input type="text" readonly  name="point" value={{ $user->points }} class="form-control"></input>
				</div>
                <div class="form-group{{ $errors->has('avater') ? ' has-error' : '' }}">
					<label for="title"> Change Profile Image</label>
					<input type="file"  name="avater" placeholder="Enter a new password" class="form-control"></input>

                    @if($errors->has('avater'))
                        <span class="help-block">{{ $errors->first('avater') }}</span>
                    @endif
				</div>
                
				<div class="form-group" style="float:right;">
					<button class="btn btn-success">Update Profile</button>
				</div>
			</form>
        </div>
    </div>

@endsection
