<?php

namespace Resultado\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class ResultadoForm extends AbstractForm{
    public function __construct($options=[]){
        parent::__construct('resultadoform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject('resultadoform',$this,$this->inputFilter);
        $objForm->hidden("id")->required(false)->label("Id");  

        $arrOpcoes[] = array('value' => 'S', 'label' => 'Certo');
        $arrOpcoes[] = array('value' => 'N', 'label' => 'Errado');
        $objForm->radio("cs_resposta", $arrOpcoes)->required(false)->label("Classificar de resposta");
        $objForm->combo("id_aluno", '\Aluno\Service\AlunoService', 'id', 'nm_aluno')->required(false)->label("Aluno");  
        $objForm->combo("id_conteudo_simulado", '\ConteudoSimulado\Service\ConteudoSimuladoService', 'id', 'nm_conteudo_simulado')->required(false)->label("Conteúdo do simulado");

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}