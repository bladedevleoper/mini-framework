<?php

namespace Tests;

require_once __DIR__ . '/../resource/helpers/helper-functions.php';

use PHPUnit\Framework\TestCase;
use App\Classes\IndexController;
use App\TemplateEngine\View;
use App\Exceptions\ViewException;
use DOMDocument;

class ViewTest extends TestCase
{

    /** test */
    public function a_string_is_returned_from_view()
    {
        //TODO look at this test again
        //Arrange
        $controller = new IndexController();
        //TODO:- this still outputs the html
        $view = $controller->index();
        
        //$this->assertIsString($view);
        //$this->assertInstanceOf(View::class, $view);
        //$this->assertStringContainsString('<h1>{$name}</h1>', $view);
       // var_dump($view);
        //$this->
        //var_dump($view);
        //Assert
        //$this->assertInstanceOf('App\TemplateEngine\View', $view);
        
        //$this->assertEquals(true, is_string($view));
    }
    
    /** @test */
    public function an_exception_is_thrown_if_view_does_not_exist()
    {
        //Arrange
        $view = new View('test', []);
    
        //Assert
        $this->expectException(ViewException::class);
        $this->expectExceptionMessage('View Cannot be found');
        $this->expectExceptionCode(404);

        //Act
        $view->doesFileExist();

        
    }


}

