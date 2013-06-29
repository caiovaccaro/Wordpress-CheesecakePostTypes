PostType Options
================
You can create a post type just with 'singular_name', but if you want you can set additional options. Here is a list:
- singular_name (string)
- plural_name (string, optional)
- menu_name (string, optional)
- menu_position (number, optional)
- supports (array, optional)  
  
For more details about the 'supports' parameter and 'menu_position' refer to the [Codex](http://codex.wordpress.org/Function_Reference/register_post_type#Arguments).  
Wordpress Post Types has a lot of flexibility and different options. More of them can be added in the future.  
  
Example:  
```php
$postType = array(
	'singular_name'=> 'Company',
	'plural_name'=> 'Companies',
	'menu_name'=> 'Wonderful Places',
	'menu_position'=> 4,
	'supports'=> array( 'title', 'thumbnail' )
);

$companies = new CheesecakePostTypes\PostType($postType);
$companies->register();
``` 
  
See the [Metaboxes Options Reference](metaboxes_options.md)