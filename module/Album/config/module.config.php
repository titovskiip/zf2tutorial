<?php

return array(
    'doctrine' => array(
        'driver' => array(
            'album_entity' => array(
                'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'paths' => array(__DIR__ . '/../src/Album/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Album\Entity' => 'album_entity',
                )
            )
        )
    ),

    'form_elements' => array(
        'factories' => array(
            'Album\Form\RoleForm' => 'Album\Factory\Form\RoleFormFactory',
        ),
    ),

    'controllers' => array(
       /* 'invokables' => array(
            'Album\Controller\Album' => 'Album\Controller\AlbumController',
        ),*/
        'factories' => array(
            'Album\Controller\Album' => 'Album\Factory\Controller\RoleControllerFactory',
        ),

    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'album' => __DIR__ . '/../view',
        ),
    ),

    'router' => array(
        'routes' => array(
            'album' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/album[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Album\Controller\Album',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'album' => __DIR__ . '/../view',
        ),
    ),
);
