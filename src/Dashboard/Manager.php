<?php

namespace Terranet\Administrator\Dashboard;

use App\Http\Terranet\Administrator\Widgets\PublicPlaceImages;
use App\Models\PublicPlace;
use Closure;
use IteratorAggregate;

class Manager implements IteratorAggregate
{
    /** @var array */
    protected $rows = [];

    /**
     * @param Closure $callback
     *
     * @return static
     */
    public function row(Closure $callback)
    {
        $callback($row = new Row());

        $this->rows[] = $row;

        return $this;
    }

    /**
     * @return \ArrayIterator|\Traversable
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->rows);
    }

    /*public function push($widget)
    {
        $this->rows[] = $widget;
        return $this;
    }*/
    public function push($widget)
    {
        if ($widget instanceof PublicPlace) {
            $publicPlaceImages = new PublicPlaceImages($widget->images);
            $this->rows[] = $publicPlaceImages;
        } else {
            $this->rows[] = $widget;
        }

        return $this;
    }


}
