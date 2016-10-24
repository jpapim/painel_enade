<?php

namespace Aluno\Table;

use Estrutura\Table\AbstractEstruturaTable;

class AlunoTable extends AbstractEstruturaTable{

    public $table = 'aluno';
    public $campos = [
        'id_aluno'=>'id', 
        'id_curso'=>'id_curso', 
        'id_sexo'=>'id_sexo', 
        'nm_aluno'=>'nm_aluno', 
        'nr_matricula'=>'nr_matricula', 
        'em_email'=>'em_email', 

    ];

}