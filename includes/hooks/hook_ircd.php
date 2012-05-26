<?php

class hook_ircd
{
	public function __construct()
	{
		global $hooks;

		$hooks->attach('read', 'ircd');
		$hooks->attach('write', 'ircd');
	}

	public function read($args)
	{
		global $logs;

		if (!empty($args))
		{
			$logs->add('[READ] ' . $args[0], LL_VERBOSE);
		}
	}

	public function write($args)
	{
		global $logs;

		if (!empty($args))
		{
			$logs->add('[WRITE]' . $args[0], LL_VERBOSE);
		}
	}
}