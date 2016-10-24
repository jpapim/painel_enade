<?php

namespace Resultado\Table;

use Estrutura\Table\AbstractEstruturaTable;

class ResultadoTable extends AbstractEstruturaTable{

    public $table = 'resultado';
    public $campos = [
        'id_resultado'=>'id', 
        'id_aluno'=>'id_aluno', 
        'id_conteudo_simulado'=>'id_conteudo_simulado', 
        'cs_resposta'=>'cs_resposta', 

    ];

}