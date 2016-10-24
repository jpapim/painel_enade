<?php

namespace Aluno\Controller;

use Estrutura\Controller\AbstractCrudController;
use Zend\View\Model\ViewModel;

class AlunoController extends AbstractCrudController
{
    /**
     * @var \Aluno\Service\Aluno
     */
    protected $service;

    /**
     * @var \Aluno\Form\Aluno
     */
    protected $form;

    public function __construct(){
        parent::init();
    }

    public function indexAction()
    {
        
        return new ViewModel([
            'service' => $this->service,
            'form' => $this->form,
            'controller' => $this->params('controller'),
            'atributos' => array()
        ]);        
    }
    
    public function indexPaginationAction()
    {
        
        $filter = $this->getFilterPage();

        $camposFilter = [
'0' => [
    'filter' => "LOWER(nm_aluno) LIKE ? ",
    'mascara' => 'strtolower($value)',
],
'1' => [
    'filter' => "LOWER(nr_matricula) LIKE ? ",
    'mascara' => 'strtolower($value)',
],
'2' => [
    'filter' => "LOWER(em_email) LIKE ? ",
    'mascara' => 'strtolower($value)',
],
    '3' => NULL,
];
        
        $paginator = $this->service->getPaginatorAluno($filter, $camposFilter);

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

    public function gravarAction(){
        
        if ($result = parent::gravar($this->getServiceObj(), $this->getFormObj())) {
            
            $this->addSuccessMessage('Salvo com sucesso');
            $this->redirect()->toRoute('navegacao', array(
                'controller' => $this->params('controller'), 
                'action' => 'index')
            );
        }
        return $result;
    }

    public function cadastroAction()
    {
        return parent::cadastro($this->getServiceObj(), $this->getFormObj());
    }
    
    public function editaAction()
    {
        return parent::cadastro($this->getServiceObj(), $this->getFormObj());
    }

    public function excluirAction()
    {
        return parent::excluir($this->getServiceObj(), $this->getFormObj());
    }
}
