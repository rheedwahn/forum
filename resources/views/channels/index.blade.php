@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Channels
        <a href="{{ route('channels.create') }}" class="btn btn-default btn-xs pull-right">Add Channels</a>
        </div>
        <div class="panel-body">
            @if($channels->count() === 0)
                <p><h1 class="text-center">You have no Channels</h1></p><br>
                <p class="text-center"><a href="{{ route('channels.create') }}">Please click to create one</a></p>
            @else
                <div class="table-responsive">          
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>
                                S/N
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Edit
                                </th>
                                <th>
                                    Delete
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($channels as $channel)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $channel->title }}</td>
                                    <td>
                                        <a href="{{ route('channels.edit', ['channel' => $channel->slug]) }}" class="btn btn-primary btn-sm">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('channels.destroy', ['channel' => $channel->slug]) }}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>   
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

@endsection
