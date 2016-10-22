<?php

namespace Auth\Controller;

use Estrutura\Controller\AbstractCrudController;
use Zend\View\Model\ViewModel;
use Estrutura\Helpers\Cript;

class AuthController extends AbstractCrudController
{

    /**
     * @var \Auth\Service\Auth
     */
    protected $service;

    /**
     * @var \Auth\Form\Auth
     */
    protected $form;
    protected $storage;
    protected $authService;

    public function __construct()
    {
        parent::init();
    }

    public function indexAction()
    {
        return parent::index($this->service, $this->form);
    }

    public function getForm()
    {
        if (!$this->form) {

            $this->setFormObj();
        }

        return $this->form;
    }

    /**
     *
     * @return \Zend\Authentication\AuthenticationService
     */
    public function getAuthService()
    {
        if (!$this->authService) {

            $this->authService = $this->getServiceLocator()->get('AuthService');
        }

        return $this->authService;
    }

    public function getSessionStorage()
    {
        if (!$this->storage) {

            $this->storage = $this->getServiceLocator()->get('Auth\Table\MyAuth');
        }

        return $this->storage;
    }

    /**
     * Mostra a tela de login
     * @return type
     */
    public function loginAction()
    {
        if ($this->getAuthService()->hasIdentity()) {
            return $this->redirect()->toRoute('navegacao', array('controller' => 'application-index', 'action' => 'index'));
        }

        $form = $this->getForm();
        return array(
            'form' => $form,
            'messages' => $this->flashmessenger()->getMessages()
        );
    }

    /**
     * Autentica o usuário
     *
     * @return type
     */
    public function authenticateAction()
    {
        try {

            $form = $this->getForm();

            $request = $this->getRequest();

            if (!$request->isPost()) {

                throw new \Exception('Dados Inválidos');
            }

            $form->setData($request->getPost());

            if (!$form->isValid()) {

                $this->addValidateMessages($form);
                $this->setPost($request);
                return $this->redirect()->toRoute('login');
            }

            //check authentication...            
            $this->getAuthService()->getAdapter()
                ->setIdentity($request->getPost('email'))
                ->setCredential($request->getPost('senha'));

            $result = $this->getAuthService()->authenticate();

            $translate = $this->getServiceLocator()->get('viewhelpermanager')->get('translate');

            foreach ($result->getMessages() as $message) {

                //save message temporary into flashmessenger                
                if ($result->getCode() == 1) {

//                    $this->flashmessenger()->addSuccessMessage($translate($message, 'Auth'));
                } else {

                    $this->flashmessenger()->addErrorMessage($translate($message, 'Auth'));
                }
            }

            if ($result->isValid()) {

                $resultRow = $this->getAuthService()->getAdapter()->getResultRowObject(null, "pw_senha");
                $this->getAuthService()->getStorage()->write($resultRow);
            }

            return $this->redirect()->toRoute('login');
        } catch (\Exception $e) {

            $this->setPost($this->getPost());
            $this->addErrorMessage($e->getMessage());
            return $this->redirect()->toRoute('login');
        }
    }

    /**
     * Realiza o Logoff
     *
     * @return type
     */
    public function logoffAction()
    {
        $this->getSessionStorage()->forgetMe();
        $this->getAuthService()->clearIdentity();

        $this->flashmessenger()->addMessage("Você foi desconectado do sistema ADV-e");
//        27/07/2015 - Redirecionar para o site
//        return $this->redirect()->toRoute('login');
        return $this->redirect()->toUrl($this->getServiceLocator()->get('Config')['dominio']);
    }

    /**
     *
     * @return type
     */
    public function captchaAction()
    {

        $response = $this->getResponse();
        $response->getHeaders()->addHeaderLine('Content-Type', "image/png");

        $id = $this->params('id', false);

        if ($id) {

            $image = BASE_PATCH . '/data/captcha/' . $id;

            if (file_exists($image) !== false) {
                $imagegetcontent = file_get_contents($image);

                $response->setStatusCode(200);
                $response->setContent($imagegetcontent);

                if (file_exists($image) == true) {
                    unlink($image);
                }
            }
        }

        return $response;
    }

    /**
     *
     */
    public function esqueciSenhaAction()
    {

        return new ViewModel([
            'form' => new \Auth\Form\EsqueciSenhaForm(),
            'controller' => $this->params('controller'),
        ]);
    }

    /**
     *
     * @param type $param
     * @return boolean
     */
    public function solicitarSenhaAction()
    {

        $form = new \Auth\Form\EsqueciSenhaForm();

        $elementCaptch = $form->getElements()['captcha'];
        foreach ($elementCaptch->getInputSpecification()['validators'] as $validator) {

            if (!$validator->isValid($this->getRequest()->getPost()->get('captcha'))) {

                $this->addErrorMessage('Captcha inválido.');
                $this->redirect()->toRoute('navegacao', ['controller' => 'auth', 'action' => 'esqueci-senha']);
                return FALSE;
            }
        }

        /* @var $emailService \EmailAcesso\Service\EmailAcessoService */
        $emailService = $this->getServiceLocator()->get('\EmailAcesso\Service\EmailAcessoService');
        $emailService->setEmEmail($this->getRequest()->getPost()->get('email'));
        $emailList = $emailService->filtrarObjeto();

        if (!$emailList->count()) {

            $this->addErrorMessage('E-mail não consta cadastrado.');
            $this->redirect()->toRoute('navegacao', ['controller' => 'auth', 'action' => 'esqueci-senha']);
            return FALSE;
        }

        $emailEntity = $emailList->current();

        $usuarioService = new \Usuario\Service\UsuarioService();
        $usuarioService->setIdEmail($emailEntity->getId());
        $usuarioEntity = $usuarioService->filtrarObjeto()->current();

        $esqueciSenhaService = new \EsqueciSenha\Service\EsqueciSenhaService();
        $esqueciSenhaService->setIdSituacao($this->getConfigList()['situacao_ativo']);
        $esqueciSenhaService->setIdUsuario($usuarioEntity->getId());
        $listEsqueciSenha = $esqueciSenhaService->filtrarObjeto();

        if ($listEsqueciSenha->count()) {

            foreach ($listEsqueciSenha as $esqueciSenhaEntityAux) {

                $dateSolicitacao = new \DateTime($esqueciSenhaEntityAux->getDtSolicitacao());

                $dataAtual = new \Datetime();
                $dataAtual->modify('-1 hours');

                if ($dateSolicitacao < $dataAtual) {

                    $esqueciSenhaEntityAux->setIdSituacao($this->getConfigList()['situacao_inativo']);
                    $esqueciSenhaEntityAux->salvar();
                } else {

                    $this->addErrorMessage('Existe uma solicitação de redefinição de senha vigente. Verifique seu e-mail');
                    $this->redirect()->toRoute('navegacao', ['controller' => 'auth', 'action' => 'login']);
                    return FALSE;
                }
            }
        }

        $txIdentificacao = md5(uniqid(mt_rand(), true));

        $esqueciSenhaService = new \EsqueciSenha\Service\EsqueciSenhaService();
        $esqueciSenhaService->exchangeArray([
            'id' => NULL,
            'id_usuario' => $usuarioEntity->getId(),
            'tx_identificacao' => $txIdentificacao,
            'id_situacao' => $this->getConfigList()['situacao_ativo'],
            'dt_solicitacao' => date('Y-m-d H:i:s'),
        ]);
        if ($esqueciSenhaService->salvar()) {

            $contaEmail = 'no-reply';

            $message = new \Zend\Mail\Message();
            $message->addFrom($contaEmail . '@acthosti.com.br', 'ADV-e')
                ->addTo($emailEntity->getEmEmail())
                ->addBcc('alysson@acthosti.com.br')
                ->setSubject('Redefinição de senha');

            $applicationService = new \Application\Service\ApplicationService();
            $transport = $applicationService->getSmtpTranport($contaEmail);

            $htmlMessage = $applicationService->tratarModelo(
                [
                    'BASE_URL' => BASE_URL,
                    'nomeUsuario' => $usuarioEntity->getNmUsuario(),
                    'txIdentificacao' => base64_encode(\Estrutura\Helpers\Bcrypt::hash($txIdentificacao)),
                    'email' => $emailEntity->getEmEmail(),
                ], $applicationService->getModelo('solicitar-senha'));

            $html = new \Zend\Mime\Part($htmlMessage);
            $html->type = "text/html";

            $body = new \Zend\Mime\Message();
            $body->addPart($html);

            $message->setBody($body);
            $transport->send($message);

            $this->addSuccessMessage('Redefinição de senha enviado para o e-mail ' . $emailEntity->getEmEmail());
            $this->redirect()->toRoute('navegacao', ['controller' => 'auth', 'action' => 'login']);
            return TRUE;
        } else {
            $this->addErrorMessage('Não foi possível redefinir a senha. Tente novamente mais tarde.');
            $this->redirect()->toRoute('navegacao', ['controller' => 'auth', 'action' => 'esqueci-senha']);
            return FALSE;
        }
    }

    /**
     *
     * @return boolean|ViewModel
     */
    public function redefinirSenhaAction()
    {

        $id = base64_decode($this->params('id'));

        if (!$id) {

            $this->addErrorMessage('Token não informado. Solicite outra redefinição de senha');
            $this->redirect()->toRoute('navegacao', ['controller' => 'auth', 'action' => 'login']);
            return FALSE;
        }

        $esqueciSenhaService = new \EsqueciSenha\Service\EsqueciSenhaService();
        $esqueciSenhaService->setIdSituacao($this->getConfigList()['situacao_ativo']);
        $listEsqueciSenha = $esqueciSenhaService->filtrarObjeto();

        if (!$listEsqueciSenha->count()) {

            $this->addErrorMessage('Token inválido. Solicite outra redefinição de senha');
            $this->redirect()->toRoute('navegacao', ['controller' => 'auth', 'action' => 'login']);
            return FALSE;
        }

        $esqueciSenhaEntity = NULL;
        foreach ($listEsqueciSenha as $esqueciSenhaEntityAux) {

            if (crypt($esqueciSenhaEntityAux->getTxIdentificacao(), $id) === $id) {

                $esqueciSenhaEntity = $esqueciSenhaEntityAux;
            } else {

                $dateSolicitacao = new \DateTime($esqueciSenhaEntityAux->getDtSolicitacao());

                $dataAtual = new \Datetime();
                $dataAtual->modify('-1 hours');

                if ($dateSolicitacao < $dataAtual) {

                    $esqueciSenhaEntityAux->setIdSituacao($this->getConfigList()['situacao_inativo']);
                    $esqueciSenhaEntityAux->salvar();
                }
            }
        }

        if (!$esqueciSenhaEntity) {

            $this->addErrorMessage('Token inválido. Solicite outra redefinição de senha');
            $this->redirect()->toRoute('navegacao', ['controller' => 'auth', 'action' => 'login']);
            return FALSE;
        }

        $dateSolicitacao = new \DateTime($esqueciSenhaEntity->getDtSolicitacao());

        $dataAtual = new \Datetime();
        $dataAtual->modify('-1 hours');

        if ($dateSolicitacao < $dataAtual) {

            $esqueciSenhaEntity->setIdSituacao($this->getConfigList()['situacao_inativo']);
            $esqueciSenhaEntity->salvar();

            $this->addErrorMessage('Token expirado. Solicite outra redefinição de senha');
            $this->redirect()->toRoute('navegacao', ['controller' => 'auth', 'action' => 'login']);
            return FALSE;
        }

        $usuarioService = new \Usuario\Service\UsuarioService();
        $usuarioEntity = $usuarioService->buscar($esqueciSenhaEntity->getIdUsuario());

        return new ViewModel([
            'controller' => $this->params('controller'),
            'form' => new \Auth\Form\RedefinirSenhaForm(),
            'usuarioEntity' => $usuarioEntity,
            'esqueciSenhaEntity' => $esqueciSenhaEntity,
        ]);
    }

    /**
     *
     * @return boolean
     */
    public function salvarRedefinicaoSenhaAction()
    {

        $form = new \Auth\Form\RedefinirSenhaForm();
        $txIdentificacao = base64_decode($this->getRequest()->getPost()->get('tx_identificacao'));

        if (!$txIdentificacao) {

            $this->addErrorMessage('Token não informado. Solicite outra redefinição de senha.');
            $this->redirect()->toRoute('navegacao', ['controller' => 'auth', 'action' => 'login']);
            return FALSE;
        }

        $elementCaptch = $form->getElements()['captcha'];
        foreach ($elementCaptch->getInputSpecification()['validators'] as $validator) {

            if (!$validator->isValid($this->getRequest()->getPost()->get('captcha'))) {

                $this->addErrorMessage('Captcha inválido.');
                $this->redirect()->toRoute('navegacao', ['controller' => 'auth', 'action' => 'redefinir-senha', 'id' => base64_encode($txIdentificacao)]);
                return FALSE;
            }
        }

        $id_usuario = \Estrutura\Helpers\Cript::dec($this->getRequest()->getPost()->get('id_usuario'));

        $esqueciSenhaService = new \EsqueciSenha\Service\EsqueciSenhaService();
        $esqueciSenhaService->setIdUsuario($id_usuario);
        $esqueciSenhaService->setIdSituacao($this->getConfigList()['situacao_ativo']);
        $esqueciSenhaEntity = $esqueciSenhaService->filtrarObjeto()->current();

        if (!$esqueciSenhaEntity) {

            $this->addErrorMessage('Token inválido. Solicite outra redefinição de senha.');
            $this->redirect()->toRoute('navegacao', ['controller' => 'auth', 'action' => 'login']);
            return FALSE;
        }

        if (crypt($esqueciSenhaEntity->getTxIdentificacao(), $txIdentificacao) != $txIdentificacao) {

            $this->addErrorMessage('Token inválido. Solicite outra redefinição de senha.');
            $this->redirect()->toRoute('navegacao', ['controller' => 'auth', 'action' => 'login']);
            return FALSE;
        }

        $dateSolicitacao = new \DateTime($esqueciSenhaEntity->getDtSolicitacao());

        $dataAtual = new \Datetime();
        $dataAtual->modify('-2 hours');

        if ($dateSolicitacao < $dataAtual) {

            $esqueciSenhaEntity->setIdSituacao($this->getConfigList()['situacao_inativo']);
            $esqueciSenhaEntity->salvar();

            $this->addErrorMessage('Token expirado. Solicite outra redefinição de senha.');
            $this->redirect()->toRoute('navegacao', ['controller' => 'auth', 'action' => 'login']);
            return FALSE;
        }

        $loginService = new \Login\Service\LoginService();
        $loginService->setIdUsuario($id_usuario);
        $loginEntity = $loginService->filtrarObjeto()->current();

        if (!$loginEntity) {

            $this->addErrorMessage('Token inválido. Solicite outra redefinição de senha.');
            $this->redirect()->toRoute('navegacao', ['controller' => 'auth', 'action' => 'login']);
            return FALSE;
        }

        //Verifica tamanho da senha
        if (strlen(trim($this->getRequest()->getPost()->get('pw_nova_senha'))) < 8) {

            $this->addErrorMessage('Senha deve ter no mínimo 8 caracteres.');
            $this->redirect()->toRoute('navegacao', ['controller' => 'auth', 'action' => 'redefinir-senha', 'id' => base64_encode($txIdentificacao)]);
            return FALSE;
        }

        //Verifica se as novas senhas são iguais
        if (strcasecmp($this->getRequest()->getPost()->get('pw_nova_senha_confirm'), $this->getRequest()->getPost()->get('pw_nova_senha')) != 0) {

            $this->addErrorMessage('Senhas não correspondem.');
            $this->redirect()->toRoute('navegacao', ['controller' => 'auth', 'action' => 'redefinir-senha', 'id' => base64_encode($txIdentificacao)]);
            return FALSE;
        }

        //Verifica se a senha atual é igual a senha antiga
        if (strcasecmp($loginEntity->getPwSenha(), md5($this->getRequest()->getPost()->get('pw_nova_senha'))) == 0) {

            $this->addErrorMessage('Nova senha igual a senha atual.');
            $this->redirect()->toRoute('navegacao', ['controller' => 'auth', 'action' => 'redefinir-senha', 'id' => base64_encode($txIdentificacao)]);
            return FALSE;
        }

        //Seta a nova senha
        $loginEntity->setPwSenha(md5(trim($this->getRequest()->getPost()->get('pw_nova_senha'))));
        $loginEntity->setPwSenhaFinanceira(md5(trim($this->getRequest()->getPost()->get('pw_nova_senha'))));
        $loginEntity->salvar();

        //Desativa o esqueci senha atual
        $esqueciSenhaEntity->setIdSituacao($this->getConfigList()['situacao_inativo']);
        $esqueciSenhaEntity->salvar();

        /* @var $emailService \EmailAcesso\Service\EmailAcessoService */
        $emailService = $this->getServiceLocator()->get('\EmailAcesso\Service\EmailAcessoService');
        $emailEntity = $emailService->buscar($loginEntity->getIdEmail());

        $usuarioService = new \Usuario\Service\UsuarioService();
        $usuarioEntity = $usuarioService->buscar($id_usuario);

        $txIdentificacao = md5(uniqid(mt_rand(), true));

        $esqueciSenhaService = new \EsqueciSenha\Service\EsqueciSenhaService();
        $esqueciSenhaService->exchangeArray([
            'id' => NULL,
            'id_usuario' => $usuarioEntity->getId(),
            'tx_identificacao' => $txIdentificacao,
            'id_situacao' => $this->getConfigList()['situacao_ativo'],
            'dt_solicitacao' => date('Y-m-d H:i:s'),
        ]);
        $esqueciSenhaService->salvar();

        $contaEmail = 'no-reply';

        $message = new \Zend\Mail\Message();
        $message->addFrom($contaEmail . '@acthosti.com.br', 'ADV-e')
            ->addTo($emailEntity->getEmEmail())
            ->addBcc('alysson@acthosti.com.br')
            ->setSubject('A senha da conta do MC Network foi redefinida');

        $applicationService = new \Application\Service\ApplicationService();
        $transport = $applicationService->getSmtpTranport($contaEmail);

        $htmlMessage = $applicationService->tratarModelo(
            [
                'BASE_URL' => BASE_URL,
                'nomeUsuario' => $usuarioEntity->getNmUsuario(),
                'email' => $emailEntity->getEmEmail(),
                'txIdentificacao' => base64_encode(\Estrutura\Helpers\Bcrypt::hash($txIdentificacao)),
            ], $applicationService->getModelo('senha-redefinida'));

        $html = new \Zend\Mime\Part($htmlMessage);
        $html->type = 'text/html';

        $body = new \Zend\Mime\Message();
        $body->addPart($html);

        $message->setBody($body);
        $transport->send($message);

        $this->getSessionStorage()->forgetMe();
        $this->getAuthService()->clearIdentity();

        $this->addSuccessMessage('Senha alterada com sucesso.');
        $this->redirect()->toRoute('navegacao', ['controller' => 'auth', 'action' => 'login']);
        return FALSE;
    }

    public function confirmEmailAction()
    {

        $id = base64_decode($this->params('id'));

        if (!$id) {

            $this->addErrorMessage('Token não informado.');
            $this->redirect()->toRoute('navegacao', ['controller' => 'auth', 'action' => 'login']);
            return FALSE;
        }

        $loginService = new \Login\Service\LoginService();
        $loginService->setIdSituacao($this->getConfigList()['situacao_inativo']);
        $listLoginService = $loginService->filtrarObjeto();

        if (!$listLoginService->count()) {

            $this->addSuccessMessage('E-mail confirmado com sucesso.');
            $this->redirect()->toRoute('navegacao', ['controller' => 'auth', 'action' => 'login']);
            return FALSE;
        }

        $confirmEmail = FALSE;
        foreach ($listLoginService as $loginEntityAux) {

            if (crypt($loginEntityAux->getId(), $id) === $id) {

                $loginEntityAux->setIdSituacao($this->getConfigList()['situacao_ativo']);
                $loginEntityAux->salvar();
                $confirmEmail = TRUE;
            }
        }

        if ($confirmEmail) {

            $this->addSuccessMessage('E-mail confirmado com sucesso.');
            $this->redirect()->toRoute('navegacao', ['controller' => 'auth', 'action' => 'login']);
            return FALSE;
        }

        $this->addSuccessMessage('E-mail confirmado com sucesso.');
        $this->redirect()->toRoute('navegacao', ['controller' => 'auth', 'action' => 'login']);
        return FALSE;
    }

    public function cadastroEscritorioAction()
    {
        return new ViewModel([
            'form' => new \Auth\Form\CadastroEscritorioForm(),
            'controller' => $this->params('controller'),
        ]);
    }

    public function gravarEscritorioAction()
    {
        $emailService = $this->getServiceLocator()->get('\EmailAcesso\Service\EmailAcessoService');
        $emailService->setEmEmail(trim($this->getRequest()->getPost()->get('em_email')));
        //Verifica se já existe aquele email cadastrado
        if ($emailService->filtrarObjeto()->count()) {
            $this->addErrorMessage('Email já cadastrado. Faça seu login.');
            $this->redirect()->toRoute('navegacao', array('controller' => 'auth', 'action' => 'login'));
            return FALSE;
        }

        $this->getRequest()->getPost()->set('cd_tipo_pessoa', 'E');

        $resultPessoaEscritorio = parent::gravar(
            $this->getServiceLocator()->get('\Pessoa\Service\PessoaService'), new \Pessoa\Form\PessoaForm()
        );

        if ($resultPessoaEscritorio) {
            $this->getRequest()->getPost()->set('id', $resultPessoaEscritorio);
            $this->getRequest()->getPost()->set('nm_escritorio', $this->getRequest()->getPost()->get('nm_pessoa_fisica') . ' ' . $this->getRequest()->getPost()->get('nm_sobrenome'));
            $resultEscritorio = parent::gravarEmTabelaNaoIdentity(
                $this->getServiceLocator()->get('\Escritorio\Service\EscritorioService'), new \Escritorio\Form\EscritorioForm()
            );
            if ($resultEscritorio) {
                $this->getRequest()->getPost()->set('cd_tipo_pessoa', 'F');

                $resultPessoaFis = parent::gravar(
                    $this->getServiceLocator()->get('\Pessoa\Service\PessoaService'), new \Pessoa\Form\PessoaForm()
                );

                if ($resultPessoaFis) {
                    $this->getRequest()->getPost()->set('id', $resultPessoaFis);
                    $this->getRequest()->getPost()->set('sg_estado_civil', $this->getRequest()->getPost()->get('sg_estado_civil'));
                    $this->getRequest()->getPost()->set('cd_escolaridade', $this->getRequest()->getPost()->get('cd_escolaridade'));
                    $this->getRequest()->getPost()->set('nm_pessoa_fisica', $this->getRequest()->getPost()->get('nm_pessoa_fisica'));
                    $this->getRequest()->getPost()->set('nm_sobrenome', $this->getRequest()->getPost()->get('nm_sobrenome'));
                    $this->getRequest()->getPost()->set('nr_cpf', $this->getRequest()->getPost()->get('nr_cpf'));
                    $this->getRequest()->getPost()->set('nm_mae', $this->getRequest()->getPost()->get('nm_mae'));
                    $this->getRequest()->getPost()->set('nm_pai', $this->getRequest()->getPost()->get('nm_pai'));
                    $this->getRequest()->getPost()->set('dt_nascimento', $this->getRequest()->getPost()->get('dt_nascimento'));
                    $this->getRequest()->getPost()->set('sg_sexo', $this->getRequest()->getPost()->get('sg_sexo'));
                    $this->getRequest()->getPost()->set('tp_siatuacao_cadastral', $this->getRequest()->getPost()->get('tp_siatuacao_cadastral'));
                    $this->getRequest()->getPost()->set('tp_residente_exterior', $this->getRequest()->getPost()->get('tp_residente_exterior'));

                    $resultPessoaFisica = parent::gravarEmTabelaNaoIdentity(
                        $this->getServiceLocator()->get('\PessoaFisica\Service\PessoaFisicaService'), new \PessoaFisica\Form\PessoaFisicaForm()
                    );

                    if ($resultPessoaFisica) {
                        $this->getRequest()->getPost()->set('id_pessoa', $resultPessoaEscritorio);
                        $this->getRequest()->getPost()->set('id_pessoa_vinculada', $resultPessoaFisica);
                        $this->getRequest()->getPost()->set('id_tipo_vinculo_pessoa', $this->getConfigList()['flag_responsavel_pelo_escritorio']);
                        $this->getRequest()->getPost()->set('dt_inicio', $this->getRequest()->getPost()->get('dt_inicio'));
                        $this->getRequest()->getPost()->set('dt_fim', $this->getRequest()->getPost()->get('dt_fim'));
                        $this->getRequest()->getPost()->set('st_pessoa_vinculada', 'A');

                        $resultVinculo = parent::gravar(
                            $this->getServiceLocator()->get('\PessoaVinculo\Service\PessoaVinculoService'), new \PessoaVinculo\Form\PessoaVinculoForm()
                        );

                        if($resultVinculo){
                            $this->getRequest()->getPost()->set('id_situacao', $this->getConfigList()['situacao_ativo']);
                            $resultEmailAcesso = parent::gravar(
                                $this->getServiceLocator()->get('\EmailAcesso\Service\EmailAcessoService'), new \EmailAcesso\Form\EmailAcessoForm()
                            );

                            if ($resultEmailAcesso) {
                                $this->getRequest()->getPost()->set('nm_usuario', $this->getRequest()->getPost()->get('nm_pessoa_fisica') . ' ' . $this->getRequest()->getPost()->get('nm_sobrenome'));
                                $this->getRequest()->getPost()->set('id_tipo_usuario', $this->getConfigList()['perfil_administrador']);
                                $this->getRequest()->getPost()->set('id_situacao_usuario', $this->getConfigList()['situacao_usuario_ativo']);
                                $this->getRequest()->getPost()->set('id_email', $resultEmailAcesso); #id_email inserido anteriormente
                                $this->getRequest()->getPost()->set('id_escritorio', $resultPessoaEscritorio); #id_email inserido anteriormente
                                #$this->getRequest()->getPost()->set('id_pessoa_fisica', $resultPessoaFisica); #id_email inserido anteriormente

                                $resultUsuario = parent::gravar(
                                    $this->getServiceLocator()->get('\Usuario\Service\UsuarioService'), new \Usuario\Form\UsuarioEscritorioResponsavelForm()
                                );

                                if ($resultUsuario) {
                                    $this->getRequest()->getPost()->set('id_usuario', $resultUsuario);
                                    //Verifica se é dia 29, 30, 31
                                    $this->getRequest()->getPost()->set('dt_registro', (date('d') >= 29 ? date('Y-m-' . 28 . ' H:m:s') : date('Y-m-d H:m:s')));
                                    $this->getRequest()->getPost()->set('id_perfil', $this->getRequest()->getPost()->get('id_tipo_usuario'));
                                    $this->getRequest()->getPost()->set('pw_senha', md5($this->getRequest()->getPost()->get('pw_senha')));
                                    $this->getRequest()->getPost()->set('id_situacao', $this->getConfigList()['situacao_inativo']);

                                    $resultLogin = parent::gravar(
                                        $this->getServiceLocator()->get('\Login\Service\LoginService'), new \Login\Form\LoginForm()
                                    );

                                    #Se cadastro realizado com sucesso, dispara um email para o usuario
                                    if ($resultLogin) {

                                        $contaEmail = 'no-reply';

                                        $message = new \Zend\Mail\Message();
                                        $message->addFrom($contaEmail . '@acthosti.com.br', 'Acthos Tecnologia')
                                            ->addTo(trim($this->getRequest()->getPost()->get('em_email'))) #Envia para o Email que cadastrou
                                            ->addBcc('alysson.vicuna@gmail.com')
                                            ->setSubject('Confirmação de cadastro');

                                        $applicationService = new \Application\Service\ApplicationService();
                                        $transport = $applicationService->getSmtpTranport($contaEmail);
                                        $htmlMessage = $applicationService->tratarModelo(
                                            [
                                                'BASE_URL' => BASE_URL,
                                                'nomeUsuario' => trim($this->getRequest()->getPost()->get('nm_usuario')),
                                                'txIdentificacao' => base64_encode(\Estrutura\Helpers\Bcrypt::hash($resultLogin)),
                                                'email' => trim($this->getRequest()->getPost()->get('em_email')),
                                            ], $applicationService->getModelo('cadastro'));

                                        $html = new \Zend\Mime\Part($htmlMessage);
                                        $html->type = "text/html";

                                        $body = new \Zend\Mime\Message();
                                        $body->addPart($html);

                                        $message->setBody($body);
                                        $transport->send($message);

                                        $this->addSuccessMessage('Parabéns! Cadastro realizado com sucesso. Para confirmar seu cadastro, leia as instruções que enviamos para você por e-mail.');
                                    }
                                }

                            }
                        }
                    }
                }
            }
        }

        $this->addSuccessMessage('Conta criada com sucesso! Verifique seu email e siga as instruções.');
        $this->redirect()->toRoute('navegacao', array('controller' => 'auth', 'action' => 'login'));
    }


}
