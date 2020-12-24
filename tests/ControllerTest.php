<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Classes\IndexController;

class ControllerTest extends TestCase
{

    /** @test */
    public function a_view_is_returned_from_controller()
    {
        //Arrange
        $controller = $this->createMock(IndexController::class);
        
        //Act
        $controller->method('index')
            ->willReturn('home');

        //Assert
        $this->assertSame('home', $controller->index());
    }    
}
