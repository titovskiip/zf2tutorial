<?php

namespace Admin\Controller;

use Admin\Form\CategoryAddForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Controller\BaseAdminController as BaseController;
use Blog\Entity\Category;
use Zend\Mvc\Controller\Plugin\FlashMessenger;

class CategoryController extends BaseController
{
    public function indexAction()
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT u FROM Blog\Entity\Category u ORDER BY u.id DESC');
        $rows = $query->getResult();

        return array('category' => $rows);
    }

    public function addAction()
    {
        $form = new CategoryAddForm();
        $status = $message = '';
        $em = $this->getEntityManager();

        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $category = new Category();
                $category->exchangeArray($form->getData());

                $em->persist($category);
                $em->flush();

                $status = 'success';
                $message = 'Категория добавлена';

            } else {
                $status = 'error';
                $message = 'Ошибка параметров';
            }
        } else {
            return array('form' => $form);
        }

        if ($message) {
            $this->flashMessenger()->setNamespace($status)->addMessage($message);
        }

        return $this->redirect()->toRoute('admin/category');
    }

    public function editAction()
    {
        $form = new CategoryAddForm();
        $status = $message = '';
        $em = $this->getEntityManager();

        $id = (int) $this->params()->fromRoute('id',0);

        $category = $em->find('Blog\Entity\Category',$id);

        if (empty($category)){
            $status = 'error';
            $message = 'Категория не найдена';
            $this->flashMessenger()->setNamespace($status)->addMessage($message);
            return $this->redirect()->toRoute('admin/category');
        }

        $form->bind($category);

        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $em->persist($category);
                $em->flush();

                $status = 'success';
                $message = 'Категория добавлена';

            } else {
                $status = 'error';
                $message = 'Ошибка параметров';
            }
        } else {
          return array('form' =>$form, 'id' => $id);
        }

        if ($message) {
            $this->flashMessenger()->setNamespace($status)->addMessage($message);
        }

        return $this->redirect()->toRoute('admin/category');
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id' ,0);
        $em = $this->getEntityManager();

        $status = FlashMessenger::NAMESPACE_SUCCESS;
        $message = 'Категория удалена';

        try {
            $repository = $em->getRepository('Blog\Entity\Category');
            $category = $repository->find($id);
            $em->remove($category);
            $em->flush();
        }
        catch (\Exception $e){
            $status = 'error';
            $message = 'Ошибка удаления записи:' . $e->getMessage();
        }

        $this->flashMessenger()->setNamespace($status)->addMessage($message);
        return $this->redirect()->toRoute('admin/category');
    }
}
