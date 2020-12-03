<?php
/**
 * Created by PhpStorm
 * User: hejinlong
 * Date: 2020/11/26
 * Time: 1:45 PM
 */

require '../vendor/autoload.php';
$mapper = new JsonMapper();

$json = '{"imgUrl":"http:\/\/renwu.cloudin.com\/resource\/heiren_20200116\/3_1571499257699_fov_0_GES_2_expo_8000000_iso_109.jpg?sign=qdmcqJHKx5%2BUZJ1qaa2oxdegwp7Fo2VrZ3GTnpZrsamd05xzY5abk5Zqmm1lZbDN15TGqtTao6Scqp6W&time=1581474624&path=nMugqJfPwpSSZZZnZGJqk03w9BkbIGMe4s5GF%2FBlGfTjTt68YZKakphimZZkZmuVmG6cZ5adanBwl8fV15VllHuripVkwMja0qLFb2NhZJSUZcKe1NWTaGdxj9DRnQ%3D%3D&bucket=youshu","width":640,"height":480,"marks":[{"type":"point","pselect":"\u573a\u666f:\u8857\u9053,\u5149\u7ebf:\u5f3a\u5149,\u6a2a\u7ad6\u5c4f:\u7ad6\u5c4f,\u6027\u522b:\u7537,\u5e74\u9f84:18,\u5934\u90e8\u59ff\u6001:\u4fef\u89c6,\u8ddd\u79bb:20cm\u4ee5\u5185","property":[[{"id":0,"pcode":"qvDfqkIl4bjysEI9axj4GkqIaPOPE8yG","pname":"scene","ptitle":"\u8857\u9053","parentid":"qvDfqkIl4bjysEI9axj4GkqIaPOPE8yG"}],[{"id":1,"pcode":"DAy0x2TLgg3lu0tY4bcFM3LvSXecI7dn","ptitle":"\u5f3a\u5149","pname":"qiang guang","parentid":"AuTxYBDYC82iaXpx8Hv9Llw7o2dBdn7T"}],[{"id":6,"pcode":"Eu0vljRSE2mkKu6Bm3O1Ww6V8KluofY9","ptitle":"\u7ad6\u5c4f","pname":"shu ping","parentid":"dkgSFVAU0GDQmUp6D1q99mWirynC9OGq"}],[{"id":2,"pcode":"Zxtg3ZuGaYrH70vpr8fi0exxGQVMxYjO","ptitle":"\u7537","pname":"nan","parentid":"98IGs4Y8a0y7e6YlhySxf8kDWeHYqSuY"}],[{"id":0,"pcode":"GBYjk2IoMwA0CPX4nlHp8ZjPk9KRDaVt","pname":"age","ptitle":"18","parentid":"GBYjk2IoMwA0CPX4nlHp8ZjPk9KRDaVt"}],[{"id":4,"pcode":"6HHjvHpZ8veNgElp6CUKlUVwFrQJCjle","ptitle":"\u4fef\u89c6","pname":"fu shi","parentid":"FnchtLVOG2FM939FH8fA3Ob3J1fKLkHL"}],[{"id":5,"pcode":"K27abLLlr8ruECcrrLDgqD0VwBUYL3DP","ptitle":"20cm\u4ee5\u5185","pname":"2 0 c m yi nei","parentid":"XoDHFu1mevRlIlqdr3JfRO7hYbSCYPpV"}]],"isfillOverlay":false,"objectId":0,"boxId":-1,"angle":"","point":{"x":"50.0","y":"50.0"}},{"type":"rect","pselect":"\u8138\u5728\u753b\u9762\u6bd4\u5217:1,\u906e\u6321:\u65e0,\u8868\u60c5:\u5fae\u7b11\/\u5e73\u9759,\u4eba\u8138\u671d\u5411:2,\u662f\u5426\u6ce8\u89c6:\u975e\u6ce8\u89c6","property":[[{"id":0,"pcode":"06LeFOqRY4OmylKCU6EnOQkI6j19JlTG","ptitle":"1","pname":"1","parentid":"eEfoKdLOQ4Hjx3B44nuuDIlgKsu5GWhC"}],[{"id":1,"pcode":"nhClvnAiKkrqhhZSDGPjUEPT5Pdgw6qP","ptitle":"\u65e0","pname":"wu","parentid":"kk6tC8sunX6UASgSh8cPKww3ohqUYK9R"}],[{"id":2,"pcode":"vbr4rW75IPQVTYDk6DMDlbPu6PflDT21","ptitle":"\u5fae\u7b11\/\u5e73\u9759","pname":"wei xiao \/ ping jing","parentid":"bCjUwlsTq1RaBd4XUdhMMpcNit9QFhHj"}],[{"id":3,"pcode":"VbNU7WD1e91ljrNo9moZqsgobob2L8R5","ptitle":"2","pname":"2","parentid":"j37aHIum6S9rovnoDSOKhMfFBGmvjcpZ"}],[{"id":4,"pcode":"RX1gDIokxupVCvGSN9bUa1YklhJyYPqd","ptitle":"\u975e\u6ce8\u89c6","pname":"false","parentid":"N12hcuUPUrVwgQn0ngAZNmJuEwEboi6G","angle":false}]],"isfillOverlay":false,"objectId":0,"points":[{"x":105.7,"y":180.2},{"x":314.4,"y":180.2},{"x":314.4,"y":329.2},{"x":105.7,"y":329.2}],"angle":"","boxId":-1,"point":{"left":105.7,"top":180.2,"right":314.4,"bottom":329.2}}],"postils":[],"printscreen":"","rotateDeg":0}';

$json = json_decode($json);

$mapper = new JsonMapper();
$obj = $mapper->map($json, new \YoushuJson\Model\YsJson());

//var_dump($obj->imgUrl);
//var_dump($obj->width);
//var_dump($obj->marks[0]->property[0][0]->pname);
$obj->propAnalyzer();
var_dump($obj->propMap);
