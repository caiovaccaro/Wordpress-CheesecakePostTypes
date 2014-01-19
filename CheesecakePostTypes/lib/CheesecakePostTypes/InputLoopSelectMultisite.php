<?php

namespace CheesecakePostTypes;

/**
 * Returns posts from all blogs in Multisite
 * in the specified Post Type.
 *
 * Select Keys have blog_id and post_id/post_slug
 */
class InputLoopSelectMultisite extends Forms
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

		$blogs = wp_get_sites();

		foreach ($blogs as $blog) {
			switch_to_blog($blog['blog_id']);

				$args = array( 'post_type' => $this->post_type,
							   'nopaging' => true);

				$loop = new \WP_Query( $args );

				if($loop->have_posts()) : while($loop->have_posts()) : $loop->the_post();
					global $post;
					$value = get_the_title();
					$key = $this->valueType == 'id' ? 'blog_id='.$blog['blog_id'].'&post_id='.get_the_ID() : 'blog_id='.$blog['blog_id'].'&post_slug='.str_replace('?'.$this->post_type.'=','',(basename(get_permalink())));
					
					if($post->ID !== $this->post) {
						$options[] = array('key' => $key, 'text'=> $value);
					}

				endwhile; wp_reset_postdata(); endif;

			restore_current_blog();
		}

		foreach ($options as $key => $post) {
			$selected = $this->frontend_selected ? Utils::checkForFrontendSelected('select', $post['key'], $this->compare) :
												   Utils::checkSelectedValue($this->post, $this->metaName(), $post['key'], 'select');
			$options[$key]['selected'] = $selected;
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