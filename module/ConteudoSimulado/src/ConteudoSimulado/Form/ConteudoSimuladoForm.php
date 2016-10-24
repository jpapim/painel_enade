<?php

namespace ConteudoSimulado\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class ConteudoSimuladoForm extends AbstractForm{
    public function __construct($options=[]){
        parent::__construct('conteudosimuladoform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject('conteudosimuladoform',$this,$this->inputFilter);
        $objForm->hidden("id")->required(false)->label("Id");  
        $objForm->combo("id_conteudo", '\Conteudo\Service\ConteudoService', 'id', 'nm_conteudo')->required(false)->label("Conteudo");  
        $objForm->combo("id_simulado", '\Simulado\Service\SimuladoService', 'id', 'nm_simulado')->required(false)->label("Simulado");  
        $objForm->combo("nr_questao", '\NrQuestao\Service\NrQuestaoService', 'id', 'nm_nr_questao')->required(false)->label("Nr questao");  
        $objForm->text("nr_peso_questao")->required(false)->label("Nr peso questao");  

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}