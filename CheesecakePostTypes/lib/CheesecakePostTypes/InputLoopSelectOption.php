<?php

namespace CheesecakePostTypes;

class InputLoopSelectOption extends Forms
{
	// Post type for loops
	public $post_type;

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

		$args = array( 'post_type' => $this->post_type, 'nopaging' => true );
		$loop = new \WP_Query( $args );

		if($loop->have_posts()) : while($loop->have_posts()) : $loop->the_post();

			$value = get_the_title();
			$key = str_replace('?'.$this->post_type.'=','',(basename(get_permalink())));
			$selected = $this->frontend_selected ? Utils::checkForFrontendSelected('select', $key, $this->compare) : Utils::checkForMultipleSelectOption($this->post, $this->metaName(), $key, $this->index, $this->plugin);
			
			if($post->ID !== $this->post) {
				$options[] = array('key' => $key, 'selected' => $selected, 'text'=> $value);
			}

		endwhile; wp_reset_postdata(); endif;

		$data = array(
			'meta_name' => $meta_name,
			'options' => $options,
		);

		parent::view(get_class($this), $data);

	}
}

?>