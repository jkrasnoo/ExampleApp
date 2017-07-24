<?php

namespace Event\Model;

use Carbon\Carbon;
use Zend\Filter\DateTimeFormatter;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\InputFilter\InputFilter;
use Zend\Validator\StringLength;

class Event
{
    /**
     * @var $id int   The id.
     */
    public $id;

    /**
     * @var $date Carbon   The date of the event.
     */
    public $dateTime;

    /**
     * @var $title string   The title of the event.
     */
    public $title;

    /**
     * @var $description string   The description of the event.
     */
    public $description;

    /**
     * @var $inputFilter InputFilter  The domain input filter.
     */
    private $inputFilter;

    public function exchangeArray(array $data)
    {
        $this->id          = !empty($data['id']) ? $data['id'] : null;
        $this->dateTime    = !empty($data['date']) ? $data['date'] : null;
        $this->title       = !empty($data['title']) ? $data['title'] : null;
        $this->description = !empty($data['description']) ? $data['description'] : null;
    }

    public function toArray()
    {
        return [
            'id'          => $this->id,
            'date'        => $this->dateTime,
            'title'       => $this->title,
            'description' => $this->description
        ];
    }

    public function getInputFilter()
    {
        if ($this->inputFilter)
        {
            return $this->inputFilter;
        }

        $inputFilter = new InputFilter();

        $inputFilter->add([
            'name'     => 'id',
            'required' => true,
            'filters'  => [
                [ 'name' => ToInt::class ]
            ]
        ]);

        $inputFilter->add([
            'name'     => 'date',
            'required' => true,
            'filters'  => [
                [
                    'name'    => DateTimeFormatter::class,
                    'options' => [
                        'format' => 'Y-m-d h:i:s'
                    ]
                ]
            ]
        ]);

        $inputFilter->add([
            'name'     => 'title',
            'required' => true,
            'filters'  => [
                [ 'name' => StripTags::class ],
                [ 'name' => StringTrim::class]
            ],
            'validators' => [
                [
                    'name'    => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min'      => 1,
                        'max'      => 255
                    ]
                ]
            ]
        ]);

        $inputFilter->add([
           'name'      => 'description',
            'required' => true,
            'filters'  => [
                [ 'name' => StripTags::class ],
                [ 'name' => StringTrim::class ]
            ],
            'validators' => [
                [
                    'name'    => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min'      => 100,
                        'max'      => 6000
                    ]
                ]
            ]
        ]);

        $this->inputFilter = $inputFilter;
        return $this->inputFilter;
    }
}