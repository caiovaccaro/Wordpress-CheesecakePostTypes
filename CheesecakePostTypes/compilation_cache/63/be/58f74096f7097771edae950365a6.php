<?php

/* inputTextarea.html */
class __TwigTemplate_63be58f74096f7097771edae950365a6 extends Twig_Template
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
        echo "<textarea class=\"";
        if (isset($context["textarea_class"])) { $_textarea_class_ = $context["textarea_class"]; } else { $_textarea_class_ = null; }
        echo twig_escape_filter($this->env, $_textarea_class_, "html", null, true);
        echo " ";
        if (isset($context["class"])) { $_class_ = $context["class"]; } else { $_class_ = null; }
        echo twig_escape_filter($this->env, $_class_, "html", null, true);
        echo "\" id=\"";
        if (isset($context["meta_name"])) { $_meta_name_ = $context["meta_name"]; } else { $_meta_name_ = null; }
        echo twig_escape_filter($this->env, $_meta_name_, "html", null, true);
        echo "\" name=\"";
        if (isset($context["meta_name"])) { $_meta_name_ = $context["meta_name"]; } else { $_meta_name_ = null; }
        echo twig_escape_filter($this->env, $_meta_name_, "html", null, true);
        echo "\">";
        if (isset($context["value"])) { $_value_ = $context["value"]; } else { $_value_ = null; }
        echo twig_escape_filter($this->env, $_value_, "html", null, true);
        echo "</textarea>";
    }

    public function getTemplateName()
    {
        return "inputTextarea.html";
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
