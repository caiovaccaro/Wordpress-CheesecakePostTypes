Input Classes
=============
Each form element that CheesecakePostTypes supports has it's own class. If you want you can use them separately.  
  
All classes are namespaced so you should them like:
```php
$companies = new CheesecakePostTypes\InputLoopMultiselect(array('name'=>'Companies', 'post_type'=>'companies'));
$companies->render();
```  
  
Here is a list of all classes available:  
- InputText
- InputTextarea
- InputCheckbox
- InputMultipleCheckbox
- InputLoopCheckbox
- InputMultipleRadio
- InputLoopRadio
- InputSelect
- InputMultiselect
- InputLoopSelect
- InputLoopMultiselect  
  
  
The major difference between using Input Classes separately is that you can define the 'context' option which will define the prefix of your input id and name. When used to create a metabox the prefix is always the post type identifier.  
  
See the [Input Options Reference](input_options.md) for more details about the options of each input type.