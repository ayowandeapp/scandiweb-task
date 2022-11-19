<?php

namespace app\models\ProductType;

use app\models\Validation;

class Furniture extends Validation
{
    public function validateValue()
    {
        if (!$this->data['height'] || !$this->data['width'] || !$this->data['length']) {
            return "One or more of dimensions were not provided!";
        }

        if (is_numeric($this->data['height']) && is_numeric($this->data['width']) && is_numeric($this->data['length'])) 
        {
            $this->value = 'Dimensions: ' . $this->data['height'] . ' x ' . $this->data['width'] . ' x ' . $this->data['length'] . ' CM';
            return "";
        }
    }
}
