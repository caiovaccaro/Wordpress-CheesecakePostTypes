<?php

namespace CheesecakePostTypes;

class InputText extends Forms
{
	public $text_class = 'custom-input-primary';

	public function __construct($args)
	{
		parent::__construct($args);
	}

	public function render()
	{
		$value = esc_attr( get_post_meta( $this->post, $this->metaName(), true ) );
		$text_class = $this->text_class;
		
		$data = array(
			'value' => $value,
			'text_class' => $text_class
		);

		parent::view(get_class($this), $data);
	}
}

?>