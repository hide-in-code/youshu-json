<?php
/**
 * Created by PhpStorm
 * User: hejinlong
 * Date: 2020/11/26
 * Time: 1:45 PM
 */

require '../vendor/autoload.php';


$array['info']['home']['address'] = 'Kings Square';

echo $array['info']['home']['address'] . PHP_EOL;

$a = [];
$dot = new \Adbar\Dot($a);
echo $dot->set('info.home.address', "aaa");
echo $dot->get('info.home.address');

var_dump($dot->toJson());
