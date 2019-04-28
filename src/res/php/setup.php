<?php
use Language\Lang;
Lang::setModule('setup');
?>
<div class="screen intro" id="screen1">
	<img src="res/img/white-flat-logo.png" id="logo" />
	<h1><?= Lang::getText('welcome_title'); ?></h1>
	<p><?= Lang::getText('welcome_text', array('app_name' => $_APP['app_name'], 'continue_button' => Lang::getText('continue'))); ?></p>
</div>

<div class="screen intro" id="screen2">
	<h1><?= Lang::getText('your_home_page_title'); ?></h1>
	<p><?= Lang::getText('your_home_page_text', array('app_name' => $_APP['app_name'])); ?></p>
	
	<img src="res/img/screens/1.png" onclick="viewScreen('res/img/screens/1.png');" class="screenImg" />
	<img src="res/img/screens/1m.png" class="screenImgMobile" />
</div>

<div class="screen intro" id="screen3">
	<h1><?= Lang::getText('select_engine_title'); ?></h1>
	<p><?= Lang::getText('select_engine_text'); ?></p>
	
    <iframe class="ytbe" width="560" height="315" src="https://www.youtube-nocookie.com/embed/2hxLgtrusjI?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
	<img src="res/img/screens/2m.png" class="screenImgMobile" />
</div>

<div class="screen intro" id="screen4">
	<h1><?= Lang::getText('quick_access_title'); ?></h1>
	<p><?= Lang::getText('quick_access_text'); ?></p>
	
	<iframe class="ytbe" width="560" height="315" src="https://www.youtube-nocookie.com/embed/mXSLV90StIQ?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
	<img src="res/img/screens/3m.png" class="screenImgMobile" />
</div>

<div class="screen customize" id="screen5">
	<h1><?= Lang::getText('default_engine_title'); ?></h1>
	<p><?= Lang::getText('default_engine_text'); ?></p>
	
	<ul class="rects">
		<li id="imgMotor">
			<p><?= Lang::getText('search_engine'); ?></p>
			<div onclick="showMotors();" style="background: url(res/img/choose.png) no-repeat center center / cover;"><span><?= Lang::getText('undefined'); ?></span></div>
		</li>
	</ul>
</div>

<div class="screen customize" id="screen6">
	<h1><?= Lang::getText('customize_title'); ?></h1>
	<p><?= Lang::getText('customize_text'); ?></p>
	
	<ul class="rects">
		<li>
			<p><?= Lang::getText('background_color'); ?></p>
			<div onclick="showColorSelector('background');" id="backgroundColor"></div>
		</li>
		<li>
			<p><?= Lang::getText('background_image'); ?></p>
			<div onclick="showEditor('#editBgImg');" id="backgroundImage"></div>
		</li>
		<li>
			<p><?= Lang::getText('accent_color'); ?></p>
			<div onclick="showColorSelector('accent');" id="accentColor"></div>
		</li>
	</ul>
</div>

<div class="screen ending" id="screen7">
	<h1><?= Lang::getText('saving_title'); ?></h1>
	<p><?= Lang::getText('saving_text', array('app_name' => $_APP['app_name'])); ?></p>
</div>
