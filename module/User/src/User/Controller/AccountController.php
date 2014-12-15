<?php

namespace User\Controller;

use User\Form\User as UserForm;
use User\Model\Interfaces\UserDaoInterface;
use User\Model\User;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AccountController extends AbstractActionController
{
    /**
     * @var UserDaoInterface
     */
    private $_model;

    function __construct(UserDaoInterface $_model)
    {
        $this->_model = $_model;
    }

    public function indexAction()
    {
        $this->layout()->title = 'List Users';
        $users = $this->_model->findAll();

        return ['users' => $users];
    }

    public function createAction()
    {
        $this->layout()->title = 'Create User';

        $form = new UserForm();
        $form->get('submit')->setValue('Create New User');
        $form->setAttribute('action', $this->url()->fromRoute('account_doCreate'));

        return ['form' => $form];
    }

    public function doCreateAction()
    {
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form = new UserForm();
            $userEntity = new User();
            $form->setInputFilter($userEntity->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $formData = $form->getData();

                $data['email']      = $formData['email'];
                $data['password']   = $formData['password'];
                $data['role']       = $formData['role'];
                $data['date']       = date('Y-m-d H:i:s');

                $this->_model->save($data);
                return $this->redirect()->toRoute('account');
            }

            $form->prepare();

            $this->layout()->title = 'Create User - Error - Review your data';

            // we reuse the create view
            $view = new ViewModel(['form' => $form]);
            $view->setTemplate('user/account/create.phtml');

            return $view;
        }

        $this->redirect()->toRoute('account_create');
    }

    public function viewAction()
    {
        $this->layout()->title = 'User Details';

        $id = $this->params()->fromRoute('id');
        $user = $this->_model->getById($id);

        return ['user' => $user];
    }

    public function deleteAction()
    {
        $this->_model->delete($this->params()->fromRoute('id'));

        $this->redirect()->toRoute('account');
    }

    public function updateAction()
    {
        $this->layout()->title = 'Update User';

        $user = $this->_model->getById($this->params()->fromRoute('id'));

        $form = new UserForm();
        $form->setAttribute('action', $this->url()->fromRoute('account_doUpdate'));
        $form->bind($user);
        $form->get('submit')->setAttribute('value', 'Edit User');

        // we reuse the create view
        $view = new ViewModel(['form' => $form, 'isUpdate' => true]);
        $view->setTemplate('user/account/create.phtml');

        return $view;
    }

    public function doUpdateAction()
    {
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form = new UserForm();
            $userEntity = new User();
            $form->setInputFilter($userEntity->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $formData = $form->getData();

                $data['id']         = $formData['id'];
                $data['email']      = $formData['email'];
                $data['password']   = $formData['password'];
                $data['role']       = $formData['role'];
                $data['date']       = date('Y-m-d H:i:s');

                $this->_model->update($data);
                return $this->redirect()->toRoute('account');
            }

            $form->prepare();

            $this->layout()->title = 'Update User - Error - Review your data';

            // we reuse the create view
            $view = new ViewModel(['form' => $form, 'isUpdate' => true]);
            $view->setTemplate('user/account/create.phtml');

            return $view;
        }

        $this->redirect()->toRoute('account');
    }
}

