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

require_once 'Elemental/bootstrap.php'; 

/**
 * Sample Elemental application Bootstrap class
 *
 * @example 
 * 	<code>
 * 		e.g. http://hostname/index.php?m=blog&o=index
 *  </code>
 * 
 * @author Zed Robinson <dev@zrobinson.com>
 */
class Sample_Bootstrap_Survey extends Elemental_Bootstrap {
	
	/**
	 * Defines the name of the current project
	 *
	 * @var string
	 */
	public $projectName;
	
	/**
	 * Defines the path to the project's root directory
	 *
	 * @var string
	 */
	public $projectPath;
	
	/**
	 * Defines the reference name of the requested controller
	 *
	 * @var string
	 */
	public $controller;
	
	/**
	 * Defines the name of the requested operation
	 *
	 * @var string
	 */
	public $operation;
	
	/**
	 * Defines the name of the requested model
	 *
	 * @var string
	 */
	public $model;
	
	/**
	 * Defines the name of the requested view
	 *
	 * @var string
	 */
	public $view;
		
	/**
	 * Defines the HTTP request method (e.g. GET, POST, etc.)
	 *
	 * @var string
	 */
	public $httpMethod;
	
	/**
	 * Defines the raw request input
	 *
	 * @var array
	 */
	public $request;
	
	/**
	 * Sets up handling of request
	 * 
	 * @param array $request
	 * @param string $projectName
	 * @param string $projectPath
	 */
	public function __construct($request = array(), $projectName, $projectPath, $method) {
		
		/**
		 * Setup default routing handling
		 */
		if (empty($_REQUEST['c']) and empty($_REQUEST['controller'])) {
			$request['c'] = 'surveys'; // set default controller
		}
		if (empty($_REQUEST['m']) and empty($_REQUEST['model'])) {
			$request['m'] = 'survey'; // set default model					
		}
		if (empty($_REQUEST['o']) and empty($_REQUEST['operation'])) {
			$request['o'] = 'add'; // set default operation					
		}				
		
		$project = array(
			'name' => $projectName,
			'path' => $projectPath
		);				
		parent::__construct($request, $project, $method);
	}	
		
	/**
	 * Parses request parameters and loads routing information 
	 */
	protected function setParameters() {
		parent::setParameters();			
	}
	
	/**
	 * Route request for dispatch
	 */
	protected function route() {
				
		/* set path to controller class file */
		$this->controllerPath = "$this->projectPath/controllers/{$this->controller}.php";
		
		/* set name of class file associated with request */
		$this->controllerClass = "{$this->projectName}_Controller_".ucfirst($this->controller);
	}
	
	/**
	 * Finds and runs controller associated with the request.
	 */
	protected function run() {				
		parent::run();				
	}
}
