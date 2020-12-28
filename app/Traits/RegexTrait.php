<?php

namespace App\Traits;

trait RegexTrait
{
    public function removeSpacesBetweenCurlyBraces($string)
    {
        return preg_replace('/\s+(?=[$])|\s+(?=}})/', '', $string);
    }
}