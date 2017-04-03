<?php

namespace Album\Form;

use Zend\Form\Form;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

class RoleForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('album');

        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
        $this->add(array(
            'name' => 'role',
            'type'  => 'Select',
            'attributes' => array(
                'onChange' => 'alert("Клик!")'
            ),
            'options' => array(
                'label' => 'role',
                'value_options' => array(
                    '1' => 'Федеральная антимонопольная служба',
                    '2' => 'Федеральная служба по оборонному заказу',
                    '3' => 'Орган исполнительной власти субъекта РФ',
                    '4' => 'Орган местного самоуправления муниципального района, городского округа',
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