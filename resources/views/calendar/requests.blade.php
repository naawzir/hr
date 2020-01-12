@extends('layouts.app')
@section('styles')
    <link type="text/css" rel="stylesheet" href="/css/global.css" />
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
@endsection
@section('content')
    <div class="container">

<div id="requests">
    <div id="userId" style="display:none;">{{ \Auth::user()->uuid }}</div>
    <div id="content_wrapper" style="margin:0 auto;">
        <div style="margin:0 auto;">
            <div id="content_title">
                <h1>Requests</h1>
                <p> @{{ acceptedRequests }}</p>
            </div><!--end of content_title-->

                <div id="tabs">
                    <ul class='tabs'>
                        <li><a href='#tabs-1' @click="showTable()">Requests pending (sent) ({{ $holidaysPending->count() }}</a></li>
                        <li><a href='#tabs-2' @click="showTable()">Requests accepted ({{ $holidaysAccepted->count() }})</a></li>
                        <li><a href='#tabs-3' @click="showTable()">Requests declined ({{ $holidaysDeclined->count() }})</a></li>
                    </ul>
                    <div id='tabs-1'><!-- pending -->
                        <table class='myTable tablesorter'>
                            <thead>
                                <tr>
                                    <th style='width: 5%; position: relative;'>
                                        <input type='checkbox' v-if="pendingRequests" v-model="allPending" @click="selectAllPending()" />
                                    </th>
                                    <th class='no'>No</th>
                                    <th class='name'>Name</th>
                                    <th class='job_title'>Date Sent</th>
                                    <th class='department'>Holiday Date</th>
                                    <th class='booked'>Full/Half Day</th>
                                    <th>Accept / Decline</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php
                                $x = 1;
                                $date_booked = date('z') + 1;
                            @endphp

                            @foreach($holidaysPending as $hol)
                                @php
                                    if ($hol->booked == 'Request sent') {
                                        $booked = 'Full day';
                                    } else {
                                        $booked = 'Half a day';
                                    }
                                @endphp
                                <tr>
                                    <td class='checkbox-custom checkbox-primary mb5'>
                                        <input type='checkbox' v-model="pending" value='{{ $hol->holiday_id }}' />
                                    </td>
                                    <td class='no'>{{ $x++ }}</td>
                                    <td class='name'>{{ $hol->user->name }}</td>
                                    <td class='Job Title hide_divs'>{{ $hol->request_date }}</td>
                                    <td class='lastcontact hide_divs'>{{ $hol->requested_date }}</td>
                                    <td class='booked hide_divs'>{{ $booked }}</td>
                                    <td>
                                        @if($hol->id >= $date_booked)
                                            <button @click="acceptHolidayRequest({{ $hol->holiday_id }})" title='Accept request'>Accept</button>
                                            <button @click="declineHolidayRequest({{ $hol->holiday_id }})" title='Decline request'>Decline</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div id='tabs-2'><!-- accepted -->
                        <table class='myTable tablesorter'>
                            <thead>
                                <tr>
                                    <th style='width: 5%; position: relative;'>
                                        <input type='checkbox' v-if="acceptedRequests" id='selectAllAccepted' v-model="allAccepted" @click="selectAllAccepted()" />
                                    </th>
                                    <th class='no'>No</th>
                                    <th class='name'>Name</th>
                                    <th class='job_title'>Date Sent</th>
                                    <th class='department'>Holiday Date</th>
                                    <th class='booked'>Full/Half Day</th>
                                    <th class='decline'>Decline</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php $x = 1; @endphp
                            @foreach($holidaysAccepted as $hol)
                                @php
                                    if ($hol->booked == 'Request sent') {
                                        $booked = 'Full day';
                                    } else {
                                        $booked = 'Half a day';
                                    }
                                @endphp
                                <tr>
                                    <td class='checkbox-custom checkbox-primary mb5'>
                                        <input type='checkbox' v-model="accepted" value='{{ $hol->holiday_id }}' />
                                    </td>
                                    <td class='no'>{{ $x++ }}</td>
                                    <td class='name'>{{ $hol->user->name }}</td>
                                    <td class='Job Title hide_divs'>{{ $hol->request_date }}</td>
                                    <td class='lastcontact hide_divs'>{{ $hol->requested_date }}</td>
                                    <td class='booked hide_divs'>{{ $booked }}</td>
                                    <td>
                                        @if($hol->id >= $date_booked)
                                            <button @click="declineHolidayRequest({{ $hol->holiday_id }})" title='Decline request'>Decline</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div id='tabs-3'><!-- declined -->
                        <table class='myTable tablesorter'>
                            <thead>
                                <tr>
                                    <th style='width: 5%; position: relative;'>
                                        <input type='checkbox' v-if="declinedRequests" v-model="allDeclined" @click="selectAllDeclined()"  />
                                    </th>
                                    <th class='no'>No</th>
                                    <th class='name'>Name</th>
                                    <th class='job_title'>Date Sent</th>
                                    <th class='department'>Holiday Date</th>
                                    <th class='booked'>Full/Half Day</th>
                                    <th class='decline'>Decline</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php $x = 1; @endphp
                            @foreach($holidaysDeclined as $hol)
                                @php
                                    if ($hol->booked == 'Request sent') {
                                        $booked = 'Full day';
                                    } else {
                                        $booked = 'Half a day';
                                    }
                                @endphp
                                <tr>
                                    <td class='checkbox-custom checkbox-primary mb5'>
                                        <input type='checkbox' v-model="declined" value='{{ $hol->holiday_id }}' />
                                    </td>
                                    <td class='no'>{{ $x++ }}</td>
                                    <td class='name'>{{ $hol->user->name }}</td>
                                    <td class='Job Title hide_divs'>{{ $hol->request_date }}</td>
                                    <td class='lastcontact hide_divs'>{{ $hol->requested_date }}</td>
                                    <td class='booked hide_divs'>{{ $booked }}</td>
                                    <td>
                                        @if($hol->id >= $date_booked)
                                            <button @click="acceptHolidayRequest({{ $hol->holiday_id }})" title='Accept request'>Accept</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <button v-if="acceptButton" class="request_button" @click="acceptHolidayRequests()">Accept</button>
                <button v-if="declineButton" class="request_button" @click="declineHolidayRequests()">Decline</button>
            <div class='clear'></div>
        </div><!--end of content-->
    </div><!--end of content_wrapper-->
</div>
</div>
@endsection

@section('scripts')
<!--JavaScript-->
<script src="/js/requests.js"></script>
{{--<script src="/js/jquery.min.js"></script>--}}
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
{{--<script src="/js/axios.min.js"></script>--}}
<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
<script src="//cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $("#tabs").tabs();
        $("#requests").addClass("active");
        $('.myTable').dataTable();
    });
</script>
@endsection
