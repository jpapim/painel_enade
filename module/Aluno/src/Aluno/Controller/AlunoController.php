<?php

namespace Aluno\Controller;

use Estrutura\Controller\AbstractCrudController;
use Zend\View\Model\ViewModel;
use Resultado;
use Estrutura\Helpers\Cript;
use Zend\View\Model\JsonModel;

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

    public function __construct()
    {
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

//    public function gravarAction()
//    {
//
//        if ($result = parent::gravar($this->getServiceObj(), $this->getFormObj())) {
//
//            $this->addSuccessMessage('Salvo com sucesso');
//            $this->redirect()->toRoute('navegacao', array(
//                    'controller' => $this->params('controller'),
//                    'action' => 'index')
//            );
//        }
//        return $result;
//    }

    public function gravarAction()
    {
        try {
            $controller = $this->params('controller');
            $request = $this->getRequest();
            $service = $this->service;
            $form = $this->form;

            if (!$request->isPost()) {
                throw new \Exception('Dados Inválidos');
            }

            $post = \Estrutura\Helpers\Utilities::arrayMapArray('trim', $request->getPost()->toArray());

            $local = TXT_CONST_LOCAL_COMPLETO_UPLOAD;
            if (!file_exists($local)) {
                mkdir($local, 0755);
            }

            $files = $request->getFiles();
            $upload = $this->uploadFile($files, $local);

            $local_relativo = TXT_CONST_LOCAL_RELATIVO_UPLOAD;
            foreach ($upload as $file) {
                if (isset($file['tmp_name'])) {
                    $upload['ar_arquivo'] = str_replace($local_relativo,'',str_replace(BASE_PATCH, '', $file['tmp_name']));
                }
            }

            $post = array_merge($post, $upload);

            if (isset($post['id']) && $post['id']) {
                $post['id'] = Cript::dec($post['id']);
            }

            $form->setData($post);

            if (!$form->isValid()) {
                $this->addValidateMessages($form);
                $this->setPost($post);
                $this->redirect()->toRoute('navegacao', array('controller' => $controller, 'action' => 'cadastro'));
                return false;
            }
            $service->exchangeArray($form->getData());
            $this->addSuccessMessage('Registro alterado com sucesso');
            $id_tcc = $service->salvar();

            //Define o redirecionamento
            if (isset($post['id']) && $post['id']) {
                $this->redirect()->toRoute('navegacao', array('controller' => $controller, 'action' => 'cadastro-detalhe', 'id' => Cript::enc($post['id'])));
            } else {
                $this->redirect()->toRoute('navegacao', array('controller' => $controller, 'action' => 'cadastro-detalhe', 'id' => Cript::enc($id_aluno)));
            }

            return $id_tcc;

        } catch (\Exception $e) {
            $this->setPost($post);
            $this->addErrorMessage($e->getMessage());
            $this->redirect()->toRoute('navegacao', array('controller' => $controller, 'action' => 'cadastro'));
            return false;
        }
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

    // Iniciando ações do Cadastro Detalhe

    public function cadastroDetalheAction()
    {
        //recuperar o id do Modulo Tcc
        $id_aluno = Cript::dec($this->params('id') );

        $aluno = new \Aluno\Service\AlunoService();
        $dadosaluno = $aluno->buscar($id_aluno);
        #xd($dadosaluno);

        $dadosView = [
            'service' => new Resultado\Service\ResultadoService(),
            'form' => new Resultado\Form\ResultadoForm(),
            'controller' => $this->params('controller'),
            'atributos' => array(),
            'id_aluno' => $id_aluno,
            'dadosaluno' => $dadosaluno,
        ];

        return new ViewModel($dadosView);

    }

    // Iniciando ações para resultado
    public function adicionarresultadosAction()
    {
        //Se for a chamada Ajax
        if ($this->getRequest()->isPost()) {

            $id_aluno = \Estrutura\Helpers\Cript::dec($this->params()->fromPost('id'));
            $id_conteudo_simulado = $this->params()->fromPost('id_conteudo_simulado');
            $cs_resposta = $this->params()->fromPost('cs_resposta');
            $detalhe_resultado = new Resultado\Service\ResultadoService();

            $id_inserido = $detalhe_resultado->getTable()->salvar(array(
                'id_aluno'=>$id_aluno,
                'id_conteudo_simulado'=>$id_conteudo_simulado,
                'cs_resposta'=>$cs_resposta,
            ), null);
            $valuesJson = new JsonModel( array('id_inserido'=>$id_inserido, 'sucesso'=>true, 'nm_concluinte'=>$id_conteudo_simulado) );
            return $valuesJson;
        }
    }

    public function listarResultadosAction()
    {
        $filter = $this->getFilterPage();

        $id_tcc = $this->params()->fromPost('id_tcc');
        $camposFilter = [
            '0' => [
                'filter' => "resultado.nr_questão     LIKE ?"
            ],
            '1' => [
                'filter' => "resultado.cs_resposta LIKE ?"
            ],
            '2' => NULL,
        ];
        #xd($id_tcc = $this->params('id'));

        $paginator = $this->service->getResultadoPaginator( $id_tcc, $filter, $camposFilter);

        $paginator->setItemCountPerPage($paginator->getTotalItemCount());

        $countPerPage = $this->getCountPerPage(
            current(\Estrutura\Helpers\Pagination::getCountPerPage($paginator->getTotalItemCount()))
        );

        $paginator->setItemCountPerPage($this->getCountPerPage(
            current(\Estrutura\Helpers\Pagination::getCountPerPage($paginator->getTotalItemCount()))
        ))->setCurrentPageNumber($this->getCurrentPage());

        $viewModel = new ViewModel([
            'service' => $this->service,
            'form' => new Resultado\Form\ResultadoForm(),
            'paginator' => $paginator,
            'filter' => $filter,
            'countPerPage' => $countPerPage,
            'camposFilter' => $camposFilter,
            'controller' => $this->params('controller'),
            'id_tcc'=>$id_tcc,
            'atributos' => array()
        ]);

        return $viewModel->setTerminal(TRUE);
    }

    public function excluirResultadoViaAlunoAction()
    {
        try {
            $request = $this->getRequest();
            if ($request->isPost()) {
                return new JsonModel();
            }

            $controller = $this->params('controller');
            $id = Cript::dec($this->params('id'));
            $id_aluno = Cript::dec($this->params('aux'));

            $resultadoService = new Resultado\Service\ResultadoService();
            $resultadoService->setId($id);
            $resultadoService->setIdTcc($id_aluno);

            $dados = $resultadoService->filtrarObjeto()->current();
            if (!$dados) {
                throw new \Exception('Registro nao encontrado');
            }

            $resultadoService->excluir();
            $this->addSuccessMessage('Registro excluido com sucesso');
            return $this->redirect()->toRoute('navegacao', ['controller' => $controller, 'action' => 'cadastro-detalhe', 'id' => \Estrutura\Helpers\Cript::enc($id_aluno)]);

        } catch (\Exception $e) {
            if( strstr($e->getMessage(), '1451') ) { #ERRO de SQL (Mysql) para nao excluir registro que possua filhos
                $this->addErrorMessage('Erro ao excluir. Verifique!');
            }else {
                $this->addErrorMessage($e->getMessage());
            }

            return $this->redirect()->toRoute('navegacao', ['controller' => $controller]);
        }

    }


}
