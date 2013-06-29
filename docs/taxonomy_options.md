Taxonomy Options
================
You can change this options when creating a taxonomy:
- singular (string)
- plural (string, optional)
- hierarchical (string, optional)
  
Hierarchical can be 'true' or 'false', if set to true it will render as categories(you can have sub-categories). If false(or not set) it will render as tags.  
  
Example:
```php
$taxonomy = array('singular'=>'Category', 'plural'=>'Categories', hierarchical=> 'true');
$movies->addTaxonomy($taxonomy);
```  
  
Check the [Post Type Options Reference](post_type_options.md)