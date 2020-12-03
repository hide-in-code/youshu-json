<?php

namespace YoushuJson\Model;

/**
 * Created by PhpStorm
 * User: hejinlong
 * Date: 2020/11/26
 * Time: 1:53 PM
 */

class YsMark
{
    public $type;
    public $pselect;
    public $color;
    public $objectId;
    public $isfillOverlay;
    public $boxId;
    public $angle;

    /**
     * @var array[YsPoint]
     */
    public $point;

    /**
     * @var array
     */
    public $property;

    public function getAllPoints()
    {
        return $this->point;
    }

    public function getAllProperties()
    {
        return $this->property;
    }
}
