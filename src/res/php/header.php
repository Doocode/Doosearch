<?php $lang->setSection('header'); ?>
<header id="head">
	<div class="ctn">
		<div>
			<img class="btnMenu" onclick="showHeaderMenu();" src="res/img/menu.png" />
			<p class="logo" title="<?= $lang->getKey('home'); ?>"><a href="index.php"><img src="res/img/white-flat-logo-header.png" /></a></p>
		</div>
		
        <span class="right">
            <?php $lang->setSection('hub'); ?>
            <span id="hubPages">
                <a id="setupPage" href="setup.php" title="<?= $lang->getKey('first_steps', array('app_name' => $_CORE['app_name'])); ?>"><img src="res/img/home.png" /></a>
                <a id="searchPage" href="search.php" title="<?= $lang->getKey('start_searching'); ?>"><img src="res/img/search.png" /></a>
                <a id="quickAccessPage" href="quickaccess.php" title="<?= $lang->getKey('quick_access'); ?>"><img src="res/img/quickaccess.png" /></a>
                <a id="configPage" href="configuration.php" title="<?= $lang->getKey('configure_app', array('app_name' => $_CORE['app_name'])); ?>"><img src="res/img/config.png" /></a>
            </span>
            <div class="dropdown" id="btnLang">
                <?php $lang->setSection('language'); ?>
                <img src="res/img/flag.png" title="<?= $lang->getKey('language'); ?>" />
                <ul class="menu icons">
                    <div class="content">
                        <h2><?= $lang->getKey('language'); ?></h2>
                        <br>
                        <li class="<?php if($_CORE['language']=='english') echo 'selected'; ?>">
                            <a href="?lang=en">
                                <img src="res/img/lang/english.png"/ >
                                <span><?= $lang->getKey('english'); ?></span>
                            </a>
                        </li>
                        <li class="<?php if($_CORE['language']=='french') echo 'selected'; ?>">
                            <a href="?lang=fr">
                                <img src="res/img/lang/french.png"/ >
                                <span><?= $lang->getKey('french'); ?></span>
                            </a>
                        </li>
                    </div>
                </ul>
            </div>
        </span>
	</div>
    
	<?php $lang->setSection('header'); ?>
	<ul class="pages">
		<li id="homePage">
			<a href="index.php">
				<span><?= $lang->getKey('home'); ?></span>
			</a>
		</li>
		<!--li id="discoverPage">
			<a href="discover.php">
				<span><?= $lang->getKey('discover'); ?></span>
			</a>
		</li-->
		<li id="downloadPage">
            <a href="download.php">
				<span><?= $lang->getKey('download'); ?></span>
			</a>
		</li>
		<li id="contactPage">
			<a href="contact.php">
				<span><?= $lang->getKey('contact'); ?></span>
			</a>
		</li>
		<li id="aboutPage">
			<a href="about.php">
				<span><?= $lang->getKey('about'); ?></span>
			</a>
		</li>
	</ul>
</header>