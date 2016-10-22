<?php

namespace ConteudoSimulado\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class ConteudoSimuladoForm extends AbstractForm{
    public function __construct($options=[]){
        parent::__construct('conteudosimuladoform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject('conteudosimuladoform',$this,$this->inputFilter);

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}