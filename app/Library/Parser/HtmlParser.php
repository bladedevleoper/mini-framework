<?php 

namespace App\Library\Parser;

class HtmlParser 
{
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
        $html = preg_replace('/\s+(?=[$])|\s+(?=}})/', '', $html);
        return strtr($html, $this->toParse);
    }
}