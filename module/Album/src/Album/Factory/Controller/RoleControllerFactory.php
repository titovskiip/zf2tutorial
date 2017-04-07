<?php

namespace Album\Factory\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Album\Controller\AlbumController;

class RoleControllerFactory implements FactoryInterface
{
public function createService(ServiceLocatorInterface $serviceLocator)
{
$services       = $serviceLocator->getServiceLocator();
$roleForm    = $services->get('FormElementManager')->get('Album\Form\RoleForm');
$controller = new AlbumController($roleForm);

return $controller;
}
}