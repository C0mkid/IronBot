<?php

class hooks
{
	public $objects = array();
	public $hooks = array();

	public function __construct()
	{
		$this->add('b');
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

		foreach ($this->hooks[$name] as $object)
		{
			$this->objects[$object]->$name();
		}
	}

	public function attach($name, $object)
	{
		$this->hooks[$name] += array($object);
	}

	public function detach($name, $object)
	{
		if (array_search($object, $this->hooks[$name]))
		{
			unset($this->hooks[$name][array_search($object, $this->hooks[$name])]);
		}
	}
}