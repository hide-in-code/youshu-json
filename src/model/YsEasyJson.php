<?php
/**
 * Created by PhpStorm
 * User: hejinlong
 * Date: 2020/12/4
 * Time: 9:44 AM
 */

namespace YoushuJson\Model;

use Adbar\Dot;
use YoushuJson\Components\Analyzer;

/**
 * Class YsEasyJson
 * @package YoushuJson\Model
 * 解决图片信息 + 多个标注内容的json类型
 */

class YsEasyJson extends YsJson
{
    /**
     * @var \YoushuJson\Model\YsMapping
     */
    public $mapping;

    /**
     * @var \YoushuJson\Model\YsMarkMapping
     */
    public $markMapping;

    public $YsEasyArray = [];

    public function transformat()
    {
        if (!$this->mapping) {
            throw new \Exception("未设置 mapping");
        }

        $ret = [];
        $retDot = new Dot($ret);
        foreach ($this->mapping as $key => $value) {
            if ($key == "marks_filed") {
                continue;
            }
            $retDot->set($key, Analyzer::mappingAnalyzeGetVal($this, $value));
        }

        $marks = [];
        foreach ($this->getAllMarks() as $mark) {
            $tmpDot = new Dot([]);
            foreach ($this->markMapping as $key => $value) {
                $tmpDot->set($key, Analyzer::mappingAnalyzeGetVal($mark, $value));
            }

            $marks[] = $tmpDot->jsonSerialize();
        }

        $retDot->set($this->mapping->marks_filed, $marks);
        return $retDot->toJson(null, [JSON_UNESCAPED_UNICODE]);
    }

    public function load($json)
    {
        parent::load($json);
        $this->YsEasyArray = json_decode($json, true);
    }
}

class YsMapping extends \stdClass
{
    public $marks_filed = "";

    public function __construct($config = [])
    {
        if (!is_array($config)) {
            throw new \Exception("YsMapping 必须是一个数组!");
        }

        foreach ($config as $item => $value) {
            if ($value == '@markMapping') {
                $this->marks_filed = $item;
                continue;
            }
            $this->$item = $value;
        }

        if ($this->marks_filed == "") {
            throw new \Exception("YsMapping 必须设置一个用于存储所有标注结果的字段：markMapping");
        }
    }
}

class YsMarkMapping extends \stdClass
{
    public function __construct($config = [])
    {
        foreach ($config as $item => $value) {
            $this->$item = $value;
        }
    }
}

