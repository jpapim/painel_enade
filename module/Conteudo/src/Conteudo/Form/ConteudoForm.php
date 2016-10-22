<?php

namespace Conteudo\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class ConteudoForm extends AbstractForm{
    public function __construct($options=[]){
        parent::__construct('conteudoform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject('conteudoform',$this,$this->inputFilter);

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}