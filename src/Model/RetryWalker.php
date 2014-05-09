<?php
namespace Doukaku\Lesson\Model;

class RetryWalker
{
    public function __invoke(SequenceCollection $collection, $elements)
    {
        while ($element = array_shift($elements)) {
            if (!$collection->add($element)) {
                array_push($elements, $element);
            }
        }
    }
}
