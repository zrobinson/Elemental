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
 * Elemental base controller class
 *
 * @author Zed Robinson <dev@zrobinson.com>
 */
class Elemental_Controller {

	/**
	 * Defines the controller operation
	 *
	 * @var string
	 */
	protected $operation = 'index';

	/**
	 * Defines the model class name
	 *
	 * @var string
	 */
	protected $model;

	/**
	 * Defines the view class name
	 *
	 * @var string
	 */
	protected $view;

	/**
	 * Stores request input
	 *
	 * @var array
	 */
	protected $request;
	
	/**
	 * Defines the data returned by the application model for presentation
	 *
	 * @var mixed
	 */
	protected $data = null;

	/**
	 * Defines HTTP request method 
	 *
	 * @var string
	 */
	protected $httpMethod;
	
	/**
	 * Routes the request 
	 *
	 * @param string $operation
	 * @param string $model
	 * @param string $view
	 * @param string $method
	 */
	public function __construct($operation = '', $model, $view, $httpMethod = '') {
		
		if (!empty($operation)) {
			$this->operation = $operation;
		}
		$this->model = $model;
		$this->view = (empty($view)) ? $this->model : $view;;
		
		if (!empty($httpMethod)) {
			$this->httpMethod = $httpMethod;
		}
		
		/* Load raw user input data */
		if (strcasecmp($this->httpMethod,'POST')==0) {
			$this->request = $_POST;			
		} else {
			$this->request = $_GET;
		}
		
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
	 * Dispatches request for processing
	 *
	 * @param string $model
	 * @param string $operation
	 * @return mixed
	 */
	public function dispatch($model = '', $operation = '') {
		
		if (!empty($model)) {
			$modelClass = $model;
		} else {
			$modelClass = $this->model;
		}

		if (empty($operation)) {
			$operation = $this->operation;
		}

		$model = new $modelClass($this->request);
		$this->data = $model->$operation();

		return $this->data;
	}

	/**
	 * Presents the processed response
	 *
	 * @param mixed $data
	 */
	public function present($data = null) {
		
		$viewClass = $this->view;
		$presenter = new $viewClass($data);		
		$presenter->render($this->operation);
	}
}