<?php

$root_path = './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($root_path . 'common.php');

$configs->loadConfig('cool');

$irc->loadconfig();
$irc->connect();

// @TODO: Complete read loop

for ($tick = 0; $irc->connected(); $tick++, $read = $irc->read(), $start = microtime(true))
{
	$log->add('derp', LL_CRITICAL);

	if ($tick == 0)
	{
		$irc->send('NICK ComBot');
		$irc->send('USER ComBot ComBot * :ComBot');
	}

	if ($read)
	{
		//var_dump($read);
	}

	//var_dump(microtime(true) - $start);
}