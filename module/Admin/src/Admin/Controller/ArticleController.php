<?php

namespace Admin\Controller;

use Admin\Form\ArticleAddForm;
use Blog\Entity\Article;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Controller\BaseAdminController as BaseController;
use Blog\Entity\Category;
use Zend\Mvc\Controller\Plugin\FlashMessenger;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;

class ArticleController extends BaseController
{
    public function indexAction()
    {
        $query = $this->getEntityManager()->createQueryBuilder();
        $query ->select('a')
               ->from('Blog\Entity\Article','a')
               ->orderBy('a.id','ASC');

        $adapter = new DoctrineAdapter(new ORMPaginator($query));

        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(5);
        $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page',1));
        return array('articles' => $paginator);
    }

    public function addAction()
    {
        $em = $this->getEntityManager();
        $form = new ArticleAddForm($em);


        $request = $this->getRequest();

        if ($request->isPost()) {
            $status = $message = '';
            $data = $request->getPost()->toArray();
            $article = new Article();
            $form->setHydrator(new DoctrineHydrator ($em, 'Blog\Entity\Article'));
            $form->bind($article);
            $form->setData($data);

            if ($form->isValid()) {
                $em->persist($article);
                $em->flush();

                $status = 'success';
                $message = 'Статья добавлена';
            } else {
                $status = 'error';
                $message = 'Ошибка';
                $err=$form->getMessages();

                foreach ($form->getInputFilter()->getInvalidInput() as $errors) {
                    foreach ($errors->getMessages() as $error) {
                        $message .= ' ' . $error;
                    }
                }
            }
        } else {
            return array('form' => $form);
        }

        if ($message) {
            $this->flashMessenger()->setNamespace($status)->addMessage($message);
        }

        return $this->redirect()->toRoute('admin/article');

    }

    public function editAction()
    {
        $em = $this->getEntityManager();
        $form = new ArticleAddForm($em);

        $id = (int) $this->params()->fromRoute('id',0);
        $article = $em->find('Blog\Entity\Article', $id);

        if (empty($article)) {
            $message = 'Статья не найдена';
            $status='error';
            $this->flashMessenger()->setNamespace($status)->addMessage($message);
            return $this->redirect()->toRoute('admin/article');
        }
        $form->setHydrator(new DoctrineHydrator ($em, 'Blog\Entity\Article'));
        $form->bind($article);

        $request = $this->getRequest();

        if ($request->isPost()) {
            $status = $message = '';
            $data = $request->getPost()->toArray();
            $form->setData($data);

            if ($form->isValid()) {
                $em->persist($article);
                $em->flush();

                $status = 'success';
                $message = 'Статья обновлена';
            } else {
                $status = 'error';
                $message = 'Ошибка';
                $err=$form->getMessages();

                foreach ($form->getInputFilter()->getInvalidInput() as $errors) {
                    foreach ($errors->getMessages() as $error) {
                        $message .= ' ' . $error;
                    }
                }
            }
        } else {
            return array('form' => $form, 'id'=>$id);
        }

        if ($message) {
            $this->flashMessenger()->setNamespace($status)->addMessage($message);
        }

        return $this->redirect()->toRoute('admin/article');
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id' ,0);
        $em = $this->getEntityManager();

        $status = FlashMessenger::NAMESPACE_SUCCESS;
        $message = 'Категория удалена';

        try {
            $repository = $em->getRepository('Blog\Entity\Article');
            $article = $repository->find($id);
            $em->remove($article);
            $em->flush();
        }
        catch (\Exception $e){
            $status = 'error';
            $message = 'Ошибка удаления записи:' . $e->getMessage();
        }

        $this->flashMessenger()->setNamespace($status)->addMessage($message);
        return $this->redirect()->toRoute('admin/article');
    }
}
