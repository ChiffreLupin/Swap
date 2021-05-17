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

    public string $type;
    public Model $model;
    public string $attribute;

    public function __construct(Model $model, $attribute){
        $this->type = self::TYPE_TEXT;
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function __toString() {
        return sprintf('
        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right">%s</label>
            <div class="col-md-6">
                <input type="%s"  value="%s" class="form-control%s" name="%s">
                <div class="invalid-feedback">
                    %s
                </div>
            </div>
           
        </div>
        ', $this->attribute,
        $this->type,
        $this->model->{$this->attribute},
        $this->model->hasError($this->attribute) ? ' is-invalid':'', 
        $this->attribute,
        $this->model->getFirstError($this->attribute));
    }

    public function passwordField() {
        $this->type = self::TYPE_PASS;
        return $this;
    }
}