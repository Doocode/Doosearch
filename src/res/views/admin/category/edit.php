<?php 
use Language\Lang;
use Admin\Category;
use Gui\PagePath;

Lang::setModule('administration');
$title = $_APP['app_name'] .' > '. Lang::getText('administration');
Lang::setModule('admin_categories');
$title = $title .' > '. Lang::getText('edit_category');
PagePath::addItem(Lang::getText('manage_categories'), 'admin-list-category.php');
PagePath::addItem(Lang::getText('edit_category'), '#');
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("res/php/head.php"); ?>
        <link rel="stylesheet" href="res/css/page.css" />
        <link rel="stylesheet" href="res/css/pagepath.css" />
        <link rel="stylesheet" href="res/css/admin/main.css" />
        <link rel="stylesheet" href="res/css/admin/categories.css" />
        <title><?= $title ?></title>
        <script src="res/js/admin/categories.js"></script>
    </head>

    <body>
        <?php include("res/php/header.php"); ?>
        <?php Lang::setModule('admin_categories'); ?>
        <script>setCurrentPage('#accountPage');</script>
		
		<div class="presentation" style="background-image: url(res/img/login.png);">
			<h1><?= Lang::getText('edit_category'); ?></h1>
		</div>
		
		<div class="page">
            <div class="header">
                <div class="titleBar">
                    <a href="admin-list-category.php" title="<?= Lang::getText('back'); ?>">
                        <img src="res/img/header/goback.png" />
                    </a>
                    <h1><?= Lang::getText('edit_category'); ?></h1>
                </div>
                <?php PagePath::toHtml(); Lang::setModule('admin_categories'); ?>
                
                <ul class="toolbar">
                    <li><a href="admin-list-category.php"><button class="flat"><?= Lang::getText('back'); ?></button></a></li>
                </ul>
            </div>
            
            <?php
            if(isset($_POST['status']))
            {
                $status = $_POST['status'];
                $bgColor = '';
                $msg = '';
                if(isset($status['success']))
                {
                    $bgColor = 'green';
                    $msg = $status['success'];
                }
                else if(isset($status['error']))
                {
                    $bgColor = 'red';
                    $msg = $status['error'];
                }
                else if(isset($status['warning']))
                {
                    $bgColor = 'orange';
                    $msg = $status['warning'];
                }
                ?><p class="info <?= $bgColor ?>"><?= $msg ?></p><?php
            }
            
            $item = Category::find($_GET['id']);
            $searchEngines = Category::getSearchEnginesForCategory($item['keyword']);
            ?>
            <form method="post" action="admin-update-category.php">
                <input type="hidden" name="id" value="<?= $item['id'] ?>" />
                <table class="decorated" id="editForm">
                    <tr></tr>
                    <tr>
                        <th><?= Lang::getText('keyword'); ?></th>
                        <td><input type="text" name="keyword" value="<?= $item['keyword'] ?>" /></td>
                    </tr>
                    <tr>
                        <th><?= Lang::getText('search_engines'); ?></th>
                        <td>
                            <div class="tabWidget">
                                <div class="tabBar">
                                    <input type="radio" name="tabs" id="tabAll" checked /><label for="tabAll"><?= Lang::getText('all'); ?></label>
                                    <input type="radio" name="tabs" id="tabSelected" /> <label for="tabSelected"><?= Lang::getText('selected'); ?></label>
                                    <input type="radio" name="tabs" id="tabNotSelected" /><label for="tabNotSelected"><?= Lang::getText('not_selected'); ?></label>
                                </div>
                                <div class="tabContent">
                                <?php
                                foreach($searchEngines as $se)
                                {
                                    $checked = '';
                                    if($se['checked'])
                                        $checked = 'checked="checked"';
                                    ?>
                                    <input type="checkbox" name="searchEngines[]" id="se<?= $se['id'] ?>" value="se<?= $se['id'] ?>" <?= $checked ?> />
                                    <label for="se<?= $se['id'] ?>">
                                        <img src="res/img/motors/<?= $se['icon'] ?>" />
                                        <p><?= $se['title'] ?></p>
                                    </label>
                                    <?php
                                }
                                ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td><input type="submit" value="<?= Lang::getText('submit'); ?>"/></td>
                    </tr>
                </table>
            </form>
		</div>
    </body>
</html>