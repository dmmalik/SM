<?php

namespace App\Http\Controllers\auth;
use App\school;
use App\Http\Controllers\Session;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\SmExam;
use App\SmNews;
use App\SmClass;
use App\SmEvent;
use App\SmStaff;
use App\SmCourse;
use App\SmSchool;
use App\SmSection;
use App\SmStudent;
use App\SmSubject;
use App\SmVisitor;
use App\tableList;
use App\SmExamType;
use App\SmNewsPage;
use App\SmAboutPage;
use App\SmCoursePage;
use App\SmCustomLink;
use App\ApiBaseMethod;
use App\SmContactPage;
use App\SmNoticeBoard;
use App\SmTestimonial;
use App\SmContactMessage;
use App\SmGeneralSettings;
use App\SmHomePageSetting;
use App\SmSocialMediaIcon;
use Illuminate\Http\Request;
use App\SmFrontendPersmission;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Redirect;
use App\SmEmailSetting;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($school_Id)
    {
        try {
            $school_data=SmGeneralSettings::where('school_code',$school_Id)->first();
            $general = SmGeneralSettings::where('school_code',$school_Id)->first();
            $registerlink=$general->school_link;
            $homePage = SmHomePageSetting::where('school_code',$school_Id)->first();
            if($homePage == null){
                $homePage = SmHomePageSetting::find(1);
            }
            $news=SmNews::where('school_id',$school_data->school_id)->get();
            
            $testimonial = SmTestimonial::where('school_id',$school_data->school_id)->get();
            $events = SmEvent::where('school_id',$school_data->school_id)->get();
            $academics = SmCourse::where('school_id',$school_data->school_id)->limit(3)->get();
            $notice_board = SmNoticeBoard::where('school_id', $school_data->school_id)->orderBy('created_at', 'DESC')->take(3)->get();
            return view('frontEnd.dashBoard.school_front', compact('homePage','registerlink', 'news', 'testimonial', 'notice_board', 'events', 'academics'));
        } 
        catch (\Exception $e)
        {
            dd($e);
            Toastr::error('Operation Failed', 'Failed');
            return redirect('register_school')
            ->withInput()
            ->withErrors($e);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


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
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, School $school)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        //
    }
}
