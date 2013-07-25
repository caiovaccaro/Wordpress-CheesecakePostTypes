<?php

namespace CheesecakePostTypes;

abstract class Forms
{
	protected $table_class = 'custom-table-primary';
	protected $label_class = 'custom-label-primary';
	protected $label_cell_class = 'custom-label-primary-table';
	protected $input_cell_class = 'custom-input-primary-table';
	protected $separator = '-';
	protected $base_template = 'base.html';
	// Input suffix name
	protected $name;
	// Post type name(prefix name)
	protected $context;
	// Post id
	protected $post;
	// Input complete name(overwrite)
	protected $input;
	// Value of input
	protected $value;
	// If input is inline(instead of block - css)
	protected $inline;
	// Which option of select is selected by default on page load
	protected $frontend_selected;
	// Value to compare with
	protected $compare;
	// Css class
	protected $class;
	// If true don't show input label
	protected $remove_label;

	/**
	 * For WP_Editor
	 * @var Boolean
	 */
	protected $media_buttons;

	/**
	 * If true in conjunction with 'input' parameter
	 * overwrites the input name including prefix
	 * @var Boolean
	 */
	protected $overwrite_input_name;
	// Deprecated
	protected $index;
	// Deprecated
	protected $plugin;

	public function __construct($args)
	{
		foreach ($args as $key => $value) {
			if(property_exists($this, $key)) {
				$this->$key = $value;
			}
		}

		if(!isset($args['post'])) {
			global $post;
			$this->post = $post->ID;
		}

		if(!isset($args['context'])) {
			$this->context = 'cheesecake';
		}

		if(isset($args['frontend_selected'])) {
			$this->frontend_selected = $args['frontend_selected'] == 'true' ? true : false;
		}
	}

	public function sanitize($string)
	{
		return strtolower(str_replace(' ', $this->separator, remove_accents( $string )));
	}

	public function attrName()
	{
		if($this->input && $this->overwrite_input_name) {
			echo $this->sanitize($this->input);
		} elseif($this->input) {
			echo $this->context.$this->separator.$this->sanitize($this->input);
		} else {
			echo $this->context.$this->separator.$this->sanitize($this->name);
		}
	}

	public function metaName()
	{
		if($this->input && $this->overwrite_input_name) {
			return $this->sanitize($this->input);
		} elseif($this->input) {
			return $this->context.$this->separator.$this->sanitize($this->input);
		} else {
			return $this->context.$this->separator.$this->sanitize($this->name);
		}
	}

	public function retrieveMetaName($params, $context)
	{
		if(isset($params['input']) && isset($params['overwrite_input_name']) && $params['overwrite_input_name']) {
			return $this->sanitize($params['input']);
		} elseif(isset($params['input'])) {
			return $context.$this->separator.self::sanitize($params['input']);
		} else if(isset($params['name'])) {
			return $context.$this->separator.self::sanitize($params['name']);
		}
	}

	public function renderFront($id)
	{
		return get_post_meta( $id, $this->metaName(), true );
	}

	private function returnClassName($class)
	{
		$className = explode('\\', $class); 
		return end($className); 
	}

	public function view($className, $data)
	{
		global $twig;

		$base_data = array(
			'name' => $this->name,
			'meta_name' => $this->metaName(),
			'label_class' => $this->label_class,
			'class' => $this->class ? $this->class : '',
			'remove_label' => $this->remove_label ? true : false,
			'table_class' => $this->table_class,
			'label_cell_class' => $this->label_cell_class,
			'input_cell_class' => $this->input_cell_class,
			'template' => lcfirst($this->returnClassName($className)).'.html'
		);

		$final_data = array_merge($data, $base_data);

		echo $twig->render($this->base_template, $final_data);
	}
}

?>