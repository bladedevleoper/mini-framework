<?php

namespace Tests;

use App\Router\Router;
use PHPUnit\Framework\TestCase;

class RouteTest extends TestCase
{

    private Router $router;

    //Arrange
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->router = new Router();

        Router::addGet('/', 'ShoppingListController@index');

    }

    /** @test */
    public function can_populate_get_routes()
    {
        //Act
        $result = $this->router->getAllRoutes()['get'];
        $expected = 1;

        //Assertion
        $this->assertEquals($expected, count($result));
        

    
    }

    /** @test */
    public function can_access_get_routes()
    {

        var_dump($this->router);

        //$this->assertEquals(1, 2);
    }
}
