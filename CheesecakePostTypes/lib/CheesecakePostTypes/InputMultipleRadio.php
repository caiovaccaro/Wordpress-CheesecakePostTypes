<?php

namespace CheesecakePostTypes;

class InputMultipleRadio extends Forms
{
	public $multiple_radio_wrapper_class = 'custom-radio-loop-primary';
	public $multiple_radio_wrapper_class_inline = 'custom-radio-loop-inline';
	public $multiple_radio_class = 'custom-radio-block';
	public $multiple_radio_class_inline = 'custom-radio-inline';
	// Options for checkboxes/selects/radio
	public $options;

	public function __construct($args)
	{
		parent::__construct($args);
	}

	public function render()
	{
		$options = array();
		$wrapper_class = $this->inline ? $this->multiple_radio_wrapper_class_inline : $this->multiple_radio_wrapper_class;
		$radio_class = $this->inline ? $this->multiple_radio_class_inline : $this->multiple_radio_class;

		foreach ($this->options as $option) {
			$key = $this->sanitize($option);
			$selected = $this->frontend_selected ? Utils::checkForFrontendSelected('select', $option, $this->compare) : Utils::checkForCheckbox($this->post, $this->metaName(), $key);
			$options[] = array('key' => $key, 'selected' => $selected, 'text'=> $option);
		}

		$data = array(
			'options' => $options,
			'wrapper_class' => $wrapper_class,
			'radio_class' => $radio_class
		);

		parent::view(get_class($this), $data);
	}
}

?>