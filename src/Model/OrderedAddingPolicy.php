<?php
namespace Doukaku\Lesson\Model;

class OrderedAddingPolicy
{
    public function __invoke(SequenceCollection $collection, SequenceElement $element)
    {
        if (!($index = $element->nextIndex())) return true;

        $sequence = $collection->sequences[$index];

        if ($sequence->full()) return false;

        $sequence->add($element);

        return true;
    }
}
