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

require ("../bootstrap.php");
require ("../controller.php");
require ("../model.php");
require ("../view.php");

/**
 * Test class to test bootstrap
 */
class TestBootstrap extends PHPUnit_Framework_TestCase {
	
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
	 * Tests bootstrap intitialization .
	 */
	public function testSetParameters() {
		
		$request = array(
			'controller' => 'controller',
			'model' => 'Elemental_Model',
			'view' => 'Elemental_View',
			'operation' => 'index'
		);

		$project = array(
			'name' => 'Elemental',
			'path' => dirname(getcwd()),
		);
		
		try {
			$bootstrap = new Elemental_Bootstrap($request, $project);			
		} catch (Exception $e) {
			$this->fail($e->getMessage());			
		}			
		
		$this->assertTrue($bootstrap instanceof Elemental_Bootstrap);
		$this->assertEquals($request['controller'], $bootstrap->controller);
		$this->assertEquals($request['model'], $bootstrap->model);
		$this->assertEquals($request['view'], $bootstrap->view);
		$this->assertEquals($request['operation'], $bootstrap->operation);
	}	
	
	
	/**
	 * Tests bootstrap intitialization using short-form parameters.
	 */
	public function testSetParametersUsingShortForm() {
		
		$request = array(
			'c' => 'controller',
			'm' => 'Elemental_Model',
			'v' => 'Elemental_View',
			'o' => 'operation'
		);

		$project = array(
			'name' => 'Elemental',
			'path' => dirname(getcwd()),
		);
		
		try {
			$bootstrap = new Elemental_Bootstrap($request, $project);			
		} catch (Exception $e) {
			$this->fail($e->getMessage());			
		}			
		
		$this->assertTrue($bootstrap instanceof Elemental_Bootstrap);
		$this->assertEquals($request['c'], $bootstrap->controller);
		$this->assertEquals($request['m'], $bootstrap->model);
		$this->assertEquals($request['v'], $bootstrap->view);
		$this->assertEquals($request['o'], $bootstrap->operation);						
	}
		
	/**
	 * Tests that the HTTP method is set correctly
	 */
	public function testSetHTTPMethod() {
		$request = array(
			'c' => 'controller',
			'm' => 'Elemental_Model',
			'v' => 'Elemental_View',
			'o' => 'operation'
		);

		$project = array(
			'name' => 'Elemental',
			'path' => dirname(getcwd()),
		);
		
		/* test for default POST condition */
		try {
			$bootstrap = new Elemental_Bootstrap($request, $project);			
		} catch (Exception $e) {
			$this->fail($e->getMessage());			
		}					
		$this->assertEquals('POST', $bootstrap->httpMethod);		
		
		/* test for GET condition */
		try {
			$bootstrap = new Elemental_Bootstrap($request, $project, 'GET');			
		} catch (Exception $e) {
			$this->fail($e->getMessage());			
		}					
		$this->assertEquals('GET', $bootstrap->httpMethod);

		/* negative test */
		try {
			$bootstrap = new Elemental_Bootstrap($request, $project);			
		} catch (Exception $e) {
			$this->fail($e->getMessage());			
		}					
		$this->assertNotEquals('GET', $bootstrap->httpMethod);		
	}
	
	/**
	 * Test that the project parameters are set correctly
	 */
	public function testSetProjectParameters() {
		
		$request = array(
			'c' => 'controller',
			'm' => 'Elemental_Model',
			'v' => 'Elemental_View',
			'o' => 'operation'
		);		
		
		$project = array(
			'name' => 'Elemental',
			'path' => dirname(getcwd()),
		);
				
		try {
			$bootstrap = new Elemental_Bootstrap($request, $project);			
		} catch (Exception $e) {
			$this->fail($e->getMessage());			
		}
		
		/* test for project name */					
		$this->assertEquals($project['name'], $bootstrap->projectName);

		/* test for project path */					
		$this->assertEquals($project['path'], $bootstrap->projectPath);
		
		
	}
	
}
