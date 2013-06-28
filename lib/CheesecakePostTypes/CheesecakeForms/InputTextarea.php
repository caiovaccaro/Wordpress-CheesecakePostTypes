<?php

namespace CheesecakePostTypes\CheesecakeForms;

class InputTextarea extends Forms
{
	public $textarea_class = 'custom-input-primary';

	public function __construct($args)
	{
		parent::__construct($args);
	}

	public function render()
	{
		$value = preg_replace('#<br\s*?/?>#i', "\n", get_post_meta( $this->post, $this->metaName(), true ));
		$textarea_class = $this->textarea_class;

		$data = array(
			'value' => $value,
			'textarea_class' => $textarea_class
		);

		parent::view(get_class($this), $data);
	}
}

?>