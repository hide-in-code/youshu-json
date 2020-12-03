<?php
namespace YoushuJson\Components;

/**
 * Created by PhpStorm
 * User: hejinlong
 * Date: 2020/11/26
 * Time: 3:05 PM
 */

class Analyzer
{
    /**
     * Notes:分析属性层级
     * 最终得到属性标签的一个属性特征
     * User: hejinlong
     * Date: 2020/11/26
     * Time: 4:01 PM
     * @param $props
     * @return string
     */
    public static function getPropFeature($props)
    {
        $feature_str = '';
        foreach ($props as $propArr) {
            foreach ($propArr as $prop) {
                $feature_str .= $prop->parentid;
            }
        }

        return $feature_str;
    }
}
