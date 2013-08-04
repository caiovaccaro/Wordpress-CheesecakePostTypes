<?

namespace CheesecakePostTypes;

class InputCheckbox extends Forms
{
	public $checkbox_class = 'custom-checkbox-single-inline';

	public function __construct($args)
	{
		parent::__construct($args);
	}

	public function render()
	{
		$checkbox_class = $this->checkbox_class;
		$value = $this->value;
		$key = $this->sanitize($value);
		$selected = $this->frontend_selected ? Utils::checkForFrontendSelected('checkbox', $value, $this->compare) :
											   Utils::checkSelectedValue($this->post, $this->metaName(), $key, 'checkbox');

		$data = array(
			'checkbox_class' => $checkbox_class,
			'key' => $key,
			'value' => $value,
			'selected' => $selected
		);

		parent::view(get_class($this), $data);
	}
}

?>