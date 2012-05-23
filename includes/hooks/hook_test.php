<?php

class hook_test
{
	public function __construct()
	{
		global $hooks, $log;

		$log->add('test');
		$hooks->attach('b', 'test');
	}

	public function b()
	{
		global $log;

		$log->add('b');
	}
}