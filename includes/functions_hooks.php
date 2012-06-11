<?php

class hooks
{
	public $objects = array();
	public $hooks = array();

	public function __construct()
	{

	}

	public function add($name)
	{
		$this->hooks[$name] = array();
	}

	public function del($name)
	{
		unset($this->hooks[$name]);
	}

	public function exec($name)
	{
		if (!array_key_exists($name, $this->hooks))
		{
			return;
		}

		$args = array();

		if (func_num_args() > 1)
		{
			$args = func_get_args();
			array_shift($args);
		}

		foreach ($this->hooks[$name] as $object)
		{
			$this->objects[$object]->$name($args);
		}
	}

	public function attach($name, $object)
	{
		$this->hooks = array_merge($this->hooks, array($name => (array_key_exists($name, $this->hooks)) ? array_merge($this->hooks[$name], array($object)) : array($object)));
	}

	public function detach($name, $object)
	{
		if (array_search($object, $this->hooks[$name]))
		{
			unset($this->hooks[$name][array_search($object, $this->hooks[$name])]);
		}
	}
}