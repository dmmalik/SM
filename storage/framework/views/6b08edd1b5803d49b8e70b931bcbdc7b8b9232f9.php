<!DOCTYPE html>
<?php
$setting = App\SmGeneralSettings::find(1);
//0dd($setting);
if(isset($setting->copyright_text)){ $copyright_text = $setting->copyright_text; }else{ $copyright_text = 'Copyright © 2019 All rights reserved | This application is made with by Codethemes'; }

	$logo = 'public/uploads/settings/logo.png';
	

if(isset($setting->favicon)) { $favicon = $setting->favicon; } else{ $favicon = 'public/backEnd/img/favicon.png'; }

$login_background = App\SmBackgroundSetting::where([['is_default',1],['title','Login Background']])->first();

if(empty($login_background)){
    $css = "";
}else{
    if(!empty($login_background->image)){
        $css = "background: url('". url($login_background->image) ."')  no-repeat center;  background-size: cover;";

    }else{
        $css = "background:".$login_background->color;
    }
}
$active_style = App\SmStyle::where('is_active', 1)->first();

$ttl_rtl = $setting->ttl_rtl;
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>School registration </title>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/themify-icons.css" />
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/css/style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="<?php echo e(asset($favicon)); ?>" type="image/png"/>
    <meta name="_token" content="<?php echo csrf_token(); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/login2')); ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/login2')); ?>/themify-icons.css">


    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/backEnd/vendors/css/nice-select.css" />
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/backEnd/vendors/js/select2/select2.css" />



    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/login2')); ?>/css/style.css">
	<link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/toastr.min.css"/>
    <title><?php echo e(isset($setting)? !empty($setting->site_title) ? $setting->site_title : 'System ': 'System '); ?> | <?php echo app('translator')->get('lang.login'); ?></title>
    <style>

.loginButton {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.loginButton{
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}
.singleLoginButton{
    flex: 22% 0 0;
}

.loginButton .get-login-access {
    display: block;
    width: 100%;
    border: 1px solid #fff;
    border-radius: 5px;
    margin-bottom: 20px;
    padding: 5px;
    white-space: nowrap;
}
@media (max-width: 576px) {
  .singleLoginButton{
    flex: 49% 0 0;
  }
}
@media (max-width: 576px) {
  .singleLoginButton{
    flex: 49% 0 0;
  }
  .loginButton .get-login-access {
    margin-bottom: 10px;
}
}
.create_account a {
    color: #828bb2;
    font-weight: 500;
    text-decoration: none;
}
    </style>
</head>
<html lang="en">
<!--<head>
    
	
	
</head>-->
<body class="login">

    <!--================ Start Login Area =================-->
    
	<section class="login-area">
	
		<div class="container">
			<div class="row login-height justify-content-center align-items-center">
				<div class="col-lg-5 col-md-8">
					<div class="form-wrap text-center in_login_content">
						<div class="logo-container">
							<!--<a href="#">
								<?php if(!empty($setting->logo)): ?><img src="<?php echo e(asset($setting->logo)); ?>" alt="Login Panel"><?php endif; ?>-->
						</div>
						
						<h5 class="text-uppercase">Registration Details</h5>
						<form method="post" class="" action="<?php echo e(url('register_school')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
						<?php if(session()->has('message-danger') != ""): ?>
                                    <?php if(session()->has('message-danger')): ?>
                                    <p class="text-danger"><?php echo e(session()->get('message-danger')); ?></p>
                                    <?php endif; ?>
                                <?php endif; ?>
							<div class="form-group input-group">
								<span class="input-group-addon">
								<?php if(session()->has('message-danger') != ""): ?>
                                    <?php if(session()->has('message-danger')): ?>
                                    <p class="text-danger"><?php echo e(session()->get('message-danger')); ?></p>
                                    <?php endif; ?>
                                <?php endif; ?>
								
									<i class="lnr lnr-user"></i>
								</span>
								<input class="form-control<?php echo e($errors->has('school_name') ? ' is-invalid' : ''); ?>" type="text" name='school_name' placeholder="Enter your School Name" required="required" />
								
							</div>
							
							<div class="form-group input-group">
								<span class="input-group-addon">
									<i class="lnr lnr-user"></i>
								</span>
								<input class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" type="email" name='email' placeholder="Enter Email address" required="required" />
								
							</div>
							
							<div class="form-group input-group">
								<span class="input-group-addon">
									<i class="fa fa-key"></i>
								</span>
								<input class="form-control<?php echo e($errors->has('phone') ? ' is-invalid' : ''); ?>" type="text" name='phone' placeholder="Enter Phone Number" required="required" />
								
							</div>
							<div class="form-group input-group">
								<span class="input-group-addon">
									<i class="fa fa-key"></i>
								</span>
								<input class="form-control<?php echo e($errors->has('address') ? ' is-invalid' : ''); ?>" type="textarea" name='address' placeholder="Enter address" required="required" />
								
							</div>
							
							 <div class="form-group input-group">
								<label for="logo_img">Upload School Logo</label>
								<input type="file" name="logo_img" class="form-control<?php echo e($errors->has('logo_img') ? ' is-invalid' : ''); ?>"   id="logo_img">

								
							</div>
								<div class="input-effect mb-40 in_single_input">
                                        <select class="mb-26 niceSelect infix_theme_style w-100 bb form-control<?php echo e($errors->has('school_type') ? ' is-invalid' : ''); ?>" name="school_type" >
                                            
                                            <?php $__currentLoopData = $schools_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $school): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($school->id); ?>"> <?php echo e($school->school_type); ?> </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
							</div>
							<div class="form-group ">
								<button type="submit" class="primary-btn fix-gr-bg ">
									<span class="ti-lock"></span>
									Register
                                </button>
							</div>
							<?php if($errors->any()): ?>
						<div class="alert alert-danger">
								<ul>
								<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li><?php echo e($error); ?></li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</ul>
							<?php if($errors->has('email')): ?>
								<?php endif; ?>
							</div>
							<?php endif; ?>
							
							
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================ Start End Login Area =================-->

	<!--================ Footer Area =================-->
	
	<!--================ End Footer Area =================-->


    <script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/jquery-3.2.1.min.js"></script>
    <script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/popper.js"></script>
	<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/bootstrap.min.js"></script>
	<script>
		$('.primary-btn').on('click', function(e) {
		// Remove any old one
		$('.ripple').remove();

		// Setup
		var primaryBtnPosX = $(this).offset().left,
			primaryBtnPosY = $(this).offset().top,
			primaryBtnWidth = $(this).width(),
			primaryBtnHeight = $(this).height();

		// Add the element
		$(this).prepend("<span class='ripple'></span>");

		// Make it round!
		if (primaryBtnWidth >= primaryBtnHeight) {
			primaryBtnHeight = primaryBtnWidth;
		} else {
			primaryBtnWidth = primaryBtnHeight;
		}

		// Get the center of the element
		var x = e.pageX - primaryBtnPosX - primaryBtnWidth / 2;
		var y = e.pageY - primaryBtnPosY - primaryBtnHeight / 2;

		// Add the ripples CSS and start the animation
		$('.ripple')
			.css({
				width: primaryBtnWidth,
				height: primaryBtnHeight,
				top: y + 'px',
				left: x + 'px'
			})
			.addClass('rippleEffect');
		});
	</script>
	



	<script>
    if ($('.niceSelect').length) {
		$('.niceSelect').niceSelect();
	}
	$(document).ready(function () {

		$('#btnsubmit').on('click',function()
		{
		$(this).html('Please wait ...')
			.attr('disabled','disabled');
		$('#infix_form').submit();
		});

	 });


	$(document).ready(function() {
        $("#email-address").keyup(function(){
            $("#username-hidden").val($(this).val());
        });
    });

	 </script>



	<?php echo Toastr::message(); ?>

  </body>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\resources\views/frontEnd/register_school.blade.php ENDPATH**/ ?>