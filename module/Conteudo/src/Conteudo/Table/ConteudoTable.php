<?php

namespace Conteudo\Table;

use Estrutura\Table\AbstractEstruturaTable;

class ConteudoTable extends AbstractEstruturaTable{

    public $table = 'conteudo';
    public $campos = [
        'id_conteudo'=>'id', 
        'id_disciplina'=>'id_disciplina', 
        'ds_conteudo'=>'ds_conteudo', 

    ];

}