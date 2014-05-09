<?php
namespace Doukaku\Lesson\Model;

use Ginq\Ginq;

class Sequence
{
    public $limit;
    public $elements = [];
    public $name;

    public function __construct($name, $limit)
    {
        $this->name = $name;
        $this->limit = $limit;
    }

    public function full()
    {
        return count($this->elements) >= $this->limit;
    }

    public function count()
    {
        return count($this->elements);
    }

    public function add(SequenceElement $element)
    {
        $this->elements[] = $element;
    }

    public function __toString()
    {
        $elements = Ginq::from($this->elements)
            ->orderBy(function($v){
                return (int)$v->getNumber();
            })
            ->toArray();

        return sprintf('%s_%s', $this->name, implode(':', $elements));
    }
}
