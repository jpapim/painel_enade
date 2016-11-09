<?php

namespace Resultado\Service;

use \Resultado\Entity\ResultadoEntity as Entity;

class ResultadoService extends Entity
{

    protected $configList;

    public function setConfigList($configList)
    {
        $this->configList = $configList;
    }

    public function getPaginatorResultado($filter = NULL, $camposFilter = NULL)
    {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('resultado')->columns([
            'id_resultado',
            'cs_resposta',

        ])->join('aluno', 'aluno.id_aluno = resultado.id_aluno', ['nm_aluno'])
            ->join('conteudo_simulado', 'conteudo_simulado.id_conteudo_simulado = resultado.id_conteudo_simulado', ['nr_questao']);

        $where = [
        ];

        if (!empty($filter)) {

            foreach ($filter as $key => $value) {

                if ($value) {

                    if (isset($camposFilter[$key]['mascara'])) {

                        eval("\$value = " . $camposFilter[$key]['mascara'] . ";");
                    }

                    $where[$camposFilter[$key]['filter']] = '%' . $value . '%';
                }
            }
        }

        $select->where($where)->order(['id_resultado DESC']);
        //$select->order(['<campo> ASC']);

        return new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\DbSelect($select, $this->getAdapter()));
    }

    /** Início de Consulta para Detalhes */

    public function getResultadoPaginator($id_aluno, $filter = NULL, $camposFilter = NULL)
    {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('resultado')->columns([
            'id_resultado',
            'cs_resposta',
        ])->join('aluno', 'aluno.id_aluno = resultado.id_aluno', ['nm_aluno'])
            ->join('conteudo_simulado', 'conteudo_simulado.id_conteudo_simulado = resultado.id_conteudo_simulado', ['nr_questao']);

        $where = [
            'id_aluno' => $id_aluno,
        ];

        if (!empty($filter)) {

            foreach ($filter as $key => $value) {

                if ($value) {

                    if (isset($camposFilter[$key]['mascara'])) {

                        eval("\$value = " . $camposFilter[$key]['mascara'] . ";");
                    }

                    $where[$camposFilter[$key]['filter']] = '%' . $value . '%';
                }
            }
        }

        $select->where($where)->order(['id_resultado DESC']);
        #xd($select->getSqlString($this->getAdapter()->getPlatform()));
        return new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\DbSelect($select, $this->getAdapter()));
    }


}