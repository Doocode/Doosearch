<?php

namespace Gui;

class Window
{
    private $idTag;
    private $title;
    private $content;

    public function __construct($title, $idTag, $content)
    {
        $this->title = $title;
        $this->idTag = $idTag;
        if(!is_null($content))
            $this->content = $content;
    }
    
    public function setContent($content)
    {
        $this->content = $content;
    }
    
    public function toHtml()
    {
        ?>
        <div id="<?= $this->idTag ?>" class="winholder">
            <div class="closeArea" onclick="closeWindow('#<?= $this->idTag ?>');">
            </div>
            <div class="align">
            </div>
            <div class="window">
                <div class="ttl">
                    <h1 id="title"><?= $this->title ?></h1>
                    <img src="res/img/close.png" onclick="closeWindow('#<?= $this->idTag ?>');" />
                </div>
                <div class="ctn">
                    <?= $this->content ?>
                </div>
            </div>
        </div>
        <?php
    }
}