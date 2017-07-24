<?php

namespace Event\Factory;

use Event\Repository\EventRepository;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class EventRepositoryFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $tableGateway = $container->get('Model\EventTableGateway');

        return new EventRepository($tableGateway);
    }
}