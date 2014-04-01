<?php

namespace CheesecakePostTypes;

class PostType extends Cheese
{
	private $name;
	private $unique_name;
	private $singular_name;
	private $plural_name;
	private $menu_name;
	private $supports;
	private $menu_position;
	private $hierarchical;
	private $show_in_menu;
	private $show_ui;

	public function __construct($params)
	{
		foreach ($params as $key => $value) {
			if(property_exists($this, $key)) {
				$this->$key = $value;
			}
		}

		if(!isset($params['plural_name'])) {
			$this->plural_name = $this->singular_name.'s';
		}

		$this->unique_name = $this->name ? $this->name : $this->sanitize($this->plural_name);
		Registry::set($this->unique_name, $this);
	}

	public function getUniqueName()
	{
		return $this->unique_name;
	}

	public function register()
	{
		$post_type = $this->getUniqueName();
		$plural = $this->plural_name;
		$singular = $this->singular_name;
		$menu_position = $this->menu_position;
		$supports = $this->supports ? $this->supports : array( 'title', 'editor', 'thumbnail', 'page-attributes' );

		$labels = array(
			'name'               => __( $plural ),
			'singular_name'      => __( $singular ),
			'add_new'            => __( 'New' ),
			'add_new_item'       => __( 'New '.$singular ),
			'edit_item'          => __( 'Edit '.$singular ),
			'new_item'           => __( 'New '.$singular ),
			'all_items'          => __( 'All '.$plural ),
			'view_item'          => __( 'See '.$singular ),
			'search_items'       => __( 'Search '.$plural ),
			'not_found'          => __( 'None '.$singular.' found' ),
			'not_found_in_trash' => __( 'None '.$singular.' found in trash' ), 
			'parent_item_colon'  => '',
			'menu_name'          => $plural
		);
		$args = array(
			'labels'        => $labels,
			'description'   => 'Registration of '.$plural,
			'public'        => true,
			'menu_position' => $menu_position,
			'supports'      => $supports,
			'show_in_nav_menus' => true,
			'capability_type' => 'page',
			'hierarchical' => $this->hierarchical ? $this->hierarchical : true,
			'show_ui' => true,
			'show_in_menu' => $this->show_in_menu ? $this->show_in_menu : true
		);

		add_action( 'init', function() use($post_type, $args)
		{

			register_post_type( $post_type, $args );

		});
	}

	public function addMetabox($params, $inputs)
	{
		$name = $params['name'];
		$identifier = $this->sanitize($name);
		$post_type = $this->getUniqueName();
		$place = isset($params['place']) ? $params['place'] : 'normal';
		$priority = isset($params['priority']) ? $params['priority'] : 'low';
		$separator = $this->separator;
		$content_nonce_name = $post_type.$separator.$identifier.$separator.'content'.$separator.'nonce';
		$meta_box_name = $post_type.$separator.$identifier;
		$inputs_to_save = array();

		foreach ($inputs as $input) {
		    $inputs_to_save[] = Forms::retrieveMetaName($input['params'], $post_type);
		}

		add_action( 'add_meta_boxes', function() use($name, $identifier, $post_type, $place, $priority, $inputs, $content_nonce_name, $meta_box_name)
		{
			global $post;
			$post_id = $post->ID;

			add_meta_box( $meta_box_name, $name,
				function() use($post_id, $post_type, $inputs, $content_nonce_name)
				{
				    wp_nonce_field( plugin_basename(__FILE__), $content_nonce_name );
				    
				    foreach ($inputs as $input) {
				      	$basic_params = array('context'=>$post_type, 'post'=>$post_id);
				      	$params = array_merge($input['params'], $basic_params);
				        $class = 'CheesecakePostTypes\Input'.ucfirst($input['type']);
				        $meta_box_input = new $class($params);
				        $meta_box_input->render();
				    }
				},
			$post_type, $place, $priority );
		});
		
		$this->setupSave(array(
			'content_nonce_name' => $content_nonce_name,
			'inputs_to_save' => $inputs_to_save
		));
	}

	public function setupSave($params)
	{
		$content_nonce_name = $params['content_nonce_name'];
		$inputs = $params['inputs_to_save'];

		add_action( 'save_post', function() use($content_nonce_name, $inputs)
		{
			global $post;

			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return;

			if ( isset($_POST[$content_nonce_name]) && !wp_verify_nonce( $_POST[$content_nonce_name], plugin_basename(__FILE__) ) )
			return;

			if ( isset($_POST['post_type']) && 'page' == $_POST['post_type'] ) {
				if ( isset($post) && !current_user_can( 'edit_page', $post->ID ) )
				return;
			} else {
				if ( isset($post) && !current_user_can( 'edit_post', $post->ID ) )
				return;
			}

			foreach ($inputs as $input) {
				if(isset($_POST[$input])) {
					$post_data = $_POST[$input];
					update_post_meta( $post->ID, $input, $post_data );
				} else {
					update_post_meta( $post->ID, $input, '' );
				}
			}
		});
	}

	public function addTaxonomy($params)
	{
		$post_type = $this->getUniqueName();
		$singular = isset($params['singular']) ? $params['singular'] : null;
		$plural = isset($params['plural']) ? $params['plural'] : $singular.'s';
		$name = isset($params['name']) ? $params['name'] : $post_type.$this->separator.$this->sanitize($singular);
		$hierarchical =  isset($params['hierarchical']) && $params['hierarchical'] == 'true' ? true : false;

		if(!$singular) throw new Exception('Define "singular" parameter');

		add_action( 'init', function() use($post_type, $name, $singular, $plural, $hierarchical)
		{

			$args = array(
				'hierarchical' => $hierarchical,
				'labels' => array(
					'name' => _x( $plural, 'taxonomy general name' ),
					'singular_name' => _x( $singular, 'taxonomy singular name' ),
					'search_items' =>  __( 'Search '.$plural ),
					'all_items' => __( 'All '.$plural ),
					'parent_item' => __( 'Parent '.$plural ),
					'parent_item_colon' => __( 'Parent '.$singular.':' ),
					'edit_item' => __( 'Edit '.$singular ),
					'update_item' => __( 'Update '.$singular ),
					'add_new_item' => __( 'Add new '.$singular ),
					'new_item_name' => __( 'New name of '.$singular ),
					'menu_name' => __( $plural ),
				),
				'rewrite' => array(
					'with_front' => false,
					'hierarchical' => $hierarchical 
				)
			);
			register_taxonomy($name, $post_type, $args);

		}, 0 );
	}
}

?>