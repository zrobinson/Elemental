<?php
/*
This file is part of Elemental PHP Framework.

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

/* global configuration */
require_once "../survey_config.php";

/* instantiate bootstrap */
require_once "bootstrap.php";
$bootstrap = new Sample_Bootstrap_Survey($_REQUEST, PROJECT_NAME, PROJECT_PATH, $_SERVER['REQUEST_METHOD']);

