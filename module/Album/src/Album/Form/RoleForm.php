<?php

namespace Album\Form;

use Zend\Form\Form;
use Album\Entity\Role;
use Doctrine\ORM\EntityManager;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class RoleForm extends Form implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('role');

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
            'type'  => 'DoctrineModule\Form\Element\ObjectSelect',
            /*'attributes' => array(
                'onChange' => 'change()'
            ),*/
            'options' => array(
                'label' => 'Role',
                'empty_option'   => '',
                'object_manager' => $this->getServiceManager()->get('doctrine.entitymanager.orm_default'),
                'target_class'   => Role::class,
                'property'       => 'role',
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array(
                        ),
                    ),
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