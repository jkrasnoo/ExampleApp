<?php

namespace Event\Repository;

use Zend\Db\Exception\RuntimeException;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGatewayInterface;
use Carbon\Carbon;
use Event\Model\Event;

class EventRepository
{
    const EVENT_ID          = 'id';
    const EVENT_DATE        = 'date';
    const EVENT_TITLE       = 'title';
    const EVENT_IMAGE       = 'image';
    const EVENT_DESCRIPTION = 'description';

    protected $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function getEvent($id)
    {
        $id = (int) $id;

        /**
         * @var $rowset ResultSet   The result set.
         */
        $rowset = $this->tableGateway->select([self::EVENT_ID => $id]);

        $row = $rowset->current();

        if (!$row)
        {
            throw new RuntimeException(sprintf('Could not find event with identifier %d', $id));
        }

        return $row;
    }

    public function getOnlyCurrentEvents()
    {
        $carbon = new Carbon();
        $where = sprintf('\'%s\' >= date', $carbon->toDateTimeString());

        $result = $this->tableGateway->select($where);

        return $result;
    }

    public function insert(Event $event)
    {
        $data = $event->toArray();

        $this->tableGateway->insert($data);
    }

    public function update(Event $event)
    {
        $id = (int) $event->id;

        $data = $event->toArray();
        unset($data['id']);

        if (!$this->getEvent($id))
        {
            throw new RuntimeException(sprintf(
                'Cannot update event with identifier %d; does not exist.',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => (int) $id ]);
    }

    public function delete($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}