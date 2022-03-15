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
<html lang="<?php echo e(app()->getLocale()); ?>" <?php if(isset ($ttl_rtl ) && $ttl_rtl ==1): ?> dir="rtl" class="rtl" <?php endif; ?> >

<head>
    <meta charset="utf-8"/>
    <meta name="viewport"
          content="Infix is 100+ unique feature enable school management software system. It can manage all type of school, academy and any educational institution"/>
    <link rel="icon" href="<?php echo e(asset($favicon)); ?>" type="image/png"/>
    <title><?php echo e(isset($page_title)? $page_title:$site_title); ?></title>
    <meta name="_token" content="<?php echo csrf_token(); ?>"/>
    <!-- Bootstrap CSS -->
    <?php if(isset ($ttl_rtl ) && $ttl_rtl ==1): ?>
        <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/css/rtl/bootstrap.min.css"/>
    <?php else: ?>
        <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/bootstrap.css"/>
    <?php endif; ?>


    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/jquery-ui.css"/>


    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/bootstrap-datepicker.min.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/themify-icons.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/nice-select.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/magnific-popup.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/fastselect.min.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/owl.carousel.min.css"/>
    <!-- main css -->


    <?php if(isset ($ttl_rtl ) && $ttl_rtl ==1): ?>
        <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/css/rtl/style.css"/>
    <?php else: ?>
        <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/css/<?php echo e(@$active_style->path_main_style); ?>"/>
    <?php endif; ?>

    
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/fullcalendar.print.css">


    <link rel="stylesheet" href="<?php echo e(asset('public/')); ?>/frontend/css/infix.css"/>
    <?php echo $__env->yieldPushContent('css'); ?>
</head>

<body class="client light">

<!--================ Start Header Menu Area =================-->
<header class="header-area">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container box-1420">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand" href="<?php echo e(url('/')); ?>/home">
                    <img class="w-75" src="<?php echo e(asset($logo)); ?>" alt="Infix Logo" style="max-width: 150px;">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="ti-menu"></span>
                </button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">
                        
                            <li class="nav-item  <?php echo e(Request::path() == '/' ||  Request::path() == 'home'? 'active':''); ?> "><a
                                        class="nav-link" href="<?php echo e(url('/')); ?>/home">Home</a></li>
                            <li class="nav-item <?php echo e(Request::path() == 'about'? 'active':''); ?>"><a class="nav-link"
                                                                                                href="<?php echo e(url('/')); ?>/about">About</a>
                       </li>
                       <!--     <li class="nav-item <?php echo e(Request::path() == 'course'? 'active':''); ?>"><a class="nav-link"
                                                                                                href="<?php echo e(url('/')); ?>/course">Course</a>
                            </li>-->
                            <li class="nav-item <?php echo e(Request::path() == 'news-page'? 'active':''); ?>"><a class="nav-link"
                                                                                                    href="<?php echo e(url('/')); ?>/news-page">News</a>
                            </li>
                            <li class="nav-item <?php echo e(Request::path() == 'contact'? 'active':''); ?>"><a class="nav-link"
                                                                                                href="<?php echo e(url('/')); ?>/contact">Contact</a>
                            </li>
                             <li class="nav-item <?php echo e(Request::path() == 'login'? 'active':''); ?>"><a class="nav-link"
                                                                                            href="<?php echo e(url('/')); ?>/register/<?php echo e($registerlink); ?>">Register User</a>
                            </li>
                            <?php if(Auth::user() ==""): ?>
                            <li class="nav-item <?php echo e(Request::path() == 'login'? 'active':''); ?>"><a class="nav-link"
                                                                                                href="<?php echo e(url('/')); ?>/student-login">Login</a>
                            </li>
                            <?php endif; ?>
                        <?php if(Auth::user() !=""): ?>
                            <li class="nav-item <?php echo e(Request::path() == 'login'? 'active':''); ?>"><a class="nav-link"
                                                                                                href="<?php echo e(url('/')); ?>/logout">Logout</a>
                            </li>
                            <?php endif; ?>
                            <?php if(App\SmGeneralSettings::isModule('ParentRegistration')== TRUE): ?>
                                <?php $is_registration_permission = DB::table('sm_registration_settings')->where('registration_permission',1)->first(); ?> 
                                <?php if($is_registration_permission && $is_registration_permission->position==1): ?>
                                    <li class="nav-item"><a class="nav-link"   href="<?php echo e(url('/parentregistration/registration')); ?>">Student Registration</a></li>
                                <?php endif; ?>
                            <?php endif; ?>
                           
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
<?php echo $__env->yieldContent('main_content'); ?>

<!--================Footer Area =================-->
<!--<footer class="footer_area section-gap-top">
    <div class="container">
        <div class="row footer_inner">

            <?php
                                $custom_link=App\SmCustomLink::find(1);
                            ?>
                            <?php if($custom_link!=''): ?>
                                
                            
                            <div class="col-lg-3 col-sm-6">
                                <div class="footer-widget">
                                    <div class="f_title">
                                    <h4><?php echo e($custom_link->title1); ?></h4>
                                    </div>
                                    <div class="footer-list">
                                        <nav>
                                            <ul>
                                                <?php if(App\SmGeneralSettings::isModule('ParentRegistration')== TRUE): ?>
                                                    <?php $is_registration_permission = DB::table('sm_registration_settings')->where('registration_permission',1)->first(); ?> 
                                                    <?php if($is_registration_permission && $is_registration_permission->position==2): ?>
                                                        <li><a  href="<?php echo e(url('/parentregistration/registration')); ?>">Student Registration</a></li>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <?php if($custom_link->link_href1!=''): ?>
                                                  <li><a href="<?php echo e($custom_link->link_href1); ?>"><?php echo e($custom_link->link_label1); ?> </a></li>
                                                  
                                                <?php endif; ?>
                                                <?php if($custom_link->link_href5!=''): ?>
                                                <li><a href="<?php echo e($custom_link->link_href5); ?>"><?php echo e($custom_link->link_label5); ?></a></li>
                                                <?php endif; ?>
                                                <?php if($custom_link->link_href9!=''): ?>
                                                    <li><a href="<?php echo e($custom_link->link_href9); ?>"><?php echo e($custom_link->link_label9); ?></a></li>
                                                
                                                <?php endif; ?>
                                                <?php if($custom_link->link_href13!=''): ?>
                                                      <li><a href="<?php echo e($custom_link->link_href13); ?>"><?php echo e($custom_link->link_label13); ?> </a></li>
                                                <?php endif; ?>
                                               
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="footer-widget">
                                    <div class="f_title">
                                        <h4><?php echo e($custom_link->title2); ?></h4>
                                    </div>
                                    <div class="footer-list">
                                        <nav>
                                            <ul>
c

                                                    <?php if($custom_link->link_href2!=''): ?>
                                                    <li><a href="<?php echo e($custom_link->link_href2); ?>"><?php echo e($custom_link->link_label2); ?></a></li>
                                                
                                                <?php endif; ?>
                                                <?php if($custom_link->link_href6!=''): ?>
                                                <li><a href="<?php echo e(url($custom_link->link_href6)); ?>"><?php echo e($custom_link->link_label6); ?></a></li>
                                      
                                                <?php endif; ?>
                                                <?php if($custom_link->link_href10!=''): ?>
                                                <li><a href="<?php echo e($custom_link->link_href10); ?>"><?php echo e($custom_link->link_label10); ?></a></li>
                                      
                                                <?php endif; ?>
                                                <?php if($custom_link->link_href14!=''): ?>
                                                <li><a href="<?php echo e($custom_link->link_href14); ?>"><?php echo e($custom_link->link_label14); ?></a></li>
                                           
                                               <?php endif; ?>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="footer-widget">
                                    <div class="f_title">
                                        <h4><?php echo e($custom_link->title3); ?></h4>
                                    </div>
                                    <div class="footer-list">
                                        <nav>
                                            <ul>
                                             <?php if($custom_link->link_href3!=''): ?>
                                                    <li><a href="<?php echo e($custom_link->link_href3); ?>"><?php echo e($custom_link->link_label3); ?></a></li>
                                               <?php endif; ?>
                                                    <?php if($custom_link->link_href7!=''): ?>
                                                        <li><a href="<?php echo e($custom_link->link_href7); ?>"><?php echo e($custom_link->link_label7); ?></a></li>
                                                    <?php endif; ?>
                                                    <?php if($custom_link->link_href11!=''): ?>
                                                        <li><a href="<?php echo e($custom_link->link_href11); ?>"><?php echo e($custom_link->link_label11); ?></a></li>
                                                    <?php endif; ?>
                                                    <?php if($custom_link->link_href15!=''): ?>
                                                        <li><a href="<?php echo e($custom_link->link_href15); ?>"><?php echo e($custom_link->link_label15); ?></a></li>
                                                    <?php endif; ?>
                                                
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="footer-widget">
                                    <div class="f_title">
                                        <h4><?php echo e($custom_link->title4); ?></h4>
                                    </div>
                                    <div class="footer-list">
                                        <nav>
                                            <ul>
                                             <?php if($custom_link->link_href4!=''): ?>
                                                    <li><a href="<?php echo e($custom_link->link_href4); ?>"><?php echo e($custom_link->link_label4); ?></a></li>
                                               <?php endif; ?>
                                                    <?php if($custom_link->link_href8!=''): ?>
                                                        <li><a href="<?php echo e($custom_link->link_href8); ?>"><?php echo e($custom_link->link_label8); ?></a></li>
                                                    <?php endif; ?>
                                                    <?php if($custom_link->link_href12!=''): ?>
                                                        <li><a href="<?php echo e($custom_link->link_href12); ?>"><?php echo e($custom_link->link_label12); ?></a></li>
                                                    <?php endif; ?>
                                                    <?php if($custom_link->link_href16!=''): ?>
                                                        <li><a href="<?php echo e($custom_link->link_href16); ?>"><?php echo e($custom_link->link_label16); ?></a></li>
                                                    <?php endif; ?>
                                               
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
            

            

        </div>
        <div class="row single-footer-widget">
            <div class="col-lg-8 col-md-9">
                <div class="copy_right_text">
                    <p><?php echo $copyright_text; ?></p>
                </div>
            </div>

            <?php if(isset($per["Social Icons"])): ?>
                <div class="col-lg-4 col-md-3">
                    <div class="social_widget">

                        <?php $__currentLoopData = $social_icons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social_icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(@$social_icon->url != ""): ?>
                                <a href="<?php echo e(@$social_icon->url); ?>"><i class="<?php echo e($social_icon->icon); ?>"></i></a>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        

                        


                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</footer>-->
<!--================End Footer Area =================-->

<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/jquery-3.2.1.min.js">
</script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/jquery-ui.js">
</script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/popper.js">
</script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/bootstrap.min.js">
</script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/nice-select.min.js">
</script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/jquery.magnific-popup.min.js">
</script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/raphael-min.js">
</script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/morris.min.js">
</script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/owl.carousel.min.js"></script>

<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/moment.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/print/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/bootstrap-datepicker.min.js"></script>
<!-- <script src="<?php echo e(asset('public/backEnd/')); ?>/js/gmap3.min.js"></script> -->
<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCwzmSafhk_bBIdIy7MjwVIAVU1MgUmXY4"></script> -->

<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDs3mrTgrYd6_hJS50x4Sha1lPtS2T-_JA"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/js/main.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/js/custom.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/js/developer.js"></script>

<?php echo $__env->yieldContent('script'); ?>

</body>
</html>



<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('public/')); ?>/frontend/css/new_style.css"/>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main_content'); ?>
<?php
    $css= "background: linear-gradient(0deg, rgba(124, 50, 255, 0.6), rgba(199, 56, 216, 0.6)), url(".url($homePage->image).") no-repeat center;    background-size: cover;";
?>

 <style type="text/css">
     .client .events-item .card .card-body .date {
        max-width: 90px !important; 
     }
 </style>

  <?php if(isset($per["Image Banner"])): ?>
    <!--================ Home Banner Area =================-->
    <section class="container box-1420">
        <div class="home-banner-area" style="<?php echo e($css); ?>">
            <div class="banner-inner">
                <div class="banner-content">
                    <h5><?php echo e($homePage->title); ?></h5>
                    <h2><?php echo e($homePage->long_title); ?></h2>
                    <p><?php echo e($homePage->short_description); ?></p>
                    <a class="primary-btn fix-gr-bg semi-large" href="<?php echo e($homePage->link_url); ?>"><?php echo e($homePage->link_label); ?></a>
                 </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
    


    <!--================ End Home Banner Area =================-->

    <!--================ News Area =================-->
    <section class="news-area section-gap-top">
        <div class="container">
            <div class="row">
                  <?php if(isset($per["Latest News"])): ?>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-6 col-md-7">
                            <h3 class="title">Latest News</h3>
                        </div>
                        <div class="col-lg-6 col-md-5 text-md-right text-left mb-30-lg">
                            <a href="<?php echo e(url('news-page')); ?>" class="primary-btn small fix-gr-bg">Browse All</a>
                        </div>
                    </div>
                    <div class="row">
                          <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="news-item">
                                <div class="news-img">
                                    <img class="img-fluid w-100 news-image" src="<?php echo e(asset($value->image)); ?>" alt="">
                                </div>
                                <div class="news-text">
                                    <p class="date">
                                       
<?php echo e($value->publish_date != ""? App\SmGeneralSettings::DateConvater($value->publish_date):''); ?>


                                    </p>
                                    <h4>
                                        <a href="<?php echo e(url('news-details/'.$value->id)); ?>">
                                            <?php echo e($value->news_title); ?>

                                        </a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php endif; ?>
                  <?php if(isset($per["Notice Board"])): ?>

                <div class="col-lg-3 notice-board-area">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="title">Notice Board</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="notice-board">
                                <?php $__currentLoopData = $notice_board; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="notice-item">
                                    <p class="date">
                                       
                                    <?php echo e($notice->publish_on != ""? App\SmGeneralSettings::DateConvater($notice->publish_on):''); ?>


                                    </p>
                                    <a href="#" data-toggle="modal" data-target="#NoticeDetails<?php echo e($notice->id); ?>" ><h4><?php echo e($notice->notice_title); ?></h4></a> 
                                 
                                    <div class="modal fade admin-query" id="NoticeDetails<?php echo e($notice->id); ?>" >
                                    <div class="modal-dialog modal-dialog-centered  modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title text-white "><?php echo e($notice->notice_title); ?></h4>
                                                
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div> 
                                            <div class="modal-body">
                                                <div class="text-left">
                                                    <p class="text-left"><?php echo $notice->notice_message; ?></p>
                                                </div> 
                                               
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>   
                <?php endif; ?>
            </div>
        </div>
    </section>

 

    <!--================End News Area =================-->
    
  <?php if(isset($per["Academics"])): ?>
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
                            <a href="<?php echo e(url('course')); ?>" class="primary-btn small fix-gr-bg">Browse All</a>
                        </div>
                    </div>
                    <div class="row">
                        <?php $__currentLoopData = $academics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $academic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="academic-item">
                                <div class="academic-img">
                                    <img class="img-fluid" src="<?php echo e(asset($academic->image)); ?>" alt="">
                                </div>
                                <div class="academic-text">
                                    <h4>
                                        <a href="<?php echo e(url('course-Details/'.$academic->id)); ?>"><?php echo e($academic->title); ?></a>
                                    </h4>
                                    <p>
                                        <?php echo substr($academic->overview, 0, 50); ?>

                                    </p>
                                    <div>
                                        <a href="<?php echo e(url('course-Details/'.$academic->id)); ?>" class="client-btn">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

  <?php if(isset($per["Event List"])): ?>
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
                        <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="events-item">
                                <div class="card">
                                    <img class="card-img-top" class="img-fluid" src="<?php echo e(asset($event->uplad_image_file)); ?>" alt="">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <?php echo e($event->event_title); ?>

                                        </h5>
                                        <p class="card-text">
                                            <?php echo e($event->event_location); ?>

                                        </p>
                                        <div class="date">
                                           
<?php echo e($event->from_date != ""? App\SmGeneralSettings::DateConvater($event->from_date):''); ?>



                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php endif; ?>
  <?php if(isset($per["Testimonial"])): ?>

    <!--================ End Events Area =================-->

    <!--================ Start Testimonial Area =================-->
    <!--<section class="testimonial-area relative section-gap box-1420">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="active-testimonial owl-carousel">

                     <?php $__currentLoopData = $testimonial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="single-testimonial text-center">
                        <div class="d-flex justify-content-center">
                            <div class="thumb">
                                <?php if(!empty($value->image)): ?>
                                <img class="img-fluid rounded-circle testimonial-image" src="<?php echo e(asset($value->image)); ?>" alt="">
                                    <?php else: ?>
                                    <img class="img-fluid rounded-circle" src="<?php echo e(asset('public/uploads/sample.jpg')); ?>" alt="">
                                    <?php endif; ?>
                            </div>
                            <div class="meta text-left">
                                <h4><?php echo e($value->name); ?></h4>
                                <p><?php echo e($value->designation); ?>, <?php echo e($value->institution_name); ?></p>
                            </div>
                        </div>
                        <p class="desc">
                            <?php echo e($value->description); ?>

                        </p>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </section>-->

    <?php endif; ?> 

    <!--================ End Testimonial Area =================-->
<?php $__env->stopSection(); ?>
<?php /**PATH C:\xampp\htdocs\resources\views/frontEnd/dashBoard/school_front.blade.php ENDPATH**/ ?>