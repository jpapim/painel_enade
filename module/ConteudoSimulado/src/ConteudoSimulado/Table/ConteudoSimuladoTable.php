<?php

namespace ConteudoSimulado\Table;

use Estrutura\Table\AbstractEstruturaTable;

class ConteudoSimuladoTable extends AbstractEstruturaTable{

    public $table = 'conteudo_simulado';
    public $campos = [
        'id_conteudo_simulado'=>'id', 
        'id_conteudo'=>'id_conteudo', 
        'id_simulado'=>'id_simulado', 
        'nr_questao'=>'nr_questao', 
        'nr_peso_questao'=>'nr_peso_questao', 

    ];

}