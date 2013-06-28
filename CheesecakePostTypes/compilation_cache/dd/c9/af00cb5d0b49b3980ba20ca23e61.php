<?php

/* inputText.html */
class __TwigTemplate_ddc9af00cb5d0b49b3980ba20ca23e61 extends Twig_Template
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
        echo "<input type=\"text\" class=\"";
        if (isset($context["text_class"])) { $_text_class_ = $context["text_class"]; } else { $_text_class_ = null; }
        echo twig_escape_filter($this->env, $_text_class_, "html", null, true);
        echo " ";
        if (isset($context["class"])) { $_class_ = $context["class"]; } else { $_class_ = null; }
        echo twig_escape_filter($this->env, $_class_, "html", null, true);
        echo "\" id=\"";
        if (isset($context["meta_name"])) { $_meta_name_ = $context["meta_name"]; } else { $_meta_name_ = null; }
        echo twig_escape_filter($this->env, $_meta_name_, "html", null, true);
        echo "\" name=\"";
        if (isset($context["meta_name"])) { $_meta_name_ = $context["meta_name"]; } else { $_meta_name_ = null; }
        echo twig_escape_filter($this->env, $_meta_name_, "html", null, true);
        echo "\" value=\"";
        if (isset($context["value"])) { $_value_ = $context["value"]; } else { $_value_ = null; }
        echo twig_escape_filter($this->env, $_value_, "html", null, true);
        echo "\">";
    }

    public function getTemplateName()
    {
        return "inputText.html";
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
