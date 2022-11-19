<?php

namespace app\models\ProductType;

use app\models\Validation;

class Disc extends Validation
{
    public function validateValue()
    {
        if (!$this->data['size']) {
            return "Size was not provided!";
        }

        if (is_numeric($this->data['size']) && floatval($this->data['size'] >= 0)) {
            $this->value = 'Size: ' . $this->data['size'] . ' MB';
            return "";
        }
    }
}
