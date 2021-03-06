<?php

namespace CheesecakePostTypes;

class InputSelect extends Forms
{
	public $default_select_text = 'Choose...';
	public $select_wrapper_class = 'custom-select-single';
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
		$default_select_text = $this->default_select_text;
		$select_wrapper_class = $this->select_wrapper_class;
		foreach ($this->options as $option) {
			if($this->loop_options) {
				$params = array_merge($option, array('post' => $this->post));
				$loopOption = new InputLoopSelectOption($params);
				$options = array_merge($options, $loopOption->retrieveOptions());
			} else {
				$key = $this->sanitize($option);
				$selected = $this->frontend_selected ? Utils::checkForFrontendSelected('select', $option, $this->compare) :
													   Utils::checkSelectedValue($this->post, $this->metaName(), $key, 'select');
				$options[] = array('key' => $key, 'selected' => $selected, 'text'=> $option);
			}
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