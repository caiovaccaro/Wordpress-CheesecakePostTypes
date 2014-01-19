<?php

namespace CheesecakePostTypes;

class Registry extends Cheese
{
	/**
	 * Global register of classes
	 * @var array
	 */
	private static $_register;

	/**
	 * Set a new registry
	 * @param string $name  Defined name
	 * @param class $class  Class to be registered
	 */
	public static function set($name, $class)
	{
		if(is_null($name)) throw new Exception('You need to set a name to the registry');
		$name = strtolower($name);
		self::$_register[$name] = $class;
	}

	/**
	 * Return class by registry name
	 * @param  string $name  Registry name
	 * @return class         Registry class
	 */
	public static function get($name)
	{
		$name = strtolower($name);
		if (array_key_exists($name, self::$_register)) {
			return self::$_register[$name];
		} else {
			throw new Exception('No class found on the registry.');
		}
	}
}

?>