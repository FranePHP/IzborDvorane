<?php

$mysqli = new mysqli("localhost", "test", "", "test");
$result = $mysqli->query("SELECT * FROM dvorane");

?>

<form method="POST">
Naziv dvorane: <input type="text" name="ime" />
<br/>
Broj mjesta: <input type="text" name="broj_mjesta" />
<br/>
<input type="submit" value="Submit" />
</form>

<?php

if (isset($_POST["ime"]) || isset($_POST["broj_mjesta"])) {

	$incorrect = 0;


	if (!isset($_POST["ime"]) || !ctype_alnum($_POST["ime"]) || strlen($_POST["ime"]) > 5) {
		echo "Polje Naziv dvorane je obvezno, mora sadržavati samo slova i brojeve i ne smije biti dulje od 5 znakova<br/>";
		$incorrect = 1;
	}

	if (!isset($_POST["broj_mjesta"]) || !ctype_digit($_POST["broj_mjesta"])) {
		echo "Polje Broj mjesta mora biti isključivo broj<br/>";
		$incorrect = 1;
	}

	if ($incorrect) {
		exit(1);
	}

	$result = $mysqli->query("INSERT INTO dvorane (ime, broj_mjesta) VALUES (
		'". $_POST["ime"] ."',
		'". $_POST["broj_mjesta"] ."'
	)");

	if ($result) {
	    header("Refresh: 0");
	} else {
	    echo "Greska: " . $mysqli->error;
	}
}

?>