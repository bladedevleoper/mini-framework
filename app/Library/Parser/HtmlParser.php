<?php 

namespace App\Library\Parser;

class HtmlParser 
{
    private $toParse = [
        '{{' => '<?=',
        '}}' => ';?>',
    ];
 
    public function parse($html)
    {
        return strtr($html, $this->toParse);
    }
}