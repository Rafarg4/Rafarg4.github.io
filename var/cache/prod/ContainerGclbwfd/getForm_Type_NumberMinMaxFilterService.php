<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'form.type.number_min_max_filter' shared service.

$this->services['form.type.number_min_max_filter'] = $instance = new \PrestaShopBundle\Form\Admin\Type\NumberMinMaxFilterType();

$instance->setTranslator(${($_ = isset($this->services['translator.default']) ? $this->services['translator.default'] : $this->getTranslator_DefaultService()) && false ?: '_'});

return $instance;
