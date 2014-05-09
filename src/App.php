<?php
namespace Doukaku\Lesson;

use Doukaku\Lesson\Model\AvailableFilter;
use Doukaku\Lesson\Model\OrderedAddingPolicy;
use Doukaku\Lesson\Model\RetryWalker;
use Doukaku\Lesson\Model\Sequence;
use Doukaku\Lesson\Model\SequenceCollection;
use Doukaku\Lesson\Model\SequenceElement;
use Ginq\Ginq;

class App
{
    private $classes;
    private $walker;

    public function __construct()
    {
        $classes = [
            1 => new Sequence(1, 4),
            2 => new Sequence(2, 4),
            3 => new Sequence(3, 4),
            4 => new Sequence(4, 4),
            5 => new Sequence(5, 4),
        ];
        $this->classes = new SequenceCollection($classes);
        $this->classes->addingPolicy = new OrderedAddingPolicy();
        $this->classes->outputFilter = new AvailableFilter();
        $this->walker = new RetryWalker();
    }

    public function run($input)
    {
        $elements = $this->parseInput($input);
        call_user_func($this->walker, $this->classes, $elements);

        return (string)$this->classes;
    }

    public function parseInput($input)
    {
        $elements = explode('|', $input);

        return Ginq::from($elements)
            ->select(function($v) {
                return $this->parseElement($v);
            })
            ->toArray();
    }

    public function parseElement($element)
    {
        $temp = explode('_', $element);
        $number = $temp[0];
        $order = str_split($temp[1]);

        return new SequenceElement($number, $order);
    }
}
