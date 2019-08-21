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
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Elemental PHP Framework Sample Application</title>
		<LINK REL=StyleSheet HREF="css/sample.css" TITLE="Contemporary" TYPE="text/css">
	</head>
    <body>
	    <p><img src="images/Elemental_logo.png"/></p>
	    <h3>Elemental PHP Framework Sample Application</h3>

	    <p>
	    <b><i><?php echo $question; ?></i></b> Your answer was: <b><u><?php echo $answer; ?></u></b>.
		</p>
		
		<p>Overall Results:</p>
		<p>
		<?php 
			foreach ($results as $result) { 
				echo $result['percentage'] . '% - ' . $result['answer'];
				echo "<br/>";					
			}
		?>
		</p>
		
		<p>
			<a href="http://base1/Elemental/Elemental/sample/public/index.php?c=surveys&m=survey&o=add">
				&lt;&lt; Back to Survey Page
			</a>
		</p>		
    </body>
</html>