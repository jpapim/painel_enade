<?php

namespace Disciplina\Table;

use Estrutura\Table\AbstractEstruturaTable;

class DisciplinaTable extends AbstractEstruturaTable{

    public $table = 'disciplina';
    public $campos = [
        'id_disciplina'=>'id', 
        'id_curso'=>'id_curso', 
        'nm_disciplina'=>'nm_disciplina', 

    ];

}