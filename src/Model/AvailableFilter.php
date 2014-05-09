<?php
namespace Doukaku\Lesson\Model;

use Ginq\Ginq;

class AvailableFilter
{
    public function __invoke($sequences)
    {
        return Ginq::from($sequences)
            ->where(function ($v) {
                return $v->count() > 0;
            })
            ->toArray();
    }
}
