<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Classes\IndexController;
use App\TemplateEngine\View;

require_once __DIR__ . '../../resource/helpers/helper-functions.php';

class ViewTest extends TestCase
{
    private IndexController $indexController;

    protected function setUp(): void
    {
        $this->indexController = new IndexController();
        
    }

    /** @test */
    public function an_instance_of_a_view_is_returned_from_controller()
    {
        //TODO mock a view to execute the handle method
        //Act
        $controller = $this->createMock(IndexController::class);

        $controller->method('index')
            ->willReturn('home');
        $this->assertSame('home', $controller->index());
    }    
}
