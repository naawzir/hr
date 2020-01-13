@extends('layouts.app')
@section('content')
<div id="users">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('View User') }}</div>

                    <div class="card-body">

                            <div class="row">
                                <label for="title" class="col-md-4 text-md-right">{{ __('Title') }}</label>
                                <div class="col-md-6">
                                    {{$user->title}}
                                </div>
                            </div>

                            <div class="row">
                                <label for="firstname" class="col-md-4 text-md-right">{{ __('Firstname') }}</label>
                                <div class="col-md-6">
                                    {{$user->firstname}}
                                </div>
                            </div>

                            <div class="row">
                                <label for="middlename" class="col-md-4 text-md-right">{{ __('Middlename') }}</label>
                                <div class="col-md-6">
                                    {{$user->middlename}}
                                </div>
                            </div>

                            <div class="row">
                                <label for="lastname" class="col-md-4 text-md-right">{{ __('Lastname') }}</label>
                                <div class="col-md-6">
                                    {{$user->lastname}}
                                </div>
                            </div>

                            <div class="row">
                                <label for="email" class="col-md-4 text-md-right">{{ __('Email') }}</label>
                                <div class="col-md-6">
                                    {{$user->email}}
                                </div>
                            </div>

                            <div class="row">
                                <label for="job_title" class="col-md-4 text-md-right">{{ __('Job Title') }}</label>
                                <div class="col-md-6">
                                    {{$user->job_title}}
                                </div>
                            </div>

                            <div class="row">
                                <label for="gender" class="col-md-4 text-md-right">{{ __('Gender') }}</label>
                                <div class="col-md-6">
                                    {{$user->gender}}
                                </div>
                            </div>

                            <div class="row">
                                <label for="dob" class="col-md-4 text-md-right">{{ __('DOB') }}</label>
                                <div class="col-md-6">
                                    @php $dob = date('Y-m-d', strtotime($user->dob)); @endphp
                                    {{ old('dob', $dob) }}
                                </div>
                            </div>

                            <div class="row">
                                <label for="holiday_entitlement" class="col-md-4 text-md-right">{{ __('Holiday Entitlement') }}</label>
                                <div class="col-md-6">
                                    {{$user->holiday_entitlement}}
                                </div>
                            </div>

                            <div class="row">
                                <label for="hours_per_week" class="col-md-4 text-md-right">{{ __('Hours per week') }}</label>
                                <div class="col-md-6">
                                    {{$user->hours_per_week}}
                                </div>
                            </div>

                            <div class="row">
                                <label for="photo" class="col-md-4 text-md-right">{{ __('Photo') }}</label>
                                <div class="col-md-6">
                                    <img class="col-sm-6" id="preview" src="{{ asset('images') . '/' . $user->photo }}">
                                </div>
                            </div>
                        <br />
                        <div class="row">
                            <a class="col-md-4" href="/admin/users/{{ $user->uuid }}/edit">
                                <button class="btn btn-success col-md-12">Edit</button>
                            </a>
                            <br />
                            @if($user->id != \Auth::user()->id)
                                <br />
                                @if($user->trashed())
                                    <a class="col-md-4" href="/admin/users/{{ $user->uuid }}/restore">
                                        <button class="btn btn-success col-md-12">Make active</button>
                                    </a>
                                @else
                                    <form class="col-md-6" style="display:inline-block;" action="/admin/users/{{ $user->uuid }}" method="POST">
                                        {{ method_field('DELETE') }}
                                        @csrf
                                        <a class="col-md-12" href="#">
                                            <button class="btn btn-danger col-md-8">Delete</button>
                                        </a>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{ asset('js/users.js') }}"></script>
@endsection
