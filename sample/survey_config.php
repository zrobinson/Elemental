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
 * Global configuration settings for sample Elemental application
 */
define('FRAMEWORK_PATH', realpath("../../.."));
define('PROJECT_PATH', realpath(".."));
define('PROJECT_NAME', 'Sample');

set_include_path(get_include_path().PATH_SEPARATOR.FRAMEWORK_PATH.PATH_SEPARATOR.PROJECT_PATH);


/**
 * MySQL Database connection settings
 */

/* Database username */
$DB_USERNAME = 'architec';

/* Database password */
$DB_PASSWORD = 'nik0time';

/* Database host name */
$DB_HOST = 'localhost';

/* Database name */
$DB_DATABASE = 'Sample_Elemental_App';


define('DB_HOST', $DB_HOST);
define('DB_DATABASE', $DB_DATABASE);
define('DB_USERNAME', $DB_USERNAME);
define('DB_PASSWORD', $DB_PASSWORD);