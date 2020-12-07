<?php
namespace YoushuJson\Components;

use YoushuJson\Model\YsEasyJson;

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

    /**
     * Notes:根据设置的mapping寻找合适的解析方式
     * User: hejinlong
     * Date: 2020/12/7
     * Time: 9:34 PM
     * @param $obj
     * @param $mapping_val
     * @return mixed
     * @throws \Exception
     */
    public static function mappingAnalyzeGetVal($obj, $mapping_val)
    {
        if (!is_string($mapping_val) && !is_numeric($mapping_val)) {
            throw new \Exception("mapping_val 必须是一个字符串或数字");
        }

        if (strpos($mapping_val, "@") === false) {//未加设置
            return $mapping_val;
        }

        $call_method = str_replace("@", "", $mapping_val);

        if (strpos($mapping_val, "(") === false) {//对象属性
            return $obj->$call_method;;
        }

        if (strpos($mapping_val, "()") !== false) {//对象方法
            $call_method = str_replace("()", "", $call_method);
            return call_user_func_array([$obj, $call_method], []);
        }

        preg_match('/\((.*?)\)/', $call_method,  $argv_match);
        $argv_str = str_replace(" ", "", $argv_match[1]);
        $argv_arr = explode(",", $argv_str);
        preg_match('/(.*?)\(/', $call_method,  $func_match);

        return call_user_func_array([$obj, $func_match[1]], $argv_arr);
    }
}
