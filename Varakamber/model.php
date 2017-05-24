<?php

function connect_db() {
	global $connection;
	$host = "localhost";
	$user = "test";
	$pass = "t3st3r123";
	$db = "test";
	$connection = mysqli_connect($host, $user, $pass, $db) or die("Ei saa ühendust andmebaasiga: " . mysqli_error());
	mysqli_query($connection, "SET CHARACTER SET UTF8") or die("Ei saanud baasi UTF-8-sse: " . mysqli_error($connection));
}

function register() {
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		global $connection;

		$errors = array();

		if (empty(trim($_POST['name']))) {
			$errors[] = "Nimi on puudu.";
		}

		if (empty(trim($_POST['email']))) {
			$errors[] = "E-posti aadress on puudu.";
		}

		if (empty(trim($_POST['password1']))) {
			$errors[] = "Salasõna on puudu.";
		}

		if (strlen(trim($_POST['password1'])) < 8) {
			$errors[] = "Salasõna peab koosnema vähemalt 8 tähemärgist.";
		}

		if (empty(trim($_POST['password2']))) {
			$errors[] = "Salasõna kordus on puudu.";
		}

		if ($_POST['password1'] != $_POST['password2']) {
			$errors[] = "Salasõnad ei ole ühesugused.";
		}

		$users_email = mysqli_real_escape_string($connection, htmlspecialchars($_POST["email"]));

		$query = mysqli_query($connection, "SELECT count(*) AS ridade_arv FROM 10153154_kylastajad WHERE email='$users_email'") or die("Ei õnnestu e-posti aadressi kontrollida.");
		$row = mysqli_fetch_assoc($query);

		if ($row['ridade_arv'] > 0) {
			$errors[] = "Selle e-posti aadressiga on juba registreeritud kasutaja.";
		}

		if (empty($errors)) {

			$users_name = mysqli_real_escape_string($connection, htmlspecialchars($_POST['name']));
			$users_email = mysqli_real_escape_string($connection, htmlspecialchars($_POST['email']));
			$users_password = mysqli_real_escape_string($connection, htmlspecialchars($_POST['password1']));

			$result = mysqli_query($connection, "INSERT INTO 10153154_kylastajad (username, email, passw) VALUES ('$users_name', '$users_email', SHA1('$users_password'))") or die("Ei õnnestu kasutajat luua.");
			$rows = mysqli_affected_rows($connection);

			if ($rows > 0) {
				$_SESSION['user'] = $users_name;

				$query = mysqli_query($connection, "SELECT id AS session_id FROM 10153154_kylastajad WHERE email='$users_email'");
				$result = mysqli_fetch_assoc($query);
			
				$_SESSION['user_id'] = $result['session_id'];

			}
		}
		else {
			return $errors;
		}
	}
}

function login() {
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		global $connection;

		$errors = array();
		
		$users_email = mysqli_real_escape_string($connection, trim(htmlspecialchars($_POST['login_email'])));
		$users_password = mysqli_real_escape_string($connection, trim(htmlspecialchars($_POST['login_password'])));

		$query = mysqli_query($connection, "SELECT count(*) AS ridade_arv FROM 10153154_kylastajad WHERE email='$users_email' AND passw=SHA1('$users_password')") or die("Ei õnnestu kindlaks teha sellise e-posti aadressi ja salasõnaga kasutajat.");
		$row = mysqli_fetch_assoc($query);

		if ($row['ridade_arv'] != 1) {
			$errors[] = "Sisselogimine ebaõnnestus.";
		}

		if (empty(trim(htmlspecialchars($_POST['login_email'])))) {
			$errors[] = "E-posti aadress on puudu.";
		}

		if (empty(trim(htmlspecialchars($_POST['login_password'])))) {
			$errors[] = "Salasõna on puudu.";
		}

		if (empty($errors)) {
			
			$query = mysqli_query($connection, "SELECT username AS session_name FROM 10153154_kylastajad WHERE email='$users_email'") or die("Ei saanud kasutaja nime.");
			$result = mysqli_fetch_assoc($query);

			$_SESSION['user'] = $result['session_name'];

			$query = mysqli_query($connection, "SELECT id AS session_id FROM 10153154_kylastajad WHERE email='$users_email'") or die("Ei saanud kasutaja id-d.");
			$result = mysqli_fetch_assoc($query);
			
			$_SESSION['user_id'] = $result['session_id'];

		}
		else {
			return $errors;
		}
	}
}

function logout() {
	session_destroy();
	unset($_SESSION['user']);
	$id = false;
}

?>
