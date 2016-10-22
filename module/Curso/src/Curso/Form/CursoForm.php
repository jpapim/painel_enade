<?php

namespace Curso\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class CursoForm extends AbstractForm{
    public function __construct($options=[]){
        parent::__construct('cursoform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject('cursoform',$this,$this->inputFilter);

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}