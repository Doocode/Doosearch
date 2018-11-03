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
			<h1 id="title"><?= Lang::getText("add_a_website"); ?></h1>
			<img src="res/img/close.png" onclick="closeWindow('#addWebsite'); resetForm();" />
		</div>
		<div class="ctn">
			<p class="text"><?= Lang::getText("fill_the_form"); ?></p>
			
            <table class="form">
                <tr>
                    <img class="icon" src="res/img/choose.png" />
                </tr>
                <tr>
                    <th><?= Lang::getText("website_icon"); ?></th>
                    <td><input type="text" name="icon" placeholder="<?= Lang::getText("website_icon"); ?>" /></td>
                </tr>
                <tr>
                    <th><?= Lang::getText("website_title"); ?></th>
                    <td><input type="text" name="title" placeholder="<?= Lang::getText("website_title"); ?>" /></td>
                </tr>
                <tr>
                    <th><?= Lang::getText("website_url"); ?></th>
                    <td><input type="text" name="url" placeholder="<?= Lang::getText("website_url"); ?>" /></td>
                </tr>
                <tr>
                    <th></th>
                    <td><input type="button" value="<?= Lang::getText("add"); ?>" onclick="addWebsite();"/></td>
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
			<h1 id="title"><?= Lang::getText("edit_the_shortcut"); ?></h1>
			<img src="res/img/close.png" onclick="closeWindow('#editWebsite'); resetForm();" />
		</div>
		<div class="ctn">
			<table class="form">
                <tr>
                    <img class="icon" src="res/img/choose.png" />
                </tr>
                <tr>
                    <th><?= Lang::getText("website_icon"); ?></th>
                    <td><input type="text" name="icon" placeholder="<?= Lang::getText("website_icon"); ?>" /></td>
                </tr>
                <tr>
                    <th><?= Lang::getText("website_title"); ?></th>
                    <td><input type="text" name="title" placeholder="<?= Lang::getText("website_title"); ?>" /></td>
                </tr>
                <tr>
                    <th><?= Lang::getText("website_url"); ?></th>
                    <td><input type="text" name="url" placeholder="<?= Lang::getText("website_url"); ?>" /></td>
                </tr>
                <tr>
                    <th></th>
                    <td><input type="button" value="<?= Lang::getText("edit"); ?>" onclick="saveChanges();"/></td>
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
                <p><?= Lang::getText("open_this_link"); ?></p>
            </li>
            <li id="actEdit" onclick="editWebsite();">
                <img src="res/img/edit.png" />
                <p><?= Lang::getText("edit_this_link"); ?></p>
            </li>
            <li id="actDuplicate" onclick="duplicateWebsite();">
                <img src="res/img/duplicate.png" />
                <p><?= Lang::getText("duplicate_this_link"); ?></p>
            </li>
            <li id="actRemove" onclick="removeWebsite();">
                <img src="res/img/remove.png" />
                <p><?= Lang::getText("remove_this_link"); ?></p>
            </li>
        </ul>
    </div>
</div>