<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Classes\IndexController;

class ControllerTest extends TestCase
{

    /** @test */
    public function a_view_is_returned_from_controller()
    {
        //Act
        $controller = $this->createMock(IndexController::class);

        $controller->method('index')
            ->willReturn('home');
        $this->assertSame('home', $controller->index());
    }    
}
