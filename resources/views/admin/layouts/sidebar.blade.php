<div class="leftbar">
    <!-- Start Sidebar -->
    <div class="sidebar">
        <!-- Start Navigationbar -->

        <div class="navigationbar">

            <div class="vertical-menu-detail">

                <div class="tab-content" id="v-pills-tabContent">

                    <div class="tab-pane fade active show" id="v-pills-dashboard" role="tabpanel"
                        aria-labelledby="v-pills-dashboard">
                        @if(Auth::User()->role == "admin")
                        <ul class="vertical-menu">
                            <div class="logobar">
                                <a href="{{ url('/') }}" class="logo logo-large">
                                    <img style="object-fit:scale-down;" src="{{ url('images/logo/'.$gsetting->logo) }}"
                                        class="img-fluid" alt="logo">
                                </a>
                            </div>


                            <li class="{{ Nav::isRoute('admin.index') }}">
                                <a class="nav-link" href="{{route('admin.index')}}">
                                    <i class="feather icon-pie-chart text-secondary"></i>
                                    <span>{{ __('adminstaticword.Dashboard') }}</span>
                                </a>
                            </li>

                            <li class="{{ Nav::isRoute('market.index') }}">
                                <a class="nav-link" href="{{route('market.index')}}">
                                    <i class="feather icon-pie-chart text-secondary"></i>
                                    <span>{{ __('Marketing Dashboard') }}</span>
                                </a>
                            </li>

                            <!-- dashboard end -->
                            <li class="header">{{ __('Users') }}</li>

                            <!-- user start  -->
                            <li
                                class="{{ Nav::isRoute('user.index') }} {{ Nav::isRoute('user.add') }} {{ Nav::isRoute('user.edit') }}{{ Nav::isRoute('alluser.index') }} {{ Nav::isRoute('alluser.add') }} {{ Nav::isRoute('alluser.edit') }}{{ Nav::isRoute('allinstructor.index') }} {{ Nav::isRoute('allinstructor.add') }} {{ Nav::isRoute('allinstructor.edit') }}">
                                <a href="javaScript:void();">
                                    <i class="feather icon-users text-secondary"></i><span>{{ __('Users') }}</span><i
                                        class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">

                                    <li>
                                        <a class="{{ Nav::isResource('user') }}"
                                            href="{{route('user.index')}}">{{ __('All Users') }}</a>
                                    </li>

                                    <li>
                                        <a class="{{ Nav::isResource('allusers') }}"
                                            href="{{route('allusers.index')}}">{{ __('All Students') }}</a>
                                    </li>
                                    <li>
                                        <a class="{{ Nav::isResource('allinstructor') }}"
                                            href="{{route('allinstructor.index')}}">{{ __('All Instructors') }}</a>
                                    </li>

                                </ul>
                            </li>
                            <li
                                class="{{ Nav::isResource('plan/subscribe/settings') }} {{ Nav::isResource('subscription/plan') }}  {{ Nav::isRoute('all.instructor') }} {{ Nav::isResource('requestinstructor') }}">
                                <a href="javaScript:void();">
                                    <i
                                        class="feather icon-user text-secondary"></i><span>{{ __('adminstaticword.Instructors') }}</span><i
                                        class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    <li class="{{ Nav::isRoute('all.instructor') }}"><a
                                            href="{{route('all.instructor')}}">{{ __('adminstaticword.All') }}
                                            {{ __('adminstaticword.InstructorRequest') }}</a></li>
                                    <li class="{{ Nav::isResource('requestinstructor') }}"><a
                                            href="{{url('requestinstructor')}}">{{ __('adminstaticword.Pending') }}
                                            {{ __('Request') }}</a></li>
                                    <li class="{{ Nav::isResource('plan/subscribe/settings') }}"><a
                                            href="{{url('plan/subscribe/settings')}}">{{ __('adminstaticword.Instructor') }}
                                            {{ __('adminstaticword.Subscription') }}</a></li>
                                    @if(env('ENABLE_INSTRUCTOR_SUBS_SYSTEM') == 1)
                                    <li class="{{ Nav::isResource('subscription/plan') }}"><a
                                            href="{{url('subscription/plan')}}">{{ __('adminstaticword.InstructorPlan') }}</a>
                                    </li>
                                    @endif
                                    <!-- MultipleInstructor start  -->
                                    <li
                                        class="{{ Nav::isRoute('allrequestinvolve') }} {{ Nav::isRoute('involve.request.index') }} {{ Nav::isRoute('involve.request') }}">
                                        <a href="javaScript:void();">
                                            <i class=""></i> <span>{{ __('adminstaticword.MultipleInstructor') }}</span>
                                        </a>
                                        <ul class="vertical-submenu">

                                            <li class="{{ Nav::isRoute('allrequestinvolve') }}"><a
                                                    href="{{route('allrequestinvolve')}}">{{ __('adminstaticword.RequestToInvolve') }}</a>
                                            </li>
                                            <li class="{{ Nav::isRoute('involve.request.index') }}"><a
                                                    href="{{route('involve.request.index')}}">{{ __('adminstaticword.InvolvementRequests') }}</a>
                                            </li>
                                            <li class="{{ Nav::isRoute('involve.request') }}"><a
                                                    href="{{route('involve.request')}}">{{ __('adminstaticword.InvolvedInCourse') }}</a>
                                            </li>

                                        </ul>
                                    </li>
                                    <!-- MultipleInstructor end  -->
                                    <!-- InstructorPayout start  -->
                                    <li
                                        class="{{ Nav::isRoute('instructor.settings') }} {{ Nav::isRoute('admin.instructor') }} {{ Nav::isRoute('admin.completed') }}">
                                        <a href="javaScript:void();">
                                            <i class=""></i> <span>{{ __('adminstaticword.InstructorPayout') }}</span>
                                        </a>
                                        <ul class="vertical-submenu">

                                            <li class="{{ Nav::isRoute('instructor.settings') }}"><a
                                                    href="{{route('instructor.settings')}}">{{ __('adminstaticword.PayoutSettings') }}</a>
                                            </li>
                                            <li class="{{ Nav::isRoute('admin.instructor') }}"><a
                                                    href="{{route('admin.instructor')}}">{{ __('adminstaticword.PendingPayout') }}</a>
                                            </li>
                                            <li class="{{ Nav::isRoute('admin.completed') }}"><a
                                                    href="{{route('admin.completed')}}">{{ __('adminstaticword.CompletedPayout') }}</a>
                                            </li>


                                        </ul>
                                    </li>
                                    <!-- InstructorPayout end  -->
                                </ul>
                            </li>
                            <!-- user end -->
                            <li class="header">{{ __('Education') }}</li>
                            <!-- ====================Course start======================== -->
                            <li
                                class="{{ Nav::isResource('category') }} {{ Nav::isResource('subcategory') }} {{ Nav::isResource('childcategory') }} {{ Nav::isResource('course') }} {{ Nav::isResource('bundle') }} {{ Nav::isResource('courselang') }} {{ Nav::isResource('coursereview') }} {{ Nav::isRoute('assignment.view') }} {{ Nav::isResource('refundpolicy') }} {{ Nav::isResource('batch') }} {{ Nav::isRoute('quiz.review') }} {{ Nav::isResource('private-course') }} {{ Nav::isResource('admin/report/view') }} {{ Nav::isResource('user/question/report') }}">
                                <a href="javaScript:void();">
                                    <i
                                        class="feather icon-book text-secondary"></i><span>{{ __('adminstaticword.Course') }}</span><i
                                        class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    <!-- Category start  -->
                                    <li
                                        class="{{ Nav::isResource('category') }} {{ Nav::isResource('subcategory') }} {{ Nav::isResource('childcategory') }}">
                                        <a href="javaScript:void();">
                                            <i class=""></i> <span>{{ __('adminstaticword.Category') }}</span><i
                                                class="feather icon-chevron-right"></i>
                                        </a>
                                        <ul class="vertical-submenu">

                                            <li class="{{ Nav::isResource('category') }}"><a
                                                    href="{{url('category')}}">{{ __('adminstaticword.Category') }}</a>
                                            </li>
                                            <li class="{{ Nav::isResource('subcategory') }}"><a
                                                    href="{{url('subcategory')}}">{{ __('adminstaticword.SubCategory') }}</a>
                                            </li>
                                            <li class="{{ Nav::isResource('childcategory') }}"><a
                                                    href="{{url('childcategory')}}">{{ __('adminstaticword.ChildCategory') }}</a>
                                            </li>

                                        </ul>
                                    </li>


                                    <!-- Category end  -->
                                    <li class="{{ Nav::isResource('course') }}"><a
                                            href="{{url('course')}}"><span>{{ __('adminstaticword.Courses') }}</span></a>
                                    </li>
                                    <li class="{{ Nav::isResource('bundle') }}"><a
                                            href="{{url('bundle')}}"><span>{{ __('adminstaticword.BundleCourse') }}</span></a>
                                    </li>
                                    <li class="{{ Nav::isResource('courselang') }}"><a
                                            href="{{url('courselang')}}"><span>{{ __('adminstaticword.CourseLanguage') }}</span></a>
                                    </li>
                                    <li class="{{ Nav::isResource('coursereview') }}"><a
                                            href="{{url('coursereview')}}"><span>{{ __('adminstaticword.CourseReview') }}</span></a>
                                    </li>
                                    @if($gsetting->assignment_enable == 1)
                                    <li class="{{ Nav::isRoute('assignment.view') }}"><a
                                            href="{{route('assignment.view')}}"><span>{{ __('adminstaticword.Assignment') }}</span></a>
                                    </li>
                                    @endif
                                    <li class="{{ Nav::isResource('refundpolicy') }}"><a
                                            href="{{url('refundpolicy')}}"><span>{{ __('adminstaticword.RefundPolicy') }}</span></a>
                                    </li>
                                    <li class="{{ Nav::isResource('batch') }}"><a
                                            href="{{url('batch')}}"><span>{{ __('adminstaticword.Batch') }}</span></a>
                                    </li>
                                    <li class="{{ Nav::isRoute('quiz.review') }}"><a
                                            href="{{route('quiz.review')}}"><span>{{ __('adminstaticword.QuizReview') }}</span></a>
                                    </li>
                                    <li class="{{ Nav::isResource('private-course') }}"><a
                                            href="{{url('private-course')}}"><span>{{ __('adminstaticword.PrivateCourse') }}</span></a>
                                    </li>

                                    <li class="{{ Nav::isResource('admin/report/view') }}">
                                        <a href="{{url('admin/report/view')}}">{{ __('adminstaticword.Reported') }}
                                            {{ __('Course') }}
                                        </a>
                                    </li>

                                    <li class="{{ Nav::isResource('user/question/report') }}">
                                        <a href="{{url('user/question/report')}}">{{ __('adminstaticword.Reported') }}
                                            {{ __('Question') }}</a>
                                    </li>
                                </ul>
                            </li>
                            <!--=================== Course end====================================  -->
                            <!-- ====================Meetings start======================== -->
                            <li
                                class="{{ Nav::isRoute('meeting.create') }} {{ Nav::isRoute('zoom.show') }} {{ Nav::isRoute('zoom.edit') }} {{ Nav::isRoute('zoom.setting') }} {{ Nav::isRoute('zoom.index') }} {{ Nav::isRoute('meeting.show') }} {{ Nav::isRoute('bbl.setting') }} {{ Nav::isRoute('bbl.all.meeting') }} {{ Nav::isRoute('download.meeting') }} {{ Nav::isRoute('googlemeet.setting') }} {{ Nav::isRoute('googlemeet.index') }} {{ Nav::isRoute('googlemeet.allgooglemeeting') }} {{ Nav::isRoute('jitsi.dashboard') }} {{ Nav::isRoute('jitsi.create') }} {{ Nav::isResource('meeting-recordings') }}">
                                <a href="javaScript:void();">
                                    <i class="feather icon-clock text-secondary"></i>
                                    <span>{{ __('adminstaticword.Meetings') }}</span><i
                                        class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    <!-- ZoomLiveMeetings start  -->
                                    @if(isset($zoom_enable) && $zoom_enable == 1)
                                    <li
                                        class="{{ Nav::isRoute('meeting.create') }} {{ Nav::isRoute('zoom.show') }} {{ Nav::isRoute('zoom.edit') }} {{ Nav::isRoute('zoom.setting') }} {{ Nav::isRoute('zoom.index') }} {{ Nav::isRoute('meeting.show') }}">
                                        <a href="javaScript:void();">
                                            <i class=""></i> <span>{{ __('Zoom Meetings') }}</span><i
                                                class="feather icon-chevron-right"></i>
                                        </a>
                                        <ul class="vertical-submenu">
                                            <li class="{{ Nav::isRoute('zoom.setting') }}"><a
                                                    href="{{route('zoom.setting')}}">{{ __('Settings') }}</a>
                                            </li>
                                            <li
                                                class="{{ Nav::isRoute('zoom.index') }} {{ Nav::isRoute('zoom.show') }} {{ Nav::isRoute('zoom.edit') }} {{ Nav::isRoute('meeting.create') }}">
                                                <a href="{{route('zoom.index')}}">{{ __('Dashboard') }}</a>
                                            </li>
                                            <li class="{{ Nav::isRoute('meeting.show') }}"><a
                                                    href="{{route('meeting.show')}}">{{ __('adminstaticword.AllMeetings') }}</a>
                                            </li>

                                        </ul>
                                    </li>
                                    @endif
                                    <!-- ZoomLiveMeetings end  -->
                                    <!-- BigBlueMeetings start  -->
                                    @if(isset($gsetting) && $gsetting->bbl_enable == 1)
                                    <li
                                        class="{{ Nav::isRoute('bbl.setting') }} {{ Nav::isRoute('bbl.all.meeting') }} {{ Nav::isRoute('download.meeting') }}">
                                        <a href="javaScript:void();">
                                            <i class=""></i> <span>{{ __('Big Blue') }}</span><i
                                                class="feather icon-chevron-right"></i>
                                        </a>
                                        <ul class="vertical-submenu">

                                            <li class="{{ Nav::isRoute('bbl.setting') }}"><a
                                                    href="{{ route('bbl.setting') }}">{{ __('Settings') }}</a>
                                            </li>
                                            <li class="{{ Nav::isRoute('bbl.all.meeting') }}"><a
                                                    href="{{ route('bbl.all.meeting') }}">{{ __('adminstaticword.ListMeetings') }}</a>
                                            </li>
                                            <li class="{{ Nav::isRoute('download.meeting') }}"><a
                                                    href="{{ route('download.meeting') }}">{{ __('Recorded') }}</a>
                                            </li>
                                        </ul>
                                    </li>
                                    @endif
                                    <!-- BigBlueMeetings end  -->

                                    <!-- Google Meet Meeting start  -->
                                    @if(isset($gsetting) && $gsetting->googlemeet_enable == 1)
                                    <li
                                        class="{{ Nav::isRoute('googlemeet.setting') }} {{ Nav::isRoute('googlemeet.index') }} {{ Nav::isRoute('googlemeet.allgooglemeeting') }}">
                                        <a href="javaScript:void();">
                                            <i class=""></i> <span>{{ __('Google Meet') }}</span><i
                                                class="feather icon-chevron-right"></i>
                                        </a>
                                        <ul class="vertical-submenu">

                                            <li class="{{ Nav::isRoute('googlemeet.setting') }}"><a
                                                    href="{{route('googlemeet.setting')}}">{{ __('Settings') }}</a>
                                            </li>
                                            <li class="{{ Nav::isRoute('googlemeet.index') }}"><a
                                                    href="{{route('googlemeet.index')}}">{{ __('Dashboard') }}</a>
                                            </li>
                                            <li class="{{ Nav::isRoute('googlemeet.allgooglemeeting') }}"><a
                                                    href="{{route('googlemeet.allgooglemeeting')}}">{{ __('adminstaticword.AllMeetings') }}</a>
                                            </li>

                                        </ul>
                                    </li>
                                    @endif
                                    <!-- Google Meet Meeting end  -->

                                    <!-- Jitsi Meeting start -->
                                    @if(isset($gsetting) && $gsetting->jitsimeet_enable == 1)
                                    <li
                                        class="{{ Nav::isRoute('jitsi.dashboard') }} {{ Nav::isRoute('jitsi.create') }}">
                                        <a href="javaScript:void();">
                                            <i class=""></i> <span>{{ __('Jitsi Meeting') }}</span><i
                                                class="feather icon-chevron-right"></i>
                                        </a>
                                        <ul class="vertical-submenu">
                                            <li class="{{ Nav::isRoute('jitsi.dashboard') }}"><a
                                                    href="{{ route('jitsi.dashboard') }}">{{ __('Dashboard') }}</a></li>
                                        </ul>
                                    </li>
                                    @endif

                                    @if(Module::find('Googleclassroom') && Module::find('googleclassroom')->isEnabled())
                                    @include('googleclassroom::layouts.admin_sidebar_menu')
                                    @endif
                                    <!-- Jitsi Meeting end -->
                                    <li class="{{ Nav::isResource('meeting-recordings') }}"><a
                                            href="{{url('meeting-recordings')}}"><span>{{ __('adminstaticword.MeetingRecordings') }}</span></a>
                                    </li>

                                </ul>
                            </li>
                            <li><a href="{{url('institute')}}"><i
                                        class="feather icon-grid text-secondary"></i><span>{{ __('Institute') }}</span></a>
                            </li>
                            @if(Module::has('Certificate') && Module::find('Certificate')->isEnabled())
                            @include('certificate::admin.sidebar_menu')
                            @endif

                            <li class="{{ Nav::isRoute('certificate.index') }}"><a
                                    href="{{route('certificate.index')}}">
                                    <i
                                        class="feather icon-help-circle text-secondary"></i><span>{{ __('Certificate Verify') }}</span>
                                </a>
                            </li>

                         

                            <!--===================meeting end====================================  -->
                            <!-- ====================instructor start======================== -->

                            <!--===================instructor end====================================  -->
                            <li class="header">{{ __('Marketing') }}</li>
                            <li class="{{ Nav::isResource('coupon') }}"><a href="{{url('coupon')}}"><i
                                        class="feather icon-award text-secondary"></i><span>{{ __('adminstaticword.Coupon') }}</span></a>
                            </li>
                            <li class="{{ Nav::isRoute('follower.view') }}"><a href="{{route('follower.view')}}"><i
                                        class="feather icon-help-circle text-secondary"></i><span>{{ __('Followers') }}</span></a>
                            </li>

                            <li
                                class="{{ Nav::isRoute('save.affiliates') }} {{ Nav::isRoute('wallet.settings') }} {{ Nav::isRoute('wallet.transactions') }}">
                                <a href="javaScript:void();">
                                    <i
                                        class="feather icon-dollar-sign text-secondary"></i><span>{{ __('adminstaticword.Affiliate&Wallet') }}</span><i
                                        class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">

                                    <li class="{{ Nav::isRoute('save.affiliates') }}">
                                        <a href="{{route('save.affiliates')}}">{{ __('adminstaticword.Affiliate') }}</a>
                                    </li>

                                    <li
                                        class="{{ Nav::isRoute('wallet.settings') }} {{ Nav::isRoute('wallet.transactions') }}">
                                        <a href="javaScript:void();">

                                            <span>{{ __('adminstaticword.Wallet') }}</span>

                                        </a>
                                        <ul class="vertical-submenu">
                                            <li class="{{ Nav::isRoute('wallet.settings') }}"><a
                                                    href="{{route('wallet.settings')}}">{{ __('adminstaticword.Wallet') }}
                                                    {{ __('adminstaticword.Setting') }}</a></li>
                                            <li class="{{ Nav::isRoute('wallet.transactions') }}"><a
                                                    href="{{route('wallet.transactions')}}">{{ __('adminstaticword.Wallet') }}
                                                    {{ __('adminstaticword.Transactions') }}</a></li>

                                        </ul>
                                    </li>

                                </ul>
                            </li>
                            <!-- PushNotification -->
                            <li class="{{ Nav::isRoute('onesignal.settings') }}"><a
                                    href="{{route('onesignal.settings')}}"><i
                                        class="feather icon-navigation text-secondary"></i><span>{{ __('adminstaticword.PushNotification') }}</span></a>
                            </li>



                            <li class="{{ Nav::isResource('admin/flash-sales') }}"><a
                                    href="{{url('admin/flash-sales')}}"><i
                                        class="feather icon-clock text-secondary"></i>
                                    <span>{{ __('Flash Deals') }}</span></a>
                            </li>



                            <!-- attandance -->
                            @if(isset($gsetting) && $gsetting->attandance_enable == 1)
                            <li class="{{ Nav::isResource('attandance') }}"><a href="{{url('attandance')}}"><i
                                        class="feather icon-user text-secondary"></i><span>{{ __('adminstaticword.Attandance') }}</span></a>
                            </li>
                            @endif

                            <!-- coupon -->

                            <li class="header">{{ __('Financial') }}</li>

                            <!-- order -->
                            <li class="{{ Nav::isResource('order') }}"><a href="{{url('order')}}"><i
                                        class="feather icon-shopping-cart text-secondary"></i><span>{{ __('adminstaticword.Order') }}</span></a>
                            </li>

                            <!-- order -->


                            <li class="header">{{ __('Content') }}</li>


                            <li class="{{ Nav::isResource('blog') }}">
                                <a href="{{url('blog')}}"><i class="feather icon-message-square"></i>
                                    <span>{{ __('Blogs') }}</span>
                                </a>
                            </li>
                            <!-- pages start -->
                            <li class="{{ Nav::isResource('page') }}"><a
                                    href="{{url('page')}}"><i class="feather icon-file-text"></i><span>{{ __('Pages') }}</span></a> </li>
                            <!-- pages end -->
                            <!-- report start  -->
                            <li
                                class="{{ Nav::isResource('user/course/report') }} {{ Nav::isResource('user/question/report') }}{{url('show/progress/report')}} {{ Nav::isResource('show/quiz/report') }}">
                                <a href="javaScript:void();">
                                    <i
                                        class="feather icon-file-text text-secondary"></i><span>{{ __('adminstaticword.Report') }}</span><i
                                        class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">


                                    <li class="{{ Nav::isResource('show/quiz/report') }}">
                                        <a href="{{url('show/quiz/report')}}">{{ __('Quiz') }} {{ __('Report') }} </a>
                                    </li>
                                    <li class="{{ Nav::isResource('show/progress/report') }}">
                                        <a href="{{url('show/progress/report')}}">{{ __('Progress') }}
                                            {{ __('Report') }}</a>
                                    </li>

                                    <!-- revenue report start  -->
                                    <li
                                        class="{{ Nav::isRoute('admin.revenue.report') }} {{ Nav::isRoute('instructor.revenue.report') }}{{ Nav::isResource('device-logs') }}">
                                        <a href="javaScript:void();"><span>{{ __('adminstaticword.Revenue') }}
                                                {{ __('adminstaticword.Report') }}</span><i
                                                class="feather icon-chevron-right"></i>
                                        </a>
                                        <ul class="vertical-submenu">

                                            <li class="{{ Nav::isRoute('admin.revenue.report') }}">
                                                <a
                                                    href="{{route('admin.revenue.report')}}">{{ __('adminstaticword.AdminRevenue') }}</a>
                                            </li>

                                            <li class="{{ Nav::isRoute('instructor.revenue.report') }}">
                                                <a
                                                    href="{{route('instructor.revenue.report')}}">{{ __('adminstaticword.InstructorRevenue') }}</a>
                                            </li>

                                        </ul>
                                    </li>


                                    <li class="{{ Nav::isResource('admin/report/view') }}">
                                        <a href="{{ route('order.report') }}">
                                            {{ __('Financial reports') }} </a>
                                    </li>

                                    <li class="{{ Nav::isResource('device-logs') }}">
                                        <a href="{{url('device-logs')}}">{{ __('Device History') }} </a>
                                    </li>

                                </ul>
                            </li>
                            <!-- report end -->
                            <!-- forum -->
                            @if(Module::find('forum') && Module::find('forum')->isEnabled())
                            @include('forum::layouts.admin_sidebar_menu')
                            @endif
                            <li class="{{ Nav::isRoute('about.page') }}">
                                <a href="{{route('about.page')}}"><i
                                        class="feather icon-external-link text-secondary"></i>{{ __('adminstaticword.About') }}</a>
                            </li>
                            <!-- faq start  -->
                            <li class="{{ Nav::isResource('faq') }} {{ Nav::isResource('faqinstructor') }}">
                                <a href="javaScript:void();">
                                    <i
                                        class="feather icon-help-circle text-secondary"></i><span>{{ __('adminstaticword.Faq') }}</span><i
                                        class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">

                                    <li class="{{ Nav::isResource('faq') }}">
                                        <a href="{{url('faq')}}">{{ __('adminstaticword.FaqStudent') }}</a>
                                    </li>

                                    <li class="{{ Nav::isResource('faqinstructor') }}">
                                        <a href="{{url('faqinstructor')}}">{{ __('adminstaticword.FaqInstructor') }}</a>
                                    </li>

                                </ul>
                            </li>
                            <li class="{{ Nav::isRoute('careers.page') }}">
                                <a href="{{route('careers.page')}}"><i
                                        class="feather icon-sidebar text-secondary"></i>{{ __('adminstaticword.Career') }}</a>
                            </li>
                            <!-- faq end -->

                            <!-- location start -->
                            <li
                                class="{{ Nav::isResource('admin/country') }} {{ Nav::isResource('admin/state') }} {{ Nav::isResource('admin/city') }}">
                                <a href="javaScript:void();">
                                    <i class="fa fa-map-marker text-secondary"></i><span>{{ __('Locations') }}</span><i
                                        class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">

                                    <li class="{{ Nav::isResource('admin/country') }}"><a
                                            href="{{url('admin/country')}}">{{ __('adminstaticword.Country') }}</a></li>
                                    <li class="{{ Nav::isResource('admin/state') }}"><a
                                            href="{{url('admin/state')}}">{{ __('adminstaticword.State') }}</a></li>
                                    <li class="{{ Nav::isResource('admin/city') }}"><a
                                            href="{{url('admin/city')}}">{{ __('adminstaticword.City') }}</a></li>

                                </ul>
                            </li>


                            <!-- contact us start -->
                            <li class="{{ Nav::isResource('usermessage') }}"><a href="{{url('usermessage')}}"><i
                                        class="feather icon-phone-call text-secondary"></i><span>{{ __('adminstaticword.ContactUs') }}</span>
                                </a>
                            </li>
                            @if(Module::has('Resume') && Module::find('Resume')->isEnabled())
                            @include('resume::front.job.admin.icon')
                            @endif
                            <!-- contact us end -->
                            <!-- location end -->
                            <li class="header">{{ __('Setting') }}</li>
                            <li class="{{ Nav::isRoute('get.api.key') }}">
                                <a href="{{route('get.api.key')}}"><i
                                class="feather icon-share text-secondary"></i><span>{{ __('adminstaticword.GetAPIKeys') }}</span></a>
                            </li>
                            <li class="{{ Nav::isRoute('currency.index') }}"><a href="{{route('currency.index')}}"><i
                                        class="feather icon-dollar-sign text-secondary"></i><span>{{ __('adminstaticword.Currency') }}</span></a>
                            </li>
                             
                            <li class="{{ Nav::isRoute('themesettings.index') }}">
                                <a href="{{route('themesettings.index')}}">
                                    <i class="feather icon-airplay text-secondary"></i>
                                    <span>{{ __('adminstaticword.Themes') }}</span>
                                </a>
                            </li>
                            
                            <!-- front setting start  -->
                            <li
                                class="{{ Nav::isResource('testimonial') }} {{ Nav::isResource('advertisement') }} {{ Nav::isResource('slider') }} {{ Nav::isResource('facts') }} {{ Nav::isRoute('category.slider') }} {{ Nav::isResource('getstarted') }} {{ Nav::isResource('trusted') }} {{ Nav::isRoute('widget.setting') }} {{ Nav::isRoute('terms') }} {{ Nav::isResource('directory') }}">
                                <a href="javaScript:void();">
                                    <i
                                        class="feather icon-monitor text-secondary"></i><span>{{ __('adminstaticword.FrontSetting') }}</span><i
                                        class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    <li class="{{ Nav::isResource('testimonial') }}"><a
                                            href="{{url('testimonial')}}"><span>{{ __('adminstaticword.Testimonial') }}</span></a>
                                    </li>
                                    <li class="{{ Nav::isResource('advertisement') }}"><a
                                            href="{{url('advertisement')}}"><span>{{ __('adminstaticword.Advertisement')}}</span></a>
                                    </li>
                                    <li class="{{ Nav::isResource('slider') }}"><a
                                            href="{{url('slider')}}"><span>{{ __('adminstaticword.Slider') }}</span></a>
                                    </li>
                                    <li class="{{ Nav::isResource('facts') }}"><a
                                            href="{{url('facts')}}"><span>{{ __('Fact Slider') }}</span></a>
                                    </li>
                                    <li class="{{ Nav::isRoute('category.slider') }}"><a
                                            href="{{route('category.slider')}}"><span>{{ __('adminstaticword.CategorySlider') }}</span></a>
                                    </li>

                                    <li class="{{ Nav::isResource('getstarted') }}"><a
                                            href="{{url('getstarted')}}">{{ __('adminstaticword.GetStarted') }}</a></li>
                                    <li class="{{ Nav::isResource('trusted') }}"><a
                                            href="{{url('trusted')}}"><span>{{ __('adminstaticword.TrustedSlider') }}</span></a>
                                    </li>
                                    <li class="{{ Nav::isRoute('widget.setting') }}"><a
                                            href="{{route('widget.setting')}}">{{ __('Widget') }}</a>
                                    </li>
                                    <li class="{{ Nav::isResource('directory') }}"><a
                                            href="{{url('directory')}}"><span>{{ __('adminstaticword.Seo') }}
                                                {{ __('adminstaticword.Directory') }}</span></a></li>

                                    <li class="{{ Nav::isRoute('comingsoon.page') }}">
                                        <a
                                            href="{{route('comingsoon.page')}}">{{ __('adminstaticword.ComingSoon') }}</a>
                                    </li>
                                    <li class="{{ Nav::isRoute('termscondition') }}">
                                        <a href="{{route('termscondition')}}">{{ __('adminstaticword.Terms&Condition') }}
                                        </a>
                                    </li>
                                    <li class="{{ Nav::isRoute('policy') }}">
                                        <a href="{{route('policy')}}">{{ __('adminstaticword.PrivacyPolicy') }}</a>
                                    </li>
                                    <li class="{{ Nav::isRoute('coloroption.view') }}">
                                        <a href="{{url('admin/coloroption')}}">{{ __('Color & Theme') }}</a>
                                    </li>

                                    <li class="{{ Nav::isRoute('invoice/settings') }}">
                                        <a href="{{ url('invoice/settings') }}">{{ __('Invoice') }}{{ __('') }}</a>
                                    </li>

                                </ul>
                            </li>

                            <!-- front setting end -->
                            <!-- site setting start  -->
                            <li
                                class="{{ Nav::isRoute('gen.set') }} {{ Nav::isRoute('careers.page') }}  {{ Nav::isRoute('termscondition') }} {{ Nav::isRoute('policy') }}  {{ Nav::isRoute('show.pwa') }} {{ Nav::isRoute('adsense') }} {{ Nav::isRoute('ipblock.view') }}   {{ Nav::isRoute('twilio.settings') }} {{ Nav::isRoute('show.sitemap') }} {{ Nav::isRoute('show.lang') }}">
                                <a href="javaScript:void();">
                                    <i
                                        class="feather icon-settings text-secondary"></i><span>{{ __('adminstaticword.SiteSetting') }}</span><i
                                        class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">

                                    <li class="{{ Nav::isRoute('gen.set') }}">
                                        <a href="{{route('gen.set')}}">{{ __('adminstaticword.Setting') }}</a>
                                    </li>
                                    <li class="{{ Nav::isRoute('show.pwa') }}">
                                        <a href="{{route('show.pwa')}}">{{ __('PWA') }}</a>
                                    </li>
                                    <li class="{{ Nav::isRoute('adsense') }}">
                                        <a href="{{url('/admin/adsensesetting')}}">{{ __('Adsense') }}</a>
                                    </li>
                                    @if(isset($gsetting) && $gsetting->ipblock_enable == 1)
                                    <li class="{{ Nav::isRoute('ipblock.view') }}">
                                        <a
                                            href="{{url('admin/ipblock')}}">{{ __('adminstaticword.IPBlockSettings') }}</a>
                                    </li>
                                    @endif
                                    <li class="{{ Nav::isRoute('twilio.settings') }}">
                                        <a href="{{route('twilio.settings')}}">{{ __('Twilio') }}</a>
                                    </li>
                                    <li class="{{ Nav::isRoute('show.sitemap') }}">
                                        <a href="{{route('show.sitemap')}}">{{ __('adminstaticword.SiteMap') }}</a>
                                    </li>

                                    <li class="{{ Nav::isRoute('show.lang') }}">
                                        <a href="{{route('show.lang')}}">{{ __('adminstaticword.Language') }}</a>
                                    </li>
                                    <li class="{{ Nav::isRoute('maileclipse/mailables') }}">
                                        <a href="{{ url('maileclipse/mailables') }}">{{ __('Email') }}{{ __('') }}</a>
                                    </li>


                                </ul>
                            </li>
                            <!-- site setting end -->
                            <!-- payment setting start -->
                            <li
                                class=" {{ Nav::isRoute('api.setApiView') }}{{ Nav::isRoute('bank.transfer') }}{{ Nav::isResource('manualpayment') }} ">
                                <a href="javaScript:void();">
                                    <i
                                        class="feather icon-dollar-sign text-secondary"></i><span>{{ __('Payment Setting') }}</span><i
                                        class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">

                                    <li class="{{ Nav::isRoute('api.setApiView') }}">
                                        <a href="{{route('api.setApiView')}}">{{ __('Credentials') }}</a>
                                    </li>

                                    @if(Module::has('MPesa') && Module::find('MPesa')->isEnabled())
                                    @include('mpesa::admin.sidebar')
                                    @endif

                                    <li class="{{ Nav::isRoute('bank.transfer') }}">
                                        <a href="{{route('bank.transfer')}}">{{ __('adminstaticword.BankDetails') }}</a>
                                    </li>
                                    <li class="{{ Nav::isResource('manualpayment') }}">
                                        <a href="{{url('manualpayment')}}">{{ __('Manual Payment') }}</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- payment setting start end -->
                            <!-- player setting start -->
                            <li
                                class="{{ Nav::isRoute('player.set') }} {{ Nav::isRoute('ads') }} {{ Nav::isRoute('ad.setting') }}">
                                <a href="javaScript:void();">
                                    <i
                                        class="feather icon-play-circle text-secondary"></i><span>{{ __('adminstaticword.PlayerSettings') }}</span><i
                                        class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">

                                    <li class="{{ Nav::isRoute('player.set') }}"><a
                                            href="{{route('player.set')}}">{{ __('adminstaticword.PlayerCustomization') }}</a>
                                    </li>

                                    <li class="{{ Nav::isRoute('ads') }}"><a href="{{url('admin/ads')}}"
                                            title="Create ad">{{ __('adminstaticword.Advertise') }}</a></li>
                                    @php $ads = App\Ads::all(); @endphp
                                    @if($ads->count()>0)
                                    <li class="{{ Nav::isRoute('ad.setting') }}"><a href="{{url('admin/ads/setting')}}"
                                            title="Ad Settings">{{ __('adminstaticword.AdvertiseSettings') }}</a></li>
                                    @endif

                                </ul>
                            </li>
                            <!-- player setting start end -->
                            @if(isset($gsetting) && $gsetting->activity_enable == '1')
                            <li class="{{ Nav::isRoute('activity.index') }}"><a href="{{route('activity.index')}}">
                                    <i
                                        class="feather icon-help-circle text-secondary"></i><span>{{ __('adminstaticword.ActivityLog') }}</span>
                                </a></li>

                            @endif
                            <li class="header">{{ __('Support') }}</li>
                            <!-- help & support start  -->
                            <li class="{{ Nav::isResource('admin-addon') }}">
                                <a href="{{url('admin/addon')}}"> <i
                                        class="feather icon-move  text-secondary"></i><span>{{ __('adminstaticword.Addon') }}</span>
                                    {{ __('adminstaticword.Manager') }}</a>
                            </li>
                            <li class="{{ Nav::isRoute('update.process') }}">
                                <a href="{{route('update.process')}}"><i class="feather icon-share text-secondary"></i><span>{{ __('adminstaticword.UpdateProcess') }}</span></a>
                            </li>
                            <li
                                class="{{ Nav::isRoute('import.view') }} {{ Nav::isRoute('database.backup') }} ">
                                <a href="javaScript:void();">
                                    <i class="feather icon-help-circle text-secondary"></i><span>{{ __('adminstaticword.Help&Support') }}</span><i
                                        class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">

                                    <li class="{{ Nav::isRoute('import.view') }}">
                                        <a href="{{route('import.view')}}">{{ __('adminstaticword.ImportDemo') }}</a>
                                    </li>
                                    <li class="{{ Nav::isRoute('database.backup') }}">
                                        <a
                                            href="{{route('database.backup')}}">{{ __('adminstaticword.DatabaseBackup') }}</a>
                                    </li>
                                   

                                    <li class="{{ Nav::isRoute('remove.public') }}">
                                        <a
                                            href="{{route('remove.public')}}">{{ __('adminstaticword.RemovePublic') }}</a>
                                    </li>
                                    <li class="{{ Nav::isRoute('clear-cache') }}">
                                        <a href="{{url('clear-cache')}}">{{ __('adminstaticword.ClearCache') }}</a>
                                    </li>


                                </ul>
                            </li>
                            <!-- help & support end -->



                            </li>
                        </ul>
                        </li>


                        </ul>
                        @endif
                    </div>

                </div>

            </div>
        </div>
        <!-- End Navigationbar -->
    </div>
    <!-- End Sidebar -->
</div>