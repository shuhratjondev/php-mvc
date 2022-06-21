<?php
/**
 * User: sh_abdurasulov
 * @package shuhratjon\mvc\form
 */

namespace shuhratjon\mvc\form;


use shuhratjon\mvc\Model;

class Form
{

    public static function begin($action, $method)
    {
        echo sprintf('<form action="%s" method="%s">', $action, $method) . PHP_EOL;
        return new Form();
    }

    public static function end()
    {
        echo '</form>' . PHP_EOL;
    }

    public function field(Model $model, $attribute): InputField
    {
        return new InputField($model, $attribute);
    }

    public function textarea(Model $model, $attribute): TextareaField
    {
        return new TextareaField($model, $attribute);
    }


}