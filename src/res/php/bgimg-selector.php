<?php 
use Language\Lang;
Lang::setSection('image_selector');
?>
<div class="colorEditor" id="editBgImg">
    <div class="titleBar">
        <button onclick="showEditor('#editBgImg');" title="<?= Lang::getText("go_back"); ?>"><img src="res/img/back.png" /></button>
        <p><?= Lang::getText("background_image"); ?></p>
    </div>
    <ul class="tabs">
        <li class="current" id="tabDefaultImg" onclick="$('#editBgImg #defaultBgImg').slideDown(); $('#editBgImg #customBgImg').slideUp(); $('#tabDefaultImg').addClass('current'); $('#tabCustomImg').removeClass('current');"><?= Lang::getText("default_background"); ?></li>
        <li id="tabCustomImg" onclick="$('#editBgImg #defaultBgImg').slideUp(); $('#editBgImg #customBgImg').slideDown(); $('#tabDefaultImg').removeClass('current'); $('#tabCustomImg').addClass('current');"><?= Lang::getText("custom_background"); ?></li>
    </ul>
    <ul class="colorSelector" id="defaultBgImg">
        <li onclick="resetBgImg();" style="background-image: url(res/img/bgs/empty.png);"></li>
        <li onclick="setBgImg('res/img/bgs/bg1.png');" style="background-image: url(res/img/bgs/bg1.png);"></li>
        <li onclick="setBgImg('res/img/bgs/bg2.png');" style="background-image: url(res/img/bgs/bg2.png);"></li>
        <li onclick="setBgImg('res/img/bgs/bg3.png');" style="background-image: url(res/img/bgs/bg3.png);"></li>
        <li onclick="setBgImg('res/img/bgs/bg4.png');" style="background-image: url(res/img/bgs/bg4.png);"></li>
        <li onclick="setBgImg('res/img/bgs/DCG30.png');" style="background-image: url(res/img/bgs/DCG30.png);"></li>
        <li onclick="setBgImg('res/img/bgs/DCG29.png');" style="background-image: url(res/img/bgs/DCG29.png);"></li>
        <li onclick="setBgImg('res/img/bgs/bg6.png');" style="background-image: url(res/img/bgs/bg6.png);"></li>
        <br/>
        <li onclick="setBgImg('res/img/bgs/bg5.png');" style="background-image: url(res/img/bgs/bg5.png);"></li>
        <li onclick="setBgImg('res/img/bgs/DCG28.png');" style="background-image: url(res/img/bgs/DCG28.png);"></li>
        <li onclick="setBgImg('res/img/bgs/DCG27.png');" style="background-image: url(res/img/bgs/DCG27.png);"></li>
        <li onclick="setBgImg('res/img/bgs/DCG25.png');" style="background-image: url(res/img/bgs/DCG25.png);"></li>
        <li onclick="setBgImg('res/img/bgs/DCG24.png');" style="background-image: url(res/img/bgs/DCG24.png);"></li>
        <li onclick="setBgImg('res/img/bgs/DCG23.png');" style="background-image: url(res/img/bgs/DCG23.png);"></li>
        <li onclick="setBgImg('res/img/bgs/DCG26.png');" style="background-image: url(res/img/bgs/DCG26.png);"></li>
        <li onclick="setBgImg('res/img/bgs/bg7.png');" style="background-image: url(res/img/bgs/bg7.png);"></li>
    </ul>
    <ul class="colorSelector" id="customBgImg">
        <li id="btnImportImg" onclick="importImage();" style="background-image: url(res/img/bgs/import.png);"></li>
    </ul>
</div>