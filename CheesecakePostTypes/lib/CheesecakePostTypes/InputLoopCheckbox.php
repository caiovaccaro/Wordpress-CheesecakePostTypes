<?php

namespace CheesecakePostTypes;

class InputLoopCheckbox extends Forms
{
	public $loop_checkbox_class = 'custom-checkbox-block';
	public $loop_checkbox_class_inline = 'custom-checkbox-inline';
	public $loop_checkbox_wrapper_class = 'custom-checkbox-loop-primary';
	public $loop_checkbox_wrapper_class_inline = 'custom-checkbox-loop-inline';
	// Post type for loops
	public $post_type;

	public function __construct($args)
	{
		parent::__construct($args);
	}

	public function render()
	{
		$options = array();
		$wrapper_class = $this->inline ? $this->loop_checkbox_wrapper_class_inline : $this->loop_checkbox_wrapper_class;
		$checkbox_class = $this->inline ? $this->loop_checkbox_class_inline : $this->loop_checkbox_class;

		$args = array( 'post_type' => $this->post_type, 'nopaging' => true );
		$loop = new \WP_Query( $args );

		if($loop->have_posts()) : while($loop->have_posts()) : $loop->the_post();
			global $post;
			$value = get_the_title();
			$key = $this->valueType == 'id' ? get_the_ID() : $this->sanitize(str_replace('?'.$this->post_type.'=','',(basename(get_permalink()))));
			$selected = $this->frontend_selected ? Utils::checkForFrontendSelected('checkbox', $key, $this->compare) :
												   Utils::checkSelectedValue($this->post, $this->metaName(), $key, 'checkbox');
			
			if($post->ID !== $this->post) {
				$options[] = array('key' => $key, 'selected' => $selected, 'text'=> $value);
			}

		endwhile; wp_reset_postdata();  endif;

		$data = array(
			'options' => $options,
			'wrapper_class' => $wrapper_class,
			'checkbox_class' => $checkbox_class
		);

		parent::view(get_class($this), $data);

	}
}

?>