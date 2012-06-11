<?php

class hook_test
{
	public function __construct()
	{
		global $hooks, $log;

		//$log->add('test');
		$hooks->attach('connect', 'test');
	}

	public function connect()
	{
		global $log;

		$args = func_get_args();
		//var_dump($args[0]);
	}
}