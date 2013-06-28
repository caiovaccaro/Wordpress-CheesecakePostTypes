CheesecakePostTypes
===================

CheesecakePostTypes helps you to build your Wordpress project. In big websites with a lot of post types and custom fields you can get your self repeating a lot of code. This Class is a result of just that.

It uses CSS for a responsive and clean look and also [Chosen](http://harvesthq.github.io/chosen/) for multiple selects.

Setup
-----
Place the 'CheesecakePostTypes' folder inside your theme folder:  
'wp-content/themes/yourtheme/CheesecakePostTypes'  
And in your theme 'functions.php', require the base file of the project:

```php
require_once 'CheesecakePostTypes/Base.php';
```

Create a Post Type
------------------
```php
$postType = array(
	'singular_name'=> 'Movie'
);

$movies = new CheesecakePostTypes\PostType($postType);
$movies->register();
```

Create Meta boxes
-----------------
```php
$inputs = array(
	array('type'=>'text', 'params' => array('name'=>'Movie name')),
	array('type'=>'textarea', 'params' => array('name'=>'Description')),
	array('type'=>'multipleRadio', 'params' => array('name'=>'Has subtitle?', 'options'=>array('Yes', 'No')))
);
$metabox = array(
	'name' => 'Info'
);

$movies->addMetabox($metabox, $inputs);
```

Create Taxonomy
---------------
```php
$taxonomy = array('singular'=>'Category', 'plural'=>'Categories');
$movies->addTaxonomy($taxonomy);
```

Using data from other Post Types
--------------------------------
If you have two post types like 'People' and 'Company', you might want to display all companies in a select box(or maybe multiple select box):
```php
$inputs = array(
	array('type'=>'loopMultiselect', 'params' => array('name'=>'Companies', 'post_type' => 'companies'))
);
$metabox = array(
	'name' => 'Person Companies'
);

$people->addMetabox($metabox, $inputs);
```

Frontend
--------
You can use all forms components that CheesecakePostType uses on the frontend also. For example:
```php
$companies = new CheesecakePostTypes\CheesecakeForms\InputLoopSelect(array('name'=>'Companies', 'post_type'=>'companies'));
$companies->render();
```

Enjoy and feel free to extend CheesecakePostTypes.  
Extended readme with all options coming soon.