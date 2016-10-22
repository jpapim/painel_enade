<?php

namespace Usuario\Entity;

use Estrutura\Service\AbstractEstruturaService;

class UsuarioEntity extends AbstractEstruturaService{

        protected $id;
        protected $nm_usuario; 
        protected $dt_nascimento; 
        protected $nu_rg; #Apagar
        protected $nu_cpf; #Apagar
        protected $nm_profissao; #Apagar
        protected $nm_nacionalidade; #Apagar
        protected $id_sexo; 
        protected $id_estado_civil; #Apagar
        protected $id_tipo_usuario; 
        protected $id_situacao_usuario; 
        protected $id_email; 
        protected $id_telefone; 
        protected $id_endereco; 
        protected $id_escritorio;
        protected $id_pessoa_fisica;
}