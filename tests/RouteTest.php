<?php

namespace Tests;

use App\Http\Request\Request;
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
        Router::addPost('/save-shopping', 'SomeController@store');

    }

    /**
     *  @test
    */
    public function can_populate_routes()
    {
    
        //Act
        $result = count($this->router->getAllRoutes()['get']);
        $expected = 1;
        //Assert
        $this->assertEquals($expected, $result);


        //Act
        $result = count($this->router->getAllRoutes()['post']);
        $expected = 1;
        //Assert
        $this->assertEquals($expected, $result);
        
    }

    /** @test  */
    public function exception_is_thrown_if_route_does_not_exist()
    {   
        //Arrange
        $request = new Request();
        $request->request['uri'] = '/shopping-cart/does-not-exist';
        $request->currentRequest();
        
        //Act and Assert
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Route Does Not Exist');
        $this->router->routeExist($request);
    }
}
