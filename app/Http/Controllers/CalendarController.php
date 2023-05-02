<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();// get the authenticated user

        $today = Carbon::now();
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);

        $firstDayOfMonth = Carbon::createFromDate($year, $month, 1, 'CET')->startOfMonth();
        $lastDayOfMonth = Carbon::createFromDate($year, $month, 1, 'CET')->endOfMonth();

        // add empty days before the first day of the month (June starts on a Thursday, so 3 empty days)
        $calendarDays = [];
        for($i = 1; $i < $firstDayOfMonth->dayOfWeek; $i++) {
            $calendarDays[] = '';
        }

        for ($day = 1; $day <= $lastDayOfMonth->day; $day++) {
            $calendarDays[] = $day;
        }

        $pickUps = DB::table('pick_ups')
            ->join('packets', 'pick_ups.id', '=', 'packets.id')
            ->where('packets.user_id', $user->id)
            ->whereBetween('pick_up_date_time', [$firstDayOfMonth, $lastDayOfMonth])
            ->get();

        return view('calendar', compact('today', 'month', 'year', 'firstDayOfMonth', 'calendarDays', 'pickUps'));
    }
}

