<?php
/**
    Class Field
    @package app\core\form
 */

namespace app\core\form;
use app\core\Model;

class Field{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASS = 'password';
    public const TYPE_NUMBER = 'number';
    public const TYPE_EMAIL = 'email';


    public string $type;
    public Model $model;
    public string $attribute;
    public string $style;
    public string $class;


    public function __construct(Model $model, $attribute,string $style, string $class){
        $this->type = self::TYPE_TEXT;
        $this->model = $model;
        $this->attribute = $attribute;
        $this->style = $style;
        $this->class = $class;
    }

    public function __toString() {
        return sprintf('
            <div class="col-md-6 %s">
                <input placeholder="%s" type="%s"  value="%s" class="form-control%s" name="%s" style="%s">
                <div class="invalid-feedback">
                    %s
                </div>
            </div>
        ', $this->class,
        $this->model->labels()[$this->attribute] ?? $this->attribute,
        $this->type,
        $this->model->{$this->attribute},
        $this->model->hasError($this->attribute) ? ' is-invalid':'', 
        $this->attribute,
        $this->style,
        $this->model->getFirstError($this->attribute));
    }

    public function password() {
        $this->type = self::TYPE_PASS;
        return $this;
    }

    public function email() {
        $this->type = self::TYPE_EMAIL;
        return $this;
    }
}