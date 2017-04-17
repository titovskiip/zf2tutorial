<?php

namespace Admin\Filter;

use Zend\InputFilter\InputFilter;

class ArticleAddInputFilter extends InputFilter
{
    public function __construct()
    {
        $this->add(array(
            'name'=>'title',
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'StringLength', //название валидатора
                    'options' => array(
                        'min' => 3,
                        'max' => 100,
                    ),
                ),
            ),
            'filters' => array(
                array('name' => 'StripTags'), //удалить все теги
                array('name' => 'StringTrim'),//удалить пробелы вначале и вконце
            ),
        ));

        $this->add(array(
            'name'=>'shortArticle',
            'required' => false,
            'validators' => array(
                array(
                    'name' => 'StringLength', //название валидатора
                    'options' => array(
                        'max' => 800,
                    ),
                ),
            ),
            'filters' => array(
                array('name' => 'StringTrim'),//удалить пробелы вначале и вконце
            ),
        ));

        $this->add(array(
            'name'=>'article',
            'required' => true,
            'filters' => array(
                array('name' => 'StringTrim'),//удалить пробелы вначале и вконце
            ),
        ));

        $this->add(array(
            'name'=>'isPublic',
            'required' => false,
        ));

        $this->add(array(
            'name'=>'category',
            'required' => true,
        ));
    }
}