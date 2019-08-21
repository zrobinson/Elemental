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
 * Elemental base view (i.e. presentation) class
 *
 * @author Zed Robinson <dev@zrobinson.com>
 */

class Elemental_View {

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
		
		$this->data = $data;
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
	 * Loads data to be presented as output 
	 *
	 * @param string $operation
	 * @return mixed 
	 */
	public function render($operation) {
				
		/* view file in format: /path/to/views/index.php */
		$viewFile = $this->viewPath . '/' . $operation . '.' . $this->viewFileExtension;										
		if (file_exists($viewFile)) {			
			$contents = file_get_contents($viewFile);	
		}								
		return $contents;
	}
}