<?php

namespace App\Http\Controllers\Admin\API;

use App\Events\sendEmailToHR;
use App\Events\sendEmailToEmployee;
use App\Http\Controllers\Controller;
use App\Calendar;
use Illuminate\Http\Request;
use App\User;
use App\Holiday;
use Illuminate\Support\Facades\Validator;

class CalendarController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('api');
    }

    public function getRequests(Request $request)
    {
        /*date_default_timezone_set('Europe/London');
        $date_booked = date('z') + 1;
        //$date_booked = date('z');
        $holidaysPending = Holiday::whereNull('stage')
            ->where('id', '>=', $date_booked)
            ->where(function($q) {
                $q->where('booked', 'Request sent')
                    ->orWhere('booked', 'Half Request sent');
            })
            ->with('user')
            ->get();

        $holidaysAccepted = Holiday::where('stage', 'Accepted')->get();
        $holidaysDeclined = Holiday::where('stage', 'Declined')->get();

        return response()->json([
            'success' => true,
            'holidaysPending' => $holidaysPending,
            'holidaysAccepted'  => $holidaysAccepted,
            'holidaysDeclined'  => $holidaysDeclined,
        ]);*/
    }

    public function makeHolidayRequest(Request $request)
    {
        $id = $request['daynumber'];
        $calendar = Calendar::findOrFail($id);

        $userId = $request['userId']; // uuid value
        $user = findByUuid(new User, $userId);

        $day = $calendar['day'];
        $date = $calendar['date'];
        $month = $calendar['month'];

        $date_booked = "$day $date $month 2020";

        date_default_timezone_set('Europe/London');
        $date_requested = date('D d M Y');
        $time_requested = date('H:i:s');

        $holiday = new Holiday;
        $holiday->id = $id;
        $holiday->user_id = $user->id;
        $holiday->request_date = $date_requested;
        $holiday->request_time = $time_requested;
        $holiday->requested_date = $date_booked;
        $holiday->booked = $request['type'];
        $holiday->save();

        return response()->json([
            'success' => true,
            'data'  => $holiday,
        ]);
    }

    public function submitHolidayRequests(Request $request)
    {
        $userId = $request['userId']; // uuid value
        $user = findByUuid(new User, $userId);

        $fullDayRequests = Holiday::where('user_id', $user->id)
            ->whereNull('stage')
            ->where('booked', 'Request')
            ->get();

        $fullDayRequestedDates = [];
        foreach ($fullDayRequests as $holiday) {
            $fullDayRequestedDates[] = $holiday->requested_date;
            $holiday->booked = 'Request sent';
            $holiday->save();
        }

        $halfDayRequests = Holiday::where('user_id', $user->id)
            ->whereNull('stage')
            ->where('booked', 'Half Request')
            ->get();

        $halfDayRequestedDates = [];
        foreach ($halfDayRequests as $holiday) {
            $halfDayRequestedDates[] = $holiday->requested_date;
            $holiday->booked = 'Half Request sent';
            $holiday->save();
        }

        $userName = $user->name;
        $message = $userName . ' has submitted a holiday request for the following dates:';
        $message .= html_entity_decode("\n") . implode("\n", $fullDayRequestedDates) . html_entity_decode("\n");
        $message .= html_entity_decode("\n") . implode("\n", $halfDayRequestedDates) . html_entity_decode("\n");
        //$text = null;
        // let us send an email
        if (app()->isLocal()) {
            event(new sendEmailToHR($user, $message));
        } else {
            // we'll send one email every hour only if at least one holiday request has been made in the previous hour

        }
        return response()->json([
            'success' => true
        ]);
    }

    public function cancelHolidayRequest(Request $request)
    {
        $userId = $request['userId']; // uuid value
        $user = findByUuid(new User, $userId);

        $holiday = Holiday::where('user_id', $user->id)
            ->where('id', $request['daynumber'])
            ->firstOrFail();
        $holiday->delete();

        return response()->json([
            'success' => true
        ]);
    }

    public function acceptHolidayRequests(Request $request)
    {
        $holidayIds = array_unique($request->holiday_ids);
        $holidays = Holiday::whereIn('holiday_id', $holidayIds)->get();
        foreach ($holidays as $holiday) {
            $holiday->stage = 'Accepted';
            $holiday->save();
        }

        $text = null;
        // let us send an email
        ///event(new sendEmailToHR($user, $text));

        return response()->json([
            'success' => true
        ]);
    }

    public function declineHolidayRequests(Request $request)
    {
        $holidayIds = array_unique($request->holiday_ids);
        $holidays = Holiday::whereIn('holiday_id', $holidayIds)->get();
        foreach ($holidays as $holiday) {
            $holiday->stage = 'Declined';
            $holiday->save();
        }

        // let us send an email
        /*$user = User::findOrFail(10);
        $userName = $user->name;
        $text = 'Your holiday requests have been declined';*/
        //$text .= html_entity_decode("\n") . implode("\n", $fullDayRequestedDates) . html_entity_decode("\n");
        //$text .= html_entity_decode("\n") . implode("\n", $halfDayRequestedDates) . html_entity_decode("\n");

        // let us send an email
        //event(new sendEmailToEmployee($user, $text));

        return response()->json([
            'success' => true
        ]);
    }

    public function acceptHolidayRequest(Request $request)
    {
        //"UPDATE holidays SET stage = 'Accepted' WHERE holiday_id = '$id'"
        $holiday = Holiday::findOrFail($request->holiday_id);
        $holiday->stage = 'Accepted';
        $holiday->save();

        // let us send an email

        return response()->json([
            'success' => true
        ]);
        //return redirect()->route('requests');
    }

    public function declineHolidayRequest(Request $request)
    {
        //"UPDATE holidays SET stage = 'Declined' WHERE holiday_id = '$id'"
        $holiday = Holiday::findOrFail($request->holiday_id);
        $holiday->stage = 'Declined';
        $holiday->save();

        /*$user = User::findOrFail(10);
        $userName = $user->name;
        $text = 'Your holiday requests have been declined';*/
        //$text .= html_entity_decode("\n") . implode("\n", $fullDayRequestedDates) . html_entity_decode("\n");
        //$text .= html_entity_decode("\n") . implode("\n", $halfDayRequestedDates) . html_entity_decode("\n");

        // let us send an email
        //event(new sendEmailToEmployee($user, $text));

        return response()->json([
            'success' => true
        ]);
        //return redirect()->route('requests');
    }
}
