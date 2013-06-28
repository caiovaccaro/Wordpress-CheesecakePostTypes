<?php

namespace CheesecakePostTypes;

abstract class Forms
{
	public $table_class = 'custom-table-primary';
	public $label_class = 'custom-label-primary';
	public $label_cell_class = 'custom-label-primary-table';
	public $input_cell_class = 'custom-input-primary-table';
	public $separator = '-';
	public $base_template = 'base.html';
	// Input suffix name
	public $name;
	// Post type name(prefix name)
	public $context;
	// Post id
	public $post;
	// Input complete name(overwrite)
	public $input;
	// Value of input
	public $value;
	// If input is inline(instead of block - css)
	public $inline;
	// Which option of select is selected by default on page load
	public $frontend_selected;
	// Value to compare with
	public $compare;
	// Css class
	public $class;
	// If true don't show input label
	public $remove_label;
	// Deprecated
	public $index;
	// Deprecated
	public $plugin;

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
	}

	public function sanitize($string)
	{
		return strtolower(str_replace(' ', $this->separator, remove_accents( $string )));
	}

	public function attrName()
	{
		if($this->input) {
			echo $this->context.$this->separator.$this->sanitize($this->input);
		} else {
			echo $this->context.$this->separator.$this->sanitize($this->name);
		}
	}

	public function metaName()
	{
		if($this->input) {
			return $this->context.$this->separator.$this->sanitize($this->input);
		} else {
			return $this->context.$this->separator.$this->sanitize($this->name);
		}
	}

	public function retrieveMetaName($params, $context)
	{
		if($params['input']) {
			return $context.$this->separator.self::sanitize($params['input']);
		} else {
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