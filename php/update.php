<?php

require_once('config.php');

$id = $_POST["id"];
$nome = $_POST["nomeMod"];
$cognome = $_POST["cognomeMod"];
$email = $_POST["emailMod"];

$sql = "UPDATE persone SET nome='$nome', cognome='$cognome', email='$email' WHERE id = $id";
if ($connessione->query($sql) === true) {
    $data = [
        "messaggio" => "Riga modificata con successo",
        "response" => 1,
    ];
    echo json_encode($data);
} else {
    $data = [
        "messaggio" => $connessione->error,
        "response" => 0,
    ];
    echo json_encode($data);
}
