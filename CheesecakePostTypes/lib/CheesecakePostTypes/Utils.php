<?php

namespace CheesecakePostTypes;

/**
 * General Utility class
 */
class Utils extends Cheese
{

	/**
	 * Check selected value Selects, Radio, Checkboxes
	 * @param  integer $post   Post ID
	 * @param  string  $meta   Custom meta key name
	 * @param  string  $value  Custom meta value to compare
	 * @param  string  $type   Input type: select, checkbox, radio
	 * @return string          Return if selected
	 */
	public function checkSelectedValue($post, $meta, $value, $type)
	{
		$compare = get_post_meta( $post, $meta, true );
		$selected = $type == 'select' ? 'selected="selected"' : 'checked="checked"';

		if(is_array($compare)) {
			foreach ($compare as $select) {
				if($value == $select) {
					return $selected;
				}
			}
		} elseif(strpos($compare, ', ')) {
			$array = explode(', ', $compare);

			foreach ($array as $select) {
				if($value == $select) {
					return $selected;
				}
			}
		} else {
			if($value == $compare) {
				return $selected;
			}
		}
	}

	/**
	 * Check for selected value on outside WP Admin
	 * @param  string $type    Input type: select, radio, checkbox
	 * @param  string $value   Actual value
	 * @param  string $compare Value to compare
	 * @return string          Return if selected
	 */
	public function checkFrontendSelected($type, $value, $compare)
	{
		$selected = $type == 'checkbox' || $type == 'radio' ? 'checked="checked"' : 'selected="selected"';

		if($value == $compare) {
			return $selected;
		}
	}

	/**
	 * Return Post Title from Custom Post Type by ID
	 * @param  string $post_type
	 * @param  integer $id       
	 * @return string            
	 */
	public function getPostTypeTitleFromId($post_type, $id)
	{
		$args = array( 'post_type' => $post_type, 'nopaging' => true, 'p' => $id );
		$loop = new \WP_Query( $args );

		if($loop->have_posts()) : while($loop->have_posts()) : $loop->the_post();

			return get_the_title();

		endwhile; wp_reset_postdata(); endif;
	}

	/**
	 * Return Page Id by slug
	 * @param  string $page_slug
	 * @return integer
	 */
	public function getPageIdBySlug($page_slug)
	{
	    $page = get_page_by_path($page_slug);
	    if($page) {
	        return $page->ID;
	    } else {
	        return null;
	    }
	}

	public function joinTerms($post_type, $tax, $id, $base_url, $link = 'link') {

		$taxonomy = get_the_terms($id, $post_type.'_'.$tax);
		$post_type_id = get_ID_by_slug($post_type);
		$base_post_type_url = get_permalink($post_type_id);

		if(!$base_url) {
			$path = $base_post_type_url;
		} else {
			$path = $base_url;
		}

		if($taxonomy && !is_wp_error( $taxonomy )) {
			$taxonomies = array();

			foreach ( $taxonomy as $term ) {
				$url = add_query_arg(array('taxonomy'=>$post_type.$this->separator.$tax, 'tv'=>$term->slug), $path);
				if($link == 'link') {
					$atag = '<a href="'.$url.'">';
					$aclose = '</a>';
				}
				$taxonomies[] = $atag.$term->name.$aclose;
			}
								
			$taxonomy = join( ', ', $taxonomies );
		}

		return $taxonomy;
	}
}

?>