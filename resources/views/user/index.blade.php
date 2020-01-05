@extends('layouts.app')
@section('styles')
    <link type="text/css" rel="stylesheet" href="/css/global.css" />
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
@endsection
@section('content')
<div id="users">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <a href="/admin/users/create">Create</a></p>

                    <div id="tabs">
                        <ul class='tabs'>
                            <li><a href='#tabs-1'>Users (Active) ({{ $usersActive->count() }})</a></li>
                            <li><a href='#tabs-2'>Users (Inactive) ({{ $usersInactive->count() }})</a></li>
                        </ul>
                        <div id='tabs-1'>
                            <table class='myTable tablesorter'>
                                <thead>
                                <tr>
                                    <th class='no'>No.</th>
                                    <th class='name'>Name</th>
                                    <th class=''>View</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $x = 1; @endphp
                                @foreach($usersActive as $user)
                                    <tr>
                                        <td class='no'>{{ $x++ }}</td>
                                        <td class='name'>{{ $user->name }}</td>
                                        <td class=''><a href="/admin/users/{{ $user->uuid }}">View</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div id='tabs-2'>
                            <table class='myTable tablesorter'>
                                <thead>
                                    <tr>
                                        <th class='no'>No.</th>
                                        <th class='name'>Name</th>
                                        <th class=''>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $x = 1; @endphp
                                @foreach($usersInactive as $user)
                                    <tr>
                                        <td class='no'>{{ $x++ }}</td>
                                        <td class='name'>{{ $user->name }}</td>
                                        <td class=''><a href="/admin/users/{{ $user->id }}">View</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                   {{-- @foreach($users as $user)
                        <p>{{ $user->name }} @if($user->trashed()) (Inactive) @endif | </p>
                    @endforeach--}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    {{--<script src="{{ asset('js/users.js') }}"></script>--}}
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
    <script src="//cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#tabs").tabs();
            $("#users").addClass("active");
            $('.myTable').dataTable();
        });
    </script>
@endsection
