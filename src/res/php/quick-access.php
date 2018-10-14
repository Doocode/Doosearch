<?php
use Language\Lang;
Lang::setSection('quick_access');
?>
<div id="addWebsite" class="winholder">
	<div class="closeArea" onclick="closeWindow('#addWebsite'); resetForm();">
	</div>
	<div class="align">
	</div>
	<div class="window">
		<div class="ttl">
			<h1 id="title"><?= Lang::getKey("add_a_website"); ?></h1>
			<img src="res/img/close.png" onclick="closeWindow('#addWebsite'); resetForm();" />
		</div>
		<div class="ctn">
			<p class="text"><?= Lang::getKey("fill_the_form"); ?></p>
			
            <table class="form">
                <tr>
                    <img class="icon" src="res/img/choose.png" />
                </tr>
                <tr>
                    <th><?= Lang::getKey("website_icon"); ?></th>
                    <td><input type="text" name="icon" placeholder="<?= Lang::getKey("website_icon"); ?>" /></td>
                </tr>
                <tr>
                    <th><?= Lang::getKey("website_title"); ?></th>
                    <td><input type="text" name="title" placeholder="<?= Lang::getKey("website_title"); ?>" /></td>
                </tr>
                <tr>
                    <th><?= Lang::getKey("website_url"); ?></th>
                    <td><input type="text" name="url" placeholder="<?= Lang::getKey("website_url"); ?>" /></td>
                </tr>
                <tr>
                    <th></th>
                    <td><input type="button" value="<?= Lang::getKey("add"); ?>" onclick="addWebsite();"/></td>
                </tr>
            </table>
		</div>
	</div>
</div>

<div id="editWebsite" class="winholder">
	<div class="closeArea" onclick="closeWindow('#editWebsite'); resetForm();">
	</div>
	<div class="align">
	</div>
	<div class="window">
		<div class="ttl">
			<h1 id="title"><?= Lang::getKey("edit_the_shortcut"); ?></h1>
			<img src="res/img/close.png" onclick="closeWindow('#editWebsite'); resetForm();" />
		</div>
		<div class="ctn">
			<table class="form">
                <tr>
                    <img class="icon" src="res/img/choose.png" />
                </tr>
                <tr>
                    <th><?= Lang::getKey("website_icon"); ?></th>
                    <td><input type="text" name="icon" placeholder="<?= Lang::getKey("website_icon"); ?>" /></td>
                </tr>
                <tr>
                    <th><?= Lang::getKey("website_title"); ?></th>
                    <td><input type="text" name="title" placeholder="<?= Lang::getKey("website_title"); ?>" /></td>
                </tr>
                <tr>
                    <th><?= Lang::getKey("website_url"); ?></th>
                    <td><input type="text" name="url" placeholder="<?= Lang::getKey("website_url"); ?>" /></td>
                </tr>
                <tr>
                    <th></th>
                    <td><input type="button" value="<?= Lang::getKey("edit"); ?>" onclick="saveChanges();"/></td>
                </tr>
            </table>
		</div>
	</div>
</div>

<div class="central ctxtmenu" onclick="hideMenu();">
    <div class="aligner"></div>
    <div class="menu">
        <div class="view">
            <img src="res/img/choose.png" />
            <h5></h5>
        </div>
        <ul class="actions">
            <li id="actOpen" onclick="openLink();">
                <img src="res/img/use.png" />
                <p><?= Lang::getKey("open_this_link"); ?></p>
            </li>
            <li id="actEdit" onclick="editWebsite();">
                <img src="res/img/edit.png" />
                <p><?= Lang::getKey("edit_this_link"); ?></p>
            </li>
            <li id="actDuplicate" onclick="duplicateWebsite();">
                <img src="res/img/duplicate.png" />
                <p><?= Lang::getKey("duplicate_this_link"); ?></p>
            </li>
            <li id="actRemove" onclick="removeWebsite();">
                <img src="res/img/remove.png" />
                <p><?= Lang::getKey("remove_this_link"); ?></p>
            </li>
        </ul>
    </div>
</div>