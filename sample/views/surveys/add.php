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
	<LINK REL=StyleSheet HREF="css/sample.css" TITLE="sample" TYPE="text/css">
</head>
    <body>
	    <p><img src="images/Elemental_logo.png"/></p>
	    <h3>Elemental PHP Framework Sample Application</h3>

	    <p>
	    	<b><i><?php echo $question; ?></i></b>
	    </p>
	    
	    <form name="sample_survey_form" action="index.php" method="post">
	    	<input type="hidden" name="c" value="surveys" />
	    	<input type="hidden" name="m" value="survey" />
	    	<input type="hidden" name="o" value="create" />
	    	<p>
		    <?php
				foreach ($question_answer_options as $id => $option) {
					echo "<input type=\"radio\" name=\"answer_option\" value=\"$id\" />";
					echo $option;
					echo "<br/>";
				}		
			?>	
			</p>		
			<p><input type="submit" name="survey_submission" value="Submit" onclick="return validate(document.getElementsByName('answer_option'))" /></p>
		</form>
		
    </body>
</html>

<script type="text/javascript">
	function validate(obj) {
		for(var x=0;x<obj.length;x++) {		
			if (obj[x].checked == true) { return true; }
		}	
		alert("Please select one of the options");	
		return false;
	}
</script>