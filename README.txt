------
README
------

GENERAL INFORMATION ABOUT ELEMENTAL

Elemental is a PHP Framework. It is an experimental, minimalistic and lightweight 
MVC-based application framework suitable for creating simple web applications. 
Elemental should appeal to those who seek a bare-bones framework, prefering to 
apply complexity on their own terms. Elemental provides no database abstraction
layer, no validation or session handling, and no view templating system (other 
than PHP itself). Elemental is a good way to learn how MVC works at its most
Elemental level.


AUTHOR
Zed Robinson <dev@zrobinson.com>. Zed developed this framework for fun.


INSTALLATION
For a quick setup, follow the instructions in "/Elemental/sample/INSTALL.txt".
The instructions there provide guidance on how to setup the sample application.

To install Elemental, copy the directory containing the framework source code 
to your web server so that it can be referenced from your scripts. Ensure that 
permissions are correctly setup as any other web script. Also, ensure that
the Elemental framework source code is not accessable from the public web root. 
Elemental can be bootstrapped from any php file found in the public web host 
document root.

As Elemental is a PHP 5 based application framework, it requires PHP 5 to be 
installed on the host environment.


CONFIGURATION
To use Elemental, you must create new classes that inherit from the base 
framework classes. The sample application found in the "sample" directory provides
an example of how this may be done. However, this is meant as an easy starting
point. There is no right way to use Elemental. It is designed so that you may 
easily tweak it to your liking.

Generally, you will want to create a bootstrap file which will instantiate a 
bootstrap class and load any configuration options (e.g. to setup global variable
and database settings).

A typical setup will look like the following in your file system:

Elemental/
    bootstrap.php
    controller.php
    model.php
    view.php
MyApp/
    controllers/
        myapp_controller_a.php  [extends Elemental/controller.php]
        myapp_controller_b.php
        ...
    models/
        myapp_model_a.php   [extends Elemental/model.php]
        myapp_model_b.php
        ...    
    views/    
        operation_a.php   [extends Elemental/view.php]
        operation_b.php
        ...
    bootstrap.php   [extends Elemental/bootstrap.php]
    config.php
    public_html/
        index.php   [loads bootstrap and config]
    
    
LICENSE

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