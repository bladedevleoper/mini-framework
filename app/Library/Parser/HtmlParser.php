<?php 

namespace App\Library\Parser;

use App\Traits\RegexTrait;

class HtmlParser
{
    use RegexTrait;

    private $toParse = [
        '{{' => '<?=',
        '}}' => ';?>',
    ];

    /**
     * Parses curly brace string an return php tags
     * @param $html
     * @return string
     */
    public function parse($html): string
    {
        return strtr($this->removeSpacesBetweenCurlyBraces($html), $this->toParse);
    }
}