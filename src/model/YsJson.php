<?php

namespace YoushuJson\Model;

use YoushuJson\Components\Analyzer;

/**
 * Created by PhpStorm
 * User: hejinlong
 * Date: 2020/11/26
 * Time: 1:53 PM
 */

class YsJson
{
    public $imgUrl;
    public $width;
    public $height;

    /**
     * @var array[YsMark]
     */
    public $marks;

    public $rotateDeg;

    public $propMap = [];//用于分析工具和属性使用, 里面包含了分析整个json所有属性代表，需要先调用propAnalyzer()

    public function getAllMarks()
    {
        return $this->marks;
    }

    /**
     * Notes:
     * User: hejinlong
     * Date: 2020/11/26
     * Time: 4:13 PM
     */
    public function propAnalyzer()
    {
        $freature_arr = [];
        foreach ($this->marks as $mark) {
            if (!isset($this->propMap[$mark->type])) {
                $this->propMap[$mark->type] = [];
            }

            $feature = Analyzer::getPropFeature($mark->property);

            if (!in_array($feature, $freature_arr)) {
                $freature_arr[] = $feature;
                $this->propMap[$mark->type][] = json_encode($mark->property, JSON_UNESCAPED_UNICODE);
            }
        }
    }

    public function getFileName()
    {
        return pathinfo($this->imgUrl)['basename'];
    }

    public function load($json)
    {
        $mapper = new \JsonMapper();
        $obj = $mapper->map(json_decode($json), new static());
        $class = new \ReflectionClass($obj);
        foreach ($class->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
            foreach ($obj as $key => $item) {
                if ($key == $property->getName()) {
                    $property->setValue($this, $item);
                    break;
                }
            }
        }
    }
}
