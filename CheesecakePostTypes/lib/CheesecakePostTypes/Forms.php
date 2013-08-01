<?php
namespace CheesecakePostTypes;

abstract class Forms
{
	/**
	 * Default CSS classes
	 * @var string
	 */
	protected $table_class = 'custom-table-primary';
	protected $label_class = 'custom-label-primary';
	protected $label_cell_class = 'custom-label-primary-table';
	protected $input_cell_class = 'custom-input-primary-table';

	/**
	 * Default separator
	 * @example: slug-name turn into slugSEPARATORname
	 * @var string
	 */
	protected $separator = '-';

	/**
	 * Base template file name
	 * @var string
	 */
	protected $base_template = 'base.html';

	/**
	 * Value type in case of loops
	 * To be set in checkboxes, radio buttons, selects
	 * @example: 'id' or 'slug'
	 * @var string
	 */
	protected $valueType = 'id';
	
	/**
	 * Input suffix name
	 * @example: postTypeName_suffixName
	 * @var string
	 */
	protected $name;

	/**
	 * Post type name, input prefix name
	 * @example: postTypeName_suffixName
	 * @var string
	 */
	protected $context;
	
	/**
	 * Post ID
	 * @var integer
	 */
	protected $post;

	
	/**
	 * If set overwrites input complete name
	 * @var string
	 */
	protected $input;

	/**
	 * Input value if it's mean to be set
	 * @var string|number
	 */
	protected $value;

	/**
	 * CSS Inline setting
	 * @var boolean
	 */
	protected $inline;

	/**
	 * If it's mean to set a value and check it as selected
	 * @var boolean
	 */
	protected $frontend_selected;

	/**
	 * Value to compare with.
	 * In case of frontend_selected
	 * @var string|number
	 */
	protected $compare;
	
	/**
	 * CSS class
	 * @var string
	 */
	protected $class;
	
	/**
	 * If true don't show input label
	 * @var boolean
	 */
	protected $remove_label;

	/**
	 * For WP_Editor
	 * Show or not media buttons
	 * @var boolean
	 */
	protected $media_buttons;

	/**
	 * If true in conjunction with 'input' parameter
	 * overwrites the input name including prefix
	 * @var boolean
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