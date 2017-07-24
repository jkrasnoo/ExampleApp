<?php

namespace Event\Factory;

use Interop\Container\ContainerInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Db\ResultSet\ResultSet;
use Event\Model\Event;

class EventTableGatewayFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $dbAdapter = $container->get('Application\Db\Adapter');
        $resultsSetPrototype = new ResultSet();
        $resultsSetPrototype->setArrayObjectPrototype(new Event());

        return new TableGateway('event', $dbAdapter, null, $resultsSetPrototype);
    }
}