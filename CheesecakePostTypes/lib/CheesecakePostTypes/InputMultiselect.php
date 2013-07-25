<?php

namespace CheesecakePostTypes;

class InputMultiselect extends Forms
{
	private $default_select_text = 'Choose...';
	private $multiselect_wrapper_class = 'custom-multiselect';
	private $multiselect_class = 'custom-select-loop';
	private $chosen_class = 'chzn-select';
	private $placeholder = 'Write something or click to choose';
	// Number of maximum choices
	protected $max_multiple;
	// Options for checkboxes/selects
	public $options;
	protected $loop_options;

	public function __construct($args)
	{
		parent::__construct($args);
	}

	public function render()
	{
		$options = array();
		$multiselect_wrapper_class = $this->multiselect_wrapper_class;
		$multiselect_class = $this->multiselect_class;
		$default_select_text = $this->remove_label ? $this->name : $this->default_select_text;
		$max_multiple = $this->max_multiple ? 'max="'.$this->max_multiple.'"' : null;
		$chosen_class = $this->chosen_class;
		$placeholder = $this->placeholder;

		foreach ($this->options as $option) {
			if($this->loop_options) {
				$params = array_merge($option, array('post' => $this->post));
				$loopOption = new InputLoopSelectOption($params);
				$options = array_merge($options, $loopOption->retrieveOptions());
			} else {
				$key = $this->sanitize($option);
				$selected = $this->frontend_selected ? Utils::checkForFrontendSelected('select', $option, $this->compare) : Utils::checkForMultipleSelect($this->post, $this->metaName(), $key);
				$options[] = array('key' => $key, 'selected' => $selected, 'text'=> $option);
			}
		}

		$data = array(
			'options' => $options,
			'default_select_text' => $default_select_text,
			'select_wrapper_class' => $multiselect_wrapper_class,
			'max_multiple' => $max_multiple,
			'multiselect_class' => $multiselect_class,
			'chosen_class' => $chosen_class,
			'placeholder' => $placeholder
		);

		parent::view(get_class($this), $data);
	}
}

?>