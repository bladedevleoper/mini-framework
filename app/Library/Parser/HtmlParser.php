<?php 

namespace App\Library\Parser;

use App\Traits\RegexTrait;

class HtmlParser
{
    use RegexTrait;

    private array $toParse = [
        '{{' => '<?=',
        '}}' => ';?>',
    ];

    /**
     * Parses curly brace string an return php tags
     * @param string $html
     * @return string
     */
    public function parse(string $html): string
    {
        return strtr($this->removeSpacesBetweenCurlyBraces($html), $this->toParse);
    }
}