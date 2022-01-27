<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Language;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Course;
use App\Googlemeet;
use App\JitsiMeeting;
use App\Meeting;
use App\BBL;
use App\WidgetSetting;
use Auth;
use App\UserBankDetail;
use App\WatchCourse;
use Carbon\Carbon;
use App\ManualPayment;
use App\Attandance;
use App\Currency;

class OtherApiController extends Controller
{
    public function siteLanguage(Request $request)
    {

    	$validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }

    	$language = Language::get();

        return response()->json(array('language'=>$language), 200);
    }

    public function search(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'secret' => 'required',
            'searchTerm' => 'required'
        ]);

        if ($validator->fails()) {

            $errors = $validator->errors();

            if($errors->first('secret')){
                return response()->json(['message' => $errors->first('secret'), 'status' => 'fail']);
            }
            if($errors->first('searchTerm')){
                return response()->json(['message' => $errors->first('searchTerm'), 'status' => 'fail']);
            }
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }

        $searchTerm = $request->searchTerm;

        $coursequery = Course::query()->with('user');

        if(isset($searchTerm))
        {
            $search_data = collect();

            $lang =app()->getLocale();

            if($lang == 'ar' || $lang == 'ur')
            {

                $course_title = $coursequery->where('title->'.app()->getLocale(), 'LIKE', '%'.$searchTerm.'%')->paginate(10);
                 
            }
            else{
                
                 $course_title = $coursequery->where('title', 'LIKE', "%$searchTerm%")->where('status','=',1)->paginate(10);

            }
            

            

            if (isset($course_title) && count($course_title) > 0)
            {
                
                $search_data->push($course_title);
                                

            }

            $course_tags = $coursequery->where('level_tags', 'LIKE', "%$searchTerm%")->where('status','=',1)->paginate(10);

            if (isset($course_tags) && count($course_tags) > 0)
            {
                
                $search_data->push($course_tags);
                                

            }

            $search_data = $search_data->flatten();

            $courses = Course::search($searchTerm)->with('user')->paginate(10);

            return response()->json(array('courses'=>$courses), 200);
        }
        else
        {
            return response()->json(array('message' => 'No searchTerm found', 'status' => 'fail'), 200);
        }
    }

    public function meetings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {

            $errors = $validator->errors();

            if($errors->first('secret')){
                return response()->json(['message' => $errors->first('secret'), 'status' => 'fail']);
            }
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }

        $zoom_meeting = Meeting::where('course_id','=', NULL)->get();
        $bigblue_meeting = BBL::where('course_id','=', NULL)->get();
        $google_meet = Googlemeet::where('course_id','=', NULL)->get();
        $jitsi_meeting = JitsiMeeting::where('course_id','=', NULL)->get();



        $array_zoom = array($zoom_meeting);
        $array_jitsi = array($jitsi_meeting);

        foreach(array_merge($array_zoom,$array_jitsi) as $item)
        {
           $all_categories[] = array(
                $item,
            );
        }
    


        return response()->json(array('result' => $all_categories,'zoom_meeting' => $zoom_meeting, 'bigblue_meeting' => $bigblue_meeting, 'jitsi_meeting' => $jitsi_meeting, 'google_meet' => $google_meet ), 200);
    }

    public function userbankdetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {

            $errors = $validator->errors();

            if($errors->first('secret')){
                return response()->json(['message' => $errors->first('secret'), 'status' => 'fail']);
            }
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }


        $user = Auth::user();
        $banks = UserBankDetail::where('user_id', $user->id)->get();


        return response()->json(array('user_bankdetail' => $banks), 200);


    }

    public function addbankdetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'secret' => 'required',
            'bank_name' => 'required',
            'ifcs_code' => 'required',
            'account_number' => 'required',
            'account_holder_name' => 'required',
        ]);

        if ($validator->fails()) {

            $errors = $validator->errors();

            if($errors->first('secret')){
                return response()->json(['message' => $errors->first('secret'), 'status' => 'fail']);
            }

            if($errors->first('bank_name')){
                return response()->json(['message' => $errors->first('bank_name'), 'status' => 'fail']);
            }

            if($errors->first('ifcs_code')){
                return response()->json(['message' => $errors->first('ifcs_code'), 'status' => 'fail']);
            }

            if($errors->first('account_number')){
                return response()->json(['message' => $errors->first('account_number'), 'status' => 'fail']);
            }

            if($errors->first('account_holder_name')){
                return response()->json(['message' => $errors->first('account_holder_name'), 'status' => 'fail']);
            }
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }

        $user = Auth::user();

        $bank = new UserBankDetail;
        $bank->user_id = $user->id;
        $bank->bank_name = $request->bank_name;
        $bank->ifcs_code = $request->ifcs_code;
        $bank->account_number = $request->account_number;
        $bank->account_holder_name = $request->account_holder_name;
        $bank->bank_enable = 1;

        $bank->save();


        return response()->json(array('message' => 'Your bank detail has been added successfully', 'status' => 'success'), 200);
    }

    public function updatebankdetail(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {

            $errors = $validator->errors();

            if($errors->first('secret')){
                return response()->json(['message' => $errors->first('secret'), 'status' => 'fail']);
            }

        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }

        $user = Auth::user();

        if (UserBankDetail::where('id', $id)->exists()) {
            $data = UserBankDetail::find($id);

            $data->user_id = isset($request->user_id) ? $request->user_id : $data->user_id;
            $data->bank_name = isset($request->bank_name) ? $request->bank_name : $data->bank_name;
            $data->ifcs_code = isset($request->ifcs_code) ? $request->ifcs_code : $data->ifcs_code;
            $data->account_number = isset($request->account_number) ? $request->account_number : $data->account_number;
            $data->account_holder_name = isset($request->account_holder_name) ? $request->account_holder_name : $data->account_holder_name;

            $data->status = isset($request->bank_enable) ? $request->bank_enable : $data->bank_enable;
            $data->save();

            return response()->json([
              "message" => "updated successfully",
              'record'=>$data
            ]);
        } else {
            return response()->json([
              "message" => "data not found"
            ], 404);
        }


        return response()->json(array('message' => 'Your bank detail has been added successfully', 'status' => 'success'), 200);
    }


    public function updatelanguage(Request $request, $id) {

        $validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {

            $errors = $validator->errors();

            if($errors->first('secret')){
                return response()->json(['message' => $errors->first('secret'), 'status' => 'fail']);
            }
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !'], 400);
        }

        if (UserBankDetail::where('id', $id)->exists()) {
            $userBank = UserBankDetail::find($id);

            $userBank->bank_name = isset($request->bank_name) ? $request->bank_name : $userBank->bank_name;
            $userBank->ifcs_code = isset($request->ifcs_code) ? $request->ifcs_code : $userBank->ifcs_code;
            $userBank->account_number = isset($request->account_number) ? $request->account_number : $userBank->account_number;
            $userBank->account_holder_name = isset($request->account_holder_name) ? $request->account_holder_name : $userBank->account_holder_name;

            $userBank->save();

            return response()->json([
              "message" => "records updated successfully",
              'userBank'=>$userBank
            ]);
        } else {
            return response()->json([
              "message" => "record not found"
            ], 404);
        }
    }

    public function widget(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {

            $errors = $validator->errors();

            if($errors->first('secret')){
                return response()->json(['message' => $errors->first('secret'), 'status' => 'fail']);
            }
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }


        $widget = WidgetSetting::first();

        return response()->json(array('widget' => $widget), 200);
    }

    public function addwatchlist(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'secret' => 'required',
            'course_id' => 'required',
        ]);

        if ($validator->fails()) {

            $errors = $validator->errors();

            if($errors->first('secret')){
                return response()->json(['message' => $errors->first('secret'), 'status' => 'fail']);
            }

            if($errors->first('course_id')){
                return response()->json(['message' => $errors->first('course_id'), 'status' => 'fail']);
            }
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }

        $user = Auth::user();

        $watch = WatchCourse::create([
            'user_id'    => $user->id,
            'course_id'  => $request->course_id,
            'start_time' => \Carbon\Carbon::now()->toDateTimeString(),
            'active'     => '1',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            ]
        );

        return response()->json(array('watchlist' => $watch), 200);
    }

    public function viewwatchlist(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {

            $errors = $validator->errors();

            if($errors->first('secret')){
                return response()->json(['message' => $errors->first('secret'), 'status' => 'fail']);
            }
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }

        $user = Auth::user();

        $watch = WatchCourse::where('user_id', $user->id)->get();

        return response()->json(array('watchlist' => $watch), 200);
    }

    public function deletewatchlist(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'secret' => 'required',
            'course_id' => 'required'
        ]);

        if ($validator->fails()) {

            $errors = $validator->errors();

            if($errors->first('secret')){
                return response()->json(['message' => $errors->first('secret'), 'status' => 'fail']);
            }

            if($errors->first('course_id')){
                return response()->json(['message' => $errors->first('course_id'), 'status' => 'fail']);
            }
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }

        $user = Auth::user();

        if(WatchCourse::where('course_id', $request->course_id)->where('user_id', $user->id)->exists()) {
            WatchCourse::where('course_id', $request->course_id)->where('user_id', $user->id)->delete();

            return response()->json([
              "message" => "records deleted"
            ]);

        } else {
            return response()->json([
              "message" => "record not found"
            ], 404);
        }
    }

    public function manual(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {

            $errors = $validator->errors();

            if($errors->first('secret')){
                return response()->json(['message' => $errors->first('secret'), 'status' => 'fail']);
            }
        } 

        $payments = ManualPayment::get();

        $result = array();

        foreach ($payments as $data) {

            $result[] = array(
                'id' => $data->id,
                'name' => $data->name,
                'detail' => strip_tags($data->detail),
                'image' => $data->image,
                'image_path' => url('images/manualpayment/'.$data->image),
                'status' => $data->status,
                'created_at' => $data->created_at,
                'updated_at' => $data->updated_at,
            );
        }

        return response()->json(array('manual_payment' => $result), 200);

    }


    public function attandance(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            if($errors->first('secret')){
                return response()->json(['message' => $errors->first('secret'), 'status' => 'fail']);
            }
        }
        $user = Auth::user();
        $date = Carbon::now();
            //Get date
        $date->toDateString();
        $zoom = Meeting::where('id', $request->meeting_id)->first();
        if($request->meeting_type == '1')
        {
            $courseAttandance = Attandance::where('user_id', $user->id)->where('zoom_id', $request->meeting_id)->first();
            if(!$courseAttandance)
            {
                $attanded = Attandance::create([
                    'user_id'    => Auth::user()->id,
                    'zoom_id'  => $zoom->id,
                    'instructor_id' => $zoom->user_id,
                    'date'     => $date->toDateString(),
                    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    ]
                );
                return response()->json(array('attanded'=>$attanded));
            }
        }
        $googlemeet = Googlemeet::where('id', $request->meeting_id)->first();
        if($request->meeting_type == '2')
        {
            $courseAttandance = Attandance::where('user_id', $user->id)->where('googlemeet_id', $request->meeting_id)->first();
            if(!$courseAttandance)
            {
                $attanded = Attandance::create([
                    'user_id'    => Auth::user()->id,
                    'zoom_id'  => $googlemeet->id,
                    'instructor_id' => $googlemeet->user_id,
                    'date'     => $date->toDateString(),
                    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    ]
                );
                return response()->json(array('attanded'=>$attanded));
            }
        }
        $jitsimeetings = JitsiMeeting::where('meeting_id', '=', $request->meeting_id)->first();
        if($request->meeting_type == '3')
        {
            $courseAttandance = Attandance::where('user_id', $user->id)->where('jitsi_id', $request->meeting_id)->first();
            if(!$courseAttandance)
            {
                $attanded = Attandance::create([
                    'user_id'    => Auth::user()->id,
                    'zoom_id'  => $jitsimeetings->id,
                    'instructor_id' => $jitsimeetings->user_id,
                    'date'     => $date->toDateString(),
                    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    ]
                );
                return response()->json(array('attanded'=>$attanded));
            }
        }
        $bigblue = BBL::where('meetingid',$request->meeting_id)->first();
        if($request->meeting_type == '4')
        {
            $courseAttandance = Attandance::where('user_id', $user->id)->where('bbl_id', $request->meeting_id)->first();
            if(!$courseAttandance)
            {
                $attanded = Attandance::create([
                    'user_id'    => Auth::user()->id,
                    'zoom_id'  => $bigblue->id,
                    'instructor_id' => $bigblue->user_id,
                    'date'     => $date->toDateString(),
                    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    ]
                );
                return response()->json(array('attanded'=>$attanded));
            }
        }
    }


    public function currencies(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'secret' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }

        $currencies = Currency::get();

        return response()->json(array('currencies'=>$currencies), 200);
    }

    public function currency_rates(Request $request, $code)
    {

        $validator = Validator::make($request->all(), [
            'secret' => 'required',
            'amount' => 'required',
            'currency_from' => 'required',
            'currency_to' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Secret Key is required']);
        }

        $key = DB::table('api_keys')->where('secret_key', '=', $request->secret)->first();

        if (!$key) {
            return response()->json(['Invalid Secret Key !']);
        }

        $currency = currency($request->price, $from = $currency_from, $to = $currency_to, $format = true);

        return response()->json(array('currency'=>$currency), 200);
    }



    
}
