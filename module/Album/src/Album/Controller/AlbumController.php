<?php

namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;

class AlbumController extends AbstractActionController
{
    /**
     * @var DoctrineORMEntityManager
     */
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
        $this->getEntityManager();
        $ee=$this->em->getRepository('\Album\Entity\Album')->findAll();
        return new ViewModel(array(
            'albums' => $ee,
        ));
    }

    public function addAction()
    {
    }

    public function editAction()
    {
    }

    public function deleteAction()
    {
    }
}