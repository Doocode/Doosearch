<?php

// src/res/core/Admin/Administration.php

namespace Admin;

class Administration
{    
    public static function printStatus($status)
    {
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
        ?><p class="info inline <?= $bgColor ?>"><?= $msg ?></p><?php // Fail UTF-8 by urldecode()
    }
}
