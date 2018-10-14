<?php 

// src/admin.php

include("res/php/core.php"); 

if($_SESSION['user_type'] != 'admin')
    header('Location: account.php');
else
    include("res/views/admin/index.php"); 