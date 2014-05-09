<?php
namespace Doukaku\Lesson\Model;

class SequenceCollection
{
    public $sequences = [];
    public $addingPolicy = null;
    public $outputFilter = null;

    public function __construct($sequences)
    {
        $this->sequences = $sequences;
    }

    public function add(SequenceElement $element)
    {
        return is_callable($this->addingPolicy) ? call_user_func($this->addingPolicy, $this, $element) : false;
    }

    public function __toString()
    {
        return implode('|', call_user_func($this->outputFilter, $this->sequences));
    }
}
