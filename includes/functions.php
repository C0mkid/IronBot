<?php

function request_var($name, $default) // simplified phpBB3 function XD
{
	return (gettype($default) == gettype($_REQUEST[$name])) ? $_REQUEST[$name] : $default;
}