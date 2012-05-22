<?php

set_time_limit(0);
date_default_timezone_set('Australia/Melbourne');

include($root_path . 'config.php');
include($root_path . 'includes/functions.php');
include($root_path . 'includes/functions_logs.php');

$log = new log();
$log->spacer(1);

$dir = scandir($root_path . 'includes/');
array_shift($dir);
array_shift($dir);

foreach ($dir as $file)
{
    if ($file != 'functions.php' && $file != 'functions_logs.php' && strpos($file, '.' . $phpEx) !== false)
    {
        include($root_path . 'includes/' . $file);
        $name = preg_match('/functions_([a-zA-Z0-9\-_]*)\.php/', $file, $matches);
        $name = $matches[1];
        $$name = new $name();
    }
}

$dir = scandir($root_path . 'includes/hooks/');
array_shift($dir);
array_shift($dir);

foreach ($dir as $file)
{
    if (strpos($file, '.' . $phpEx) !== false)
    {
        include($root_path . 'includes/hooks/' . $file);
        preg_match('/(hook_([a-zA-Z0-9\-_]*))\.php/', $file, $matches);
        $hooks->objects[$matches[2]] = new $matches[1]();
    }
}