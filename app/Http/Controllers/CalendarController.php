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
        $year = $request->input('year', now()->year);
        $month = $request->input('month', now()->month);

        //get first day of month
        $firstDayOfMonth = Carbon::createFromDate($year, $month, 1, 'CET')->startOfMonth();

        //get last day of month
        $lastDayOfMonth = Carbon::createFromDate($year, $month, 1, 'CET')->endOfMonth();

        //days of the week
        $daysOfWeek = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];

        //create an array to hold the days of the month
        $calendarDays = [];

        //fill array based on the number of days in the month and the first and last weekday of the month
        for($i = 1; $i < $firstDayOfMonth->dayOfWeek; $i++) {
            $calendarDays[] = '';
        }

        for ($day = 1; $day <= $lastDayOfMonth->day; $day++) {
            //add the month number to the array
            $calendarDays[] = $day;
        }

        $today = Carbon::now();

        $pickUps = DB::table('pick_ups')
            ->whereBetween('pick_up_date_time', [$firstDayOfMonth, $lastDayOfMonth])
            ->get();

        return view('calendar', compact('year', 'month', 'firstDayOfMonth', 'lastDayOfMonth', 'daysOfWeek', 'calendarDays', 'today', 'pickUps'));
    }
}

