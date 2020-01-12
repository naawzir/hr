@extends('layouts.app')
@section('styles')
    <link type="text/css" rel="stylesheet" href="/css/global.css" />
    <link type="text/css" rel="stylesheet" href="/css/holidays.css" />
    <link type="text/css" rel="stylesheet" href="/css/holidays-overview.css" />
    <link type="text/css" rel="stylesheet" href="/css/modal.css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
@endsection
@section('content')
    <div id="requests">
        <div id="myCalendar">
            <div id="calendar_wrapper" style="margin:0 auto;">
                <div id="cal" style="margin:0 auto;">
                    <div id="keys_container" style="text-align:center;">
                        <span class='undecided key'>Pending</span>
                        <span class='accepted key'>Accepted</span>
                        <span class='declined key'>Declined</span>
                        <span class='both key'>Accepted/Declined</span>
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
                                                @if (!$day->holidaysForUsers->isEmpty())
                                                    @if ($day->holidaysForUsers->count() == 1)
                                                        @if ($day->holidaysForUsers[0]->stage == 'Accepted')
                                                            <span class='accepted' id='{{ $day->id }}'><label>{{ $day->day }}</label></span>
                                                        @elseif ($day->holidaysForUsers[0]->stage == 'Declined')
                                                            <span class="declined" id='{{ $day->id }}'><label>{{ $day->day }}</label></span>
                                                        @elseif ($day->holidaysForUsers[0]->stage == '')
                                                            <span class='undecided' id='{{ $day->id }}'><label>{{ $day->day }}</label></span>
                                                        @endif
                                                    @else
                                                        @php $stages = $day->holidaysForUsers->pluck('stage')->toArray(); @endphp
                                                        @if (in_array('Declined', $stages) && in_array('Accepted', $stages))
                                                            <span class='both' id='{{ $day->id }}'><label>{{ $day->day }}</label></span>
                                                        @endif
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
                        </div>
                        <div class='clear'></div>
                </div><!--end of content-->
            </div><!--end of content_wrapper-->
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/requests-calendar.js"></script>
@endsection
