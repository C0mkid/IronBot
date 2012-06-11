<?php

class irc
{
	private $config;
	private $handle;
	private $read;

	public function __construct()
	{
		global $hooks;

		$hooks->add('set');
		$hooks->add('connect');
		$hooks->add('read');
		$hooks->add('write');
	}

	public function set($name, $variable)
	{
		global $hooks;

		$hooks->exec('set', $name, $variable);
		$this->config[$name] = $variable;
	}

	public function loadConfig()
	{
		global $config;
		$this->config = $config;
	}

	public function connect()
	{
		global $hooks;

		$hooks->exec('connect', $this->config['server'], $this->config['port'], $this->config['timeout']);

		$this->handle = fsockopen($this->config['server'], $this->config['port'], $errno, $errstr, $this->config['timeout']);

		//$hooks->exec('connect', $this->config['server'], $this->config['port'], $this->config['timeout']);

		if ($this->handle)
		{
			stream_set_timeout($this->handle, $this->config['timeout']);

			return true;
		}

		return false;
	}

	public function read()
	{
		global $hooks;

		$this->read = fgets($this->handle, 1024);
		if (!empty($this->read))
		{
			$hooks->exec('read', $this->read);
			return $this->read;
		}

		return false;
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

	public function connected()
	{
		if ($this->handle && !feof($this->handle))
		{
			return true;
		}

		return false;
	}
}