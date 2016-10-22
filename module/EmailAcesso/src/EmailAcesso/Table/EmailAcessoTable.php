<?php

namespace EmailAcesso\Table;

use Estrutura\Table\AbstractEstruturaTable;

class EmailAcessoTable extends AbstractEstruturaTable{

    public $table = 'email_acesso';
    public $campos = [
        'id_email'=>'id', 
        'em_email'=>'em_email', 
        'id_situacao'=>'id_situacao',
    ];

}