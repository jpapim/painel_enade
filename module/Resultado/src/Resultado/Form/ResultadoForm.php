<?php

namespace Resultado\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class ResultadoForm extends AbstractForm{
    public function __construct($options=[]){
        parent::__construct('resultadoform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject('resultadoform',$this,$this->inputFilter);

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}