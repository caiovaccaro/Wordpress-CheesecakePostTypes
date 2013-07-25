<?php
namespace CheesecakePostTypes;

class InputEditor extends Forms
{
	public function __construct($args)
	{
		parent::__construct($args);
	}

	public function render()
	{
		$field_value = get_post_meta( $this->post, $this->metaName(), false );
		$media_buttons = isset($this->media_buttons) ? $this->media_buttons : false;
		wp_editor( $field_value[0], $this->metaName(), array( 'textarea_name' => $this->metaName(), 'media_buttons' => $media_buttons ) );
	}
}

?>