<?php

namespace Event\Controller;

use Event\Form\EventForm;
use Event\Model\Event;
use Event\Repository\EventRepository;
use Zend\Http\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class EventController extends AbstractActionController
{
    protected $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function currentAction()
    {
        $events = $this->eventRepository->getOnlyCurrentEvents();
        return new ViewModel([
            'events' => $events
        ]);
    }

    public function indexAction()
    {
        $events = $this->eventRepository->fetchAll();
        return new ViewModel([
            'events' => $events
        ]);
    }

    public function addAction()
    {
        $eventForm = new EventForm();
        $eventForm->get('submit')->setValue('Add');

        /** @var Request $request */
        $request = $this->getRequest();

        if ($request->isPost())
        {
            $event = new Event();
            $eventForm->setInputFilter($event->getInputFilter());
            $eventForm->setData($request->getPost());
        }

        return new ViewModel([
            'form' => $eventForm
        ]);
    }

    public function editAction()
    {
        return new ViewModel();
    }

    public function deleteAction()
    {
        return new ViewModel();
    }
}