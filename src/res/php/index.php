<?php
use Language\Lang;
Lang::setSection('index');
?>
<div id="pinEngine" class="winholder">
	<div class="closeArea" onclick="closeWindow('#pinEngine');">
	</div>
	<div class="align">
	</div>
	<div class="window">
		<div class="ttl">
			<h1 id="title"><?= Lang::getText('pin_search_engine_title'); ?></h1>
			<img src="res/img/close.png" onclick="closeWindow('#pinEngine');" />
		</div>
		<div class="ctn">
			<iframe class="ytbe" width="560" height="315" src="https://www.youtube-nocookie.com/embed/mXSLV90StIQ?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
		</div>
	</div>
</div>

<div id="qrCode" class="winholder">
	<div class="closeArea" onclick="closeWindow('#qrCode');">
	</div>
	<div class="align">
	</div>
	<div class="window">
		<div class="ttl">
			<h1 id="title">QR Code</h1>
			<img src="res/img/close.png" onclick="closeWindow('#qrCode');" />
		</div>
		<div class="ctn">
            <img src="res/img/qrc.png" />
		</div>
	</div>
</div>