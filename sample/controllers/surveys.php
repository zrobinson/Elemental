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

require_once 'Elemental/controller.php';

require_once 'models/survey.php';
require_once 'views/surveys.php';

/**
 * Sample Elemental application controller class
 *
 * @author Zed Robinson <dev@zrobinson.com>
 */
class Sample_Controller_Surveys extends Elemental_Controller {

	/**
	 * Defines the controller operation; defaults to 'index'
	 *
	 * @var string
	 */
	public $operation = 'index';

	/**
	 * Defines the model class name
	 *
	 * @var string
	 */
	public $model;

	/**
	 * Defines the view class name
	 *
	 * @var string
	 */
	public $view;

	/**
	 * Defines the data returned by the application model for presentation
	 *
	 * @var mixed
	 */
	public $data = null;

	/**
	 * Defines HTTP request method 
	 *
	 * @var string
	 */
	public $httpMethod;
	
	/**
	 * Routes the request 
	 *
	 * @param string $operation
	 * @param string $model
	 * @param string $view
	 * @param string $method
	 */
	public function __construct($operation = '', $model, $view = '', $httpMethod = '') {
		parent::__construct($operation, $model, $view, $httpMethod);									
	}
		
	/**
	 * Dispatches request for processing
	 *
	 * @param string $model
	 * @param string $operation
	 * @return mixed
	 */
	public function dispatch($model = '', $operation = '') {								
		$model = (!empty($model)) ? 'Sample_Model_'.ucfirst($model) : $this->model;
		parent::dispatch($model, $operation);
	}

	/**
	 * Presents the processed response
	 */
	public function present() {		
		
		$viewClass = 'Sample_View_'.ucfirst($this->view);
		$presenter = new $viewClass($this->data);		
		$presenter->render($this->operation);
	}
}