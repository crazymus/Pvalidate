<?php namespace Crazymus\Rule;

use Crazymus\PvalidateException;

class BaseRule
{
    protected $title = null;

    protected $required = false;

    protected $errorMsg = null;

    protected $enum = array();

    public function __construct($config = null)
    {
        if (!empty($config)) {
            foreach ($config as $property => $value) {
                $this->{$property} = $value;
            }
        }
    }

    public function validate($value)
    {
        if ($this->required && $value === '') {
            throw new PvalidateException($this->renderErrorMsg('不能为空'));
        }

        if (!empty($this->enum)) {
            if (!in_array($value, $this->enum)) {
                throw new PvalidateException($this->renderErrorMsg('类型错误'));
            }
        }
    }

    public function renderErrorMsg($msg)
    {
        if ($this->errorMsg) {
            return $this->errorMsg;
        }

        return $this->title . $msg;
    }
}
