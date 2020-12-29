<?php

namespace App\Traits;

trait RegexTrait
{
    /**
     * will remove white space between curly braces only
     *
     * @param string $string
     * @return void
     */
    public function removeSpacesBetweenCurlyBraces(string $string): string
    {
        return preg_replace('/\s+(?=[$])|\s+(?=}})/', '', $string);
    }
}
