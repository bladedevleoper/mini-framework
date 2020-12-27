<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Library\Parser\HtmlParser;
/**
 * @group htmlParser
 */
class ParseHtmlTest extends TestCase
{
    private $pasrser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->parser = new HtmlParser();
    }

    /** @test */
    public function can_parse_curley_braces_into_php_tags()
    {
        //Act
        $result = $this->parser->parse('<h5>{{ $hello }} Test String</h5>');
        $expected = '<h5><?= $hello ;?> Test String</h5>';
        
        //Assert
        $this->assertEquals($expected, $result);
    }
}