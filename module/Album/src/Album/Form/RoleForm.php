<?php

namespace Album\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\ORM\EntityManager;

class RoleForm extends Form implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        parent::__construct();

        $this->entityManager = $entityManager;
    }

    public function init()
    {
        //$r = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default')->getRepository('Album\Entity\Role')->findAll();
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));

        $this->add(array(
            'name' => 'role',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'object_manager'     => $this->entityManager,
                'target_class'       =>  Role::class,
                'property' => 'role',
                'is_method' => true,
                'find_method'        => array(
                    'name'   => 'getRole',
                ),
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));
    }
}