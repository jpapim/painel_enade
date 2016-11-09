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

        $objForm->combo("id_conteudo", '\Conteudo\Service\ConteudoService', 'id', 'ds_conteudo')->required(false)->label("Conteúdo");
        $objForm->combo("id_simulado", '\Simulado\Service\SimuladoService', 'id', 'ds_simulado')->required(false)->label("Simulado");
        $objForm->integer("nr_questao")->required(false)->label("Número da questão");
        $objForm->integer("nr_peso_questao")->required(false)->label("Número do peso da questão");

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}