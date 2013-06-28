<?php

namespace CheesecakePostTypes\CheesecakeForms;

use CheesecakePostTypes;

class InputSelect extends Forms
{
	public $default_select_text = 'Escolha...';
	public $select_wrapper_class = 'custom-select-single';
	// Options for checkboxes/selects
	public $options;

	public function __construct($args)
	{
		parent::__construct($args);
	}

	public function render()
	{
		$options = array();
		$default_select_text = $this->default_select_text;
		$select_wrapper_class = $this->select_wrapper_class;

		foreach ($this->options as $option) {
			$key = $this->sanitize($option);
			$selected = $this->frontend_selected ? CheesecakePostTypes\Utils::checkForFrontendSelected('select', $option, $this->compare) : CheesecakePostTypes\Utils::checkForSelect($this->post, $this->metaName(), $option);

			$options[] = array('key' => $key, 'selected' => $selected, 'text'=> $option);
		}

		$data = array(
			'options' => $options,
			'default_select_text' => $default_select_text,
			'select_wrapper_class' => $select_wrapper_class
		);

		parent::view(get_class($this), $data);
	}
}

?>