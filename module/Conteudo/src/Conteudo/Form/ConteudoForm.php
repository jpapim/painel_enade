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
        $objForm->hidden("id")->required(false)->label("Id");  
        $objForm->combo("id_disciplina", '\Disciplina\Service\DisciplinaService', 'id', 'nm_disciplina')->required(false)->label("Disciplina");  
        $objForm->text("ds_conteudo")->required(false)->label("Nome do conteudo");

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}