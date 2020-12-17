<?php
namespace YoushuJson\Components;

use Adbar\Dot;

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
        if ($mapping_val instanceof \Closure) {//闭包
            return $mapping_val($obj);
        }

        if (strpos($mapping_val, "@") === false) {//未加设置，默认是字符串
            return $mapping_val;
        }

        $Dot = new Dot(json_decode(json_encode($obj), true));//备用

        //对象属性
        if (strpos($mapping_val, "(") === false) {
            $call_method = str_replace("@", "", $mapping_val);
            if (strpos($call_method, ".") === false) {//单级属性
                return $obj->$call_method;
            }

            //获取多技属性
            return $Dot->get($call_method);
        }

        //执行方法
        $call_method = substr($mapping_val, 1);
        preg_match('/\((.*?)\)/', $call_method,  $argv_match);
        $argv_str = str_replace(" ", "", $argv_match[1]);
        preg_match('/(.*?)\(/', $call_method,  $func_match);

        $funName = $func_match[1];//执行方法名
        $argv_arr = self::argvAnalyze(explode(",", $argv_str), $Dot, $obj);//参数分析

        //优先执行类内部方法
        if (method_exists($obj, $funName)) {
            if (strpos($mapping_val, "()") === false) {//带参数
                return call_user_func_array([$obj, $funName], $argv_arr);
            }
            return call_user_func_array([$obj, $funName], []);
        }

        //执行php标准方法
        if (function_exists($funName)) {
            return call_user_func_array($funName,  $argv_arr);
        }

        //执行某个类的静态方法
        if (strpos($funName, "::") !== false) {
            $class_func_arr = explode("::", $funName);
            $class = $class_func_arr[0];
            $func = $class_func_arr[1];
            $object = new $class();
            if (method_exists($object, $func)) {
                if (strpos($func, "()") === false) {//带参数
                    return call_user_func_array([$object, $func], $argv_arr);
                }
                return call_user_func_array([$object, $func], []);
            }
        }

        //执行某个类的方法
        if (strpos($funName, "->") !== false) {
            $class_func_arr = explode("->", $funName);
            $object = $class_func_arr[0];
            $func = $class_func_arr[1];
            if (method_exists($object, $func)) {
                if (strpos($func, "()") === false) {//带参数
                    return call_user_func_array([$object, $func], $argv_arr);
                }
                return call_user_func_array([$object, $func], []);
            }
        }

        throw new \Exception("$funName 不是一个可执行的方法");
    }

    /**
     * Notes:调用方法参数分析，在执行函数之前先对参数进行分析
     * User: hejinlong
     * Date: 2020/12/17
     * Time: 2:12 PM
     * @param $argv_arr
     * @param $dot
     * @param $obj
     * @return mixed
     */
    private static function argvAnalyze(array $argv_arr, Dot $dot, $obj)
    {
        $ret = [];
        foreach ($argv_arr as $argv) {
            if (strpos($argv, "@") === false) {//如果不带@表示一般字符串参数
                $ret[] = $argv;
            } else {
                if (strpos($argv, "(") === false) {//对象的一般属性
                    $call_method = str_replace("@", "", $argv);
                    if (strpos($call_method, ".") === false) {//单级属性
                        if (!property_exists($obj,  $call_method)) {
                            throw new \Exception("【 $call_method 】不能在这里使用，请检查！");
                        }
                        $ret[] = $obj->$call_method;
                        continue;
                    }

                    //获取多技属性
                    $ret[] = $dot->get($call_method);
                    continue;
                }

                throw new \Exception("执行方法时，暂时不能以函数作为参数【 $argv 】");
                //执行类内部方法
//                $call_method = substr($argv, 1);
//                preg_match('/\((.*?)\)/', $call_method,  $argv_match);
//                if (!isset($argv_match[1])) {
//                    var_dump($argv_match);exit;
//                }
//                $argv_str = str_replace(" ", "", $argv_match[1]);
//                preg_match('/(.*?)\(/', $call_method,  $func_match);
//
//                $funName = $func_match[1];//执行方法名
//                $argv_arr = explode(",", $argv_str);
//                if (method_exists($obj, $funName)) {
//                    if (strpos($argv, "()") === false) {//带参数
//                        $ret[] = call_user_func_array([$obj, $funName], $argv_arr);
//                        continue;
//                    }
//
//                    $ret = call_user_func_array([$obj, $funName], []);
//                    continue;
//                }
            }
        }

        return $ret;
    }
}

