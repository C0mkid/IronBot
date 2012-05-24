<?php

class log
{
	private $handle;

	public function __construct()
	{
		global $root_path;

		$dir = scandir($root_path . 'logs/');
		array_shift($dir);
		array_shift($dir);

		$n = 1;

		foreach ($dir as $file)
		{
			if (strpos($file, date('D_d-M-Y')) !== false)
			{
				$n++;
			}
		}

		$this->handle = fopen($root_path . 'logs/' . date('D_d-M-Y') . '_' . $n . '.log', 'a');
	}

	public function add($line, $level = LL_INFO)
	{
		global $config;

		fwrite($this->handle, $line . PHP_EOL);

		if ($level >= $config['level'])
		{
			echo constant('LL_' . $level) . $line . ((!isset($_SERVER['HTTP_USER_AGENT'])) ? PHP_EOL : "<br />");
		}
	}

	public function spacer($type)
	{
		switch ($type)
		{
			case 1:
				$this->add('-------------------------');
			break;

			case 2:
				$this->add('|||||||||||||||||||||||||');
			break;

			default:
			case 0:
				$this->add('');
			break;
		}
	}
}