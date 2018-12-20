<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoutesTest extends TestCase
{
    /**
     * Test routes for unlogged user
     *
     * @return void
     */
    public function testRoutesUnlogged()
    {

		// Define all routes that user CAN visit
		$routesIndex = ["/", "/categories/nike"];

		// Define all routes that user CAN NOT visit
		$routesCart = ["/cart"];
		$routesAdmin = ['/edit/1', '/admin'];

		$routesHaveAccess = [$routesIndex];
		$routesHaveNotAccess = [$routesCart, $routesAdmin];

		// Check what routes user can access
		foreach ($routesHaveAccess as $routes) {
			foreach ($routes as $route) {
				$response = $this->get($route);
        		$response->assertSuccessful();
        	}
        }

        // Check what routes user can not access
        foreach ($routesHaveNotAccess as $routes) {
			foreach ($routes as $route) {
				$response = $this->get($route);
        		$response->assertStatus(302);
        	}
        }
    }

    /**
     * Test routes for usual user
     *
     * @return void
     */
    public function testRoutesUser()
    {
    	// Auth as usual user
        $user = new User(array('name' => 'User'));
		$this->be($user);

		// Define all routes that user CAN visit
		$routesIndex = ["/", "/categories/nike"];

		// Define all routes that user CAN NOT visit
		$routesCart = ["/cart"];
		$routesAdmin = ['/edit/1', '/admin'];

		$routesHaveAccess = [$routesIndex, $routesCart];
		$routesHaveNotAccess = [$routesAdmin];

		// Check what routes user can access
		foreach ($routesHaveAccess as $routes) {
			foreach ($routes as $route) {
				$response = $this->get($route);
        		$response->assertSuccessful();
        	}
        }

        // Check what routes user can not access
        foreach ($routesHaveNotAccess as $routes) {
			foreach ($routes as $route) {
				$response = $this->get($route);
        		$response->assertStatus(302);
        	}
        }
    }


    /**
     * Test routes for admin
     *
     * @return void
     */
    public function testRoutesAdmin()
    {
    	// Auth as admin
        $admin = new User(array('name' => 'admin', 'admin'=>'1'));
		$this->be($admin);

		// Define all routes that admin CAN visit
		$routesIndex = ["/", "/categories/nike"];
		$routesCart = ["/cart"];
		$routesAdmin = ['/edit/1', '/admin'];

		$routesHaveAccess = [$routesIndex, $routesCart, $routesAdmin];

		// Check what routes admin can access
		foreach ($routesHaveAccess as $routes) {
			foreach ($routes as $route) {
				$response = $this->get($route);
        		$response->assertSuccessful();
        	}
        }
    }
}
