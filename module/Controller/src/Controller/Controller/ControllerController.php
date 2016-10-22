<?php

namespace Controller\Controller;

use Estrutura\Controller\AbstractCrudController;
use Zend\View\Model\ViewModel;

class ControllerController extends AbstractCrudController
{
    /**
     * @var \Controller\Service\Controller
     */
    protected $service;

    /**
     * @var \Controller\Form\Controller
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
        $this->addSuccessMessage('Registro gravado com sucesso');
        $this->redirect()->toRoute('navegacao', array('controller' => 'controller', 'action' => 'index'));
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

    public function indexPaginationAction()
    {

        $filter = $this->getFilterPage();

        $camposFilter = [
            '0' => [
                'filter' => "LOWER(nm_controller) LIKE ? ",
                'mascara' => 'strtolower($value)',
            ],
            '1' => [
                'filter' => "LOWER(nm_modulo) LIKE ? ",
                'mascara' => 'strtolower($value)',
            ],
            '2' => NULL,
        ];

        #xd('hiohohohoih');
        $paginator = $this->service->getPaginatorController($filter, $camposFilter);

        $paginator->setItemCountPerPage($paginator->getTotalItemCount());

        $countPerPage = $this->getCountPerPage(
            current(\Estrutura\Helpers\Pagination::getCountPerPage($paginator->getTotalItemCount()))
        );

        $paginator->setItemCountPerPage($this->getCountPerPage(
            current(\Estrutura\Helpers\Pagination::getCountPerPage($paginator->getTotalItemCount()))
        ))->setCurrentPageNumber($this->getCurrentPage());

        $viewModel = new ViewModel([
            'service' => $this->service,
            'form' => $this->form,
            'paginator' => $paginator,
            'filter' => $filter,
            'countPerPage' => $countPerPage,
            'camposFilter' => $camposFilter,
            'controller' => $this->params('controller'),
            'atributos' => array()
        ]);

        return $viewModel->setTerminal(TRUE);
    }
}
