<?php

namespace Tests;

require_once __DIR__ . '/../resource/helpers/helper-functions.php';
use PHPUnit\Framework\TestCase;
use App\Classes\IndexController;
use DOMDocument;
use DOMNode;

class ControllerTest extends TestCase
{

    /** @test */
    public function a_view_is_returned_from_controller()
    {
        //Arrange
        $controller = new IndexController();
        //Act
        $html = $controller->index();
        //Assert
        $this->assertInstanceOf('App\TemplateEngine\View', $html);
    }    
}

