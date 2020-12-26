<?php 

namespace App\Library\Parser;

class HtmlParser 
{
    private $toParse = [
        '{{' => '<?=',
        '}}' => ';?>',
        ' ' => '',
    ];

    
    public function parse($html)
    {
        $parsed = strtr($html, $this->toParse);

        return $parsed;
    }
}