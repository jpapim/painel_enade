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
        $objForm->combo("id_aluno", '\Aluno\Service\AlunoService', 'id', 'nm_aluno')->required(true)->label("Aluno");
        $objForm->combo("id_conteudo_simulado", '\ConteudoSimulado\Service\ConteudoSimuladoService', 'id', 'nr_questao')->required(true)->label("Conteúdo do simulado");
//        $objForm->text("cs_resposta")->required(false)->label("Classificador de resposta");

        $arrOpcoes[] = array('value' => 'S', 'label' => 'Certo');
        $arrOpcoes[] = array('value' => 'N', 'label' => 'Errado');
        $objForm->radio("cs_resposta", $arrOpcoes)->required(true)->label("Classificar de resposta");

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}