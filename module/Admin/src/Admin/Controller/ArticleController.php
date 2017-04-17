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
               ->orderBy('a.id', ASC);

        $adapter = new DoctrineAdapter(new ORMPaginator($query));

        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(1);
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
            $data = $request->getPost();
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
}
