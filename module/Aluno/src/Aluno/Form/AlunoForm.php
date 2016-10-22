<?php

namespace Aluno\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class AlunoForm extends AbstractForm{
    public function __construct($options=[]){
        parent::__construct('alunoform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject('alunoform',$this,$this->inputFilter);

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}