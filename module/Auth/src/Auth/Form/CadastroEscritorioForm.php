<?php

namespace Auth\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class CadastroEscritorioForm extends AbstractForm {

    public function __construct($options = []) {

        parent::__construct('cadastroescritorioform');

        $this->inputFilter = new InputFilter();

        $objForm = new FormObject('cadastroescritorioform',$this,$this->inputFilter);
        $objForm->hidden("id")->required(false)->label("Id");

        #Inicio da Tabela Pessoa (Escritorio)
        #$objForm->select("cd_tipo_pessoa_escritorio", array('J'=>'Juridica'))->required(true)->label("Tipo de Pessoa");
        #Fim da Tabela Pessoa (Escritorio)


        #Inicio da Tabela de pessoa Juridica
        #$objForm->combo("id_natureza_juridica", '\NaturezaJuridica\Service\NaturezaJuridicaService', 'id', 'nm_natureza_juridica')->required(false)->label("Natureza juridica");
        #$objForm->combo("id_tipo_lucro", '\TipoLucro\Service\TipoLucroService', 'id', 'nm_tipo_lucro')->required(false)->label("Tipo de Lucro");
        #$objForm->text("nr_cnpj")->required(true)->label("CNPJ *");
        #$objForm->text("nr_inscricao_estadual")->required(false)->label("Inscricao Estadual");
        #$objForm->text("nm_razao_social")->required(true)->label("Razao Social *");
        #$objForm->text("nm_fantasia")->required(false)->label("Nome Fantasia");
        #Fim da Tabela de pessoa Juridica

        $objForm->email("em_email")->required(true)->label("Email");
        $objForm->email("em_email_confirm")->required(true)->label("Confirme o email")
            ->setAttribute('data-match', '#em_email')
            ->setAttribute('data-match-error', 'Email não correspondem');
        $objForm->combo("id_email", '\EmailAcesso\Service\EmailAcessoService', 'id', 'em_email')->required(false)->label("Email");
        $objForm->password("pw_senha")->required(true)->label("Senha");
        $objForm->password("pw_senha_confirm")->required(true)->label("Confirmar senha")
            ->setAttribute('data-match', '#pw_senha')
            ->setAttribute('data-match-error', 'Senhas não correspondem');


        /*
        #Inicio da Tabela Escritorio
        $objForm->text("nm_escritorio")->required(false)->label("Ds slogan escritorio");
        #Fim da Tabela Escritorio
        */

        /*
        #Inicio da Tabela Pessoa (Responsavel)
        $objForm->select("cd_tipo_pessoa_responsavel", array('F'=>'Fisica'))->required(true)->label("Tipo de Pessoa");
        #$objForm->text("sg_pais")->required(true)->label("Sigla do Pais");
        #Fim da Tabela Pessoa (Responsavel)
        */


        #Inicio da Tabela Pessoa Fisica (Responsavel)
        #$objForm->text("sg_estado_civil")->required(false)->label("Sg estado civil");
        #$objForm->combo("cd_escolaridade", '\Escolaridade\Service\EscolaridadeService', 'id', 'nm_escolaridade')->required(false)->label("Cd escolaridade");
        $objForm->text("nm_pessoa_fisica")->required(true)->label("Nome do responsável *");
        $objForm->text("nm_sobrenome")->required(false)->label("Sobrenome");
        #$objForm->text("nr_cpf")->required(true)->label("CPF *");
        #$objForm->text("nm_mae")->required(false)->label("Nome da mae");
        #$objForm->text("nm_pai")->required(false)->label("Nome do pai");
        #$objForm->text("dt_nascimento")->required(true)->label("Data de Nascimento *");
        #$objForm->text("sg_sexo")->required(false)->label("Sexo");
        #$objForm->text("tp_siatuacao_cadastral")->required(false)->label("Situaçao Cadastral");
        #$objForm->text("tp_residente_exterior")->required(false)->label("Residente Exterior");
        #Fim da Tabela Pessoa Fisica(Responsavel)

        /*
        #Inicio da Tabela Vinculo Pessoa(Responsavel pelo Escritorio)
        $objForm->combo("id_pessoa_vinculante", '\Pessoa\Service\PessoaService', 'id', 'nm_pessoa')->required(false)->label("Pessoa");
        $objForm->combo("id_pessoa_vinculada", '\Pessoa\Service\PessoaService', 'id', 'nm_pessoa')->required(false)->label("Pessoa vinculada");
        $objForm->combo("id_tipo_vinculo_pessoa", '\TipoVinculoPessoa\Service\TipoVinculoPessoaService', 'id', 'ds_tipo_vinculo_pessoa')->required(false)->label("Tipo vinculo pessoa");
        $objForm->text("dt_inicio")->required(true)->label("Dt inicio *");
        $objForm->text("di_fim")->required(true)->label("Di fim *");
        $objForm->text("st_pessoa_vinculada")->required(true)->label("St pessoa vinculada *");
        #Fim da Tabela Vinculo Pessoa(Responsavel pelo Escritorio)
        */
        $this->formObject = $objForm;
    }

    public function getInputFilter() {
        return $this->inputFilter;
    }

}
