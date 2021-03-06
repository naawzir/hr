@extends('layouts.app')
@section('content')
<div id="users">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Create User') }}</div>

                    <div class="card-body">
                        <form method="POST" action="/admin/users" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                                <div class="col-md-6">
                                    <select id="title" name="title">
                                        <option value="">Please select</option>
                                        <option @if(old('title') == 'Mr') selected @endif value="{{ old('title', 'Mr') }}">Mr</option>
                                        <option @if(old('title') == 'Mrs') selected @endif value="{{ old('title', 'Mrs') }}">Mrs</option>
                                        <option @if(old('title') == 'Ms') selected @endif value="{{ old('title', 'Ms') }}">Ms</option>
                                        <option @if(old('title') == 'Miss') selected @endif value="{{ old('title', 'Miss') }}">Miss</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('Firstname *') }}</label>
                                <div class="col-md-6">
                                    <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname">
                                    @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="middlename" class="col-md-4 col-form-label text-md-right">{{ __('Middlename') }}</label>
                                <div class="col-md-6">
                                    <input id="middlename" type="text" class="form-control @error('middlename') is-invalid @enderror" name="middlename" value="{{ old('middlename') }}" autocomplete="middlename">
                                    @error('middlename')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Lastname *') }}</label>
                                <div class="col-md-6">
                                    <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname">
                                    @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email *') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="job_title" class="col-md-4 col-form-label text-md-right">{{ __('Job Title') }}</label>
                                <div class="col-md-6">
                                    <input id="job_title" type="text" class="form-control @error('job_title') is-invalid @enderror" name="job_title" value="{{ old('job_title') }}" autocomplete="job_title">
                                    @error('job_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
                                <div class="col-md-6">
                                    <select id="gender" name="gender">
                                        <option value="">Please select</option>
                                        <option @if(old('gender') == 'male') selected @endif value="{{ old('gender', 'male') }}">Male</option>
                                        <option @if(old('gender') == 'female') selected @endif value="{{ old('gender', 'female') }}">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('DOB') }}</label>
                                <div class="col-md-6">
                                    <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}" autocomplete="dob">
                                    @error('dob')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="holiday_entitlement" class="col-md-4 col-form-label text-md-right">{{ __('Holiday Entitlement') }}</label>
                                <div class="col-md-6">
                                    <input id="holiday_entitlement" type="text" class="form-control @error('holiday_entitlement') is-invalid @enderror" name="holiday_entitlement" value="{{ old('holiday_entitlement') }}" autocomplete="holiday_entitlement">
                                    @error('holiday_entitlement')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="book_past_holidays" class="col-md-4 col-form-label text-md-right">{{ __('Book holidays in the past') }}</label>
                                <div class="col-md-6">
                                    <select id="book_past_holidays" name="book_past_holidays">
                                        <option @if(old('book_past_holidays') === 0) selected @endif value="{{ old('book_past_holidays', '0') }}">No</option>
                                        <option @if(old('book_past_holidays') === 1) selected @endif value="{{ old('book_past_holidays', '1') }}">Yes</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="hours_per_week" class="col-md-4 col-form-label text-md-right">{{ __('Hours per week') }}</label>
                                <div class="col-md-6">
                                    <input id="hours_per_week" type="text" class="form-control @error('hours_per_week') is-invalid @enderror" name="hours_per_week" value="{{ old('hours_per_week') }}" autocomplete="hours_per_week">
                                    @error('hours_per_week')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="photo" class="col-md-4 col-form-label text-md-right">{{ __('Photo') }}</label>
                                <div class="col-md-6">
                                    <input data-preview="#preview" name="photo" type="file" id="photo">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </div>
                        </form>
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

