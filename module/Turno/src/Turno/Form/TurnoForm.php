<?php

namespace Turno\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class TurnoForm extends AbstractForm{
    public function __construct($options=[]){
        parent::__construct('turnoform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject('turnoform',$this,$this->inputFilter);
        $objForm->hidden("id")->required(false)->label("Id");
        $arrOpcoes[] = array('value' => '', 'label' => 'Selecione...');
        $arrOpcoes[] = array('value' => 'Matutino', 'label' => 'Matutino');
        $arrOpcoes[] = array('value' => 'Vespertino', 'label' => 'Vespertino');
        $arrOpcoes[] = array('value' => 'Noturno', 'label' => 'Noturno');
        $objForm->select("nm_turno", $arrOpcoes)->required(false)->label("Nome do Turno");
        //Foi retirada a linha abaixo para implementação de um select com os turnos.
        //$objForm->text("nm_turno")->required(false)->label("Nome do turno");

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}