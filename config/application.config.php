<?php

return array(
    'modules' => array(
        'Admin',
        'Application',
        'Auth',
        'Action',
        'Controller',
        'PerfilControllerAction',
        'Estrutura',
        'Gerador',
        'CompactAsset',
        'Config',
        'DOMPDFModule',
        'EdpSuperluminal', //http://dev.advocacia.com.br/?EDPSUPERLUMINAL_CACHE - Execute isso na URL para compilar os arquivos e ficar mais rapido
        // - em cada requisiçao, ao de de baixar em tempo de execuçao cada require do autoload, ele salva um unico arquivo, minificado, com todas as classes dentro.
        'EmailAcesso',
        'EsqueciSenha',
        'Gerador',
        'Login',
        'Perfil',
        'PhpBoletoZf2',
        'Sexo',
        'Situacao',
        'SituacaoUsuario',
        'TipoUsuario',
        'Usuario',
        'Infra',
        'Principal',
        'Permissao',
        'Aluno',
        'Conteudo',
        'ConteudoSimulado',
        'Curso',
        'Disciplina',
        'Resultado',
        'Turno',
        'Simulado',
    ),
    'module_listener_options' => array(
        'module_paths' => array(
            './module',
            './vendor',
        ),
        'config_glob_paths' => array(
            'config/autoload/{,*.}{global,' . APPLICATION_ENV . '}.php'            
        ),
    ) 
);
