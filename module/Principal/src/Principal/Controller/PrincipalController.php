<?php

namespace Principal\Controller;

use Estrutura\Controller\AbstractEstruturaController;
use Zend\View\Model\ViewModel;

class PrincipalController extends AbstractEstruturaController
{

    /**
     *
     * @return ViewModel
     */
    public function indexAction() {

        return new ViewModel([]);
    }

    /**
     *
     */
    public function infoAction() {

        phpinfo();
        die;
    }

}
