<?php
use Language\Lang;
Lang::setSection('header');
?>
<header id="head">
	<div class="ctn">
		<div>
			<img class="btnMenu" onclick="showHeaderMenu();" src="res/img/header/menu.png" />
			<p class="logo" title="<?= Lang::getKey('home'); ?>"><a href="index.php"><img src="res/img/header/white-flat-logo-header.png" /></a></p>
		</div>
		
        <span class="right">
            <?php Lang::setSection('hub'); ?>
            <span id="hubPages">
                <a id="setupPage" href="setup.php" title="<?= Lang::getKey('first_steps', array('app_name' => $_APP['app_name'])); ?>"><img src="res/img/header/home.png" /></a>
                <a id="searchPage" href="search.php" title="<?= Lang::getKey('start_searching'); ?>"><img src="res/img/header/search.png" /></a>
                <a id="quickAccessPage" href="quickaccess.php" title="<?= Lang::getKey('quick_access'); ?>"><img src="res/img/header/quickaccess.png" /></a>
                <a id="configPage" href="configuration.php" title="<?= Lang::getKey('configure_app', array('app_name' => $_APP['app_name'])); ?>"><img src="res/img/header/config.png" /></a>
            </span>
            <div class="dropdown" id="btnUser">
                <?php Lang::setSection('account'); ?>
                <img src="res/img/header/user.png" title="<?= Lang::getKey('account'); ?>" />
                
                <?php if(isset($_SESSION['user_name'])) 
                {
                ?>
                <ul class="menu">
                    <div class="content">
                        <h2><?= $_SESSION['user_name']; ?></h2>
                        <br>
                        <li>
                            <a href="account.php">
                                <?= Lang::getKey('my_account'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="logout.php">
                                <?= Lang::getKey('logout'); ?>
                            </a>
                        </li>
                    </div>
                </ul>
                <?php } else {?>
                <ul class="menu">
                    <div class="content">
                        <h2><?= Lang::getKey('account'); ?></h2>
                        <br>
                        <li>
                            <a href="login.php#login">
                                <?= Lang::getKey('login'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="login.php#register">
                                <?= Lang::getKey('register'); ?>
                            </a>
                        </li>
                    </div>
                </ul>
                <?php }?>
            </div>
            <div class="dropdown" id="btnLang">
                <?php Lang::setSection('language'); ?>
                <img src="res/img/header/flag.png" title="<?= Lang::getKey('language'); ?>" />
                <ul class="menu icons">
                    <div class="content">
                        <h2><?= Lang::getKey('language'); ?></h2>
                        <br>
                        <li class="<?php if($_APP['language']=='english') echo 'selected'; ?>">
                            <a href="?lang=en">
                                <img src="res/img/lang/english.png"/ >
                                <span><?= Lang::getKey('english'); ?></span>
                            </a>
                        </li>
                        <li class="<?php if($_APP['language']=='french') echo 'selected'; ?>">
                            <a href="?lang=fr">
                                <img src="res/img/lang/french.png"/ >
                                <span><?= Lang::getKey('french'); ?></span>
                            </a>
                        </li>
                    </div>
                </ul>
            </div>
            <img class="btnFamily" onclick="showFamily();" title="Doocode Family" src="res/img/header/family.png" />
        </span>
	</div>
    
	<?php Lang::setSection('header'); ?>
	<ul class="pages">
		<li id="homePage">
			<a href="index.php">
				<span><?= Lang::getKey('home'); ?></span>
			</a>
		</li>
		<!--li id="discoverPage">
			<a href="discover.php">
				<span><?= Lang::getKey('discover'); ?></span>
			</a>
		</li-->
		<li id="downloadPage">
            <a href="download.php">
				<span><?= Lang::getKey('download'); ?></span>
			</a>
		</li>
		<li id="contactPage">
			<a href="contact.php">
				<span><?= Lang::getKey('contact'); ?></span>
			</a>
		</li>
		<li id="aboutPage">
			<a href="about.php">
				<span><?= Lang::getKey('about'); ?></span>
			</a>
		</li>
	</ul>
</header>

<nav class="family">
	<ul>
		<h1>Doocode Family</h1>
		<li>
			<a href="https://doocode.xyz/">
				<img src="res/img/family/doocode.png" />
				<span>Doocode</span>
			</a>
		</li>
		<li>
			<a href="https://chronos.doocode.xyz/">
				<img src="res/img/family/doochronos.png" />
				<span>Doochronos</span>
			</a>
		</li>
		<li>
			<a href="https://search.doocode.xyz/">
				<img src="res/img/family/doosearch.png" />
				<span>Doosearch</span>
			</a>
		</li>
		<li>
			<a href="https://scape.doocode.xyz/">
				<img src="res/img/family/dooscape.png" />
				<span>Dooscape</span>
			</a>
		</li>
		<li>
			<a href="https://doocode.xyz/backgrounds.html">
				<img src="res/img/family/darts.png" />
				<span>Doocode Fonds d'écrans</span>
			</a>
		</li>
	</ul>
</nav>