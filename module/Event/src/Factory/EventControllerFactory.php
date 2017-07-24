<?php

namespace Event\Factory;

use Event\Model\EventTable;
use Event\Repository\EventRepository;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Event\Controller\EventController;

class EventControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $eventRepository = $container->get(EventRepository::class);
        return new EventController($eventRepository);
    }
}