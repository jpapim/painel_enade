<?php

namespace Simulado\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class SimuladoForm extends AbstractForm{
    public function __construct($options=[]){
        parent::__construct('simuladoform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject('simuladoform',$this,$this->inputFilter);
        $objForm->hidden("id")->required(false)->label("Id");  
        $objForm->combo("id_curso", '\Curso\Service\CursoService', 'id', 'nm_curso')->required(false)->label("Curso");  
        $objForm->combo("id_usuario", '\Usuario\Service\UsuarioService', 'id', 'nm_usuario')->required(false)->label("Usuario");  
        $objForm->text("ds_simulado")->required(false)->label("Ds simulado");  

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}