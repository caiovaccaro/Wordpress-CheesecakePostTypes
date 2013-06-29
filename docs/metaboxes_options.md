Metaboxes Options
=================
When you create a metabox you define a few options:
- name (string)
- place (string, optional)
- priority (string, optional)  
  
Name appears as the title of the box. For details about 'place'(in the Codex as 'context') and 'priority' please refer to the [Codex](http://codex.wordpress.org/Function_Reference/add_meta_box#Parameters).  
  
Example:  
```php
$metabox = array(
	'name' => 'Additional info',
	'place' => 'side',
	'priority' => 'high'
);

$movies->addMetabox($metabox, $inputs);
// It's necessary to register your inputs at the time you create the metabox.
//This example assume you have already defined it in the 'inputs' variable.  
```  
  
See the [Input Options Reference](input_options.md) for details about the options of each input type.