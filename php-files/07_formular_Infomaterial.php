<html lang="de">
	<meta name="author" content="Dank an Ingo Speckens" charset="UTF-8">
		<head>
			<title>Formular</title>
			<style>
				.error {color: #FF0000;}
			</style>
		</head>
<body>

	<?php
	// define variables and set to empty values
	$name = $strasse = $plz = $ort = $jahreszeit = $anliegen = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  $name = test_input($_POST["name"]);
	  $strasse = test_input($_POST["strasse"]);
	  $plz = test_input($_POST["plz"]);
	  $ort = test_input($_POST["ort"]);
	  $jahreszeit = test_input($_POST["jahreszeit"]);
	  $anliegen = test_input($_POST["anliegen"]);
	}

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	
	$nameErr = $strasseErr = $plzErr = $ortErr = $jahreszeitErr = $anliegenErr = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

	  if (empty($_POST["name"])) {
		$nameErr = "Name is required";
	  } else {
		$name = test_input($_POST["name"]);
	  }

	  if (empty($_POST["strasse"])) {
		$strasseErr = "Strasse is required";
	  } else {
		$strasse = test_input($_POST["strasse"]);
	  }

	  if (empty($_POST["plz"])) {
		$plzErr = "PLZ fehlt";
	  } else {
		$plz = test_input($_POST["plz"]);
	  }

	  if (empty($_POST["ort"])) {
		$ortErr = "Ort is required";
	  } else {
		$ort = test_input($_POST["ort"]);
	  }
	}
	
	?>
	
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	
		<h1>Infomaterial</h1>
	<p>Bitte senden Sie mir Informationsmaterial!</p>
	<table>
		<tr>
			<td>
				<label>Anrede: </label>
			</td>
			<td>
				<select name="anrede">
					<option value="Frau">Frau</option>
					<option value="Herr">Herr</option>
					<option value="Familie" selected>Familie</option>
				</select>
			</td>					
		</tr>
		<tr>
			<td>
				<label>Name:</label>
			</td>	
			<td>
				<input type="text" id="name" name="name" placeholder="Namen eingeben" autofocus>
				<span class="error">* <?php echo $nameErr;?></span>
			</td>		
		</tr>
		<tr>
			<td>
				<label>Strasse:</label>
			</td>	
			<td>
				<input type="text" id="strasse" name="strasse">
				<span class="error">* <?php echo $strasseErr;?></span>
			</td>		
		</tr>
		<tr>
			<td>
				<label>Plz:</label>
			</td>	
			<td>
				<input type="number" name="plz" maxlength="5" size="5" min="00000" max ="99999">
				<span class="error">* <?php echo $plzErr;?></span>
			</td>		
		</tr>
		<tr>
			<td>
				<label>Ort:</label>
			</td>	
			<td>
				<input type="text" id="ort" name="ort">
				<span class="error">* <?php echo $ortErr;?></span>
			</td>		
		</tr>
	</table>



	<p>
		Ich beabsichtige einen Aufenthalt im<br>
		<input type="radio" name="jahreszeit" value="Sommer" id="jahreszeit-sommer"><label for="jahreszeit-sommer">Sommer</label><br>
		<input type="radio" name="jahreszeit" value="Winter" id="jahreszeit-winter"><label for="jahreszeit-winter">Winter</label>
	</p>

	<p>
		Ich habe folgende Wünsche: <br>
		<textarea name="anliegen" placeholder="Meine Mitteilung..." cols="25" rows="5"></textarea>
	</p>

	<p>
		<input type="submit" value="absenden">
		<input type="reset" value="Formular leeren">
	</p>

</form>
	<?php
	$ausgabeFelder = array("Anrede: " => "anrede", "Name: " => "name", "Strasse: " => "strasse", "PLZ: " => "plz", "Ort: " => "ort", "Jahreszeit: " => "jahreszeit", "Anliegen: " => "anliegen");
	
	foreach($ausgabeFelder as $x => $x_value) {
		echo $x . $_POST["$x_value"];
		echo "<br>";
	}
	?>
	

	


</body>
</html>