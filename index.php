<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="stile.css">

<body>

<center>
<img src="img/logo.png" width="50%">

<p>
<h3>Sistema di rilascio credenziali G-Suite</h3>
<label>Inserire il codice fiscale o School Pass (senza spazi) quindi</label>
<label>selezionare classe e indirizzo di studi.</label>
<label>Cliccare infine sul comando di ricerca</label>
</p>
<hr>

<form action="back_scuola.php">

    <label for="codice">Codice:</label><br>
    <input type="text" id="codice" name="codice" placeholder="..."><br><br>

    <label for="scuola_classe">Classe e indirizzo:</label><br>
    <select id="scuola_classe" name="scuola_classe" class="select">
    <option value=''disabled selected>Scegliere</option>
    <?php

        /* Establish DB connection */
        $conn = @mysqli_connect ( 'localhost', 'dbuser', '', 'Database_Allievi' );

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error ();
        }

        /* Query construction */
        $query = "SELECT DISTINCT Classe
                  FROM Dati
                  ORDER BY Classe ASC";

        /* Query execution */
        $result = mysqli_query ( $conn, $query );
        if (!$result){
            die ( 'Query error: ' . mysqli_error ( $conn ) );
        }

        /* Check if codt found */
        if (mysqli_num_rows ( $result ) > 0) {
            while($row = mysqli_fetch_array($result)) {
                $codt = $row["Classe"];
                echo "<option value='$codt'>$codt</option>";
            }
        }
        ?>
        </select>
        <br>
        <br>

    <input type="submit" value="Ricerca credenziali">
</form>
<hr>
<label>Applicazione MySql + PHP di Isabella e Massimo Priano</label>

</center>
</body>
</html>
