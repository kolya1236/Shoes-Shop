<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CheckRedirectsTest extends TestCase
{
    /**
     * Test routes for unlogged user
     *
     * @return void
     */
    public function testCheckRedirectsUnlogged()
    {

		// Define all routes that user redirected from
		$routesIndex = ["/logout"];
		$routesCart = ['/cart/add/1', '/cart', '/cart/decrement/1', '/cart/remove/1', '/cart/buy'];
		$routesAdmin = ['/admin', '/admin/changeRights/2/1', '/admin/delete/{id}'];

		$routesRedirect = [$routesIndex, $routesCart, $routesAdmin];

		// Check redirects
		foreach ($routesRedirect as $routes) {
			foreach ($routes as $route) {
				$response = $this->get($route);
        		$response->assertRedirect('/login');
        	}
        }
    }
}
