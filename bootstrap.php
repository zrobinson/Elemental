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

/**
 * Elemental Bootstrap base class
 *
 * @example 
 * 	<code>
 * 		e.g. http://servername/index.php?m=blog&o=edit
 *  </code>
 * 
 * @author Zed Robinson <dev@zrobinson.com>
 */
class Elemental_Bootstrap {
	
	/**
	 * Defines the name of the current project
	 *
	 * @var string
	 */
	protected $projectName;
	
	/**
	 * Defines the path to the project's root directory
	 *
	 * @var string
	 */
	protected $projectPath;
	
	/**
	 * Defines the reference name of the requested controller
	 *
	 * @var string
	 */
	protected $controller;
	
	/**
	 * Defines the name of the requested operation
	 *
	 * @var string
	 */
	protected $operation;
	
	/**
	 * Defines the name of the requested model
	 *
	 * @var string
	 */
	protected $model;
	
	/**
	 * Defines the name of the requested view
	 *
	 * @var string
	 */
	protected $view;

	/**
	 * Defines class name of controller 
	 *
	 * @var string
	 */
	protected $controllerClass;
	
	/**
	 * Defines path to controller class file
	 *
	 * @var string
	 */
	protected $controllerPath;
	
	/**
	 * Defines the HTTP request method (e.g. GET, POST, etc.)
	 *
	 * @var string
	 */
	protected $httpMethod;
	
	/**
	 * Defines the raw request input
	 *
	 * @var array
	 */
	protected $request;
	
	/**
	 * Sets up handling of request
	 * 
	 * @param array $request
	 * @param array $project
	 */
	public function __construct($request = array(), $project = array(), $method = 'POST') {
		
		/* set request data */
		$this->request = $request;			
		$this->projectPath = $project['path'];
		$this->projectName = $project['name'];
		$this->httpMethod = (isset($method)) ? $method : 'POST';
			
		/* set routing parameters */
		$this->setParameters();
		
		$this->route();
		
		/* execute associated controller */		
		$this->run();
	}
	
	/**
	 * magic get method used to access protected properties.
	 *
	 * @param string $name
	 * @return mixed
	 */
	public function __get($name) {		
		
		if (property_exists($this, $name)){
			return $this->{$name};
		} else {
			throw new Exception("Property '$name' does not exist.");			
		}
	}
		
	/**
	 * Parses request parameters and loads routing information 
	 */
	protected function setParameters() {
		
		foreach ($this->request as $name => $value) {
			
			switch(strtolower($name)) {				
				/* set controller name */
				case 'c':
				case 'controller':
					$this->controller = $value;
					break;
	
				/* set operation name */
				case 'o':
				case 'operation':
					$this->operation = $value;
					break;
					
				/* set model name */
				case 'm':
				case 'model':
					$this->model = $value;
					break;
								
				/* set view name */				
				case 'v':
				case 'view':								
					$this->view = $value;
					break;					
			}					
		}		
	}
	
	/**
	 * Route request for dispatch
	 */
	protected function route() {
		
		/* set path to controller class file */
		$this->controllerPath = "$this->projectPath/{$this->controller}.php";
		
		/* set name of class file associated with request */
		$this->controllerClass = "{$this->projectName}_".ucfirst($this->controller);
	}
	
	/**
	 * Finds and runs controller associated with the request.
	 */
	protected function run() {
				
		/* instantiate controller with request input */		
		if (file_exists($this->controllerPath)) {
			require_once($this->controllerPath);
			$controller = new $this->controllerClass(
				$this->operation, 
				$this->model, 
				$this->view, 
				$this->httpMethod
			);
			
			/* dispatch request operation */
			$controller->dispatch($this->model, $this->operation);
			
			/* display results */
			$controller->present();
			
		} else {
			throw new Exception('File not found: ' . $controllerPath);
		}
				
	}
}
