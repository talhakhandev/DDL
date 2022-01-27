<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CourseProgress;
use App\CourseChapter;
use Auth;
use App\User;

class CourseProgressController extends Controller
{
    public function checked(Request $request, $id)
	{
		$data = $this->validate($request, [
            'checked' => 'required',
        ]);

		$progress = CourseProgress::where('course_id','=',$id)->where('user_id', Auth::User()->id)->first();

		if(isset($progress))
		{
			$chapter = CourseChapter::where('course_id', $id)->get();

		   	$chapter_id = array();

		   	foreach($chapter as $c)
	        {
	           array_push($chapter_id, "$c->id");
	        }
	        
			CourseProgress::where('course_id', $id)->where('user_id', '=', Auth::user()
                    ->id)
                    ->update([
                    	'mark_chapter_id' => $request->checked,
                    	'all_chapter_id' => $chapter_id, 
                    	'updated_at'  => \Carbon\Carbon::now()->toDateTimeString()
                    ]);
		}
		else
        {
	   	
		   	$chapter = CourseChapter::where('course_id', $id)->get();

		   	$chapter_id = array();

		   	foreach($chapter as $c)
	        {
	           array_push($chapter_id, "$c->id");
	        }

		   	$created_progress = CourseProgress::create([
	            'course_id' => $id,
	            'user_id' => Auth::User()->id,
	            'mark_chapter_id' => $request->checked,
	            'all_chapter_id' => $chapter_id,
	            'created_at'  => \Carbon\Carbon::now()->toDateTimeString(),
	            'updated_at'  => \Carbon\Carbon::now()->toDateTimeString(),
	            ]
	        );
		}

        return back(); 
	}


	public function progressreport(){

		$user = User::all();
	    $progress = CourseProgress::all();
	    return view('admin.report.progress', compact('progress', 'user'));
	}

    public function progressview(Request $request,$id){

        $progress = CourseProgress::where('user_id',$id)->get();

        return view('admin.report.progressview', compact('progress'));
    }




}
