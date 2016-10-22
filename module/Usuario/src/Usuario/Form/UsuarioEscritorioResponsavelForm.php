<?php

namespace Usuario\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

    class UsuarioEscritorioResponsavelForm extends AbstractForm {

    public function __construct($options = []) {
        parent::__construct('usuarioescritorioresponsavelform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject(
                'usuarioescritorioresponsavelform', $this, $this->inputFilter
        );

        $objForm->hidden("id")->required(false)->label("Id");
        $objForm->text("nm_usuario")->required(true)->label("Nome completo");
        $objForm->combo("id_tipo_usuario", '\TipoUsuario\Service\TipoUsuarioService', 'id', 'nm_tipo_usuario')->required(true)->label("Tipo de Usuário");
        $objForm->combo("id_situacao_usuario", '\SituacaoUsuario\Service\SituacaoUsuarioService', 'id', 'nm_situacao_usuario')->required(true)->label("Situação do Usuário");
        $objForm->combo("id_pessoa_fisica", '\PessoaFisica\Service\PessoaFisicaService', 'id', 'nm_pessoa_fisica')->required(false)->label("Pessoa Fisica");
        $objForm->combo("id_escritorio", '\Escritorio\Service\EscritorioService', 'id', 'nm_escritorio')->required(false)->label("Escritorio");
        $objForm->email("em_email")->required(true)->label("Email");
        $objForm->combo("id_email", '\EmailAcesso\Service\EmailAcessoService', 'id', 'em_email')->required(true)->label("Email");
        $objForm->password("pw_senha")->required(true)->label("Senha");

        $this->formObject = $objForm;
    }

    public function getInputFilter() {
        return $this->inputFilter;
    }

}
