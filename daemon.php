<?php

$root_path = './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($root_path . 'common.php');

$configs->loadConfig('rizon');

$irc->loadconfig();
$irc->connect();

// @TODO: Complete read loop

for ($tick = 0; $irc->connected(); $tick++, $read = $irc->read(), $start = microtime(true))
{
	$log->add('Tick: ' . $tick, LL_CRITICAL);

	if ($tick == 0)
	{
		$irc->send('NICK ' . $config['nick']);
		$irc->send('USER ' . $config['nick'] . ' 8 * :' . $config['real']);
	}
}

echo PHP_EOL . 'Ran for: ' . var_dump(microtime(true) - $start);