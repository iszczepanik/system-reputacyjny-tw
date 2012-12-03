<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-us" lang="en-us">
<head>
	<title>Star Rating widget Demo2 Page</title>
	

	<!-- demo page js -->
	<script type="text/javascript" src="jquery.min.js?v=1.5.1"></script>
	<script type="text/javascript" src="jquery-ui.custom.min.js?v=1.8.13"></script>
	<script type="text/javascript" src="jquery.uni-form.js?v=1.3"></script>
	
	<!-- Star Rating widget stuff here... -->
	<script type="text/javascript" src="jquery.ui.stars_1.js?v=3.0.1b44"></script>
	<link rel="stylesheet" type="text/css" href="jquery.ui.stars_1.css?v=3.0.1b44"/>

	
<script type="text/javascript">
		$(function(){
			$("#starify").children().not(":input").hide();
			
			// Create stars from :radio boxes
			$("#starify").stars({
				cancelShow: false
			});
		});
	</script>

</head>

<body>
<?
var_dump($_POST);
echo $_POST["name"]."<br />";
echo $_POST["starify"]."<br />";
?>

<form class="uniForm" action="test.php" method="post">

		<fieldset class="inlineLabels">

			<legend>
				Contact form (<a href="demo3a.html?b44" class="">before</a>|<a href="demo3b.html?b44" class="unlink">after1</a>|<a href="demo3c.html?b44" class="">after2</a>|<a href="demo3d.html?b44" class="">after3</a>)
			</legend>

			<div class="ctrlHolder">
				<label for="name"><em>*</em> Your Name</label>
				<input name="name" id="name" value="John Doe" type="text" class="textInput" />
			</div>

			<div class="ctrlHolder">
				<label for="email"><em>*</em> Email address</label>

				<input name="email" id="email" value="email@example.com" type="text" class="textInput" />
			</div>

			<div class="ctrlHolder">
				<label for="message"><em>*</em> Your Message</label>
				<textarea name="message" id="message">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</textarea>
			</div>

			<div class="ctrlHolder">
			<p class="label"><em>*</em> Rate this</p>
				<div class="multiField" id="starify">
					<label for="vote1" class="blockLabel"><input type="radio" name="vote" id="vote1" value="1" /> Poor</label>
					<label for="vote2" class="blockLabel"><input type="radio" name="vote" id="vote2" value="2" /> Fair</label>

					<label for="vote3" class="blockLabel"><input type="radio" name="vote" id="vote3" value="3" checked="checked" /> Average</label>
					<label for="vote4" class="blockLabel"><input type="radio" name="vote" id="vote4" value="4" /> Good</label>
					<label for="vote5" class="blockLabel"><input type="radio" name="vote" id="vote5" value="5" /> Excellent</label>
				</div>
			</div>

			<div class="buttonHolder">
				<a href="#" class="resetButton" onclick="document.forms[0].reset()">Reset</a>
				<button type="submit" class="primaryAction">Submit</button>
			</div>

		</fieldset>
		
	</form>






</body>
</html>
