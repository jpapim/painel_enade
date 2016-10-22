<?php

namespace Controller\Service;

use \Controller\Entity\ControllerEntity as Entity;

class ControllerService extends Entity {

    /**
     *
     * @var type 
     */
    protected $configList;

    /**
     * 
     * @param type $configList
     */
    public function setConfigList($configList) {
        $this->configList = $configList;
    }

    /**
     * Método criado para Sobrescrever o método utilizado para carregar os combos
     * @return \Zend\Db\ResultSet\ResultSet
     */
    public function fetchAllModulos() {
        $select = new \Zend\Db\Sql\Select('controller');
        $select->order(['nm_modulo ASC']);
        return $this->getTable()->getTableGateway()->selectWith($select);
    }

    public function getPaginatorController($filter = NULL, $camposFilter = NULL) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('controller')->columns([
            'id_controller',
            'nm_controller',
            'nm_modulo',
            'cs_exibir_combo',
        ]);

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
