<?php

class irc
{
	private $config;
	private $log;
	private $handle;

	public function __construct()
	{
		global $log;

		$this->log = $log;
	}

	public function set($name, $variable)
	{
		$this->config[$name] = $variable;
	}

	public function connect()
	{
		$this->handle = fsockopen($this->config['server'], $this->config['port'], $errno, $errstr, $this->config['timeout']);

		if ($this->handle)
		{
			stream_set_timeout($this->handle, $this->config['timeout']);

			return true;
		}

		return true;
	}

	public function read()
	{

	}
}