<?php


namespace App\controllers;

use Helpers;
use Mobile_Detect;

class Controller
{
    private $detect;

    public function __construct(Mobile_Detect $detect)
    {
        $this->detect = $detect;

        if ($this->detect->isMobile() || $this->detect->isTablet()) {
            Helpers::abort("MobileTable");
        }
    }

}