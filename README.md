CheesecakePostTypes
===================

CheesecakePostTypes helps you to build your Wordpress project. In big websites with a lot of post types and custom fields you can get your self repeating a lot of code. This Class is a result of just that.

It uses CSS for a responsive and clean look and also [Chosen](http://harvesthq.github.io/chosen/) for multiple selects.  

**PHP 5.3+ required.**  

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
![Wordpress Post Type](http://192.81.217.195/github/cheesecakePostTypes/1.jpg)  
See the [Post Type Options Reference](docs/post_type_options.md) for details about all available options.  

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
![Wordpress Meta box and fields](http://192.81.217.195/github/cheesecakePostTypes/2.jpg)  
See the [Metabox Options Reference](docs/metaboxes_options.md) for details about all available options.  
See the [Input Options Reference](docs/input_options.md) for details about all available input types and options.  

Create Taxonomy
---------------
```php
$taxonomy = array('singular'=>'Category', 'plural'=>'Categories');
$movies->addTaxonomy($taxonomy);
```  
![Wordpress Taxonomy](http://192.81.217.195/github/cheesecakePostTypes/3.jpg)  
See the [Taxonomy Options Reference](docs/taxonomy_options.md) for details about all available options. 

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
![Wordpress Multiselect](http://192.81.217.195/github/cheesecakePostTypes/4.jpg)  
See the [Input Options Reference](docs/input_options.md) for details about all available input types and options.  

Frontend
--------
You can use all forms components that CheesecakePostType uses on the frontend also. For example:
```php
$companies = new CheesecakePostTypes\InputLoopSelect(array('name'=>'Companies', 'post_type'=>'companies'));
$companies->render();
```  
See the [Input Class Reference](docs/input_classes.md) for a list of available input classes.  
  

Enjoy and feel free to extend CheesecakePostTypes.  

License
-------
The MIT License (MIT)

Copyright (c) 2013 Caio Abib Ramos Vaccaro Mora  
  
Permission is hereby granted, free of charge, to any person obtaining a copy of
this software and associated documentation files (the "Software"), to deal in
the Software without restriction, including without limitation the rights to
use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
the Software, and to permit persons to whom the Software is furnished to do so,
subject to the following conditions:  
  
The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.  
  
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.