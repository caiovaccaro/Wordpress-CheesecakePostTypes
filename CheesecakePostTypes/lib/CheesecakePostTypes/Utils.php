<?php

namespace CheesecakePostTypes;

class Utils
{
	public $separator = '-';

	public function checkForSelect($post, $meta, $value)
	{
		$compare = get_post_meta( $post, $meta, true );

		if($value == $compare) {
			return 'selected="selected"';
		}
	}

	public function checkForMultipleSelect($post, $meta, $value)
	{
		$compare = get_post_meta( $post, $meta, true );

		if(is_array($compare)) {
			foreach ($compare as $select) {
				if($value == $select) {
					return 'selected="selected"';
				}
			}
		} elseif(strpos($compare, ', ')) {
			$array = explode(', ', $compare);

			foreach ($array as $select) {
				if($value == $select) {
					return 'selected="selected"';
				}
			}
		} else {
			if($value == $compare) {
				return 'selected="selected"';
			}
		}
	}

	public function checkForMultipleSelectOption($post, $meta, $value, $i, $plugin)
	{
		if($plugin) {
			$compare = get_option($meta);
		} else {
			$compare = get_post_meta( $post, $meta, true );		
		}

		if($i) {
			$compare = $compare[$i];
		}

		if(is_array($compare)) {
			foreach ($compare as $select) {
				if($value == $select) {
					return 'selected="selected"';
				}
			}
		} elseif(strpos($compare, ', ')) {
			$array = explode(', ', $compare);

			foreach ($array as $select) {
				if($value == $select) {
					return 'selected="selected"';
				}
			}
		} else {
			if($value == $compare) {
				return 'selected="selected"';
			}
		}
	}

	public function checkForCheckbox($post, $meta, $value)
	{
		$compare = get_post_meta( $post, $meta, true );

		if(is_array($compare)) {
			foreach ($compare as $select) {
				if($value == $select) {
					return 'checked="checked"';
				}
			}
		} elseif(strpos($compare, ', ')) {
			$array = explode(', ', $compare);

			foreach ($array as $checkbox) {
				if($value == $checkbox) {
					return 'checked="checked"';
				}
			}
		} else {
			if($value == $compare) {
				return 'checked="checked"';
			}
		}
	}

	public function checkFrontendSelected($type, $value, $compare)
	{
		$text = $type == 'checkbox' || $type == 'radio' ? 'checked="checked"' : 'selected="selected"';

		if($value == $compare) {
			return $text;
		}
	}

	public function getCustomFieldFromSlug($post_type, $id)
	{
		$args = array( 'post_type' => $post_type, 'nopaging' => true, 'name' => $id );
		$loop = new \WP_Query( $args );

		if($loop->have_posts()) : while($loop->have_posts()) : $loop->the_post();

			return get_the_title();

		endwhile; wp_reset_postdata();  endif;
	}

	public function getPageIdBySlug($page_slug)
	{
	    $page = get_page_by_path($page_slug);
	    if ($page) {
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