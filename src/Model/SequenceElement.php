<?php
namespace Doukaku\Lesson\Model;

class SequenceElement
{
    protected $number;
    protected $order = [];

    function __construct($number, $order)
    {
        $this->number = $number;
        $this->order = $order;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function nextIndex()
    {
        return array_shift($this->order);
    }

    public function __toString()
    {
        return sprintf('%s', $this->number);
    }
}
