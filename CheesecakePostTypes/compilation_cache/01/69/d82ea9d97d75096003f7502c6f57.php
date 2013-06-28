<?php

/* base.html */
class __TwigTemplate_0169d82ea9d97d75096003f7502c6f57 extends Twig_Template
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
        echo "<table class=\"";
        if (isset($context["table_class"])) { $_table_class_ = $context["table_class"]; } else { $_table_class_ = null; }
        echo twig_escape_filter($this->env, $_table_class_, "html", null, true);
        echo "\">
\t<tr>
\t\t";
        // line 3
        if (isset($context["remove_label"])) { $_remove_label_ = $context["remove_label"]; } else { $_remove_label_ = null; }
        if (($_remove_label_ != true)) {
            // line 4
            echo "\t\t\t<td class=\"";
            if (isset($context["label_cell_class"])) { $_label_cell_class_ = $context["label_cell_class"]; } else { $_label_cell_class_ = null; }
            echo twig_escape_filter($this->env, $_label_cell_class_, "html", null, true);
            echo "\">
\t\t\t\t";
            // line 5
            $this->env->loadTemplate("label.html")->display($context);
            // line 6
            echo "\t\t\t</td>
\t\t";
        }
        // line 8
        echo "\t\t<td class=\"";
        if (isset($context["input_cell_class"])) { $_input_cell_class_ = $context["input_cell_class"]; } else { $_input_cell_class_ = null; }
        echo twig_escape_filter($this->env, $_input_cell_class_, "html", null, true);
        echo "\">
\t\t\t";
        // line 9
        if (isset($context["template"])) { $_template_ = $context["template"]; } else { $_template_ = null; }
        try {
            $template = $this->env->resolveTemplate($_template_);
            $template->display($context);
        } catch (Twig_Error_Loader $e) {
            // ignore missing template
        }

        // line 10
        echo "\t\t</td>
\t</tr>
</table>";
    }

    public function getTemplateName()
    {
        return "base.html";
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
