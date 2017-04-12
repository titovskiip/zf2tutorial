<?php

namespace Admin\Controller;

use Admin\Form\CategoryAddForm;
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
        $paginator->setDefaultItemCountPerPage(10);
        $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page',1));
        return array('articles' => $paginator);
    }
}
