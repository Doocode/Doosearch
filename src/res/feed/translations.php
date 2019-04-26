<?php

$lang = array();

$files = scandir('../translations/fr-FR/');
foreach($files as $item)
{
	if($item != '.' && $item != '..' && $item != '.htaccess')
		$lang[$item] = parse_ini_file("../translations/fr-FR/$item", false);
}

header('Content-Type: application/json');
echo json_encode($lang);