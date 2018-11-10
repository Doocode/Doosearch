<?php

// src/res/core/Gui/Pagination

namespace Gui;

class Pagination
{
    private $countPages;
    private $currentPage;
    private $args;

    public function __construct($currentPage, $countPages, $args)
    {
        $this->currentPage = $currentPage;
        $this->countPages = $countPages;
        $this->args = $args;
    }
    
    public function toHtml()
    {
        ?>
        <ul class="pagination">
        <?php
            for($i=1; $i<=$this->countPages; $i++)
            {
                $class = '';
                if($i == $this->currentPage)
                    $class = 'current';
                    $args = '';
                    foreach($this->args as $key => $arg)
                        $args .= '&'.$key.'='.$arg;
                ?>
            <li class="<?= $class ?>">
                <a href="?p=<?= $i . $args ?>"><?= $i ?></a>
            </li>
                <?php
            }
        ?>
        </ul>
        <?php
    }
}