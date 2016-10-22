<?php

namespace Simulado\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class SimuladoForm extends AbstractForm{
    public function __construct($options=[]){
        parent::__construct('simuladoform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject('simuladoform',$this,$this->inputFilter);

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}