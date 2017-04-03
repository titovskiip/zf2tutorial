<?php

namespace Repo\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
/*use Album\Entity\Album;
use Album\Model;
use Album\Form\AlbumForm;*/
use Doctrine\ORM\EntityManager;

class UserController extends AbstractActionController
{
    protected $em;

    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }

    public function indexAction()
    {
        return new ViewModel(array(
            'albums' => 'Album\Entity\Album',
        ));
    }

    public function authAction(){
        $form = new Application_Form_Enter();
        if ($form->isValid($this->getRequest()->getPost())){
            $bootstrap = $this->getInvokeArg('bootstrap');
            $auth = Zend_Auth::getInstance();
            $adapter = $bootstrap->getPluginResource('db')->getDbAdapter();
            $authAdapter = new Zend_Auth_Adapter_DbTable(
                $adapter, 'user', 'login',
                'password', 'MD5(?)'
            );
            $authAdapter->setIdentity($form->login->getValue());
            $authAdapter->setCredential($form->password->getValue());
            $result = $auth->authenticate($authAdapter);
            // Если валидация прошла успешно сохраняем в storage инфу о пользователе
            if ($result->isValid()){
                $storage = $auth->getStorage();
                $storage_data = $authAdapter->getResultRowObject(
                    null,
                    array('activate', 'password', 'enabled'));
                $user_model = new Application_Model_DbTable_User();
                $language_model = new Application_Model_DbTable_Language();
                $storage_data->status = 'user';
                $storage->write($storage_data);
            }
        }
    }

   /* public function addAction()
    {
        $form = new AlbumForm();
        $form->get('submit')->setValue('Add');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $album = new Album();
            $form->setInputFilter($album->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $album->exchangeArray($form->getData());
                $this->getEntityManager()->persist($album);
                $this->getEntityManager()->flush();
                // Redirect to list of albums
                return $this->redirect()->toRoute('album');
            }
        }
        return array('form' => $form);
    }
    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('album', array(
                'action' => 'add'
            ));
        }
        $album = $this->getEntityManager()->find('Album\Entity\Album', $id);
        if (!$album) {
            return $this->redirect()->toRoute('album', array(
                'action' => 'index'
            ));
        }
        $form  = new AlbumForm();
        $form->bind($album);
        $form->get('submit')->setAttribute('value', 'Edit');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($album->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getEntityManager()->flush();
                // Redirect to list of albums
                return $this->redirect()->toRoute('album');
            }
        }
        return array(
            'id' => $id,
            'form' => $form,
        );
    }
    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('album');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $album = $this->getEntityManager()->find('Album\Entity\Album', $id);
                if ($album) {
                    $this->getEntityManager()->remove($album);
                    $this->getEntityManager()->flush();
                }
            }
            // Redirect to list of albums
            return $this->redirect()->toRoute('album');
        }
        return array(
            'id'    => $id,
            'album' => $this->getEntityManager()->find('Album\Entity\Album', $id)
        );
    }*/
}