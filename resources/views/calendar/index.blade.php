@extends('layouts.app')
@section('styles')
    <link type="text/css" rel="stylesheet" href="/css/global.css" />
    <link type="text/css" rel="stylesheet" href="/css/holidays.css" />
    <link type="text/css" rel="stylesheet" href="/css/modal.css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
@endsection
@section('content')
<div class="">
    <div id="myCalendar">
        <div id="calendar_wrapper" style="margin:0 auto;">
            <div id="userId" style="display:none;">{{ \Auth::user()->uuid }}</div>
            <div id="cal" style="margin:0 auto;">
                <div style="text-align:center;">
                    <span id='hol_entitlement' style='display:none;'>{{ $user->holiday_entitlement }}</span>
                    <span>Available:</span> <span id='requests_booked'></span> <span style="margin-right:40px;font-size:12px;">({{ $user->holiday_entitlement }})</span>
                    <span>Requested:</span> <span style="margin-right:40px;" id='counter_requested'></span>
                    {{--<span>Requested:</span> <span style="margin-right:40px;">@{{ requestedCalculation }}</span>--}}
                    <span>Booked:</span> <span id='counter_booked'></span>
                    {{--<span>Booked:</span> <span>@{{ bookedCalculation }}</span>--}}
                </div>
                <div id="keys_container" style="text-align:center;">
                    <span class='weekday key'>Available</span>
                    <span class='unavailable key'>Unavailable</span>
                    <span class='declined key'>Declined</span>
                    <span class='bank_holiday key'>Bank Holiday</span>
                    <span class='pastday key'>Past Day</span>
                    <span class='request key'>Day Request</span>
                    <span class='request_sent key'>Day Request Sent</span>
                    <span class='booked key'>Day Booked</span>
                    <span class='halfrequest key'>Half Day Request</span>
                    <span class='halfrequest_sent key'>Half Day Request Sent</span>
                    <span class='halfbooked key'>Half Day Booked</span>
                    <button style="display:none;" @click="submitHolidayRequests()"{{--v-if="submitRequestsButtonShow" --}} class='request_button'>Submit</button>
                </div>
            </div>
        </div>

        <div id="content_wrapper" style="margin:0 auto;">
            <div id="content" style="margin:0 auto;">
                <div id="content_title">
                    <h1>My Holiday Calendar</h1>
                    <?php $date_booked = date('z') + 1; ?>
                </div><!--end of content_title-->
                <div id="calendar_ajax" style="display:none;"><img style="display:block;margin:0 auto;" src="/images/please_wait.gif" /></div>

                <!-- The Modal -->
                <div id="myModal" class="modal">
                    <!-- Modal content -->
                    <div class="modal-content">
                        <span class="close">x</span>
                        <!--
                        <button id="first_half" class="day_period">First Half</button>
                        <button id="last_half" class="day_period">Last Half</button>
                        -->
                        <p id="halfrequests"></p>
                    </div>
                </div>

                @if($user->holiday_entitlement == 0)
                    <p style="text-align:center;">You have not been allocated any holiday entitlement. Please contact HR.</p>
                @else
                    <div id='calendar'>
                        <div id='months'>
                            <ul class='months_list'>
                                @foreach($months as $month)
                                    <li>{{$month}}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div id='dates'>
                            @for($x = 1; $x <= 31; $x++)<div class='date'>{{$x}}</div>@endfor
                        </div>

                        <div class='day_container'>
                        @php $date_booked = date('z') @endphp
                        @foreach ($months as $month)
                            <div class='monthly_container'>
                                @foreach ($days as $day)
                                    @if ($day->month == $month)
                                        @php $day->day = day($day->day) @endphp
                                        @if (!$day->holidaysForUser->isEmpty())
                                            @if ($day->holidaysForUser[0]->booked == 'Request sent' && $day->holidaysForUser[0]->stage == 'Accepted')
                                                <span class='booked' id='{{ $day->id }}'><label>{{ $day->day }}</label></span>
                                            @elseif ($day->holidaysForUser[0]->booked == 'Request sent' && $day->holidaysForUser[0]->stage == 'Declined')
                                                @if ($day->id <= $date_booked)
                                                    <span id='{{ $day->id }}' class='pastday'><label>{{ $day->day }}</label></span>
                                                @else
                                                    <span class="declined" id='{{ $day->id }}'><label>{{ $day->day }}</label></span>
                                                @endif
                                            @elseif ($day->holidaysForUser[0]->booked == 'Half Request sent' && $day->holidaysForUser[0]->stage == 'Accepted')
                                                <span class='halfbooked' id='{{ $day->id }}'><label>{{ $day->day }}</label></span>
                                            @elseif ($day->holidaysForUser[0]->booked == 'Half Request sent' && $day->holidaysForUser[0]->stage == 'Declined')
                                                @if ($day->id <= $date_booked)
                                                    <span id='{{ $day->id }}' class='pastday'><label>{{ $day->day }}</label></span>
                                                @else
                                                    <span class="declined" id='{{ $day->id }}'><label>{{ $day->day }}</label></span>
                                                @endif
                                            @elseif ($day->holidaysForUser[0]->booked == 'Request' && $day->holidaysForUser[0]->stage == '')
                                                @if ($day->id <= $date_booked)
                                                    <span id='{{ $day->id }}' class='pastday'><label>{{ $day->day }}</label></span>
                                                @else
                                                    <span class='request' id='{{ $day->id }}'><label>{{ $day->day }}</label></span>
                                                @endif
                                            @elseif ($day->holidaysForUser[0]->booked == 'Half Request' && $day->holidaysForUser[0]->stage == '')
                                                @if ($day->id <= $date_booked)
                                                    <span id='{{ $day->id }}' class='pastday'><label>{{ $day->day }}</label></span>
                                                @else
                                                    <span class='halfrequest' id='{{ $day->id }}'><label>{{ $day->day }}</label></span>
                                                @endif
                                            @elseif ($day->holidaysForUser[0]->booked == 'Request sent' && $day->holidaysForUser[0]->stage == '')
                                                @if ($day->id <= $date_booked)
                                                    <span id='{{ $day->id }}' class='pastday'><label>{{ $day->day }}</label></span>
                                                @else
                                                    <span class='request_sent' id='{{ $day->id }}'><label>{{ $day->day }}</label></span>
                                                @endif
                                            @elseif ($day->holidaysForUser[0]->booked == 'Half Request sent' && $day->holidaysForUser[0]->stage == '')
                                                @if ($day->id <= $date_booked)
                                                    <span id='{{ $day->id }}' class='pastday'><label>{{ $day->day }}</label></span>
                                                @else
                                                    <span class='halfrequest_sent' id='{{ $day->id }}'><label>{{ $day->day }}</label></span>
                                                @endif
                                            @elseif ($day->bank_holiday == 'Y')
                                                <span id='{{ $day->id }}' class='bank_holiday'><label>{{ $day->day }}</label></span>
                                            @elseif ($day->bank_holiday == 'Unavailable')
                                                echo("<span id='{{ $day->id }}' class='unavailable'><label>{{ $day->day }}</label></span>");
                                            @elseif ($day->id <= $date_booked)
                                                <span id='{{ $day->id }}' class='pastday'><label>{{ $day->day }}</label></span>
                                            @else
                                                <span id='{{ $day->id }}' class='weekday'><label>{{ $day->day }}</label></span>
                                            @endif
                                        @else
                                            @if ($day->bank_holiday == 'Y')
                                                <span id='{{ $day->id }}' class='bank_holiday'><label>{{ $day->day }}</label></span>
                                            @elseif ($day->bank_holiday == 'Unavailable')
                                                <span id='{{ $day->id }}' class='unavailable'><label>{{ $day->day }}</label></span>
                                            @elseif ($day->id <= $date_booked)
                                                <span id='{{ $day->id }}' class='pastday'><label>{{ $day->day }}</label></span>
                                            @else
                                                <span id='{{ $day->id }}' class='weekday'><label>{{ $day->day }}</label></span>
                                            @endif
                                        @endif
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                        </div>

                        <div id='dates_right'>
                            @for($x = 1; $x <= 31; $x++)<div class='date'>{{$x}}</div>@endfor
                        </div>
                        <div id='months_right'>
                            <ul class='months_list'>
                                @foreach($months as $month)
                                    <li>{{$month}}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                    <div class='clear'></div>
            </div><!--end of content-->
        </div><!--end of content_wrapper-->
    </div>
</div>
@endsection

@section('scripts')
    <script src="/js/holidays.js"></script>
@endsection
