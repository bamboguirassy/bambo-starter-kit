<?php

namespace App\Custom;

class BreadcrumbItem
{
    public $label;
    public $link;

    public function __construct($label, $link = null)
    {
        $this->label = $label;
        $this->link = $link;
    }
}
