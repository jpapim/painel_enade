<?php

namespace Conteudo\Service;

use \Conteudo\Entity\ConteudoEntity as Entity;

class ConteudoService extends Entity
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
    public function getPaginatorConteudo($filter = NULL, $camposFilter = NULL)
    {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('conteudo')->columns([
            'id_conteudo',
            'ds_conteudo',

        ])->join('disciplina', 'disciplina.id_disciplina = conteudo.id_disciplina', ['nm_disciplina']);

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

        $select->where($where);
        //$select->order(['<campo> ASC']);

        return new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\DbSelect($select, $this->getAdapter()));
    }

}