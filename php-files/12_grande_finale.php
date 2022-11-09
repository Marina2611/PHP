<?php

include "connect.php";
$tabname = "Infomaterial";


 function test_post($post) {

        if(!isset($_POST[$post])) {
            return '';
        }

        $data = $_POST[$post];

        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $anrede = test_post('anrede');
        $name = test_post('name');
        $strasse = test_post('strasse');
        $plz = test_post('plz');
        $ort = test_post('ort');
        $jahreszeit = test_post('jahreszeit');
        $wuensche = test_post('wuensche');

        if(!empty($name) AND
           !empty($strasse) AND
           !empty($plz) AND
           !empty($ort)
        ) {

            // connect
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			if (!$conn) {
			die("Verbindung fehlgeschlagen: " .mysqli_connect_error());
			}

            // write data to database
			$sql = "INSERT INTO $tabname
                    (Anrede, Name, Strasse, PLZ, Ort, Aufenthalt, Wuensche) VALUES
                    ('$anrede','$name','$strasse', '$plz', '$ort', '$jahreszeit', '$wuensche');";
            
			//Falls Sie eine Fehlermeldung "Invalid SQL" bekommen, mal den SQL-Befehl ausgeben
			echo $sql;
			

            if (mysqli_query($conn, $sql)) {
                $daten_eingegangen = true;
            } else {
                die("Fehler: " . mysqli_error($conn));
            }
        }
    }
?>


<!doctype html>
<html lang="de">
    <head>

        <meta charset="utf-8">
        <title>Formular</title>

        <style>

            label {

                min-width: 75px;
                display: inline-block;
            }

            input.error {
                border: 1px solid red;
            }

            table, tr, td, th {
                border: 1px solid black;
                border-collapse: collapse;
            }

        </style>

    </head>
    <body>

        <h1>Infomaterial</h1>

        <p>Bitte senden Sie mir Informationsmaterial!</p>

        <form method="post">

            <p>
                <label for="anrede">Anrede:</label>
                <select id="anrede" name="anrede">
                    <option>Herr</option>
                    <option>Frau</option>
                    <option>Familie</option>
                </select>
            </p>

            <p>
                <label for="Name">Name *</label>
                <input <?php if($_SERVER['REQUEST_METHOD'] == 'POST' AND empty($_POST['name'])) { echo 'class="error"'; } ?> type="text" id="name" name="name" placeholder="Bitte Vor- und Nachnamen eingeben">
            </p>

            <p>
                <label for="strasse">Straße *</label>
                <input <?php if($_SERVER['REQUEST_METHOD'] == 'POST' AND empty($_POST['strasse'])) { echo 'class="error"'; } ?>type="text" id="strasse" name="strasse">
            </p>

            <p>
                <label for="plz">PLZ *</label>
                <input <?php if($_SERVER['REQUEST_METHOD'] == 'POST' AND empty($_POST['plz'])) { echo 'class="error"'; } ?>type="text" id="plz" name="plz" maxlength="5">
                <!-- kein type="number", da es postleitzahlen gibt, die mit "0" beginnen -->
            </p>

            <p>
                <label for="ort">Ort *</label>
                <input <?php if($_SERVER['REQUEST_METHOD'] == 'POST' AND empty($_POST['ort'])) { echo 'class="error"'; } ?>type="text" id="ort" name="ort">
            </p>

            <p>
                Ich beabsichtige einen Aufenthalt im<br>
                <input type="radio" name="jahreszeit" value="sommer" id="jahreszeit-sommer"><label for="jahreszeit-sommer">Sommer</label><br>
                <input type="radio" name="jahreszeit" value="winter" id="jahreszeit-winter"><label for="jahreszeit-winter">Winter</label>
            </p>

            <p>
                <label for="wuensche">Ich habe folgende Wünsche:</label><br>
                <textarea id="wuensche" name="wuensche"></textarea>
            </p>

            <p>
                <input type="submit" value="absenden"><input type="reset" value="Formular leeren">
            </p>

        </form>

        <?php

            if(isset($daten_eingegangen)) {

                ?>

                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
							<th>Anrede</th>
                            <th>Name</th>
                            <th>Strasse</th>
                            <th>PLZ</th>
                            <th>Ort</th>
                            <th>Jahreszeit</th>
                            <th>Wünsche</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                            $query = 'SELECT * FROM Infomaterial';
                            $result = mysqli_query($conn, $query);

                            if(mysqli_num_rows($result) > 0) {

                                while($row = mysqli_fetch_assoc($result))
                                {
                                    echo '
                                        <tr>
                                            <td>'.$row['id'].'</td>
											<td>'.$row['Anrede'].'</td>
                                            <td>'.$row['Name'].'</td>
                                            <td>'.$row['Strasse'].'</td>
                                            <td>'.$row['PLZ'].'</td>
                                            <td>'.$row['Ort'].'</td>
                                            <td>'.$row['Aufenthalt'].'</td>
                                            <td>'.$row['Wuensche'].'</td>
                                        </tr>';
                                }

                            } else {

                                die('keine Einträge gefunden');
                            }

                        ?>
                    </tbody>
                </table>

            <?php

            }

        ?>

    </body>
</html>