<?php

namespace CheesecakePostTypes\CheesecakeForms;

use CheesecakePostTypes;

class InputMultipleCheckbox extends Forms
{
	public $multiple_checkbox_wrapper_class = 'custom-checkbox-loop-primary';
	public $multiple_checkbox_wrapper_class_inline = 'custom-checkbox-loop-inline';
	public $multiple_checkbox_class = 'custom-checkbox-block';
	public $multiple_checkbox_class_inline = 'custom-checkbox-inline';
	// Options for checkboxes/selects
	public $options;

	public function __construct($args)
	{
		parent::__construct($args);
	}

	public function render()
	{
		$options = array();
		$wrapper_class = $this->inline ? $this->multiple_checkbox_wrapper_class_inline : $this->multiple_checkbox_wrapper_class;
		$checkbox_class = $this->inline ? $this->multiple_checkbox_class_inline : $this->multiple_checkbox_class;

		foreach ($this->options as $option) {
			$key = $this->sanitize($option);
			$selected = $this->frontend_selected ? CheesecakePostTypes\Utils::checkForFrontendSelected('select', $option, $this->compare) : CheesecakePostTypes\Utils::checkForCheckbox($this->post, $this->metaName(), $option);
			$options[] = array('key' => $key, 'selected' => $selected, 'text'=> $option);
		}

		$data = array(
			'options' => $options,
			'wrapper_class' => $wrapper_class,
			'checkbox_class' => $checkbox_class
		);

		parent::view(get_class($this), $data);
	}
}

?>