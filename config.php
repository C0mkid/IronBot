<?php

$config = array();

$config['global'] = array(
	'level'			=> LL_DEBUG,
	'port'		  	=> 6667,
	'timeout'		=> 5,
	'nick'			=> 'IronBot',
	'alt'		  	=> '%s_',
	'chan'			=> array('#IronBot', '#Comkid'),
	'exec'			=> array('PRIVMSG NickServ :IDENTIFY IronBot'),
);