<?php

/* label.html */
class __TwigTemplate_1beac94bd90f415647005465558e4bfb extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<label for=\"";
        if (isset($context["meta_name"])) { $_meta_name_ = $context["meta_name"]; } else { $_meta_name_ = null; }
        echo twig_escape_filter($this->env, $_meta_name_, "html", null, true);
        echo "\" class=\"";
        if (isset($context["label_class"])) { $_label_class_ = $context["label_class"]; } else { $_label_class_ = null; }
        echo twig_escape_filter($this->env, $_label_class_, "html", null, true);
        echo " ";
        if (isset($context["class"])) { $_class_ = $context["class"]; } else { $_class_ = null; }
        echo twig_escape_filter($this->env, $_class_, "html", null, true);
        echo "\">";
        if (isset($context["name"])) { $_name_ = $context["name"]; } else { $_name_ = null; }
        echo twig_escape_filter($this->env, $_name_, "html", null, true);
        echo ": </label>";
    }

    public function getTemplateName()
    {
        return "label.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  56 => 10,  47 => 9,  41 => 8,  37 => 6,  35 => 5,  29 => 4,  26 => 3,  19 => 1,);
    }
}
