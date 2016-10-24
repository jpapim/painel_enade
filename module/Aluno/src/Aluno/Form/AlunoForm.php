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
        $objForm->hidden("id")->required(false)->label("Id");  
        $objForm->combo("id_curso", '\Curso\Service\CursoService', 'id', 'nm_curso')->required(false)->label("Curso");  
        $objForm->combo("id_sexo", '\Sexo\Service\SexoService', 'id', 'nm_sexo')->required(false)->label("Sexo");  
        $objForm->text("nm_aluno")->required(false)->label("Nm aluno");  
        $objForm->text("nr_matricula")->required(false)->label("Nr matricula");  
        $objForm->email("em_email")->required(false)->label("Em email");  

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}