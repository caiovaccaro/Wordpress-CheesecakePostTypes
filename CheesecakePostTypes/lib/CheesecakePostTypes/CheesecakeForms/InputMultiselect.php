<?php

namespace CheesecakePostTypes\CheesecakeForms;

use CheesecakePostTypes;

class InputMultiselect extends Forms
{
	private $multiselect_wrapper_class = 'custom-multiselect';
	private $multiselect_class = 'custom-select-loop';
	private $chosen_class = 'chzn-select';
	private $placeholder = 'Write something or click to choose';
	// Number of maximum choices
	private $max_multiple;
	// Options for checkboxes/selects
	public $options;

	public function __construct($args)
	{
		parent::__construct($args);
	}

	public function render()
	{
		$options = array();
		$multiselect_wrapper_class = $this->multiselect_wrapper_class;
		$multiselect_class = $this->multiselect_class;
		$default_select_text = $remove_label ? $this->name : $this->default_select_text;
		$max_multiple = $this->max_multiple;
		$chosen_class = $this->chosen_class;
		$placeholder = $this->placeholder;

		foreach ($this->options as $option) {
			$key = $this->sanitize($option);
			$selected = $this->frontend_selected ? CheesecakePostTypes\Utils::checkForFrontendSelected('select', $option, $this->compare) : CheesecakePostTypes\Utils::checkForMultipleSelect($this->post, $this->metaName(), $option);
			$options[] = array('key' => $key, 'selected' => $selected, 'text'=> $option);
		}

		$data = array(
			'options' => $options,
			'default_select_text' => $default_select_text,
			'select_wrapper_class' => $select_wrapper_class,
			'max_multiple' => $max_multiple,
			'multiselect_class' => $multiselect_class,
			'chosen_class' => $chosen_class,
			'placeholder' => $placeholder
		);

		parent::view(get_class($this), $data);
	}
}

?>