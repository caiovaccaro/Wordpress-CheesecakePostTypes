<?php

namespace CheesecakePostTypes;

class InputLoopRadio extends Forms
{
	public $loop_radio_class = 'custom-radio-block';
	public $loop_radio_class_inline = 'custom-radio-inline';
	public $loop_radio_wrapper_class = 'custom-radio-loop-primary';
	public $loop_radio_wrapper_class_inline = 'custom-radio-loop-inline';
	// Post type for loops
	public $post_type;

	public function __construct($args)
	{
		parent::__construct($args);
	}

	public function render()
	{
		$options = array();
		$wrapper_class = $this->inline ? $this->loop_radio_wrapper_class_inline : $this->loop_radio_wrapper_class;
		$radio_class = $this->inline ? $this->loop_radio_class_inline : $this->loop_radio_class;
		$args = array( 'post_type' => $this->post_type, 'nopaging' => true );
		$loop = new \WP_Query( $args );

		if($loop->have_posts()) : while($loop->have_posts()) : $loop->the_post();
			global $post;
			$value = get_the_title();
			$key = $this->valueType == 'id' ? get_the_ID() : $this->sanitize(str_replace('?'.$this->post_type.'=','',(basename(get_permalink()))));
			$selected = $this->frontend_selected ? Utils::checkForFrontendSelected('radio', $key, $this->compare) :
												   Utils::checkSelectedValue($this->post, $this->metaName(), $key, 'radio');
			
			if($post->ID !== $this->post) {
				$options[] = array('key' => $key, 'selected' => $selected, 'text'=> $value);
			}

		endwhile; wp_reset_postdata();  endif;

		$data = array(
			'options' => $options,
			'wrapper_class' => $wrapper_class,
			'radio_class' => $radio_class
		);

		parent::view(get_class($this), $data);

	}
}

?>