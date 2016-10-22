<?php

namespace EmailAcesso\Service;

use \EmailAcesso\Entity\EmailAcessoEntity as Entity;

class EmailAcessoService extends Entity {

    /**
     *
     * @var type 
     */
    protected $configList;

    /**
     * @param type $configList
     */
    public function setConfigList($configList) {
        $this->configList = $configList;
    }

}
