<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['ip_block'])->group(function () {
Route::post('login', 'Api\Auth\LoginController@login');
Route::post('fblogin', 'Api\Auth\LoginController@fblogin');
Route::post('googlelogin', 'Api\Auth\LoginController@googlelogin');

Route::get('social/login/{provider}', 'Api\Auth\LoginController@redirectToblizzard_sociallogin');

Route::post('social/login/{provider}/callback', 'Api\Auth\LoginController@blizzard_sociallogin');

Route::post('register', 'Api\Auth\RegisterController@register');
Route::post('refresh', 'Api\Auth\LoginController@refresh');
 
Route::post('forgotpassword', 'Api\Auth\LoginController@forgotApi');
Route::post('verifycode', 'Api\Auth\LoginController@verifyApi');
Route::post('resetpassword', 'Api\Auth\LoginController@resetApi');


Route::get('home', 'Api\MainController@home');


Route::get('course', 'Api\MainController@course');
Route::get('course/paginate', 'Api\MainController@paginationcourse');

Route::get('featuredcourse', 'Api\MainController@featuredcourse');
Route::get('recent/course', 'Api\MainController@recentcourse');

Route::get('bundle/courses', 'Api\MainController@bundle');
Route::get('user/faq', 'Api\MainController@studentfaq');
Route::get('instructor/faq', 'Api\MainController@instructorfaq');

Route::get('main', 'Api\MainController@main');

Route::post('course/detail', 'Api\MainController@detailpage');
Route::get('all/pages', 'Api\MainController@pages');
Route::post('instructor/profile', 'Api\MainController@instructorprofile');
Route::post('course/review', 'Api\MainController@review');
Route::post('chapter/duration', 'Api\MainController@duration');

Route::get('apikeys', 'Api\MainController@apikeys');
Route::get('all/courses/detail', 'Api\MainController@coursedetail');
Route::get('all/coupons', 'Api\MainController@showcoupon');

Route::get('aboutus', 'Api\MainController@aboutus');

Route::post('contactus', 'Api\MainController@contactus');

Route::get('payment/apikeys', 'Api\PaymentController@apikeys');

Route::get('blog', 'Api\MainController@blog');
Route::post('blog/detail', 'Api\MainController@blogdetail');
Route::get('recent/blog', 'Api\MainController@recentblog');

Route::get('terms_policy', 'Api\MainController@terms');
Route::get('career', 'Api\MainController@career');
Route::get('zoom', 'Api\MainController@zoom');
Route::get('bigblue', 'Api\MainController@bigblue');
Route::get('fetch/category/{id}/courses','Api\MainController@getcategoryCourse');


Route::get('course/content/{id}', 'Api\MainController@coursecontent');


Route::group(['middleware' => ['auth:api']], function (){
 	 
	
	Route::post('logout','Api\Auth\LoginController@logoutApi');
   	
    //wishlist
	Route::post('addtowishlist', 'Api\MainController@addtowishlist');
	Route::post('remove/wishlist', 'Api\MainController@removewishlist');
	Route::post('show/wishlist', 'Api\MainController@showwishlist');

    //userprofile
	Route::post('show/profile', 'Api\MainController@userprofile');
	Route::post('update/profile', 'Api\MainController@updateprofile');
	Route::post('my/courses', 'Api\MainController@mycourses');

    //cart
	Route::post('addtocart', 'Api\MainController@addtocart');
 	Route::post('remove/cart', 'Api\MainController@removecart');
	Route::post('show/cart', 'Api\MainController@showcart');
	Route::post('remove/all/cart', 'Api\MainController@removeallcart');
	Route::post('addtocart/bundle', 'Api\MainController@addbundletocart');
	Route::post('remove/bundle', 'Api\MainController@removebundlecart');

    //userprofile
	Route::get('notifications', 'Api\MainController@allnotification');
	Route::get('readnotification/{id}', 'Api\MainController@notificationread');
	Route::post('readall/notification', 'Api\MainController@readallnotification');
	
	//paymentAPI
	Route::post('pay/store', 'Api\PaymentController@paystore');
	Route::get('purchase/history', 'Api\PaymentController@purchasehistory');

	Route::post('instructor/request', 'Api\MainController@becomeaninstructor');

	Route::post('course/progress', 'Api\MainController@courseprogress');
	Route::post('course/progress/update', 'Api\MainController@courseprogressupdate');

	Route::post('course/report', 'Api\MainController@coursereport');

	Route::post('apply/coupon', 'Api\CouponController@applycoupon');
	Route::post('remove/coupon', 'Api\CouponController@remove');

	Route::post('assignment/submit', 'Api\MainController@assignment');

	Route::post('appointment/request', 'Api\MainController@appointment');

	Route::post('question/submit', 'Api\MainController@question');

	Route::post('answer/submit', 'Api\MainController@answer');

	Route::post('appointment/delete/{id}', 'Api\MainController@appointmentdelete');


	Route::post('review/submit', 'Api\MainController@userreview');


	//Instructor API
	Route::get('instructor/dashboard', 'Api\InstructorApiController@dashboard');
	
	Route::get('instructor/course', 'Api\InstructorApiController@getAllcourse');
	Route::get('instructor/course/{id}', 'Api\InstructorApiController@getcourse');

	Route::post('instructor/update/profile', 'Api\InstructorApiController@instructorprofileupdate');


	Route::get('course/class', 'Api\InstructorApiController@getAllclass');
    Route::get('course/class/{id}', 'Api\InstructorApiController@getclass');
    Route::post('course/class', 'Api\InstructorApiController@createclass');
    Route::post('course/class/{id}', 'Api\InstructorApiController@updateclass');
    Route::delete('course/class/{id}','Api\InstructorApiController@deleteclass');

    /* Certicficate api */
    Route::get('certificate/download/{progress_id}', 'CertificateController@apipdfdownload');

    /* Invoice api */
    Route::get('invoice/download/{order_id}', 'OrderController@apiinvoicepdfdownload');

    Route::post('free/enroll', 'Api\PaymentController@enroll');

    Route::post('quiz/submit', 'Api\MainController@quizsubmit');

    Route::get('user/bankdetails', 'Api\OtherApiController@userbankdetail');
    Route::post('add/bankdetails', 'Api\OtherApiController@addbankdetail');
    Route::post('update/bankdetails/{id}', 'Api\OtherApiController@updatebankdetail');

    Route::post('create/watchlist', 'Api\OtherApiController@addwatchlist');
    Route::get('view/watchlist', 'Api\OtherApiController@viewwatchlist');
    Route::post('delete/watchlist', 'Api\OtherApiController@deletewatchlist');
    Route::post('assignment/delete', 'Api\MainController@deleteAssignment');

    Route::get('instructor/request/check', 'Api\MainController@requestCheck');
    Route::post('cancel/instructor/request', 'Api\MainController@cancelRequest');

    Route::post('stripe/pay/store', 'Api\PaymentController@stripepay');

    //orders API
	Route::get('order', 'Api\InstructorApiController@getAllorder');

	Route::get('watch/course/{id}', 'Api\MainController@watchcourse');

	Route::post('review/helpful/{id}', 'Api\MainController@reviewlike');

	Route::get('course/assignment', 'Api\InstructorApiController@getAllassignment');

	Route::get('refundorder', 'Api\InstructorApiController@getAllrefund');

	Route::get('toinvolve/courses', 'Api\InstructorApiController@toinvolvecourses');
	Route::post('requesttoinvolve', 'Api\InstructorApiController@requesttoinvolve');
	Route::get('all/involve/request', 'Api\InstructorApiController@Allinvolvementrequest');
	Route::get('involved/courses', 'Api\InstructorApiController@involvedcourses');

	Route::get('questions', 'Api\InstructorApiController@getAllquestions');
	Route::get('questions/{id}', 'Api\InstructorApiController@getquestions');
	Route::post('questions', 'Api\InstructorApiController@createquestions');
	Route::post('questions/{id}', 'Api\InstructorApiController@updatequestions');

	Route::get('announcement', 'Api\InstructorApiController@Allannouncement');


	Route::get('answer', 'Api\InstructorApiController@getAllanswer');
	Route::get('answer/{id}', 'Api\InstructorApiController@getanswer');
	Route::post('answer/{id}', 'Api\InstructorApiController@updateanswer');
	Route::delete('answer/{id}', 'Api\InstructorApiController@deleteanswer');
	
	
    Route::get('vacationmode', 'Api\InstructorApiController@vacationmode');
    Route::post('vacationmodeupdate', 'Api\InstructorApiController@vacationmodeupdate');

    Route::get('quiz/reports/{id}','Api\MainController@quiz_reports');
	

});

Route::get('course/assignment/{id}', 'Api\InstructorApiController@getassignment');
Route::post('course/assignment/{id}', 'Api\InstructorApiController@updateassignment');
Route::delete('course/assignment/{id}','Api\InstructorApiController@deleteassignment');

Route::post('order', 'Api\InstructorApiController@createorder');
Route::get('order/{id}', 'Api\InstructorApiController@getorder');
Route::delete('order/{id}','Api\InstructorApiController@deleteorder');


//Instructor API

//course language API
Route::get('courselanguage', 'Api\InstructorApiController@getAlllanguage');
Route::get('courselanguage/{id}', 'Api\InstructorApiController@getlanguage');
Route::post('courselanguage', 'Api\InstructorApiController@createlanguage');
Route::post('courselanguage/{id}', 'Api\InstructorApiController@updatelanguage');
Route::delete('courselanguage/{id}','Api\InstructorApiController@deletelanguage');

//categories API
Route::get('category', 'Api\InstructorApiController@getAllcategory');
Route::get('category/{id}', 'Api\InstructorApiController@getcategory');
Route::post('category', 'Api\InstructorApiController@createcategory');
Route::post('category/{id}', 'Api\InstructorApiController@updatecategory');
Route::delete('category/{id}','Api\InstructorApiController@deletecategory');

//subcategories API
Route::get('subcategory', 'Api\InstructorApiController@getAllsubcategory');
Route::get('subcategory/{id}', 'Api\InstructorApiController@getsubcategory');
Route::post('subcategory', 'Api\InstructorApiController@createsubcategory');
Route::post('subcategory/{id}', 'Api\InstructorApiController@updatesubcategory');
Route::delete('subcategory/{id}','Api\InstructorApiController@deletesubcategory');

//childcategories API
Route::get('childcategory', 'Api\InstructorApiController@getAllchildcategory');
Route::get('childcategory/{id}', 'Api\InstructorApiController@getchildcategory');
Route::post('childcategory', 'Api\InstructorApiController@createchildcategory');
Route::post('childcategory/{id}', 'Api\InstructorApiController@updatechildcategory');
Route::delete('childcategory/{id}','Api\InstructorApiController@deletechildcategory');


//Courses API

Route::post('instructor/course', 'Api\InstructorApiController@createcourse');
Route::post('instructor/course/{id}', 'Api\InstructorApiController@updatecourse');
Route::delete('instructor/course/{id}','Api\InstructorApiController@deletecourse');


Route::get('refundpolicy', 'Api\InstructorApiController@getAllrefundpolicy');


//Refund orders API

Route::get('refundorder/{id}', 'Api\InstructorApiController@getrefund');
Route::post('refundorder/{id}', 'Api\InstructorApiController@updaterefund');
Route::delete('refundorder/{id}','Api\InstructorApiController@deleterefund');


//categories API
Route::get('include', 'Api\InstructorApiController@getAllinclude');
Route::get('include/{id}', 'Api\InstructorApiController@getinclude');
Route::post('include', 'Api\InstructorApiController@createinclude');
Route::post('include/{id}', 'Api\InstructorApiController@updateinclude');
Route::delete('include/{id}','Api\InstructorApiController@deleteinclude');


//categories API
Route::get('whatlearn', 'Api\InstructorApiController@getAllwhatlearn');
Route::get('whatlearn/{id}', 'Api\InstructorApiController@getwhatlearn');
Route::post('whatlearn', 'Api\InstructorApiController@createwhatlearn');
Route::post('whatlearn/{id}', 'Api\InstructorApiController@updatewhatlearn');
Route::delete('whatlearn/{id}','Api\InstructorApiController@deletewhatlearn');


Route::get('chapter', 'Api\InstructorApiController@getAllchapter');
Route::get('chapter/{id}', 'Api\InstructorApiController@getchapter');
Route::post('chapter', 'Api\InstructorApiController@createchapter');
Route::post('chapter/{id}', 'Api\InstructorApiController@updatechapter');
Route::delete('chapter/{id}','Api\InstructorApiController@deletechapter');


Route::get('related/course', 'Api\InstructorApiController@getAllrelated');
Route::get('related/course/{id}', 'Api\InstructorApiController@getrelated');
Route::post('related/course', 'Api\InstructorApiController@createrelated');
Route::post('related/course/{id}', 'Api\InstructorApiController@updaterelated');
Route::delete('related/course/{id}','Api\InstructorApiController@deleterelated');



Route::delete('questions/{id}','Api\InstructorApiController@deletequestions');


Route::get('language', 'Api\OtherApiController@siteLanguage');


Route::post('gift/user/check', 'Api\PaymentController@giftusercheck');
Route::post('gift/checkout', 'Api\PaymentController@giftcheckout');

Route::get('category/{id}/{name}', 'Api\MainController@categoryPage');
Route::get('subcategory/{id}/{name}', 'Api\MainController@subcategoryPage');
Route::get('childcategory/{id}/{name}', 'Api\MainController@childcategoryPage');

Route::get('search', 'Api\OtherApiController@search');
Route::get('live/mettings', 'Api\OtherApiController@meetings');
Route::get('footer/widget', 'Api\OtherApiController@widget');

Route::get('manual/payment', 'Api\OtherApiController@manual');


Route::get('/check-for-update','OtaUpdateController@checkforupate');

Route::post('live/attandance','Api\OtherApiController@attandance');

Route::get('/currencies','Api\OtherApiController@currencies');

Route::post('/currency/rates','Api\OtherApiController@currency_rates');

});



