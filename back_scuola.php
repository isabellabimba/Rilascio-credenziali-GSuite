<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="stile.css">
<body>
<center>
<img src="img/logo.png" width="50%">
<hr>
<?php

/* Verify parameter */
if (!isset($_REQUEST["codice"]) || trim($_REQUEST["codice"]) == ""){
    echo "
        <h3>Errore!</h3>
        <p>Codice non inserito.</p>
        <hr>";
    echo '<a href="index.php">Clicca qui per tornare alla pagina di ricerca</a>';
     exit;

}


$codice = $_REQUEST["codice"];
$scuola_classe = $_REQUEST["scuola_classe"];

$savecode = $codice;

if (strlen($codice) == 8)
        $codice = substr($codice, 1);

if (strlen($codice) == 9)
        $codice = substr($codice, 1, -1);

/* Establish DB connection */
$conn = @mysqli_connect ( 'localhost', 'dbuser', '', 'Database_Allievi' );

if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error ();
}

/* String sanification for DB query */
$codice =  utf8_decode( mysqli_real_escape_string($conn, $codice)  );
$scuola_classe = utf8_decode( mysqli_real_escape_string($conn, $scuola_classe) );


/* Query construction */
$query = "SELECT Nome, Cognome, Email, Password
          FROM Dati
          WHERE Classe = '$scuola_classe' AND
                Nome IN (SELECT Nome2
                          FROM Fine
                          WHERE CodiceStud = '$codice' OR CodFisc = '$codice') AND
                Cognome IN (SELECT Cognome2
                             FROM Fine
                             WHERE CodiceStud = '$codice' OR CodFisc = '$codice')";
$result = mysqli_query ( $conn, $query );

/* Query execution */
$result = mysqli_query ( $conn, $query );
if (!$result){
    die ( 'Query error: ' . mysqli_error ( $conn ) );
}

/* Check if codice found */
if (mysqli_num_rows ( $result ) > 0) {
    echo "<h1>Per il codice $savecode corrisponde:</h1>";
    echo '<table border="0" align="center" class="copyright" width="100%">';

    /* Table header */
    echo "<thead><tr>";
    $i = 0;
    $field_names = [];
    while($i<mysqli_num_fields($result)) {
        $meta=mysqli_fetch_field($result);
        echo "<th>".$meta->name."</th>";
        array_push($field_names, $meta->name);
        $i++;
    }
    echo "</thead></tr>";

    /* Table content */
    while($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        foreach ($field_names as $field){
            /* String sanification for HTML */
            $safe_html = htmlspecialchars($row[$field], ENT_QUOTES | ENT_SUBSTITUTE, 'utf-8');
            echo "<td>" . $safe_html . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    echo "<h4>ATTENZIONE: La password e' valida solo per il primo accesso<h4>";

} else {
    echo "<h1>Codice non trovato!</h1>";
    echo "<label>Controllare i dati inseriti ed effettuare una nuova ricerca</label>";
}

?>
<hr>
<a href="index.php">Clicca qui per tornare alla pagina di ricerca</a>
</center>
</body>
</html>
