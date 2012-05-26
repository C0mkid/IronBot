<?php

class irc
{
	private $config;
	private $handle;
	private $read;

	public function __construct()
	{
		global $hooks;

		$hooks->add('read');
		$hooks->add('write');
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
		global $hooks;

		$this->read = fgets($this->handle, 1024);
		$hooks->exec('read', !empty($this->read) ? $this->read : null);
		return !empty($this->read) ? $this->read : false;
	}

	public function send($message)
	{
		global $hooks;

		if (!empty($message))
		{
			fwrite($this->handle, $message);
			$hooks->exec('write', $message);
		}
	}
}