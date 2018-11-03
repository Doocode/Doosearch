<?php

// src/res/core/Gui/Pagination

namespace Gui;

class Pagination
{
    private $countPages;
    private $currentPage;

    public function __construct($currentPage, $countPages)
    {
        $this->currentPage = $currentPage;
        $this->countPages = $countPages;
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
                ?>
            <li class="<?= $class ?>">
                <a href="?p=<?= $i ?>"><?= $i ?></a>
            </li>
                <?php
            }
        ?>
        </ul>
        <?php
    }
}