<?php

namespace Auth\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class AuthForm extends AbstractForm {

    public function __construct($options = []) {

        parent::__construct('login');

        $this->inputFilter = new InputFilter();

        $objForm = new FormObject(
                'usuario', $this, $this->inputFilter
        );

        $objForm->email('email')->required(true)->setAttribute('placeholder', 'Email')->label('Email');
        $objForm->password('senha')->required(true)->setAttribute('placeholder', 'Senha')->label('Senha');


        $this->formObject = $objForm;
    }

    public function getInputFilter() {
        return $this->inputFilter;
    }

}
