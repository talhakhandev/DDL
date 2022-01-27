<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class VacationController extends Controller
{
    public function view()
    {
    	$user = User::where('id', Auth::user()->id)->first();
    	return view('instructor.vacation', compact('user'));
    }

    public function update(Request $request)
    {
        
         $start_time = date('Y-m-d', strtotime($request->vacation_start));

        $end_time = date('Y-m-d', strtotime($request->vacation_end));


        User::where('id', Auth::user()->id)
                    ->update(['vacation_start' => $start_time, 'vacation_end' => $end_time]);


        return back()->with('success',trans('flash.UpdatedSuccessfully'));
    }

    public function reset(Request $request)
    {
        User::where('id', Auth::user()->id)
                    ->update(['vacation_start' => NULL, 'vacation_end' => NULL]);

        return back();

    }
}
