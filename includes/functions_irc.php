<?php

class irc
{
	private $config;
	private $log;
	private $handle;
	private $read;

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
		}

		return $this->handle;
	}

	public function read()
	{
		$this->read = fgets($this->handle, 1024);
		return !empty($this->read);
	}
}