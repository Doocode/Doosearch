<?php

// src/res/core/Gui/PagePath.php

namespace Gui;
use Language\Lang;

class PagePath
{
    private static $items = array();
    
    public static function addItem($text, $url)
    {
        self::$items[] = array('text' => $text, 'url' => $url);
    }
    
    public static function toHtml()
    {
        Lang::setModule('header');
        ?>
        <ul class="pagepath">
            <li>
                <a href="index.php">
                    <img src="res/img/header/home.png" />
                    <p><?= Lang::getText('home'); ?></p>
                </a>
            </li>
        <?php
        foreach(self::$items as $item)
        {
            ?>
            <li>
                <a href="<?= $item['url'] ?>">
                    <p><?= $item['text'] ?></p>
                </a>
            </li>
            <?php
        }
        ?>
        </ul>
        <?php
    }
}