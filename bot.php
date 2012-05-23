<?php

$root_path = './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
require($root_path . 'common.php');

$log->add('a');

$hooks->exec('b');