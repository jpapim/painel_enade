<?php

namespace Simulado\Table;

use Estrutura\Table\AbstractEstruturaTable;

class SimuladoTable extends AbstractEstruturaTable{

    public $table = 'simulado';
    public $campos = [
        'id_simulado'=>'id', 
        'id_curso'=>'id_curso', 
        'id_usuario'=>'id_usuario', 
        'ds_simulado'=>'ds_simulado',
    ];

}