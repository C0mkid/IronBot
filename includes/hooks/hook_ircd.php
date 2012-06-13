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
		global $hooks, $log;

		if (!empty($args))
		{
			$log->add('[READ] ' . $args[0], LL_VERBOSE);

			$read = explode(' ', $args[0]);

			foreach ($read as $v)
			{
				$name = ($v[0] == ':') ? substr($v, 1) : $v;

				if (!$hooks->exists($name))
				{
					$hooks->add($name);
				}

				$hooks->exec($name);
			}
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