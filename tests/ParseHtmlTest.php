<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Library\Parser\HtmlParser;

class ParseHtmlTest extends TestCase
{
    /** @test */
    public function can_parse_curley_braces_into_php_tags()
    {
        //Arrange
        $parser = new HtmlParser();
        //Act
        $result = $parser->parse('<h5>{{$hello}}</h5>');
        $expected = '<h5><?=$hello;?></h5>';

        //Assert
        $this->assertEquals($expected, $result);

         //Arrange
         $parser = new HtmlParser();
         //Act
         $result = $parser->parse('<h5>{{ $hello }}</h5>');
         $expected = '<h5><?=$hello;?></h5>';
 
         //Assert
         $this->assertEquals($expected, $result);
    }
}