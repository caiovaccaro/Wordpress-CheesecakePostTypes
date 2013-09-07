<?php

namespace CheesecakePostTypes;

/**
 * Base Class
 */
abstract class Cheese
{
	/**
	 * Default separator
	 * @example: Spaced Name turn into spacedSEPARATORname
	 * It's recommended to use the same separator that Wordpress uses: '-'
	 * @var string
	 */
	protected $separator = '-';

	/**
	 * Base template file name
	 * @var string
	 */
	protected $base_template = 'base.html';

	/**
	 * @example: Spaced Name turn into spacedSEPARATORname
	 */
	public function sanitize($string)
	{
		return strtolower(str_replace(' ', $this->separator, remove_accents( $string )));
	}
}

?>