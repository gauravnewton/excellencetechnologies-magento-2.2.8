<?php

namespace Excellence\Hello\Model;

class Product{
    public function afterGetName(\Magento\Catalog\Model\Product $subject, $result)
    {
    return "ExcellenceTest ". $result;
    }
}