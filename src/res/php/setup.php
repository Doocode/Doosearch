<?php
use Language\Lang;
Lang::setSection('setup');
?>
<div class="screen intro" id="screen1">
	<img src="res/img/white-flat-logo.png" id="logo" />
	<h1><?= Lang::getKey('welcome_title'); ?></h1>
	<p><?= Lang::getKey('welcome_text', array('app_name' => $_APP['app_name'], 'continue_button' => Lang::getKey('continue'))); ?></p>
</div>

<div class="screen intro" id="screen2">
	<h1><?= Lang::getKey('your_home_page_title'); ?></h1>
	<p><?= Lang::getKey('your_home_page_text', array('app_name' => $_APP['app_name'])); ?></p>
	
	<img src="res/img/screens/1.png" onclick="viewScreen('res/img/screens/1.png');" class="screenImg" />
	<img src="res/img/screens/1m.png" class="screenImgMobile" />
</div>

<div class="screen intro" id="screen3">
	<h1><?= Lang::getKey('select_engine_title'); ?></h1>
	<p><?= Lang::getKey('select_engine_text'); ?></p>
	
    <iframe class="ytbe" width="560" height="315" src="https://www.youtube-nocookie.com/embed/2hxLgtrusjI?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
	<img src="res/img/screens/2m.png" class="screenImgMobile" />
</div>

<div class="screen intro" id="screen4">
	<h1><?= Lang::getKey('quick_access_title'); ?></h1>
	<p><?= Lang::getKey('quick_access_text'); ?></p>
	
	<iframe class="ytbe" width="560" height="315" src="https://www.youtube-nocookie.com/embed/mXSLV90StIQ?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
	<img src="res/img/screens/3m.png" class="screenImgMobile" />
</div>

<div class="screen customize" id="screen5">
	<h1><?= Lang::getKey('default_engine_title'); ?></h1>
	<p><?= Lang::getKey('default_engine_text'); ?></p>
	
	<ul class="rects">
		<li id="imgMotor">
			<p><?= Lang::getKey('search_engine'); ?></p>
			<div onclick="showMotors();" style="background: url(res/img/choose.png) no-repeat center center / cover;"><span><?= Lang::getKey('undefined'); ?></span></div>
		</li>
	</ul>
</div>

<div class="screen customize" id="screen6">
	<h1><?= Lang::getKey('customize_title'); ?></h1>
	<p><?= Lang::getKey('customize_text'); ?></p>
	
	<ul class="rects">
		<li id="bgColor">
			<p><?= Lang::getKey('background_color'); ?></p>
			<div onclick="showColorSelector('background');" id="backgroundColor"></div>
		</li>
		<li id="bgImg">
			<p><?= Lang::getKey('background_image'); ?></p>
			<div onclick="showEditor('#editBgImg');" id="backgroundImage"></div>
		</li>
		<li id="bgColor2">
			<p><?= Lang::getKey('accent_color'); ?></p>
			<div onclick="showColorSelector('accent');" id="accentColor"></div>
		</li>
	</ul>
</div>

<div class="screen ending" id="screen7">
	<h1><?= Lang::getKey('saving_title'); ?></h1>
	<p><?= Lang::getKey('saving_text', array('app_name' => $_APP['app_name'])); ?></p>
</div>
