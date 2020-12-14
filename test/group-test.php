<?php
/**
 * Created by PhpStorm
 * User: hejinlong
 * Date: 2020/11/26
 * Time: 1:45 PM
 */

require '../vendor/autoload.php';

$json = '{"imgUrl":"http:\/\/ysdm.saasv.com\/pan\/592918\/头部拉框3\/样本原图3\/100\/0_195133.jpg","width":720,"height":576,"marks":[{"type":"rect","pselect":"人头\/容易识别","property":[[{"id":0,"pcode":"39c91c8f","ptitle":"人头","pname":"ren tou","prevcode":"39c91c8f","parentid":"49d72129","angle":false,"is_instance":"undefined","checkIndex":-1},{"id":0,"pcode":"686fb606","ptitle":"容易识别","pname":"0","prevcode":"39c91c8f","parentid":"49d72129","angle":false,"is_instance":"false","checkIndex":-1}]],"isfillOverlay":false,"objectId":0,"points":[{"x":340.1,"y":372.7},{"x":415.1,"y":372.7},{"x":415.1,"y":457.1},{"x":340.1,"y":457.1}],"angle":"","boxId":-1,"markId":"oPe4Ng","point":{"left":340.1,"top":372.7,"right":415.1,"bottom":457.1}}],"printscreen":"","rotateDeg":0,"markStatus":0}';

$ysjson = new \YoushuJson\Model\YsEasyJson();
$ysjson->load($json);

var_dump($ysjson);exit;

$ysjson->mapping = new \YoushuJson\Model\YsMapping([
//    "image_path" => '@getFileName()',
//    "info.a.b.c.width" => '@width',
//    "info.height" => '@height',
    "info.mark" => '@markMapping',
    "test" => function($data) {
        $marks = $data->getAllMarks();
        var_dump($marks);exit;
    }
]);

$ysjson->markMapping = new \YoushuJson\Model\YsMarkMapping([
//    "class" => '@getPropTitle(0,0)',
//    "local" => '@getPropName(0,0)',
    "area" => 0,
//    "points" => '@getAllPoints()',
]);

$myjson = $ysjson->transformat();
var_dump($myjson);
