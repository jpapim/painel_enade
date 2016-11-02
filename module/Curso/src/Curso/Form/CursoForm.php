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
        $objForm->hidden("id")->required(false)->label("Id");
        $objForm->combo("id_turno", '\Turno\Service\TurnoService', 'id', 'nm_turno')->required(false)->label("Turno");
        $objForm->text("nm_curso")->required(false)->label("Nome do Curso");

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}