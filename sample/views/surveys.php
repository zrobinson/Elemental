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

require_once 'Elemental/view.php';

/**
 * Sample Elemental application view class
 *
 * @author Zed Robinson <dev@zrobinson.com>
 */
class Sample_View_Survey extends Elemental_View  {

	/**
	 * Stores data representing output from application domain processing
	 *
	 * @var mixed
	 */
	protected $data;

	/**
	 * Defines the path to the view files
	 *
	 * @var string
	 */
	protected $viewPath;
	
	/**
	 * View template file extension; defaults to PHP
	 *
	 * @var string
	 */
	protected $viewFileExtension = 'php';
	
	/**
	 * Load view with data.  
	 *
	 * @param mixed $data
	 */
	public function __construct($data = null) {
		parent::__construct($data);
		$this->viewPath = realpath(PROJECT_PATH . '/views/surveys');		
	}
	
	/**
	 * Loads data to be presented as output 
	 *
	 * @param string $operation
	 * @return mixed 
	 */
	public function render($operation) {		
		$content = parent::render($operation);				
		if (method_exists($this, $operation)) {
			$content = $this->{$operation}($content);	
		}				
	}
	
	/**
	 * Load data to template for survey input page
	 *
	 * @param string $content
	 * @return string
	 */
	private function add($content) {		
		$question = $this->data['question'];
		$question_answer_options = $this->data['options'];		
		eval($content);
	}
		

	/**
	 * Load data into template for survey results page
	 *
	 * @param string $content
	 * @return string
	 */
	private function create($content) {		
		$question = $this->data['question'];	
		$answer = $this->data['answer'];		
		$results = $this->data['statistics'];		
		eval($content);		
	}
	
}
