<style>
    .footer-list ul {
        list-style: none;
        padding-left: 0;
        margin-bottom: 50px;
    }
    .footer-list ul li{
        display: block;
        margin-bottom: 10px;
        cursor: pointer;
    }
    .f_title {
        margin-bottom: 40px;
    }
    .f_title h4{
        color: #415094;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 0px;
    }
</style>

<?php
    $links = App\SmCustomLink::find(1);

    $social_icons = App\SmSocialMediaIcon::where('status', 1)->get();

    $setting = App\SmGeneralSettings::find(1);
    if (isset($setting->copyright_text)) {
        $copyright_text = $setting->copyright_text;
    } else {
        $copyright_text = 'Copyright © 2019 All rights reserved | This application is made with by Codethemes';
    }
    if (isset($setting->logo)) {
        $logo ='public/uploads/settings/logo.png';
    } else {
        $logo = 'public/uploads/settings/logo.png';
    }
    if (isset($setting->site_title) && !empty($setting->site_title)) {
        $site_title = $setting->site_title;
    } else {
        $site_title = 'Infix Edu ERP';
    }

    if (isset($setting->favicon)) {
        $favicon = $setting->favicon;
    } else {
        $favicon = 'public/backEnd/img/favicon.png';
    }


    $permisions = App\SmFrontendPersmission::where([['parent_id', 1], ['is_published', 1]])->get();
    $per = [];
    foreach ($permisions as $permision) {
        $per[$permision->name] = 1;
    }

    $ttl_rtl = $setting->ttl_rtl;
    $active_style = App\SmStyle::where('is_active', 1)->first();
?>

        <!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" @if(isset ($ttl_rtl ) && $ttl_rtl ==1) dir="rtl" class="rtl" @endif >

<head>
    <meta charset="utf-8"/>
    <meta name="viewport"
          content="Infix is 100+ unique feature enable school management software system. It can manage all type of school, academy and any educational institution"/>
    <link rel="icon" href="{{asset($favicon)}}" type="image/png"/>
    <title>{{ isset($page_title)? $page_title:$site_title }}</title>
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <!-- Bootstrap CSS -->
    @if(isset ($ttl_rtl ) && $ttl_rtl ==1)
        <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/rtl/bootstrap.min.css"/>
    @else
        <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap.css"/>
    @endif


    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/jquery-ui.css"/>


    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap-datepicker.min.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/themify-icons.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/nice-select.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/magnific-popup.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/fastselect.min.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/owl.carousel.min.css"/>
    <!-- main css -->


    @if(isset ($ttl_rtl ) && $ttl_rtl ==1)
        <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/rtl/style.css"/>
    @else
        <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/{{@$active_style->path_main_style}}"/>
    @endif

    {{-- <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/toastr.min.css" /> --}}
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/fullcalendar.min.css">
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/fullcalendar.print.css">


    <link rel="stylesheet" href="{{asset('public/')}}/frontend/css/infix.css"/>
    @stack('css')
</head>

<body class="client light">

<!--================ Start Header Menu Area =================-->
<header class="header-area">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container box-1420">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand" href="{{url('/')}}/home">
                    <img class="w-75" src="{{asset($logo)}}" alt="Infix Logo" style="max-width: 150px;">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="ti-menu"></span>
                </button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">
                        
                            <li class="nav-item  {{Request::path() == '/' ||  Request::path() == 'home'? 'active':''}} "><a
                                        class="nav-link" href="{{url('/')}}/home">Home</a></li>
                            <li class="nav-item {{Request::path() == 'about'? 'active':''}}"><a class="nav-link"
                                                                                                href="{{url('/')}}/about">About</a>
                       </li>
                       <!--     <li class="nav-item {{Request::path() == 'course'? 'active':''}}"><a class="nav-link"
                                                                                                href="{{url('/')}}/course">Course</a>
                            </li>-->
                            <li class="nav-item {{Request::path() == 'news-page'? 'active':''}}"><a class="nav-link"
                                                                                                    href="{{url('/')}}/news-page">News</a>
                            </li>
                            <li class="nav-item {{Request::path() == 'contact'? 'active':''}}"><a class="nav-link"
                                                                                                href="{{url('/')}}/contact">Contact</a>
                            </li>
                             <li class="nav-item {{Request::path() == 'login'? 'active':''}}"><a class="nav-link"
                                                                                            href="{{url('/')}}/register/{{$registerlink}}">Register User</a>
                            </li>
                            @if (Auth::user() =="")
                            <li class="nav-item {{Request::path() == 'login'? 'active':''}}"><a class="nav-link"
                                                                                                href="{{url('/')}}/student-login">Login</a>
                            </li>
                            @endif
                        @if (Auth::user() !="")
                            <li class="nav-item {{Request::path() == 'login'? 'active':''}}"><a class="nav-link"
                                                                                                href="{{url('/')}}/logout">Logout</a>
                            </li>
                            @endif
                            @if(App\SmGeneralSettings::isModule('ParentRegistration')== TRUE)
                                @php $is_registration_permission = DB::table('sm_registration_settings')->where('registration_permission',1)->first(); @endphp 
                                @if($is_registration_permission && $is_registration_permission->position==1)
                                    <li class="nav-item"><a class="nav-link"   href="{{url('/parentregistration/registration')}}">Student Registration</a></li>
                                @endif
                            @endif
                           
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <ul class="nav navbar-nav mr-auto search-bar">
                            <li class="">
                            </li>
                        </ul>
                    </ul>
                </div>

            </div>
        </nav>
    </div>
</header>
<!--================ End Header Menu Area =================-->
@yield('main_content')

<!--================Footer Area =================-->
<!--<footer class="footer_area section-gap-top">
    <div class="container">
        <div class="row footer_inner">

            @php
                                $custom_link=App\SmCustomLink::find(1);
                            @endphp
                            @if ($custom_link!='')
                                
                            
                            <div class="col-lg-3 col-sm-6">
                                <div class="footer-widget">
                                    <div class="f_title">
                                    <h4>{{ $custom_link->title1 }}</h4>
                                    </div>
                                    <div class="footer-list">
                                        <nav>
                                            <ul>
                                                @if(App\SmGeneralSettings::isModule('ParentRegistration')== TRUE)
                                                    @php $is_registration_permission = DB::table('sm_registration_settings')->where('registration_permission',1)->first(); @endphp 
                                                    @if($is_registration_permission && $is_registration_permission->position==2)
                                                        <li><a  href="{{url('/parentregistration/registration')}}">Student Registration</a></li>
                                                    @endif
                                                @endif
                                                @if ($custom_link->link_href1!='')
                                                  <li><a href="{{ $custom_link->link_href1 }}">{{ $custom_link->link_label1 }} </a></li>
                                                  
                                                @endif
                                                @if ($custom_link->link_href5!='')
                                                <li><a href="{{ $custom_link->link_href5 }}">{{ $custom_link->link_label5 }}</a></li>
                                                @endif
                                                @if ($custom_link->link_href9!='')
                                                    <li><a href="{{ $custom_link->link_href9 }}">{{ $custom_link->link_label9 }}</a></li>
                                                
                                                @endif
                                                @if ($custom_link->link_href13!='')
                                                      <li><a href="{{ $custom_link->link_href13 }}">{{ $custom_link->link_label13 }} </a></li>
                                                @endif
                                               
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="footer-widget">
                                    <div class="f_title">
                                        <h4>{{ $custom_link->title2 }}</h4>
                                    </div>
                                    <div class="footer-list">
                                        <nav>
                                            <ul>
c

                                                    @if ($custom_link->link_href2!='')
                                                    <li><a href="{{ $custom_link->link_href2}}">{{ $custom_link->link_label2}}</a></li>
                                                
                                                @endif
                                                @if ($custom_link->link_href6!='')
                                                <li><a href="{{ url($custom_link->link_href6) }}">{{ $custom_link->link_label6 }}</a></li>
                                      
                                                @endif
                                                @if ($custom_link->link_href10!='')
                                                <li><a href="{{ $custom_link->link_href10 }}">{{ $custom_link->link_label10 }}</a></li>
                                      
                                                @endif
                                                @if ($custom_link->link_href14!='')
                                                <li><a href="{{ $custom_link->link_href14 }}">{{ $custom_link->link_label14 }}</a></li>
                                           
                                               @endif
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="footer-widget">
                                    <div class="f_title">
                                        <h4>{{ $custom_link->title3 }}</h4>
                                    </div>
                                    <div class="footer-list">
                                        <nav>
                                            <ul>
                                             @if ($custom_link->link_href3!='')
                                                    <li><a href="{{ $custom_link->link_href3}}">{{ $custom_link->link_label3}}</a></li>
                                               @endif
                                                    @if ($custom_link->link_href7!='')
                                                        <li><a href="{{ $custom_link->link_href7 }}">{{ $custom_link->link_label7 }}</a></li>
                                                    @endif
                                                    @if ($custom_link->link_href11!='')
                                                        <li><a href="{{ $custom_link->link_href11 }}">{{ $custom_link->link_label11 }}</a></li>
                                                    @endif
                                                    @if ($custom_link->link_href15!='')
                                                        <li><a href="{{ $custom_link->link_href15 }}">{{ $custom_link->link_label15 }}</a></li>
                                                    @endif
                                                
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="footer-widget">
                                    <div class="f_title">
                                        <h4>{{ $custom_link->title4 }}</h4>
                                    </div>
                                    <div class="footer-list">
                                        <nav>
                                            <ul>
                                             @if ($custom_link->link_href4!='')
                                                    <li><a href="{{ $custom_link->link_href4}}">{{ $custom_link->link_label4}}</a></li>
                                               @endif
                                                    @if ($custom_link->link_href8!='')
                                                        <li><a href="{{ $custom_link->link_href8 }}">{{ $custom_link->link_label8 }}</a></li>
                                                    @endif
                                                    @if ($custom_link->link_href12!='')
                                                        <li><a href="{{ $custom_link->link_href12 }}">{{ $custom_link->link_label12 }}</a></li>
                                                    @endif
                                                    @if ($custom_link->link_href16!='')
                                                        <li><a href="{{ $custom_link->link_href16 }}">{{ $custom_link->link_label16 }}</a></li>
                                                    @endif
                                               
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            @endif
            

            {{-- @if(isset($per["Custom Links"]))
                @php
                    $url[1]=[1,2,3,4];
                    $url[2]=[5,6,7,8];
                    $url[3]=[9,10,11,12];
                    $url[4]=[13,14,15,16];
                    for($i=1; $i<=4; $i++){
                     $title ='title'.$i ;
                @endphp
                <div class="col-lg-3 col-sm-6">
                    <aside class="f_widget ab_widget">
                        <div class="f_title">
                            <h4>{{$links!=""?$links->$title:''}}</h4>
                        </div>
                        <ul>
                            @php
                                foreach($url[$i] as $j){
                                    $link_label ='link_label'.$j ;
                                    $link_href ='link_href'.$j ;
                            @endphp
                            <li>
                                <a href="{{$links !="" ? $links->$link_href:''}}"
                                   style="color: #828bb2"> {{$links !="" ? $links->$link_label:''}} </a>
                            </li>
                            @php } @endphp
                        </ul>
                    </aside>
                </div>
                @php } @endphp
            @endif --}}

        </div>
        <div class="row single-footer-widget">
            <div class="col-lg-8 col-md-9">
                <div class="copy_right_text">
                    <p>{!! $copyright_text !!}</p>
                </div>
            </div>

            @if(isset($per["Social Icons"]))
                <div class="col-lg-4 col-md-3">
                    <div class="social_widget">

                        @foreach($social_icons as $social_icon)
                            @if (@$social_icon->url != "")
                                <a href="{{@$social_icon->url}}"><i class="{{$social_icon->icon}}"></i></a>
                            @endif
                        @endforeach
                        

                        {{-- <a href="{{@$links->facebook_url}}"><i class="fa fa-facebook"></i></a>
                        <a href="{{@$links->twitter_url}}"><i class="fa fa-twitter"></i></a>
                        <a href="{{@$links->dribble_url}}"><i class="fa fa-dribbble"></i></a>
                        <a href="{{@$links->linkedin_url}}"><i class="fa fa-linkedin"></i></a> --}}


                    </div>
                </div>
            @endif
        </div>
    </div>
</footer>-->
<!--================End Footer Area =================-->

<script src="{{asset('public/backEnd/')}}/vendors/js/jquery-3.2.1.min.js">
</script>
<script src="{{asset('public/backEnd/')}}/vendors/js/jquery-ui.js">
</script>
<script src="{{asset('public/backEnd/')}}/vendors/js/popper.js">
</script>
<script src="{{asset('public/backEnd/')}}/vendors/js/bootstrap.min.js">
</script>
<script src="{{asset('public/backEnd/')}}/vendors/js/nice-select.min.js">
</script>
<script src="{{asset('public/backEnd/')}}/vendors/js/jquery.magnific-popup.min.js">
</script>
<script src="{{asset('public/backEnd/')}}/vendors/js/raphael-min.js">
</script>
<script src="{{asset('public/backEnd/')}}/vendors/js/morris.min.js">
</script>
<script src="{{asset('public/backEnd/')}}/vendors/js/owl.carousel.min.js"></script>
{{-- <script src="{{asset('public/backEnd/')}}/vendors/js/toastr.min.js"></script> --}}
<script src="{{asset('public/backEnd/')}}/vendors/js/moment.min.js"></script>
<script src="{{asset('public/backEnd/')}}/vendors/js/print/bootstrap-datetimepicker.min.js"></script>
<script src="{{asset('public/backEnd/')}}/vendors/js/bootstrap-datepicker.min.js"></script>
<!-- <script src="{{asset('public/backEnd/')}}/js/gmap3.min.js"></script> -->
<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCwzmSafhk_bBIdIy7MjwVIAVU1MgUmXY4"></script> -->

<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDs3mrTgrYd6_hJS50x4Sha1lPtS2T-_JA"></script>
<script src="{{asset('public/backEnd/')}}/js/main.js"></script>
<script src="{{asset('public/backEnd/')}}/js/custom.js"></script>
<script src="{{asset('public/backEnd/')}}/js/developer.js"></script>

@yield('script')

</body>
</html>



@push('css')
    <link rel="stylesheet" href="{{asset('public/')}}/frontend/css/new_style.css"/>
@endpush

@section('main_content')
<?php
    $css= "background: linear-gradient(0deg, rgba(124, 50, 255, 0.6), rgba(199, 56, 216, 0.6)), url(".url($homePage->image).") no-repeat center;    background-size: cover;";
?>

 <style type="text/css">
     .client .events-item .card .card-body .date {
        max-width: 90px !important; 
     }
 </style>

  @if(isset($per["Image Banner"]))
    <!--================ Home Banner Area =================-->
    <section class="container box-1420">
        <div class="home-banner-area" style="{{$css}}">
            <div class="banner-inner">
                <div class="banner-content">
                    <h5>{{$homePage->title}}</h5>
                    <h2>{{$homePage->long_title}}</h2>
                    <p>{{$homePage->short_description}}</p>
                    <a class="primary-btn fix-gr-bg semi-large" href="{{$homePage->link_url}}">{{$homePage->link_label}}</a>
                 </div>
            </div>
        </div>
    </section>
    @endif
    


    <!--================ End Home Banner Area =================-->

    <!--================ News Area =================-->
    <section class="news-area section-gap-top">
        <div class="container">
            <div class="row">
                  @if(isset($per["Latest News"]))
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-6 col-md-7">
                            <h3 class="title">Latest News</h3>
                        </div>
                        <div class="col-lg-6 col-md-5 text-md-right text-left mb-30-lg">
                            <a href="{{url('news-page')}}" class="primary-btn small fix-gr-bg">Browse All</a>
                        </div>
                    </div>
                    <div class="row">
                          @foreach($news as $value)
                        <div class="col-lg-4 col-md-6">
                            <div class="news-item">
                                <div class="news-img">
                                    <img class="img-fluid w-100 news-image" src="{{asset($value->image)}}" alt="">
                                </div>
                                <div class="news-text">
                                    <p class="date">
                                       
{{$value->publish_date != ""? App\SmGeneralSettings::DateConvater($value->publish_date):''}}

                                    </p>
                                    <h4>
                                        <a href="{{url('news-details/'.$value->id)}}">
                                            {{$value->news_title}}
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                      @endforeach
                    </div>
                </div>
                @endif
                  @if(isset($per["Notice Board"]))

                <div class="col-lg-3 notice-board-area">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="title">Notice Board</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="notice-board">
                                @foreach($notice_board as $notice)
                                <div class="notice-item">
                                    <p class="date">
                                       
                                    {{$notice->publish_on != ""? App\SmGeneralSettings::DateConvater($notice->publish_on):''}}

                                    </p>
                                    <a href="#" data-toggle="modal" data-target="#NoticeDetails{{$notice->id}}" ><h4>{{$notice->notice_title}}</h4></a> 
                                 
                                    <div class="modal fade admin-query" id="NoticeDetails{{$notice->id}}" >
                                    <div class="modal-dialog modal-dialog-centered  modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title text-white ">{{$notice->notice_title}}</h4>
                                                
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div> 
                                            <div class="modal-body">
                                                <div class="text-left">
                                                    <p class="text-left">{!! $notice->notice_message !!}</p>
                                                </div> 
                                               
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>   
                @endif
            </div>
        </div>
    </section>

 

    <!--================End News Area =================-->
    
  @if(isset($per["Academics"]))
    <!--================ Academics Area =================-->
    <section class="academics-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-7">
                            <h3 class="title">Academics</h3>
                        </div>
                        <div class="col-lg-6 col-md-5 text-md-right text-left mb-30-lg">
                            <a href="{{url('course')}}" class="primary-btn small fix-gr-bg">Browse All</a>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($academics as $academic)
                        <div class="col-lg-4 col-md-6">
                            <div class="academic-item">
                                <div class="academic-img">
                                    <img class="img-fluid" src="{{asset($academic->image)}}" alt="">
                                </div>
                                <div class="academic-text">
                                    <h4>
                                        <a href="{{url('course-Details/'.$academic->id)}}">{{$academic->title}}</a>
                                    </h4>
                                    <p>
                                        {!! substr($academic->overview, 0, 50) !!}
                                    </p>
                                    <div>
                                        <a href="{{url('course-Details/'.$academic->id)}}" class="client-btn">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

  @if(isset($per["Event List"]))
    <!--================ End Academics Area =================-->

    <!--================ Events Area =================-->
    <section class="events-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row mb-40">
                        <div class="col-lg-6 col-md-7">
                            <h3 class="title">Event List</h3>
                        </div>
                        <div class="col-lg-6 col-md-5 text-md-right text-left mb-30-lg">
                            <a href="#" class="primary-btn small fix-gr-bg">Browse All</a>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($events as $event)
                        <div class="col-lg-3 col-md-6">
                            <div class="events-item">
                                <div class="card">
                                    <img class="card-img-top" class="img-fluid" src="{{asset($event->uplad_image_file)}}" alt="">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            {{$event->event_title}}
                                        </h5>
                                        <p class="card-text">
                                            {{$event->event_location}}
                                        </p>
                                        <div class="date">
                                           
{{$event->from_date != ""? App\SmGeneralSettings::DateConvater($event->from_date):''}}


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>

    @endif
  @if(isset($per["Testimonial"]))

    <!--================ End Events Area =================-->

    <!--================ Start Testimonial Area =================-->
    <!--<section class="testimonial-area relative section-gap box-1420">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="active-testimonial owl-carousel">

                     @foreach($testimonial as $value)
                    <div class="single-testimonial text-center">
                        <div class="d-flex justify-content-center">
                            <div class="thumb">
                                @if(!empty($value->image))
                                <img class="img-fluid rounded-circle testimonial-image" src="{{asset($value->image)}}" alt="">
                                    @else
                                    <img class="img-fluid rounded-circle" src="{{asset('public/uploads/sample.jpg')}}" alt="">
                                    @endif
                            </div>
                            <div class="meta text-left">
                                <h4>{{$value->name}}</h4>
                                <p>{{$value->designation}}, {{$value->institution_name}}</p>
                            </div>
                        </div>
                        <p class="desc">
                            {{$value->description}}
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>-->

    @endif 

    <!--================ End Testimonial Area =================-->
@endsection
