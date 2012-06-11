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
		global $irc, $log;

		if (!empty($args))
		{
			$log->add('[READ] ' . $args[0], LL_VERBOSE);

			$read = explode(' ', $args[0]);
		}
	}

	public function write($args)
	{
		global $log;

		if (!empty($args))
		{
			$log->add('[WRITE] ' . $args[0], LL_VERBOSE);
		}
	}
}