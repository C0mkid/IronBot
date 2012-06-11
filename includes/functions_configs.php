<?php

class configs
{
	// @TODO: Rewrite configs class

	public function loadConfig($name)
	{
		global $config, $phpEx, $root_path;

		include($root_path . 'includes/configs/config_' . $name . '.' . $phpEx);

		// merge values with arrays together
		foreach ($config[$name] as $setting => $value)
		{
			if (array_key_exists($setting, $config['global']) && is_array($config['global'][$setting]))
			{
				if (!is_array($value))
				{
					$array = array($value);
				}
				else
				{
					$array = $value;
				}

				$server[$setting] = array_merge($config['global'][$setting], $array);
			}
		}

		$config = array_merge($config['global'], $config[$name], $config);
	}

	public function loadConfigs()
	{
		foreach (func_get_args() as $arg)
		{
			$this->loadConfig($arg);
		}
	}
}