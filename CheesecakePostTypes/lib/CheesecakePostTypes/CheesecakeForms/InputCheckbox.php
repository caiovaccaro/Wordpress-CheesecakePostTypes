<?

namespace CheesecakePostTypes\CheesecakeForms;

use CheesecakePostTypes;

class InputCheckbox extends Forms
{
	public $checkbox_class = 'custom-checkbox-single-inline';

	public function __construct($args)
	{
		parent::__construct($args);
	}

	public function getValue()
	{
		return $this->value;
	}

	public function render()
	{
		$checkbox_class = $this->checkbox_class;
		$value = $this->value;
		$key = $this->sanitize($value);
		$selected = $this->frontend_selected ? CheesecakePostTypes\Utils::checkForFrontendSelected('select', $value, $this->compare) : CheesecakePostTypes\Utils::checkForCheckbox($this->post, $this->metaName(), $this->value);

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