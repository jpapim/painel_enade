<?php

namespace PerfilControllerAction\Controller;

use Estrutura\Controller\AbstractCrudController;

class PerfilControllerActionController extends AbstractCrudController
{
    /**
     * @var \PerfilControllerAction\Service\PerfilControllerAction
     */
    protected $service;

    /**
     * @var \PerfilControllerAction\Form\PerfilControllerAction
     */
    protected $form;

    public function __construct(){
        parent::init();
    }

    public function indexAction()
    {
        return parent::index($this->getServiceObj(), $this->getFormObj());
    }

    public function gravarAction(){
        return parent::gravar($this->getServiceObj(), $this->getFormObj());
    }

    public function cadastroAction()
    {
        return parent::cadastro($this->getServiceObj(), $this->getFormObj());
    }

    public function excluirAction()
    {
        return parent::excluir($this->getServiceObj(), $this->getFormObj());
    }
}
