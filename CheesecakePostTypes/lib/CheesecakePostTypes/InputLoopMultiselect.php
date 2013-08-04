<?php

namespace CheesecakePostTypes;

class InputLoopMultiselect extends Forms
{
	private $default_select_text = 'Choose...';
	private $multiselect_wrapper_class = 'custom-multiselect';
	private $multiselect_class = 'custom-select-loop';
	private $chosen_class = 'chzn-select';
	private $placeholder = 'Write something or click to choose';
	// Post type for loops
	public $post_type;
	// Number of maximum choices
	private $max_multiple;

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

		$args = array( 'post_type' => $this->post_type, 'nopaging' => true );
		$loop = new \WP_Query( $args );

		if($loop->have_posts()) : while($loop->have_posts()) : $loop->the_post();
			global $post;
			$value = get_the_title();
			$key = $this->valueType == 'id' ? get_the_ID() : str_replace('?'.$this->post_type.'=','',(basename(get_permalink())));
			$selected = $this->frontend_selected ? Utils::checkForFrontendSelected('select', $key, $this->compare) : 
												   Utils::checkForMultipleSelect($this->post, $this->metaName(), $key, 'select');
			
			if($post->ID !== $this->post) {
				$options[] = array('key' => $key, 'selected' => $selected, 'text'=> $value);
			}

		endwhile; endif; wp_reset_postdata();

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