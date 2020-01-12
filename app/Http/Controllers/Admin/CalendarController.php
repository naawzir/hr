<?php

namespace App\Http\Controllers\Admin;

use App\Calendar;
use App\Holiday;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\UserTest;
use Illuminate\Support\Facades\Validator;

class CalendarController extends Controller
{
    protected $calendar;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Calendar $calendar)
    {
        $this->calendar = $calendar;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        $days = $this->calendar->with('holidaysForUser')->get();
        $months = [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ];
        $data = [
            'user'     => $user,
            'days'     => $days,
            'months'   => $months,
        ];

        return view('calendar.index', $data);
    }

    public function requests(Request $request)
    {
        date_default_timezone_set('Europe/London');
        $date_booked = date('z') + 1;

        $holidays = Holiday::whereIn('booked', ['Request sent', 'Half Request sent'])
            //->where('id', '>=', $date_booked)
            ->get();
        $holidaysPending = $holidays->filter(function ($value, $key) {
            return is_null($value->stage);
        });
        $holidaysAccepted = $holidays->filter(function ($value, $key) {
            return $value->stage == 'Accepted';
        });
        $holidaysDeclined = $holidays->filter(function ($value, $key) {
            return $value->stage == 'Declined';
        });
        $data = [
            'holidaysPending'  => $holidaysPending,
            'holidaysAccepted' => $holidaysAccepted,
            'holidaysDeclined' => $holidaysDeclined,
        ];
        return view('calendar.requests', $data);
    }

    public function requestsCalendar(Request $request)
    {
        $days = $this->calendar->with('holidaysForUsers')->get();
        $months = [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ];

        date_default_timezone_set('Europe/London');
        $date_booked = date('z') + 1;

        $holidays = Holiday::whereIn('booked', ['Request sent', 'Half Request sent'])
            //->where('id', '>=', $date_booked)
            ->get();

        $holidaysPending = $holidays->filter(function ($value, $key) {
            return is_null($value->stage);
        });
        $holidaysAccepted = $holidays->filter(function ($value, $key) {
            return $value->stage == 'Accepted';
        });
        $holidaysDeclined = $holidays->filter(function ($value, $key) {
            return $value->stage == 'Declined';
        });
        $data = [
            'holidaysPending'  => $holidaysPending,
            'holidaysAccepted' => $holidaysAccepted,
            'holidaysDeclined' => $holidaysDeclined,
            'days'     => $days,
            'months'   => $months,
        ];
        return view('calendar.requests-calendar', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function show(Calendar $calendar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function edit(Calendar $calendar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Calendar $calendar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Calendar $calendar)
    {
        //
    }
}
