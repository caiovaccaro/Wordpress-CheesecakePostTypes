<?php

namespace CheesecakePostTypes;

class InputLoopSelect extends Forms
{
	public $default_select_text = 'Choose...';
	public $select_wrapper_class = 'custom-select-loop';
	// Post type for loops
	public $post_type;

	public function __construct($args)
	{
		parent::__construct($args);
	}

	public function render()
	{
		$options = array();
		$select_wrapper_class = $this->select_wrapper_class;
		$default_select_text = $this->remove_label ? $this->name : $this->default_select_text;

		$args = array( 'post_type' => $this->post_type, 'nopaging' => true );
		$loop = new \WP_Query( $args );

		if($loop->have_posts()) : while($loop->have_posts()) : $loop->the_post();
			global $post;
			$value = get_the_title();
			$key = $this->valueType == 'id' ? get_the_ID() : str_replace('?'.$this->post_type.'=','',(basename(get_permalink())));
			$selected = $this->frontend_selected ? Utils::checkForFrontendSelected('select', $key, $this->compare) :
												   Utils::checkForSelect($this->post, $this->metaName(), $key, 'select');
			
			if($post->ID !== $this->post) {
				$options[] = array('key' => $key, 'selected' => $selected, 'text'=> $value);
			}

		endwhile; wp_reset_postdata(); endif;

		$data = array(
			'options' => $options,
			'default_select_text' => $default_select_text,
			'select_wrapper_class' => $select_wrapper_class
		);

		parent::view(get_class($this), $data);

	}
}

?>