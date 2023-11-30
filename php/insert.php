<?php

require_once('config.php');

$nome = $connessione->real_escape_string($_POST['nome']);
$cognome = $connessione->real_escape_string($_POST['cognome']);
$email = $connessione->real_escape_string($_POST['email']);

$sql = "INSERT INTO persone (nome, cognome, email) VALUES ('$nome', '$cognome', '$email')";

if ($connessione->query($sql)) {
    $data = [
        "messaggio" => "Riga inserita con successo",
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
