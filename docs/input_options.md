Input Options Reference
=======================
When creating a meta box you can set which input fields you want in this way:
```php
$inputs = array(
	array('type'=>'text', 'params' => array('name'=>'Movie name'))
);
$metabox = array(
	'name' => 'Info'
);

$movies->addMetabox($metabox, $inputs);
```  
  
The first parameter of the inputs array is 'type'. Here is the list of all the types you can choose:
- text
- textarea
- checkbox
- multipleCheckbox
- loopCheckbox
- multipleRadio
- loopRadio
- select
- multiselect
- loopSelect
- loopMultiselect
  
When a 'type' prefix is multiple it means you have to set its options. When a 'type' prefix is loop it means you need to specify the post type from which it will fetch data for your input.  
You can use all types separately. Please refer to the [Input Classes Reference](input_classes.md).

Common options
--------------
All types share these common options:
- name (string)
- input (string, optional)
- frontend_selected (string, optional. Using as a separate class)
- compare (string, optional. Using as a separate class)
- class (string, optional)
- remove_label (string, optional)
  
The 'name' option define the label and suffix of your input id and name.  
You can use the 'input' option if you want to overwrite the suffix of your input id and name.  
Setting the 'class' option will define a css class to your input.  
If 'remove_label' is the string 'true' it will remove the label.  

The 'frontend_selected' option is used together with 'compare' and is useful when you use the class outside meta boxes. If you are using your input separately or somehow setting it's value in a way that it's not from the normal get_post_meta you can set 'frontend_selected' to the string 'true' and 'compare' to the string you want to compare with so it will mark selects, checkboxes and radio buttons as selected if you have a option with the same value.  
  
Example:  
```php
$inputs = array(
	array('type'=>'text', 'params' => array('name'=>'Movie name', 'input'=> 'name', 'class'=> 'movie_name', 'remove_label'=> 'true'))
);

// Using the class in the frontend. Maybe handling a form submission
$compare = $_POST['my-form-company-rate'];
$rate = new CheesecakePostTypes\InputMultipleRadio(array('name'=>'Company rate', 'context'=>'my-form', 'options'=> array('Good', 'Regular'), 'frontend_selected'=> 'true', 'compare'=> $compare));
```  
  
When creating inputs inside a meta box, the 'context'(id and name prefix) is always the post type identifier, so your input id and name will always be 'post-type-identifier-your-input-name'. If you create a input directly with a class you can set the 'context' to whataver you want. If you don't specify the 'context' it will be 'cheesecake'.

Specific options
-----------------
Some types have additional options:
- select (extra parameter 'options', array of strings)
- multiSelect (extra parameter 'options', array of strings), (extra parameter 'max_multiple', number of maximum choices)
- multipleRadio (extra parameter 'options', array of strings)
- multipleCheckbox (extra parameter 'options', array of strings)
- checkbox (extra parameter 'value', string)
- loopCheckbox (extra parameter 'post_type', string)
- loopRadio (extra parameter 'post_type', string)
- loopSelect (extra parameter 'post_type', string)
- loopMultiselect (extra parameter 'post_type', string), (extra parameter 'max_multiple', number of maximum choices)  
Example:  
```php
$inputs = array(
	array('type'=>'loopMultiselect', 'params' => array('name'=>'Companies', 'post_type'=> 'companies', 'max_multiple'=> '4')),
	array('type'=>'loopRadio', 'params' => array('name'=>'Rate', 'options'=> array('Wonderful', 'Good', 'Regular', 'Hmm')))
);
```  
  
You can discover your post type identifier clicking on it in your admin panel and looking in the address bar for '?post_type='