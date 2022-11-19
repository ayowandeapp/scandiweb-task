<?php

namespace app\models\ProductType;

use app\models\Validation;

class Book extends Validation
{
    public function validateValue()
    {
        if (!$this->data['weight']) {
            return "Weight was not provided!";
        }

        if (is_numeric($this->data['weight']) && floatval($this->data['weight'] >= 0)) {
            $this->value = 'Weight: ' . $this->data['weight'] . ' KG';
            return "";
        }
    }
}
