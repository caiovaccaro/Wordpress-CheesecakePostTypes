<?php

/* inputMultipleRadio.html */
class __TwigTemplate_42dc1f5a8040f77b5851243356ea3aa2 extends Twig_Template
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
        echo "<div class=\"";
        if (isset($context["wrapper_class"])) { $_wrapper_class_ = $context["wrapper_class"]; } else { $_wrapper_class_ = null; }
        echo twig_escape_filter($this->env, $_wrapper_class_, "html", null, true);
        echo "\">
";
        // line 2
        if (isset($context["options"])) { $_options_ = $context["options"]; } else { $_options_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_options_);
        foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
            // line 3
            echo "\t<input name=\"";
            if (isset($context["meta_name"])) { $_meta_name_ = $context["meta_name"]; } else { $_meta_name_ = null; }
            echo twig_escape_filter($this->env, $_meta_name_, "html", null, true);
            echo "[]\" type=\"radio\" value=\"";
            if (isset($context["option"])) { $_option_ = $context["option"]; } else { $_option_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_option_, "key"), "html", null, true);
            echo "\" ";
            if (isset($context["option"])) { $_option_ = $context["option"]; } else { $_option_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_option_, "selected"), "html", null, true);
            echo "> ";
            if (isset($context["option"])) { $_option_ = $context["option"]; } else { $_option_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_option_, "text"), "html", null, true);
            echo "
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 5
        echo "</div>";
    }

    public function getTemplateName()
    {
        return "inputMultipleRadio.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  49 => 5,  30 => 3,  25 => 2,  56 => 10,  47 => 9,  41 => 8,  37 => 6,  35 => 5,  29 => 4,  26 => 3,  19 => 1,);
    }
}
