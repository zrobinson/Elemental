<?php
/*
This file is part of Elemental.

Elemental is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

Elemental is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Elemental.  If not, see <http://www.gnu.org/licenses/>.
*/

require_once 'PHPUnit/Framework/TestCase.php';

require ("../controller.php");
require ("../model.php");
require ("../view.php");

/**
 *  test class to test Elemental base controller
 */
class TestController extends PHPUnit_Framework_TestCase {
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		// TODO Auto-generated constructor
	}

	/**
	 * Tests controller routing and dispatching
	 */
	public function testDispatch() {

		$operation = 'index';
		$model = 'Elemental_Model';
		$view = 'Elemental_View';
		$httpMethod = 'POST';
		
		$controller = new Elemental_Controller($operation, $model, $view, $httpMethod);		
		$data = $controller->dispatch();

		$this->assertEquals($controller->operation, $operation);
		$this->assertEquals($controller->model, $model);
		$this->assertEquals($controller->view, $view);
		$this->assertEquals($controller->httpMethod, $httpMethod);
		$this->assertNull($data);				
	}
	
	/**
	 * Tests presentation of view
	 */
	public function testPresent() {

		$operation = 'index';
		$model = 'Elemental_Model';
		$view = 'Elemental_View';
		$httpMethod = 'POST';
		
		$controller = new Elemental_Controller($operation, $model, $view, $httpMethod);		
		$data = $controller->dispatch();
		$presentation = $controller->present();		
	}
	
}

