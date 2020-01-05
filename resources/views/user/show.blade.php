@extends('layouts.app')
@section('content')
    <div id="users">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <p>{{ $user->name }}</p>
                        <button class="btn btn-success col-md-2" value="Edit">
                            <a href="/admin/users/{{ $user->uuid }}/edit">Edit</a>
                        </button>
                        <br />
                        @if($user->id != \Auth::user()->id)
                            @if($user->trashed())
                                <button class="btn btn-success col-md-2" value="Make active">
                                    <a href="/admin/users/{{ $user->uuid }}/restore">Make active</a>
                                </button>
                            @else
                            <form action="/admin/users/{{ $user->uuid }}" method="POST">
                                {{ method_field('DELETE') }}
                                @csrf
                                <button type='submit' class="btn btn-danger col-md-2" value="Delete">Delete</button>
                            </form>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
