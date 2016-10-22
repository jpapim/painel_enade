<?php

namespace Disciplina\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class DisciplinaForm extends AbstractForm{
    public function __construct($options=[]){
        parent::__construct('disciplinaform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject('disciplinaform',$this,$this->inputFilter);

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}