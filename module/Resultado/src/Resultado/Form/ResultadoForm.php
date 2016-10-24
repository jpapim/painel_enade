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
        $objForm->combo("id_aluno", '\Aluno\Service\AlunoService', 'id', 'nm_aluno')->required(false)->label("Aluno");  
        $objForm->combo("id_conteudo_simulado", '\ConteudoSimulado\Service\ConteudoSimuladoService', 'id', 'nm_conteudo_simulado')->required(false)->label("Conteudo simulado");  
        $objForm->text("cs_resposta")->required(false)->label("Cs resposta");  

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}