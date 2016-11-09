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
        $objForm->hidden("id")->required(false)->label("Id");  
        $objForm->combo("id_curso", '\Curso\Service\CursoService', 'id', 'nm_curso')->required(false)->label("Curso");  
        $objForm->text("nm_disciplina")->required(false)->label("Nome da disciplina");

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}