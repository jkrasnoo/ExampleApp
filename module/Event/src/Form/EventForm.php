<?php

namespace Event\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;

class EventForm extends Form implements InputFilterProviderInterface
{
    public function __construct($name = null, array $options = [])
    {
        parent::__construct('event', $options);

        $this->add([
            'name' => 'id',
            'type' => 'hidden'
        ]);

        $this->add([
            'type'     => Element\DateTime::class,
            'name'     => 'event-date-time',
            'attributes' => [
                'class' => 'form-control'
            ],
            'options'  => [
                'label' => 'Event Date and Time',
                'format' => 'Y-m-d H:i:s'
            ]
        ]);

        $this->add([
            'type'     => Element\Text::class,
            'name'     => 'title',
            'attributes' => [
                'class' => 'form-control'
            ],
            'options'  => [
                'label' => 'Event Title'
            ]
        ]);

        $this->add([
            'type'     => Element\Textarea::class,
            'name'     => 'description',
            'attributes' => [
                'class' => 'form-control'
            ],
            'options'  => [
                'label' => 'Event Description'
            ]
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Submit',
                'id'    => 'submitbutton',
                'class' => 'btn btn-primary'
            ],
        ]);
    }

    public function getInputFilterSpecification()
    {
        return [

        ];
    }
}