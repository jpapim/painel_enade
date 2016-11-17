<?php

namespace ConteudoSimulado\Service;

use \ConteudoSimulado\Entity\ConteudoSimuladoEntity as Entity;

class ConteudoSimuladoService extends Entity
{

    /**
     *
     * @var type
     */
    protected $configList;

    /**
     * @param type $configList
     */
    public function setConfigList($configList)
    {
        $this->configList = $configList;
    }

    /**
     *
     */
    public function getPaginatorConteudoSimulado($filter = NULL, $camposFilter = NULL)
    {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('conteudo_simulado')->columns([
            'id_conteudo_simulado',
            'nr_questao',
            'nr_peso_questao',

        ])->join('simulado', 'simulado.id_simulado = conteudo_simulado.id_simulado', ['ds_simulado'])
          ->join('conteudo', 'conteudo.id_conteudo = conteudo_simulado.id_conteudo', ['ds_conteudo']);

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

        $select->where($where)->order(['id_conteudo_simulado DESC']);


        return new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\DbSelect($select, $this->getAdapter()));
    }

}