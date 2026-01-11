<?php $lang->setSection('setup'); ?>
<div class="screen intro" id="screen1">
	<img src="res/img/white-flat-logo.png" id="logo" />
	<h1><?= $lang->getKey('welcome_title'); ?></h1>
	<p><?= $lang->getKey('welcome_text', array('app_name' => $_CORE['app_name'], 'continue_button' => $lang->getKey('continue'))); ?></p>
</div>

<div class="screen intro" id="screen2">
	<h1><?= $lang->getKey('your_home_page_title'); ?></h1>
	<p><?= $lang->getKey('your_home_page_text', array('app_name' => $_CORE['app_name'])); ?></p>
	
	<img src="res/img/screens/1.png" onclick="viewScreen('res/img/screens/1.png');" class="screenImg" />
	<img src="res/img/screens/1m.png" class="screenImgMobile" />
</div>

<div class="screen intro" id="screen3">
	<h1><?= $lang->getKey('select_engine_title'); ?></h1>
	<p><?= $lang->getKey('select_engine_text'); ?></p>
	
    <iframe class="ytbe" width="560" height="315" src="https://www.youtube-nocookie.com/embed/2hxLgtrusjI?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
	<img src="res/img/screens/2m.png" class="screenImgMobile" />
</div>

<div class="screen intro" id="screen4">
	<h1><?= $lang->getKey('quick_access_title'); ?></h1>
	<p><?= $lang->getKey('quick_access_text'); ?></p>
	
	<iframe class="ytbe" width="560" height="315" src="https://www.youtube-nocookie.com/embed/mXSLV90StIQ?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
	<img src="res/img/screens/3m.png" class="screenImgMobile" />
</div>

<div class="screen customize" id="screen5">
	<h1><?= $lang->getKey('default_engine_title'); ?></h1>
	<p><?= $lang->getKey('default_engine_text'); ?></p>
	
	<ul class="rects">
		<li id="imgMotor">
			<p><?= $lang->getKey('search_engine'); ?></p>
			<div onclick="showMotors();" style="background: url(res/img/choose.png) no-repeat center center / cover;"><span><?= $lang->getKey('undefined'); ?></span></div>
		</li>
	</ul>
</div>

<div class="screen customize" id="screen6">
	<h1><?= $lang->getKey('customize_title'); ?></h1>
	<p><?= $lang->getKey('customize_text'); ?></p>
	
	<ul class="rects">
		<li id="bgColor">
			<p><?= $lang->getKey('background_color'); ?></p>
			<div onclick="showColorSelector('background');" id="backgroundColor"></div>
		</li>
		<li id="bgImg">
			<p><?= $lang->getKey('background_image'); ?></p>
			<div onclick="showEditor('#editBgImg');" id="backgroundImage"></div>
		</li>
		<li id="bgColor2">
			<p><?= $lang->getKey('accent_color'); ?></p>
			<div onclick="showColorSelector('accent');" id="accentColor"></div>
		</li>
	</ul>
</div>

<div class="screen ending" id="screen7">
	<h1><?= $lang->getKey('saving_title'); ?></h1>
	<p><?= $lang->getKey('saving_text', array('app_name' => $_CORE['app_name'])); ?></p>
</div>
