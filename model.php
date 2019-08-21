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
 * Elemental base model class
 *
 * @author Zed Robinson <dev@zrobinson.com>
 */
class Elemental_Model {

	/**
	 * Stores any user input
	 *
	 * @var array
	 */
	protected $input;
	
	/**
	 * Contructor loads user input
	 */
	public function __construct($request = array()) {
		$this->input = $request;		
	}

	/**
	 * Magic callback stub method.
	 *
	 * @param string $method
	 * @param mixed $args
	 */
	public function __call($method, $args) {}
	
}