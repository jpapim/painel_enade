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
<<<<<<< HEAD

		$objForm->hidden("id")->required(false)->label("Id");  
		
=======
        $objForm->hidden("id")->required(false)->label("Id");
>>>>>>> dev-yves
        $arrOpcoes[] = array('value' => '', 'label' => 'Selecione...');
        $arrOpcoes[] = array('value' => 'Matutino', 'label' => 'Matutino');
        $arrOpcoes[] = array('value' => 'Vespertino', 'label' => 'Vespertino');
        $arrOpcoes[] = array('value' => 'Noturno', 'label' => 'Noturno');
<<<<<<< HEAD
        $objForm->select("nm_turno", $arrOpcoes)->required(true)->label("Turno");        

=======
        $objForm->select("nm_turno", $arrOpcoes)->required(false)->label("Nome do Turno");
        //Foi retirada a linha abaixo para implementação de um select com os turnos.
        //$objForm->text("nm_turno")->required(false)->label("Nome do turno");
>>>>>>> dev-yves
        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}