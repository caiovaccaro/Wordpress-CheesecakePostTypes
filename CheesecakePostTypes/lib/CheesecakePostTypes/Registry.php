<?php
namespace CheesecakePostTypes;
class Registry
{
	private static $_register;

	public static function set($name, $class)
	{
		if(is_null($name)) throw new Exception('You need to set a name to the registry');
		$name = strtolower($name);
		self::$_register[$name] = $class;
	}

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