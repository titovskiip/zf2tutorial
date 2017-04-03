<?php

return array(
    'doctrine' => array(
        'driver' => array(
            'repo_entity' => array(
                'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'paths' => array(__DIR__ . '/../src/Album/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Repo\Entity' => 'repo_entity',
                )
            )
        )
    ),

    'controllers' => array(
        'invokables' => array(
            'Repo\Controller\User' => 'Repo\Controller\UserController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'repo' => __DIR__ . '/../view',
        ),
    ),

    'router' => array(
        'routes' => array(
            'repo' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/repo[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Repo\Controller\User',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'repo' => __DIR__ . '/../view',
        ),
    ),
);
